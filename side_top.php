<?php
/**
 * 侧边栏顶部
 */
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
<div class="downLoadText">
	<form method="get" action="<?php echo BLOG_URL; ?>index.php">
		<input type="text" name="keyword" placeholder="输入关键字按回车键搜索" />
	</form>
</div>
