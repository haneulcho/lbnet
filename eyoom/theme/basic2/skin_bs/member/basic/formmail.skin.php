<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/font-awesome/css/font-awesome.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style.min.css" type="text/css" media="screen">',0);
?>

<div class="formmail">
	<h5 class="margin-bottom-20"><strong><?php echo $name ?>님께 메일보내기</strong></h5>
	<div class="tab-e1">
		<ul class="nav nav-tabs">
			<li class="active"><a>메일쓰기</a></li>
		</ul>
		<div class="tab-content">
			<!--{* 메일 쓰기 시작 *}-->
			<form name="fformmail" action="./formmail_send.php" onsubmit="return fformmail_submit(this);" method="post" enctype="multipart/form-data" class="eyoom-form">
			<input type="hidden" name="to" value="<?php echo $email ?>">
			<input type="hidden" name="attach" value="2">
			<input type="hidden" name="token" value="<?php echo $token ?>">
			<?php if ($is_member) { ?>
				<input type="hidden" name="fnick" value="<?php echo get_text($member['mb_nick']) ?>">
				<input type="hidden" name="fmail" value="<?php echo $member['mb_email'] ?>">
			<?php } ?>

			<?php if (!$is_member) { ?>
			<div class="row">
				<section class="col col-6">
					<label for="fnick" class="label">이름<strong class="sound_only">필수</strong></label>
					<label class="input">
						<i class="icon-append fa fa-user"></i>
						<input type="text" name="fnick" id="fnick" required>
					</label>
				</section>
				<section class="col col-6">
					<label for="fmail" class="label">E-mail<strong class="sound_only">필수</strong></label>
					<label class="input">
						<i class="icon-append fa fa-envelope-o"></i>
						<input type="text" name="fmail"  id="fmail" required>
					</label>
				</section>
			</div>
			<div class="margin-hr-10"></div>
			<?php } ?>
			<div class="row">
				<section class="col col-6">
					<label for="subject" class="label">제목<strong class="sound_only">필수</strong></label>
					<label class="input">
						<i class="icon-append fa fa-tag"></i>
						<input type="text" name="subject" id="subject" required>
					</label>
				</section>
				<section class="col col-6">
					<label class="label">형식</label>
					<div class="inline-group">
						<label for="type_text" class="radio"><input type="radio" name="type" value="0" id="type_text" checked><i class="rounded-x"></i>TEXT</label>
						<label for="type_html" class="radio"><input type="radio" name="type" value="1" id="type_html"><i class="rounded-x"></i>HTML</label>
						<label for="type_both" class="radio"><input type="radio" name="type" value="2" id="type_both"><i class="rounded-x"></i>TEXT+HTML</label>
					</div>
				</section>
			</div>
			<div class="margin-hr-10"></div>
			<section>
				<label for="content" class="label">내용<strong class="sound_only">필수</strong></label>
				<label class="textarea textarea-resizable">
					<textarea name="content" id="content" required></textarea>
				</label>
			</section>
			<div class="margin-hr-10"></div>
			<section>
				<label for="file1" class="label">첨부파일 1</label>
				<label for="file1" class="input input-file">
					<div class="button bg-color-light-grey"><input type="file" name="file1" id="file1" value="첨부파일1" onchange="this.parentNode.nextSibling.value = this.value">파일선택</div><input type="text" readonly>
				</label>
			</section>
			<div class="margin-hr-10"></div>
			<section>
				<label for="file2" class="label">첨부파일 2</label>
				<label for="file2" class="input input-file">
					<div class="button bg-color-light-grey"><input type="file" name="file2" id="file2" value="첨부파일2" onchange="this.parentNode.nextSibling.value = this.value">파일선택</div><input type="text" readonly>
				</label>
			</section>
			<div class="margin-hr-10"></div>
			<section>
				<label class="label">자동등록방지</label>
				<div class="vc-captcha">><?php echo captcha_html(); ?></div>
			</section>

			<div class="text-center margin-bottom-20">
				<input type="submit" value="메일발송" id="btn_submit" class="btn-e btn-e-red">
				<button type="button" onclick="window.close();" class="btn-e btn-e-dark">창닫기</button>
			</div>
			</form>
			<!--{* 메일 쓰기 끝 *}-->
		</div>
	</div>

</div>

<style>
.margin-hr-10 {height:1px;border-top:1px dotted #ddd;margin:10px 0}
.formmail {padding:15px;font-size:12px}
.formmail .tab-e1 .tab-content img {margin-top:0;margin-bottom:0}
</style>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-form/jquery.form.min.js"></script>
<script>
with (document.fformmail) {
	if (typeof fname != "undefined")
		fname.focus();
	else if (typeof subject != "undefined")
		subject.focus();
}

function fformmail_submit(f) {
	<?php echo chk_captcha_js();  ?>

	if (f.file1.value || f.file2.value) {
		// 4.00.11
		if (!confirm("첨부파일의 용량이 큰경우 전송시간이 오래 걸립니다.\n\n메일보내기가 완료되기 전에 창을 닫거나 새로고침 하지 마십시오."))
			return false;
	}

	document.getElementById('btn_submit').disabled = true;

	return true;
}
</script>