<?php if (!defined('_GNUBOARD_')) exit; ?>

<!--{* 회원가입결과 시작 *}-->
<div class="register-result">
	<div class="heading heading-v4 margin-bottom-25">
		<h2><i class="fa fa-hand-o-up"></i>우리 언니 최고!</h2>
		<p>
			<strong><?php echo $mb["mb_nick"] ?></strong> 언니, 앞으로 잘 부탁해요!
		</p>
	</div>
	<?php if ($config["cf_use_email_certify"]) {?>
	<p>
		회원 가입 시 입력하신 이메일 주소로 인증메일이 발송되었습니다.<br>
		<strong class="color-red">발송된 인증메일을 확인하신 후 인증처리</strong>를 하시면 사이트를 원활하게 이용하실 수 있습니다.
	</p>
	<blockquote class="hero hero-dark">
		<p class="font-size-12">아이디 : <strong class="color-white"><?php echo $mb["mb_id"] ?></strong></p>
		<p class="font-size-12">이메일 주소 : <strong class="color-white"><?php echo $mb["mb_email"] ?></strong></p>
	</blockquote>
	<p>
		이메일 주소를 잘못 입력했다면, help@lebolution.net으로!<br>
	</p>
	<?php } ?>

	<blockquote class="hero hero-dark">
		<p class="font-size-12">
			비밀번호는 아무도 알 수 없는 암호화 코드로 저장되므로 안심하셔도 좋습니다.<br>
			아이디, 비밀번호 분실시에는 회원가입시 입력하신 이메일 주소를 이용하여 찾을 수 있습니다.
		</p>
	</blockquote>
	<div class="margin-hr-10"></div>
	<div class="text-center">
		<a href="<?php echo G5_URL?>/" class="btn-e btn-e-dark btn-e-lg">메인으로</a>
	</div>
</div>
<!--{* 회원가입결과 끝 *}-->
<style>
.margin-hr-10 {height:1px;border-top:1px dotted #ddd;margin:10px 0}
.register-result {font-size:12px}
</style>
