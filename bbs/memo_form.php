<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

if ($is_guest)
	alert_close('회원만 이용하실 수 있습니다.');

// if (!$member['mb_open'] && $is_admin != 'super' && $member['mb_id'] != $mb_id)
//     alert_close("자신의 정보를 공개하지 않으면 다른분에게 쪽지를 보낼 수 없습니다. 정보공개 설정은 회원정보수정에서 하실 수 있습니다.");

$content = "";
// 그룹 관리자, 전체 운영진 목록 가져오기
$group = sql_fetch(" select gr_admin from {$g5['group_table']} where gr_id = 'leb' ");
$tmpArr= explode(',', $group['gr_admin']);

// 탈퇴한 회원에게 쪽지 보낼 수 없음
if ($me_id) {
	// 4.00.15
	$row = sql_fetch(" select * from {$g5['memo_table']} where me_id = '{$me_id}' and me_recv_mb_id = '{$member['mb_id']}' ");

	// 내가 받은 쪽지가 아니면 확인 못하게
	if (!isset($row) && $is_admin != 'super') {
		alert_close('잘못된 접근입니다.');
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

		// 받는이가 관리자인 경우 익명으로 쪽지 못 보내게
		if ($me_recv_mb_id == 'lebolution' || in_array($me_recv_mb_id, $tmpArr)) {
			$is_recv_admin = true;
		} else {
			$is_recv_admin = false;
		}

		if ($is_recv_admin) {
			$me_send_anonymous = false;
			$me_recv_nick = $mb['mb_nick'];
		} else {
			// 해당 me_id의 쪽지 보낸 사람이 익명이면 me_name = 익명
			if ($row['me_send_anonymous'] == 1) {
				$me_send_anonymous = true;
				$me_recv_nick = '익명의 니니';
			} else {
				$me_send_anonymous = false;
				$me_recv_nick = $mb['mb_nick'];
			}
		}
		// 원본 쪽지 내용
		if ($row['me_memo']) {
			$content = conv_content($row['me_memo'], 0);
		}
	}
} else if ($bt && $mid) {
	// 19.02.13 특정 게시판의 경우 쪽지 보내지 못하게
	$boLimitArr = ['sdiary'];

	if (!$is_admin && in_array($bt, $boLimitArr)) {
		alert_close('이 게시판에서는 쪽지를 보낼 수 없습니다!');
	} else {
		// 익명으로 쪽지 보냈는데 닉네임 노출되면 안 되므로 bo_table, wr_id를 매칭해서 닉네임과 익명여부를 가져옴
		$row = sql_fetch(" select mb_id, wr_name, wr_1 from {$g5['write_prefix']}{$bt} where wr_id = '{$mid}' ");

		if ($row) {
			// 받는이가 관리자인 경우 익명으로 쪽지 못 보내게
			if ($row['mb_id'] == 'lebolution' || in_array($row['mb_id'], $tmpArr)) {
				$is_recv_admin = true;
			} else {
				$is_recv_admin = false;
			}
			if ($is_recv_admin) {
				$me_recv_nick = $row['wr_name'];
				// 받는이가 관리자인 경우 쪽지 못 보내게 임시 주석 처리
				// alert_close('운영진에게는 쪽지를 보낼 수 없습니다!');
			} else {
				list($gnu_level,$eyoom_level,$anonymous) = explode('|',$row['wr_1']);
				if(!$anonymous) {
					$me_recv_nick = $row['wr_name'];
				} else {
					if($anonymous == 'y') {
						$me_recv_nick = '익명의 니니';
					}
				}
			}
		} else {
			// 게시판명, 글번호 없을 경우 처리
			alert_close('잘못된 접근입니다.');
		}
	}

} else {
	if ($is_admin != 'super') {
		alert_close('잘못된 접근입니다.');
	}
}

$g5['title'] = '쪽지 보내기';
include_once(G5_PATH.'/head.sub.php');

$memo_action_url = G5_HTTPS_BBS_URL."/memo_form_update.php";
include_once($member_skin_path.'/memo_form.skin.php');

include_once(G5_PATH.'/tail.sub.php');
?>
