<?php
namespace app\common\validate;
use think\Validate;

class BaseValidate extends Validate
{
  public function goCheck($scene = false) {
     // 获取请求传递过来的参数
    $param = request() -> param();
    
    // 开始验证
    $check = $scene ? $this ->scene($scene)  -> check($param) : $this -> check($param);
    if (!$check) \TApiException($this->getError(),10000,400);
    return true;
  }

  //  验证码验证
  protected function isPefectCode ($value, $rule = '', $data = '', $field = '') {
    // 验证码不存在
    $beforeCode = cache($data['phone']);
    if (!$beforeCode) return '请重新获取验证码';
    // 验证验证码
    if ($value != $beforeCode) return '验证码错误';
    return true; 
  }
}
