<?php

namespace app\admin\controller;
use app\common\model\Article as ArticleModel;
use app\common\model\ArticleCate as ArticleCateModel;
use think\Db;

class Article extends Base
{

    public function _initialize()
    {
        parent::_initialize();
    }


    /**
     * [index  文章列表]
     * @author []
     * @return html
     */
    public function index(){
        $model = new ArticleModel();

        if(request()->isAjax())
        {
            $data = input('param.');

            $map = [];
            if(is_array($data)){
                if(!empty($data['key']))
                    $map['title'] = ['like',"%" . $data['key'] . "%"];
            }

            $this->getPageAndSize($data);

            try{
                $count =$model->getArticleCountByCondition($map);
                $allpage = intval(ceil($count / $this->size));//总页面
                $lists = $model->getArticleByCondition($map, $this->from, $this->size);//列表
            }catch (\Exception $e)
            {
                writelog($e->getMessage(),-1);
                exception($e->getMessage());
            }

            writelog('查看文章列表');

            if(empty($lists))
                return '';

            return $this->fetch('ajax_article_list',[
                'count' => $count,//总记录数
                'allpage' => $allpage,
                'lists' => $lists,
            ]);

        }


         return $this->fetch();
    }


    /**
     * [add  添加文章]
     * @author []
     * @return array|mixed
     */
    public function add()
    {
        if(request()->isAjax()){
            $model = new ArticleModel();
            $param = input('post.');
           // $param['cate_id']=input('cate_id');
            $param['ip'] = request()->ip();
            try{
                $id= $model->addData($param);
            }catch (\Exception $e){
                writelog($e->getMessage(),-1);
                return admin_json(-1, '文章添加失败！' , '');
            }
            writelog('增加文章--'.$id);

            return admin_json(1, '文章添加成功！' , '', url('index'));
        }




        $cate = new ArticleCateModel();

        return $this->fetch('add',[
            'cate' => $cate->getAllCate(),
            'writer' => config('admin.writer')
        ]);
    }


    /**
     * [edit  编辑文章]
     * @author [忘尘]
     * @return array|mixed
     */
    public function edit()
    {
        $model = new ArticleModel();

        if(request()->isAjax())
        {
            $param = input('post.');
            try {
                $id = $model->editData($param);
            }catch (\Exception $e) {
                writelog($e->getMessage(),-1);
                return admin_json(-1, '文章修改失败！' , '');
            }
            writelog('修改文章--'.$id);
            return admin_json(1, '文章修改成功！' , '', url('index'));
        }

        $id = input('param.id');
        $cate = new ArticleCateModel();

        writelog('查看文章--'.$id);

        return $this->fetch('edit',[
            'cate' => $cate->getAllCate(),
            'article' => $model->findData($id),
        ]);
    }


    /**
     * [del  删除文章]
     * @author [忘尘]
     * @return array|\think\response\Json
     */
    public function del()
    {
        $model = new ArticleModel();

        $id = input('param.id');
        $res = $model->deleteTrueData($id);
        writelog('删除文章--'.$id);

        return admin_json(1,'删除文章成功');
    }



    /**
     * [status 文章状态]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function status()
    {
        $model = new ArticleModel();
        $data=input('param.');
        $res = $model->changeStatus(['id' => $data['id']],$data['status']);

        if($res)
        {
            if($data['status'] == 0)
            {
                writelog('禁用文章状态--'.$data['id']);
                $statusurl = url('status',['id'=>$data['id'],'status'=>1]);
                return admin_json(2,'已禁止',['statusurl'=>$statusurl]);
            }
            else
            {
                writelog('启用文章状态--'.$data['id']);
                $statusurl = url('status',['id'=>$data['id'],'status'=>0]);
                return admin_json(1,'已启用',['statusurl'=>$statusurl]);
            }
        }
        return admin_json(-1,'操作失败');
    }


}