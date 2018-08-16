<?php

namespace app\admin\controller;
use app\common\model\Menu as MenuModel;
use think\Db;


class Menu extends Base
{
    /**
     * [index  菜单列表]
     * @author [忘尘]
     * @return mixed
     */
    public function index()
    {
        $model = new MenuModel();
        $menu = $model->getAllMenu();
        $arr = $this->rule($menu);

        writelog('查看菜单列表');

        return $this->fetch('',[
            'admin_rule' => $arr,
        ]);
    }

    /**
     * [rule  菜单整理]
     * @author [忘尘]
     * @param $cate
     * @param string $lefthtml
     * @param int $pid
     * @param int $lvl
     * @param int $leftpin
     * @return array
     */
     public function rule($cate , $lefthtml = '— — ' , $pid=0 , $lvl=0, $leftpin=0 ){
        $arr=array();
        foreach ($cate as $v){
            if($v['pid']==$pid){
                $v['lvl']=$lvl + 1;
                $v['leftpin']=$leftpin + 0;//左边距
                $v['lefthtml']=str_repeat($lefthtml,$lvl);
                $arr[]=$v;
                $arr= array_merge($arr,self::rule($cate,$lefthtml,$v['id'],$lvl+1 , $leftpin+20));
            }
        }
        return $arr;
    }


    /**
     * [add  添加菜单]
     * @author [忘尘]
     * @return array
     */
	public function add()
    {
        $model = new MenuModel();
        if(request()->isPost()){
            try{
                $param = input('post.');
                $id = $model->addData($param);
            }catch(\Exception $e){
                writelog($e->getMessage(),-1);
                return admin_json(-1,$model->getError());
            }
            writelog('增加菜单--'.$id);
            return admin_json(1,'增加菜单成功','',url('index'));
        }
    }


    /**
     * [edit  编辑菜单]
     * @author [忘尘]
     * @return array|mixed
     */
    public function edit()
    {
        $model = new MenuModel();

        if(request()->isAjax())
        {
            $param = input('post.');
            try {
                $id = $model->editData($param);
            }catch (\Exception $e) {
                writelog($e->getMessage(),-1);
                return admin_json(-1, '菜单修改失败！' , '');
            }
            writelog('修改菜单--'.$id);
            return admin_json(1, '菜单修改成功！' , '', url('index'));
        }

        $id = input('param.id');

        writelog('查看菜单--'.$id);

        return $this->fetch('edit',[
            'menu' => $model->findData($id),
        ]);
    }


    /**
     * [roleDel 删除角色]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function del()
    {
        $model = new MenuModel();

        $id = input('param.id');
        $res = $model->deleteTrueData( $id);
        writelog('删除菜单--'.$id);

        return admin_json(1,'删除菜单成功','',url('index'));
    }


    /**
     * [ruleorder  排序]
     * @author [忘尘]
     * @return array
     */
    public function ruleorder()
    {
        $model = new MenuModel();

        if (request()->isAjax()){
            $param = input('post.');     
            foreach ($param as $id => $sort){
                $data = array();
                $data['id'] = $id;
                $data['sort'] = $sort;
                try{
                    $model->editData($data);
                    unset($data);
                }catch (\Exception $e)
                {
                    writelog($e->getMessage(),-1);
                    return admin_json(-1,'排序更新失败');
                }
            }
            writelog('更新菜单排序');

            return admin_json(1,'排序更新成功');
        }
    }


    /**
     * [status  菜单状态]
     * @author [忘尘]
     * @return array
     */
    public function status()
    {
        $model = new MenuModel();

        $data=input('param.');
        $res = $model->changeStatus(['id' => $data['id']],$data['status']);

        if($res)
        {
            if($data['status'] == 0)
            {
                writelog('禁用菜单状态--'.$data['id']);
                $statusurl = url('status',['id'=>$data['id'],'status'=>1]);
                return admin_json(2,'已禁止菜单',['statusurl'=>$statusurl]);
            }
            else
            {
                writelog('启用菜单状态--'.$data['id']);
                $statusurl = url('status',['id'=>$data['id'],'status'=>0]);
                return admin_json(1,'已启用菜单',['statusurl'=>$statusurl]);
            }
        }

        return admin_json(-1,'操作失败');
    }



}