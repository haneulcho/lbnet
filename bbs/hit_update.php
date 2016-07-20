<?php
include_once('./_common.php');

$wr_hit = '';
if (isset($_POST['wr_hit'])) {
    $wr_hit = $_POST['wr_hit'];
}
if ($wr_hit == '') {
    $msg = '<strong>숫자</strong>를 입력하세요.';
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
    sql_query(" update {$bo_table} set wr_hit = '$wr_hit' where wr_id = '$wr_id' ");
    alert('wr_hit 수정이 완료되었습니다.', $url);
?>
