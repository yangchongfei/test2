<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:71:"C:\xampp\htdocs\houtai\public/../application/admin\view\menu\index.html";i:1528964044;s:64:"C:\xampp\htdocs\houtai\application\admin\view\public\header.html";i:1526904358;s:64:"C:\xampp\htdocs\houtai\application\admin\view\public\status.html";i:1528792740;s:64:"C:\xampp\htdocs\houtai\application\admin\view\public\footer.html";i:1528792740;}*/ ?>
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
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>菜单列表</h5>
        </div>
        <div class="ibox-content">          
            <div class="row">
                <div class="col-sm-12">   
                    <div  class="col-sm-2">
                        <div class="input-group" >  
                            <button type="button" class="btn btn-primary btn-outline" data-toggle="modal" data-target="#myModal">添加菜单</button> 
                        </div>
                    </div>                                                                                        
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <form id="ruleorder" name="ruleorder" method="post" action="<?php echo url('ruleorder'); ?>" >
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="long-tr">
                                    <th width="6%">ID</th>
                                    <th width="19%">权限名称</th>
                                    <th width="15%">节点</th>
                                    <th width="15%">菜单状态</th>
                                    <th width="18%">添加时间</th>
                                    <th width="10%">排序</th>
                                    <th width="15%">操作</th>
                                </tr>
                            </thead>
                            <tbody>                       
                                <?php if(is_array($admin_rule) || $admin_rule instanceof \think\Collection || $admin_rule instanceof \think\Paginator): if( count($admin_rule)==0 ) : echo "" ;else: foreach($admin_rule as $key=>$vo): ?>
                                    <tr class="long-td">
                                        <td><?php echo $vo['id']; ?></td>
                                        <td style='text-align:left;padding-left:<?php if($vo['leftpin'] != 0): ?><?php echo $vo['leftpin']; ?>px<?php endif; ?>'><?php echo $vo['lefthtml']; ?><?php echo $vo['title']; ?></td>
                                        <td><?php echo $vo['name']; ?></td>
                                        <td>
    <?php switch($name=$vo['status']): case "1": ?>
    <a href="javascript:void(0);" statusurl="<?php echo url('status',['id'=>$vo['id'],'status'=>0]); ?>" thisid="<?php echo $vo['id']; ?>"  onclick="change_status(this);">
        <div id="statushtml<?php echo $vo['id']; ?>"><span class="label label-info">开启</span></div>
    </a>
    <?php break; default: ?>
    <a href="javascript:void(0);" statusurl="<?php echo url('status',['id'=>$vo['id'],'status'=>1]); ?>" thisid="<?php echo $vo['id']; ?>" onclick="change_status(this);">
        <div id="statushtml<?php echo $vo['id']; ?>"><span class="label label-danger">禁用</span></div>
    </a>
    <?php endswitch; ?>
</td>
                                        <td><?php echo $vo['create_time']; ?></td>
                                        <td style="padding: 3px" >
                                            <div >
                                                <input name="<?php echo $vo['id']; ?>" value=" <?php echo $vo['sort']; ?>" width="50%" style="text-align:center;" class="form-control">
                                            </div>
                                        </td>
                                        <td>
                                            <a href="javascript:;" editurl="<?php echo url('edit',['id'=>$vo['id']]); ?>" thisid="<?php echo $vo['id']; ?>" onclick="edit_data(this)"  class="btn btn-primary btn-xs btn-outline"><i class="fa fa-paste"></i> 编辑</a>&nbsp;&nbsp;
                                            <a href="javascript:;" delurl="<?php echo url('del'); ?>" thisid="<?php echo $vo['id']; ?>" onclick="del_data(this)" removeTr="1" class="btn btn-danger btn-xs btn-outline"><i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                <tr>
                                    <td colspan="8" align="right">
                                    <button type="submit"  id="btnorder" class="btn btn-info">更新排序</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
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
    <div class="modal  fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title">添加菜单</h3>                  
                </div>
                <form class="form-horizontal" name="add" id="add" method="post" action="<?php echo url('add'); ?>">
                    <div class="ibox-content">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">所属父级</label>
                                <div class="col-sm-8">                                                      
                                    <select name="pid" class="form-control">
                                        <option value="0">--默认顶级--</option>
                                        <?php if(is_array($admin_rule) || $admin_rule instanceof \think\Collection || $admin_rule instanceof \think\Paginator): if( count($admin_rule)==0 ) : echo "" ;else: foreach($admin_rule as $key=>$vo): ?>
                                            <option value="<?php echo $vo['id']; ?>" style="margin-left:55px;"><?php echo $vo['lefthtml']; ?><?php echo $vo['title']; ?></option>                                          
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>                                    
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">菜单名称</label>
                                <div class="col-sm-8">
                                    <input type="text" name="title" id="title" placeholder="输入菜单名称" class="form-control"/>
                                </div>
                            </div>                      
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">节点</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" id="name" placeholder="模块/控制器/方法" class="form-control"/>
                                    <span class="help-block m-b-none">如：admin/user/adduser (一级节点添加“#”即可)</span>
                                </div>
                            </div>  
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">CSS样式</label>
                                <div class="col-sm-8">
                                    <input type="text" name="css" id="css" placeholder="输入菜单名称前显示的CSS样式" class="form-control"/>
                                    <span class="help-block m-b-none"> <a href="http://fontawesome.dashgame.com/" target="_black">选择图标</a> 如fa fa-user </span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">排&nbsp;序</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sort" id="sort" value="50" placeholder="输入排序" class="form-control"/>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                            <label class="col-sm-3 control-label">状&nbsp;态</label>
                            <div class="col-sm-6">
                                <div class="radio i-checks">
                                    <input type="radio" name='status' value="1" checked="checked"/>开启&nbsp;&nbsp;
                                    <input type="radio" name='status' value="0" />关闭
                                </div>
                            </div>
                        </div>                  
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> 保存</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> 关闭</button>                    
                    </div>
                </form>
            </div>
        </div>
    </div>

<script type="text/javascript">
   
    $(function(){
        $('#add').ajaxForm({
            beforeSubmit: checkForm, 
            success: complete, 
            dataType: 'json'
        });
        
        function checkForm(){
            if( '' == $.trim($('#title').val())){
                alert_msg.error('请输入菜单名称')
            }
            
            if( '' == $.trim($('#name').val())){
                alert_msg.error('控制器/方法不能为空')
            }
        }


        function complete(data){
            if(data.code == 1){
                alert_msg.success(data.msg,data.url)
            }else{
                alert_msg.error(data.msg)
            }
        }
    });


    //更新排序
    $(function(){
        $('#ruleorder').ajaxForm({
            success: complete, 
            dataType: 'json'
        });

        function complete(data){
            if(data.code == 1){
                alert_msg.success(data.msg,data.url)
            }else{
                alert_msg.error(data.msg)
            }
        }
    });

    var config = {
        '.chosen-select': {},                    
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
</script>
</body>
</html>