<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/font-awesome/css/font-awesome.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style.min.css" type="text/css" media="screen">',0);
?>

<!--{* 로그인 시작 *}-->
<div class="eb-login">
	<div class="container">
		<div class="member-login">
			<div class="member-login-header">
				<h4><strong>로그인</strong></h4>
				<a href="<?php echo G5_BBS_URL ?>/password_lost.php" target="_blank">아이디/비밀번호찾기</a>
				<a href="./register.php" class="pull-right">회원가입</a>
				<div class="clearfix"></div>
			</div>
			<form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post" class="eyoom-form">
			<input type="hidden" name="url" value="<?php echo $login_url ?>">

			<fieldset>
				<section>
					<label class="input">
						<i class="icon-prepend fa fa-user"></i>
						<input type="text" class="form-control" placeholder="아이디" name="mb_id" required class="frm_input required" size="20" maxLength="20">
					</label>
				</section>
				<section>
					<label class="input">
						<i class="icon-prepend fa fa-lock"></i>
						<input type="password" class="form-control" placeholder="비밀번호" name="mb_password" required class="frm_input required" size="20" maxLength="20">
					</label>
				</section>
				<label class="checkbox">
					<input type="checkbox" name="auto_login" id="login_auto_login"><i></i>자동로그인
				</label>
				<div class="margin-bottom-20"></div>
				<div class="text-center">
					<button type="submit" value="로그인" class="btn-e btn-e-red"><i class="fa fa-sign-in"></i> 로그인</button>
				</div>
			</fieldset>
			</form>
		</div>
	</div>
	<div class="main-comeback margin-bottom-30">
		<a href="<?php echo G5_URL ?>/">메인으로 돌아가기</a>
	</div>
</div>

<style>
body {background-color:#f0f0f0}
.member-login {width:380px;padding:20px;margin:40px auto 20px;background:#fff;border-top:solid 1px #f44455}
.member-login .eyoom-form {border:0}
.member-login .eyoom-form fieldset {padding:0}
.member-login h4, .member-login p, .member-login p a {color:#333}
.member-login-header {padding-bottom:5px;margin-bottom:20px;border-bottom:solid 1px #eee}
.member-login-header h4 {padding-bottom:15px;text-align:center;margin-bottom:15px}
.main-comeback {text-align: center;margin-top:0}
.member-login-notmb {width:380px;padding:20px;margin:0px auto 20px;background:#fff}
.member-login-notmb .eyoom-form {border:0}
.member-login-notmb .panel {padding:10px;border:1px solid #eee;box-shadow: none;margin-bottom:10px}
.member-login-notmb .contentHolder {height:120px}
.member-login-order {width:380px;padding:20px;margin:0px auto 20px;background:#fff}
.member-login-order .eyoom-form {border:0}
.member-login-order .btn {font-size: 14px;}
@media (max-width: 767px) {
	.member-login {width:280px}
	.member-login-notmb {width:280px}
	.member-login-order {width:280px}
}
</style>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-form/jquery.form.min.js"></script>
<!--[if lt IE 9]>
	<script src="/eyoom/theme/basic2/js/respond.js"></script>
	<script src="/eyoom/theme/basic2/js/html5shiv.js"></script>
	<script src="/eyoom/theme/basic2/plugins/eyoom-form/js/eyoom-form-ie8.js"></script>
<![endif]-->
<script>
$(function(){
	$("#login_auto_login").click(function(){
		if (this.checked) {
			this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
		}
	});
});

function flogin_submit(f) {
	return true;
}
</script>
<!--{* 로그인 끝 *}-->