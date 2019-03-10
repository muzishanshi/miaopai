<?php 
require_once '../../../../init.php';
if(!defined('EMLOG_ROOT')) {exit('error!');}
$action = isset($_POST['action']) ? addslashes($_POST['action']) : '';
if($action=='update'){
	$version = isset($_POST['version']) ? addslashes(trim($_POST['version'])) : '';
	$version=file_get_contents('https://www.tongleer.com/api/interface/miaopai.php?action=update&version='.$version);
	echo $version;
	exit;
}
?>