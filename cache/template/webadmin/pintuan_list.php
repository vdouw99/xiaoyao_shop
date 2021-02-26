
<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=pintuan" class="sel">拼团列表（<?php echo $tongji['all'] ?>）<i></i></a>
		<a href="webadmin.php?mod=pintuan&act=add" id="fabu">添加拼团</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="50">ID号</th>
			<th class="bgtt" width="40"></th>
			<th class="bgtt">商品名称</th>
			<th class="bgtt" width="60">原价</th>
			<th class="bgtt" width="60">拼团价</th>
			<th class="bgtt" width="60">成团人数</th>
			<th class="bgtt" width="100">创建日期</th>
			<th class="bgtt" width="180">有效日期</th>
			<th class="bgtt" width="100">状态</th>
			<th class="bgtt" width="100">操作</th>
		</tr>
		<?php foreach($info_list as $v):?>
		<tr>
			<td><?php echo $v['huodong_id'] ?></td>
			<td><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank"><img src="<?php echo pe_thumb($v['product_logo'], 100, 100) ?>" width="40" height="40" class="imgbg" /></a></td>
			<td class="aleft"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank" class="cblue"><?php echo $v['product_name'] ?></a></td>
			<td><?php echo $v['product_smoney'] ?></td>
			<td><span class="corg"><?php echo $v['product_money'] ?></span></td>
			<td><?php echo $v['product_ptnum'] ?>人</td>
			<td><?php echo pe_date($v['huodong_atime'], 'Y-m-d') ?></td>
			<td><?php echo pe_date($v['huodong_stime'], 'Y-m-d') ?> 至 <?php echo pe_date($v['huodong_etime'], 'Y-m-d') ?></td>
			<td><?php echo pe_hd_stateshow($v['huodong_stime'], $v['huodong_etime']) ?></td>
			<td>
				<a href="webadmin.php?mod=pintuan&act=edit&id=<?php echo $v['huodong_id'] ?>" class="admin_edit mar5">修改</a>
				<a href="webadmin.php?mod=pintuan&act=del&id=<?php echo $v['huodong_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
			</td>
		</tr>
		<?php endforeach;?>
		</table>
		</form>
	</div>
	<div class="right_bottom">
		<span class="fr fenye"><?php echo $db->page->html ?></span>
		<div class="clear"></div>
	</div>
</div>
<?php include(pe_tpl('footer.html','admin'));?>