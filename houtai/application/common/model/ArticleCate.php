<?php

namespace app\common\model;

class ArticleCate extends Base
{
    /**
     * [getAllCate  获取全部分类]
     * @author [忘尘]
     * @param array $map
     * @param bool $from 前台传入
     * @return array
     */
    public function getAllCate($map = [],$from=false)
    {
        if($from)
            $map['status'] = ['gt',0];
        else
            $map['status'] = ['egt',0];

        return $this->where($map)->order('id asc')->select();
    }



}