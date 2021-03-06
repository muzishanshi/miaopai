<?php 
/*
Custom:page_fans
Description:粉丝（用户）页面
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<!--内容分区-->
<div class="box900">
    <!--左分区-->
    <div class="contentLeft">
        <!--顶部分区-->
		<?php include View::getView('info');?>
		<div class="content">
			<div class="videoCont">
				<!--视频列表 (设计图为3条)-->
				<div class="videoList">
					<!--视频URL-->
					<?php
					$matche_content=getVideoCode($log_content);
					if(count($matche_content)!=0){
						if(strpos($matche_content[0][0],'video')&&strpos($matche_content[2][0],'.mp4')===false){
							?>
							<div class="video">
								<div class="MIAOPAI_player" data-scid="<?=basename($matche_content[2][0]);?>" data-img=""></div>
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
									$authorRes = $db->query("SELECT email FROM ".DB_PREFIX."user WHERE uid=".$author);
									$authorRow = $db->fetch_array($authorRes);
									$host = 'https://secure.gravatar.com';
									$url = '/avatar/';
									$size = '50';
									$rating = 'g';
									$hash = md5(strtolower($authorRow["email"]));
									$avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=mm';
									?>
									<a href="javascript:;" class="pic" title="<?=$authorRow["email"];?>"><img src="<?=$avatar;?>"></a>
									<img src="<?php echo TEMPLATE_URL;?>assets/images/v2.png" class='vip'>
								</div>
								<div class="personalData">
									<p class="personalDataNpost">
										<?php echo $log_title; ?>
										<?php editflg($config_admin_dir,$logid,$author); ?>
									</p>
									<p class="personalDataT">
										<span><?php echo gmdate('Y-n-j', $date); ?></span>
										<span class="red">
											<?php blog_author($author); ?>
										</span>
									</p>
								</div>
							</div>
							<div class="viedoAbout">
								<p><?php echo formatContent($log_content);?></p>
								<div class="lists">
								<?php
									$fansRes = $db->query("SELECT * FROM ".DB_PREFIX."user WHERE role='writer' ORDER BY uid DESC LIMIT 0,105");
									if($db->num_rows($fansRes)>0){
										?>
										<div class="link-content">
											<ul>
												<?php
												while ($fansRow = $db->fetch_array($fansRes)) {
													$avatarhost = 'https://secure.gravatar.com';
													$avatarurl = '/avatar/';
													$avatarsize = '50';
													$avatarrating = 'G';
													$avatarhash = md5(strtolower($fansRow["email"]));
													$avatar = $avatarhost . $avatarurl . $avatarhash . '?s=' . $avatarsize . '&r=' . $avatarrating . '&d=mm';
													?>
													<li>
														<a href="<?=$fansRow["email"]?"mailto:".$fansRow["email"]:"javascript:;";?>" rel="friend" title="<?=$fansRow["description"];?>" target="_blank">
															<img src='<?=$avatar;?>' alt='<?=$fansRow["nickname"];?>' />
														</a>
													</li>
													<?php
												}
												?>
											</ul>
										</div>
									<?php
									}
								?>
								</div>
							</div>
						</div>
						<div class="videoIntrBottom">
							<ul class="commentLike">
								<li><a class="slzanpd" href="javascript:;" data-slzanpd="<?php echo $logid;?>" title="喜欢这篇文章就赞一个吧！">觉得很赞 (<?php echo(isset($logData['slzan'])?$logData['slzan']:getnum($logid));?>)</a></li>
								<li><a href="javascript:dashangToggle();">打赏</a></li>
								<div class='shang_box'>
									<span onclick='dashangToggle()' title='关闭' style='float:right;cursor:pointer;'>X</span>
									<div id='sl_shang'>
										<div class='sl_shang'>
											<b>打赏作者</b>
											<ul>
												<li><input type='radio' name='paytype' onclick='opay();return changeItem(0);' checked='checked' />微信</li>
												<li><input type='radio' name='paytype' onclick='opay();return changeItem(1);'  />QQ红包</li>
												<li><input type='radio' name='paytype' onclick='opay();return changeItem(2);'  />支付宝</li>
											</ul>
										</div>
										<div id='sl_shang0'>
											<img src='<?=$config_wxpay_qrcode!=""?$config_wxpay_qrcode:"https://ws3.sinaimg.cn/large/005V7SQ5ly1g0vg645dznj303w03wt8m.jpg";?>' width="150" /><br /><br />用微信扫一扫
										</div>
										<div id='sl_shang1' style='display:none;'>
											<img src='<?=$config_qqpay_qrcode!=""?$config_qqpay_qrcode:"https://ws3.sinaimg.cn/large/005V7SQ5ly1g0vg645dznj303w03wt8m.jpg";?>' width="150" /><br /><br />用QQ扫一扫
										</div>
										<div id='sl_shang2' style='display:none;'>
											<img src='<?=$config_alipay_qrcode!=""?$config_alipay_qrcode:"https://ws3.sinaimg.cn/large/005V7SQ5ly1g0vg645dznj303w03wt8m.jpg";?>' width="150" /><br /><br />用支付宝扫一扫
										</div>
									</div>
								</div>
							</ul>
							<div class="shareCont">
								<a href="http://service.weibo.com/share/share.php?url=<?php echo curPageURL(); ?>&title=<?php echo $log_title; ?>&source=<?php echo $blogname; ?>&sourceUrl=<?php echo BLOG_URL; ?>&content=utf8&searchPic=false" target="_blank"><img src="<?php echo TEMPLATE_URL;?>assets/images/shareIco_sina.png"></a>
								
								<a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo curPageURL(); ?>&title=<?php echo $log_title; ?>&desc=<?=$logdes?>&summary=<?=$logdes?>&site=<?php echo BLOG_URL; ?>&pics=<?=getBlogImages($log_content)[0];?>" target="_blank"><img src="<?php echo TEMPLATE_URL;?>assets/images/shareIco_qzone.png"></a>
								
								<a href="http://connect.qq.com/widget/shareqq/index.html?url=<?php echo curPageURL(); ?>&title=<?php echo $log_title; ?>&source=<?php echo $blogname; ?>&desc=<?=$logdes?>&pics=<?=getBlogImages($log_content)[0];?>&summary=<?=$logdes?>" target="_blank"><img src="<?php echo TEMPLATE_URL;?>assets/images/shareIco_qq.png"></a>
								
								<a href="javascript:window.open('https://www.tongleer.com/api/web/?action=qrcode&url=<?php echo curPageURL(); ?>', 'newwindow', 'height=200, width=200, top=200,left=200 toolbar =no, menubar=no, scrollbars=no, resizable=no, location=no, status=no');" target="_blank"><img src="<?php echo TEMPLATE_URL;?>assets/images/shareIco_wx.png"></a>
								
								<a href="javascript:window.open('https://www.tongleer.com/api/web/?action=qrcode&url=<?php echo curPageURL(); ?>', 'newwindow', 'height=200, width=200, top=200,left=200 toolbar =no, menubar=no, scrollbars=no, resizable=no, location=no, status=no');"><img src="<?php echo TEMPLATE_URL;?>assets/images/shareIco_friend.png"></a>
								
								<a href="http://widget.renren.com/dialog/share?title=<?php echo $log_title; ?>&resourceUrl=<?php echo curPageURL(); ?>&srcUrl=<?php echo curPageURL(); ?>&pic=<?=getBlogImages($log_content)[0];?>&description=<?=$logdes?>" target="_blank"><img src="<?php echo TEMPLATE_URL;?>assets/images/shareIco_renren.png"></a>
							</div>
						</div>
					</div>
					<!--评论-->
					<div class="videoIntr">
						<div class="videoIntrTop">
						<?php blog_comments($comments); ?>
						<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!--右分区-->
    <?php include View::getView('side');?>
</div>
<?php include View::getView('footer');?>