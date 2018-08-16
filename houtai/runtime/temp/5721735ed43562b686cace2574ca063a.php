<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"C:\xampp\htdocs\houtai\public/../application/admin\view\log\ajax_adminlog_list.html";i:1528856580;}*/ ?>
<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<tr class="long-td">
    <td><?php echo $vo['id']; ?></td>
    <td><?php if($vo['admin_id'] > 0): ?><?php echo $vo['admin_id']; ?>--<?php echo $vo['admin_name']; else: ?>管理员<?php endif; ?></td>
    <td><?php echo $vo['description']; ?></td>
    <td><?php echo $vo['ip']; ?></td>
    <td><?php echo $vo['ipaddrcountry']; ?><?php echo $vo['ipaddrarea']; ?></td>
    <td>
        <?php switch($name=$vo['status']): case "1": ?><span>操作成功<span><?php break; default: ?>
                <span style="color: red">操作失败<span>
        <?php endswitch; ?>
    </td>
    <td><?php echo $vo['create_time']; ?></td>
</tr>
<?php endforeach; endif; else: echo "" ;endif; ?>
<!--总页数-->
<input id="allpagecount" type="hidden" value="<?php echo $allpage; ?>">
<!--总记录数-->
<input id="count" type="hidden" value="<?php echo $count; ?>">