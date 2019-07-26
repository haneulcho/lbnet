<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

	// PC/모바일 링크 생성
	$href = $thema->get_href($tpl_name);

	// tail 템플릿 출력
	@include_once(EYOOM_THEME_PATH.'/'.$theme.'/layout/tail.php');

	// tail_sub 템플릿 출력
	@include_once(EYOOM_THEME_PATH.'/'.$theme.'/layout/tail_sub.php');
?>