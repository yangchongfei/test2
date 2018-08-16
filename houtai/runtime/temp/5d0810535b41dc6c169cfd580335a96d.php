<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"C:\xampp\htdocs\houtai\public/../application/admin\view\adminuser\ajax_adminuser_list.html";i:1528792740;}*/ ?>
<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<tr class="long-td">
    <td><?php echo $vo['id']; ?></td>
    <td><?php echo $vo['username']; ?></td>
    <td>
        <img src="<?php echo $vo['portrait']; ?>" class="img-circle" style="width:35px;height:35px" onerror="this.src='/static/admin/images/head_default.gif'"/>
    </td>
    <td><?php echo $vo['title']; ?></td>
    <td><?php echo $vo['loginnum']; ?></td>
    <td><?php echo $vo['last_login_ip']; ?></td>
    <td><?php echo date("Y-m-d H:i:s",$vo['last_login_time']); ?></td>
    <td><?php echo $vo['real_name']; ?></td>
    <td>
        <!--普通管理员-->
        <?php if($vo['id'] != 1): switch($name=$vo['status']): case "1": ?>
            <a href="javascript:void(0);" statusurl="<?php echo url('status',['id'=>$vo['id'],'status'=>0]); ?>" thisid="<?php echo $vo['id']; ?>"  onclick="change_status(this);">
                <div id="statushtml<?php echo $vo['id']; ?>"><span class="label label-info">开启</span></div>
            </a>
            <?php break; default: ?>
            <a href="javascript:void(0);" statusurl="<?php echo url('status',['id'=>$vo['id'],'status'=>1]); ?>" thisid="<?php echo $vo['id']; ?>" onclick="change_status(this);">
                <div id="statushtml<?php echo $vo['id']; ?>"><span class="label label-danger">禁用</span></div>
            </a>
            <?php endswitch; else: ?>
            <!--超级管理员-->
            <a class="red" href="javascript:;" >
                <div><span class="label label-info">开启</span></div>
            </a>
        <?php endif; ?>
    </td>
    <td>
        <?php if($vo['id'] != 1): ?>
            <a href="javascript:;" editurl="<?php echo url('edit',['id'=>$vo['id']]); ?>" thisid="<?php echo $vo['id']; ?>" onclick="edit_data(this)"  class="btn btn-primary btn-xs btn-outline"><i class="fa fa-paste"></i> 编辑</a>&nbsp;&nbsp;
            <a href="javascript:;" delurl="<?php echo url('del'); ?>" thisid="<?php echo $vo['id']; ?>" onclick="del_data(this)" class="btn btn-danger btn-xs btn-outline"><i class="fa fa-trash-o"></i> 删除</a>
        <?php else: if(\think\Session::get('uid') == 1): ?>
                <a href="javascript:;" editurl="<?php echo url('edit',['id'=>$vo['id']]); ?>" thisid="<?php echo $vo['id']; ?>" onclick="edit_data(this)"  class="btn btn-primary btn-xs btn-outline"><i class="fa fa-paste"></i> 编辑</a>&nbsp;&nbsp;
            <?php endif; endif; ?>
    </td>
</tr>
<?php endforeach; endif; else: echo "" ;endif; ?>
<!--总页数-->
<input id="allpagecount" type="hidden" value="<?php echo $allpage; ?>">
<input id="count" type="hidden" value="<?php echo $count; ?>">