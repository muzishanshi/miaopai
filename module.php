<?php 
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
$db = MySql::getInstance();
?>
<?php
//widget：blogger
function widget_blogger($title){
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    $name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];?>
	<div class="followCont">
    <h1 class="partitionTit"><span><?php echo $title; ?></span></h1>
	<div class="followInfo">
		<div class="followText">
			<p class="followName">
				<?php if (!empty($user_cache[1]['photo']['src'])): ?>
				<img src="<?php echo BLOG_URL.$user_cache[1]['photo']['src']; ?>" width="<?php echo $user_cache[1]['photo']['width']; ?>" height="<?php echo $user_cache[1]['photo']['height']; ?>" alt="blogger" />
				<?php endif;?>
			</p>
			<p>
				<b><?php echo $name; ?></b>
				<?php echo $user_cache[1]['des']; ?>
			</p>
		</div>
	</div>
	</div>
<?php }?>
<?php
//widget：标签
function widget_tag($title){
    global $CACHE;
    $tag_cache = $CACHE->readCache('tags');?>
	<div class="followCont">
    <h1 class="partitionTit"><span><?php echo $title; ?></span></h1>
	<div class="followInfo">
	<?php foreach($tag_cache as $value): ?>
		<span style="font-size:<?php echo $value['fontsize']; ?>pt; line-height:30px;">
		<a title="<?php echo $value['usenum']; ?> 篇文章" href="<?php echo Url::tag($value['tagurl']); ?>"><?php echo $value['tagname']; ?></a>
		</span>
	<?php endforeach; ?>
	</div>
	</div>
<?php }?>
<?php
//widget：分类
function widget_sort($title){
    global $CACHE;
    $sort_cache = $CACHE->readCache('sort'); ?>
	<div class="followCont">
    <h1 class="partitionTit"><span><?php echo $title; ?></span></h1>
	<?php
	foreach($sort_cache as $value):
		if ($value['pid'] != 0) continue;
		?>
		<div class="followInfo">
			<div class="followText">
				<p class="followName">
					<a title="<?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)" href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
					<?php if (!empty($value['children'])): ?>
						<ul style="margin-left:20px;">
						<?php
						$children = $value['children'];
						foreach ($children as $key):
							$value = $sort_cache[$key];
						?>
						<li>
							<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
						</li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</p>
			</div>
		</div>
		<?php
	endforeach;
	?>
	</div>
<?php }?>
<?php
//widget：最新评论
function widget_newcomm($title){
    global $CACHE; 
    $com_cache = $CACHE->readCache('comment');
    ?>
	<div class="followCont">
    <h1 class="partitionTit"><span><?php echo $title; ?></span></h1>
	<?php
	foreach($com_cache as $value):
	$url = Url::comment($value['gid'], $value['page'], $value['cid']);
	?>
	<div class="followInfo">
		<div class="followText">
			<p class="followName">
				<?php echo $value['name']; ?><br />
				<a title="<?php echo $value['name']; ?>" href="<?php echo $url; ?>"><?php echo $value['content']; ?></a>
			</p>
		</div>
	</div>
	<?php
	endforeach;
	?>
	</div>
<?php }?>
<?php
//widget：最新文章
function widget_newlog($title){
    global $CACHE; 
    $newLogs_cache = $CACHE->readCache('newlog');
    ?>
	<div class="followCont">
    <h1 class="partitionTit"><span><?php echo $title; ?></span></h1>
	<?php foreach($newLogs_cache as $value): ?>
	<div class="followInfo">
		<div class="followText">
			<p class="followName">
				<a title="<?php echo $value['title']; ?>" href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a>
			</p>
		</div>
	</div>
	<?php endforeach; ?>
	</div>
<?php }?>
<?php
//widget：热门文章
function widget_hotlog($title){
    $index_hotlognum = Option::get('index_hotlognum');
    $Log_Model = new Log_Model();
    $hotLogs = $Log_Model->getHotLog($index_hotlognum);?>
	<div class="followCont">
    <h1 class="partitionTit"><span><?php echo $title; ?></span></h1>
	<?php foreach($hotLogs as $value): ?>
	<div class="followInfo">
		<div class="followText">
			<p class="followName">
				<a title="<?php echo $value['title']; ?>" href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a>
			</p>
		</div>
	</div>
	<?php endforeach; ?>
	</div>
<?php }?>
<?php
//widget：搜索
function widget_search($title){ ?>
	<div class="followCont">
    <h1 class="partitionTit"><span><?php echo $title; ?></span></h1>
	<div class="downLoadText">
		<form method="get" action="<?php echo BLOG_URL; ?>index.php">
			<input type="text" name="keyword" placeholder="输入关键字按回车键搜索" />
		</form>
	</div>
	</div>
<?php } ?>
<?php
//widget：归档
function widget_archive($title){
    global $CACHE; 
    $record_cache = $CACHE->readCache('record');
    ?>
	<div class="followCont">
    <h1 class="partitionTit"><span><?php echo $title; ?></span></h1>
	<?php foreach($record_cache as $value): ?>
	<div class="followInfo">
		<div class="followText">
			<p class="followName">
				<a title="<?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)" href="<?php echo Url::record($value['date']); ?>"><?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)</a>
			</p>
		</div>
	</div>
	<?php endforeach; ?>
	</div>
<?php } ?>
<?php
//widget：自定义组件
function widget_custom_text($title, $content){ ?>
	<div class="followCont">
    <h1 class="partitionTit"><span><?php echo $title; ?></span></h1>
	<div class="followInfo">
		<div class="followText">
			<p class="followName">
				<?php echo $content; ?>
			</p>
		</div>
	</div>
	</div>
<?php } ?>
<?php
//widget：友情链接
function widget_link($title){
    global $CACHE; 
    $link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
    ?>
	<div class="followCont">
    <h1 class="partitionTit"><span><?php echo $title; ?></span></h1>
	<div class="followInfo">
	<?php foreach($link_cache as $value): ?>
		<span style="line-height:30px;">
			<a title="<?php echo $value['des']; ?>" href="<?=$value['url'];?>" target="_blank"><?php echo $value['link']; ?></a>
		</span>
	<?php endforeach; ?>
	</div>
	</div>
<?php }?>
<?php
//blog：导航
function blog_navi($blogname){
	include(dirname(__FILE__).'/config.php');
    global $CACHE; 
    $navi_cache = $CACHE->readCache('navi');
    ?>
	<div class="header">
		<div class="headerCont">
			<h1 class="logoHeader">
				<a href="<?php echo BLOG_URL; ?>" title="<?php echo $blogname; ?>">
					<img src="<?=$config_logo!=""?$config_logo:TEMPLATE_URL."assets/images/logoHeader.png";?>" alt="">
				</a>
			</h1>
			<div class="headerRight">
				<div class="headerNav">
					<?php
					foreach($navi_cache as $value){
						if ($value['pid'] != 0) {
							continue;
						}
						$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
						$value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
						?>
						<a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
					<?php
					}
					?>
				</div>
				<div class="personal" style="float:right;">
				<?php
				if(ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER){
					?>
					<div>
						<a href="<?php echo BLOG_URL; ?><?=$config_admin_dir!=""?$config_admin_dir:"admin"?>/">后台</a>
					</div>
					<?php
				}else{
					?>
					<div class="login">
						<a href="javascript:;">登录</a>
					</div>
					<?php
				}
				?>
				</div>
			</div>
		</div>
	</div>
	<!--登录框-->
	<div class="black_bg"></div>
	<div class="login_box">
		<span class="close_btn"><img src="<?php echo TEMPLATE_URL;?>assets/images/closeIco.png" ></span>
		<h2 class="tit_login">登录<?php echo $blogname; ?></h2>
		<div class="login_cont">
			<input type="text" id="phone" maxlength="32" placeholder="请输入邮箱" name="" class="login_name" >
			<input type="text" id="pwd" placeholder="请输入密码" name="" class="login_password" >
			<!-------------star------------>
			<div class="yzm_cont" style="display: none;">
				<input type="text" class="yzm_input" placeholder="请输入验证码">
				<img src="" class="yzm_img" id="yzm_img">
			</div>
			<!--------------end------------->
			<input id="ph" type="hidden" value="0">
			<div class="remember_password">
				<input type="checkbox" id="remember_input" ><label for="remember_input">下次自动登录</label>
				<!-------------注册star------------>
				<?php if($config_is_mailreg=="y"){?>
				<span class="reginster_btnChange">注册</span>
				<?php }?>
				<!--------------end------------->
			</div>
			
			<input type="submit" value="登录" class="login_btn">
			<font color="red"><div id="loginAlert">&nbsp;</div></font>
		</div>
		<?php if($config_is_weibologin=="y"||$config_is_qqlogin=="y"){?>
		<div class="login_other">
			<p class="login_otherTit"><b class="left"></b><span>社交账号登录</span><b class="right"></b></p>
			<div class="login_otherBtn">
				<?php if($config_is_weibologin=="y"){?>
					<?php if($config_is_qqlogin!="y"){?>
						<a class='sina_login' href="javascript:;" target="_blank">&nbsp;</a>
					<?php }?>
					<a class='sina_login' href="javascript:;" target="_blank"><img src="<?php echo TEMPLATE_URL;?>assets/images/share_sina.png" ></a>
				<?php }?>
				<a class='wx_login' href="javascript:void('https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxa2f893aa61e8444e&redirect_uri=http%3A%2F%2Fwww.miaopai.com%2Fcu%2Flogin&response_type=code&scope=snsapi_login&state=wxlogin#wechat_redirect');" target="_blank">&nbsp;</a>
				<?php if($config_is_qqlogin=="y"){?>
					<a class='qq_login' href="javascript:;" target="_blank"><img src="<?php echo TEMPLATE_URL;?>assets/images/share_qq.png"></a>
				<?php }?>
			</div>
		</div>
		<?php }?>
	</div>
	<!--注册-->
	<div class="register_box" style="display: none;">
		<span class="close_btn"><img src="<?php echo TEMPLATE_URL;?>assets/images/closeIco.png" ></span>
		<h2 class="tit_login">注册<?php echo $blogname; ?></h2>
		<div class="login_cont">
			<input type="text" placeholder="请输入邮箱账号" maxlength="32" id="phoneReg" class="reginster_input" >
			<input type="password" placeholder="请输入密码" id="pwdReg" class="reginster_input" >
			<div class="voiceYzm_box">
				<input type="text" placeholder="请输入验证码" id="voiceYzmVal" class="voiceYzm_val">
				<input type="button" value="获取邮件验证码" id="voiceYzmBtn" class="voiceYzm_btn">
			</div>
			<div class="yzm_alertText">请注意查收邮件，并填写邮件中的验证码</div>
			<input type="submit" value="注册" class="reginster_btn">
			<font color="red"><div id="regAlert">&nbsp;</div></font>
			<div class="login_alertText">已有<?php echo $blogname; ?>账号？点此 <span class="login_btnChange">登录</span></div>
		</div>
	</div>
	<div class="alert_status">注册成功</div>
	<!--图片验证码弹框-->
	<div class="yzm_pic" style="display: none;">
		<span class="yzmClose_btn"><img src="<?php echo TEMPLATE_URL;?>assets/images/closeIco.png"></span>
		<div class="yzmPic_box">
			<input type="text" placeholder="验证码" class="yzmPic_input">
			<div class="yzmPic_img"><img src=""></div>
		</div>
		<div class="yzmPic_alert">点击图片刷新验证码</div>
		<p class="alert_text"></p>
		<input type="button" value="确定" id="yzmLog_btn" class="yzmLog_btn">
		<font color="red"><center><div id="sendCodeAlert">&nbsp;</div></center></font>
	</div>
	<!--注册end-->
<?php }?>
<?php
//blog：分类
function blog_sort($blogid){
    global $CACHE; 
    $log_cache_sort = $CACHE->readCache('logsort');
    ?>
    <?php if(!empty($log_cache_sort[$blogid])): ?>
    <a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
    <?php endif;?>
<?php }?>
<?php
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '标签:';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "	<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo $tag;
	}
}
?>
<?php
//blog：文章作者
function blog_author($uid){
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    $author = $user_cache[$uid]['name'];
    $mail = $user_cache[$uid]['mail'];
    $des = $user_cache[$uid]['des'];
    $title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
    echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>
<?php //分页函数
function my_page($count,$perlogs,$page,$url,$anchor=''){
	$pnums = @ceil($count / $perlogs);
	$page = @min($pnums,$page);
	$prepg=$page-1;                 //上一页
	$nextpg=($page==$pnums ? 0 : $page+1); //下一页
	$urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|","",$url);
	//开始分页导航内容
	$re = "";
	if($pnums<=1) return false;	//如果只有一页则跳出	
	if($page!=1) $re .=" <a href=\"$urlHome$anchor\">首页</a> "; 
	if($prepg) $re .=" <a href=\"$url$prepg$anchor\" ><span class='page'>‹‹</span></a> ";
	for ($i = $page-2;$i <= $page+2 && $i <= $pnums; $i++){
	if ($i > 0){if ($i == $page){$re .= " <span class='page now-page'>$i</span> ";
	}elseif($i == 1){$re .= " <a href=\"$urlHome$anchor\">$i</a> ";
	}else{$re .= " <a href=\"$url$i$anchor\">$i</a> ";}
	}}
	if($nextpg) $re .=" <a href=\"$url$nextpg$anchor\" class='nextpages'><span class='page'>››</span></a> "; 
	if($page!=$pnums) $re.=" <a href=\"$url$pnums$anchor\" title=\"尾页\">尾页</a>";
	return $re;
}
?>
<?php
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<img src=\"".TEMPLATE_URL."/assets/images/top.png\" title=\"首页置顶文章\" /> " : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<img src=\"".TEMPLATE_URL."/assets/images/sortop.png\" title=\"分类置顶文章\" /> " : '';
    }
}
?>
<?php
//blog：编辑
function editflg($config_admin_dir,$logid,$author){
    $editflg = ROLE == ROLE_ADMIN || $author == UID ? '<a href="'.BLOG_URL.$config_admin_dir.'/write_log.php?action=edit&gid='.$logid.'" target="_blank">编辑</a>' : '';
    echo $editflg;
}
?>
<?php
//blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}
?>
<?php
//blog：相邻文章
function neighbor_log($neighborLog){
    extract($neighborLog);?>
    <?php if($prevLog):?>
    &laquo; <a href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a>
    <?php endif;?>
    <?php if($nextLog && $prevLog):?>
        |
    <?php endif;?>
    <?php if($nextLog):?>
         <a href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a>&raquo;
    <?php endif;?>
<?php }?>
<?php
//blog：评论列表
function blog_comments($comments){
    extract($comments);
    if($commentStacks): ?>
    <a name="comments"></a>
    <p class="comment-header"><b>评论：</b></p>
    <?php endif; ?>
    <?php
    $isGravatar = Option::get('isgravatar');
    foreach($commentStacks as $cid):
    $comment = $comments[$cid];
    $comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
    ?>
    <div class="comment" id="comment-<?php echo $comment['cid']; ?>">
        <a name="<?php echo $comment['cid']; ?>"></a>
        <?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo getGravatar($comment['mail']); ?>" /></div><?php endif; ?>
        <div class="comment-info">
            <b><?php echo $comment['poster']; ?> </b><span class="comment-time"><?php echo $comment['date']; ?></span>
            <div class="comment-content"><?php echo $comment['content']; ?></div>
            <div class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></div>
        </div>
        <?php blog_comments_children($comments, $comment['children']); ?>
    </div>
    <?php endforeach; ?>
    <div id="pagenavi">
        <?php echo $commentPageUrl;?>
    </div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
    $isGravatar = Option::get('isgravatar');
    foreach($children as $child):
    $comment = $comments[$child];
    $comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
    ?>
    <div class="comment comment-children" id="comment-<?php echo $comment['cid']; ?>">
        <a name="<?php echo $comment['cid']; ?>"></a>
        <?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo getGravatar($comment['mail']); ?>" /></div><?php endif; ?>
        <div class="comment-info">
            <b><?php echo $comment['poster']; ?> </b><span class="comment-time"><?php echo $comment['date']; ?></span>
            <div class="comment-content"><?php echo $comment['content']; ?></div>
            <?php if($comment['level'] < 4): ?><div class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></div><?php endif; ?>
        </div>
        <?php blog_comments_children($comments, $comment['children']);?>
    </div>
    <?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
    if($allow_remark == 'y'): ?>
    <div id="comment-place">
    <div class="comment-post" id="comment-post">
        <div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">取消回复</a></div>
        <p class="comment-header"><b>发表评论：</b><a name="respond"></a></p>
        <form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
            <input type="hidden" name="gid" value="<?php echo $logid; ?>" />
            <?php if(ROLE == ROLE_VISITOR): ?>
            <p>
                <input type="text" name="comname" maxlength="49" value="<?php echo $ckname; ?>" size="22" tabindex="1" required placeholder="昵称">
                <label for="author"><small>昵称</small></label>
            </p>
            <p>
                <input type="text" name="commail"  maxlength="128"  value="<?php echo $ckmail; ?>" size="22" tabindex="2" placeholder="邮件地址 (选填)">
                <label for="email"><small>邮件地址 (选填)</small></label>
            </p>
            <p>
                <input type="text" name="comurl" maxlength="128"  value="<?php echo $ckurl; ?>" size="22" tabindex="3" placeholder="个人主页 (选填)">
                <label for="url"><small>个人主页 (选填)</small></label>
            </p>
            <?php endif; ?>
            <p><textarea name="comment" id="comment" rows="10" tabindex="4" required placeholder="你想要的说点什么……"></textarea></p>
            <p>
				<?php echo $verifyCode; ?> <input type="submit" id="comment_submit" value="发表评论" tabindex="6" />
				<span id="commentAlert"></span>
			</p>
            <input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
        </form>
    </div>
    </div>
    <?php endif; ?>
<?php }?>
<?php
//调用文章页url
function curPageURL(){
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on"){
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80"){
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    }else{
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
?>
<?php
//格式化摘要
function formatExcerpt($content, $strlen = null){
	$content = preg_replace('/\[iframe\](.*)\[\/iframe\]/Uims', '', $content);
	$content = preg_replace('/\[video\](.*)\[\/video\]/Uims', '', $content);
	$content = str_replace('继续阅读&gt;&gt;', '', $content);
	$content = preg_replace("/\[hide\](.*)\[\/hide\]/Uims", '|*********此处内容回复可见*********|', strip_tags($content));
	if ($strlen) {
		$content = subString($content, 0, $strlen);
	}
	return $content;
}
//格式化内容
function formatContent($content){
	$matche_content=getVideoCode($content);
	for($i=0;$i<count($matche_content[0]);$i++){
		if(strpos($matche_content[0][$i],'iframe')){
			$content = str_replace($matche_content[0][$i], '<iframe height="400" width="100%" src="'.$matche_content[2][$i].'" frameborder="0" "allowfullscreen"></iframe>', $content);
		}else if(strpos($matche_content[0][$i],'video')&&strpos($matche_content[2][$i],'.mp4')){
			$content = str_replace($matche_content[0][$i], '<video width="100%" src="'.$matche_content[2][$i].'" controls="controls"></video>', $content);
		}else if(strpos($matche_content[0][$i],'video')){
			$content = str_replace($matche_content[0][$i], '', $content);
		}
	}
	return $content;
}
/*获取文章中视频代码*/
function getVideoCode($content){
    preg_match_all( "/\[(video|VIDEO|iframe|IFRAME)\](.*)\[\/(video|VIDEO|iframe|IFRAME)\]/Uims", $content, $matches );
    return $matches;
}
/*获取文章中首张图片*/
function getBlogImages($content){
    preg_match_all( "/<(img|IMG).*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $content, $matches );
	$thumb=array();
	if(count($matches[2])!=0){
        array_push($thumb,$matches[2][0]);//文章内容中抓到了图片 输出链接
    }
    return $thumb;
}
?>
<?php 
//解决页面标题重复
function page_repeat($page) {
	if ($page>=2){ 
		echo ' _第'.$page.'页'; 
	}
}
?>
<?php
//点赞
function syzan(){
	$DB = MySql::getInstance();
	if($DB->num_rows($DB->query("show columns from ".DB_PREFIX."blog like 'slzan'")) == 0){
		$sql = "ALTER TABLE ".DB_PREFIX."blog ADD slzan int unsigned NOT NULL DEFAULT '0'";
		$DB->query($sql);
	}
}
syzan();
function update($logid){
	$logid = intval($_POST['id']);
	$DB = Database::getInstance();
	$DB->query("UPDATE " . DB_PREFIX . "blog SET slzan=slzan+1 WHERE gid=$logid");
	setcookie('slzanpd_'. $logid, 'true', time() + 31536000);
}
function lemoninit() {
	if( @$_POST['plugin'] == 'slzanpd' &&@$_POST['action'] == 'slzan' &&isset($_POST['id'])){
		$id = intval($_POST['id']);
		header("Access-Control-Allow-Origin: *");
		update($id);echo getnum($id);die;
	}
}
lemoninit();
function getnum($id){
	static $arr = array();
	$DB = Database::getInstance();
	if(isset($arr[$logid])) return $arr[$logid];
	$sql = "SELECT slzan FROM " . DB_PREFIX . "blog WHERE gid=$id";
	$res = $DB->query($sql);
	$row = $DB->fetch_array($res);
	$arr[$id] = intval($row['slzan']);
	return $arr[$id];
}
?>
<?php
/*时间轴文章归档*/
function displayRecord(){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	$output = '';
	foreach($record_cache as $value){
		$output .= '<h4>'.$value['record'].'('.$value['lognum'].')</h4>'.displayRecordItem($value['date']).'';
	}
	$output = '<div class="archives">'.$output.'</div>';
	return $output;
}
function displayRecordItem($record){
	if (preg_match("/^([\d]{4})([\d]{2})$/", $record, $match)) {
		$days = getMonthDayNum($match[2], $match[1]);
		$record_stime = emStrtotime($record . '01');
		$record_etime = $record_stime + 3600 * 24 * $days;
	} else {
		$record_stime = emStrtotime($record);
		$record_etime = $record_stime + 3600 * 24;
	}
	$sql = "and date>=$record_stime and date<$record_etime order by top desc ,date desc";
	$result = archiver_db($sql);
	return $result;
}
function archiver_db($condition = ''){
	$DB = MySql::getInstance();
	$sql = "SELECT gid, title, date, views FROM " . DB_PREFIX . "blog WHERE type='blog' and hide='n' $condition";
	$result = $DB->query($sql);
	$output = '';
	while ($row = $DB->fetch_array($result)) {
		$log_url = Url::log($row['gid']);
		$output .= '<li><a href="'.$log_url.'"><span>'.date('Y年m月d日',$row['date']).'</span><div class="atitle">'.$row['title'].'</div></a></li>';
	}
	$output = empty($output) ? '<li>暂无文章</li>' : $output;
	$output = '<ul>'.$output.'</ul>';
	return $output;
}
function findQQUserInfo($access_token,$oauth_consumer_key,$openid){
	$user_data_url = "https://graph.qq.com/user/get_user_info?access_token={$access_token}&oauth_consumer_key={$oauth_consumer_key}&openid={$openid}&format=json";
	$user_data = file_get_contents($user_data_url);
	$user_data = json_decode($user_data, true);
	return $user_data;
}
function findQQOpenID($access_token){
	$graph_url = "https://graph.qq.com/oauth2.0/me?access_token=".$access_token;
	$str = file_get_contents($graph_url);
	if (strpos($str, "callback") !== false){
		$lpos = strpos($str, "(");
		$rpos = strrpos($str, ")");
		$str = substr($str, $lpos + 1, $rpos - $lpos -1);
	}
	$user = json_decode($str);//存放返回的数据 client_id ，openid
	if (isset($user->error)){
		return 0;
	}
	return $user;
}
function findQQAccessToken($qq_appid,$qq_appkey,$qq_callback,$code){
	$token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&". "client_id=" . $qq_appid . "&redirect_uri=" . $qq_callback. "&client_secret=" . $qq_appkey . "&code=" . $code;
	$response = file_get_contents($token_url);
	if (strpos($response, "callback") !== false){
		//如果登录用户临时改变主意取消了，返回true!==false,否则执行step3
		$lpos = strpos($response, "(");
		$rpos = strrpos($response, ")");
		$response = substr($response, $lpos + 1, $rpos - $lpos -1);
		$msg = json_decode($response);
		if (isset($msg->error)){
			return 0;
		}
	}
	//Step3：使用Access Token来获取用户的OpenID
	$params = array();
	parse_str($response, $params);//把传回来的数据参数变量化
	return $params;
}
?>