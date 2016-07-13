<?php
$sub_menu = '800300';
include_once('./_common.php');
include_once(EYOOM_PATH.'/common.php');

auth_check($auth[$sub_menu], 'r');

$theme = get_text($_POST['theme']);
$target = get_text($_POST['target']);
$me_shop = get_text($_POST['me_shop']);
if(!$theme) exit;
if(!$target) exit;
if(!$me_shop) exit;

$sql = "delete from {$g5['eyoom_menu']} where me_theme = '{$target}' and me_shop = '{$me_shop}'";
sql_query($sql, false);

$sql = "select * from {$g5['eyoom_menu']} where (1) and me_theme = '{$theme}' and me_shop = '{$me_shop}' order by me_code asc";
$res = sql_query($sql, false);
for($i=0; $row=sql_fetch_array($res); $i++) {
	unset($set, $insert);
	$set = "
		me_theme 		= '" . $target . "', 
		me_code 		= '" . $row['me_code'] . "',
		me_name			= '" . $row['me_name'] . "',
		me_icon			= '" . $row['me_icon'] . "',
		me_shop			= '" . $row['me_shop'] . "',
		me_path			= '" . $row['me_path'] . "',
		me_type			= '" . $row['me_type'] . "',
		me_pid			= '" . $row['me_pid'] . "',
		me_link			= '" . $row['me_link'] . "',
		me_target		= '" . $row['me_target'] . "',
		me_order		= '" . $row['me_order'] . "',
		me_permit_level	= '" . $row['me_permit_level'] . "',
		me_side			= '" . $row['me_side'] . "',
		me_use			= '" . $row['me_use'] . "',
		me_use_nav		= '" . $row['me_use_nav'] . "'
	";
	
	$insert = "insert into {$g5['eyoom_menu']} set {$set}";
	sql_query($insert, false);
}

$_value_array = array();
$_value_array['menu_clone'] = 'ok';

include_once EYOOM_CLASS_PATH."/json.class.php";

$json = new Services_JSON();
$output = $json->encode($_value_array);

echo $output;

?>