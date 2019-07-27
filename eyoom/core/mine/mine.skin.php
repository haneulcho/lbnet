<?php
	if (!defined('_GNUBOARD_')) exit;

	// Paging
	$paging = $thema->pg_pages($tpl_name,"?type=$view&amp;page=");

	include_once(EYOOM_THEME_PATH.'/'.$theme.'/skin_bs/mine/'.$eyoom['mine_skin'].'/mine.skin.php');
?>
