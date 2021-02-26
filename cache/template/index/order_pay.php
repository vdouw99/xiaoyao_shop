<?php include(pe_tpl('header.html'));?>
<div class="content">
	<form method="post" id="form" onkeydown="if(event.keyCode==13)return false;">
	<div class="order_cg">
		<i class="tjcg_dui"></i>
		<?php if($info['order_payment'] == 'cod'):?>
		<div class="tjcg_tt">订单已提交，我们会尽快安排发货！</div>
		<?php else:?>
		<div class="tjcg_tt">订单已提交，请尽快付款！</div>
		<?php endif;?>
		<!--<div class="mat8 c888">（请您在48小时内完成支付，否则订单会被自动取消）</div>-->
		<div class="mat30">订单编号：<span class="c888 mal5"><?php echo $info['order_id'] ?></span></div>
		<div class="mat10">支付方式：<span class="c888 mal5"><?php echo $info['order_payment_name'] ?></span></div>
		<div class="dd_yingfu">应付金额：<span><?php echo $info['order_money'] ?></span> 元</div>
	</div>
	<?php if($info['order_state'] == 'wpay'):?>
	<div class="dd_box" style="padding-bottom:40px;">
		<div class="liucheng">选择支付方式</div>
		<div class="fkfs">
			<ul>
				<?php foreach($payment_list as $k=>$v):?>
				<?php if($v['payment_type'] == 'cod')continue?>
				<li class="js_radio">
					<label for="order_payment_<?php echo $k ?>">
						<input type="radio" name="order_payment" value="<?php echo $k ?>" id="order_payment_<?php echo $k ?>" style="display:none" />
						<img src="<?php echo $pe['host_root'] ?>public/plugin/payment/<?php echo $k ?>/logo.png" class="fl" />
						<?php if($v['payment_type'] == 'balance'):?>
						<span class="fr mat5 mal10">余额：<span class="corg"><?php echo $user['user_money'] ?>元</span></span>
						<?php endif;?>
						<div class="clear"></div><i></i>
					</label>
				</li>
				<?php endforeach;?>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="zf_box" id="paypw_html">
			<div class="zf_text">请输入支付密码：</div>
			<div class="zfmm">
				<input type="password" name="user_paypw" value="" />
				<a href="<?php echo $pe['host_root'] ?>user.php?mod=setting&act=paypw" target="_blank" class="cblue mal10">重置密码</a>
			</div>
		</div>
		<input type="hidden" name="pe_token" value="<?php echo $pe_token ?>" />
		<input type="hidden" name="pesubmit" />
		<input type="button" value="去付款" onclick="pay_btn()" class="ddtj_btn" style="float:none; margin:90px 0 50px 45px;" />
		<?php endif;?>
	</div>
	</form>
</div>
<script type="text/html" id="paypw_form">
<div>
	<input type="text" name="paypw" value="" id="paypw" />
	<a href="javascript:;" onclick="paypw_btn();">确认支付</a>
	<a href="<?php echo $pe['host_root'] ?>user.php?mod=setting&act=paypw" />重置支付密码</a>
</div>
</script>
<script type="text/javascript">
$(function(){
	pe_select_radio('order_payment', "<?php echo $info['order_payment'] ?>", function(){
		if ($(":input[name='order_payment']:checked").val() == 'balance') {
			$("#paypw_html").show();		
		}
		else {
			$("#paypw_html").hide();		
		}
	});
})
//支付提交按钮
function pay_btn() {
	var order_payment = $(":input[name='order_payment']:checked").val();	
	/*if (order_payment == 'balance' && $(":input[name='user_paypw']").val() == '') {
		layer.open({
			type: 1,
			title: '请输入支付密码',
		  	area: ['500px', '300px'],
			fixed: false, //不固定
			shadeClose: true,
			shade: 0.5,
			content: $("#paypw_form").html()
		});
		return false;
	}*/
	if (order_payment == 'bank') {
		layer.open({
			type: 2,
			title: '转账汇款说明',
			area: ['550px', '350px'],
			fixed: false, //不固定
			shadeClose: true,
			shade: 0.5,
			content: "<?php echo $pe['host_root'] ?>public/plugin/payment/bank/pay.php"
		});
		return false;	
	}
	$.ajaxSettings.async = false;
	pe_submit("<?php echo pe_nowurl() ?>", function(json){
		//$(":input[name='user_paypw']").val('');
		if (json.result) {
			if (order_payment == 'balance') {
				pe_open(json.url, 1000);
			}
			else {
				$("#form").attr("action", json.url).submit();
			}		
		}
	})
}
//支付密码确认按钮
function paypw_btn() {
	var user_paypw = $('#paypw').val();
	if (user_paypw == '') {
		pe_tip('请输入支付密码');
		return false;
	}
	$(":input[name='user_paypw']").val(user_paypw)
	//layer.closeAll();
	pay_btn();
}
</script>
<?php include(pe_tpl('footer.html'));?>