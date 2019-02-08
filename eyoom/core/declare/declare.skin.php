<?php
	if (!defined('_GNUBOARD_')) exit;

	// Paging
	$paging = $thema->pg_pages($tpl_name,$_SERVER['PHP_SELF'].'?&amp;page=');

	// Template define
	$tpl->define_template('declare',$eyoom['declare_skin'],'declare.skin.html');

	@include EYOOM_INC_PATH.'/tpl.assign.php';
	$tpl->print_($tpl_name);
?>
