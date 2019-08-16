<?php

namespace app\common\model;

use think\Model;

class PostClass extends Model
{
    // 关联文章模型
    public function post(){
        return $this->hasMany('Post');
    }

    public function getPostClassList () {
        return $this -> field('id,classname') -> where('status',1) -> select(); 
    }
    // 获取指定分类下的文章（分页）
    public function getPost(){
        // 获取所有参数
        $param = request()->param();
        
        $userId = \request() -> userid ? \request() -> userid : 0;

        return self::get($param['id'])->post()->with([
            'user'=>function($query){
                return $query->field('id,username,userpic');
            },'images'=>function($query){
                return $query->field('url');
            },'share','support' => function ($query) use($userId) {
                return $query -> where('user_id', $userId);
            }])->page($param['page'],10)->select();
    }
}
