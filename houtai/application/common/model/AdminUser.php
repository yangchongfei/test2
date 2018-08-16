<?php

namespace app\common\model;
use think\Db;

class AdminUser extends Base
{

    /**
     * 根据搜索条件获取用户列表信息
     */
    public function getAdminUserByConditon($map, $from=0, $size = 5)
    {
        $order = ['id' => 'desc'];

        $join = [
          ['think_auth_group ag','a.groupid = ag.id'],
        ];

        //status -1 已删除
        $map['a.status'] = ['egt', 0];

        $result =  $this->field('a.*,ag.title')
            ->alias('a')
            ->join($join)
            ->where($map)
            ->limit($from, $size)
            ->order($order)
            ->select();

        return $result;
    }

    /**
     * 根据条件来获取列表的数据的总数
     * @param array $param
     */
    public function getAdminUserCountByCondition($map = []) {
        return $this->where($map)->count();
    }

    /**
     * 插入管理员信息
     * @param $param
     */
    public function addAdminUser($param)
    {
        if(!is_array($param)) {
            exception('传递数据不合法');
        }

        $this->allowField(true)->isUpdate(false)->save($param);

        return $this->id;
    }

    /**
     * 编辑管理员信息
     * @param $param
     */
    public function editAdminUser($param)
    {
        if(!is_array($param)) {
            exception('传递数据不合法');
        }

        $this->allowField(true)->isUpdate(true)->save($param, ['id' => $param['id']]);

        return $this->id;
    }


}