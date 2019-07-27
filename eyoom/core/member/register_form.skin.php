<?php 
	if (!defined('_GNUBOARD_')) exit;

	if(isset($member['mb_open_date'])) {
		$open_day = date("Y년 m월 j일", strtotime("{$member['mb_open_date']} 00:00:00")+$config['cf_open_modify']*86400);
	} else {
		$open_day = date("Y년 m월 j일", G5_SERVER_TIME+$config['cf_open_modify']*86400);
	}

	include_once(EYOOM_THEME_PATH.'/'.$theme.'/skin_bs/member/'.$eyoom['member_skin'].'/register_form.skin.php');
?>