<?php
namespace app\admin\controller;
use app\common\model\UserType;
use app\common\model\AdminUser as AdminUserModel;
use think\Db;

class Adminuser extends Base
{
    /**
     * [index  管理员用户管理]
     * @author [忘尘]
     * @return mixed|string
     */
    public function index()
    {
        $model = new AdminUserModel();
        if (request()->isAjax()) {
            $data = input('param.');
            $map = [];
            if(is_array($data)){
                if(!empty($data['key']))
                    $map['username'] = ['like', "%" . $data['key'] . "%"];
            }
            $this->getPageAndSize($data);
            try{
                $count = $model->getAdminUserCountByCondition($map);//满足条件的总数
                $allpage = intval(ceil($count / $this->size));//总页数
                $lists = $model->getAdminUserByConditon($map, $this->from, $this->size);
            }catch (\Exception $e)
            {
                writelog($e->getMessage(),-1);
                exception($e->getMessage());
            }

            writelog('查看管理员列表');

            if(empty($lists))
                return '';

            return $this->fetch('ajax_adminuser_list', [
                'count' => $count,//总记录数
                'allpage' => $allpage,  //总页数
                'lists' => $lists,  //列表数据
            ]);
        }

        return $this->fetch();
    }


    /**
     * [userAdd 添加用户]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function add()
    {
        $model = new AdminUserModel();
        if (request()->isAjax())
        {
            $param = input('post.');
            $param['password'] = md5(md5($param['password']) . config('admin.adminuser_password_halt'));
            //验证（待处理）

            //判断用户名是否已经注册
            $adminuser = $model->get(['username' => $param['username']]);
            if (!empty($adminuser))
                return admin_json(-2,'用户名已注册');

            try {
                $id = $model->addAdminUser($param);
                if($id)
                   Db::name('auth_group_access')->insert(['uid' => $id, 'group_id' => $param['groupid']]);

            } catch (\Exception $e) {
                writelog($e->getMessage(),-1);
                return admin_json(-1,'添加用户失败');
            }

            writelog( '管理员用户【' . $param['username'] . '】添加成功');

            return admin_json(1,'添加管理员用户成功','',url('index'));
        }

        $role = new UserType();
        return $this->fetch('add',[
            'role'=> $role->getRole()
        ]);
    }


    /**
     * [edit  编辑管理员用户]
     * @author [忘尘]
     * @return array|mixed
     */
    public function edit()
    {
        $model = new AdminUserModel();
        if (request()->isAjax())
        {
            $param = input('post.');
            if (empty($param['password']))
                unset($param['password']);
             else
                $param['password'] = md5(md5($param['password']) . config('admin.adminuser_password_halt'));

            try {
                $id = $model->editAdminUser($param);
                if ($id)
                    //用户角色表
                    Db::name('auth_group_access')->where('uid', $id)->update(['group_id' => $param['groupid']]);

            } catch (\Exception $e) {
                writelog($e->getMessage(),-1);
                return admin_json(-1,$model->getError());
            }
            writelog( '管理员【' . $param['username'] . '】编辑成功');
            return admin_json(1,'编辑管理员成功','',url('index'));
        }

        $id = input('param.id');
        $role = new UserType();
        return $this->fetch('edit',[
            'user' => $model->findData($id),
            'role' => $role->getRole()
        ]);
    }


    /**
     * [del   假删除  删除管理员用户]
     * @author [忘尘]
     * @return array
     */
    public function del()
    {
        $model = new AdminUserModel();

        $id = input('param.id');
        $res = $model->deleteFalseData(['id' => $id],['status'=>-1]);
        writelog('删除管理员--'.$id);

        return admin_json(1,'删除管理员成功');
    }


    /**
     * [status  管理员用户状态]
     * @author [忘尘]
     * @return \think\response\Json
     */
    public function status()
    {
        $model = new AdminUserModel();
        $data=input('param.');
        $res = $model->changeStatus(['id' => $data['id']],$data['status']);

        if($res)
        {
            if($data['status'] == 0)
            {
                writelog('禁用管理员状态--'.$data['id']);
                $statusurl = url('status',['id'=>$data['id'],'status'=>1]);
                return admin_json(2,'管理员已禁止',['statusurl'=>$statusurl]);
            }
            else
            {
                writelog('启用管理员状态--'.$data['id']);
                $statusurl = url('status',['id'=>$data['id'],'status'=>0]);
                return admin_json(1,'管理员已启用',['statusurl'=>$statusurl]);
            }
        }

        return admin_json(-1,'操作失败');
    }
}