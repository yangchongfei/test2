<?php

namespace app\common\model;
use think\Db;

class UserType extends Base
{
    protected  $name = 'auth_group';

    /**
     * [getRoleByCondition  根据搜索条件获取角色列表信息]
     * @author [忘尘]
     * @param $map
     * @param $from
     * @param $size
     * @return array
     */
    public function getRoleByCondition($map, $from, $size)
    {
        $orde = ['id' => 'desc'];


        $lists =  $this->alias('a')
            ->field('a.*')
            ->where($map)
            ->limit($from, $size)
            ->order($orde)
            ->select();

        return $lists;
    }


    /**
     * [getRoleCountByCondition  根据搜索条件获取满足条数]
     * @author [忘尘]
     * @param $map
     * @return int
     */
    public function getRoleCountByCondition($map)
    {
        return $this->where($map)->count();
    }


    /**
     * [forbiddenRoleAdminUser  禁用角色的管理员]
     * @author [忘尘]
     * @param int $roleid
     * @return int|string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function forbiddenRoleAdminUser($roleid=0)
    {
        return Db::name('admin_user')->where('groupid',$roleid)->update(['status'=>0]);
    }


    /**
     * [insertRole 插入角色信息]
     * @author [忘尘]
     */    
    public function insertRole($param)
    {
        try{
            $result =  $this->validate('RoleValidate')->save($param);
            if(false === $result){               
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '添加角色成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }



    /**
     * [editRole 编辑角色信息]
     * @author [忘尘]
     */  
    public function editRole($param)
    {
        try{
            $result =  $this->validate('RoleValidate')->save($param, ['id' => $param['id']]);
            if(false === $result){
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '编辑角色成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }






    /**
     * [getRole 获取所有的角色信息]
     * @author [忘尘]
     */ 
    public function getRole()
    {
        if(session('roleid') == 1)
            $where['id'] =  ['>',0];
        else
            $where['id'] = ['=',session('roleid')];

        return $this->where($where)->select();
    }


    /**
     * [getRole 获取角色的权限节点]
     * @author [忘尘]
     */ 
    public function getRuleById($id)
    {
        $res = $this->field('rules')->where('id', $id)->find();
        return $res['rules'];
    }


    /**
     * [editAccess 分配权限]
     * @author [忘尘]
     */
    /**
     * [editAccess  ]
     * @author [忘尘]
     * @param $param
     * @return false|int
     */
    public function editAccess($param)
    {
        return $this->isUpdate(false)->save($param, ['id' => $param['id']]);
    }



    /**
     * [getRoleInfo 获取角色信息]
     * @author [忘尘]
     */ 
    public function getRoleInfo($id){

        $result = Db::name('auth_group')->where('id', $id)->find();
        if(empty($result['rules'])){
            $where = '';
        }else{
            $where = 'id in('.$result['rules'].')';
        }
        $res = Db::name('auth_rule')->field('name')->where($where)->select();

        foreach($res as $key=>$vo){
            if('#' != $vo['name']){
                $result['name'][] = $vo['name'];
            }
        }

        return $result;
    }
}