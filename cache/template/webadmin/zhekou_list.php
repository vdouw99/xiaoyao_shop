
<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=zhekou" class="sel"><?php echo $menutitle ?>（<?php echo $tongji['all'] ?>）<i></i></a>
		<a href="webadmin.php?mod=zhekou&act=add" id="fabu">添加活动</a>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<form method="post" id="form">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" width="50">ID号</th>
			<th class="bgtt" width="40"></th>
			<th class="bgtt aleft">活动信息</th>
			<th class="bgtt" width="100">参与商品</th>
			<th class="bgtt" width="100">创建日期</th>
			<th class="bgtt" width="180">有效日期</th>
			<th class="bgtt" width="100">状态</th>
			<th class="bgtt" width="100">操作</th>
		</tr>
		<?php foreach($info_list as $v):?>
		<?php $num = $db->pe_num('huodongdata', array('huodong_id'=>$v['huodong_id']))?>
		<tr>
			<td><?php echo $v['huodong_id'] ?></td>
			<td><img src="<?php echo $pe['host_admintpl'] ?>images/zhekou.png" style="width:33px;" /></td>
			<td class="aleft"><span class="cblue"><?php echo $v['huodong_tag'] ?></span><p><?php echo $v['huodong_desc'] ?></p></td>
			<td><?php echo $num ?>个</td>
			<td><?php echo pe_date($v['huodong_atime'], 'Y-m-d') ?></td>
			<td><?php echo pe_date($v['huodong_stime'], 'm-d H:i') ?> 至 <?php echo pe_date($v['huodong_etime'], 'm-d H:i') ?></td>
			<td><?php echo pe_hd_stateshow($v['huodong_stime'], $v['huodong_etime']) ?></td>
			<td>
				<a href="webadmin.php?mod=zhekou&act=edit&id=<?php echo $v['huodong_id'] ?>" class="admin_edit mar5">修改</a>
				<a href="webadmin.php?mod=zhekou&act=del&id=<?php echo $v['huodong_id'] ?>&token=<?php echo $pe_token ?>" class="admin_del" onclick="return pe_cfone(this, '删除')">删除</a>
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