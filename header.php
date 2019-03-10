<?php
/*
Template Name:秒拍模板<br /><a href="../?setting" target="_blank">模板设置</a>&nbsp;<a href="https://github.com/muzishanshi/miaopai" target="_blank">作者Github</a>&nbsp;<a href="https://www.tongleer.com/api/web/pay.png" target="_blank">打赏</a>&nbsp;
Description:一个仿秒拍的模板
Version:1.0.1
Author:二呆
Author Url:http://www.tongleer.com
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
define('INKER_VERSION', '1');
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