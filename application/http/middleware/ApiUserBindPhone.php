<?php

namespace app\http\middleware;
// use app\common\model\User as UserModel;

class ApiUserBindPhone
{
    public function handle($request, \Closure $next)
    {
        // $param = $request -> userTokenInfo;
        // (new UserModel()) -> OtherLoginIsBindPhone($param);
        if ($request -> userid < 1) \TApiException('请先绑定手机！',20008,200);
        return $next($request);
    }
}
