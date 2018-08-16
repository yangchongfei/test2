<?php

namespace app\common\model;
use think\Db;

class Log extends Base
{
    protected $name = 'log_admin';

    /**
     * [getArticleByCondition  根据搜索条件获取列表信息]
     * @author [忘尘]
     * @param $map
     * @param $from
     * @param $size
     * @return array
     */
    public function getAdminLogByCondition($map, $from, $size)
    {
        $orde = ['id' => 'desc'];

        $lists =  $this->where($map)->limit($from, $size)->order($orde)->select();

        return $lists;
    }


    /**
     * [getAdminLogCountByCondition  根据搜索条件获取满足条数]
     * @author [忘尘]
     * @param $map
     * @return int|string
     */
    public function getAdminLogCountByCondition($map)
    {
        return $this->where($map)->count();
    }














    /**
     * [getHomeLogCountByCondition  前台日志数量]
     * @author [忘尘]
     * @param $map
     * @return int|string
     */
    public function getHomeLogCountByCondition($map)
    {
        return Db::name('log_home')->where($map)->count();
    }


    /**
     * [getHomeLogByCondition  前台日志]
     * @author [忘尘]
     * @param $map
     * @param $from
     * @param $size
     * @return array
     */
    public function getHomeLogByCondition($map, $from, $size)
    {
        $orde = ['id' => 'desc'];

        $lists =  Db::name('log_home')->where($map)->limit($from, $size)->order($orde)->select();

        return $lists;
    }

}