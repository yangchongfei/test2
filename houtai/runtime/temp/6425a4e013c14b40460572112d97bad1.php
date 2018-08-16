<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:72:"C:\xampp\htdocs\houtai\public/../application/admin\view\group\index.html";i:1528792740;s:64:"C:\xampp\htdocs\houtai\application\admin\view\public\header.html";i:1526904358;s:69:"C:\xampp\htdocs\houtai\application\admin\view\public\footer_page.html";i:1528792740;s:64:"C:\xampp\htdocs\houtai\application\admin\view\public\footer.html";i:1528792740;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo config('WEB_SITE_TITLE'); ?></title>
    <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/animate.min.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <style type="text/css">
    .long-tr th{
        text-align: center
    }
    .long-td td{
        text-align: center
    }
    </style>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>会员组列表</h5>
        </div>
        <div class="ibox-content">
            <!--搜索框开始-->           
            <div class="row">
                <div class="col-sm-12">   
                <div  class="col-sm-2" style="width: 100px">
                    <div class="input-group" >  
                        <a href="<?php echo url('add'); ?>"><button class="btn btn-outline btn-primary" type="button">添加会员组</button></a>
                    </div>
                </div>                                            
                    <form name="admin_list_sea" class="form-search" method="post" action="" onsubmit="return false">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" id="key" class="form-control" name="key" value="" placeholder="输入需查询的会员组" />
                                <span class="input-group-btn"> 
                                    <button type="button" onclick="Ajaxpage()"  class="btn btn-primary"><i class="fa fa-search"></i> 搜索</button>
                                </span>
                            </div>
                        </div>
                    </form>                         
                </div>
            </div>
            <!--搜索框结束-->
            <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
                                <th>ID</th>
                                <th>会员组名称</th>
                                <th>状态</th>
                                <th>创建时间</th>
                                <th>更新时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody id="list-content">

                        </tbody>
                    </table>
                    
<div id="AjaxPage" style="text-align:right;"></div>
<div style="text-align: right;">
    共<span id="listcount"></span>条数据<span id="allpage">,</span>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Panel Other -->
</div>

<!-- 加载动画 -->
<div class="spiner-example">
    <div class="sk-spinner sk-spinner-three-bounce">
        <div class="sk-bounce1"></div>
        <div class="sk-bounce2"></div>
        <div class="sk-bounce3"></div>
    </div>
</div>

<script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/admin/js/content.min.js?v=1.0.0"></script>
<script src="/static/admin/js/plugins/chosen/chosen.jquery.js"></script>
<script src="/static/admin/js/plugins/iCheck/icheck.min.js"></script>
<script src="/static/admin/js/plugins/layer/laydate/laydate.js"></script>
<script src="/static/admin/js/plugins/switchery/switchery.js"></script><!--IOS开关样式-->
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/layer/layer.js"></script>
<script src="/static/admin/js/laypage/laypage.js"></script>
<script src="/static/admin/js/laytpl/laytpl.js"></script>
<script src="/static/admin/js/wangchen.js?v=1.0.0"></script>
<script src="/static/admin/js/admin.js?v=1.0.0"></script>
<!--公共提示信息js-->
<script src="/static/common/js/alert_msg.js?v=1.0.0"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>

<script type="text/javascript">
    //laypage分页
    Ajaxpage();

    function Ajaxpage(curr) {
        var page = curr || 1;
        var data = $('form[name="admin_list_sea"]').serialize()+"&page="+page;

        $.getJSON('<?php echo url("index"); ?>',
            data,
            function (data) {      //data是后台返回过来的JSON数据
                $(".spiner-example").css('display', 'none'); //数据加载完关闭动画
                if (data == '') {
                    $("#list-content").html('<td colspan="20" style="padding-top:10px;padding-bottom:10px;font-size:16px;text-align:center">暂无数据</td>');
                    $('#allpage').html('');
                    $('#AjaxPage').html('');
                    $('#listcount').text(0);//总记录数
                } else {
                    $("#list-content").html(data);

                    laypage({
                        cont: $('#AjaxPage'),//容器。值支持id名、原生dom对象，jquery对象,
                        pages: $('#allpagecount').val(),//总页数
                        skip: true,//是否开启跳页
                        skin: '#1AB5B7',//分页组件颜色
                        curr: curr || 1,
                        groups: 5,//连续显示分页数
                        jump: function (obj, first) {
                            if (!first) {
                                Ajaxpage(obj.curr)
                            }
                            $('#allpage').html(',第' + obj.curr + '页，共' + obj.pages + '页');
                            $('#listcount').text($('#count').val());//总记录数
                        }
                    });
                }
            });
    }
</script>
</body>
</html>