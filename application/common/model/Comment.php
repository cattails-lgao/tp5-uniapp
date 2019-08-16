<?php

namespace app\common\model;

use think\Model;

class Comment extends Model
{
    // 关联用户
    public function user(){
        return $this->belongsTo('User','user_id');
    }
    // 评论
    public function comment(){
        $params = request()->param();
        
        // 获得当前用户id
        $userid = request()->userid;
        $comment = $this->create([
            'user_id'=>$userid,
            'post_id'=>$params['post_id'],
            'fid'=>$params['fid'],
            'data'=>$params['data']
        ]);
        // halt($comment);
        // 评论成功
        if ($comment) {
            if ($params['fid']>0) {
                $fcomment = self::get($params['fid']);
                $fcomment->fnum = ['inc', 1];
                $fcomment -> save();
            }
            return true;
        }
        TApiException('评论失败');
    }
}
