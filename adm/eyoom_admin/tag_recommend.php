<?php
$sub_menu = "800600";
include_once('./_common.php');
include_once(EYOOM_PATH.'/common.php');

auth_check($auth[$sub_menu], 'r');

$tg_id = $_POST['id'];
$tg_recommend = $_POST['yn'];
if(!$tg_id) exit;

$tg_recommdt = $tg_recommend == 'y' ? G5_TIME_YMDHIS : '0000-00-00 00:00:00';

$sql = "update {$g5['eyoom_tag']} set tg_recommdt = '{$tg_recommdt}' where tg_id = '{$tg_id}'";
sql_query($sql);

$_value_array = array();
$_value_array['recommdt'] = $tg_recommdt;

include_once EYOOM_CLASS_PATH."/json.class.php";

$json = new Services_JSON();
$output = $json->encode($_value_array);

echo $output;

?>