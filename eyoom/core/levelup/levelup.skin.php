<?php
	if (!defined('_GNUBOARD_')) exit;

	// 선택삭제으로 인해 셀합치기가 가변적으로 변함
	$colspan = 4;

	if ($is_admin) $colspan++;

	// 그룹정보 가져오기
	$sel_group = $eb->get_group();

	// 사용자 프로그램
	@include_once(EYOOM_USER_PATH.'/levelup/levelup.skin.php');

	// Template define
	$tpl->define_template('levelup',$eyoom['levelup_skin'],'levelup.skin.html');

	@include EYOOM_INC_PATH.'/tpl.assign.php';
	$tpl->print_($tpl_name);

?>
