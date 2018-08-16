<?php

namespace app\common\model;
use think\Db;

class AdPosition extends Base
{
    protected $name = 'ad_position';

    // 开启自动写入时间戳
    protected $autoWriteTimestamp = true;

    /**
     * [getAdByCondition  广告位]
     * @author [忘尘]
     * @param $map
     * @param $from
     * @param $size
     * @return array
     */
    public function getAdPositionByCondition($map, $from, $size)
    {
        $lists = $this->where($map)->limit($from, $size)->order('orderby desc,id desc')->select();

        return $lists;
    }

    /**
     * [getAdCountByCondition  根据搜索条件获取满足条数]
     * @author [忘尘]
     * @param $map
     * @return int|string
     */
    public function getAdPositionCountByCondition($map)
    {
        return $this->where($map)->count();
    }
}