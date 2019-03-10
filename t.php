<?php
/**
 * 微语部分
 */
if (!defined('EMLOG_ROOT')) { exit('error!');}
?>
<style>
#tw .videoIntr .personalDataT .post{ float: right;font-size:12px;line-height:14px;margin:0;}
#tw .videoIntr .r{ margin:5px 0px 0px 40px;color:#666666; border:0; padding:0px;}
#tw .videoIntr .r li{padding:5px 3px 3px;border-bottom: #F7F7F7 1px solid; width:475px}
#tw .videoIntr .r .num{ font-size:16px; font-weight:bold; color:#0079b7;padding:0px 5px; float:left; width:20px;}
#tw .videoIntr .r .name{ padding:0px 0px 0px 0px; font-size:12px; color:#336699;}
#tw .videoIntr .r em a{ font-style:normal;}
#tw .videoIntr .huifu{margin:5px 0px 0px 43px; background:#F5F5F5;border:#CCCCCC solid 1px;text-align:center;display:none;}
#tw .videoIntr .huifu textarea{ margin:5px; width:460px; border:#CCCCCC solid 1px;overflow:auto;}
#tw .videoIntr .huifu input{ margin:0px 5px;}
#tw .videoIntr .huifu div{ text-align:left; padding:0px 5px; text-align:center}
#tw .videoIntr .huifu .text{ width:60px;}
#tw .videoIntr .button_p{border:0;cursor:pointer; _cursor:hand; width:63px; height:25px;}
#tw .tbutton{ font-size:12px;float:none; margin-bottom:3px;}
#tw .tbutton input{ width:90px; border:#CCCCCC solid 1px; }
#tw .tbutton .button_p{border:0;cursor:pointer; _cursor:hand; width:60px; height:25px;}
#tw .tbutton .tinfo{ float:left; }
#tw .msg{ clear:both}
#tw .videoIntr .huifu textarea{background-color:#FFFFFF;}
#tw .videoIntr .huifu input{background-color:#FFFFFF;}
#tw .videoIntr ul{ line-height:0;font-size:0;}
#tw .videoIntr ul li{ font-size:12px; line-height:22px;}
#tw .top{width:650px;}
#tw .videoIntr .r li{width:565px}
#tw .videoIntr .huifu textarea{width:90%;}
#tw .videoIntr li .bttome .post{ font-size:12px;line-height:14px;margin:0; text-align:right; float:none;clear:both; width:610px; background:0; border:0;}
#tw p .t_img{padding: 0 7px;margin: 0 0 0 10px;}
</style>
<!--内容分区-->
<div class="box900">
    <!--左分区-->
    <div class="contentLeft">
        <!--顶部分区-->
		<?php include View::getView('info');?>
		<div class="content" id="tw">
			<?php if (!empty($tws)){?>
				<div class="videoCont">
					<!--视频列表 (设计图为3条)-->
					<?php
					foreach($tws as $value){
						$tid = (int)$value['id'];
						$img = empty($value['img']) ? "" : BLOG_URL.$value['img'];
						?>
						<div class="videoList">
							<!--视频URL-->
							<?php
							if($img){
								?>
								<div class="video">
									<img class="MIAOPAI_player" src="<?=$img;?>" />
								</div>
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
												<span><?php echo $value['date']; ?></span>
												<?php if(Option::get('istreply')=="y"){?>
												<span class="post">
													<a href="javascript:loadr('<?php echo DYNAMIC_BLOGURL; ?>?action=getr&tid=<?php echo $tid;?>','<?php echo $tid;?>');">
														回复(<span id="rn_<?php echo $tid;?>"><?php echo $value['replynum'];?></span>)
													</a>
												</span>
												<?php }?>
											</p>
											<p>
												<ul id="r_<?php echo $tid;?>" class="r"></ul>
												<?php if ($istreply == 'y'):?>
												<div class="huifu" id="rp_<?php echo $tid;?>">
												<textarea id="rtext_<?php echo $tid; ?>"></textarea>
												<div class="tbutton">
													<div class="tinfo" style="display:<?php if(ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER){echo 'none';}?>">
														<p style="float:left;">
															昵&nbsp;&nbsp;&nbsp;&nbsp;称：<input type="text" id="rname_<?php echo $tid; ?>" value="" />
														</p>
														<p style="float:left;">
															<span style="display:<?php if($reply_code == 'n'){echo 'none';}?>">
																验证码：&nbsp;<input type="text" id="rcode_<?php echo $tid; ?>" value="" />
																<img src="<?=BLOG_URL;?>include/lib/checkcode.php?mode=t" />
															</span>
														</p>
													</div>
													<input class="button_p" type="button" onclick="reply('<?php echo DYNAMIC_BLOGURL; ?>index.php?action=reply',<?php echo $tid;?>);" value="回复" /> 
													<div class="msg"><span id="rmsg_<?php echo $tid; ?>" style="color:#FF0000"></span></div>
												</div>
												</div>
												<?php endif;?>
											</p>
										</div>
									</div>
									<div class="viedoAbout">
										<p><?php echo $logdes = formatExcerpt($value['t'], 140);?></p>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<div class="pagenavi">
					<?php echo $pageurl;?>
				</div>
				<?php
			}else{
				?>
				<div class="videoCont">
					<div class="videoList">
						<center>
							<p>此人很懒，还没有写任何动态~</p>
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