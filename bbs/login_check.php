<?php
include_once('./_common.php');

$g5['title'] = "로그인 검사";

$mb_id       = trim($_POST['mb_id']);
$mb_password = trim($_POST['mb_password']);

if (!$mb_id || !$mb_password)
    alert('회원아이디나 비밀번호가 공백이면 안됩니다.');

$mb = get_member($mb_id);

// 가입된 회원이 아니다. 비밀번호가 틀리다. 라는 메세지를 따로 보여주지 않는 이유는
// 회원아이디를 입력해 보고 맞으면 또 비밀번호를 입력해보는 경우를 방지하기 위해서입니다.
// 불법사용자의 경우 회원아이디가 틀린지, 비밀번호가 틀린지를 알기까지는 많은 시간이 소요되기 때문입니다.
if (!$mb['mb_id'] || !check_password($mb_password, $mb['mb_password'])) {
    // 회원 아이디로 로그인 실패 시 g5_login_data 테이블에 실패 기록 삽입
	if($mb['mb_id']) {
		$sql = " insert into {$g5['login_data_table']}
                set mb_id = '{$mb['mb_id']}',
                    mb_ip = '{$_SERVER['REMOTE_ADDR']}',
                    lg_time = '".G5_TIME_YMDHIS."',
                    lg_success = '0' ";
        sql_query($sql);
    }
    
    // 최근 7일 내 같은 아이디, 같은 아이피로 10회 이상 로그인 실패 시 해당 회원 및 관리자에게 로그인 실패 쪽지 발송
    $period = 7;
    $start = date("YmdHis", strtotime("-".$period." day"));
    $end = date("YmdHis");
    $sql2 = " select count(*) as cnt from {$g5['login_data_table']}
            where mb_id = '{$mb['mb_id']}'
            and mb_ip = '{$_SERVER['REMOTE_ADDR']}'
            and lg_time between date_format(".$start.", '%Y-%m-%d 00:00:00') and date_format(".$end.", '%Y-%m-%d 23:59:59')
            and lg_success = '0' ";
    $row = sql_fetch($sql2);

    if ($row['cnt'] && $row['cnt'] > 9) {
        $send_mb_id = 'lebolution';
        $member_list = array();
        $member_list['id'][] = $send_mb_id;
        $member_list['id'][] = $mb['mb_id'];
        $me_memo = '최근 7일 내 회원님의 아이디로 동일 IP 10회 이상 로그인 실패 기록이 발견 되어 보내드리는 보안 알림 쪽지입니다.\\n아래 로그인 실패 기록을 확인하신 후, 본인이 접속한 것이 아니라면 운영자에게 말씀 주세요.\\n\\n접근 시도 아이피: '.$_SERVER['REMOTE_ADDR'].'\\n로그인 실패일자:\\n';

        $sql3 = " select * from {$g5['login_data_table']}
                where mb_id = '{$mb['mb_id']}'
                and mb_ip = '{$_SERVER['REMOTE_ADDR']}'
                and lg_time between date_format(".$start.", '%Y-%m-%d 00:00:00') and date_format(".$end.", '%Y-%m-%d 23:59:59')
                and lg_success = '0' ";
        $memo = sql_query($sql3, false);
        for($i=0; $row=sql_fetch_array($memo); $i++) {
            $me_memo .= $row['lg_time'].'\\n';
        }

        for ($i=0; $i<count($member_list['id']); $i++) {
            $tmp_row = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
            $me_id = $tmp_row['max_me_id'] + 1;
            $recv_mb_id   = $member_list['id'][$i];

            // 쪽지 INSERT
            $sql = " insert into {$g5['memo_table']} ( me_id, me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo ) values ( '$me_id', '$recv_mb_id', '$send_mb_id', '".G5_TIME_YMDHIS."', '$me_memo' ) ";
            sql_query($sql);
        
            // 실시간 쪽지 알림 기능
            $sql = " update {$g5['member_table']} set mb_memo_call = '$send_mb_id' where mb_id = '$recv_mb_id' ";
            sql_query($sql);
        }
        alert('10회 이상 로그인 실패! 해당 회원에게 로그인 기록을 전송합니다.\\nIP 차단 대상이 될 수 있으니 주의하시기 바랍니다.');
    } else {
        alert('가입된 회원아이디가 아니거나 비밀번호가 틀립니다.\\n비밀번호는 대소문자를 구분합니다.');
    }
}

// 차단된 아이디인가?
if ($mb['mb_intercept_date'] && $mb['mb_intercept_date'] <= date("Ymd", G5_SERVER_TIME)) {
    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_intercept_date']);
    alert('회원님의 아이디는 접근이 금지되어 있습니다.\n처리일 : '.$date);
}

// 탈퇴한 아이디인가?
if ($mb['mb_leave_date'] && $mb['mb_leave_date'] <= date("Ymd", G5_SERVER_TIME)) {
    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_leave_date']);
    alert('탈퇴한 아이디이므로 접근하실 수 없습니다.\n탈퇴일 : '.$date);
}

if ($config['cf_use_email_certify'] && !preg_match("/[1-9]/", $mb['mb_email_certify'])) {
    $ckey = md5($mb['mb_ip'].$mb['mb_datetime']);
    confirm("{$mb['mb_email']} 메일로 메일인증을 받으셔야 로그인 가능합니다. 다른 메일주소로 변경하여 인증하시려면 취소를 클릭하시기 바랍니다.", G5_URL, G5_BBS_URL.'/register_email.php?mb_id='.$mb_id.'&ckey='.$ckey);
}

@include_once($member_skin_path.'/login_check.skin.php');

// 회원아이디 세션 생성
set_session('ss_mb_id', $mb['mb_id']);
// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

// 포인트 체크
if($config['cf_use_point']) {
    $sum_point = get_point_sum($mb['mb_id']);

    $sql= " update {$g5['member_table']} set mb_point = '$sum_point' where mb_id = '{$mb['mb_id']}' ";
    sql_query($sql);
}

// 3.26
// 아이디 쿠키에 한달간 저장
if ($auto_login) {
    // 3.27
    // 자동로그인 ---------------------------
    // 쿠키 한달간 저장
    $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
    set_cookie('ck_mb_id', $mb['mb_id'], 86400 * 31);
    set_cookie('ck_auto', $key, 86400 * 31);
    // 자동로그인 end ---------------------------
} else {
    set_cookie('ck_mb_id', '', 0);
    set_cookie('ck_auto', '', 0);
}

if ($url) {
    // url 체크
    check_url_host($url);

    $link = urldecode($url);
    // 2003-06-14 추가 (다른 변수들을 넘겨주기 위함)
    if (preg_match("/\?/", $link))
        $split= "&amp;";
    else
        $split= "?";

    // $_POST 배열변수에서 아래의 이름을 가지지 않은 것만 넘김
    foreach($_POST as $key=>$value) {
        if ($key != 'mb_id' && $key != 'mb_password' && $key != 'x' && $key != 'y' && $key != 'url') {
            $link .= "$split$key=$value";
            $split = "&amp;";
        }
    }
} else  {
    $link = G5_URL;
}

goto_url($link);
?>
