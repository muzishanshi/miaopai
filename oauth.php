<?php 
if(!defined('EMLOG_ROOT')) {exit('error!');} 
require_once(dirname(__FILE__).'/config.php');
if(!class_exists('SaeTOAuthV2')){
	include_once('libs/saetv2.ex.class.php' );
}
date_default_timezone_set('Asia/Shanghai');
$db = Database::getInstance();
global $CACHE;

$action = isset($_GET['action']) ? addslashes($_GET['action']) : '';
if($action=='weibocallback'){
	$o = new SaeTOAuthV2( $config_wb_akey , $config_wb_skey );

	if (isset($_REQUEST['code'])) {
		$keys = array();
		$keys['code'] = $_REQUEST['code'];
		$keys['redirect_uri'] = $config_wb_callback_url;
		try {
			$token = $o->getAccessToken( 'code', $keys ) ;
		} catch (OAuthException $e) {
		}
	}

	if (isset($token)) {
		setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
		//获得用户信息
		$c = new SaeTClientV2( $config_wb_akey , $config_wb_skey , $token['access_token'] );
		$ms  = $c->home_timeline(); // done
		$uid_get = $c->get_uid();
		$oauthid = $uid_get['uid'];
		$user_message = $c->show_user_by_id( $oauthid);//根据ID获取用户等基本信息
		$weibo_id=$user_message["id"];
		$name=$user_message["name"];
		$gender=$user_message["gender"];
		$figureurl=$user_message["profile_image_url"];
		$weibo_url="http://weibo.com/".$user_message["profile_url"];
		$weibo_description=$user_message["description"];
	} else {
		emMsg('授权失败',BLOG_URL,true);exit;
	}
	$oauthUser = $db->once_fetch_array("SELECT * FROM ".DB_PREFIX."tle_emlog_oauthlogin WHERE oauthid='$oauthid'");
	if($oauthUser){
		//微博登录
		/** 如果已经登录 */
		if(ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER){
			emDirect(BLOG_URL);
		}
		$user = $db->once_fetch_array("SELECT username FROM ".DB_PREFIX."user WHERE uid='".$oauthUser['oauthuid']."'");

		LoginAuth::setAuthCookie($user["username"]);
		emDirect(BLOG_URL);
	}else{
		//微博注册
		/** 如果已经登录 */
		if(ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER){
			emDirect(BLOG_URL);
		}
		if($config_is_weibologin!="y"){
			emMsg('未开启微博登陆',BLOG_URL,true);exit;
		}
		$hsPWD = new PasswordHash(8, true);
		$password = $hsPWD->HashPassword(time());
		
		$nickname=$name;
		$rowName = $db->once_fetch_array("SELECT username FROM ".DB_PREFIX."user WHERE nickname='".$nickname."'");
		if($rowName){
			for($i=1;;$i++){
				$nickname=$name.$i;
				$rowName = $db->once_fetch_array("SELECT username FROM ".DB_PREFIX."user WHERE nickname='".$nickname."'");
				if(count($rowName)==0){
					break;
				}
			}
		}
		$email=$weibo_id.'@'.$_SERVER['SERVER_NAME'];

		$db->query("insert into ".DB_PREFIX."user (username,nickname,password,email,role,ischeck) values('$weibo_id','$nickname','$password','$email','writer','y')");
		$userId = $db->insert_id();
		
		$db->query("insert into ".DB_PREFIX."tle_emlog_oauthlogin (oauthid,oauthuid,oauthnickname,oauthfigureurl,oauthgender,oauthtype) values('$oauthid','$userId','$nickname','$figureurl','$gender','weibo')");

		$CACHE->updateCache();
		LoginAuth::setAuthCookie($weibo_id);
		emDirect(BLOG_URL);
	}
}else if($action=='qqcallback'){
	$code = isset($_GET['code']) ? addslashes(trim($_GET['code'])) : '';
	$state = isset($_GET['state']) ? addslashes(trim($_GET['state'])) : '';
	if($code!=''&&$state!=''){
		if(!$state || $state != $_SESSION["qqstate"]){
			emMsg('操作异常，拒绝访问！code=30001',BLOG_URL,true);exit;
		}
		$tokenData=findQQAccessToken($config_qq_appid,$config_qq_appkey,$config_qq_callback,$_GET['code']);
		if($tokenData==0){
			emMsg('非法操作，请重新登录！',BLOG_URL,true);exit;
		}
		$qqUserData=findQQOpenID($tokenData['access_token']);
		if($qqUserData==0){
			emMsg('非法操作，请重新登录！',BLOG_URL,true);exit;
		}
		$oauthid=$qqUserData->openid;
		$userinfo=findQQUserInfo($tokenData['access_token'],$config_qq_appid,$oauthid);
		$name=$userinfo['nickname'];
		$gender=$userinfo['gender'];
		$figureurl=$userinfo['figureurl_qq_2'];
		$oauthUser = $db->once_fetch_array("SELECT * FROM ".DB_PREFIX."tle_emlog_oauthlogin WHERE oauthid='$oauthid'");
		if($oauthUser){
			/*登录*/
			/** 如果已经登录 */
			if(ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER){
				emDirect(BLOG_URL);
			}
			$user = $db->once_fetch_array("SELECT username FROM ".DB_PREFIX."user WHERE uid='".$oauthUser['oauthuid']."'");
			LoginAuth::setAuthCookie($user["username"]);
			emDirect(BLOG_URL);
		}else{
			/*注册*/
			/** 如果已经登录 */
			if(ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER){
				emDirect(BLOG_URL);
			}
			if($config_is_qqlogin!="y"){
				emMsg('未开启QQ登陆',BLOG_URL,true);exit;
			}
			$hsPWD = new PasswordHash(8, true);
			$password = $hsPWD->HashPassword(time());
			
			$nickname=$name;
			$rowName = $db->once_fetch_array("SELECT username FROM ".DB_PREFIX."user WHERE nickname='".$nickname."'");
			if($rowName){
				for($i=1;;$i++){
					$nickname=$name.$i;
					$rowName = $db->once_fetch_array("SELECT username FROM ".DB_PREFIX."user WHERE nickname='".$nickname."'");
					if(count($rowName)==0){
						break;
					}
				}
			}
			$email=$nickname.'@'.$_SERVER['SERVER_NAME'];

			$db->query("insert into ".DB_PREFIX."user (username,nickname,password,email,role,ischeck) values('$nickname','$nickname','$password','$email','writer','y')");
			$userId = $db->insert_id();
			
			$db->query("insert into ".DB_PREFIX."tle_emlog_oauthlogin (oauthid,oauthuid,oauthnickname,oauthfigureurl,oauthgender,oauthtype) values('$oauthid','$userId','$nickname','$figureurl','$gender','qq')");

			$CACHE->updateCache();
			LoginAuth::setAuthCookie($nickname);
			emDirect(BLOG_URL);
		}
	}
}
?>