<?php if (!defined('_GNUBOARD_')) exit;
$wr_files = empty($wr_file) || !is_array($wr_file) ? 0 : count($wr_file);
?>
<section class="board-write board-area">
	<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" class="eyoom-form">
	<input type="hidden" name="uid" value="<?php echo $uid ?>">
	<input type="hidden" name="w" value="<?php echo $w ?>">
	<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
	<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
	<input type="hidden" name="page" value="<?php echo $page ?>">
	<input type="hidden" name="board_skin_path" value="<?php echo EYOOM_CORE_PATH ?>/board">
	<input type="hidden" name="wr_1" id="wr_1" value="<?php echo $wr_1 ?>">
	<?php echo $option_hidden ?>

	<section class="clearfix margin-bottom-20">
		<div class="col-sm-5">
			<div class="col-sm-11 md-margin-bottom-20">
				<fieldset class="lbbox">
					<h3><i class="fa fa-pencil-square-o"></i> <strong>기본정보 입력</strong></h3>
					<dl class="margin-bottom-15">
						<dt>지역</dt>
						<dd>
							<label class="select">
							<select name="wr_area" <?php if (!$is_admin) { ?>required <?php } ?>class="form-control c-select">
								<option value="">지역을 선택하세요.</option>
								<?php
									$area = array('서울', '인천/경기', '대전/충청', '광주/전라', '대구/경북', '부산/경남', '강원/제주', '해외');
									for ($i = 0; $i < count($area); $i++) {
								?>
								<option value="<?php echo $area[$i]; ?>"<?php if($wr_area == $area[$i]){ echo ' selected';} ?>><?php echo $area[$i]; ?></option>
								<?php } ?>
							</select>
								<i></i>
							</label>
						</dd>
					</dl>
					<dl class="col-6 pull-left">
						<dt>성향</dt>
						<dd>
							<?php
								$type = array('팸', '부치', '전천', '무성향');
								for ($i = 0; $i < count($type); $i++) {
							?>
							<label for="wr_type<?php echo $i; ?>" class="radio"><input type="radio" id="wr_type<?php echo $i; ?>" name="wr_type" value="<?php echo $type[$i]; ?>"<?php if($wr_type == $type[$i]){ echo ' checked';} ?>><i class="rounded-x"></i><?php echo $type[$i]; ?></label>
							<?php } ?>
						</dd>
					</dl>
					<dl class="col-6 pull-left">
						<dt>나이</dt>
						<dd>
							<?php
								$age = array('20~24', '25~29', '30~34', '35 이상');
								for($i = 0; $i < count($age); $i++) {
							?>
							<label for="wr_age<?php echo $i; ?>" class="radio"><input type="radio" id="wr_age<?php echo $i; ?>" name="wr_age" value="<?php echo $age[$i]; ?>"<?php if($wr_age == $age[$i]){ echo ' checked';} ?>><i class="rounded-x"></i><?php echo $age[$i]; ?></label>
							<?php } ?>
						</dd>
					</dl>
				</fieldset>
			</div>
			<div class="col-sm-11 md-margin-bottom-20">
				<fieldset class="lbbox">
					<h3><i class="fa fa-plus-square"></i> <strong>추가정보 입력</strong></h3>
					<div class="margin-bottom-15">
						<label for="wr_send_moreinfo" class="col-sm-4 form-control-label">추가정보 입력하기</label><label class="ui-switch primary m-t-xs m-r"><input type="checkbox" id="wr_send_moreinfo" name="wr_send_moreinfo"<?php if ($wr_send_moreinfo == '1') { echo ' checked value="1"'; } else { echo ' value="0"'; } ?>><i></i></label>
					</div>
					<div class="margin-bottom-15">
						<label for="wr_recv_moreinfo" class="col-sm-4 form-control-label">무조건 상대 추가정보 받기</label><label class="ui-switch primary m-t-xs m-r"><input type="checkbox" id="wr_recv_moreinfo" name="wr_recv_moreinfo"<?php if ($wr_recv_moreinfo == '1') { echo ' checked value="1"'; } else { echo ' value="0"'; } ?>><i></i></label>
					</div>
					<div class="alert alert-danger padding-all-10 margin-top-10 margin-bottom-15">
					<strong>Note:</strong> 추가정보 입력시 50포인트 적립 / 상대 추가정보 받기를 켜두면, 댓글 쓰는 상대방은 무조건 추가정보를 입력해야 합니다.
					</div>
					<dl id="moreinfo" style="display:none">
						<dt>직업</dt>
						<dd>
							<label class="select">
							<select name="wr_job" class="form-control c-select">
								<option value="">직업을 선택하세요.</option>
								<?php
									$job = array('학생', '직장인(주5일)', '직장인(주6일)', '직장인(평일휴무)', '직장인(주말휴무)', '프리랜서', '무직');
									for($i = 0; $i < count($job); $i++) {
								?>
								<option value="<?php echo $job[$i]; ?>"<?php if ($wr_job == $job[$i]) { echo ' selected'; } ?>><?php echo $job[$i]; ?></option>
								<?php } ?>
							</select>
								<i></i>
							</label>
						</dd>
						<dt>키</dt>
						<dd>
							<label class="select">
							<select id="wr_figure1" name="wr_figure[]" class="form-control c-select">
								<option value="0">키를 선택하세요.</option>
								<?php
									$figure1 = array('155cm 미만', '155~159cm', '160~164cm', '165~169cm', '170cm 이상');
									for($i = 0; $i < count($figure1); $i++) {
								?>
								<option value="<?php echo $figure1[$i]; ?>"<?php if ($wr_figure[0] == $figure1[$i]) { echo ' selected'; } ?>><?php echo $figure1[$i]; ?></option>
								<?php } ?>
							</select>
								<i></i>
							</label>
						</dd>
						<dt>체형</dt>
						<dd>
							<label class="select">
							<select id="wr_figure2" name="wr_figure[]" class="form-control c-select">
								<option value="0">체형을 선택하세요.</option>
								<?php
									$figure2 = array('마름', '보통', '통통', '통통 이상');
									for($i = 0; $i < count($figure2); $i++) {
								?>
								<option value="<?php echo $figure2[$i]; ?>"<?php if ($wr_figure[1] == $figure2[$i]) { echo ' selected'; } ?>><?php echo $figure2[$i]; ?></option>
								<?php } ?>
							</select>
								<i></i>
							</label>
						</dd>
						<dt>흡연유무</dt>
						<dd>
							<label for="wr_etc1" class="radio"><input type="radio" id="wr_etc1" name="wr_etc" value="흡연"<?php if ($wr_etc == '흡연') { echo ' checked'; } ?>><i class="rounded-x"></i>흡연</label>
							<label for="wr_etc2" class="radio"><input type="radio" id="wr_etc2" name="wr_etc" value="비흡연"<?php if ($wr_etc == '비흡연') { echo ' checked'; } ?>><i class="rounded-x"></i>비흡연</label>
						</dd>
						<dt>관심사</dt>
						<dd>
<?php
	$wr_interest_array = $wr_interest;
	$interest = array("독서/글쓰기", "음악", "영화/드라마", "게임", "운동", "덕질", "사진/영상", "예술", "정치/사회", "반려동물");
	for($i = 0; $i < count($interest); $i++) {
?>
							<label for="wr_interest<?php echo $i; ?>" class="checkbox pull-left"><input type="checkbox" id="wr_interest<?php echo $i; ?>" name="wr_interest[]" value="<?php echo $interest[$i]; ?>"<?php if (isset($wr_interest) && in_array($interest[$i], $wr_interest_array)) { echo ' checked'; } ?>><i></i><?php echo $interest[$i]; ?></label>
<?php } ?>
						</dd>
					</dl>
				</fieldset>
			</div>
		</div>
		<div class="col-sm-7">
			<div class="tbl_frm01 tbl_wrap" style="margin-top:-10px;">
				<div class="clearfix"></div>
				<section>
					<div class="row">
						<div class="col col-8" style="margin-bottom:0">
						<?php if ($is_notice || $is_secret || $is_mail || $is_anonymous) { ?>
							<?php if ($is_notice) { ?>
							<label for="notice" class="checkbox"><input type="checkbox" id="notice" name="notice" value="1" <?php echo $notice_checked ?>><i></i>공지</label>
							<?php } ?>

							<?php if ($is_secret) { ?>
							<?php if ($is_admin || $is_secret == 1) { ?>
							<label for="secret" class="checkbox"><input type="checkbox" id="secret" name="secret" value="secret" <?php echo $secret_checked ?>><i></i>비밀글</label>
							<?php } else { ?>
							<input type="hidden" name="secret" value="secret">
							<?php } ?>
							<?php } ?>

							<?php } ?>
						</div>
					</div>
				</section>


				<div class="lbtop">
					<div class="lbsubject">
						<div class="lbanonymous">
							<?php if ($is_anonymous) { ?>
							<label for="anonymous" class="checkbox"><input type="checkbox" id="anonymous" name="anonymous" value="y" checked><i></i>익명글</label>
							<?php } ?>
							<?php if ($is_html) { ?>
								<?php if ($is_dhtml_editor) { ?>
								<input type="hidden" value="html1" name="html">
								<?php } else { ?>
								<label for="html" class="checkbox"><input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="<?php echo $html_value ?>" <?php echo $html_checked ?>><i></i>HTML</label>
								<?php } ?>
							<?php } ?>
						</div>
						<label for="wr_subject" class="sound_only">제목<strong class="sound_only"> 필수</strong></label>
						<label class="input">
						<i class="icon-prepend fa fa-edit"></i>
						<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="form-control" size="50" maxlength="255" placeholder="제목을 입력해 주세요.">
						<b class="tooltip tooltip-top-left">제목을 입력해 주세요.</b>
						</label>
					</div>
				</div>

				<section>
					<div class="wr_content">
						<!--{* 에디터 사용시는 에디터로, 아니면 textarea 로 노출 *}-->
						<?php echo $editor_html ?>
					</div>
				</section>
				<div class="margin-hr-10"></div>
				<section>
					<?php if ($wr_files) { foreach ($wr_file as $k => $item) { ?>
					<div class="row">
						<div class="col col-12" style="margin-bottom:7px;">
						<label for="file" class="input input-file">
							<div class="button bg-color-light-grey"><input type="file" id="file" name="bf_file[]" value="사진선택" title="파일첨부 <?php echo $k + 1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" onchange="this.parentNode.nextSibling.value = this.value">파일<?php echo $k + 1 ?> 선택</div><input type="text" readonly>
						</label>
						</div>
						<?php if ($is_file_content) { ?>
						<div class="col col-12 margin-top-10">
							<label class="input">
								<i class="icon-append fa fa-question-circle"></i>
								<input type="text" name="bf_content[]" value="<?php if ($w == 'u') { ?><?php echo $item["bf_content"] ?><?php } ?>" class="form-control" size="50" placeholder="파일<?php echo $k + 1 ?> 설명">
							<b class="tooltip tooltip-top-right">파일<?php echo $k + 1 ?> 설명을 입력해 주세요.</b>
							</label>
						</div>
						<div class="clearfix"></div>
						<?php } ?>
						<?php if ($w == 'u' && $item["file"]) { ?>
						<div class="col col-6">
							<label for="bf_file_del<?php echo $k ?>" class="checkbox"><input type="checkbox" id="bf_file_del<?php echo $k ?>" name="bf_file_del[<?php echo $k ?>]" value="1"><i></i><?php echo $item["source"] ?> (<?php echo $item["size"] ?>) 파일삭제</label>
						</div>
						<?php } ?>
					</div>
					<?php } } ?>
				</section>
				<?php if (!$is_member) { ?>
				<section>
					<label class="label">자동등록방지</label>
					<div class="vc-captcha"><?php echo $captcha_html ?></div>
					<div class="margin-bottom-20"></div>
				</section>
				<?php } ?>
			</div>
			<div class="text-center wwbtn">
				<a href="<?php if ($wmode) { ?>javascript:history.go(-1)<?php } else { ?>./board.php?bo_table=<?php echo $bo_table ?><?php } ?>">취소</a>
				<button type="submit" id="btn_submit"><i class="fa fa-paper-plane"></i>작성완료</button>
			</div>
		</div>
	</section> <!--row end-->
	</form>
</section>

<script>
$('#wr_send_moreinfo').change(function() {
	if(this.checked) {
		$('#moreinfo').slideDown();
		$(this).val('1').attr('checked', 'checked');
	} else {
		$('#moreinfo').slideUp();
		$(this).val('0').removeAttr('checked');
	}
});
$('#wr_recv_moreinfo').change(function() {
	if(this.checked) {
		$(this).val('1').attr('checked', 'checked');
	} else {
		$(this).val('0').removeAttr('checked');
	}
});
function html_auto_br(obj)
{
	if (obj.checked) {
		result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
		if (result)
			obj.value = "html2";
		else
			obj.value = "html1";
	}
	else
		obj.value = "";
}

function fwrite_submit(f)
{
	<?php echo $editor_js ?> // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함

	<?php if ($is_anonymous) { ?>
	var wr_1 = '<?php echo $wr_1 ?>';
	if($("#anonymous").is(':checked')) {
		wr_1 = wr_1+'|y';
		$("#wr_1").val(wr_1);
	}
	<?php } ?>


	<?php if (!$is_admin) { ?>
	if($('input:radio[name="wr_type"]').is(':checked') == false) {
		alert('성향을 선택해 주세요!');
		f.wr_type1.focus();
		return false;
	}
	if($('input:radio[name="wr_age"]').is(':checked') == false) {
		alert('나이를 선택해 주세요!');
		f.wr_age1.focus();
		return false;
	}

	if($('input:checkbox[name="wr_send_moreinfo"]').is(':checked') == true || $('input[name="wr_send_moreinfo"]').val() == 1) {
		if($('select[name="wr_job"] option:selected').val() == '' ) {
			alert('직업을 선택해 주세요!');
			f.wr_job.focus();
			return false;
		}
		if($('#wr_figure1 option:selected').val() == 0) {
			alert('키를 선택해 주세요!');
			f.wr_figure1.focus();
			return false;
		}
		if($('#wr_figure2 option:selected').val() == 0) {
			alert('체형을 선택해 주세요!');
			f.wr_figure2.focus();
			return false;
		}
		if($('input:radio[name="wr_etc"]').is(':checked') == false) {
			alert('흡연유무를 선택해 주세요!');
			f.wr_etc1.focus();
			return false;
		}
		if($('input:checkbox[name="wr_interest[]"]').is(':checked') == false) {
			alert('관심사를 선택해 주세요!');
			f.wr_interest1.focus();
			return false;
		}
	}
	<?php } ?>

	var subject = "";
	var content = "";
	$.ajax({
		url: g5_bbs_url+"/ajax.filter.php",
		type: "POST",
		data: {
			"subject": f.wr_subject.value,
			"content": f.wr_content.value
		},
		dataType: "json",
		async: false,
		cache: false,
		success: function(data, textStatus) {
			subject = data.subject;
			content = data.content;
		}
	});

	if (subject) {
		alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
		f.wr_subject.focus();
		return false;
	}

	if (content) {
		alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
		if (typeof(ed_wr_content) != "undefined")
			ed_wr_content.returnFalse();
		else
			f.wr_content.focus();
		return false;
	}

	if (document.getElementById("char_count")) {
		if (char_min > 0 || char_max > 0) {
			var cnt = parseInt(check_byte("wr_content", "char_count"));
			if (char_min > 0 && char_min > cnt) {
				alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
				return false;
			}
			else if (char_max > 0 && char_max < cnt) {
				alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
				return false;
			}
		}
	}

	<?php echo $captcha_js ?> // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함

	document.getElementById("btn_submit").disabled = "disabled";

	return true;
}
</script>

<style>
.wwbtn {height:40px;overflow:hidden;}
.wwbtn button, .wwbtn a {display:inline-block;box-sizing:border-box;height:40px;line-height:1;outline:0;border:0;color:#fff}
.wwbtn button {background-color:#00bcd4;font-size:14px;padding:10px 15px;}
.wwbtn button i {margin-right:6px;}
.wwbtn button:hover, .wwbtn button:focus {background-color:#09a7bb;}
.wwbtn a {vertical-align: -1px;background-color:#e0e0e0;color:#bbb;font-size:12px;padding:14px 10px 10px;}
.wwbtn a:hover {color:#999;background-color:#eee;}
.margin-hr-0 {height:1px;border-top:1px dotted #ddd;margin:0 0 10px;clear:both}
.margin-hr-10 {height:1px;border-top:1px dotted #ddd;margin:10px 0;clear:both}
.margin-top-m-2 {margin-top:-2px}
.board-write .board-write-title {border-bottom:1px solid #e5e5e5;padding-bottom:10px}
.board-write .tbl_frm01 textarea {width:100% !important;height:200px !important;border:1px solid #ddd;background:#fafafa;padding:10px; font-size:13px; line-height: 1.35; -webkit-box-sizing:border-box; box-sizing:border-box}
@media (max-width: 767px) {
	.board-write .tbl_frm01 textarea {height:170px !important;}
}
.board-write .input-group-btn .btn {cursor:inherit}
.board-write .write-function-box {margin-top:10px;border:1px solid #e5e5e5;padding:15px 10px}
#char_count_desc {display:block;margin:0 0 5px;padding:0}
#char_count_wrap {margin:5px 0 0;text-align:right}
#char_count {font-weight:bold}
</style>
