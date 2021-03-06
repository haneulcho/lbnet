<?php if (!defined("_GNUBOARD_")) exit; ?>

<!--{* 로그인 전 아웃로그인 시작 *}-->
<section class="ol-before">
	<form name="foutlogin" action="<?php echo $outlogin_action_url?>" onsubmit="return fhead_submit(this);" method="post" autocomplete="off" class="eyoom-form">
		<input type="hidden" name="url" value="<?php echo $outlogin_url?>">
		<section>
			<strong class="sound_only">LOGIN</strong>
			<label class="input">
				<i class="icon-append fa fa-user"></i>
				<input type="text" id="ol_id" name="mb_id" required class="form-control" maxlength="20" placeholder="아이디">
				<b class="tooltip tooltip-top-right">아이디를 입력해 주세요.</b>
			</label>
		</section>
		<section>
			<label class="input">
				<i class="icon-append fa fa-lock"></i>
				<input type="password" name="mb_password" id="ol_pw" required class="form-control" maxlength="20" placeholder="비밀번호">
				<b class="tooltip tooltip-top-right">비밀번호를 입력해 주세요.</b>
			</label>
		</section>
		<div class="width-50 pull-left">
			<label class="checkbox"><input type="checkbox" name="auto_login" value="1" id="auto_login"><i></i><span class="font-size-11" style="color:#818a91">자동로그인</span></label>
		</div>
		<div class="width-50 pull-right text-right">
			<button id="ol_submit" class="btn-e" type="submit">로그인</button>
		</div>
		<div class="clearfix"></div>
	</form>
</section>

<style>
.ol-before {position:relative;display:block;box-shadow:0 0 1px rgba(0,0,0,.15);background:#fff;padding:15px 15px 10px;font-size:12px}
.ol-account {font-size:12px;margin-bottom:5px;font-weight:bold}
.ol-account a:hover {text-decoration:underline}
</style>

<script>
$omi = $('#ol_id');
$omp = $('#ol_pw');
$omi_label = $('#ol_idlabel');
$omi_label.addClass('ol_idlabel');
$omp_label = $('#ol_pwlabel');
$omp_label.addClass('ol_pwlabel');

$(function() {
	$omi.focus(function() {
		$omi_label.css('visibility','hidden');
	});
	$omp.focus(function() {
		$omp_label.css('visibility','hidden');
	});
	$omi.blur(function() {
		$this = $(this);
		if($this.attr('id') == "ol_id" && $this.attr('value') == "") $omi_label.css('visibility','visible');
	});
	$omp.blur(function() {
		$this = $(this);
		if($this.attr('id') == "ol_pw" && $this.attr('value') == "") $omp_label.css('visibility','visible');
	});

	$("#auto_login").click(function(){
		if ($(this).is(":checked")) {
			if(!confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?"))
				return false;
		}
	});
});

function fhead_submit(f)
{
	if (f.mb_id.value == '' || f.mb_id.value == $("#ol_id").attr("placeholder")) {
		alert("아이디를 입력해 주세요.");
		f.mb_id.select();
		f.mb_id.focus();
		return false;
	}
	if (f.mb_password.value == '' || f.mb_password.value == $("#ol_pw").attr("placeholder")) {
		alert("비밀번호를 입력해 주세요.");
		f.mb_password.select();
		f.mb_password.focus();
		return false;
	}
	return true;
}
</script>
<!--{* 로그인 전 아웃로그인 끝 *}-->
