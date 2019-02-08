<?php
	if (!defined('_GNUBOARD_')) exit;

	// CSS, JS 캐시 대응 Ver 설정
	$fileDate = date("YmdHis", G5_SERVER_TIME);
	define('G5_CSS_VER', $fileDate);
	define('G5_JS_VER',  $fileDate);

	// 게시판 관리자 여러명 정하기 
	if ($is_member && $board['bo_admin']) {
		$tmpArr= explode(',', $board['bo_admin']);
		if (in_array($member[mb_id], $tmpArr)) {
			$board['bo_admin'] = $member[mb_id];
			$is_admin = 'board';
		}
	}

	// $bo_table 변수가 없는 환경에서 $group 재지정해서 그룹 관리자 불러오기
	if (!$group['gr_admin'] && $member['mb_level'] >= 7) {
		$gr_id = 'leb';
		$group = sql_fetch(" select * from {$g5['group_table']} where gr_id = '$gr_id' ");
	}

	// 그룹 관리자 여러명 정하기 
	if ($is_member && $group['gr_admin']) {
		$tmpArr= explode(',', $group['gr_admin']);
		if (in_array($member[mb_id], $tmpArr)) {
			$group['gr_admin'] = $member[mb_id];
			$is_admin = 'group';
		}
	}
?>