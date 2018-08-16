<?php

namespace app\common\model;
use think\Db;

class Group extends  Base
{
    /**
     *
     */
    /**
     * [getGroupByCondition  根据条件获取全部数据]
     * @author [忘尘]
     * @param $map
     * @param int $from
     * @param int $size
     * @return array
     */
    public function getGroupByCondition($map, $from=0, $size = 5)
    {
        $order = ['id' => 'desc'];

        $result =  $this->where($map)->limit($from, $size)->order($order)->select();

        return $result;
    }

    /**
     * [getGroupCountByCondition  根据条件来获取列表的数据的总数]
     * @author [忘尘]
     * @param array $map
     * @return int|string
     */
    public function getGroupCountByCondition($map = []) {
        return $this->where($map)->count();
    }


    /**
     * [forbiddenGroupUser  禁用会员组的会员]
     * @author [忘尘]
     * @param int $roleid
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function forbiddenGroupUser($groupid=0)
    {
        return Db::name('user')->where('group_id',$groupid)->update(['status'=>0]);
    }

}