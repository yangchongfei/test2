<?php

namespace app\admin\controller;
use app\common\model\Node;
use app\common\model\UserType;
use think\Db;

class Role extends Base
{
    /**
     * [index  角色列表]
     * @author [忘尘]
     * @return mixed|\think\response\Json
     */
    public function index(){

        $model = new UserType();

        if(request()->isAjax())
        {
            $data = input('param.');
            $map = [];

            $map['status'] = ['egt',0];

            if(is_array($data)){
                if(!empty($data['key']))
                    $map['title'] = ['like',"%" . $data['key'] . "%"];
            }

            $this->getPageAndSize($data);

            try{
                $count =$model->getRoleCountByCondition($map);
                $allpage = intval(ceil($count / $this->size));//总页面
                $lists = $model->getRoleByCondition($map, $this->from, $this->size);//列表
            }catch (\Exception $e)
            {
                writelog($e->getMessage(),-1);
                exception($e->getMessage());
            }


            if(empty($lists))
                return '';

            return $this->fetch('ajax_role_list',[
                'count' => $count,//总记录数
                'allpage' => $allpage,
                'lists' => $lists,
            ]);
        }

        writelog('查看角色列表');

        return $this->fetch();
    }



    /**
     * [roleAdd 添加角色]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function add()
    {
        if(request()->isAjax()){
            $model = new UserType();

            $param = input('post.');
            try{
                $id= $model->addData($param);
            }catch (\Exception $e){
                writelog($e->getMessage(),-1);
                return admin_json(-1, '文章角色失败！' , '');
            }
            writelog('增加角色--'.$id);

            return admin_json(1, '角色添加成功！' , '', url('index'));
        }

        return $this->fetch('add');
    }



    /**
     * [roleEdit 编辑角色]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function edit()
    {
        $model = new UserType();

        if(request()->isAjax())
        {
            $param = input('post.');
            try {
                $status = $model->where('id','=',$param['id'])->value('status');

                $id = $model->editData($param);

                //做管理员用户禁用操作
                if($param['status'] == 0 && $status==1)
                    $model->forbiddenRoleAdminUser($param['id']) && writelog('禁用角色'.$param['id'].'的管理员用户');

            }catch (\Exception $e) {
                writelog($e->getMessage(),-1);
                return admin_json(-1, '角色修改失败！' , '');
            }
            writelog('修改角色--'.$id);
            return admin_json(1, '角色修改成功！' , '', url('index'));
        }

        $id = input('param.id');

        writelog('查看角色--'.$id);

        return $this->fetch('edit',[
            'role' => $model->findData($id),
        ]);
    }


    /**
     * [del  删除角色]
     * @author [忘尘]
     * @return array
     */
    public function del()
    {
        $model = new UserType();

        $id = input('param.id');
        $res = $model->deleteFalseData(['id' => $id],['status'=>-1]);
        //做管理员禁用操作
        $model->forbiddenRoleAdminUser($id);

        writelog('删除角色--'.$id);
        writelog('禁用角色'.$id.'的管理员用户');


        return admin_json(1,'删除角色成功');
    }


    /**
     * [status  角色状态]
     * @author [忘尘]
     * @return array
     */
    public function status()
    {
        $model = new UserType();

        $data=input('param.');
        $res = $model->changeStatus(['id' => $data['id']],$data['status']);

        if($res)
        {
            if($data['status'] == 0)
            {
                //做管理员用户禁用操作
                $model->forbiddenRoleAdminUser($data['id']);

                writelog('禁用角色状态--'.$data['id']);
                 writelog('禁用角色'.$data['id'].'的管理员用户');

                $statusurl = url('status',['id'=>$data['id'],'status'=>1]);
                return admin_json(2,'已禁止角色',['statusurl'=>$statusurl]);
            }
            else
            {
                writelog('启用角色状态--'.$data['id']);
                $statusurl = url('status',['id'=>$data['id'],'status'=>0]);
                return admin_json(1,'已启用角色',['statusurl'=>$statusurl]);
            }
        }

        return admin_json(-1,'操作失败');
    }



    /**
     * [giveAccess 分配权限]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function giveAccess()
    {
        $param = input('param.');
        $node = new Node();
        //获取现在的权限
        if('get' == $param['type']){
            $nodeStr = $node->getNodeInfo($param['id']);
            $nodeStr && writelog('查看角色'.$param['id'].'权限');

            return admin_json(1,'success',['data'=>$nodeStr]);
        }
        //分配新权限
        if('give' == $param['type']){
            $doparam = [
                'id' => $param['id'],
                'rules' => $param['rule']
            ];
            $user = new UserType();
            $res = $user->editAccess($doparam);

            $res && writelog('给角色'.$param['id'].'分限权限');

            return admin_json(1,'角色权限分配成功');
        }
    }
}