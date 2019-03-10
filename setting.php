<?php 
/*
 * @MiaopaiForEmlog
 * @authors 二呆 (www.tongleer.com)
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
require_once(dirname(__FILE__).'/config.php');
if (ROLE == ROLE_ADMIN){
	$action = isset($_POST['action']) ? addslashes($_POST['action']) : '';
	if($action=='setting'){
		$config_admin_dir = @isset($_POST['config_admin_dir']) ? addslashes(str_replace("'","\'",trim($_POST['config_admin_dir']))) : 'admin';
		$config_is_pjax = @isset($_POST['config_is_pjax']) ? addslashes(trim(str_replace("'","\'",$_POST['config_is_pjax']))) : 'n';
		
		$config_is_mailreg = @isset($_POST['config_is_mailreg']) ? addslashes(trim(str_replace("'","\'",$_POST['config_is_mailreg']))) : 'n';
		$config_mailsmtp = @isset($_POST['config_mailsmtp']) ? addslashes(trim(str_replace("'","\'",$_POST['config_mailsmtp']))) : 'ssl://smtp.exmail.qq.com';
		$config_mailport = @isset($_POST['config_mailport']) ? addslashes(trim(str_replace("'","\'",$_POST['config_mailport']))) : '465';
		$config_mailuser = @isset($_POST['config_mailuser']) ? addslashes(trim(str_replace("'","\'",$_POST['config_mailuser']))) : '';
		$config_mailpass = @isset($_POST['config_mailpass']) ? addslashes(trim(str_replace("'","\'",$_POST['config_mailpass']))) : '';
		
		$config_is_weibologin = @isset($_POST['config_is_weibologin']) ? addslashes(trim(str_replace("'","\'",$_POST['config_is_weibologin']))) : 'n';
		$config_wb_akey = @isset($_POST['config_wb_akey']) ? addslashes(trim(str_replace("'","\'",$_POST['config_wb_akey']))) : '';
		$config_wb_skey = @isset($_POST['config_wb_skey']) ? addslashes(trim(str_replace("'","\'",$_POST['config_wb_skey']))) : '';
		$config_wb_callback_url = @isset($_POST['config_wb_callback_url']) ? addslashes(trim(str_replace("'","\'",$_POST['config_wb_callback_url']))) : '';
		
		$config_is_qqlogin = @isset($_POST['config_is_qqlogin']) ? addslashes(trim(str_replace("'","\'",$_POST['config_is_qqlogin']))) : 'n';
		$config_qq_appid = @isset($_POST['config_qq_appid']) ? addslashes(trim(str_replace("'","\'",$_POST['config_qq_appid']))) : '';
		$config_qq_appkey = @isset($_POST['config_qq_appkey']) ? addslashes(trim(str_replace("'","\'",$_POST['config_qq_appkey']))) : '';
		$config_qq_callback = @isset($_POST['config_qq_callback']) ? addslashes(trim(str_replace("'","\'",$_POST['config_qq_callback']))) : '';
		
		$config_favicon = @isset($_POST['config_favicon']) ? addslashes(str_replace("'","\'",trim($_POST['config_favicon']))) : '';
		$config_logo = @isset($_POST['config_logo']) ? addslashes(str_replace("'","\'",trim($_POST['config_logo']))) : '';
		$config_headImgUrl = @isset($_POST['config_headImgUrl']) ? addslashes(str_replace("'","\'",trim($_POST['config_headImgUrl']))) : '';
		$config_nickname = @isset($_POST['config_nickname']) ? addslashes(str_replace("'","\'",trim($_POST['config_nickname']))) : '';
		$config_address = @isset($_POST['config_address']) ? addslashes(str_replace("'","\'",trim($_POST['config_address']))) : '';
		$config_detail = @isset($_POST['config_detail']) ? addslashes(str_replace("'","\'",trim($_POST['config_detail']))) : '';
		$config_wxpay_qrcode = @isset($_POST['config_wxpay_qrcode']) ? addslashes(str_replace("'","\'",trim($_POST['config_wxpay_qrcode']))) : '';
		$config_qqpay_qrcode = @isset($_POST['config_qqpay_qrcode']) ? addslashes(str_replace("'","\'",trim($_POST['config_qqpay_qrcode']))) : '';
		$config_alipay_qrcode = @isset($_POST['config_alipay_qrcode']) ? addslashes(str_replace("'","\'",trim($_POST['config_alipay_qrcode']))) : '';
		$config_follow = @isset($_POST['config_follow']) ? addslashes(str_replace("'","\'",trim($_POST['config_follow']))) : '';
		$config_fans = @isset($_POST['config_fans']) ? addslashes(str_replace("'","\'",trim($_POST['config_fans']))) : '';
		$config_github = @isset($_POST['config_github']) ? addslashes(str_replace("'","\'",trim($_POST['config_github']))) : '';
		$config_github_url = @isset($_POST['config_github_url']) ? addslashes(str_replace("'","\'",trim($_POST['config_github_url']))) : '';
		$config_qq = @isset($_POST['config_qq']) ? addslashes(str_replace("'","\'",trim($_POST['config_qq']))) : '';
		$config_qq_qrcode = @isset($_POST['config_qq_qrcode']) ? addslashes(str_replace("'","\'",trim($_POST['config_qq_qrcode']))) : '';
		$config_weixin = @isset($_POST['config_weixin']) ? addslashes(str_replace("'","\'",trim($_POST['config_weixin']))) : '';
		$config_weixin_qrcode = @isset($_POST['config_weixin_qrcode']) ? addslashes(str_replace("'","\'",trim($_POST['config_weixin_qrcode']))) : '';
		$config_custom = @isset($_POST['config_custom']) ? addslashes(str_replace("'","\'",trim($_POST['config_custom']))) : '';
		
		$data = "<?php
				 \$config_admin_dir = '".$config_admin_dir."';
				 \$config_is_pjax = '".$config_is_pjax."';
				 \$config_is_mailreg = '".$config_is_mailreg."';
				 \$config_is_weibologin = '".$config_is_weibologin."';
				 \$config_wb_akey = '".$config_wb_akey."';
				 \$config_wb_skey = '".$config_wb_skey."';
				 \$config_wb_callback_url = '".$config_wb_callback_url."';
				 \$config_is_qqlogin = '".$config_is_qqlogin."';
				 \$config_qq_appid = '".$config_qq_appid."';
				 \$config_qq_appkey = '".$config_qq_appkey."';
				 \$config_qq_callback = '".$config_qq_callback."';
				 \$config_mailsmtp = '".$config_mailsmtp."';
				 \$config_mailport = '".$config_mailport."';
				 \$config_mailuser = '".$config_mailuser."';
				 \$config_mailpass = '".$config_mailpass."';
				 \$config_favicon = '".$config_favicon."';
				 \$config_logo = '".$config_logo."';
		         \$config_headImgUrl = '".$config_headImgUrl."';
		         \$config_nickname = '".$config_nickname."';
			     \$config_address = '".$config_address."';
				 \$config_detail = '".$config_detail."';
				 \$config_wxpay_qrcode = '".$config_wxpay_qrcode."';
				 \$config_qqpay_qrcode = '".$config_qqpay_qrcode."';
				 \$config_alipay_qrcode = '".$config_alipay_qrcode."';
				 \$config_follow = '".$config_follow."';
				 \$config_fans = '".$config_fans."';
				 \$config_github = '".$config_github."';
				 \$config_github_url = '".$config_github_url."';
				 \$config_qq = '".$config_qq."';
				 \$config_qq_qrcode = '".$config_qq_qrcode."';
				 \$config_weixin = '".$config_weixin."';
				 \$config_weixin_qrcode = '".$config_weixin_qrcode."';
				 \$config_custom = '".$config_custom."';
	    ?>";
		$file = dirname(__FILE__).'/config.php';
		@$fp = fopen($file, 'wb') OR emMsg('读取文件失败，如果您使用的是Unix/Linux主机，请修改主题文件config.php的权限为777。如果您使用的是Windows主机，请联系管理员，将该文件设为everyone可写');
		@$fw =	fwrite($fp,$data) OR emMsg('写入文件失败，如果您使用的是Unix/Linux主机，请修改主题文件config.php的权限为777。如果您使用的是Windows主机，请联系管理员，将该文件设为everyone可写');
		fclose($fp);
		emMsg("修改配置成功！",BLOG_URL.'?setting');
	}
	?>
<style>
.page-main{
	background-color:#fff;
	width:960px;
	margin:0px auto 0px auto;
}
@media screen and (max-width: 960px) {
	.page-main {width: 100%;}
}
</style>
<script>
$(".header").css("display","none");
$("title").html("<?=Option::get('blogname');?>主题设置");
$.post("<?=TEMPLATE_URL;?>ajax/update.php",{action:"update",version:"<?=INKER_VERSION;?>"},function(data){
	var data=JSON.parse(data);
	$("#versionCode").html(data.message);
});
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/amazeui/2.7.2/css/amazeui.min.css"/>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->
<!-- content section -->
<section class="page-main">
	<!-- content start -->
	<div class="admin-content">
		<form class="am-form" method="post" action="">
		  <div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">主题设置</strong> / <small><a href="<?=BLOG_URL.$config_admin_dir?>" target="_blank">返回后台</a>&nbsp;<a href="<?=BLOG_URL?>" target="_blank">显示前台</a></small></div>
		  </div>

		  <div class="am-tabs am-margin" data-am-tabs>
			<ul class="am-tabs-nav am-nav am-nav-tabs">
			  <li class="am-active"><a href="#tab-basic">基础设置</a></li>
			  <li><a href="#tab-login">登陆设置</a></li>
			  <li><a href="#tab-video">视频模块</a></li>
			  <li><a href="#tab-about">关于主题</a></li>
			</ul>

			<div class="am-tabs-bd">
			  <div class="am-tab-panel am-fade am-in am-active" id="tab-basic">
				
				<div class="am-form-group">
				  <label for="config_admin_dir">版本检测</label>
				  <p class="am-form-help" id="versionCode"></p>
				</div>
				<div class="am-form-group">
				  <label for="config_admin_dir">后台管理员文件夹名称</label>
				  <input type="text" class="" name="config_admin_dir" id="config_admin_dir" value="<?=$config_admin_dir;?>" placeholder="">
				  <p class="am-form-help">在这里填入后台管理员文件夹名称，如admin</p>
				</div>
				<div class="am-form-group">
				  <label for="config_is_pjax">是否开启PJAX</label>
				  <div class="am-form-group">
					  <label class="am-radio-inline">
						<input type="radio"  value="y" name="config_is_pjax" <?php if($config_is_pjax=='y'){?>checked<?php }?>> 开启
					  </label>
					  <label class="am-radio-inline">
						<input type="radio" value="n" name="config_is_pjax" <?php if($config_is_pjax=='n'){?>checked<?php }?>> 关闭
					  </label>
				  </div>
				  <p class="am-form-help">开启PJAX后点击网页链接会无刷新跳转，适合结合播放器使用。</p>
				</div>
				
				<div class="am-form-group">
				  <label for="config_favicon">自定义favicon图标</label>
				  <input type="text" class="" name="config_favicon" value="<?=$config_favicon;?>" id="config_favicon" placeholder="">
				  <p class="am-form-help">在这里填入自定义favicon图标url</p>
				</div>
				<div class="am-form-group">
				  <label for="config_logo">自定义Logo图标</label>
				  <input type="text" class="" name="config_logo" value="<?=$config_logo;?>" id="config_logo" placeholder="">
				  <p class="am-form-help">在这里填入自定义Logo图标url</p>
				</div>
				<div class="am-form-group">
				  <label for="config_headImgUrl">头像地址</label>
				  <input type="text" class="" name="config_headImgUrl" value="<?=$config_headImgUrl;?>" id="config_headImgUrl" placeholder="">
				  <p class="am-form-help">在这里填入头像的URL地址</p>
				</div>
				<div class="am-form-group">
				  <label for="config_nickname">昵称</label>
				  <input type="text" class="" name="config_nickname" value="<?=$config_nickname;?>" id="config_nickname" placeholder="">
				  <p class="am-form-help">在这里填入昵称</p>
				</div>
				<div class="am-form-group">
				  <label for="config_address">地区</label>
				  <input type="text" class="" name="config_address" value="<?=$config_address;?>" id="config_address" placeholder="">
				  <p class="am-form-help">在这里填入地区</p>
				</div>
				<div class="am-form-group">
				  <label for="config_detail">简介</label>
				  <input type="text" class="" name="config_detail" value="<?=$config_detail;?>" id="config_detail" placeholder="">
				  <p class="am-form-help">在这里填入简介</p>
				</div>
				<div class="am-form-group">
				  <label for="config_wxpay_qrcode">打赏微信二维码URL</label>
				  <input type="text" class="" name="config_wxpay_qrcode" value="<?=$config_wxpay_qrcode;?>" id="config_wxpay_qrcode" placeholder="">
				  <p class="am-form-help">在这里填入打赏微信二维码URL</p>
				</div>
				<div class="am-form-group">
				  <label for="config_qqpay_qrcode">打赏QQ二维码URL</label>
				  <input type="text" class="" name="config_qqpay_qrcode" value="<?=$config_qqpay_qrcode;?>" id="config_qqpay_qrcode" placeholder="">
				  <p class="am-form-help">在这里填入打赏支付宝二维码URL</p>
				</div>
				<div class="am-form-group">
				  <label for="config_alipay_qrcode">打赏支付宝二维码URL</label>
				  <input type="text" class="" name="config_alipay_qrcode" value="<?=$config_alipay_qrcode;?>" id="config_alipay_qrcode" placeholder="">
				  <p class="am-form-help">在这里填入打赏支付宝二维码URL</p>
				</div>
				<div class="am-form-group">
				  <label for="config_follow">更多关注链接</label>
				  <input type="text" class="" name="config_follow" value="<?=$config_follow;?>" id="config_follow" placeholder="">
				  <p class="am-form-help">在这里填入更多关注的链接，推荐新建page_follow模板页面</p>
				</div>
				<div class="am-form-group">
				  <label for="config_fans">更多粉丝链接</label>
				  <input type="text" class="" name="config_fans" value="<?=$config_fans;?>" id="config_fans" placeholder="">
				  <p class="am-form-help">在这里填入更多粉丝的链接，推荐新建page_fans模板页面，备注：除了关注和粉丝页面外，还存在一个时间轴文章归档页面模板page_archives，自行新建即可。</p>
				</div>
				
				<div class="am-form-group">
				  <label for="config_github">底部Github锚文本</label>
				  <input type="text" class="" name="config_github" value="<?=$config_github;?>" id="config_github" placeholder="">
				  <p class="am-form-help">在这里填入底部Github锚文本</p>
				</div>
				<div class="am-form-group">
				  <label for="config_github_url">底部Github锚文本的链接</label>
				  <input type="text" class="" name="config_github_url" value="<?=$config_github_url;?>" id="config_github_url" placeholder="">
				  <p class="am-form-help">在这里填入底部Github锚文本的链接</p>
				</div>
				<div class="am-form-group">
				  <label for="config_qq">底部QQ锚文本</label>
				  <input type="text" class="" name="config_qq" value="<?=$config_qq;?>" id="config_qq" placeholder="">
				  <p class="am-form-help">在这里填入底部QQ锚文本</p>
				</div>
				<div class="am-form-group">
				  <label for="config_qq_qrcode">底部QQ锚文本的二维码地址</label>
				  <input type="text" class="" name="config_qq_qrcode" value="<?=$config_qq_qrcode;?>" id="config_qq_qrcode" placeholder="">
				  <p class="am-form-help">在这里填入底部QQ锚文本的二维码地址</p>
				</div>
				<div class="am-form-group">
				  <label for="config_weixin">底部微信锚文本</label>
				  <input type="text" class="" name="config_weixin" value="<?=$config_weixin;?>" id="config_weixin" placeholder="">
				  <p class="am-form-help">在这里填入底部微信锚文本</p>
				</div>
				<div class="am-form-group">
				  <label for="config_weixin_qrcode">底部微信锚文本的二维码地址</label>
				  <input type="text" class="" name="config_weixin_qrcode" value="<?=$config_weixin_qrcode;?>" id="config_weixin_qrcode" placeholder="">
				  <p class="am-form-help">在这里填入底部微信锚文本的二维码地址</p>
				</div>
				
				<div class="am-form-group">
				  <label for="config_custom">底部自定义内容</label>
				  <textarea class="" rows="5" name="config_custom" id="config_custom" placeholder=""><?=$config_custom;?></textarea>
				  <p class="am-form-help">在这里填入底部自定义内容</p>
				</div>

			  </div>

			  <div class="am-tab-panel am-fade" id="tab-login">
				<div class="am-form-group">
				  <label for="config_is_mailreg">是否开启邮箱注册</label>
				  <div class="am-form-group">
					  <label class="am-radio-inline">
						<input type="radio"  value="y" name="config_is_mailreg" <?php if($config_is_mailreg=='y'){?>checked<?php }?>> 开启
					  </label>
					  <label class="am-radio-inline">
						<input type="radio" value="n" name="config_is_mailreg" <?php if($config_is_mailreg=='n'){?>checked<?php }?>> 关闭
					  </label>
				  </div>
				  <p class="am-form-help">开启邮箱注册后用户可通过邮件验证注册网站用户。</p>
				</div>
				<div class="am-form-group">
				  <label for="config_mailsmtp">smtp服务器(已验证QQ企业邮箱和126邮箱可成功发送)</label>
				  <input type="text" class="" name="config_mailsmtp" value="<?=$config_mailsmtp?$config_mailsmtp:"ssl://smtp.exmail.qq.com";?>" id="config_mailsmtp" placeholder="">
				  <p class="am-form-help">用于邮箱注册发送邮箱验证码及其他邮件服务的smtp服务器地址，QQ企业邮箱：ssl://smtp.exmail.qq.com:465；126邮箱：smtp.126.com:25</p>
				</div>
				<div class="am-form-group">
				  <label for="config_mailport">smtp服务器端口</label>
				  <input type="text" class="" name="config_mailport" value="<?=$config_mailport?$config_mailport:"465";?>" id="config_mailport" placeholder="">
				  <p class="am-form-help">用于邮箱注册发送邮箱验证码及其他邮件服务的smtp服务器端口</p>
				</div>
				<div class="am-form-group">
				  <label for="config_mailuser">smtp服务器邮箱用户名</label>
				  <input type="text" class="" name="config_mailuser" value="<?=$config_mailuser;?>" id="config_mailuser" placeholder="">
				  <p class="am-form-help">用于邮箱注册发送邮箱验证码及其他邮件服务的smtp服务器邮箱用户名</p>
				</div>
				<div class="am-form-group">
				  <label for="config_mailpass">smtp服务器邮箱密码</label>
				  <input type="text" class="" name="config_mailpass" value="<?=$config_mailpass;?>" id="config_mailpass" placeholder="">
				  <p class="am-form-help">用于邮箱注册发送邮箱验证码及其他邮件服务的smtp服务器邮箱密码</p>
				</div>
				
				<div class="am-form-group">
				  <label for="config_is_weibologin">是否开启微博登陆</label>
				  <div class="am-form-group">
					  <label class="am-radio-inline">
						<input type="radio"  value="y" name="config_is_weibologin" <?php if($config_is_weibologin=='y'){?>checked<?php }?>> 开启
					  </label>
					  <label class="am-radio-inline">
						<input type="radio" value="n" name="config_is_weibologin" <?php if($config_is_weibologin=='n'){?>checked<?php }?>> 关闭
					  </label>
				  </div>
				  <p class="am-form-help">开启微博登陆后用户可通过微博账户注册网站用户。</p>
				</div>
				<div class="am-form-group">
				  <label for="config_wb_akey">微博开放平台App Key</label>
				  <input type="text" class="" name="config_wb_akey" value="<?=$config_wb_akey?>" id="config_wb_akey" placeholder="">
				  <p class="am-form-help">填写在微博开放平台申请的App Key</p>
				</div>
				<div class="am-form-group">
				  <label for="config_wb_skey">微博开放平台App Secret</label>
				  <input type="text" class="" name="config_wb_skey" value="<?=$config_wb_skey?>" id="config_wb_skey" placeholder="">
				  <p class="am-form-help">填写在微博开放平台申请的App Secret</p>
				</div>
				<div class="am-form-group">
				  <label for="config_wb_callback_url">微博开放平台授权回调接口地址</label>
				  <input type="text" class="" name="config_wb_callback_url" value="<?=BLOG_URL;?>?oauth&action=weibocallback" id="config_wb_callback_url" placeholder="" readOnly>
				  <p class="am-form-help">填写在微博开放平台配置的授权回调接口地址</p>
				</div>
				
				<div class="am-form-group">
				  <label for="config_is_qqlogin">是否开启QQ登陆</label>
				  <div class="am-form-group">
					  <label class="am-radio-inline">
						<input type="radio"  value="y" name="config_is_qqlogin" <?php if($config_is_qqlogin=='y'){?>checked<?php }?>> 开启
					  </label>
					  <label class="am-radio-inline">
						<input type="radio" value="n" name="config_is_qqlogin" <?php if($config_is_qqlogin=='n'){?>checked<?php }?>> 关闭
					  </label>
				  </div>
				  <p class="am-form-help">开启QQ登陆后用户可通过QQ账户注册网站用户。</p>
				</div>
				<div class="am-form-group">
				  <label for="config_qq_appid">QQ互联appid</label>
				  <input type="text" class="" name="config_qq_appid" value="<?=$config_qq_appid?>" id="config_qq_appid" placeholder="">
				  <p class="am-form-help">填写在QQ互联申请的qq_appid</p>
				</div>
				<div class="am-form-group">
				  <label for="config_qq_appkey">QQ互联qq_appkey</label>
				  <input type="text" class="" name="config_qq_appkey" value="<?=$config_qq_appkey?>" id="config_qq_appkey" placeholder="">
				  <p class="am-form-help">填写在QQ互联申请的qq_appkey</p>
				</div>
				<div class="am-form-group">
				  <label for="config_qq_callback">QQ互联qq_callback</label>
				  <input type="text" class="" name="config_qq_callback" value="<?=BLOG_URL;?>?oauth&action=qqcallback" id="config_qq_callback" placeholder="" readOnly>
				  <p class="am-form-help">填写在QQ互联配置的qq_callback</p>
				</div>
			  </div>
			  
			  <div class="am-tab-panel am-fade" id="tab-video">
				<div class="am-form-group">
<pre>
在编辑文章时，除了以html的方式添加视频外，还可以用一下方式添加：
1、[video]秒拍网页端(http://www.miaopai.com/miaopai/plaza)中的视频ID[/video]
	第一步：视频ID查找方法在秒拍网页端点击每个秒拍号头像；
	第二步：打开单独秒拍号网页后，右键查看网页源代码，搜索https://www.miaopai.com/show/字符串，它和.htm之间的内容就是视频ID了；
	第三步：最后将视频ID添加在[video]视频ID[/video]之中即可。
2、[video]mp4视频地址[/video]
3、[iframe]优酷视频地址[/iframe]
</pre>
				</div>
			  </div>
			  
			  <div class="am-tab-panel am-fade" id="tab-about">
				<div class="am-form-group">
<pre>
本主题请在Emlog官网或我的博客上花费1元获取，请不要在以外的网站下载。
本主题可通过购买<a href="http://m.renrendian.com/buyer/home?vid=14420124" target="_blank">主机微店</a>或<a href="https://weidian.com/?userid=2055073" target="_blank">零食微店</a>的商品，以获得主题的技术支持。
开发者承诺本主题不含任何挂马、广告等恶意代码，使用本主题所造成的任何问题，请及时与开发者联系。
如果您心情好，可以捐赠一下支持我们做出更好的主题：
<img src="https://www.tongleer.com/api/web/pay.png" width="300" alt="" />
开发者：二呆
email：diamond0422@qq.com
博客：http://www.tongleer.com/
微信公众号：Diamond0422
<img src="https://ws3.sinaimg.cn/large/005V7SQ5ly1g0vcv2g89yj305k05k3yu.jpg" width="100" alt="" />
</pre>
				</div>
			  </div>

			</div>
		  </div>

		  <div class="am-margin">
			<input type="hidden" class="" name="action" value="setting" />
			<input type="submit" class="am-btn am-btn-primary am-btn-xs" value="保存配置" />
		  </div>
		</form>
	</div>
	<!-- content end -->
	<footer>
	  <hr>
	  <center>
		CopyRight©<?=date("Y");?> <a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a> Powered by <a href="http://www.emlog.net/" title="Emlog" rel="nofollow">Emlog</a> Theme By <a href="http://www.tongleer.com" title="同乐儿">Tongleer</a>
	  </center>
	</footer>
</section>
<!--[if lt IE 9]>
<script src="https://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/amazeui/2.7.2/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/amazeui/2.7.2/js/amazeui.min.js" type="text/javascript"></script>
</body>
</html>
	<?php
}else{
	header("Location:".BLOG_URL);exit;
}
?>