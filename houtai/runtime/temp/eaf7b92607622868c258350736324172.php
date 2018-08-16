<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"C:\xampp\htdocs\houtai\public/../application/admin\view\user\ajax_user_list.html";i:1528792740;s:64:"C:\xampp\htdocs\houtai\application\admin\view\public\status.html";i:1528792740;}*/ ?>
<?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<tr class="long-td">
    <td><?php echo $vo['id']; ?></td>
    <td><?php echo $vo['account']; ?></td>
    <td><?php echo $vo['nickname']; ?></td>
    <td>
        <?php switch($name=$vo['sex']): case "value='1": ?>男<?php break; case "value='1": ?>女<?php break; default: ?>未知
        <?php endswitch; ?>
    </td>
    <td><?php echo $vo['group_name']; ?></td>
    <td>
        <img src="/uploads/face/<?php echo $vo['head_img']; ?>" class="img-circle" style="width:35px;height:35px" onerror="this.src='/static/admin/images/head_default.gif'"/>
    </td>
    <td><?php echo $vo['integral']; ?></td>
    <td><?php echo $vo['money']; ?></td>
    <td><?php echo $vo['mobile']; ?></td>
    <td><?php echo $vo['login_num']; ?></td>
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