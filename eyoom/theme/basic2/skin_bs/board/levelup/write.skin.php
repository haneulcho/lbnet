<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/syntaxhighlighter/styles/shCoreDjango.css" type="text/css" media="screen">', 0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/venobox/venobox.css" type="text/css" media="screen">', 0);

$tags = empty($wr_tags) || !is_array($wr_tags) ? 0 : count($wr_tags);
$wr_files = empty($wr_file) || !is_array($wr_file) ? 0 : count($wr_file);
?>

<script type="text/javascript" src="/eyoom/theme/basic2/plugins/venobox/venobox.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/syntaxhighlighter/scripts/shCore.js"></script>
<?php if ($eyoom_board["bo_use_addon_coding"] == '1') { ?>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/syntaxhighlighter/scripts/shBrushXml.js"></script>
<script type="text/javascript">SyntaxHighlighter.all();</script>
<?php } ?>
<?php if ($eyoom_board["bo_use_addon_map"] == '1') { ?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<?php } ?>
<script>
$(document).ready(function(){
	<?php if ($eyoom_board["bo_use_addon_emoticon"] == '1') { ?>
	$(".emoticon").venobox({border:'3px'});
	<?php } ?>

	<?php if ($eyoom_board["bo_use_addon_video"] == '1') { ?>
	//동영상 추가
	$("#btn_video").click(function(){
		var v_url = $("#video_url").val();
		if(!v_url) alert('동영상 주소를 입력해 주세요.');
		else set_textarea_contents('video',v_url);
		$("#video_url").val('');
	});
	<?php } ?>

	<?php if ($eyoom_board["bo_use_addon_coding"] == '1') { ?>
	//코드 추가
	$(".ch_code").click(function(){
		var ch = $(this).text();
		var val = ch.toLowerCase();
		set_textarea_contents('code',val);
	});
	<?php } ?>

	<?php if ($eyoom_board["bo_use_addon_soundcloud"] == '1') { ?>
	//사운드크라우드 추가
	$("#btn_scloud").click(function(){
		var s_url = $("#scloud_url").val();
		if(!s_url) alert('사운드크라우드 주소를 입력해 주세요.');
		else set_textarea_contents('sound',s_url);
	});
	$("#scloud_url").val('');
	<?php } ?>

	<?php if ($eyoom_board["bo_use_addon_map"] == '1') { ?>
	//지도 추가
	$("#btn_map").click(function(){
		var map_type = $("input[name='map_type']:checked").val();
		var map_addr1 = $("#map_addr1").val();
		var map_addr2 = $("#map_addr2").val();
		var map_name = $("#map_name").val();

		set_map_address(map_type, map_addr1, map_addr2, map_name);
	});
	<?php } ?>
});

<?php if ($eyoom_board["bo_use_addon_emoticon"] == '1') { ?>
function set_emoticon(emoticon) {
	var type='emoticon';
	set_textarea_contents(type,emoticon);
}
<?php } ?>

function set_textarea_contents(type,value) {
	var type_text = '';
	var content = '';
	var mobile = <?php if (G5_IS_MOBILE) { ?>true<?php } else { ?>false<?php } ?>;
	switch(type) {
		case 'emoticon': type_text = '이모티콘'; break;
		case 'video': type_text = '동영상'; break;
		case 'code': type_text = 'code'; break;
		case 'sound': type_text = 'soundcloud'; break;
		case 'map': type_text = '지도'; break;
	}
	if(type_text != 'code') {
		content = '{'+type_text+':'+value+'}';
	} else {
		content = '{code:'+value+'}<br><br>{/code}<br>'
	}
	if(g5_editor.indexOf('ckeditor')!=-1 && !mobile) {
		CKEDITOR.instances.wr_content.insertHtml(content);
	} else if(g5_editor.indexOf('smarteditor')!=-1 && !mobile) {
		oEditors.getById["wr_content"].exec("PASTE_HTML", [content]);
	} else if(g5_editor.indexOf('summernote')!=-1) {
		$('.summernote').summernote('pasteHTML', content);
	} else {
		var wr_html = $("#wr_content").val();
		var wr_emo = content;
		wr_html += wr_emo;
		$("#wr_content").val(wr_html);
	}
}
</script>

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
	<input type="hidden" name="wr_2" id="wr_2" value="<?php echo $wr_2 ?>">
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
						<?php if ($is_admin == 'super') { ?>
						<div class="col col-6" style="margin-bottom:0">
							<label class="select">
								<select name="ca_name" id="ca_name" required class="form-control">
									<option value="">분류를 선택하세요 (필수)</option>
									<?php echo $category_option ?>
								</select>
								<i></i>
							</label>
						</div>
					<?php } else { ?>
						<?php if ($is_admin) { ?>
							<div class="col col-6" style="margin-bottom:0">
								<label class="select">
									<select name="ca_name" id="ca_name" required class="form-control">
										<option value="공지">공지</option>
									</select>
									<i></i>
								</label>
							</div>
						<?php } else { ?>
							<div class="col col-6" style="margin-bottom:0">
								<label class="select">
									<select name="ca_name" id="ca_name" required class="form-control">
										<option value="대기">대기</option>
									</select>
									<i></i>
								</label>
							</div>
						<?php } ?>
					<?php } ?>
				<?php } ?>
				<?php if ($is_notice || $is_secret || $is_mail) { ?>
					<div class="col col-6">
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
		<?php if ($eyoom["use_tag"] == 'y' && $eyoom_board["bo_use_tag"] == '1' && $member["mb_level"] >= $eyoom_board["bo_tag_level"]) { ?>
		<section>
			<div class="row">
				<div class="col col-6 md-margin-bottom-10">
					<label>태그 입력</label>
					<label class="input">
						<i class="icon-append fa fa-tags"></i>
						<input type="text" name="tmp_tag" id="tmp_tag" class="form-control" size="50" maxlength="255">
						<b class="tooltip tooltip-top-right">관련 태그를 입력 후, TAB키를 누르시면 쉽게 태그를 추가할 수 있습니다.</b>
					</label>
				</div>
				<div class="col col-6 text-left">
					<label class="visible-lg visible-md visible-sm">&nbsp;</label>
					<a class="btn-e btn-e-lg btn-e-dark add_tags" href="#" style="font-size:12px;font-weight:bold;"><i class="fa fa-plus"></i> 태그입력</a>
				</div>
			</div>
			<div id="tag-box">
				<div id="tag-cloud">
				<?php if ($tags) { $i = - 1; foreach ($wr_tags as $item) { $i++; ?>
					<div id="tag_box_<?php echo $i ?>"><?php echo $item ?> <i class="fa fa-close" onclick="del_tags('<?php echo $item ?>','<?php echo $i ?>');"></i></div>
				<?php } } ?>
				</div>
			</div>
			<input type="hidden" name="wr_tag" id="wr_tag" value="<?php echo $write["wr_tag"] ?>">
			<input type="hidden" name="del_tag" id="del_tag" value="">
		</section>
		<div class="margin-hr-10"></div>
		<?php } ?>
		<section>
			<div class="wr_content">
				<?php if (!$is_member) { ?>
				<div class="alert alert-danger padding-all-10 margin-bottom-10">
					<strong>Note!</strong> 글쓰기 시 회원만 동영상, 사운드클라우드, 코드, 이모티콘 첨부가 가능합니다.
				</div>
				<?php } ?>
				<div id="write-option">
					<div class="panel panel-default" style="border:0;margin-bottom:0;box-shadow:none">
						<?php if ($eyoom_board["bo_use_addon_video"] == '1') { ?>
						<a class="btn-e btn-e-sm btn-e-default" data-toggle="collapse" data-parent="#write-option" href="#collapse-video-wr">동영상</a>
						<?php } ?>
						<?php if ($eyoom_board["bo_use_addon_soundcloud"] == '1') { ?>
						<a class="btn-e btn-e-sm btn-e-default" data-toggle="collapse" data-parent="#write-option" href="#collapse-sound-wr">사운드클라우드</a>
						<?php } ?>
						<?php if ($eyoom_board["bo_use_addon_coding"] == '1') { ?>
						<a class="btn-e btn-e-sm btn-e-default" data-toggle="collapse" data-parent="#write-option" href="#collapse-code-wr">코드</a>
						<?php } ?>
						<?php if ($eyoom_board["bo_use_addon_map"] == '1') { ?>
						<a class="btn-e btn-e-sm btn-e-default" data-toggle="collapse" data-parent="#write-option" href="#collapse-map-wr">지도</a>
						<?php } ?>
						<?php if ($eyoom_board["bo_use_addon_emoticon"] == '1') { ?>
						<a class="btn-e btn-e-sm btn-e-dark pull-right emoticon" data-type="iframe" title="이모티콘" href="<?php echo EYOOM_CORE_URL ?>/board/emoticon.php">이모티콘</a>
						<?php } ?>
						<div class="clearfix"></div>
						<?php if ($eyoom_board["bo_use_addon_video"] == '1') { ?>
						<div id="collapse-video-wr" class="panel-collapse collapse">
							<div class="write-function-box">
								<label class="input input-file">
									<a href="javascript:;" class="button bg-color-light-grey color-white" id="btn_video" onclick="return false;">확인</a>
									<input type="text" id="video_url" class="form-control" placeholder="동영상주소">
								</label>
							</div>
						</div>
						<?php } ?>
						<?php if ($eyoom_board["bo_use_addon_soundcloud"] == '1') { ?>
						<div id="collapse-sound-wr" class="panel-collapse collapse">
							<div class="write-function-box">
								<div class="row">
									<div class="col col-8">
										<label class="input input-file">
											<a href="javascript:;" class="button bg-color-light-grey color-white" id="btn_scloud" onclick="return false;">확인</a>
											<input type="text" id="scloud_url" class="form-control" placeholder="사운드클라우드 음원주소">
										</label>
									</div>
									<div class="col col-4 text-right">
										<a href="https://soundcloud.com/" target="_blank" class="btn-e btn-e-xs btn-e-light-grey margin-top-5"><i class="fa fa-location-arrow"></i> 사운드클라우드 GO</a>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<?php } ?>
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
						<?php if ($eyoom_board["bo_use_addon_coding"] == '1') { ?>
						<div id="collapse-code-wr" class="panel-collapse collapse">
							<div class="write-function-box">
								<a href="javascript:;" class="ch_code btn-e-xs" onclick="return false;">HTML</a>
								<a href="javascript:;" class="ch_code btn-e-xs" onclick="return false;">PHP</a>
								<a href="javascript:;" class="ch_code btn-e-xs" onclick="return false;">CSS</a>
								<a href="javascript:;" class="ch_code btn-e-xs" onclick="return false;">JS</a>
								<a href="javascript:;" class="ch_code btn-e-xs" onclick="return false;">JAVA</a>
								<a href="javascript:;" class="ch_code btn-e-xs" onclick="return false;">XML</a>
								<a href="javascript:;" class="ch_code btn-e-xs" onclick="return false;">PYTHON</a>
								<a href="javascript:;" class="ch_code btn-e-xs" onclick="return false;">RUBY</a>
								<a href="javascript:;" class="ch_code btn-e-xs" onclick="return false;">SASS</a>
								<a href="javascript:;" class="ch_code btn-e-xs" onclick="return false;">SCALA</a>
								<a href="javascript:;" class="ch_code btn-e-xs" onclick="return false;">SQL</a>
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
<?php if ($eyoom["use_tag"] == 'y' && $eyoom_board["bo_use_tag"] == '1' && $member["mb_level"] >= $eyoom_board["bo_tag_level"]) { ?>
var tag_size = <?php if ($tags) { ?><?php echo $tags ?><?php } else { ?>0<?php } ?>;
$(function(){
	$(".add_tags").click(function(){
		add_tags();
	});
	$("#tmp_tag").blur(function(){
		var tag = $('#tmp_tag').val();
		if(tag) add_tags();
	});

	var add_tags = function() {
		var obj = $('#tmp_tag');
		var tag = obj.val();
		if(!tag) {
			obj.focus();
		} else {
			<?php if (!$is_admin) { ?>
			var count = $('#tag-cloud > div:not(.blind)').length;
			var limit = '<?php echo $eyoom_board["bo_tag_limit"] ?>';
			var max = parseInt(limit)-1;
			if(count > max) {
				alert("태그는 "+limit+"개까지 등록가능합니다.");
				obj.val('');
				obj.focus();
				return;
			}
			<?php } ?>
			var duplicate = false;
			$('#tag-cloud > div:not(.blind)').each(function(){
				if($(this).text().trim() == tag) {
					duplicate = true;
				}
			});
			if(duplicate) {
				alert('중복된 태그입니다.');
				obj.val('');
				obj.focus();
				return;
			}
			var tag_html = $('#tag-cloud').html();
			tag_html += '<div id="tag_box_'+tag_size+'">'+tag+' <i class="fa fa-close" onclick="del_tags(\''+tag+'\',\''+tag_size+'\');"></i></div>';
			$('#tag-cloud').html(tag_html);

			var add_tags = $('#wr_tag').val();
			if(add_tags) {
				add_tags += ',';
			}
			add_tags += tag;
			$('#wr_tag').val(add_tags);

			tag_size++;
			obj.val('');
			obj.focus();
		}
	}
});

function del_tags(tag, num) {
	var del_tags = $('#del_tag').val();
	if(del_tags) {
		del_tags += ',';
	}
	del_tags += tag;
	$('#del_tag').val(del_tags);
	$('#tag_box_'+num).addClass('blind');
}
<?php } ?>
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
#autosave_wrapper {position:relative}
#autosave_pop {display:none;z-index:10;position:absolute;top:10px;right:10px;padding:8px;width:320px;height:auto !important;height:180px;max-height:180px;border:1px solid #565656;background:#fff;overflow-y:scroll}
html.no-overflowscrolling #autosave_pop {height:auto;max-height:10000px !important}
#autosave_pop strong {position:absolute;font-size:0;line-height:0;overflow:hidden}
#autosave_pop div {text-align:right}
#autosave_pop button {margin:0;padding:0;border:0;background:transparent;margin-left:10px}
#autosave_pop ul {margin:10px 0;padding:0;border-top:1px solid #e9e9e9;list-style:none}
#autosave_pop li {padding:8px 5px;border-bottom:1px solid #e9e9e9;zoom:1}
#autosave_pop li:after {display:block;visibility:hidden;clear:both;content:""}
#autosave_pop a {display:block;float:left}
#autosave_pop span {display:block;float:right}
.autosave_close {cursor:pointer}
.autosave_content {display:none}
/* Tag Style */
#tag-box {border:1px dashed #ddd;min-height:20px;padding:5px;background:#fff;margin-top:10px}
#tag-cloud div {border:1px solid #c38c8c;background:#f2dede;padding:1px 5px;display:inline-block;margin:2px 3px;font-size:11px;color:#000}
.blind {position:absolute;top:-10px;left:-100000px;display:none;}
/* Smart Editor Style */
.cke_sc {margin-bottom:10px}
.btn_cke_sc {padding:0 10px}
.cke_sc_def {padding:10px;margin-bottom:10px;margin-top:10px}
.cke_sc_def button {padding:3px 15px;background:#53535a;color:#fff;border:none}
/* CK Editor Style */
.cke_chrome {border:1px solid #ddd !important;box-shadow:none !important}
.cke_top {background:#fafafa !important;border-bottom:1px solid #ddd !important;box-shadow:none !important}
.cke_bottom {background:#fafafa !important;border-top:1px solid #ddd !important;box-shadow:none !important}
.cke_toolgroup {border:1px solid #c5c5c5 !important;border-bottom-color:#c5c5c5 !important;box-shadow:none !important;background:#fff !important;background-image:none !important}
.cke_combo_button {border:1px solid #c5c5c5 !important;border-bottom-color:#c5c5c5 !important;box-shadow:none !important;background:#fff !important;background-image:none !important}
.cke_sc {display:none}
/* Summernote Style */
.board-write .panel-default > .panel-heading {background:#f5f5f5;padding:0 0 5px 5px}
.board-write .note-editor {overflow:inherit}
.board-write .note-editor .note-toolbar .btn-group {display:inline-block;position:relative;vertical-align:middle;}
.board-write .note-editor .note-toolbar .btn-group .btn {padding:5px 10px !important;background-color:#fff;border:1px solid #ccc;margin-left:-1px}
.board-write .note-editor .note-toolbar .btn-group .btn:hover {background-color:#e6e6e6;border-color:#adadad}
.board-write .note-editor .panel-heading.note-toolbar .note-color-palette div .note-color-btn {width:18px;height:18px;padding:0;margin:0;border:1px solid #fff}
.note-dialog .btn {display:inline-block;padding:6px 12px;margin-bottom:0;font-size:12px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-image:none;border:1px solid transparent}
.note-dialog .form-group {margin-bottom:15px;margin-right:0;margin-left:0}
.note-dialog .btn-primary {color: #fff;background-color:#428bca;border-color:#357ebd}
.note-dialog .btn.disabled, .note-dialog .btn[disabled] {pointer-events:none;cursor:not-allowed;filter:alpha(opacity=65);-webkit-box-shadow:none;box-shadow:none;opacity:.65}
.note-dialog .btn-primary.disabled, .note-dialog .btn-primary[disabled] {background-color:#428bca;border-color:#357ebd}
.note-dialog label {display:block;max-width:100%;margin-bottom:5px;font-weight:700}
.note-dialog .input {margin:0;font:inherit;color:inherit}
.note-dialog .form-control {display:block;width:100%;padding:6px 12px;font-size:14px;line-height:1.42857143;color:#555;background-color:#fff;background-image:none;border:1px solid #ccc;-webkit-transition:border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s}
.board-write .note-editor .table-bordered>thead>tr>th, .board-write .note-editor .table-bordered>tbody>tr>th, .board-write .note-editor .table-bordered>tfoot>tr>th, .board-write .note-editor .table-bordered>thead>tr>td, .board-write .note-editor .table-bordered>tbody>tr>td, .board-write .note-editor .table-bordered>tfoot>tr>td {border:1px solid #ddd}
</style>
