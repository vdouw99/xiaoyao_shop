<?php include(pe_tpl('header.html','admin'));?>
<div class="right">
	<div class="now">
		<a href="webadmin.php?mod=order" <?php if(!$_g_state):?>class="sel"<?php endif;?>>全部订单（<?php echo $tongji['all'] ?>）<i></i></a>
		<?php foreach($ini['order_state'] as $k=>$v):?>
		<a href="webadmin.php?mod=order&state=<?php echo $k ?>" <?php if($_g_state==$k):?>class="sel"<?php endif;?>><?php echo $v ?>（<?php echo $tongji[$k] ?>）<i></i></a>
		<?php endforeach;?>
		<div class="clear"></div>
	</div>
	<div class="right_main">
		<div class="search">
			<form method="get">
				<input type="hidden" name="mod" value="<?php echo $_g_mod ?>" />
				<input type="hidden" name="state" value="<?php echo $_g_state ?>" />
				订单编号：<input type="text" name="id" value="<?php echo $_g_id ?>" class="inputtext input150 mar5" />
				姓名：<input type="text" name="user_tname" value="<?php echo $_g_user_tname ?>" class="inputtext input80 mar5" />
				电话：<input type="text" name="user_phone" value="<?php echo $_g_user_phone ?>" class="inputtext input80 mar5" />
				<!--帐号：<input type="text" name="user_name" value="<?php echo $_g_user_name ?>" class="inputtext input80 mar5" />-->
				下单时间：<input type="text" name="date1" value="<?php echo $_g_date1 ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="Wdate inputtext" style="width:90px;height:20px;" />	
				至 <input type="text" name="date2" value="<?php echo $_g_date2 ?>" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="Wdate inputtext" style="width:90px;height:20px;" />			
				<input type="submit" value="搜索" class="input_btn" />
				<input type="button" value="导出" class="input_btn" id="excel_btn" />
			</form>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
		<tr>
			<th class="bgtt" style="border-bottom:0;">商品信息</th>
			<th class="bgtt" style="border-bottom:0;" width="111">实付款</th>
			<th class="bgtt" style="border-bottom:0;" width="211">收货信息</th>
			<th class="bgtt" style="border-bottom:0;" width="91">支付/发货</th>
			<th class="bgtt" style="border-bottom:0;" width="91">状态</th>
			<th class="bgtt" style="border-bottom:0;" width="91">操作</th>
		</tr>
		</table>
		<?php foreach($info_list as $k=>$v):?>
		<?php $sel = in_array($v['order_state'], array('success', 'close')) ? 'hy_ordertw' : 'hy_ordertt'?>
		<div class="hy_ordertw c666 mat10">
			订单编号：<span class="num" style="margin-right:60px"><?php echo $v['order_id'] ?></span>
			下单时间：<span class="num"><?php echo pe_date($v['order_atime']) ?></span>
			<?php if($v['pintuan_id']):?>
			<span class="fr mar10">拼团编号：<a href="<?php echo $pe['host_root'] ?>index.php?mod=order&act=pintuan&id=<?php echo $v['pintuan_id'] ?>" class="num" target="_blank"><?php echo $v['pintuan_id'] ?></a></span>
			<?php endif;?>
			<div class="clear"></div>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="hy_orderlist">
		<tr>
			<td class="aleft" style="border-left:0;padding:8px 10px;">
				<?php foreach($v['product_list'] as $kk=>$vv):?>
				<div class="dingdan_list" <?php if($kk==0):?>style="padding-top:0"<?php endif;?>>
				<table width="100%" class="dd_tb1">
				<tr>
					<td width="50"><a href="<?php echo pe_url('product-'.$vv['product_id']) ?>" target="_blank"><img src="<?php echo pe_thumb($vv['product_logo'], 100, 100) ?>" width="40" height="40" class="imgbg" /></a></td>
					<td>
						<?php if($v['order_type']=='pintuan'):?><span class="tag_red" style="height:16px;line-height:16px;padding:0 5px;">拼团</span><?php endif;?>
						<a href="<?php echo pe_url('product-'.$vv['product_id']) ?>" title="<?php echo $vv['product_name'] ?>" target="_blank" class="cblue dd_name"><?php echo $vv['product_name'] ?></a>
						<p class="c999"><?php echo order_skushow($vv['product_rule']) ?></p>
					</td>
					<td width="70" class="aright">
						<span class="num"><?php echo $vv['product_money'] ?></span>(×<?php echo $vv['product_num'] ?>)
					</td>
					<td width="70" class="aright">
						<?php if($vv['refund_state']):?>
						<a href="webadmin.php?mod=refund&act=view&id=<?php echo $vv['refund_id'] ?>" target="_blank"><?php echo refund_stateshow($vv['refund_state']) ?></a>
						<?php endif;?>
					</td>
				</tr>
				</table>
				</div>
				<?php endforeach;?>
			</td>
			<td width="110">
				<p class="corg num strong"><?php echo $v['order_money'] ?></p>
				<p class="c999">（含运费：<?php echo $v['order_wl_money'] ?>）</p>
				<p class="c999"><?php echo $v['order_payment_name'] ?></p>
			</td>
			<td width="210" class="aleft" valign="top" style="color:#555;padding-left:10px">
				<p>姓名：<?php echo $v['user_tname'] ?><?php if($v['user_phone']):?><span class="c888 mal5">（<?php echo $v['user_phone'] ?>）</span><?php endif;?></p>
				<p>地址：<?php echo pe_cut($v['user_address'], 13, '..') ?></p>
				<p>留言：<span class="c888"><?php echo $v['order_text'] ?></span></p>
			</td>
			<td width="90">
				<img src="<?php echo $pe['host_admintpl'] ?>images/fu_<?php echo $v['order_pstate'] ?>.png" title="<?php echo pe_date($v['order_ptime']) ?>" />
				<img src="<?php echo $pe['host_admintpl'] ?>images/fa_<?php echo $v['order_sstate'] ?>.png" title="<?php echo pe_date($v['order_stime']) ?>" />
				<p><a href="webadmin.php?mod=order&act=print_product&id=<?php echo $v['order_id'] ?>" class="c999" onclick="return pe_dialog(this, '打印发货单', 1000, 580)">[发货单]</a></p>
				<p><a href="webadmin.php?mod=order&act=print_express&id=<?php echo $v['order_id'] ?>" class="c999" onclick="return pe_dialog(this, '打印快递单', 1000, 580)">[快递单]</a></p>
			</td>
			<td width="90"><?php echo order_stateshow($v['order_state']) ?><p class="mat5"><a href="webadmin.php?mod=order&act=edit&id=<?php echo $v['order_id'] ?>" target="_blank" class="c999">订单详情</a></p></td>
			<td width="90" style="border-right:0;">
				<?php if($v['order_state'] == 'wpay'):?>
				<a class="tag_org" href="webadmin.php?mod=order&act=pay&id=<?php echo $v['order_id'] ?>" onclick="return pe_dialog(this, '订单付款', 600, 450, 'order_pay')">立即付款</a>
				<p class="mat5"><a href="webadmin.php?mod=order&act=close&id=<?php echo $v['order_id'] ?>" onclick="return pe_dialog(this, '取消订单', 600, 450, 'order_close')" class="c999">取消订单</a></p>
				<?php elseif($v['order_state'] == 'wsend'):?>
				<a class="tag_blue" href="webadmin.php?mod=order&act=send&id=<?php echo $v['order_id'] ?>" onclick="return pe_dialog(this, '填写发货信息', 600, 450, 'order_send')">发 货</a>
				<p class="mat5"><a href="webadmin.php?mod=order&act=close&id=<?php echo $v['order_id'] ?>" onclick="return pe_dialog(this, '取消订单', 600, 450, 'order_close')" class="c999">取消订单</a></p>
				<?php elseif($v['order_state'] == 'wget'):?>
				<a class="tag_green" href="webadmin.php?mod=order&act=success&id=<?php echo $v['order_id'] ?>&token=<?php echo $pe_token ?>" onclick="return pe_cfone(this, '买家已收到商品')">确认收货</a>
				<p class="mat5"><a href="webadmin.php?mod=order&act=close&id=<?php echo $v['order_id'] ?>" onclick="return pe_dialog(this, '取消订单', 600, 450, 'order_close')" class="c999">取消订单</a></p>
				<?php elseif($v['order_state'] == 'close'):?>
				<a href="webadmin.php?mod=order&act=del&id=<?php echo $v['order_id'] ?>&token=<?php echo $pe_token ?>" onclick="return pe_cfone(this, '删除订单')" class="c999">删除</a>
				<?php else:?>
				-
				<?php endif;?>
			</td>
		</tr>
		</table>
		<?php endforeach;?>
	</div>
	<div class="right_bottom">
		<span class="fr fenye"><?php echo $db->page->html ?></span>
		<div class="clear"></div>
	</div>
</div>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>public/plugin/my97/WdatePicker.js"></script>
<script type="text/javascript">
$(function(){
	$("#excel_btn").click(function(){
		pe_open("webadmin.php?<?php echo $_SERVER['QUERY_STRING'] ?>&act=excel_out");
	})
})
</script>
<?php include(pe_tpl('footer.html','admin'));?>