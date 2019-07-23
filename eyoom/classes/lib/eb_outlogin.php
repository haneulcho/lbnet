<?php

function eb_outlogin($skin_dir='basic') {
	global $config, $member, $g5, $theme, $urlencode, $is_admin, $is_member, $eb, $eyoomer, $levelset;

	if (array_key_exists('mb_nick', $member)) {
		$nick  = cut_str($member['mb_nick'], $config['cf_cut_name']);
	}
	if (array_key_exists('mb_point', $member)) {
		$point = number_format($member['mb_point']);
	}

	if ($is_member) {
		$is_auth = false;
		$sql = " select count(*) as cnt from {$g5['auth_table']} where mb_id = '{$member['mb_id']}' ";
		$row = sql_fetch($sql);
		if ($row['cnt']) {
			$is_auth = true;
		}
		// 오늘 처음 로그인 이라면 로그인 레벨포인트 적용
		if (substr($member['mb_today_login'], 0, 10) != G5_TIME_YMD) {
			// 첫 로그인 이윰 레벨포인트 지급
			$eb->level_point($levelset['login']);
		}
		// 레벨 진행바
		$lvinfo = $eb->eyoom_level_info($member);
	}

	$outlogin_url = login_url($urlencode);
	$outlogin_action_url = G5_HTTPS_BBS_URL.'/login_check.php';

	$outlogin_skin_path = EYOOM_THEME_PATH.'/'.$theme.'/skin_bs/outlogin/'.$skin_dir;

	ob_start();
	if ($is_member) {
		include_once($outlogin_skin_path.'/outlogin.skin.2.php');
	} else {
		include_once($outlogin_skin_path.'/outlogin.skin.1.php');
	}
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}
?>