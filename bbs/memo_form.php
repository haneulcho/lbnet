<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

if ($is_guest)
    alert_close('회원만 이용하실 수 있습니다.');

// if (!$member['mb_open'] && $is_admin != 'super' && $member['mb_id'] != $mb_id)
//     alert_close("자신의 정보를 공개하지 않으면 다른분에게 쪽지를 보낼 수 없습니다. 정보공개 설정은 회원정보수정에서 하실 수 있습니다.");

$content = "";
// 탈퇴한 회원에게 쪽지 보낼 수 없음
if($me_id) {
    // 4.00.15
    $row = sql_fetch(" select * from {$g5['memo_table']} where me_id = '{$me_id}' and me_recv_mb_id = '{$member['mb_id']}' ");

    // 내가 받은 쪽지가 아니면 확인 못하게
    if(!isset($row) && $is_admin != 'super') {
      alert_close ('잘못된 접근입니다');
    } else {
      // 받는 사람 아이디
      // 레볼루션에서는 쪽지 발송시 받는 상대방 아이디를 노출하면 안됨
      // 따라서 get 변수 없이 me_id로 memo 테이블에 쿼리 날려서 me_recv_mb_id를 직접 db에서 받아옴
      $me_send_mb_id = $row['me_recv_mb_id'];
      $me_recv_mb_id = $row['me_send_mb_id'];

      $mb = get_member($me_recv_mb_id);

      if (!$mb['mb_id'])
          alert_close('회원정보가 존재하지 않습니다.\\n\\n탈퇴한 회원일 수 있습니다.');

      // 받는 사람이 정보공개 안할 시 쪽지 보낼 수 없도록
      // if (!$mb['mb_open'] && $is_admin != 'super')
      //     alert_close('정보공개를 하지 않았습니다.');

      // 원본 쪽지 내용
      if ($row['me_memo'])
      {
          $content = str_replace("\n", "\n> ", get_text($row['me_memo'], 0));
      }
    }
}

$g5['title'] = '쪽지 보내기';
include_once(G5_PATH.'/head.sub.php');

$memo_action_url = G5_HTTPS_BBS_URL."/memo_form_update.php";
include_once($member_skin_path.'/memo_form.skin.php');

include_once(G5_PATH.'/tail.sub.php');
?>
