<?php
	include_once('../_common.php');
	include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

	if ($is_guest)
		alert('회원만 이용하실 수 있습니다.');

	if (!chk_captcha()) {
		alert('자동등록방지 숫자가 틀렸습니다.');
	}

	$str_nick_list = '';
	$msg = '';
	$error_list  = array();
	$member_list = array();

	if (isset($_POST['me_recv_mb_id'])) {
		$recv_list = explode(',', trim($_POST['me_recv_mb_id']));
		$me_recv_anonymous = 0;
	} else {
		if (isset($_POST['lbme_id'])) {
			// input에 직접 아이디값을 주면 소스보기시 아이디가 노출되므로 lbme_id로 memo 테이블에 쿼리 날려서 me_recv_mb_id를 직접 db에서 받아옴
			$lbme_id = $_POST['lbme_id'];
			$lb = sql_fetch(" select me_send_mb_id, me_send_anonymous from {$g5['memo_table']} where me_id = '{$lbme_id}' and me_recv_mb_id = '{$member['mb_id']}' ");
			$me_recv_mb_id = $lb['me_send_mb_id'];
			$me_recv_anonymous = $lb['me_send_anonymous'];
			$recv_list[] = $me_recv_mb_id;
		} else if(isset($_POST['bt']) && isset($_POST['mid'])) {
			// 익명으로 쪽지 보냈는데 닉네임 노출되면 안 되므로 bo_table, wr_id를 매칭해서 닉네임과 익명여부를 가져옴
		  $lb2 = sql_fetch(" select mb_id, wr_name, wr_1 from {$g5['write_prefix']}{$bt} where wr_id = '{$mid}' ");
			$me_recv_mb_id = $lb2['mb_id'];
			$recv_list[] = $me_recv_mb_id;
			list($gnu_level,$eyoom_level,$anonymous) = explode('|',$lb2['wr_1']);
		  if(!$anonymous) {
		    $me_recv_anonymous = 0;
		  } else {
		    if($anonymous == 'y') {
		      $me_recv_anonymous = 1;
		    }
		  }
		}
	}
	for ($i=0; $i<count($recv_list); $i++) {
		$row = sql_fetch(" select mb_id, mb_nick, mb_open, mb_leave_date, mb_intercept_date from {$g5['member_table']} where mb_id = '{$recv_list[$i]}' ");
		if ($row) {
			if ($is_admin || (!$row['mb_leave_date'] || !$row['mb_intercept_date'])) {
				$member_list['id'][]   = $row['mb_id'];
				$member_list['nick'][] = $row['mb_nick'];
			} else {
				$error_list[]   = $recv_list[$i];
			}
		}
		/*
		// 관리자가 아니면서
		// 가입된 회원이 아니거나 정보공개를 하지 않았거나 탈퇴한 회원이거나 차단된 회원에게 쪽지를 보내는것은 에러
		if ((!$row['mb_id'] || !$row['mb_open'] || $row['mb_leave_date'] || $row['mb_intercept_date']) && !$is_admin) {
			$error_list[]   = $recv_list[$i];
		} else {
			$member_list['id'][]   = $row['mb_id'];
			$member_list['nick'][] = $row['mb_nick'];
		}
		*/
	}

	$error_msg = implode(",", $error_list);

	if ($error_msg) {
		if ($is_admin) {
			alert("회원아이디 '{$error_msg}' 은(는) 존재(또는 정보공개)하지 않는 회원아이디 이거나 탈퇴, 접근차단된 회원아이디 입니다.\\n쪽지를 발송하지 않았습니다.");
		} else {
			alert("존재하지 않는 회원이거나 탈퇴, 접근차단된 회원 입니다.\\n쪽지를 발송하지 못했습니다.");
		}
	}

	if (!$is_admin) {
		if (count($member_list['id'])) {
			$point = (int)$config['cf_memo_send_point'] * count($member_list['id']);
			if ($point) {
				if ($member['mb_point'] - $point < 0) {
					alert('보유하신 포인트('.number_format($member['mb_point']).'점)가 모자라서 쪽지를 보낼 수 없습니다.');
				}
			}
		}
	}

	for ($i=0; $i<count($member_list['id']); $i++) {
		$tmp_row = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
		$me_id = $tmp_row['max_me_id'] + 1;

		$recv_mb_id   = $member_list['id'][$i];
		if ($me_recv_anonymous == 1) {
			$recv_mb_nick = '익명의 니니';
		} else {
			$recv_mb_nick = get_text($member_list['nick'][$i]);
		}

		// 쪽지 INSERT
		$sql = " insert into {$g5['memo_table']} ( me_id, me_recv_mb_id, me_send_mb_id, me_recv_anonymous, me_send_anonymous, me_send_datetime, me_memo ) values ( '$me_id', '$recv_mb_id', '{$member['mb_id']}', '{$me_recv_anonymous}', '{$_POST['me_send_anonymous']}', '".G5_TIME_YMDHIS."', '{$_POST['me_memo']}' ) ";
		sql_query($sql);

		// 푸시등록
		$user = sql_fetch("select onoff_push_memo from {$g5['eyoom_member']} where mb_id = '{$recv_mb_id}'");
		if($user['onoff_push_memo'] == 'on') {
			if($me_recv_anonymous == 1) {
				$eb->set_push("memo",$me_id,$recv_mb_id,'익명의 니니');
			} else {
				$eb->set_push("memo",$me_id,$recv_mb_id,$member['mb_nick']);
			}
		}

		// 나의 활동
		$act_contents = array();
		$act_contents['mb_nick'] = $recv_mb_nick;
		$act_contents['mb_id'] = $recv_mb_id;
		$act_contents['me_id'] = $me_id;
		$eb->insert_activity($member['mb_id'],'memo',$act_contents);

		// 실시간 쪽지 알림 기능
		$sql = " update {$g5['member_table']} set mb_memo_call = '{$member['mb_id']}' where mb_id = '$recv_mb_id' ";
		sql_query($sql);

		if (!$is_admin) {
			insert_point($member['mb_id'], (int)$config['cf_memo_send_point'] * (-1), $recv_mb_nick.' 님께 쪽지 발송', '@memo', $recv_mb_id, $me_id);
			if($i=0) {
				$eb->level_point($levelset['memo']);
			}
		}
	}

	// 사용자 프로그램
	@include_once(EYOOM_USER_PATH.'/member/memo_form_update.php');

	if ($member_list) {
		if ($me_recv_anonymous == 1) {
			$str_nick_list = implode(',', $member_list['nick']);
			alert("익명의 니니 님께 쪽지를 전달하였습니다.", G5_HTTP_BBS_URL."/memo.php?kind=send", false);
		} else {
			$str_nick_list = implode(',', $member_list['nick']);
			alert($str_nick_list." 님께 쪽지를 전달하였습니다.", G5_HTTP_BBS_URL."/memo.php?kind=send", false);
		}
	} else {
		alert("회원아이디 오류 같습니다.", G5_HTTP_BBS_URL."/memo_form.php", false);
	}
?>
