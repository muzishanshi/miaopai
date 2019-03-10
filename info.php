<?php
/**
 * 顶部个人资料信息
 */
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
$User_Model=new User_Model();
$Log_Model=new Log_Model();
$followLink = $db->once_fetch_array("SELECT count(*) AS total FROM ".DB_PREFIX."link WHERE hide='n'");
$userNum = $db->once_fetch_array("SELECT count(*) AS total FROM ".DB_PREFIX."user WHERE role='writer'");
if($author){$conditionAuthor="and author='".$author."'";}
$blogViewNum = $db->once_fetch_array("SELECT SUM(views) AS total FROM ".DB_PREFIX."blog WHERE type='blog' AND hide='n' AND checked='y' $conditionAuthor");
$blogCommentNum = $db->once_fetch_array("SELECT SUM(comnum) AS total FROM ".DB_PREFIX."blog WHERE type='blog' AND hide='n' AND checked='y' $conditionAuthor");
?>
<div class="personalInfo">
	<div class="topInfor">
		<?php
		if(!$author){
		?>
		<div class="personalPic">
			<a class="pic"><img src="<?=$config_headImgUrl!=""?$config_headImgUrl:TEMPLATE_URL."assets/images/avatar.jpg";?>"></a>
			<img src='<?php echo TEMPLATE_URL;?>assets/images/vip.png' class='vip'>
		</div>
		<div class="personalText">
			<p class="name">
				<a href="javascript:;"><span><?=$config_nickname!=""?$config_nickname:"快乐贰呆";?></span></a>
			</p>
			<p class="address"><?=$config_address!=""?$config_address:"";?></p>
			<p class="brief"><?=$config_detail!=""?$config_detail:"欢迎关注微信公众号：Diamond0422";?></p>
		</div>
		<?php
		}else{
			$authorRes = $db->query("SELECT * FROM ".DB_PREFIX."user WHERE uid=".$author);
			$authorRow = $db->fetch_array($authorRes);
			$host = 'https://secure.gravatar.com';
			$url = '/avatar/';
			$size = '50';
			$rating = 'g';
			$hash = md5(strtolower($authorRow["email"]));
			$avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=mm';
			?>
			<div class="personalPic">
				<a class="pic"><img src="<?=$avatar;?>"></a>
				<img src='<?php echo TEMPLATE_URL;?>assets/images/vip.png' class='vip'>
			</div>
			<div class="personalText">
				<p class="name">
					<a href="javascript:;"><span><?=$authorRow["nickname"]!=""?$authorRow["nickname"]:$authorRow["username"];?></span></a>
				</p>
				<p class="address"><?=$authorRow["email"]!=""?$authorRow["email"]:"";?></p>
				<p class="brief"><?=$authorRow["description"]!=""?$authorRow["description"]:"";?></p>
			</div>
		<?php
		}
		?>
	</div>
	<ul class="bottomInfor">
		<li>
			<a href="javascript:;">
				<span class="num"><?=$Log_Model->getLogNum('n',"and checked='y'")?$Log_Model->getLogNum('n',"and checked='y'"):0;?></span>
				<span class="tit">文章</span>
			</a>
			<i class="line"></i>
		</li>
		<li>
			<?php
			if(!$author){
			?>
			<a href="javascript:;">
				<span class="num"><?=$followLink["total"]?$followLink["total"]:0;?></span>
				<span class="tit">关注</span>
			</a>
			<?php
			}else{
			?>
			<a href="javascript:;">
				<span class="num"><?=$blogCommentNum['total']?$blogCommentNum['total']:0;?></span>
				<span class="tit">评论</span>
			</a>
			<?php
			}
			?>
			<i class="line"></i>
		</li>
		<li>
			<?php
			if(!$author){
			?>
			<a href="javascript:;">
				<span class="num"><?=$userNum["total"]?$userNum["total"]:0;?></span>
				<span class="tit">粉丝</span>
			</a>
			<?php
			}else{
			?>
			<a href="javascript:;">
				<span class="num"><?=$blogViewNum['total']?$blogViewNum['total']:0;?></span>
				<span class="tit">阅读</span>
			</a>
			<?php
			}
			?>
		</li>
	</ul>
</div>