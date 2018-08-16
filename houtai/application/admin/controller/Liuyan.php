<?php
namespace app\admin\controller;
use app\common\model\Liuyan as LiuyanModel;

class Liuyan extends Base
{
    /**
     * [articleDetail  留言]
     * @author []
     * @param int $id
     * @return array
     */
    public function index()
    {
        $liuyanModel = new LiuyanModel();
        if(request()->isAjax())
        {
            $data= input('param.');
            $map = [];
            try{
                $this->getPageAndSize($data);
                $count = $liuyanModel->getLiuyanCountByCondition($map);//计算总条数
                $allpage = intval(ceil($count / $this->size));
                $lists = $liuyanModel->getLiuyanByCondition($map, $this->from, $this->size);
            }catch (\Exception $e) {
                writelog($e->getMessage(),-1);
                exception($e->getMessage());
            }


            if(empty($lists))
                return '';

            return $this->fetch('ajax_liuyan_list',[
                'count' => $count,//总记录数
                'allpage' => $allpage,
                'lists' => $lists,
            ]);
        }
        writelog('查看留言列表');

        return $this->fetch();
    }

    /**
     * [delLiuyan  删除留言]
     * @author [忘尘]
     * @return array|\think\response\Json
     */
    public function del()
    {
        $liuyanModel = new LiuyanModel();
        $id = input('param.id');
        try{
            $liuyanModel->deleteTrueData($id);
        }catch( PDOException $e){
            writelog($e->getMessage(),-1);
            exception($e->getMessage());
        }
        writelog('删除留言--'.$id);

        return admin_json(1,'删除留言成功');
    }


    /**
     * [respondLiuyan  回复留言]
     * @author [忘尘]
     * @return array|mixed
     * @throws \phpmailerException
     */
    public function respondLiuyan()
    {
        if(request()->isAjax())
        {
            $liuyanModel = new LiuyanModel();
            $data = input('post.');

            if(empty(trim($data['respondcontent'])))
                return admin_json(-1, '回复内容不能为空！' , '');

            try{
                $res = send_email($data['email'],'煮酒听雨博客回复',$data['respondcontent']);
                if($res['status'] == 1)
                    $result = $liuyanModel->isUpdate(true)->allowField(true)->save(['respondcontent'=>$data['respondcontent']],['id'=>$data['id']]);

                writelog('回复留言--'.$data['id']);
                return admin_json(1, '回复成功！' , '',url('index'));
            }catch (\Exception $e){
                writelog($e->getMessage(),-1);
                return admin_json(-1, '回复失败！' , '');
            }
        }

        $data = input('param.');

        writelog('查看留言--'.$data['id']);

        return $this->fetch('respondliuyan',[
            'liuyan' => $data,
        ]);
    }

}

