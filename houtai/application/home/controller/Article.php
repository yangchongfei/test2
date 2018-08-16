<?php
/**
 * Article.php
 * 描述
 * Create on 2018/8/13 13:55
 * Create by 杨重飞
 */

namespace app\home\controller;


use think\Controller;

class Article extends  Controller
{

    public  function  index(){
$arid = input('arid');
$articles=db('article')->find($arid);

    }
}