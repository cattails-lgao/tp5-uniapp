<?php

namespace app\common\model;

use think\Model;
use think\facade\Cache;
use app\common\controller\AliSMSController;

class User extends Model
{
    // 自动写入时间
    protected $autoWriteTimestamp = true;

    // 发送验证码
    public function sendCode() {
        // 获取用户提交的手机号码
        $phone = request() -> param('phone');
        // 判断是否已经发送过
        if (Cache::get($phone)) \TApiException('你操作的太快了',30001,200);
        // 生成4位随机数字
        $code = random_int(1000,9999);
        // 判断是否开启验证码功能
        if (!config('api.aliSMS.isopen')) {
            Cache::set($phone, $code, config('api.aliSMS.expire'));
            \TApiException('验证码：'.$code,30005,200);
        }
        // 发送验证码
        $res = AliSMSController::SendMSM($phone, $code);
        
        // 发送成功写入缓存
        if ($res['Code'] == 'OK') return Cache::set($phone, $code, config('api.alisms.expire'));
        

        if ($res['Code'] == 'isv.MOBILE_NUMBER_ILLEGAL') \TApiException('无效号码',30002,200);
        if ($res['Code'] == 'isv.BUSINESS_LIMIT_CONTROL') \TApiException('今日你已经发送超过限制，改日再来',30003,200);
        // 发送失败
        \TApiException('发送失败',30004,200);
    }

    // 绑定用户信息
    public function userinfo () {
        return $this -> hasOne('Userinfo');
    }
    // 绑定第三方登录
    public function userbind () {
        return $this -> hasMany('UserBind');
    }

    // 判断用户是否存在
    public function isExist ($arr = []) {
        if (!is_array($arr)) return false; 
        if (array_key_exists('phone', $arr)) {
            return $this -> where('phone', $arr['phone']) -> find();
        }
        // 用户ID
        if (array_key_exists('id', $arr)) { 
            return $this -> where('id', $arr['id']) -> find();
        }
        // 邮箱
        if (array_key_exists('email', $arr)) { 
            return $this -> where('email', $arr['email']) -> find();
        }
        // 用户名
        if (array_key_exists('username', $arr)) { 
            return $this -> where('username', $arr['username']) -> find();
        }
        // 第三方
        if (array_key_exists('provider', $arr)) {
            $where = [
                'type' => $arr['provider'],
                'openid' => $arr['openid']
            ];
            return $this -> userbind() -> where($where) -> find();
        }
        return false;
    }

    // 手机号码登录
    public function phoneLogin () {
        // 获取所有参数
        $param = request() -> param();
        // 验证用户是否存在
        $user = $this -> isExist(['phone' => $param['phone']]);
        // 用户不存在直接注册
        if (!$user) {
            // 用户主表
            $user = self::create([
                'username' => $param['phone'],
                'phone' => $param['phone'],
                // 'password' => password_hash($param['phone'], PASSWORD_DEFAULT)
            ]);
            // 在用户信息表创建对应的记录（用户存放用户其他信息）
            $user -> userinfo() -> create([
                'user_id' => $user -> id
            ]);

            return $this -> CreateSaveToken($user -> toArray());
        }
        // 用户是否被禁用
        $this -> checkStatus($user -> toArray());
        // 登录成功，返回 token
        return $this -> CreateSaveToken($user -> toArray());
    }

    // 生成并保持 token
    public function CreateSaveToken ($arr = []) {
        // 生成 token
        $token = sha1(md5(uniqid(md5(microtime(true)).true)));
        $arr['token'] = $token;
        // 登录过期时间
        $expire = array_key_exists('expires_in', $arr) ? $arr['expires_in'] : config('api.token_expire');
        // 保存到缓存
        if (!Cache::set($token, $arr, $expire)) \TApiException();

        // 返回 token
        return $token;
    }

    // 检查用户是否禁用
    public function checkStatus ($arr, $isReget = false) {
        $status = 1;
        if ($isReget) {
            // 账号密码登录 和 第三方登录
            $userid = array_key_exists('user_id', $arr) ? $arr['user_id'] : $arr['id'];
            // 判断第三方登录是否绑定了手机号码
            if ($userid < 1) return $arr;
            // 查询user表
            $user = $this -> find($userid) -> toArray();
            // 拿到 status
            $status = $user['status'];
        } else {
            $status = $arr['status'];
        }
        if ($status == 0) \TApiException('该用户已被禁用',20001,200);
        return $arr;
    }

    // 账号密码登录
    public function login () {
        // 获取所有参数
        $param = request() -> param();
        // 验证用户是否存在
        $user = $this -> isExist($this -> filterUserData($param['username']));
        // 用户不存在
        if (!$user) \TApiException('昵称/手机号/邮箱错误',20000,200);
        // 用户是否被禁用
        $this -> checkStatus($user -> toArray());
        // 验证密码
        $this -> checkPassword($param['password'], $user -> password);
        // 登录成功 生成 token，进行缓存，返回客户端
        return $this -> CreateSaveToken($user -> toArray());
    }

    // 验证用户名是什么格式
    public function filterUserData ($data) {
        $arr = [];
        // 验证是否是手机号
        if (preg_match('^1(3|4|5|7|8)[0-9]\d{8}$^', $data)) {
            $arr['phone'] = $data;
            return $arr;
        }
        // 验证是否是邮箱
        if (preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/', $data)) {
            $arr['phone'] = $data;
            return $arr;
        }
        $arr['username'] = $data;
        return $arr;
    }

    // 验证密码
    public function checkPassword ($password, $hash) {
        if (!$hash) \TApiException('密码错误',20002,200);
        // 密码错误
        if (!password_verify($password, $hash)) \TApiException('密码错误',20002,200);

        return true;
    }

    // 第三方登录
    public function otherLogin () {
        // 获取所有参数
        $param = request() -> param();
        // 解密过程待添加
        // 验证用户是否存在
        $user = $this -> isExist(['provider' => $param['provider'],'openid' => $param['openid']]);
        // 用户不存在
        $arr = [];
        if (!$user) {
            $user = $this -> userbind() -> create([
                'type' => $param['provider'],
                'openid' => $param['openid'],
                'nickname' => $param['nickName'],
                'avatarurl' => $param['avatarUrl']
            ]);
            $arr = $user -> toArray();
            $arr['expires_in'] = $param['expires_in'];
            return $this -> CreateSaveToken($arr);
        }
        // 用户是否被禁用
        $arr = $this -> checkStatus($user -> toArray(), true);
        // 登录成功，返回 token
        $arr['expires_in'] = $param['expires_in'];
        return $this -> CreateSaveToken($arr);
    }

    // 验证第三方登录是否绑定手机
    // public function OtherLoginIsBindPhone ($user) {
    //     // 验证是否第三方登录
    //     if (array_key_exists('type',$user)) {
    //         if ($user['user_id'] < 1) \TApiException('请先绑定手机！',20008,200);
    //         return $user['user_id'];
    //     }
    //     return $user['id'];
    // }

    // 退出登录
    public function logOut () {
        if (!Cache::pull(request() -> userToken)) \TApiException('你已经退出了',30006,200);
        return true;
    }
}
