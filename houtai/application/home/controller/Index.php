<?php
namespace app\home\controller;

use think\Controller;

class Index extends Common
{
    public function index()
    {

       $articleres=db('article')->order('id desc')->paginate(5);
        $this->assign('list',$articleres);
        return $this->fetch();
    }



}
