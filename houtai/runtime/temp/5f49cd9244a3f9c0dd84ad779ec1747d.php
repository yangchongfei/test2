<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"C:\xampp\htdocs\houtai\public/../application/admin\view\friendurl\ajax_friendurl_list.html";i:1528792740;}*/ ?>
<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<tr class="long-td">
    <td id="id"><?php echo $vo['id']; ?></td>
    <td><?php echo $vo['friend_url']; ?></td>
    <td><?php echo $vo['url']; ?></td>
    <td>
        <?php switch($name=$vo['status']): case "1": ?> 开启 <?php break; default: ?> 待审核
        <?php endswitch; ?>
    </td>
    <td>
        <a href="javascript:;" editurl="<?php echo url('edit',['id'=>$vo['id']]); ?>" thisid="<?php echo $vo['id']; ?>" onclick="edit_data(this)"  class="btn btn-primary btn-xs btn-outline"><i class="fa fa-paste"></i> 编辑</a>&nbsp;&nbsp;
        <a href="javascript:;" delurl="<?php echo url('del'); ?>" thisid="<?php echo $vo['id']; ?>" onclick="del_data(this)" class="btn btn-danger btn-xs btn-outline"><i class="fa fa-trash-o"></i> 删除</a>
    </td>
</tr>
<?php endforeach; endif; else: echo "" ;endif; ?>
<!--总页数-->
<input id="allpagecount" type="hidden" value="<?php echo $allpage; ?>">
<!--总记录数-->
<input id="count" type="hidden" value="<?php echo $count; ?>">