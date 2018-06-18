<?php
include_once('./_common.php');
include_once(EYOOM_PATH.'/common.php');

if (!$is_member) {
  alert('로그인해 주세요.', G5_BBS_URL.'/login.php?url='.urlencode('../bbs/levelup.php'));
}

if (!$is_admin) {
  $level_limit = 3;
  $time_limit = 3;
  $next_date = date("Y-m-d H:i:s", strtotime(date($member['mb_email_certify'])." +3 hours"));

  if ($member['mb_level'] >= $level_limit || $member['mb_woman'] == 1) {
    alert('이미 인증된 회원입니다! 환영해요!');
  }
  if ($member['mb_woman'] == 3 && $member['mb_email_certify'] > date("Y-m-d", G5_SERVER_TIME - (86400 / $time_limit))) {
    alert('질문에 대한 답이 틀렸습니다! 3시간 후 다시 시도해주세요.\n(재시도 가능일자: '.$next_date.')');
  }
  // $mb_cnt = sql_fetch(" select count(mb_id) as cnt from {$g5['member_table']} where mb_woman=3 and mb_id = '{$member['mb_id']}' ");
  // if ($mb_cnt['cnt']) {
  //   alert("기존 회원 등업 신청은 한 번만 할 수 있습니다!");
  // }
}

    // sql_query(" insert into {$g5['member_table']} set mb_id = '{$mb_id}', mb_password = '".get_encrypt_string($mb_password)."', mb_datetime = '".G5_TIME_YMDHIS."', mb_ip = '{$_SERVER['REMOTE_ADDR']}', mb_email_certify = '".G5_TIME_YMDHIS."', {$sql_common} ");


// 불법접근을 막도록 토큰생성
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);
set_session("ss_cert_no",   "");
set_session("ss_cert_hash", "");
set_session("ss_cert_type", "");

$g5['title'] = '기존 회원 등업 (~ 2018.06.31 까지)';
include_once('./_head.php');

include_once($levelup_skin_path.'/levelup.skin.php');

include_once('./_tail.php');

?>
