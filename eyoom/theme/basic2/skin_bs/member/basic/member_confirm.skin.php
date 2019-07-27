<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/font-awesome/css/font-awesome.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style.min.css" type="text/css" media="screen">',0);
?>

<div class="password-confirm">
	<h5 class="margin-bottom-20"><strong><?php echo $g5['title'] ?></strong></h5>
	<div class="tab-e1">
		<ul class="nav nav-tabs">
			<li class="active"><a>회원 비밀번호 입력</a></li>
		</ul>
		<div class="tab-content">
			<h6><strong>비밀번호를 한번 더 입력해주세요.</strong></h6>
			<div class="note margin-bottom-10"><strong>Note:</strong><?php if ($url == 'member_leave.php') { ?> 비밀번호를 입력하시면 회원탈퇴가 완료됩니다.<?php } else { ?> 회원님의 정보를 안전하게 보호하기 위해 비밀번호를 한번 더 확인합니다.<?php } ?></div>
			<!--{* 회원 비밀번호 확인 시작 *}-->
			<form name="fmemberconfirm" action="<?php echo $url ?>" onsubmit="return fmemberconfirm_submit(this);" method="post" class="eyoom-form">
			<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
			<input type="hidden" name="w" value="u">
			<div class="margin-hr-10"></div>
			<h5>회원아이디: <span class="color-red"><?php echo $member['mb_id'] ?></span></h5>
			<div class="margin-hr-10"></div>
			<section>
				<label for="confirm_mb_password" class="label">비밀번호<strong class="sound_only">필수</strong></label>
				<label class="input">
					<i class="icon-prepend fa fa-lock"></i>
					<i class="icon-append fa fa-question-circle"></i>
					<input type="password" name="mb_password" id="confirm_mb_password" required size="15" maxLength="20">
					<b class="tooltip tooltip-top-right">비밀번호 입력</b>
				</label>
			</section>
			</div>
			<div class="margin-hr-10"></div>
			<div class="text-center margin-bottom-20">
				<input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-red btn-e-lg">
			</div>
			</form>
			<!--{* 회원 비밀번호 확인 끝 *}-->
			<div class="margin-bottom-20"></div>
			<div class="text-center">
				<a href="<?php echo G5_URL ?>" class="btn-e btn-e-dark btn-e-sm">메인으로 돌아가기</a>
			</div>
		</div>
	</div>

</div>

<style>
.margin-hr-10 {height:1px;border-top:1px dotted #ddd;margin:10px 0}
.password-confirm {font-size:12px;padding:15px}
</style>

<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-form/jquery.form.min.js"></script>
<script>
function fmemberconfirm_submit(f) {
	document.getElementById("btn_submit").disabled = true;

	return true;
}
</script>