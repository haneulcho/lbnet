<?php
	@include_once('../_common.php');
	@include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

	// 그누 헤더정보 출력
	@include_once(G5_PATH.'/head.sub.php');

	$sql = " select mb_email, mb_datetime, mb_email_certify from {$g5['member_table']} where mb_id = '{$mb_id}' ";
	$mb = sql_fetch($sql);
	if (substr($mb['mb_email_certify'],0,1)!=0) {
		alert("이미 메일인증 하신 회원입니다.", G5_URL);
	}

	include_once(EYOOM_THEME_PATH.'/'.$theme.'/skin_bs/member/'.$eyoom['member_skin'].'/register_email.php');
?>