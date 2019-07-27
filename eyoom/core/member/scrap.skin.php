<?php
	if (!defined('_GNUBOARD_')) exit;

	// Paging 
	$paging = $thema->pg_pages($tpl_name,"?$qstr&amp;page=");

	include_once(EYOOM_THEME_PATH.'/'.$theme.'/skin_bs/member/'.$eyoom['member_skin'].'/scrap.skin.php');
?>