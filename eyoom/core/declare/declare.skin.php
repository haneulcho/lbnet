<?php
	if (!defined('_GNUBOARD_')) exit;

	// Paging
	$paging = $thema->pg_pages($tpl_name,$_SERVER['PHP_SELF'].'?&amp;page=');

	include_once(EYOOM_THEME_PATH.'/'.$theme.'/skin_bs/declare/'.$eyoom['declare_skin'].'/declare.skin.php');
?>
