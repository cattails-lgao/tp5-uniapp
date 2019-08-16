<?php

namespace app\http\middleware;
use think\facade\Cache;

class ApiGetUserid
{
    public function handle($request, \Closure $next)
    {
        $param = $request -> header();
        if (array_key_exists('token', $param)) {
            $token = $param['token'];
            $user = Cache::get($token);
            if ($user) {
                $request -> userid = array_key_exists('type', $user) ? $user['user_id'] : $user['id'];
            }
        }
        return $next($request);
    }
}
