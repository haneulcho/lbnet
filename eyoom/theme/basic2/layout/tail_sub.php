<?php if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 ?>
<?php
	if ($config['cf_analytics']) {
		echo $config['cf_analytics'];
	}
?>
<?php if ($is_admin ==' super'){ ?><!-- <div style='float:left; text-align:center;'>RUN TIME : <?php echo get_microtime()-$begin_time ?><br></div> --><?php } ?>
</body>
</html>
<?php echo html_end(); exit; ?>
