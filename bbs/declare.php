<?php
include_once('./_common.php');
include_once(EYOOM_PATH.'/common.php');

if (!$is_member) {
	alert('로그인해 주세요.', G5_BBS_URL.'/login.php?url='.urlencode(G5_BBS_URL.'/mine.php'));
} else {
	if (!$is_admin) {
		alert('잘못된 접근을 통한 정보 탈취는 불법입니다. \n3회 이상 시도시 법적 처벌을 받을 수 있습니다!', G5_URL);
	}
}

$g5['title'] = '신고/블라인드';
include_once('./_head.php');

$mb_id = substr(preg_replace('#[^a-z0-9_]#i', '', $member['mb_id']), 0, 20);
$sql_common = " from {$g5['eyoom_yellowcard']} order by yc_id desc ";

$sql = " select count(*) as cnt {$sql_common} ";
$row = sql_fetch($sql, false);
$total_count = $row['cnt'];

$rows = $config['cf_new_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list = array();
$sql = " select * {$sql_common} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++) {
	$tmp_write_table = $g5['write_prefix'] . $row['bo_table'];
	$list[$i] = $row;
	$row2 = sql_fetch(" select bo_subject from {$g5['board_table']} where bo_table = '{$row['bo_table']}' ", false);
	$row3 = sql_fetch(" select wr_subject, mb_id from {$tmp_write_table} where wr_id = {$row['pr_id']}", false);
	$list[$i]['bo_subject'] = $row2['bo_subject'];
	$list[$i]['wr_subject'] = $row3['wr_subject'];

	if ($row['wr_id'] == $row['pr_id']) {
		// 일반글
		$list[$i]['is_cmt'] = false;
		$list[$i]['href'] = './board.php?bo_table='.$row['bo_table'].'&amp;wr_id='.$row['pr_id'];
		$list[$i]['yc_pr_id'] = $row3['mb_id'];
	} else {
		// 코멘트
		$row4 = sql_fetch(" select wr_content, mb_id from {$tmp_write_table} where wr_id = {$row['wr_id']}", false);
		$list[$i]['is_cmt'] = true;
		$comment_link = '#c_'.$row['wr_id'];
		$list[$i]['href'] = './board.php?bo_table='.$row['bo_table'].'&amp;wr_id='.$row['pr_id'].$comment_link;
		$list[$i]['wr_content'] = $row4['wr_content'];
		$list[$i]['yc_pr_id'] = $row4['mb_id'];
	}

	$list[$i]['bo_table'] = $row['bo_table'];
	$list[$i]['yc_id'] = $row['mb_id'];
	$list[$i]['yc_datetime'] = substr($row['yc_datetime'], 2, 17);
	$list[$i]['yc_datetime_mobile'] = substr($row['yc_datetime'], 2, 14);
	$list[$i]['yc_memo'] = $row['yc_memo'];
	$list[$i]['is_blind'] = ($row['yc_reason'] == 'd') ? true : false;
	$list[$i]['is_delected'] = (!$list[$i]['yc_pr_id']) ? true : false;
	
	switch ($row['yc_reason']) {
		case '1': $list[$i]['yc_reason'] = '광고성'; break;
		case '2': $list[$i]['yc_reason'] = '음란성'; break;
		case '3': $list[$i]['yc_reason'] = '비방성'; break;
		case '4': $list[$i]['yc_reason'] = '혐오성'; break;
		case '5': $list[$i]['yc_reason'] = '기타'; break;
		default: $list[$i]['yc_reason'] = '기타'; break;
	}
}

include_once($declare_skin_path.'/declare.skin.php');
include_once('./_tail.php');
?>
