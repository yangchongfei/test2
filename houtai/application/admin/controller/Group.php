<?php

namespace app\admin\controller;
use app\common\model\Group as GroupModel;
use app\common\model\User;
use think\Db;

class Group extends Base
{
    /**
     * [index  会员组]
     * @author [忘尘]
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        $group = new GroupModel();

        if (request()->isAjax())
        {
            $data = input('param.');
            $map = [];
            if(is_array($data)){
                if(!empty($data['key']))
                    $map['group_name'] = ['like',"%" . $data['key'] . "%"];
            }
            $this->getPageAndSize($data);

            try {
                $count = $group->getGroupCountByCondition($map);//满足条件的总数
                $allpage = intval(ceil($count / $this->size));//总页数
                $lists = $group->getGroupByCondition($map, $this->from, $this->size);
            } catch (\Exception $e) {
                writelog($e->getMessage(),-1);
                exception($e->getMessage());
            }

            return $this->fetch('ajax_group_list', [
                'lists' => $lists,  //列表数据
                'allpage' => $allpage,  //总页数
                'count' => $count,//总记录数
            ]);
        }

        writelog('查看会员组列表');

        return $this->fetch();
    }

    /**
     * [add  添加会员组]
     * @author [忘尘]
     * @return array|mixed
     */
    public function add()
    {
        if(request()->isAjax()){
            $model = new GroupModel();

            $param = input('post.');
            try{
                $id= $model->addData($param);
            }catch (\Exception $e){
                writelog($e->getMessage(),-1);
                return admin_json(-1, '会员组添加失败！' , '');
            }
            writelog('增加会员组--'.$id);

            return admin_json(1, '会员组添加成功！' , '', url('index'));
        }

        return $this->fetch('add');
    }

    /**
     * [edit  编辑会员组]
     * @author [忘尘]
     * @return array|mixed
     */
    public function edit()
    {
        $model = new GroupModel();
        if(request()->isAjax())
        {
            $param = input('post.');
            try {
                $status = $model->where('id','=',$param['id'])->value('status');

                $id = $model->editData($param);

                //做用户禁用操作
                if($param['status'] == 0 && $status==1)
                    $model->forbiddenGroupUser($param['id']);

                writelog('禁用会员组'.$param['id'].'的用户');

            }catch (\Exception $e) {
                writelog($e->getMessage(),-1);
                return admin_json(-1, '会员组修改失败！' , '');
            }
            writelog('修改会员组--'.$id);
            return admin_json(1, '会员组修改成功！' , '', url('index'));
        }

        $id = input('param.id');

        writelog('查看会员组--'.$id);

        return $this->fetch('edit',[
            'group' => $model->findData($id),
        ]);
    }

    /**
     * [status 会员组状态]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function status()
    {
        $model = new GroupModel();
        $data=input('param.');
        $res = $model->changeStatus(['id' => $data['id']],$data['status']);

        if($res)
        {
            if($data['status'] == 0)
            {
                //做管理员用户禁用操作
                $model->forbiddenGroupUser($data['id']);

                writelog('禁用会员组状态--'.$data['id']);
                writelog('禁用会员组'.$data['id'].'的用户');

                $statusurl = url('status',['id'=>$data['id'],'status'=>1]);
                return admin_json(2,'已禁止',['statusurl'=>$statusurl]);
            }
            else
            {
                writelog('启用会员组状态--'.$data['id']);
                $statusurl = url('status',['id'=>$data['id'],'status'=>0]);
                return admin_json(1,'已启用',['statusurl'=>$statusurl]);
            }
        }
        return admin_json(-1,'操作失败');
    }

    /**
     * [del  删除会员组]
     * @author [忘尘]
     * @return array|\think\response\Json
     */
    public function del()
    {
        $model = new GroupModel();
        $userModel = new User();

        $id = input('param.id');
        $map = [];
        $map['group_id'] = ['eq',$id];
        $map['status'] = ['eq',1];
        $res = $userModel->where($map)->find();
        if($res)
            return admin_json(-1,'会员组有正常会员，不能删除！');

        $res = $model->deleteTrueData($id);

        $res && writelog('删除会员组--'.$id);

        return admin_json(1,'删除会员组成功');
    }
}