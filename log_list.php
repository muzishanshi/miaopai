<?php
/**
 * 站点首页模板
 */
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
if(isset($_GET["setting"])){
	include View::getView('setting');exit;
}
if(isset($_GET["oauth"])){
	include View::getView('oauth');exit;
}
?>
<!--内容分区-->
<div class="box900">
    <!--左分区-->
    <div class="contentLeft">
        <!--顶部分区-->
		<?php include View::getView('info');?>
		<div class="content">
			<?php if (!empty($logs)){?>
				<div class="videoCont">
					<!--视频列表 (设计图为3条)-->
					<?php foreach ($logs as $value){?>
					<div class="videoList">
						<!--视频URL-->
						<?php
						$video=getVideoCode($value['content']);
						if(count($video)!=0){
							if(strpos($video[0][0],'iframe')){
								?>
								<iframe height="400" width="100%" src="<?=$video[2][0];?>" frameborder="0" "allowfullscreen"></iframe>
								<?php
							}else if(strpos($video[0][0],'video')&&strpos($video[2][0],'.mp4')){
								?>
								<video width="100%" src="<?=$video[2][0];?>" controls="controls"></video>
								<?php
							}else if(strpos($video[0][0],'video')){
								?>
								<div class="video">
									<div class="MIAOPAI_player" data-scid="<?=basename($video[2][0]);?>" data-img=""></div>
								</div>
								<?php
							}
						?>
						<?php
						}
						?>
						<!--视频详情-->
						<div class="videoIntr">
							<div class="videoIntrTop">
								<div class="personalAbout">
									<div class="personalPic">
										<?php
										$authorRes = $db->query("SELECT email FROM ".DB_PREFIX."user WHERE uid=".$value['author']);
										$authorRow = $db->fetch_array($authorRes);
										$host = 'https://secure.gravatar.com';
										$url = '/avatar/';
										$size = '50';
										$rating = 'g';
										$hash = md5(strtolower($authorRow["email"]));
										$avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=mm';
										?>
										<a href="<?=Url::author($value['author']);?>" class="pic" title="<?=$authorRow["email"];?>"><img src="<?=$avatar;?>"></a>
										<img src="<?php echo TEMPLATE_URL;?>assets/images/v2.png" class='vip'>
									</div>
									<div class="personalData">
										<p class="personalDataN"><?php blog_author($value['author']); ?></p>
										<p class="personalDataT">
											<span><?php blog_sort($value['logid']); ?></span>
											<span><?php echo gmdate('Y-n-j', $value['date']); ?></span>
											<span class="red"><?php echo $value['views']; ?>观看</span>
										</p>
									</div>
								</div>
								<div class="viedoAbout">
									<p class="orange title">
										<?php topflg($value['top'], $value['sortop'], isset($sortid) ? $sortid : ''); ?>
										<a href="<?php echo $value['log_url']; ?>">
											<?php echo $value['log_title']; ?>
										</a>
										&nbsp;<?php editflg($config_admin_dir,$value['logid'], $value['author']); ?>
									</p>
									<p>
										<a href="<?php echo $value['log_url']; ?>">
											<?php
											$logdes = formatExcerpt($value['content'], 180);
											echo $logdes;
											?>
										</a>
									</p>
									<p class="orange"><?php blog_tag($value['logid']); ?></p>
								</div>
							</div>
							<div class="videoIntrBottom">
								<ul class="commentLike">
									<li><a class="slzanpd" href="javascript:;" data-slzanpd="<?php echo $value['logid'];?>" title="喜欢这篇文章就赞一个吧！"><?php echo(isset($value['slzan'])?$value['slzan']:getnum($value['logid']));?></a></li>
									<li><a href="<?php echo $value['log_url']; ?>#comments" class="commentIco"><?php echo $value['comnum']; ?></a></li>
								</ul>
								<div class="shareCont">
									<a href="http://service.weibo.com/share/share.php?url=<?php echo $value['log_url']; ?>&title=<?php echo $value['log_title']; ?>&source=<?php echo $blogname; ?>&sourceUrl=<?php echo BLOG_URL; ?>&content=utf8&searchPic=false" target="_blank"><img src="<?php echo TEMPLATE_URL;?>assets/images/shareIco_sina.png"></a>
									
									<a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo $value['log_url']; ?>&title=<?php echo $value['log_title']; ?>&desc=<?=$logdes?>&summary=<?=$logdes?>&site=<?php echo BLOG_URL; ?>&pics=<?=getBlogImages($value['content'])[0];?>" target="_blank"><img src="<?php echo TEMPLATE_URL;?>assets/images/shareIco_qzone.png"></a>
									
									<a href="http://connect.qq.com/widget/shareqq/index.html?url=<?php echo $value['log_url']; ?>&title=<?php echo $value['log_title']; ?>&source=<?php echo $blogname; ?>&desc=<?=$logdes?>&pics=<?=getBlogImages($value['content'])[0];?>&summary=<?=$logdes?>" target="_blank"><img src="<?php echo TEMPLATE_URL;?>assets/images/shareIco_qq.png"></a>
									
									<a href="javascript:window.open('https://www.tongleer.com/api/web/?action=qrcode&url=<?php echo $value['log_url']; ?>', 'newwindow', 'height=200, width=200, top=200,left=200 toolbar =no, menubar=no, scrollbars=no, resizable=no, location=no, status=no');" target="_blank"><img src="<?php echo TEMPLATE_URL;?>assets/images/shareIco_wx.png"></a>
									
									<a href="javascript:window.open('https://www.tongleer.com/api/web/?action=qrcode&url=<?php echo $value['log_url']; ?>', 'newwindow', 'height=200, width=200, top=200,left=200 toolbar =no, menubar=no, scrollbars=no, resizable=no, location=no, status=no');"><img src="<?php echo TEMPLATE_URL;?>assets/images/shareIco_friend.png"></a>
									
									<a href="http://widget.renren.com/dialog/share?title=<?php echo $value['log_title']; ?>&resourceUrl=<?php echo $value['log_url']; ?>&srcUrl=<?php echo $value['log_url']; ?>&pic=<?=getBlogImages($value['content'])[0];?>&description=<?=$logdes?>" target="_blank"><img src="<?php echo TEMPLATE_URL;?>assets/images/shareIco_renren.png"></a>
								</div>
							</div>
						</div>
					</div>
					<?php }?>
				</div>
				<div class="pagenavi">
					<?php echo my_page($lognum, $index_lognum, $page, $pageurl); ?>
				</div>
				<?php
			}else{
				?>
				<div class="videoCont">
					<div class="videoList">
						<center>
							<h2>404. Not Found</h2>
							<p>没有找到你要的页面</p>
						</center>
					</div>
				</div>
				<?php
			}
			?>
		</div>
    </div>
    <!--右分区-->
    <?php include View::getView('side');?>
</div>
<?php include View::getView('footer');?>