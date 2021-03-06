<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"C:\xampp\htdocs\houtai\public/../application/admin\view\index\index.html";i:1534147197;s:64:"C:\xampp\htdocs\houtai\application\admin\view\public\header.html";i:1534230089;s:64:"C:\xampp\htdocs\houtai\application\admin\view\public\footer.html";i:1528792740;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo config('web_site_title'); ?></title>

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
<div class="wrapper wrapper-content">
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <div>尊敬的会员<span id="weather"></span></div>
    </div>

    <!-- 上方tab -->
    <div class="row">
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label pull-right">日</span>
                    <span class="label pull-right">周</span>
                    <span class="label label-success pull-right">月</span>
                    <h5>会员</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $usercount; ?></h1>
                    <small>总会员</small>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">日</span>
                    <span class="label pull-right">周</span>
                    <span class="label pull-right">月</span>
                    <h5>访问</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $viewscount; ?></h1>
                    <small>总访问量</small>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">日</span>
                    <span class="label pull-right">周</span>
                    <span class="label  pull-right">月</span>
                    <h5>注册</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $newusercount; ?></h1>
                    <small>今日新增</small>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <a href="#question">
                        <i class="fa fa-question" style="color:red;margin-left:10px" data-container="body" data-toggle="popover" data-placement="bottom"
                           data-content="日活跃用户"></i>
                    </a>
                    <span class="label pull-right">日</span>
                    <span class="label pull-right">周</span>
                    <span class="label label-success pull-right">月</span>
                    <h5>活跃用户</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo $activeusercount; ?></h1>
                    <small><?php echo date('n'); ?>月</small>
                </div>
            </div>
        </div>
    </div>

    <!-- 曲线图 -->
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-sm-12">
            <div  class="col-sm-6">
                <div id="container1" style="min-width:400px;height:400px"></div>
            </div>
            <div class="col-sm-6">
                <div id="container2" style="min-width:400px;height:400px"></div>
            </div>
        </div>
    </div>

    <!-- 中间折线 -->
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-cogs"></i> 系统信息
                    </div>
                    <div class="panel-body">
                        <p><i class="fa fa-sitemap"></i> 框架版本：ThinkPHP<?php echo $info['think_v']; ?>
                        </p>
                        <p><i class="fa fa-windows"></i> 服务环境：<?php echo $info['web_server']; ?>
                        </p>
                        <p><i class="fa fa-warning"></i> 上传附件限制：<?php echo $info['onload']; ?>
                        </p>
                        <p><i class="fa fa-credit-card"></i> PHP 版本：<?php echo $info['phpversion']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <!--<div class="col-sm-6">-->
                <!--<div class="panel panel-primary">-->
                    <!--<div class="panel-heading">-->
                        <!--<i class="fa fa-cogs"></i> 个人信息-->
                    <!--</div>-->
                    <!--<div class="panel-body">-->
                        <!--<p><i class="fa fa-send-o"></i> 博客：<a href="<?php echo url('home/index/index'); ?>" target="_blank">http://zjty.safeandsound.vip</a>-->
                        <!--</p>-->
                        <!--<p><i class="fa fa-qq"></i> QQ：<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=2656682755&amp;site=qq&amp;menu=yes" target="_blank">2656682755</a>-->
                        <!--</p>-->
                        <!--<p><i class="fa fa-weixin"></i> 微信：<a href="javascript:;">13750006075</a>-->
                        <!--</p>-->
                        <!--<p><i class="fa fa-credit-card"></i> 邮箱：<a href="javascript:;" class="邮箱信息">2656682755@qq.com</a>-->
                        <!--</p>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        </div>
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
<script src="/static/admin/js/jquery.leoweather.min.js"></script>
<script type="text/javascript">
    $('#weather').leoweather({format:'，{时段}好！<span id="colock">现在时间是：<strong>{年}年{月}月{日}日 星期{周} {时}:{分}:{秒}</strong></span>'});
</script>
</body>
</html>

<!--<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>-->
<!--例子：https://www.hcharts.cn/demo/highcharts-->
<script src="/static/common/highcharts_min/highcharts.js"></script>
<!--启用导出功能时需要引入的文件start-->
<script src="/static/common/highcharts_min/exporting.js"></script>
<script src="/static/common/highcharts_min/highcharts-zh_CN.js"></script>
<!--启用导出功能时需要引入的文件end-->
<script>
    //日访问数
    Highcharts.chart('container1', {
        title: {
            text: '<?php echo date('Y'); ?>年-<?php echo date('m'); ?>月  日访问量'
        },
        subtitle: {
            text: '数据来源：'
        },
        credits: {
            text: '',
            href: ''
        },
        xAxis: {
            categories: [<?php echo $dStr; ?>]
        },
        yAxis: {
            title: {
                text: '次数 (次)'
            }
        },
        //图例
        legend: {
            layout: 'vertical',//horizontal水平  vertical垂直
            align: 'right',//left center  right 对齐方式
            verticalAlign: 'middle' //top middle bottom 垂直对齐方式
        },
        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                //pointStart: 1 //x轴自增开始数
            },
            line: {
                dataLabels: {
                    enabled: true // 开启数据标签
                },
                //enableMouseTracking: false  // 关闭鼠标跟踪，对应的提示框、点击事件会失效
            }
        },
        series: [{
            name: '访问数',
            data: [<?php echo $dViewStr; ?>],
            showInLegend: false // 设置为 false 即为不显示在图例中
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });

    //每月访问数
    Highcharts.chart('container2', {

        chart: {
            type: 'column'
        },
        credits: {
            text: 'safeandsound.vip',
        },
        title: {
            text: '<?php echo date('Y'); ?>年 月访问数'
        },

        subtitle: {
            text: '数据来源: '
        },

        xAxis: {
            //categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            categories: [<?php echo $mStr; ?>]
        },

        yAxis: {
            title: {
                text: '次数 (次)'
            }
        },

        plotOptions: {
            series: {
                colorByPoint: true, //使用不同的颜色
                dataLabels: {
                    enabled: true,
                     formatter: function() {
                         return this.x + "   " + this.y;
                     },
                    // format: "{x}      {y}"
                }
            },

        },

        series: [{
            name:'浏览数',
            data: [<?php echo $mViewStr; ?>],
            showInLegend: false // 设置为 false 即为不显示在图例中
        }]
    });

</script>