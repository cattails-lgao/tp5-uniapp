<?php

namespace app\http\middleware;
use think\facade\Cache;

class ApiUserAuth
{
    public function handle($request, \Closure $next) {
        $param = $request -> header();
        // 不含头部信息
        if (!array_key_exists('token', $param)) \TApiException('非法token，禁止操作',20003,200);
        // 当前用户的 token 是否存在
        $token = $param['token'];
        $user = Cache::get($token);
        // 验证失败（未登录或已过期）
        if (!$user) \TApiException('非法TOKEN，请重新登录',20003,200);
        // 将 token 和 userid 这类常用参数放在 request 中
        $request -> userToken = $token;
        // 判断是否第三方登录
        $request -> userid = array_key_exists('type', $user) ? $user['user_id'] : $user['id'];
        $request -> userTokenUserInfo = $user;
        return $next($request);
    }
}
