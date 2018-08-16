<?php

namespace app\admin\controller;
use app\common\model\FriendUrl as FriendUrlModel;

class Friendurl extends Base
{
    /**
     * [index  友情链接列表]
     * @author []
     * @return html
     */
    public function index(){
        $model = new FriendUrlModel();

        if(request()->isAjax())
        {
            $data = input('param.');
            $map = [];
            if(is_array($data))
            {
                if(!empty($data['key']))
                    $map['friend_url|url'] = ['like',"%" . $data['key'] . "%"];
            }
            try{
                $count = $model->getFriendUrlCountByCondition($map);
                $lists = $model->getFriendUrlByCondition($map, 0, $count);//列表
            }catch (\Exception $e)
            {
                writelog($e->getMessage(),-1);
                exception($e->getMessage());
            }

            writelog('查看友情链接列表');

            if(empty($lists))
                return '';

            return $this->fetch('ajax_friendurl_list',[
                'count' => $model->count(),//总记录数
                'allpage' => 1,
                'lists' => $lists,
            ]);
        }
        return $this->fetch();
    }



    public function  add(){


    }

    /**
     * [editFriendurl  编辑]
     * @author []
     * @return array|mixed
     */
    public function edit()
    {
        $model = new FriendUrlModel();

        if(request()->isAjax()){

            $param = input('post.');
            try {
                $id = $model->editData($param);
            }catch (\Exception $e) {
                writelog($e->getMessage(),-1);
                return admin_json(-1, '文章友链失败！' , '');
            }
            writelog('修改友链--'.$id);
            return admin_json(1, '修改成功！' , '', url('index'));
        }

        $id = input('param.id');
        writelog('查看友链--'.$id);

        return $this->fetch('',[
            'data' => $model->findData($id),
        ]);
    }


    /**
     * [delFriendurl 删除]
     * @return [type] [description]
     * @author []
     */
    public function del()
    {
        $model = new FriendUrlModel();
        try{
            $id = input('param.id');
            $model->deleteTrueData($id);
        }catch(Exception $e){
            writelog($e->getMessage(),-1);
            exception($e->getMessage());
        }
        writelog('删除友情链接--'.$id);
        return admin_json(1,'删除链接成功');
    }


}