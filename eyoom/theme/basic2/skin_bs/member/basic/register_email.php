<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/font-awesome/css/font-awesome.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style.min.css" type="text/css" media="screen">',0);
?>
<div class="register-email">
	<h5 class="margin-bottom-20"><strong>메일인증을 받지 못한 경우 회원정보의 메일주소를 변경 할 수 있습니다.</strong></h5>
	<div class="tab-e1">
		<ul class="nav nav-tabs">
			<li class="active"><a>이메일 입력</a></li>
		</ul>
		<div class="tab-content">
			<!-- 이메일인증 변경 시작 -->
			<form method="post" name="fregister_email" action="<?php echo G5_HTTPS_BBS_URL ?>/register_email_update.php" onsubmit="return fregister_email_submit(this);" class="eyoom-form">
			<input type="hidden" name="mb_id" value="<?php echo mb_id ?>">

			<section>
				<label for="reg_mb_email" class="label">E-mail<strong class="sound_only">필수</strong></label>
				<label class="input">
					<i class="icon-append fa fa-envelope-o"></i>
					<input type="text" name="mb_email" id="reg_mb_email" required size="50" maxlength="100" value="<?php echo $mb["mb_email"] ?>">
				</label>
			</section>
			<div class="margin-hr-10"></div>
			<section>
				<label class="label">자동등록방지</label>
				<div class="vc-captcha"><?php echo captcha_html() ?></div>
			</section>
			<div class="text-center margin-bottom-20">
				<input type="submit" id="btn_submit" value="인증메일변경" class="btn-e btn-e-red">
				<button type="button" onclick="window.close();" class="btn-e btn-e-dark">창닫기</button>
			</div>
			</form>
			<!-- 이메일인증 변경 끝 -->
			<div class="margin-bottom-20"></div>
			<div class="text-center">
				<a href="<?php echo G5_URL ?>" class="btn-e btn-e-dark btn-e-lg">메인으로 돌아가기</a>
			</div>
		</div>
	</div>
</div>

<style>
.margin-hr-10 {height:1px;border-top:1px dotted #ddd;margin:10px 0}
.register-email {padding:15px;font-size:12px}
.register-email .tab-e1 .tab-content img {margin-top:0;margin-bottom:0}
</style>

<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-form/jquery.form.min.js"></script>
<script>
function fregister_email_submit(f) {
	<?php echo chk_captcha_js();  ?>

	return true;
}
</script>

<?php
// tail_sub 템플릿 출력
@include_once(EYOOM_THEME_PATH.'/'.$theme.'/layout/tail_sub.php');
?>