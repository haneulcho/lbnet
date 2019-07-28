<?php if (!defined('_GNUBOARD_')) exit;
$wr_files = empty($wr_file) || !is_array($wr_file) ? 0 : count($wr_file);
?>
<?php if ($eyoom_board["bo_use_addon_map"] == '1') { ?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
$(document).ready(function(){
	//지도 추가
	$("#btn_map").click(function(){
		var map_type = $("input[name='map_type']:checked").val();
		var map_addr1 = $("#map_addr1").val();
		var map_addr2 = $("#map_addr2").val();
		var map_name = $("#map_name").val();

		set_map_address(map_type, map_addr1, map_addr2, map_name);
	});
});
</script>
<?php } ?>

<section class="board-write board-area">
	<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" class="eyoom-form">
	<input type="hidden" name="uid" value="<?php echo $uid ?>">
	<input type="hidden" name="w" value="<?php echo $w ?>">
	<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
	<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
	<input type="hidden" name="sca" value="<?php echo $sca ?>">
	<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
	<input type="hidden" name="stx" value="<?php echo $stx ?>">
	<input type="hidden" name="spt" value="<?php echo $spt ?>">
	<input type="hidden" name="sst" value="<?php echo $sst ?>">
	<input type="hidden" name="sod" value="<?php echo $sod ?>">
	<input type="hidden" name="page" value="<?php echo $page ?>">
	<input type="hidden" name="board_skin_path" value="<?php echo EYOOM_CORE_PATH ?>/board">
	<input type="hidden" name="wr_1" id="wr_1" value="<?php echo $wr_1 ?>">
	<input type="hidden" name="wr_3" id="wr_3" value="<?php echo $wr_3 ?>">
	<input type="hidden" name="wr_4" id="wr_4" value="<?php echo $wr_4 ?>">
	<input type="hidden" name="wr_5" id="wr_5" value="<?php echo $wr_5 ?>">
	<input type="hidden" name="wmode" id="wmode" value="<?php echo $wmode ?>">
	<?php echo $option_hidden ?>
	<div class="tbl_frm01 tbl_wrap" style="margin-top:-10px;">
		<div class="clearfix"></div>
		<section>
			<div class="row" style="margin-bottom:0">
				<?php if ($is_category) { ?>
				<div class="col col-6" style="margin-bottom:0">
					<label class="select">
						<select name="ca_name" id="ca_name" required class="form-control">
							<option value="">분류를 선택하세요 (필수)</option>
							<?php echo $category_option ?>
						</select>
						<i></i>
					</label>
				</div>
				<?php } ?>
				<?php if ($is_notice || $is_secret || $is_mail) { ?>
					<div class="col col-6">
						<?php if ($is_notice) { ?>
						<label for="notice" class="checkbox"><input type="checkbox" id="notice" name="notice" value="1" <?php echo $notice_checked ?>><i></i>공지</label>
						<?php } ?>
						<?php if ($is_secret) { ?>
						<?php if ($is_admin || $is_secret == 1) { ?>
						<label for="secret" class="checkbox"><input type="checkbox" id="secret" name="secret" value="secret" <?php echo $secret_checked ?>><i></i>비밀글</label>
						<? } else { ?>
						<input type="hidden" name="secret" value="secret">
						<?php } ?>
						<?php } ?>
						<?php if ($is_mail) { ?>
						<label for="mail" class="checkbox"><input type="checkbox" id="mail" name="mail" value="mail" <?php echo $recv_email_checked ?>><i></i>답변메일받기</label>
						<?php } ?>
					</div>
				<?php } ?>
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
						<? } else { ?>
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
				<?php if (!$is_member) { ?>
				<div class="alert alert-danger padding-all-10 margin-bottom-10">
					<strong>Note!</strong> 글쓰기 시 회원만 동영상, 사운드클라우드, 코드, 이모티콘 첨부가 가능합니다.
				</div>
				<?php } ?>
				<div id="write-option">
					<div class="panel panel-default" style="border:0;margin-bottom:0;box-shadow:none">
						<?php if ($eyoom_board["bo_use_addon_map"] == '1') { ?>
						<a class="btn-e btn-e-sm btn-e-default" data-toggle="collapse" data-parent="#write-option" href="#collapse-map-wr">지도</a>
						<?php } ?>
						<div class="clearfix"></div>
						<?php if ($eyoom_board["bo_use_addon_map"] == '1') { ?>
						<div id="collapse-map-wr" class="panel-collapse collapse">
							<div class="write-function-box">
								<div class="row">
									<div class="col col-2 md-margin-bottom-10">
										<label class="input">
											<i class="icon-append fa fa-question-circle"></i>
											<input type="text" name="map_zip" id="map_zip" size="5" maxlength="6">
											<b class="tooltip tooltip-top-right">우편번호</b>
										</label>
									</div>
									<div class="col col-2 text-right md-margin-bottom-10">
										<button type="button" onclick="win_zip('fwrite', 'map_zip', 'map_addr1', 'map_addr2', 'map_addr3', 'map_addr_jibeon');" class="btn-e btn-e-dark">주소 검색</button>
									</div>
									<div class="col col-6 inline-group">
										<label class="radio" for="map_type_1">
											<input type="radio" name="map_type" id="map_type_1" value="1" checked="checked"><i class="rounded-x"></i> Google지도
										</label>
										<label class="radio" for="map_type_2">
											<input type="radio" name="map_type" id="map_type_2" value="2"><i class="rounded-x"></i> 네이버지도
										</label>
										<label class="radio" for="map_type_3">
											<input type="radio" name="map_type" id="map_type_3" value="3"><i class="rounded-x"></i> 다음지도
										</label>
									</div>
								</div>
								<div class="margin-bottom-10"></div>
								<div class="row">
									<div class="col col-10">
										<label class="input">
											<input type="text" name="map_addr1" id="map_addr1" size="50">
										</label>
										<div class="note margin-bottom-10"><strong>Note:</strong> 기본주소</div>
									</div>
								</div>
								<div class="row">
									<div class="col col-5">
										<label class="input">
											<input type="text" name="map_addr2" id="map_addr2" size="50">
										</label>
										<div class="note margin-bottom-10"><strong>Note:</strong> 상세주소</div>
									</div>
									<div class="col col-5">
										<label class="input">
											<input type="text" name="map_name" id="map_name" size="50">
										</label>
										<div class="note margin-bottom-10"><strong>Note:</strong> 장소명</div>
									</div>
									<input type="hidden" name="map_addr3" id="map_addr3" value="">
									<input type="hidden" name="map_addr_jibeon" value="">
									<div class="col col-2 text-right">
										<a href="javascript:;" class="btn-e btn-e-yellow" style="width:60px;padding:5px 12px;text-align: center;" id="btn_map" onclick="return false;">적용</a>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<?php if ($write_min || $write_max) { ?>
				<!--{* 최소/최대 글자 수 사용 시 *}-->
				<p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min ?></strong>글자 이상, 최대 <strong><?php echo $write_max ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
				<?php } ?>

				<!--{* 에디터 사용시는 에디터로, 아니면 textarea 로 노출 *}-->
				<?php echo $editor_html ?>

				<?php if ($write_min || $write_max) { ?>
				<!--{* 최소/최대 글자 수 사용 시 *}-->
				<div id="char_count_wrap"><span id="char_count"></span>글자</div>
				<?php } ?>
			</div>
		</section>
		<?php if ($eyoom_board["bo_use_hotgul"] == 1 && $bo_table == 'free2') { ?>
			<?php if ($is_admin || (!$is_admin && (!$w || $w == ''))) { ?>
			<label for="userad" class="checkbox" style="padding-left:22px !important;"><input type="checkbox" id="userad" name="wr_2" value="1" <?php echo $userad_checked ?>><i></i>전광판 (200포인트 차감)</label>
			<div class="alert alert-danger padding-all-10 margin-top-10 margin-bottom-15">
				<strong>Note:</strong> 전광판 등록은 글쓰기 시 '최초 1회'만 가능하며, 전광판에 등록된 글은 수정할 수 없으니 신중히 선택해 주세요.<br>수다방에 맞지 않는 글은 운영진 판단 하에 삭제될 수 있습니다.
			</div>
			<?php } ?>
		<?php } ?>
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
	</form>
</section>

<script>
<?php if ($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min ?>); // 최소
var char_max = parseInt(<?php echo $write_max ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
	$("#wr_content").on("keyup", function() {
		check_byte("wr_content", "char_count");
	});
});
<?php } ?>

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
