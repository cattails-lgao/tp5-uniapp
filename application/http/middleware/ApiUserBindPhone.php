<?php

namespace app\http\middleware;

class ApiUserBindPhone
{
    public function handle($request, \Closure $next)
    {
        if($request->userid < 1) TApiException('请先绑定手机！',20008); 
        return $next($request);
    }
}
