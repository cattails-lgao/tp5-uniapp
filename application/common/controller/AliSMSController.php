<?php

namespace app\common\controller;
// 引入阿里SDK
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;


class AliSMSController
{
    static public function SendMSM ($phone, $code) {
        // AlibabaCloud::accessKeyClient('LTAIbjPjrEsRNV0M', 'XslcEhE6yf7J6dhpRn9dXBg3Z94KjM')->regionId('cn-hangzhou')->asDefaultClient();
        AlibabaCloud::accessKeyClient(config('api.aliSMS.accessKeyId'), config('api.aliSMS.accessSecret'))->regionId(config('api.aliSMS.regionId'))->asDefaultClient();

        try {
            $option = [
                'query' => [
                    'RegionId' => config('api.aliSMS.regionId'),
                    'PhoneNumbers' => $phone,
                    'SignName' =>  config('api.aliSMS.SignName'),
                    'TemplateCode' => config('api.aliSMS.TemplateCode'),
                    'TemplateParam' => "{\"code\":$code}",
                ],
            ];
            $result = AlibabaCloud::rpc()
                        ->product(config('api.aliSMS.product'))
                        // ->scheme('https') // https | http
                        ->version(config('api.aliSMS.version'))
                        ->action('SendSms')
                        ->method('POST')
                        ->host('dysmsapi.aliyuncs.com')
                        ->options($option)
                        ->request();
            return $result->toArray();
        } catch (ClientException $e) {
            // echo $e->getErrorMessage() . PHP_EOL;
            \TApiException($e -> getErrorMessage(),30000,200);
        } catch (ServerException $e) {
            // echo $e->getErrorMessage() . PHP_EOL;
            \TApiException($e -> getErrorMessage(),30000,200);
        }
    }
}
