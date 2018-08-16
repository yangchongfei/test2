<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"C:\xampp\htdocs\houtai\public/../application/admin\view\config\index.html";i:1528792740;s:64:"C:\xampp\htdocs\houtai\application\admin\view\public\header.html";i:1534230089;s:64:"C:\xampp\htdocs\houtai\application\admin\view\public\footer.html";i:1528792740;}*/ ?>
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
<style type="text/css">
/* TAB */
.nav-tabs.nav>li>a {
    padding: 10px 25px;
    margin-right: 0;
}
.nav-tabs.nav>li>a:hover,
.nav-tabs.nav>li.active>a {
    border-top: 3px solid #1ab394;
    padding-top: 8px;
    border-bottom: 1px solid #FFFFFF;
}
.nav-tabs>li>a {
    color: #A7B1C2;
    font-weight: 500;  
    margin-right: 2px;
    line-height: 1.42857143;
    border: 1px solid transparent;
    border-radius: 0;
}
</style>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>网站配置</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">       
                    <div class="panel blank-panel">
                        <div class="panel-heading">                     
                            <div class="panel-options">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true">基本配置</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">内容配置</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">系统配置</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false">短信配置</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-5" aria-expanded="false">邮件配置</a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-6" aria-expanded="false">网站说明</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <form action="<?php echo url('save'); ?>" method="post" class="form-horizontal">  
                                        <div class="hr-line-dashed"></div>                                
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">网站标题：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="text" class="form-control" name="config[web_site_title]" value="<?php echo $config['web_site_title']; ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 网站标题</span>                                           
                                            </div>
                                        </div>                                 
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">网站描述：</label>
                                            <div class="input-group col-sm-4">
                                                <textarea class="form-control" type="text" rows="3" name="config[web_site_description]"><?php echo $config['web_site_description']; ?></textarea>
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 网站搜索引擎描述</span>                                           
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">网站关键字：</label>
                                            <div class="input-group col-sm-4">
                                                <textarea class="form-control" type="text" rows="3" name="config[web_site_keyword]"><?php echo $config['web_site_keyword']; ?></textarea>
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 网站搜索引擎关键字</span>                                           
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">网站备案号：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="text" class="form-control" name="config[web_site_icp]" value="<?php echo $config['web_site_icp']; ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 设置在网站底部显示的备案号，如“ 陇ICP备15002349号-1</span>                                           
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">统计代码：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <textarea class="form-control" type="text" rows="3" name="config[web_site_cnzz]"><?php echo $config['web_site_cnzz']; ?></textarea>
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 设置在网站底部显示的站长统计信息</span>                                           
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">版权信息：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="text" class="form-control" name="config[web_site_copy]" value="<?php echo $config['web_site_copy']; ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 设置在网站底部显示的版权信息</span>                                           
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">站点状态：</label>
                                            <div class="input-group col-sm-4">
                                                <div class="radio i-checks">
                                                    <input type="radio" name='config[web_site_close]' value="1" <?php if($config['web_site_close'] == 1): ?>checked<?php endif; ?>/>开启&nbsp;&nbsp;
                                                    <input type="radio" name='config[web_site_close]' value="0" <?php if($config['web_site_close'] == 0): ?>checked<?php endif; ?>/>关闭
                                                </div>
                                            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 站点关闭后除管理员外所有人访问不了后台</span>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">后台登录验证：</label>
                                            <div class="input-group col-sm-4">
                                                <div class="radio i-checks">
                                                    <input type="radio" name='config[login_verify_type]' value="1" <?php if($config['login_verify_type'] == 1): ?>checked<?php endif; ?>/>验证码&nbsp;&nbsp;
                                                    <input type="radio" name='config[login_verify_type]' value="0" <?php if($config['login_verify_type'] == 0): ?>checked<?php endif; ?>/>滑动条
                                                </div>
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 站点关闭后除管理员外所有人访问不了后台</span>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-3">
                                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存信息</button>&nbsp;&nbsp;&nbsp;
                                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                                            </div>
                                        </div>                               
                                    </form>
                                </div>
                                <div id="tab-2" class="tab-pane">
                                    <form action="<?php echo url('save'); ?>" method="post" class="form-horizontal">  
                                        <div class="hr-line-dashed"></div>                                
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">后台每页记录数：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="text" class="form-control" name="config[list_rows]" value="<?php echo $config['list_rows']; ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 后台数据每页显示记录数</span>                                           
                                            </div>
                                        </div>                                 
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-3">
                                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存信息</button>&nbsp;&nbsp;&nbsp;
                                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                                            </div>
                                        </div>                               
                                    </form>
                                </div>
                                <div id="tab-3" class="tab-pane">
                                    <form action="<?php echo url('save'); ?>" method="post" class="form-horizontal">                             
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">禁止后台访问IP：</label>
                                            <div class="input-group col-sm-4">
                                                <textarea class="form-control" type="text" rows="3" name="config[admin_allow_ip]"><?php echo $config['admin_allow_ip']; ?></textarea>
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 多个用#号分隔，如果不配置表示不限制IP访问</span>                                           
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-3">
                                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存信息</button>&nbsp;&nbsp;&nbsp;
                                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                                            </div>
                                        </div>                               
                                    </form>
                                </div>
                                <div id="tab-4" class="tab-pane">
                                    <form action="<?php echo url('save'); ?>" method="post" class="form-horizontal">  
                                        <div class="hr-line-dashed"></div>                                
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">AppKey：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="password" class="form-control" name="config[alisms_appkey]" value="<?php echo $config['alisms_appkey']; ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请前往阿里云云通信平台查看AppKey</span>                                           
                                            </div>
                                        </div>                                 
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">AppSecret：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="password" class="form-control" name="config[alisms_appsecret]" value="<?php echo $config['alisms_appsecret']; ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请前往阿里云云通信平台查看AppSecret</span>                                           
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">短信签名：</label>
                                            <div class="input-group col-sm-4">                                              
                                                <input type="text" class="form-control" name="config[alisms_signname]" value="<?php echo $config['alisms_signname']; ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请前往阿里云云通信平台查看短信签名</span>                                           
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">短信模板ID：</label>
                                            <div class="input-group col-sm-4">
                                                <input type="password" class="form-control" name="config[alisms_templatecode]" value="<?php echo $config['alisms_templatecode']; ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请前往阿里云云通信平台查看短信模板ID</span>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">注册启用短信验证：</label>
                                            <div class="input-group col-sm-4">
                                                <div class="radio i-checks">
                                                    <input type="radio" name='config[mobile_register_status]' value="1" <?php if($config['mobile_register_status'] == 1): ?>checked<?php endif; ?>/>开启&nbsp;&nbsp;
                                                    <input type="radio" name='config[mobile_register_status]' value="0" <?php if($config['mobile_register_status'] == 0): ?>checked<?php endif; ?>/>关闭
                                                </div>
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 关闭后注册不使用邮箱验证码</span>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-3">
                                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存信息</button>&nbsp;&nbsp;&nbsp;
                                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                                            </div>
                                        </div>                               
                                    </form>
                                </div>
                                <div id="tab-5" class="tab-pane">
                                    <form action="<?php echo url('save'); ?>" method="post" class="form-horizontal">
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">邮件发送服务器(SMTP)：</label>
                                            <div class="input-group col-sm-4">
                                                <input type="text" class="form-control" name="config[smtp_server]" value="<?php echo $config['smtp_server']; ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i></span>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">服务器(SMTP)端口：</label>
                                            <div class="input-group col-sm-4">
                                                <input type="text" class="form-control" name="config[smtp_port]" value="<?php echo (isset($config['smtp_port']) && ($config['smtp_port'] !== '')?$config['smtp_port']:25); ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i>smtp的端口。默认为25。具体请参看各STMP服务商的设置说明 （如果使用Gmail，请将端口设为465)</span>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">邮箱账号：</label>
                                            <div class="input-group col-sm-4">
                                                <input type="text" class="form-control" name="config[smtp_user]" value="<?php echo $config['smtp_user']; ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 使用发送邮件的邮箱账号</span>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">邮箱密码/授权码：</label>
                                            <div class="input-group col-sm-4">
                                                <input type="password" class="form-control" name="config[smtp_pwd]" value="<?php echo $config['smtp_pwd']; ?>">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 使用发送邮件的邮箱密码,或者授权码。具体请参看各STMP服务商的设置说明</span>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">测试接收的邮件地址：</label>
                                            <div class="input-group col-sm-4">
                                                <input value="<?php echo $config['test_eamil']; ?>" name="config[test_eamil]" id="test_eamil" class="form-control" type="text">
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 首次请先保存配置再测试</span>
                                                <button onclick="sendEmail()" class="btn btn-primary" type="button"><i class="fa"></i>测试</button>&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">注册启用邮箱：</label>
                                            <div class="input-group col-sm-4">
                                                <div class="radio i-checks">
                                                    <input type="radio" name='config[email_register_status]' value="1" <?php if($config['email_register_status'] == 1): ?>checked<?php endif; ?>/>开启&nbsp;&nbsp;
                                                    <input type="radio" name='config[email_register_status]' value="0" <?php if($config['email_register_status'] == 0): ?>checked<?php endif; ?>/>关闭
                                                </div>
                                                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 关闭后注册不使用邮箱验证码</span>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-3">
                                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存信息</button>&nbsp;&nbsp;&nbsp;
                                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="tab-6" class="tab-pane">
                                    <form action="<?php echo url('save'); ?>" method="post" class="form-horizontal">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <script src="/static/admin/ueditor/ueditor.config.js" type="text/javascript"></script>
                                            <script src="/static/admin/ueditor/ueditor.all.js" type="text/javascript"></script>
                                            <textarea name="config[aboutsite]" style="width:80%;height: 50%;" id="myEditor"><?php echo $config['aboutsite']; ?></textarea>
                                            <script type="text/javascript">
                                                var editor = new UE.ui.Editor();
                                                editor.render("myEditor");
                                            </script>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-3">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存信息</button>&nbsp;&nbsp;&nbsp;
                                            <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>         
                </div>
            </div>
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

<script type="text/javascript">

    var config = {
        '.chosen-select': {},                    
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }


    function sendEmail() {
        var email = $('#test_eamil').val();
        if (email == '') {
            layer.alert("请填写正确的测试邮箱账号！",{icon:2});
            return false;
        }
        else {
            $.ajax({
                type: "post",
                data: {test_eamil:email},
                dataType: 'json',
                url: "<?php echo url('config/sendEmail'); ?>",
                success: function (res) {
                    if (res.status == 1) {
                        layer.msg(res.msg, {icon: 1});
                    } else {
                        layer.msg(res.msg, {icon: 2, time: 2000});
                    }
                }
            })
        }
    }
</script>
</body>
</html>
