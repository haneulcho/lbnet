<?php
	if (!defined('_GNUBOARD_')) exit;

	$nick = get_sideview($mb['mb_id'], $mb['mb_nick'], $mb['mb_email'], $mb['mb_homepage']);
	if($kind == "recv") {
		$kind_str = "보낸";
		$kind_date = "받은";
	}
	else {
		$kind_str = "받는";
		$kind_date = "보낸";
	}

	include_once(EYOOM_THEME_PATH.'/'.$theme.'/skin_bs/member/'.$eyoom['member_skin'].'/memo_view.skin.php');
?>