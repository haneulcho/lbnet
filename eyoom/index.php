<?php
	if (!defined('_GNUBOARD_')) exit;

	// 메인주소를 쇼핑몰로 사용
	if(isset($default['de_root_index_use']) && $default['de_root_index_use']) {
		@include_once(EYOOM_CORE_PATH.'/shop/index.php');
		return;
	}

	// 이윰 헤더 디자인 출력
	@include_once(EYOOM_PATH.'/head.php');

	$eb->print_page();

	// 이윰 테일 디자인 출력
	@include_once(EYOOM_PATH.'/tail.php');
?>