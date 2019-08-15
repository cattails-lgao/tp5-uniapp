<?php

namespace app\common\model;

use think\Model;

class Topic extends Model
{
    // 关联话题
    public function topic(){
        return $this->hasMany('Topic');
    }
    public function gethotlist () {
        return $this->where('type',1)->limit(10)->select()->toArray();
    }
    // 获取指定话题分类下的话题（分页）
    public function getTopic(){
        // 获取所有参数
        $param = request()->param();
        return self::get($param['id'])->topic()->page($param['page'],10)->select();
    }
}
