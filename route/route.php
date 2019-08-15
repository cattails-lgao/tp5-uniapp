<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 路由分组 | 不需要 token
Route::group('api/:version/', function(){
  // 发送验证码
  Route::post('user/sendcode','api/v1.User/sendCode');
  // 手机登录
  Route::post('user/phonelogin','api/v1.User/phoneLogin');
  // 账号密码登
  Route::post('user/login','api/v1.User/login');
  // 第三方登录
  Route::post('user/otherlogin','api/v1.User/otherLogin');
  // 获取文章列表
  Route::get('postclass', 'api/v1.PostClass/index');
  // 获取话题分类列表
  Route::get('topicclass','api/v1.TopicClass/index');
  // 获取10条热门话题
  Route::get('topic','api/v1.topic/index');
  // 获取指定话题分类下的话题列表
  Route::get('topicclass/:id/topic/:page', 'api/v1.TopicClass/topic');
});

// 需要 token
// ,'ApiUserBindPhone','ApiUserStatus'
Route::group('api/:version/', function(){
  // 退出登录
  Route::post('user/logout','api/v1.User/logOut');
}) -> middleware(['ApiUserAuth']);

Route::group('api/:version/', function(){
  // 上传多图
  Route::post('image/uploadmore','api/v1.Image/uploadMore');
}) -> middleware(['ApiUserAuth','ApiUserBindPhone','ApiUserStatus']);