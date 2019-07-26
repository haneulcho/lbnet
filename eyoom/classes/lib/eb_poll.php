<?php

function eb_poll($skin_dir='basic', $po_id=false)
{
	global $config, $member, $g5, $theme, $is_admin;

	// 투표번호가 넘어오지 않았다면 가장 큰(최근에 등록한) 투표번호를 얻는다
	if (!$po_id) {
		$row = sql_fetch(" select MAX(po_id) as max_po_id from {$g5['poll_table']} ");
		$po_id = $row['max_po_id'];
	}

	if(!$po_id)
		return;

	$po = sql_fetch(" select * from {$g5['poll_table']} where po_id = '$po_id' ");

	for ($i=1; $i<=9 && $po["po_poll{$i}"]; $i++) {
		$poll[$i]['po_poll'] = $po["po_poll{$i}"];
	}

	$poll_skin_path = EYOOM_THEME_PATH.'/'.$theme.'/skin_bs/poll/'.$skin_dir;

	ob_start();
	include_once ($poll_skin_path.'/poll.skin.php');
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}
?>