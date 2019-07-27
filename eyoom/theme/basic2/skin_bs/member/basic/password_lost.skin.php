<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/font-awesome/css/font-awesome.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style.min.css" type="text/css" media="screen">',0);
?>

<div class="find-info">
	<h5 class="margin-bottom-20"><strong>회원정보 찾기</strong></h5>
	<div class="tab-e1">
		<ul class="nav nav-tabs">
			<li class="active"><a>이메일 찾기</a></li>
		</ul>
		<div class="tab-content">
			<div class="note margin-bottom-10"><strong>Note:</strong> 회원가입 시 등록하신 이메일 주소를 입력해 주세요. 해당 이메일로 아이디와 비밀번호 정보를 보내드립니다.</div>
			<!--{* 회원정보 찾기 시작 *}-->
			<form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off" class="eyoom-form">
			<div id="info_fs">
				<section>
					<label for="mb_email" class="label">E-mail 주소<strong class="sound_only">필수</strong></label>
					<label class="input">
						<i class="icon-append fa fa-envelope-o"></i>
						<input type="text" name="mb_email" id="mb_email" required size="30">
					</label>
				</section>
				<div class="margin-hr-10"></div>
				<section>
					<label class="label">자동등록방지</label>
					<div class="vc-captcha"><?php echo captcha_html(); ?></div>
				</section>
			</div>
			<div class="text-center margin-bottom-20">
				<input type="submit" value="확인" class="btn-e btn-e-red">
				<button type="button" onclick="window.close();" class="btn-e btn-e-dark">창닫기</button>
			</div>
			</form>
			<!--{* 회원정보 찾기 끝 *}-->
		</div>
	</div>
</div>

<style>
.margin-hr-10 {height:1px;border-top:1px dotted #ddd;margin:10px 0}
.find-info {padding:15px;font-size:12px}
.find-info .tab-e1 .tab-content img {margin-top:0;margin-bottom:0}
</style>

<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-form/jquery.form.min.js"></script>
<script>
function fpasswordlost_submit(f) {
	<?php echo chk_captcha_js(); ?>

	return true;
}

$(function() {
	var sw = screen.width;
	var sh = screen.height;
	var cw = document.body.clientWidth;
	var ch = document.body.clientHeight;
	var top  = sh / 2 - ch / 2 - 100;
	var left = sw / 2 - cw / 2;
	moveTo(left, top);
});
</script>