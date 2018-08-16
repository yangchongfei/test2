<?php

namespace app\common\model;

class Liuyan extends Base
{
    /**
     * [getArticleByCondition  根据搜索条件获取用户列表信息]
     * @author [忘尘]
     * @param $map
     * @param $from
     * @param $size
     * @return array
     */
    public function getLiuyanByCondition($map, $from, $size)
    {
        $orde = ['id' => 'desc'];

       $lists =  $this
            ->where($map)
            ->limit($from, $size)
            ->order($orde)
            ->select();
        return $lists;
    }

    /**
     * [getArticleCountByCondition  根据搜索条件获取满足条数]
     * @author [忘尘]
     * @param $map
     * @return int
     */
    public function getLiuyanCountByCondition($map)
    {
       return $this->where($map)->count();
    }



}