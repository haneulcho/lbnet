<?php
include_once('./_common.php');
include_once(EYOOM_PATH.'/common.php');

$url = G5_URL;
if (!$is_member) {
  alert('로그인해 주세요.', G5_BBS_URL.'/login.php?url='.urlencode('../bbs/levelup.php'));
} else {
  if ($member['mb_id']) {
    $mb_id = $member['mb_id'];
  } else {
    $msg = '정상적인 방법으로 접근해 주세요.';
  }

  $level_limit = 3;
  $time_limit = 3;
  $next_date = date("Y-m-d H:i:s", strtotime(date($member['mb_email_certify'])." +3 hours"));

  if ($member['mb_level'] >= $level_limit && $member['mb_woman'] == 1) {
    alert('이미 인증된 회원입니다! 환영해요!', $url);
  }
  
  if ($member['mb_woman'] == 3 && (G5_SERVER_TIME - strtotime(date($member['mb_email_certify']))) < (3600 * $time_limit)) {
    alert('질문에 대한 답이 틀렸습니다! 3시간 후 다시 시도해주세요.\n(재시도 가능일자: '.$next_date.')', $url);
  }
}

if ($_POST['ans0'] == '' || $_POST['ans1'] == '') {
  $msg = '답변이 정상적으로 넘어오지 않았습니다.';
}

$qna = array(
  array("ques"=>"로다 사이트 상단 대분류(알림공간 ~ 부가메뉴) 개수는? (숫자로만 작성, ex. 3개 (x), 3(o))", "ans"=>"7"),
  array("ques"=>"로다 공포 게시판 1번 게시글(단편 - 채팅)의 게시 날짜는? (년월일 숫자로만 작성, ex. 18년 3월 19일(x), 180319 (o))", "ans"=>"130319"),
  array("ques"=>"로다 알림공간 하위 메뉴와 자유공간 하위 메뉴 개수를 더한 값은? (숫자로만 작성, ex. 11개 (x), 11(o))", "ans"=>"11"),
  array("ques"=>"로다 창작물 게시판 1번 게시글의 제목은? (띄어쓰기 정확하게 제목 그대로 작성)", "ans"=>"달이 떴다고 전화를 주시다니요"),
  array("ques"=>"로다 접속 주소는? (http:// 및 끝 / 제외 작성, ex. http://naver.com (x), naver.com (o))", "ans"=>"roda.kr"),
  array("ques"=>"로다 운영진은 총 몇 명일까? (숫자로만 작성, ex. 3명 (x), 3 (o))", "ans"=>"1"),
  array("ques"=>"로다 상단 다이어리 메뉴의 첫 번째 하위 메뉴는? (띄어쓰기 없이 작성)", "ans"=>"일기장"),
  array("ques"=>"로다 광고홍보 - L업소정보에 등록된 업소 개수는? (숫자로만 작성, ex. 15개 (x), 15(o))", "ans"=>"19")
);

if (isset($_POST['ans0'])) {
  $ans0 = $_POST['ans0'];
}
if (isset($_POST['ans1'])) {
  $ans1 = $_POST['ans1'];
}
if (isset($_POST['ansNum0'])) {
  $realAns0 = $qna[$_POST['ansNum0']]['ans'];
}
if (isset($_POST['ansNum1'])) {
  $realAns1 = $qna[$_POST['ansNum1']]['ans'];
}

if ($ans0 == $realAns0 && $ans1 == $realAns1) {
  if (!$is_admin) {
    sql_query(" update {$g5['member_table']} set mb_name = '익명니니', mb_level = '{$level_limit}', mb_woman = '1', mb_email_certify = '".G5_TIME_YMDHIS."' where mb_id = '{$mb_id}' ");
  }
  $msg = '축하합니다! 기존 회원 인증이 완료되었습니다! :D';
} else {
  if (!$is_admin) {
    sql_query(" update {$g5['member_table']} set mb_woman = '3', mb_email_certify = '".G5_TIME_YMDHIS."' where mb_id = '{$mb_id}' ");
  }
  $msg = '질문에 대한 답이 틀렸습니다! 3시간 후 다시 시도해주세요.';
}

if ($msg) {
  alert($msg, $url);
}
?>
