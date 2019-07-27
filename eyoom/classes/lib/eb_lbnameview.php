<?php

// 회원 레이어
function eb_lbnameview($skin_dir, $wr_id, $mb_id, $name='')
{
	global $config;
	global $g5;
	global $bo_table, $is_admin, $member, $theme;

	$head['name'] = get_text($name);

	if ($mb_id) {
		$link['memo'] = G5_BBS_URL."/memo_form.php?mid=".$wr_id;
	}
	if ($is_admin == "super" && $mb_id) {
		$link['info'] = G5_ADMIN_URL."/member_form.php?w=u&amp;mb_id=".$mb_id;
		$link['point'] = G5_ADMIN_URL."/point_list.php?sfl=mb_id&amp;stx=".$mb_id;
	}

	$nameview_skin_path = EYOOM_THEME_PATH.'/'.$theme.'/skin_bs/nameview/'.$skin_dir;

	ob_start();
	include($nameview_skin_path.'/lbnameview.skin.php');
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}
