<style>
.pjax_loading {position: fixed;top: 45%;left: 45%;display: none;z-index: 999999;width: 124px;height: 124px;background: url('<?php echo TEMPLATE_URL;?>assets/images/pjax_loading.gif') 50% 50% no-repeat;}
.pjax_loading1 {position: fixed;top: 0;left: 0;z-index: 999999;display: none;width: 100%;height: 100%;opacity: .2}
</style>
<script src="https://cdn.bootcss.com/jquery.pjax/1.9.5/jquery.pjax.min.js"></script>
<script type="text/javascript" language="javascript">
$(function() {
	$(document).pjax('a[target!=_blank]', '.contentLeft', {fragment:'.contentLeft', timeout:6000});
	$(document).on('submit', 'form[target!=_blank]', function (event) {
		$.pjax.submit(event, '.contentLeft', {fragment:'.contentLeft', timeout:6000});
	});
	$(document).on('pjax:send', function() {
		$(".pjax_loading,.pjax_loading1").css("display", "block");
	});
	$(document).on('pjax:complete', function() {
		$(".pjax_loading,.pjax_loading1").css("display", "none");
		ajaxComment();
		//视频
		ajaxVideo();
		<?php if(ROLE==ROLE_VISITOR){?>
		$(".personal").html("刷新后登录");
		<?php }?>
	});
});
</script>
<div class="pjax_loading"></div>
<div class="pjax_loading1"></div>