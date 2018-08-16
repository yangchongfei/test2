<?php

namespace app\admin\controller;
use app\common\model\Ad as AdModel;
use app\common\model\AdPosition;
use think\Db;

class Ad extends Base
{
    /**
     * [index 广告列表]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function index()
    {
        $model = new AdModel();

        if(request()->isAjax())
        {
            $data = input('param.');
            $map = [];
            $map['closed'] = 0;

            if(is_array($data) && !empty($data['key'])){
                $map['title'] = ['like',"%" . $data['key'] . "%"];
            }
            $this->getPageAndSize($data);

            try{
                $count =$model->getAdCountByCondition($map);
                $allpage = intval(ceil($count / $this->size));//总页面
                $lists = $model->getAdByCondition($map, $this->from, $this->size);//列表
            }catch (\Exception $e)
            {
                writelog($e->getMessage(),-1);
                exception($e->getMessage());
            }
            writelog('查看广告列表');

            if(empty($lists))
                return '';

            return $this->fetch('ajax_ad_list',[
                'count' => $count,//总记录数
                'allpage' => $allpage,
                'lists' => $lists,
            ]);
        }
        return $this->fetch();
    }


    /**
     * [add 添加广告]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function add()
    {
        if(request()->isAjax()){
            $model = new AdModel();

            $param = input('post.');
            $param['closed'] = 0;

            try{
                $id = $model->insertAd($param);
            }catch(\Exception $e){
                writelog($e->getMessage(),-1);
                return admin_json(-1, $e->getMessage());
            }
            writelog('增加广告--'.$id);
            return admin_json(1,'添加广告成功','',url('index'));
        }


        $position = new AdPosition();
        return $this->fetch('add',[
            'position' => $position->getAllData(),
        ]);

    }


    /**
     * [edit 编辑广告]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function edit()
    {
        $model = new AdModel();
        if(request()->isPost()){
            try{
                $param = input('post.');
                $model->editAd($param);
            }catch(\Exception $e){
                writelog($e->getMessage(),-1);
                return admin_json(-1,$model->getError());
            }
            writelog('修改广告--'.$param['id']);
            return admin_json(1,'编辑广告成功','',url('index'));
        }

        $id = input('param.id');
        return $this->fetch('edit',[
            'ad' => $model->findData($id),
        ]);
    }


    /**
     * [delAd 删除广告]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function del()
    {
        $model = new AdModel();

        $id = input('param.id');
        $res = $model->deleteFalseData(['id' => $id],['closed'=>1]);
        writelog('删除广告--'.$id);

        return admin_json(1,'删除广告成功');
    }


    /**
     * [adState 广告状态]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function status()
    {
        $model = new AdModel();
        $data=input('param.');
        $res = $model->changeStatus(['id' => $data['id']],$data['status']);

        if($res)
        {
            if($data['status'] == 0)
            {
                writelog('禁用广告状态--'.$data['id']);
                $statusurl = url('status',['id'=>$data['id'],'status'=>1]);
                return admin_json(2,'已禁止',['statusurl'=>$statusurl]);
            }
            else
            {
                writelog('启用广告状态--'.$data['id']);
                $statusurl = url('status',['id'=>$data['id'],'status'=>0]);
                return admin_json(1,'已启用',['statusurl'=>$statusurl]);
            }
        }

        return admin_json(-1,'操作失败');
    }
}