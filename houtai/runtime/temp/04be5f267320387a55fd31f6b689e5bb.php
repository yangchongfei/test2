<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"C:\xampp\htdocs\houtai\public/../application/home\view\index\index.html";i:1534237303;s:63:"C:\xampp\htdocs\houtai\application\home\view\common\header.html";i:1534228972;s:61:"C:\xampp\htdocs\houtai\application\home\view\common\foot.html";i:1534231034;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo config('web_site_title'); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="<?php echo config('web_site_keyword'); ?>" />
    <meta name="description" content="<?php echo config('web_site_title'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <link href="http://z.cn/static/index/style/lady.css" type="text/css" rel="stylesheet" />
    <script type='text/javascript' src='http://z.cn/static/index/style/ismobile.js'></script>
</head>

<body>
<div class="ladytop">
    <div class="nav">
        <div class="left"><a href=""></a></div>
        <div class="right">
            <div class="box">
                <a href="<?php echo url('index/index'); ?>"  rel='dropmenu209'>首页</a>
                <?php if(is_array($cateres) || $cateres instanceof \think\Collection || $cateres instanceof \think\Paginator): $i = 0; $__LIST__ = $cateres;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <a href="<?php echo url('cate/index',array('cateid'=>$vo['id'])); ?>"  rel='dropmenu209'><?php echo $vo['name']; ?></a>
                <?php endforeach; endif; else: echo "" ;endif; ?>

            </div>
        </div>
    </div>
</div>



<!--顶部通栏-->





<div class="position"> <a href="<?php echo url('cate/index',array('cateid'=>1)); ?>">1</a> >  </div>
<div class="position"> <a href="<?php echo url('cate/index',array('cateid'=>2)); ?>">3</a> >  </div>
<div class="position"> <a href="<?php echo url('cate/index',array('cateid'=>3)); ?>">4</a> >  </div>
<div class="left">
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <div class="xnews2">
        <div class="dec">
            <h3><a target="_blank" href="<?php echo url('article/index',array('arid'=>$vo['id'])); ?>"><?php echo $vo['title']; ?></a></h3>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <div class="pages">
        <div class="plist" ><?php echo $list->render(); ?></div>
    </div>
</div>











<div class="position"></div>

<div class="overall">






</div>


<div class="footerd">
    <ul>
        <li><?php echo config('web_site_copy'); ?>  <a href="http://www.miibeian.gov.cn" target="_blank" rel="nofollow">豫icp备08107937号</a></li>
    </ul>
</div>

</body>
</html>