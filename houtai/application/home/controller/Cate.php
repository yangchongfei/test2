<?php
/**
 * Cate.php
 * 描述
 * Create on 2018/8/14 9:19
 * Create by 杨重飞
 */

namespace app\home\controller;

//文章分类
use think\Controller;

class Cate extends  Controller
{
    public function  index(){
        $cateid=input('cateid');//接收传过来的cateid的值
        $cates=db('article_cate')->find($cateid);
        //$this->assign('cates',$cates);
        $articleres= db('article')->where(array('cate_id'=>$cateid))->paginate(5);
        $this->assign('list',$articleres);
        return $this->fetch('index/index');


    }

    public function  getmore(){

    }
}