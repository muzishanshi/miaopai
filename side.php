<?php
/**
 * 侧边栏
 */
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
<div class="cotentRight">
	<!--下载-->
	<div class="downLoadApp">
		<?php include View::getView('side_top');?>
	</div>
	<!--关注-->
	<div class="followCont">
		<h1 class="partitionTit"><span><?=$config_nickname!=""?$config_nickname:"快乐贰呆";?>的关注<a title="ta的关注" href="<?=$config_follow!=""?$config_follow:"javascript:;";?>" class="moreFans">更多 ></a></span></h1>
		<?php
		$followRes = $db->query("SELECT * FROM ".DB_PREFIX."link WHERE hide='n' ORDER BY taxis DESC LIMIT 0,5");
		if($db->num_rows($followRes)>0){
			while ($followLink = $db->fetch_array($followRes)){
				?>
				<div class="followInfo">
					<div class="followText">
						<p class="followName">
							<a title="<?=$followLink["sitename"];?>" href="<?=$followLink["siteurl"];?>" target="_blank"><?=$followLink["sitename"];?></a>
							<span></span>
						</p>
						<p class="followAgh"><?=$followLink["description"];?></p>
					</div>
				</div>
				<?php
			}
		}else{
			?>
			<div class="followInfo">暂无关注</div>
			<?php
		}
		?>
	</div>
	<!--粉丝-->
	<div class="followCont fansCont">
	<h1 class="partitionTit"><span><?=$config_nickname!=""?$config_nickname:"快乐贰呆";?>的粉丝 <a title="ta的粉丝" href="<?=$config_fans!=""?$config_fans:"javascript:;";?>" class="moreFans">更多 ></a></span></h1>
		<?php
		$fansRes = $db->query("SELECT * FROM ".DB_PREFIX."user WHERE role='writer' ORDER BY uid DESC LIMIT 0,5");
		if($db->num_rows($fansRes)>0){
			while ($fansUser = $db->fetch_array($fansRes)){
				$host = 'https://secure.gravatar.com';
				$url = '/avatar/';
				$size = '50';
				$rating = 'g';
				$hash = md5(strtolower($fansUser["email"]));
				$avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=mm';
				?>
				<div class="followInfo">
					<div class="followPhoto">
						<a title="<?=$fansUser["email"];?>" href="<?=Url::author($fansUser["uid"]);?>">
							<img src="<?=$avatar;?>" >
						</a>
					</div>
					<div class="followText">
						<p class="followName">
							<a title="" href="<?=Url::author($fansUser["uid"]);?>"><?=$fansUser["nickname"]!=""?$fansUser["nickname"]:$fansUser["username"]?></a>
							<span></span>
						</p>
						<p class="followAgh"><?=$fansUser["description"];?></p>
					</div>
				</div>
				<?php
			}
		}else{
			?>
			<div class="followInfo">暂无粉丝</div>
			<?php
		}
		?>
	</div>
	
	<?php
	$widgets = !empty($options_cache['widgets1']) ? unserialize($options_cache['widgets1']) : array();
	doAction('diff_side');
	foreach ($widgets as $val) {
		$widget_title = @unserialize($options_cache['widget_title']);
		$custom_widget = @unserialize($options_cache['custom_widget']);
		if (strpos($val, 'custom_wg_') === 0) {
			$callback = 'widget_custom_text';
			if (function_exists($callback)) {
				call_user_func($callback, htmlspecialchars($custom_widget[$val]['title']), $custom_widget[$val]['content']);
			}
		} else {
			$callback = 'widget_' . $val;
			if (function_exists($callback)) {
				preg_match("/^.*\s\((.*)\)/", $widget_title[$val], $matchs);
				$wgTitle = isset($matchs[1]) ? $matchs[1] : $widget_title[$val];
				call_user_func($callback, htmlspecialchars($wgTitle));
			}
		}
	}
	?>
	
	<div class="downLoadApp downLoadApp2">
		<?php include View::getView('side_top');?>
	</div>
</div>