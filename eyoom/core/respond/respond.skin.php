<?php
	if (!defined('_GNUBOARD_')) exit;

	// Paging
	$paging = $thema->pg_pages($tpl_name,"respond.php?chk=$chk&amp;type=$type&amp;page=");

	include_once(EYOOM_THEME_PATH.'/'.$theme.'/skin_bs/respond/'.$eyoom['respond_skin'].'/respond.skin.php');
?>