<?php

return [
     // token 过期时间
    'token_expire' => 0,
    // 阿里大鱼
    'aliSMS' => [
      'isopen' => false,
      'accessKeyId' => '*******',
      'accessSecret' => '*********',
      'regionId' => 'cn-hangzhou',
      'product' => 'Dysmsapi',
      'version' => '2017-05-25',
      'SignName' => 'H5经验',
      'TemplateCode' => 'SMS_172357384',
      // 验证码有效期
      'expire' => 60
    ],
  	// 微信小程序
    'wx'=>[
        'appid'=>'*******',
        'secret'=>'*******'
    ],
  	// 支付宝小程序
    'alipay'=>[
      'appid'=>'2019082066330893',
      // 私钥
      'PrivateKey'=>'*******',
      // 公钥
      'PublicKey'=>'*******',
    ]
];
