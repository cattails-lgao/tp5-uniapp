<?php

namespace app\common\validate;

use think\Validate;

class UserValidate extends BaseValidate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'phone' => 'require|mobile',
        'code' => 'require|number|length:4|isPefectCode',
        'username' => 'require',
        'password' => 'require|alphaDash',
        'provider' => 'require', // 厂商
        'openid' => 'require',
        'nickName' => 'require',
        'avatarUrl' => 'require', // 头像
        'expires_in' => 'require', // 有效期
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'phone.require' => '请填写手机号码',
        'phone.mobile' => '手机号格式错误',
        'username.require' => '用户名不能为空',
        'password.require' => '密码不能为空'
    ];

    protected $scene = [
        'sendCode' => ['phone'],
        'phonelogin' => ['phone','code'],
        'login' => ['username', 'password'],
        'otherlogin' => ['provider','openid','nickName','avatarUrl','expires_in']
    ];
}
