<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/scrollbar/src/perfect-scrollbar.css" id="style_color" type="text/css" media="screen">',0);
?>
<style>
.margin-hr-10 {height:1px;border-top:1px dotted #ddd;margin:10px 0}
.member-skin {font-size:12px}
.member-skin .member-box {border:1px solid #ddd;margin-bottom:30px}
.member-skin .eyoom-form header {padding:10px 20px;background:#fafafa}
.member-skin .eyoom-form footer {padding:10px 20px;text-align:right}
.member-skin .contentHolder {height:178px}
.member-skin .fregister-agree label {display:inline-block;margin-right:5px}
#page {background-color:#fff; padding:10px; line-height:140%;}
#page img {max-width:100%;}
#page p {margin-bottom:15px; font-size:12px; display:block;}
#page hr {margin:10px 0; border:0; border-top:1px solid #eee;}
#page h2, #page h3, #page h4 {display:block; padding:0 10px; color:#00bcd4;}
#page h2, #page h3 {margin-bottom:6px; font-size:14px;line-height:1.3}
#page h4 {margin-left:9px; margin-right:10px; margin-bottom:3px; font-size:13px;}
#page ul, #page ol {margin:0 10px 20px; padding:10px 30px; border:1px solid #eee; background-color:#f9f9f9;}
#page ul li, #page ol li {line-height:145%; padding-bottom:5px; margin-bottom:5px; border-bottom:1px solid #eee; font-size:12px;}
#page ul li:last-child, #page ol li:last-child {padding-bottom:0; margin-bottom:0; border:none;}
#page ul li>blockquote {padding:0 10px; margin:8px 15px; border-left:5px solid #ededed;}
#page ul li>blockquote p {line-height:165%; font-size:13px;}
#page ul li>blockquote p:last-child, #page.termsofuse blockquote p:last-child {margin-bottom:0;}
#page.termsofuse p, #page.privacy p {margin-left:20px; margin-right:20px;}
#page.termsofuse ol {list-style-type:decimal;}
#page.termsofuse blockquote, #page.privacy blockquote {padding:0 15px; margin:-10px 10px 20px 22px; border-left:5px solid #ededed;}
#page.termsofuse blockquote p, #page.privacy blockquote p {margin-left:0; margin-right:0; line-height:165%; font-size:11.5px;}
#page.privacy ol li>p {margin:0; line-height:145%; font-size:12px !important;}
</style>
<!--{* 회원가입약관 동의 시작 *}-->
<div class="member-skin">
	<form name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off" class="eyoom-form">

	<section id="fregister_term" class="member-box">
		<header><h5><strong>회원가입약관</strong></h5></header>
		<div class="member-agree">
			<div id="scrollbar" class="panel-body contentHolder ps-container">
				<?php @include_once(EYOOM_THEME_PATH.'/'.$theme.'/page/provision.php'); ?>
			</div>
		</div>
		<footer>
			<div class="fregister-agree">
				<label class="checkbox" for="agree11">
					<input type="checkbox" name="agree" value="1" id="agree11"><i></i>회원가입약관의 내용에 동의합니다.
				</label>
			</div>
		</footer>
	</section>

	<section id="fregister_private" class="member-box">
		<header><h5><strong>개인정보처리방침안내</strong></h5></header>
		<div class="member-agree">
			<div id="scrollbar" class="panel-body contentHolder ps-container">
				<?php @include_once(EYOOM_THEME_PATH.'/'.$theme.'/page/privacy.php'); ?>
			</div>
		</div>
		<footer>
			<div class="fregister-agree">
				<label class="checkbox" for="agree21">
					<input type="checkbox" name="agree2" value="1" id="agree21"><i></i>개인정보처리방침안내의 내용에 동의합니다.
				</label>
			</div>
		</footer>
	</section>

	<div class="btn_confirm">
		<button class="btn-e btn-e-lg btn-e-red" type="submit" value="회원가입"><i class="fa fa-sign-in"></i> 회원가입</button>
	</div>

	</form>

	<script>
	function fregister_submit(f) {
		if (!f.agree.checked) {
			alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
			f.agree.focus();
			return false;
		}

		if (!f.agree2.checked) {
			alert("개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
			f.agree2.focus();
			return false;
		}

		return true;
	}
	</script>
</div>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/scrollbar/src/jquery.mousewheel.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/scrollbar/src/perfect-scrollbar.js"></script>
<script>
	jQuery(document).ready(function ($) {
		"use strict";
		$('.contentHolder').perfectScrollbar();
	});
</script>
<!--{* 회원가입 약관 동의 끝 *}-->
