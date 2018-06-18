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

$sql_common = " from {$g5['board_new_table']} a, {$g5['board_table']} b where a.bo_table = b.bo_table ";

if ($is_cmt)
  $sql_common .= " and a.wr_id <> a.wr_parent ";
else
  $sql_common .= " and a.wr_id = a.wr_parent ";

$mb_id = substr(preg_replace('#[^a-z0-9_]#i', '', $member['mb_id']), 0, 20);

if ($mb_id) {
    $sql_common .= " and a.mb_id = '{$mb_id}' ";
}
$sql_order = " order by a.bn_id desc ";

$sql = " select count(*) as cnt {$sql_common} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

// $rows = G5_IS_MOBILE ? $config['cf_mobile_page_rows'] : $config['cf_new_rows'];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list = array();
$sql = " select a.*, b.bo_subject, b.bo_mobile_subject {$sql_common} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $tmp_write_table = $g5['write_prefix'].$row['bo_table'];

    if ($row['wr_id'] == $row['wr_parent']) {

        // 원글
        $comment_link = "";
        $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");
        $list[$i] = $row2;

        // 익명/비익명 구분
        list($gnu_level,$eyoom_level,$anonymous) = explode('|',$row2['wr_1']);
        if(!$anonymous) {
          $name = $row2['wr_name'];
        } else {
          if($anonymous == 'y') {
            $name = '익명';
          }
        }

        // 당일인 경우 시간으로 표시함
        $datetime = substr($row2['wr_datetime'],0,10);
        $datetime2 = $row2['wr_datetime'];
        if ($datetime == G5_TIME_YMD) {
            $datetime2 = substr($datetime2,11,5);
        } else {
            $datetime2 = substr($datetime2,0,10);
        }

    } else {

        // 코멘트
        $comment_link = '#c_'.$row['wr_id'];
        $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_parent']}' ");
        $row3 = sql_fetch(" select mb_id, wr_name, wr_email, wr_homepage, wr_content, wr_datetime, wr_1 from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");
        $list[$i] = $row2;
        $list[$i]['wr_id'] = $row['wr_id'];
        $list[$i]['mb_id'] = $row3['mb_id'];
        $list[$i]['wr_name'] = $row3['wr_name'];
        $list[$i]['wr_email'] = $row3['wr_email'];
        $list[$i]['wr_homepage'] = $row3['wr_homepage'];
        $list[$i]['wr_content'] = $row3['wr_content'];

        // 익명/비익명 구분
        list($gnu_level,$eyoom_level,$anonymous) = explode('|',$row3['wr_1']);
        if(!$anonymous) {
          $name = $row3['wr_name'];
        } else {
          if($anonymous == 'y') {
            $name = '익명';
          }
        }

        // 당일인 경우 시간으로 표시함
        $datetime = substr($row3['wr_datetime'],0,10);
        $datetime2 = $row3['wr_datetime'];
        if ($datetime == G5_TIME_YMD) {
            $datetime2 = substr($datetime2,11,5);
        } else {
            $datetime2 = substr($datetime2,0,10);
        }

    }

    $list[$i]['bo_table'] = $row['bo_table'];
    $list[$i]['name'] = $name;
    $list[$i]['href'] = './board.php?bo_table='.$row['bo_table'].'&amp;wr_id='.$row2['wr_id'].$comment_link;
    $list[$i]['datetime'] = $datetime;
    $list[$i]['datetime2'] = $datetime2;

    $list[$i]['bo_subject'] = ((G5_IS_MOBILE && $row['bo_mobile_subject']) ? $row['bo_mobile_subject'] : $row['bo_subject']);
    $list[$i]['wr_subject'] = $row2['wr_subject'];
    $list[$i]['is_cmt'] = $is_cmt;
}

include_once($mine_skin_path.'/mine.skin.php');

include_once('./_tail.php');

?>
