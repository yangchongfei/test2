<?php

namespace app\common\model;

class FriendUrl extends Base
{
    /**
     * [getArticleByCondition  获取友情链接]
     * @author []
     * @param $map
     * @param $from
     * @param $size
     * @param $is_form_home
     * @return array
     */
    public function getFriendUrlByCondition($map, $from, $size,$is_form_home = false)
    {
        $orde = ['sort' => 'asc','id' => 'asc'];

        if($is_form_home)
            $map = ['status' => 1];

       $lists =  $this->where($map)->limit($from, $size)->order($orde)->select( );
        return $lists;
    }


    /**
     * [getArticleByCondition  获取友情链接数目]
     * @author []
     * @return str
     */
    public function getFriendUrlCountByCondition($map){
        return $this->where($map)->count();
    }
}