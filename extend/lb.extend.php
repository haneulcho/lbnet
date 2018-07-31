<?php
	if (!defined('_GNUBOARD_')) exit;

	// 게시판 관리자 여러명 정하기 
	if ($is_member && $board['bo_admin']) {
		$tmpArr= explode(',', $board['bo_admin']);
		if (in_array($member[mb_id], $tmpArr)) {
			$board['bo_admin'] = $member[mb_id];
			$is_admin = 'board';
		}
	}

	//그룹 관리자 여러명 정하기 
	if ($is_member && $group['gr_admin']) {
		$tmpArr= explode(',', $group['gr_admin']);
		if (in_array($member[mb_id], $tmpArr)) {
			$group['gr_admin'] = $member[mb_id];
			$is_admin = 'group';
		}
	}
?>