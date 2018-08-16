<?php

namespace app\admin\controller;
use app\common\model\Ad as AdModel;
use app\common\model\AdPosition as AdPositionModel;
use think\Db;

class Adposition extends Base
{
    /**
     * [index  广告位列表]
     * @author [忘尘]
     * @return mixed|string
     * @throws \Exception
     */
    public function index()
    {
        $model = new AdPositionModel();

        if(request()->isAjax())
        {
            $data = input('param.');
            $map = [];

            if(is_array($data)){
                if(!empty($data['key']))
                    $map['name'] = ['like',"%" . $data['key'] . "%"];
            }
            $this->getPageAndSize($data);

            try{
                $count =$model->getAdPositionCountByCondition($map);
                $allpage = intval(ceil($count / $this->size));//总页面
                $lists = $model->getAdPositionByCondition($map, $this->from, $this->size);//列表
            }catch (\Exception $e)
            {
                writelog($e->getMessage(),-1);
                exception($e->getMessage());
            }
            writelog('查看广告位列表');

            if(empty($lists))
                return '';

            return $this->fetch('ajax_adposition_list',[
                'count' => $count,//总记录数
                'allpage' => $allpage,
                'lists' => $lists,
            ]);
        }
        return $this->fetch();
    }


    /**
     * [add  添加广告位]
     * @author [忘尘]
     * @return array|mixed
     */
    public function add()
    {
        $model = new AdPositionModel();
        if(request()->isPost()){
            try{
                $param = input('post.');
                $id = $model->addData($param);
            }catch(\Exception $e){
                writelog($e->getMessage(),-1);
                return admin_json(-1,$model->getError());
            }
            writelog('增加广告位--'.$id);
            return admin_json(1,'增加广告位成功','',url('index'));
        }

        return $this->fetch('add');
    }


    /**
     * [edit  编辑广告位]
     * @author [忘尘]
     * @return array|mixed
     */
    public function edit()
    {
        $model = new AdPositionModel();
        if(request()->isPost()){
            try{
                $param = input('post.');
                $model->editData($param);
            }catch(\Exception $e){
                writelog($e->getMessage(),-1);
                return admin_json(-1,$model->getError());
            }
            writelog('修改广告位--'.$param['id']);
            return admin_json(1,'编辑广告位成功','',url('index'));
        }

        $id = input('param.id');
        return $this->fetch('edit',[
            'adposition' => $model->findData($id),
        ]);
    }


    /**
     * [del  删除广告位]
     * @author [忘尘]
     * @return array
     */
    public function del()
    {
        $model = new AdPositionModel();
        $adModel = new AdModel();

        $id = input('param.id');

        $admap = [];
        $admap['ad_position_id'] = ['eq',$id];
        $admap['status'] = ['eq',1];
        $adres = $adModel->where($admap)->find();
        if($adres)
            return admin_json(-1,'广告位有广告，不能删除！');

        $model->deleteTrueData($id);
        writelog('删除广告位--'.$id);

        return admin_json(1,'删除广告位成功');
    }

    /**
     * [status  广告状态]
     * @author [忘尘]
     * @return array
     */
    public function status()
    {
        $model = new AdPositionModel();
        $data=input('param.');
        $res = $model->changeStatus(['id' => $data['id']],$data['status']);

        if($res)
        {
            if($data['status'] == 0)
            {
                writelog('禁用广告位状态--'.$data['id']);
                $statusurl = url('status',['id'=>$data['id'],'status'=>1]);
                return admin_json(2,'已禁止',['statusurl'=>$statusurl]);
            }
            else
            {
                writelog('启用广告位状态--'.$data['id']);
                $statusurl = url('status',['id'=>$data['id'],'status'=>0]);
                return admin_json(1,'已启用',['statusurl'=>$statusurl]);
            }
        }

        return admin_json(-1,'操作失败');
    }

}