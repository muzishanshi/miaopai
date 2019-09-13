<?php 
session_start();
require_once '../../../../init.php';
require_once(dirname(__FILE__).'/../config.php');
if(!defined('EMLOG_ROOT')) {exit('error!');}
date_default_timezone_set("Etc/GMT-8");
$db = Database::getInstance();
$action = isset($_POST['action']) ? addslashes($_POST['action']) : '';
if($action=='emaillogin'){
	$username = isset($_POST['user']) ? addslashes(trim($_POST['user'])) : '';
	$password = isset($_POST['pw']) ? addslashes(trim($_POST['pw'])) : '';
	$ispersis = isset($_POST['ispersis']) ? intval($_POST['ispersis']) : false;
	$img_code = Option::get('login_code') == 'y' && isset($_POST['imgcode']) ? addslashes(trim(strtoupper($_POST['imgcode']))) : '';

	if (LoginAuth::checkUser($username, $password, $img_code)===true) {
		LoginAuth::setAuthCookie($username, $ispersis);
		$json=json_encode(array("code"=>"success","msg"=>"登陆成功"));
	} else{
		setcookie(AUTH_COOKIE_NAME, ' ', time() - 31536000, '/');
		$json=json_encode(array("code"=>"fail","msg"=>"登陆失败，请检查填写是否正确"));
	}
	echo $json;
}else if($action=='sendMailCode'){
	$username = isset($_POST['phone']) ? addslashes(trim($_POST['phone'])) : '';
	$reqid = isset($_POST['reqid']) ? addslashes(trim($_POST['reqid'])) : '';
	$img_code = isset($_POST['cap']) ? addslashes(trim($_POST['cap'])) : '';
	$version = isset($_POST['version']) ? addslashes(trim($_POST['version'])) : '';
	$verifytype = isset($_POST['verifytype']) ? addslashes(trim($_POST['verifytype'])) : '';
	
	if($config_is_mailreg!="y"){
		$json=json_encode(array("code"=>"notallowmailreg","msg"=>"未开启邮箱注册"));
		echo $json;
		exit;
	}
	if(strcasecmp($_SESSION['code'],$img_code)!=0){
		$json=json_encode(array("code"=>"imgcodeerror","msg"=>"图片验证码错误"));
		echo $json;
		exit;
	}
	$userRow = $db->once_fetch_array("SELECT COUNT(*) AS total FROM ".DB_PREFIX."user WHERE username='$username' OR email='$username'");
	if($userRow['total'] > 0){
		$json=json_encode(array("code"=>"userexist","msg"=>"账号已存在"));
		echo $json;
		exit;
	}
	if(!isset($config_mailsmtp)||!isset($config_mailport)||!isset($config_mailuser)||!isset($config_mailpass)){
		$json=json_encode(array("code"=>"mailparamerror","msg"=>"邮箱参数有误"));
		echo $json;
		exit;
	}
	//重置短信验证码
	$randCode = '';
	$chars = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPRSTUVWXYZ23456789';
	for ( $i = 0; $i < 5; $i++ ){
		$randCode .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
	}
	$_SESSION['mailsmscode'] = strtoupper($randCode);
	
	$result=sendMailSms($config_mailsmtp,$config_mailport,$config_mailuser,$config_mailpass,$config_mailsecure,$username,'【'.Option::get('blogname').'】验证码：'.$_SESSION['mailsmscode'],'欢迎使用'.Option::get('blogname').'验证码服务，您的验证码是：'.$_SESSION['mailsmscode']);
	if($result){
		$_SESSION['newmail'] = $username;
		$json=json_encode(array("code"=>"ok","msg"=>"发送邮件验证码成功"));
		echo $json;
	}else{
		$json=json_encode(array("code"=>"mailcodeerror","msg"=>"邮件验证码错误"));
		echo $json;
	}
}else if($action=='emailreg'){
	$username = isset($_POST['phone']) ? addslashes(trim($_POST['phone'])) : '';
	$password = isset($_POST['pwd']) ? addslashes(trim($_POST['pwd'])) : '';
	$smscode = isset($_POST['captcha']) ? addslashes(trim($_POST['captcha'])) : '';
	
	if($config_is_mailreg!="y"){
		$json=json_encode(array("code"=>"notallowmailreg","msg"=>"未开启邮箱注册"));
		echo $json;
		exit;
	}
	if(strcasecmp($_SESSION['mailsmscode'],$smscode)!=0){
		$json=json_encode(array("code"=>"mailcodeerror","msg"=>"邮件验证码错误"));
		echo $json;
		exit;
	}
	if (isset($_SESSION["newmail"])&&$username!=$_SESSION["newmail"]) {
		$json=json_encode(array("code"=>"mailnosame","msg"=>"填写邮箱和发送验证码的邮箱不一致"));
		echo $json;
		exit;
	}
	$userRow = $db->once_fetch_array("SELECT COUNT(*) AS total FROM ".DB_PREFIX."user WHERE username='$username' OR email='$username'");
	if($userRow['total'] > 0){
		$json=json_encode(array("code"=>"userexist","msg"=>"账号已存在"));
		echo $json;
		exit;
	}
	if(strlen($password)<6){
		$json=json_encode(array("code"=>"pwdlengtherror","msg"=>"密码长度需要不小于6位"));
		echo $json;
		exit;
	}
	global $CACHE;
	$hsPWD = new PasswordHash(8, true);
	$password = $hsPWD->HashPassword($password);
	$mailpre=explode("@",$username);
	$nickname=$mailpre.time();
	
	$db->query("insert into ".DB_PREFIX."user (username,password,email,role,ischeck) values('$username','$password','$username','writer','y')");
	$CACHE->updateCache();
	
	//重置$_SESSION['smscode']
	$randCode = '';
	$chars = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPRSTUVWXYZ23456789';
	for ( $i = 0; $i < 5; $i++ ){
		$randCode .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
	}
	$_SESSION['mailsmscode'] = strtoupper($randCode);
	
	$json=json_encode(array("code"=>"ok","msg"=>"注册成功"));
	echo $json;
	exit;
}else if($action=='getoauth'){
	if(!class_exists('SaeTOAuthV2')){
		include_once( dirname(__FILE__).'/../libs/saetv2.ex.class.php' );
	}
	$o = new SaeTOAuthV2($config_wb_akey , $config_wb_skey);
	$wb_url = $o->getAuthorizeURL( $config_wb_callback_url );
	
	$qqstate=md5(uniqid(rand(), TRUE));
	$_SESSION["qqstate"]=$qqstate;
	$qq_url = 'https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id='.$config_qq_appid.'&redirect_uri='.urlencode($config_qq_callback).'&state='.$qqstate;
	
	createTableOAuthLogin($db);
	$json=json_encode(array("code"=>"ok","msg"=>"获取第三方登陆url","data"=>array("wb_url"=>$wb_url,"qq_url"=>$qq_url)));
	echo $json;
	exit;
}
/*创建第三方登录缩短所用数据表*/
function createTableOAuthLogin($db){
	$db->query('CREATE TABLE IF NOT EXISTS '.DB_PREFIX.'tle_emlog_oauthlogin(
		`oauthid` varchar(64) COLLATE utf8_general_ci NOT NULL,
		`oauthuid` bigint(20) COLLATE utf8_general_ci NOT NULL,
		`oauthnickname` varchar(64) COLLATE utf8_general_ci DEFAULT NULL,
		`oauthfigureurl` varchar(255) COLLATE utf8_general_ci DEFAULT NULL,
		`oauthgender` varchar(8) COLLATE utf8_general_ci DEFAULT NULL,
		`oauthtype` enum("qq","weibo","weixin") COLLATE utf8_general_ci DEFAULT NULL,
		PRIMARY KEY (`oauthid`)
	) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');
}
/*发送邮件*/
function sendMailSms($mailsmtp,$mailport,$mailuser,$mailpass,$mailsecure,$email,$title,$content){
	require_once dirname(__FILE__).'/../libs/PHPMailer/PHPMailerAutoload.php';
	$phpMailer = new PHPMailer();
	$phpMailer->isSMTP();
	$phpMailer->SMTPAuth = true;
	$phpMailer->Host = $mailsmtp;
	$phpMailer->Port = $mailport;
	$phpMailer->Username = $mailuser;
	$phpMailer->Password = $mailpass;
	$phpMailer->isHTML(true);
	if ('none' != $mailsecure) {
		$phpMailer->SMTPSecure = $mailsecure;
	}
	$phpMailer->setFrom($mailuser, $title);
	$phpMailer->addAddress($email, $email);
	$phpMailer->Subject = $title;
	$phpMailer->Body    = $content;
	if(!$phpMailer->send()) {
		return false;
	} else {
		return true;
	}
}
?>