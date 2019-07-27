<?php
	if (!defined('_GNUBOARD_')) exit;

	$delete_str = "";
	if ($w == 'x') $delete_str = "댓";
	if ($w == 'u') $g5['title'] = $delete_str."글 수정";
	else if ($w == 'd' || $w == 'x') $g5['title'] = $delete_str."글 삭제";
	else $g5['title'] = $g5['title'];

	include_once(EYOOM_THEME_PATH.'/'.$theme.'/skin_bs/member/'.$eyoom['member_skin'].'/password.skin.php');
?>