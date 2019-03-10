<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<!--页脚-->
<div class="footer">
    <ul class="footerNav">
        <li><a href="<?=$config_github_url!=""?$config_github_url:"javascript:;";?>" target="_blank"><?=$config_github!=""?$config_github:"Github";?></a></li>
        <li>
            <div class="ewm_img">
                <img src="<?=$config_qq_qrcode!=""?$config_qq_qrcode:"https://ws3.sinaimg.cn/large/005V7SQ5ly1g0vcv2g89yj305k05k3yu.jpg";?>" class="pic_ewm">
            </div>
            <a href="javascript:;" class="miaopai_ewm"><?=$config_qq!=""?$config_qq:"QQ";?></a>
        </li>
        <li>
            <div class="ewm_img">
                <img src="<?=$config_weixin_qrcode!=""?$config_weixin_qrcode:"https://ws3.sinaimg.cn/large/005V7SQ5ly1g0vcv2g89yj305k05k3yu.jpg";?>" class="pic_ewm">
            </div>
            <a href="javascript:;" class="miaopai_ewm"><?=$config_weixin!=""?$config_weixin:"微信";?></a>
        </li>
    </ul>
	<p><?=$config_custom;?></p>
    <p>
		CopyRight©<?=date("Y");?> <a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a> Powered by <a href="http://www.emlog.net/" title="Emlog" rel="nofollow">Emlog</a> Theme By <a href="http://www.tongleer.com" title="同乐儿">Tongleer</a>
	</p>
    <div style="width:300px;margin:0 auto; padding:15px 0 0 0;">
        <a target="_blank" href="http://www.miibeian.gov.cn" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;">
            <img src="<?php echo TEMPLATE_URL;?>assets/images/ba.png" style="float:left;"/>
            <p style="float:left;height:20px;line-height:20px;margin: 0px 0px 0px 5px; color:#9A8202;clear: none;">
				<?php echo $icp; ?>
			</p>
        </a>
		<?php echo $footer_info; ?>
    </div>
	<?php doAction('index_footer'); ?>
</div>
<?php
if ($config_is_pjax=="y"){
	include("assets/js/pjax.js.php");
}
include("assets/js/function.js.php");
?>
</body>
</html>