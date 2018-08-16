<?php

namespace app\common\model;

class Menu extends Base
{
    protected $name = 'auth_rule';

    /**
     * [getAllMenu  获取全部菜单]
     * @author [忘尘]
     * @return array
     */
    public function getAllMenu()
    {
        return $this->order('id asc')->select();
    }


}