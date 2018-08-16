<?php

namespace app\admin\controller;
use app\common\model\User as UserModel;
use app\common\model\Group;
use think\Db;

class User extends Base
{
    /**
     * [index  会员列表]
     * @author [忘尘]
     * @return mixed|string
     * @throws \Exception
     */
    public function index()
    {
        $model = new UserModel();

        if(request()->isAjax())
        {
            $data = input('param.');
            $map = [];
            if (empty($map['status']))
                $map['think_user.status'] = ['neq', config('code.status_delete')]; //0:待审核 1：正常 -1: 已删除
            else
                $map['think_user.status'] = ['eq', $map['status']]; //0:待审核 1：正常 -1: 已删除

            if(is_array($data)){
                if(!empty($data['key']))
                    $map['account|nickname|mobile'] = ['like', "%" . $data['key'] . "%"];
            }

            $this->getPageAndSize($data);

            try{
                $count =$model->getUserCountByCondition($map);
                $allpage = intval(ceil($count / $this->size));//总页面
                $lists = $model->getUserByCondition($map, $this->from, $this->size);//列表
            }catch (\Exception $e)
            {
                writelog($e->getMessage(),-1);
                exception($e->getMessage());
            }

            if(empty($lists))
                return '';

            return $this->fetch('ajax_user_list',[
                'count' => $count,//总记录数
                'allpage' => $allpage,
                'lists' => $lists,
            ]);
        }
        writelog('查看会员列表');

        return $this->fetch();
    }


    /**
     * [add  添加会员]
     * @author [忘尘]
     * @return array|mixed|\think\response\Json
     */
    public function add()
    {
        if(request()->isAjax()){
            $model = new UserModel();

            $param = input('post.');
            $param['password'] = md5(md5($param['password']) . config('user.user_password_halt'));

            try{
                $id= $model->addData($param);
            }catch (\Exception $e){
                writelog($e->getMessage(),-1);
                return admin_json(-1, '会员添加失败！' , '');
            }
            writelog('增加会员--'.$id);

            return admin_json(1, '会员添加成功！' , '', url('index'));
        }

        $group = new Group();

        return $this->fetch('add',[
            'group' => $group->getAllData(['status'=>['gt',0]])
        ]);
    }


    /**
     * [edit  编辑会员]
     * @author [忘尘]
     * @return mixed|\think\response\Json
     */
    public function edit()
    {
        $model = new UserModel();

        if(request()->isAjax())
        {
            $param = input('post.');
            if (empty($param['password'])) {
                unset($param['password']);
            } else {
                $param['password'] = md5(md5($param['password']) . config('user.user_password_halt'));
            }

            try {
                $id = $model->editData($param);
            }catch (\Exception $e) {
                writelog($e->getMessage(),-1);
                return admin_json(-1, '会员修改失败！' , '');
            }
            writelog('修改会员--'.$id);
            return admin_json(1, '会员修改成功！' , '', url('index'));
        }

        $id = input('param.id');
        $group = new Group();

        writelog('查看会员--'.$id);

        return $this->fetch('edit',[
            'member' => $model->findData($id),
            'group' => $group->getAllData(['status'=>['gt',0]])
        ]);
    }


    /**
     * [del  删除会员]
     * @author [忘尘]
     * @return \think\response\Json
     */
    public function del()
    {
        $model = new UserModel();

        $id = input('param.id');
        $res = $model->deleteTrueData($id);
        writelog('删除会员--'.$id);

        return admin_json(1,'删除会员成功');
    }


    /**
     * [status  会员状态]
     * @author [忘尘]
     * @return array
     */
    public function status()
    {
        $model = new UserModel();
        $data=input('param.');
        $res = $model->changeStatus(['id' => $data['id']],$data['status']);

        if($res)
        {
            if($data['status'] == 0)
            {
                writelog('禁用会员状态--'.$data['id']);
                $statusurl = url('status',['id'=>$data['id'],'status'=>1]);
                return admin_json(2,'已禁止',['statusurl'=>$statusurl]);
            }
            else
            {
                writelog('启用会员状态--'.$data['id']);
                $statusurl = url('status',['id'=>$data['id'],'status'=>0]);
                return admin_json(1,'已启用',['statusurl'=>$statusurl]);
            }
        }
        return admin_json(-1,'操作失败');

    }

}