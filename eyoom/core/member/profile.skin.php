<?php
	if (!defined('_GNUBOARD_')) exit;

	$mb_photo = $eb->mb_photo($mb_id);

	include_once(EYOOM_THEME_PATH.'/'.$theme.'/skin_bs/member/'.$eyoom['member_skin'].'/profile.skin.php');
?>