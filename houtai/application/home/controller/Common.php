<?php
/**
 * Common.php
 * 描述
 * Create on 2018/8/14 14:30
 * Create by 杨重飞
 */

namespace app\home\controller;


use think\Controller;
//公用控制器方便调用
class Common extends Controller
{

    public function  _initialize()
    {
        //$this->right();
        $config = load_config();
        cache('db_config_data',$config);

        //后台网站设置配置，如：分页列表数
        config($config);
        $cateres= db('article_cate')->order('')->select();//首页导航
        $tagres=db('tags')->order('id desc')->select();//首页热门标签
        $this->assign(array(
            'cateres'=>$cateres,
            'tagres'=>$tagres
        ));

    }
}