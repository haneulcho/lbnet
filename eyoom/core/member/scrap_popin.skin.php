<?php
	if (!defined('_GNUBOARD_')) exit;

	$subject = get_text(cut_str($write['wr_subject'], 255));

	include_once(EYOOM_THEME_PATH.'/'.$theme.'/skin_bs/member/'.$eyoom['member_skin'].'/scrap_popin.skin.php');
?>