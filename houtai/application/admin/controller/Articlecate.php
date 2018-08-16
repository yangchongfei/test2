<?php
namespace app\admin\controller;
use app\common\model\ArticleCate as ArticleCateModel;
use app\common\model\Article as ArticleModel;
use think\Db;

class Articlecate extends Base
{
    /**
     * [index_cate  分类列表]
     * @author [忘尘]
     * @return
     */
    public function index(){
        $model = new ArticleCateModel();
        if(request()->isAjax())
        {
            $data = input('param.');
            $map = [];
            $map['status'] = ['egt',0];

            $this->getPageAndSize($data);

            try{
                $count =$model->where($map)->count();
                $lists = $model->where($map)->select();//列表
            }catch (\Exception $e)
            {
                writelog($e->getMessage(),-1);
                exception($e->getMessage());
            }
            writelog('查看文章分类列表');

            if(empty($lists))
                return '';

            return $this->fetch('ajax_articlecate_list',[
                'count' => $count,//总记录数
                'allpage' => 1,
                'lists' => $lists,
            ]);
        }
        return $this->fetch();
    }


    /**
     * [add_cate 添加分类]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function add()
    {
        $model = new ArticleCateModel();
        if(request()->isAjax()){
            $param = input('post.');
            try{
                $id= $model->addData($param);
            }catch (\Exception $e){
                writelog($e->getMessage(),-1);
                return admin_json(-1, '分类添加失败！' , '');
            }
            writelog('增加分类--'.$id);

            return admin_json(1, '分类添加成功！' , '', url('index'));
        }

        return $this->fetch();
    }


    /**
     * [edit_cate 编辑分类]
     * @return [type] [description]
     * @author [忘尘]
     */
    public function edit()
    {
        $model = new ArticleCateModel();
        if(request()->isAjax()){
           $param = input('post.');
            try{
                $id =$model->editData($param);
            }catch (\Exception $e) {
                writelog($e->getMessage(),-1);
                return admin_json(-1, $e->getMessage());
            }
            writelog('修改分类--'.$id);

            return admin_json(1, '分类编辑成功', '', url('index'));
        }

        $id = input('param.id');
        if(empty($id))
            $this->error('参数有误！');

        writelog('查看分类--'.$id);

        return $this->fetch('edit',[
            'cate' => $model->findData($id)
        ]);
    }


    /**
     * [del_cate  删除分类]
     * @author [忘尘]
     * @param int $id
     * @return array
     */
    public function del()
    {
        $model = new ArticleCateModel();
        $articleModel = new ArticleModel();

        $id = input('param.id');

        $articlemap = [];
        $articlemap['cate_id'] = ['eq',$id];
        $articlemap['status'] = ['egt',0];
        $articleRes = $articleModel->where($articlemap)->find();
        if($articleRes)
            return admin_json(-1,'分类下有文章，不能删除！');

        $model->deleteTrueData($id);
        writelog('删除分类--'.$id);

        return admin_json(1,'分类删除成功');

    }


    /**
     * [cate_state  分类状态]
     * @author [忘尘]
     * @return array
     */
    public function status()
    {
        $model = new ArticleCateModel();
        $data=input('param.');
        $res = $model->changeStatus(['id' => $data['id']],$data['status']);

        if($res)
        {
            if($data['status'] == 0)
            {
                writelog('禁用分类状态--'.$data['id']);
                $statusurl = url('status',['id'=>$data['id'],'status'=>1]);
                return admin_json(2,'分类已禁止',['statusurl'=>$statusurl]);
            }
            else
            {
                writelog('启用分类状态--'.$data['id']);
                $statusurl = url('status',['id'=>$data['id'],'status'=>0]);
                return admin_json(1,'分类已开启',['statusurl'=>$statusurl]);
            }
        }
        return admin_json(-1,'操作失败');
    }
}