<?php
/*
Template Name:秒拍模板<br /><a href="../?setting" target="_blank">设置</a>&nbsp;<a href="http://club.tongleer.com" target="_blank">论坛</a>&nbsp;<a href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=diamond0422@qq.com" target="_blank">反馈</a>&nbsp;
Description:一个仿秒拍的模板<a href="https://www.tongleer.com/api/web/pay.png" target="_blank"><font color="red" title="插件因兴趣于闲暇时间所写，故会有代码不规范、不专业和bug的情况，但完美主义促使代码还说得过去，如有bug或使用问题进行反馈即可。">打赏</font></a>
Version:1.0.4<span id="miaopaiUpdateInfo"></span><script>miaopaiXmlHttp=new XMLHttpRequest();miaopaiXmlHttp.open("GET","https://www.tongleer.com/api/interface/miaopai.php?action=update&version=4",true);miaopaiXmlHttp.send(null);miaopaiXmlHttp.onreadystatechange=function () {if (miaopaiXmlHttp.readyState ==4 && miaopaiXmlHttp.status ==200){document.getElementById("miaopaiUpdateInfo").innerHTML=miaopaiXmlHttp.responseText;}}</script>
Author:二呆
Author Url:http://www.tongleer.com
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
require_once(dirname(__FILE__).'/config.php');
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
	<meta name="renderer" content="webkit" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<title><?php echo $site_title; ?> <?php echo page_repeat($page); ?></title>
	<meta name="keywords" content="<?php echo $site_key; ?>" />
	<meta name="description" content="<?php echo $site_description; ?>" />
	<link rel="alternate icon" href="<?=$config_favicon!=""?$config_favicon:TEMPLATE_URL."assets/images/favicon-48.png";?>" type="image/png" />
	<link rel="stylesheet" href="<?php echo TEMPLATE_URL;?>assets/css/MPlayer-1.1.2.css">
	<link href="<?php echo TEMPLATE_URL;?>assets/css/style-1.0.0.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
	<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
	<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
	<script src="<?php echo TEMPLATE_URL;?>assets/js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>assets/js/md5.js"></script>
	<script src='<?php echo TEMPLATE_URL;?>assets/js/MiaopaiPlayer-1.1.7.min.js'></script>
	<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
	<!--[if lt IE 9]>
	<script src="<?php echo TEMPLATE_URL;?>assets/js/html5.js"></script>
	<![endif]-->
	<?php doAction('index_head'); ?>
</head>
<body class="grayBg">
<!-- header -->
<?php blog_navi($blogname);?>