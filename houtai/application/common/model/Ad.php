<?php

namespace app\common\model;

class Ad extends Base
{
####################################################--ADMIN--start--#####################################################
    /**
     * [getAdCountByCondition  根据搜索条件获取满足条数]
     * @author [忘尘]
     * @param $map
     * @return int|string
     */
    public function getAdCountByCondition($map)
    {
        return $this->where($map)->count();
    }

    /**
     * [getAdByCondition  广告]
     * @author [忘尘]
     * @param $map
     * @param $from
     * @param $size
     * @return array
     */
    public function getAdByCondition($map, $from, $size)
    {

        $lists = $this->field('think_ad.*,name')
                    ->join('think_ad_position', 'think_ad.ad_position_id = think_ad_position.id')
                    ->where($map)
                     ->limit($from, $size)
                    ->order('orderby desc,id desc')
                    ->select();

        return $lists;
    }

    /**
     * 插入信息
     * @param $param
     */
    public function insertAd($param)
    {
         $this->validate('AdValidate')->allowField(true)->save($param);
        return $this->id;
    }

    /**
     * 编辑信息
     * @param $param
     */
    public function editAd($param)
    {
        return $result = $this->validate('AdValidate')->allowField(true)->save($param, ['id' => $param['id']]);
    }






####################################################--HOME--start--#####################################################
    /**
     * [getBanner  获取首页轮播图片]
     * @author [忘尘]
     * @param $map
     * @param $size
     * @return array
     */
    public function getBanner($map = [], $size=5)
    {
        return $this->where($map)->order('orderby desc,id desc')->limit($size)->select();
    }


}