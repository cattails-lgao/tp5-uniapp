<?php

namespace app\api\controller\v1;

use think\Controller;
use think\Request;
use app\common\model\PostClass as PostClassModel;
use app\common\controller\BaseController;

class PostClass extends BaseController
{
    public function index()
    {
        $list = (new PostClassModel()) -> getPostClassList();
        return self::showResCode('获取成功',['list' => $list]);
    }
}
