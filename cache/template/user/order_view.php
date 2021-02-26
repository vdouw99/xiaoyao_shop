
<?php include(pe_tpl('header.html'));?>
<div class="huiyuan_content">
	<?php include(pe_tpl('user_menu.html'));?>
	<div class="fr huiyuan_main">
	<div class="order_view_tt mat10">订单状态</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_view mat10">
	<tr>
		<td align="right" class="c888" width="80">订单编号：</td>
		<td><?php echo $info['order_id'] ?></td>
	</tr>
	<tr>
		<td align="right" class="c888">当前状态：</td>
		<td>
			<span class="mar20"><?php echo order_stateshow($info['order_state']) ?></span>
			<?php if($info['order_state']=='wpay'):?>
			<a class="tag_org mal10" href="index.php?mod=order&act=pay&id=<?php echo $info['order_id'] ?>" target="_blank">立即付款</a>
			<a class="tag_gray mal10" href="user.php?mod=order&act=close&id=<?php echo $info['order_id'] ?>" onclick="return pe_dialog(this, '取消订单', 550, 400)">取消订单</a>
			<?php elseif($info['order_state'] == 'wget' && $info['order_payment'] != 'cod'):?>
			<a class="tag_green mal10" href="javascript:pe_confirm('已收到商品', 'user.php?mod=order&act=success&id=<?php echo $info['order_id'] ?>&token=<?php echo $pe_token ?>');">确认收货</a>
			<?php elseif($info['order_state'] == 'success' && !$info['order_comment']):?>
			<a class="tag_gray mal10" href="user.php?mod=order&act=comment&id=<?php echo $info['order_id'] ?>" onclick="return pe_dialog(this, '发表评价', 800, 500)">发表评价</a>
			<?php endif;?>
		</td>
	</tr>
	<?php if($info['order_state']=='close'):?>
	<tr>
		<td align="right" class="c888">关闭说明：</td>
		<td><?php echo $info['order_closetext'] ?></td>
	</tr>	
	<?php endif;?>
	</table>
	<?php if(count($prokey_list)):?>
	<div class="shixian mat20"></div>
	<div class="order_view_tt mat20">卡密信息</div>
	<table border="0" cellspacing="0" cellpadding="0" class="list mat10" style="width:800px">
	<tr>
		<th class="bgtt" width=""><strong>序号</strong></th>
		<th class="bgtt" width="200"><strong>卡号</strong></th>
		<th class="bgtt" width="200"><strong>密码</strong></th>
		<th class="bgtt" width="200"><strong>有效期至</strong></th>
	</tr>
	<?php foreach($prokey_list as $k=>$v):?>
	<tr>
		<td><?php echo $k+1 ?></td>
		<td><?php echo $v['prokey_user'] ?></td>
		<td><?php echo $v['prokey_pw'] ?></td>
		<td><?php echo $v['prokey_edate'] ?></td>
	</tr>
	<?php endforeach;?>
	</table>
	<?php endif;?>
	<?php if(!$info['order_virtual']):?>
	<div class="shixian mat20"></div>
	<div class="order_view_tt mat20">收货信息</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_view mat10">
	<tr>
		<td align="right" class="c888" width="80">姓　　名：</td>
		<td><?php echo $info['user_tname'] ?></td>
	</tr>
	<tr>
		<td align="right" class="c888">手机号码：</td>
		<td><?php echo $info['user_phone'] ?></td>
	</tr>
	<tr>
		<td align="right" class="c888">收货地址：</td>
		<td><?php echo $info['user_address'] ?></td>			
	</tr>
	<tr>
		<td align="right" class="c888">买家留言：</td>
		<td><?php echo $info['order_text'] ?></td>
	</tr>	
	<tr>
		<td align="right" class="c888">快递信息：</td>
		<td><?php if($info['order_wl_name']):?><a href="<?php echo pe_url('order-kuaidi', 'id='.$info['order_wl_id']) ?>" target="_blank" class="tag_kd"><?php echo $info['order_wl_name'] ?>：<?php echo $info['order_wl_id'] ?></a><?php else:?>--<?php endif;?></td>
	</tr>	
	</table>
	<?php endif;?>
	<div class="shixian mat20"></div>
	<div class="order_view_tt mat20">订单信息</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_view mat10">
	<tr>
		<td align="right" class="c888" width="80">下单时间：</td>
		<td><?php echo pe_date($info['order_atime']) ?></td>
	</tr>
	<tr>
		<td align="right" class="c888">付款时间：</td>
		<td><?php if($info['order_ptime']):?><?php echo pe_date($info['order_ptime']) ?><?php else:?>--<?php endif;?></td>
	</tr>
	<tr>
		<td align="right" class="c888">发货时间：</td>
		<td><?php if($info['order_stime']):?><?php echo pe_date($info['order_stime']) ?><?php else:?>--<?php endif;?></td>
	</tr>	
	<tr>
		<td align="right" class="c888" width="80">付款方式：</td>
		<td><?php echo $info['order_payment_name'] ?></td>
	</tr>
	</table>
	<div class="shixian mat20"></div>
	<div class="order_view_tt mat20">商品清单</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_view_list mat20">
	<tr>
		<td class="bgtt1" colspan="3">商品信息</td>

		<td class="bgtt1" width="100">单价</td>
		<td class="bgtt1" width="100">数量</td>
		<td class="bgtt1" width="150">商品优惠</td>
		<td class="bgtt1" width="100">小计</td>			
	</tr>
	<?php foreach($product_list as $k=>$v):?>
	<tr>
		<td style="border-right:0;width:60px"><a href="<?php echo pe_url('product-'.$v['product_id']) ?>" class="dingdan_img"><img src="<?php echo pe_thumb($v['product_logo'], 100, 100) ?>"></a></td>
		<td style="border-left:0;border-right:0;text-align:left;">
			<?php if($info['order_type']=='pintuan'):?><span class="tag_pintuan">拼团</span><?php endif;?>
			<a href="<?php echo pe_url('product-'.$v['product_id']) ?>" target="_blank" class="dd_name"><?php echo $v['product_name'] ?></a>
			<p class="c888 mat5"><?php echo order_skushow($v['product_rule']) ?></p>
		</td>
		<td style="border-left:0;width:80px">
			<?php if($v['refund_id']):?>
			<a href="user.php?mod=refund&act=view&id=<?php echo $v['refund_id'] ?>" target="_blank"><?php echo refund_stateshow($v['refund_state']) ?></a>
			<?php elseif(in_array($info['order_state'], array('wsend', 'wget'))):?>
			<a href="user.php?mod=refund&act=add&id=<?php echo $v['orderdata_id'] ?>" onclick="return pe_dialog(this, '申请退款/退货', 600, 400)">退款/退货</a>			
			<?php endif;?>
		</td>
		<td><span class="font13">¥<?php echo $v['product_money'] ?></span></td>
		<td><span class="font13"><?php echo $v['product_num'] ?></span></td>
		<td><?php echo order_jjmoney_show($v['product_jjmoney']) ?></td>
		<td><span class="font13">¥<?php echo $v['product_allmoney'] ?></span></td>
	</tr>
	<?php endforeach;?>
	</table>
	<div class="dingdan_jiesuan">
		<?php if($info['order_point_get']):?>
		<div class="dingdan_jiesuan_l">获得积分：<span class="cgreen"><?php echo $info['order_point_get'] ?></span> 积分</div>
		<?php endif;?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>商品金额：</td>
			<td width="100">¥ <?php echo $info['order_product_money'] ?></td>
		</tr>
		<tr>
			<td>运　　费：</td>
			<td>¥ <?php echo $info['order_wl_money'] ?></td>
		</tr>
		<?php if($info['order_quan_money']>0):?>
		<tr>
			<td>店铺优惠：</td>
			<td><a href="javascript:;" title="<?php echo $info['order_quan_name'] ?>">- ¥ <?php echo $info['order_quan_money'] ?></a></td>
		</tr>
		<?php endif;?>
		<?php if($info['order_point_money']>0):?>
		<tr>
			<td>积分抵扣：</td>
			<td><a href="javascript:;" title="使用<?php echo $info['order_point_use'] ?>积分">- ¥ <?php echo $info['order_point_money'] ?></a></td>
		</tr>
		<?php endif;?>
		<tr>
			<td>实付金额：</td>
			<td class="font16 cred strong">¥ <?php echo $info['order_money'] ?></td>
		</tr>
		</table>
		<div class="clear"></div>
	</div>
	</div>
</div>
<style type="text/css">
.list td, .list th{border:1px solid #e5e5e5; padding:10px 5px}
</style>
<?php include(pe_tpl('footer.html'));?>