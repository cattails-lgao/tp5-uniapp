<?php

namespace app\api\controller\v1;

use think\Controller;
use think\Request;
use app\common\controller\BaseController;
use app\common\validate\UserValidate;
use app\common\model\User as UserModel;

class User extends BaseController
{
   // 发送验证码
   public function sendCode () {
       // 验证参数
       (new UserValidate()) -> goCheck('sendCode');
       // 发送验证码逻辑
       (new UserModel()) -> sendCode();
       return self::showResCodeWithOutData('发送成功');
   }

    // 手机号登录
    public function phoneLogin () {
        // 验证登录信息
        (new UserValidate()) -> goCheck('phonelogin');
        // 手机登录
        $token = (new UserModel()) -> phoneLogin();
        return self::showResCode('登录成功', ['token' => $token]);
    }

    // 账号密码登录
    public function login () {
        // 验证登录信息
        (new UserValidate()) -> goCheck('login');
        // 登录
        $token = (new UserModel()) -> login();
        return self::showResCode('登录成功', ['token' => $token]);
    }

    // 第三方登录
    public function otherLogin () {
        // 验证登录信息
        (new UserValidate()) -> goCheck('otherlogin');
        // 登录
        $token = (new UserModel()) -> otherlogin();
        return self::showResCode('登录成功', ['token' => $token]);
    } 

    // 退出登录
    public function logOut () {
        (new UserModel()) -> logOut();
        return self::showResCodeWithOutData('退出成功');
    }
}