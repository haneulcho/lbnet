<?php
include_once('./_common.php');
include_once(EYOOM_PATH.'/common.php');

$mb_id = '';
if (isset($_POST['mb_id']) && $is_admin) {
    $mb_id = $_POST['mb_id'];
    $admin_id = $member['mb_id'];
    $level_limit = 3;
}
if ($mb_id == '') {
    $msg = '오류가 발생하였습니다! 아이디 값이 정상적으로 넘어오지 않았습니다.';
}
if (isset($_POST['bo_table'])) {
    $bo_table = 'g5_write_'.$_POST['bo_table'];
}
if (isset($_POST['wr_id'])) {
    $wr_id = $_POST['wr_id'];
}

if ($msg) {
    alert($msg);
}

$url = G5_HTTP_BBS_URL.'/board.php?bo_table='.$_POST['bo_table'].'&amp;wr_id='.$wr_id;
if ($is_admin) {
    sql_query(" update {$g5['member_table']} set mb_name = '익명니니', mb_memo = '등업운영진: ".$admin_id."', mb_level = '{$level_limit}', mb_woman = '1', mb_email_certify = '".G5_TIME_YMDHIS."' where mb_id = '{$mb_id}' ");
    sql_query(" update {$bo_table} set ca_name = '완료' where wr_id = '$wr_id' ");
}
    alert('등업이 완료되었습니다. 아이디: '.$mb_id, $url);
?>
