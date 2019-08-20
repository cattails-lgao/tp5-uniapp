<?php

return [
     // token 过期时间
    'token_expire' => 0,
    // 阿里大鱼
    'aliSMS' => [
      'isopen' => false,
      'accessKeyId' => 'LTAIbjPjrEsRNV0M',
      'accessSecret' => 'XslcEhE6yf7J6dhpRn9dXBg3Z94KjM',
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
        'appid'=>'wx2b73910f35e3b454',
        'secret'=>'91617891943ce6cf2fc5d6c31019e9b1'
    ],
  	// 支付宝小程序
    'alipay'=>[
      'appid'=>'2019082066330893',
      // 私钥
      'PrivateKey'=>'MIIEpQIBAAKCAQEAyuqHW/O0m7YKGMLKT+vo2uBfKM1UtUHz5Vfe5CVX8ovJR3v35RP4+NqfwosbOYv+yAUcrL5tZMOBOX6NYF6GqQESBprPX0ntuCFDPDuQo6rMRU7DYdirmiIwk4m759CKTiu98BQKsLLWA+Ga06/qAF54H44DQgYPawlTV0s9xI1bViQ8wfryXTwO81YDPZymj7GVsSUfk+/EoGEKVl542gDEkRdueRB9dhvLITYlMI8HUbeVggY+iAiulShaiESzMLWSAb463VKXyEsPmGcl7EDCWHRRz+bieI+2Dlo93iYCwPhJUc1XiRoM/jnm44a5t1Jk/uupQA2e4QUJII9mCwIDAQABAoIBAFrPzzhVvxSYybf/JS/TcmjSVYQbMLfWBmMziissk0mXScNWNcEtyRUGMs2MF+kPQD0gHI8qwiaAYIrsmjTw2O817W1LR1dr7JmlOUPxnG/C9pxl/YcCwvm+J2NAFvpOGDeX1+9j6MzfnGwsQXBPoDf+D2B/2/FmaOwMRmIg6EnX9ILDg0t5LpZ8bt/1dP5QpedC9itIR69rkJAcBJ3Vi3DvRYiCxJzlFieVGsto6V17L6wLZ8t0q6XjLCe/7c496MCxa2KQXuwrjUB495lA8c1OGaNMFqv7VTfr8y4SIhxwPfpct3GiL+7TsM5SfK37smIH9ZFYGlwVN3c2SmFEupECgYEA+sP8azVgbugQhIJuqRaOZo+H3DvDeFmjyyysI9O5sLrVgMlQk5pSnoo699Z0WCCqiBJowdA9B1TakBeFWQMe/Jxfp4aELDpIhiwT7s8GcGWH6rLHW6O3TfaLlmrib1+t2jPjr07KRqOfMgr3s2LFdYkGU5RlFu1QANE04i80PM0CgYEAzybZnN/QjvJt4ZSiY/uKJ4/x4s+XxwlAHyBCZY9roqfmV6FeqiJn42JqHh+o0GAZurp4xsBtjyiTrkojpaCgWqXpr03KIWFmDWKxtQsCc7r83Lt2uXVLNAyyslxJSIuKjc+nU09M28joJ1/y+YaVBz4TKcqgcdo5ebaqK5cPrjcCgYEA2jIodByowTgaD0LzCRwAYktnuwEhj5noBMTlL/NtstKPLhV9kEGKvDqpHrey2m/qEqZ6EpKgV73Ew/ZDaHVnxARI0xsf7N/19RFrcrMe9jPSNSzEfP+SYzswsHxmdOR7AM9/wS28ogSDY+bZK3S5PhExuQ35fB6YK23eJyVNvc0CgYEAk4nTEfUioL0v36uyIU3lbxoJqIY8Tqla/xBF2fnVKos09pLbToekwIG2nO/ll0vq52CqZrxlC8JVtJvfWbbWntluX8oivbWWLtBtS0mlHHJAaKIoBBzzTAYDPB+Ynk+shiYwwZhIYH1uQ6UF9AyTlg3zLh/AOHa52uNrvhIgO+8CgYEAiZk4/tW1QKNART+XQpomGNuQC9kgxJYLvs8nX20/+t4FfVx+hrokwZRBmbry9zYLUQxfuRkoIbCk/jspKs5fOmT+aZWblwC6IrZyq34hJ3ArUEuG3RiXK62vWnrybmj0yd/1XJGjQGXDFe8oBClj0kC7nMR4qlwZk4bJnx1F4Hk=',
      // 公钥
      'PublicKey'=>'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAyuqHW/O0m7YKGMLKT+vo2uBfKM1UtUHz5Vfe5CVX8ovJR3v35RP4+NqfwosbOYv+yAUcrL5tZMOBOX6NYF6GqQESBprPX0ntuCFDPDuQo6rMRU7DYdirmiIwk4m759CKTiu98BQKsLLWA+Ga06/qAF54H44DQgYPawlTV0s9xI1bViQ8wfryXTwO81YDPZymj7GVsSUfk+/EoGEKVl542gDEkRdueRB9dhvLITYlMI8HUbeVggY+iAiulShaiESzMLWSAb463VKXyEsPmGcl7EDCWHRRz+bieI+2Dlo93iYCwPhJUc1XiRoM/jnm44a5t1Jk/uupQA2e4QUJII9mCwIDAQAB',
    ]
];