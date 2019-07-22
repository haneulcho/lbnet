<?php
	if (!defined('_GNUBOARD_')) exit;

	// 그누 헤더정보 출력
	@include_once(G5_PATH.'/head.sub.php');

	if(!defined('_EYOOM_COMMON_') || $qaconfig) @include EYOOM_PATH.'/common.php';

	if($is_member) {
		// 읽지 않은 쪽지
		$memo_not_read = $eb->get_memo($member['mb_id']);

		// 내글 반응이 음수라면 0 으로 셋팅
		$respond = $eyoomer['respond'];
		if($respond < 0) {
			$respond = 0;
			sql_query("update {$g5['eyoom_member']} set respond = 0 where mb_id='{$member['mb_id']}'");
		}

		// 메뉴설정
		if($eyoom['use_eyoom_menu'] == 'y') $menu_flag = 'eyoom';
		$menu = $thema->menu_create($menu_flag);
	
		// 서브페이지 메뉴정보, 타이틀 및 Path 정보
		if(!defined('_INDEX_'))	{
			$subinfo = $thema->subpage_info($menu);
			if($subinfo['registed'] == 'y') $sidemenu = $thema->submenu_create($menu_flag);
		} else {
			// 팝업창  
			// if($eyoom['use_gnu_newwin'] == 'n') {
			// 	@include_once(EYOOM_CORE_PATH.'/newwin/newwin.inc.php');
			// } else {
			// 	@include_once(G5_BBS_PATH.'/newwin.inc.php');
			// }
		}
		if ($is_admin) {
			// 접속자 정보
			$connect = $eb->get_connect();
		}
	} else {
		// 비회원인 경우 서브페이지 메뉴정보, 타이틀 및 Path만 불러오기
		if(!defined('_INDEX_'))	{
			$subinfo = $thema->subpage_info($menu);
		}
	}

	// head 템플릿 출력
	@include_once(EYOOM_THEME_PATH.'/'.$theme.'/layout/head.php');

?>