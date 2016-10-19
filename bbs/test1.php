<?php
include_once('./_common.php');

$wr_content = $_POST['wr_content'];
//$wr_content = mb_convert_encoding($_POST['wr_content'], "UTF-8", "ASCII");

$sql = " insert into g5_write_free
            set wr_num = '89',
                 wr_reply = '',
                 wr_comment = 1,
                 ca_name = '',
                 wr_option = '',
                 wr_subject = '',
                 wr_content = '$wr_content',
                 wr_link1 = '',
                 wr_link2 = '',
                 wr_link1_hit = 0,
                 wr_link2_hit = 0,
                 wr_hit = 0,
                 wr_good = 0,
                 wr_nogood = 0,
                 mb_id = 'te',
                 wr_password = 't',
                 wr_name = 'ss',
                 wr_email = 'ss',
                 wr_homepage = '',
                 wr_datetime = '".G5_TIME_YMDHIS."',
                 wr_last = '".G5_TIME_YMDHIS."',
                 wr_ip = '{$_SERVER['REMOTE_ADDR']}',
                 wr_1 = '',
                 wr_2 = '',
                 wr_3 = '',
                 wr_4 = '',
                 wr_5 = '',
                 wr_6 = '',
                 wr_7 = '',
                 wr_8 = '',
                 wr_9 = '',
                 wr_10 = '' ";
sql_query($sql);
?>
