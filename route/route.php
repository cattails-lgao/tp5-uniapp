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
  Route::post('user/sendcode','api/:version.User/sendCode');
  // 手机登录
  Route::post('user/phonelogin','api/:version.User/phoneLogin');
  // 账号密码登
  Route::post('user/login','api/:version.User/login');
  // 第三方登录
  Route::post('user/otherlogin','api/:version.User/otherLogin');
  // 获取文章列表
  Route::get('postclass', 'api/:version.PostClass/index');
  // 获取话题分类列表
  Route::get('topicclass','api/:version.TopicClass/index');
  // 获取10条热门话题
  Route::get('topic','api/:version.topic/index');
  // 获取指定话题分类下的话题列表
  Route::get('topicclass/:id/topic/:page', 'api/:version.TopicClass/topic');
  // 获取文章详情
  Route::get('post/:id', 'api/:version.Post/index');
  // 获取指定话题下的文章列表
  Route::get('topic/:id/post/:page', 'api/:version.Topic/post');
  // 获取指定文章分类下的文章
  Route::get('postclass/:id/post/:page', 'api/:version.PostClass/post') -> middleware(['ApiGetUserid']);
  // 获取指定用户下的文章
  Route::get('user/:id/post/:page', 'api/:version.User/post');
  // 搜索话题
  Route::post('search/topic', 'api/:version.Search/topic');
  // 搜索文章
  Route::post('search/post', 'api/:version.Search/post');
  // 搜索用户
  Route::post('search/user', 'api/:version.Search/user');
  // 广告列表
  Route::get('adsense/:type', 'api/:version.Adsense/index');
  // 获取当前文章的所有评论
  Route::get('post/:id/comment','api/:version.Post/comment');
  // 检测更新
  Route::post('update','api/:version.Update/update');
});

// 需要 token
// ,'ApiUserBindPhone','ApiUserStatus'
Route::group('api/:version/', function(){
  // 退出登录
  Route::post('user/logout','api/:version.User/logOut');
  // 绑定手机
  Route::post('user/bindphone','api/:version.User/bindphone');
  // 绑定邮箱
  Route::post('user/bindemail','api/:version.User/bindemail');
}) -> middleware(['ApiUserAuth']);

Route::group('api/:version/', function(){
  // 上传多图
  Route::post('image/uploadmore','api/:version.Image/uploadMore');
  // 发布文章
  Route::post('post/create','api/:version.Post/create');
  // 获取指定用户下的所有文章（含隐私）
  Route::get('user/post/:page', 'api/:version.User/Allpost');
  // 绑定第三方
  Route::post('user/bindother','api/:version.User/bindother');
  // 用户顶踩
  Route::post('support', 'api/:version.Support/index');
  // 用户评论
  Route::post('post/comment','api/:version.Comment/comment');
  // 编辑头像
  Route::post('edituserpic','api/:version.User/editUserpic');
  // 编辑资料
  Route::post('edituserinfo','api/:version.User/editinfo');
  // 修改密码
  Route::post('repassword','api/:version.User/rePassword');
  // 加入黑名单
  Route::post('addblack','api/:version.Blacklist/addBlack');
  // 移出黑名单
  Route::post('removeblack','api/:version.Blacklist/removeBlack');
  // 关注
  Route::post('follow','api/:version.User/follow');
  // 取消关注
  Route::post('unfollow','api/:version.User/unfollow');
  // 互关列表
  Route::get('friends/:page','api/:version.User/friends');
  // 粉丝列表
  Route::get('fens/:page','api/:version.User/fens');
  // 关注列表
  Route::get('follows/:page','api/:version.User/follows');
  // 用户反馈
  Route::post('feedback','api/:version.Feedback/feedback');
  // 获取用户反馈列表
  Route::get('feedbacklist/:page','api/:version.Feedback/feedbacklist');
}) -> middleware(['ApiUserAuth','ApiUserBindPhone','ApiUserStatus']);

// socket 部分
Route::group('api/:version/',function(){
  // 发送信息
  Route::post('chat/send','api/:version.Chat/send');
  // 接收未接受信息
  Route::post('chat/get','api/:version.Chat/get');
  // 绑定上线
  Route::post('chat/bind','api/:version.Chat/bind');
})->middleware(['ApiUserAuth','ApiUserBindPhone','ApiUserStatus']);