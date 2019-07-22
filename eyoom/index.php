<?php
	if (!defined('_GNUBOARD_')) exit;

	// 이윰 헤더 디자인 출력
	@include_once(EYOOM_PATH.'/head.php');

	// 인덱스 테마 출력
	@include_once(EYOOM_THEME_PATH.'/'.$theme.'/layout/main.php');

	// 이윰 테일 디자인 출력
	@include_once(EYOOM_PATH.'/tail.php');
?>