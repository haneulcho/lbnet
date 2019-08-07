<?php
include_once('./_common.php');
include_once(EYOOM_PATH.'/common.php');

if (!$is_member) {
	alert('로그인해 주세요.', G5_BBS_URL.'/login.php?url='.urlencode(G5_BBS_URL.'/mine.php'));
}

$is_cmt = $_GET['type'] == 'cmt' ? true : false;
$g5['title'] = $is_cmt ? '내가 쓴 댓글' : '내가 쓴 글';
$view = $is_cmt ? 'cmt' : '';
include_once('./_head.php');

$mb_id = substr(preg_replace('#[^a-z0-9_]#i', '', $member['mb_id']), 0, 20);

if ($is_cmt) {
	$sql_common = " wr_id <> wr_parent ";
} else {
	$sql_common = " wr_id = wr_parent ";
}
if ($mb_id) {
	$sql_common .= " and mb_id = '{$mb_id}' ";
}
$sql_order = " order by wr_id desc ";

$g5_search['tables'] = Array();
$g5_search['read_level'] = Array();

$sql = " select bo_table, bo_read_level, bo_subject, bo_mobile_subject from {$g5['board_table']} where bo_use_search = 1 and bo_list_level <= '{$member['mb_level']}' ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++) {
	$g5_search['tables'][] = $row['bo_table'];
	$g5_search['read_level'][] = $row['bo_read_level'];
	$g5_search['bo_subject'][] = $row['bo_subject'];
	$g5_search['bo_mobile_subject'][] = $row['bo_mobile_subject'];
}
 
$total_count = 0;
for ($i=0; $i<count($g5_search['tables']); $i++) {
	$tmp_write_table = $g5['write_prefix'] . $g5_search['tables'][$i];

	$sql = " select wr_id from {$tmp_write_table} where {$sql_common} ";
	$result = sql_query($sql);
	$row['cnt'] = @sql_num_rows($result);

	$total_count += $row['cnt'];
}

// 선택삭제으로 인해 셀합치기가 가변적으로 변함
$colspan = 4;
if ($is_admin) $colspan++;

// $rows = G5_IS_MOBILE ? $config['cf_mobile_page_rows'] : $config['cf_new_rows'];
$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list = array();

for ($i=0; $i<count($g5_search['tables']); $i++) {
	$tmp_write_table = $g5['write_prefix'] . $g5_search['tables'][$i];
	$tmp_bo_table = $g5_search['tables'][$i];
	$tmp_bo_subject = $g5_search['bo_subject'][$i];

	if ($tmp_bo_table == 'love') {
		$sql_union .= " select '{$tmp_bo_table}' as bo_table, '{$tmp_bo_subject}' as bo_subject, wr_id, wr_parent, wr_subject, wr_content, wr_comment, Null as wr_good, mb_id, wr_name, wr_datetime, wr_1 from {$tmp_write_table} where {$sql_common} ";
	} else {
		$sql_union .= " select '{$tmp_bo_table}' as bo_table, '{$tmp_bo_subject}' as bo_subject, wr_id, wr_parent, wr_subject, wr_content, wr_comment, wr_good, mb_id, wr_name, wr_datetime, wr_1 from {$tmp_write_table} where {$sql_common} ";
	}

	if ($i != count($g5_search['tables']) - 1) {
		$sql_union .= " union all ";
	} else {
		$sql_union .= " order by wr_datetime desc ";
	}
}
$sql_union .= " limit {$from_record}, {$rows} ";
$result = sql_query_arrow_union($sql_union);

for ($k=0; $row=sql_fetch_array($result); $k++) {
	$list[$k] = $row;
	if ($row['wr_id'] == $row['wr_parent']) {
		// 일반글
		$list[$k]['wr_subject'] = get_text(cut_str($row['wr_subject'], 80));
		$list[$k]['wr_comment'] = $row['wr_comment'];
		$list[$k]['href'] = './board.php?bo_table='.$row['bo_table'].'&amp;wr_id='.$row['wr_id'];
	} else {
		// 코멘트
		$write_table = $g5['write_prefix'] . $row['bo_table'];
		$comment_link = '#c_'.$row['wr_id'];
		$row2 = sql_fetch(" select wr_subject from {$write_table} where wr_id = '{$row['wr_parent']}' ");

		$list[$k]['wr_subject'] = get_text(cut_str($row2['wr_subject'], 80));
		$list[$k]['wr_content'] = get_text(cut_str($row['wr_content'], 120));
		$list[$k]['href'] = './board.php?bo_table='.$row['bo_table'].'&amp;wr_id='.$row['wr_parent'].$comment_link;
	}

	// 익명/비익명 구분
	list($gnu_level,$eyoom_level,$anonymous) = explode('|',$row['wr_1']);
	if(!$anonymous) {
		$name = $row['wr_name'];
	} else {
		if($anonymous == 'y') {
			$name = '익명';
		}
	}

	// 익명글 제외
	// $level = $newlist[$i]['wr_1'] ? $eb->level_info($newlist[$i]['wr_1']):'';
	// if(is_array($level) && $level['anonymous']) continue;

	$list[$k]['bo_table'] = $row['bo_table'];
	$list[$k]['name'] = $name;
	$list[$k]['wr_good'] = $row['wr_good'];
	$list[$k]['datetime'] = substr($row['wr_datetime'], 2, 17);
	$list[$k]['datetime_mobile'] = substr($row['wr_datetime'], 2, 14);
	$list[$k]['bo_subject'] = cut_str($row['bo_subject'], 20);
	$list[$k]['is_cmt'] = $is_cmt;
	$list[$k]['num'] = $total_count - ($page - 1) * $rows - $i;
	$list[$k]['wr_id']		= $row['wr_id'];
	$list[$k]['comment']	= $row['comment'];
}

include_once($mine_skin_path.'/mine.skin.php');

include_once('./_tail.php');
?>
