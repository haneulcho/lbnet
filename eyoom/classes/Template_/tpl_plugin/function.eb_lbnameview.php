<?php

// 회원 레이어
function eb_lbnameview($skin_dir, $wr_id, $mb_id, $name='')
{
	global $config;
	global $g5;
	global $bo_table, $is_admin, $member, $tpl_name, $tpl;

	$head['name'] = get_text($name);

	if ($mb_id) {
		$link['memo'] = G5_BBS_URL."/memo_form.php?mid=".$wr_id;
	}
	if ($is_admin == "super" && $mb_id) {
		$link['info'] = G5_ADMIN_URL."/member_form.php?w=u&amp;mb_id=".$mb_id;
		$link['point'] = G5_ADMIN_URL."/point_list.php?sfl=mb_id&amp;stx=".$mb_id;
	}

	$tpl->define(array(
		'pc' => 'skin_pc/nameview/' . $skin_dir . '/lbnameview.skin.html',
		'mo' => 'skin_mo/nameview/' . $skin_dir . '/lbnameview.skin.html',
		'bs' => 'skin_bs/nameview/' . $skin_dir . '/lbnameview.skin.html',
	));
	$tpl->assign(array(
		"head" => $head,
		"link" => $link,
		"wr_id" => $wr_id,
		"mb_id" => $mb_id,
		"bo_table" => $bo_table,
		"g5" => $g5,
		"is_admin" => $is_admin
	));
	$tpl->print_($tpl_name);
}
