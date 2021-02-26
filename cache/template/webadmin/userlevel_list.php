<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=userlevel" class="sel">会员等级（<?php echo $tongji['all'] ?>）<i></i></a>
		<a href="webadmin.php?mod=userlevel&act=add" id="fabu">添加等级</a>
		<div class="clear"></div>
	</div>
	<?php foreach($ini['userlevel_up'] as $type=>$name):?>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="20"><input type="checkbox" name="checkall" onclick="pe_checkall(this, 'userlevel_id')" /></th>
			<th class="bgtt" width="50">ID号</th>
			<th class="bgtt" width="230">会员等级</th>
			<th class="bgtt" width="230">消费额满</th>
			<th class="bgtt" width="230">折扣率</th>
			<th class="bgtt">升级方式</th>
			<th class="bgtt" width="110">操作</th>
		</tr>
		<?php foreach($info_list[$type] as $v):?>
		<tr>
			<td><input type="checkbox" name="userlevel_id[]" value="<?php echo $v['userlevel_id'] ?>" /></td>
			<td><?php echo $v['userlevel_id'] ?></td>
			<td><?php echo $v['userlevel_name'] ?></td>
			<td><?php if($v['userlevel_up']=='auto'):?><?php echo $v['userlevel_value'] ?>元<?php else:?>-<?php endif;?></td>
			<td><?php echo $v['userlevel_zhe']*100 ?>%</td>
			<td><?php echo $name ?></td>
			<td>
				<a href="webadmin.php?mod=userlevel&act=edit&id=<?php echo $v['userlevel_id'] ?>" class="admin_edit mar3">修改</a>
				<a href="webadmin.php?mod=userlevel&act=del&id=<?php echo $v['userlevel_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		</table>
		</form>
	</div>
	<?php endforeach;?>
</div>
<?php include(pe_tpl('footer.html','admin'));?>