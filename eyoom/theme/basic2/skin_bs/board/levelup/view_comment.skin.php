<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/venobox/venobox.css" type="text/css" media="screen">', 0);
$comments = empty($comment) || !is_array($comment) ? 0 : count($comment);
include_once(EYOOM_FUNCTION_PATH.'/eb_lbnameview.php');
?>
<script>
// 글자수 제한
var char_min = parseInt(<?php echo $comment_min ?>); // 최소
var char_max = parseInt(<?php echo $comment_max ?>); // 최대
</script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/venobox/venobox.min.js"></script>

<div class="comment-area">
	<!--{* 댓글 시작 *}-->
	<?php if ($comments) { $i = - 1; foreach ($comment as $item) { $i++; ?>
	<div class="view-comment">
		<div id="c_<?php echo $item["comment_id"] ?>" class="view-comment-item<?php if ($item["is_lb_admin"]) { ?> admin<?php } ?><?php if ($item["is_cmt_best"]) { ?> cmt-best<?php } ?>">
			<div class="comment-item-body-pn">
				<div style="padding:10px 12px 6px">
				<div class="comment-item-info lbdes" style="<?php if ($item["cmt_depth"] && !$item["is_cmt_best"]) { ?>padding-left:<?php echo $item["cmt_depth"] ?>px;<?php } ?>">
					<span class="comment-name<?php if ($item["cmt_depth"] && !$item["is_cmt_best"]) { ?> lbdepth<?php } ?>"><?php if ($item["is_origin"]) { ?><b><?php echo eb_lbnameview('basic', $item["comment_id"], $item["lb_id"], $item["wr_name"]) ?></b><?php } else { ?><?php echo eb_lbnameview('basic', $item["comment_id"], $item["lb_id"], $item["wr_name"]) ?><?php } ?><?php if ($item["is_mine"]) { ?><b class="color-red">*</b><?php } ?><?php if ($is_admin) { ?>&nbsp;(<?php echo $item["lb_id"] ?>)<?php } ?></span> <?php if ($item["is_cmt_best"]) { ?><span class="badge badge-purple">BEST <?php echo $i + 1 ?></span><?php } ?>
					<span class="lbctime lbdes">
					<?php if ($eyoom_board["bo_sel_date_type"] == '1') { ?>
					<i class="fa fa-clock-o color-grey"></i><?php echo $eb->date_time('y-m-d H:i', $item["datetime"]) ?>
					<?php } elseif ($eyoom_board["bo_sel_date_type"] == '2') { ?>
					<i class="fa fa-clock-o color-grey"></i><?php echo $eb->date_format('m.d H:i', $item["datetime"]) ?></span>
					<?php } ?>
					<?php if ($is_ip_view && $is_admin) { ?> <span class="comment-ip">&nbsp;<?php echo $item["ip"] ?></span><?php } ?>
					<span class="comment-time">
						<ul class="lbcbtn">
						<?php if ($item["is_edit"]) { ?><li><a href="<?php echo $item["c_edit_href"] ?>" onclick="comment_box('<?php echo $item["comment_id"] ?>', 'cu'); return false;"><i class="fa fa-pencil"></i></a></li><?php } ?>
						<?php if ($item["is_del"]) { ?><li><a href="<?php echo $item["del_link"] ?>" onclick="return comment_delete();"><i class="fa fa-trash-o"></i></a></li><?php } ?>
						<?php if ($item["is_reply"]) { ?><li><a href="<?php echo $item["c_reply_href"] ?>" onclick="comment_box('<?php echo $item["comment_id"] ?>', 'c'); return false;"><i class="fa fa-comment-o"></i>댓글</a></li><?php } ?>
						</ul>
					</span>
				</div>

				<div class="comment-item-contents" style="<?php if ($item["cmt_depth"] && !$item["is_cmt_best"]) { ?>padding-left:<?php echo $item["cmt_depth"] ?>px;<?php } ?>">
				<?php if ($item["yc_blind"] && $item["yc_cannotsee"]) { ?>
				<p>이글은 블라인드 처리된 댓글입니다.</p>
				<?php } else { ?>
				<p>
					<?php if ($item["yc_blind"]) { ?>
					<p>이글은 블라인드 처리된 댓글입니다.</p>
					<?php } ?>
					<?php if (strstr($item["wr_option"], 'secret')) { ?><i class="fa fa-lock" style="color:#aaa;"></i> <?php } ?>
					<?php if ($item["imgsrc"]) { ?>
						<?php if (strstr($item["wr_option"], 'secret')) { ?>
							<?php if ($item["is_myarticle"] || $item["is_mine"]) { ?>
							<a href="<?php echo $item["imgsrc"] ?>" class="venobox" data-gall="lbgall" title="<?php echo $view["wr_subject"] ?>"><img src="<?php echo $item["imgsrc"] ?>" class="img-responsive"></a><br>
							<?php } ?>
						<?php } else { ?>
						<a href="<?php echo $item["imgsrc"] ?>" class="venobox" data-gall="lbgall" title="<?php echo $view["wr_subject"] ?>"><img src="<?php echo $item["imgsrc"] ?>" class="img-responsive"></a><br>
						<?php } ?>
					<?php } ?>
					<?php echo $item["comment"] ?>
				</p>
				<?php } ?>
				</div>

				<div class="comment-btn">
					<?php if ($item["is_reply"] || $item["is_edit"] || $item["is_del"] || $item["c_good_href"] || $item["c_nogood_href"]) { ?>
					<ul class="list-inline reply-list pull-right">
						<?php if ($item["c_good_href"]) { ?>
						<li class="margin-left-5"><a href="<?php echo $item["c_good_href"] ?>" id="goodcmt_button_<?php echo $item["comment_id"] ?>" class="goodcmt_button" type="button" title="공감"><i class="fa fa-thumbs-up"></i> <strong><?php if ($item["good"]) { ?><span class="wow"><?php echo $item["good"] ?></span><?php } else { ?><span>0</span><?php } ?></strong></a></li>
						<?php } ?>
						<?php if ($item["c_nogood_href"]) { ?>
						<li><a href="<?php echo $item["c_nogood_href"] ?>" id="nogoodcmt_button_<?php echo $item["comment_id"] ?>" class="nogoodcmt_button" type="button" title="비공감"><i class="fa fa-thumbs-down"></i> <strong><?php if ($item["nogood"]) { ?><span><?php echo $item["nogood"] ?></span><?php } else { ?><span>0</span><?php } ?></strong></a></li>
						<?php } ?>
					</ul>
					<?php } ?>
				</div>

				</div>
				<div class="clearfix"></div>

				<span id="edit_<?php echo $item["comment_id"] ?>"></span>
				<span id="reply_<?php echo $item["comment_id"] ?>"></span>

				<input type="hidden" value="<?php echo strstr($item["wr_option"], 'secret') ?>" id="secret_comment_<?php echo $item["comment_id"] ?>">
				<input type="hidden" value="<?php echo $item["anonymous_id"] ?>" id="anonymous_id_<?php echo $item["comment_id"] ?>">
				<input type="hidden" value="<?php echo $item["imgname"] ?>" id="imgname_<?php echo $item["comment_id"] ?>">
				<textarea id="save_comment_<?php echo $item["comment_id"] ?>" style="display:none"><?php echo $item["content1"] ?></textarea>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
		<?php } } ?>
	<?php if ($eyoom_board["bo_use_cmt_infinite"] == '1') { ?>
	<div id="infinite_pagination">
		<a class="next" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>&wr_id=<?php echo $wr_id ?>&sca=<?php echo $sca ?>&cpage=<?php echo $cpage + 1 ?>"></a>
	</div>
	<?php if (count($cmt_list) > 0) { ?>
	<div class="view-comment-more">
		<a id="view-comment-more" href="#" class="btn-e btn-e-red btn-e-lg">댓글 더보기</a>
	</div>
	<?php } ?>
	<?php } ?>
	<!--{* 댓글 끝 *}-->

	<!--{* 댓글 쓰기 시작 *}-->
	<?php if ($is_comment_write) { ?>
	<div id="view-comment-write">
		<form name="fviewcomment" action="./write_comment_update.php" onsubmit="return fviewcomment_submit(this);" method="post" autocomplete="off" class="eyoom-form view-comment-write-box" enctype="multipart/form-data">
			<input type="hidden" name="w" value="<?php if (!$w) { ?>c<?php } else { ?><?php echo $w ?><?php } ?>" id="w">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
			<input type="hidden" name="comment_id" value="<?php echo $c_id ?>" id="comment_id">
			<input type="hidden" name="sca" value="<?php echo $sca ?>">
			<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
			<input type="hidden" name="stx" value="<?php echo $stx ?>">
			<input type="hidden" name="spt" value="<?php echo $spt ?>">
			<input type="hidden" name="page" value="<?php echo $page ?>">
			<input type="hidden" name="is_good" value="">
			<input type="hidden" name="board_skin_path" value="<?php echo EYOOM_CORE_PATH ?>/board">
			<input type="hidden" name="wr_1" value="<?php echo $wr_1 ?>">
			<input type="hidden" name="cmt_amt" value="<?php echo $cmt_amt ?>">
			<input type="hidden" name="wmode" value="<?php echo $wmode ?>">

<!-- 댓글 쓰기 영역 -->
			<div class="comment-write-wrap">
				<div class="row">
					<?php if (!$is_member) { ?>
					<section class="col col-4">
						<label for="wr_name" class="label">이름<strong class="sound_only"> 필수</strong></label>
						<label class="input">
						<i class="icon-append fa fa-user"></i>
						<input type="text" name="wr_name" value="<?php echo get_cookie('ck_sns_name') ?>" id="wr_name" required size="5" maxLength="20">
						</label>
					</section>
					<section class="col col-4">
						<label for="wr_password" class="label">비밀번호<strong class="sound_only"> 필수</strong></label>
						<label class="input">
							<i class="icon-append fa fa-lock"></i>
							<input type="password" name="wr_password" id="wr_password" required size="10" maxLength="20">
						</label>
					</section>
					<?php } ?>
					<section class="col lbwoption">
						<?php if ($is_anonymous) { ?>
						<label class="checkbox pull-left"><input type="checkbox" name="anonymous" value="y" id="anonymous" checked><i></i>익명글</label>
						<?php } ?>
						<label class="checkbox pull-left" style="margin-left:15px;"><input type="checkbox" name="wr_secret" value="secret" id="wr_secret"><i></i>비밀글</label>
						<?php if ($eyoom_board["bo_use_addon_cmtimg"] == '1') { ?>
						<span class="lbimage">
						<a data-toggle="collapse" data-parent="#comment-option" href="#collapse-image-cm"><i class="fa fa-picture-o"></i>이미지 첨부</a>
						</span>
						<?php } ?>
						<div class="clearfix"></div>
					</section>
				</div>

				<?php if ($board["bo_use_sns"] && ($config["cf_facebook_appid"] || $config["cf_twitter_key"])) { ?>
				<label class="label">SNS 동시등록</label>
				<div id="bo_vc_send_sns"></div>
				<div class="clear"></div>
				<?php } ?>

				<section>
					<div id="comment-option">
						<div class="panel panel-default" style="border:0;margin-bottom:0;box-shadow:none">
							<div class="clearfix"></div>
							<div id="collapse-image-cm" class="panel-collapse collapse">
								<div class="comment-function-box">
									<label for="file" class="input input-file">
										<div class="button bg-color-light-grey"><input type="file" id="file" name="cmt_file[]" value="이미지선택" title="파일첨부 : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" onchange="this.parentNode.nextSibling.value = this.value">Image</div><input type="text" readonly>
									</label>
									<div id="del_cmtimg"></div>
								</div>
							</div>
						</div>
					</div>
					<label class="textarea textarea-resizable">
						<?php if ($comment_min || $comment_max) { ?><strong id="char_cnt"><span id="char_count"></span>글자</strong><?php } ?>
						<textarea rows="7" id="wr_content" name="wr_content" maxlength="10000" required title="내용" <?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php } ?>><?php echo $c_wr_content ?></textarea>
						<?php if ($comment_min || $comment_max) { ?><script> check_byte('wr_content', 'char_count'); </script><?php } ?>
						<script>
						$("textarea#wr_content[maxlength]").live("keyup change", function() {
							var str = $(this).val()
							var mx = parseInt($(this).attr("maxlength"))
							if (str.length > mx) {
								$(this).val(str.substr(0, mx));
								return false;
							}
						});
						</script>
					</label>
				</section>

				<?php if (!$is_member) { ?>
				<section>
					<label class="label">자동등록방지</label>
					<div class="vc-captcha"><?php echo $captcha_html ?></div>
				</section>
				<?php } ?>
				<div class="comment-write-submit">
					<button type="submit" id="btn_submit" class="btn-e btn-e-lg btn-e-yellow" value="댓글등록"><i class="fa fa-paper-plane" aria-hidden="true"></i> 입력</button>
				</div>
			</div>

		</form>
	</div>
	<?php } ?>
	<!--{* 댓글 쓰기 끝 *}-->
</div><!--{* End comment-area *}-->

<?php if ($eyoom_board["bo_use_cmt_infinite"] == '1') { ?>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/masonry/jquery.masonry.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/infinite-scroll/jquery.infinitescroll.min.js"></script>
<?php } ?>

<script>
var save_before = '';
var save_html = document.getElementById('view-comment-write').innerHTML;

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
		content = '{code:'+value+'}\n\n{/code}\n'
	}
	var wr_html = $("#wr_content").val();
	var wr_emo = content;
	wr_html += wr_emo;
	$("#wr_content").val(wr_html);
}

function good_and_write()
{
	var f = document.fviewcomment;
	if (fviewcomment_submit(f)) {
		f.is_good.value = 1;
		f.submit();
	} else {
		f.is_good.value = 0;
	}
}

function fviewcomment_submit(f) {
	var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

	f.is_good.value = 0;

	<?php if ($is_anonymous) { ?>
	var wr_1 = '<?php echo $wr_1 ?>';
	if($("#anonymous").is(':checked')) {
		wr_1 = wr_1+'|y';
		f.wr_1.value=wr_1;
	}
	<?php } ?>

	var subject = "";
	var content = "";
	$.ajax({
		url: g5_bbs_url+"/ajax.filter.php",
		type: "POST",
		data: {
			"subject": "",
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

	if (content) {
		alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
		f.wr_content.focus();
		return false;
	}

	// 양쪽 공백 없애기
	var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
	document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
	if (char_min > 0 || char_max > 0)
	{
		check_byte('wr_content', 'char_count');
		var cnt = parseInt(document.getElementById('char_count').innerHTML);
		if (char_min > 0 && char_min > cnt)
		{
			alert("댓글은 "+char_min+"글자 이상 쓰셔야 합니다.");
			return false;
		} else if (char_max > 0 && char_max < cnt)
		{
			alert("댓글은 "+char_max+"글자 이하로 쓰셔야 합니다.");
			return false;
		}
	}
	else if (!document.getElementById('wr_content').value)
	{
		alert("댓글을 입력하여 주십시오.");
		return false;
	}

	if (typeof(f.wr_name) != 'undefined')
	{
		f.wr_name.value = f.wr_name.value.replace(pattern, "");
		if (f.wr_name.value == '')
		{
			alert('이름이 입력되지 않았습니다.');
			f.wr_name.focus();
			return false;
		}
	}

	if (typeof(f.wr_password) != 'undefined')
	{
		f.wr_password.value = f.wr_password.value.replace(pattern, "");
		if (f.wr_password.value == '')
		{
			alert('비밀번호가 입력되지 않았습니다.');
			f.wr_password.focus();
			return false;
		}
	}

	<?php if ($is_guest) echo chk_captcha_js(); ?>

	document.getElementById("btn_submit").disabled = "disabled";

	return true;
}

function comment_box(comment_id, work)
{
	var el_id;
	// 댓글 아이디가 넘어오면 답변, 수정
	if (comment_id)
	{
		if (work == 'c') {
			el_id = 'reply_' + comment_id;
		} else {
			el_id = 'edit_' + comment_id;
		}
		$('#' + el_id).addClass('writing');
	} else {
		el_id = 'view-comment-write';
		$('#' + el_id).removeClass('writing');
	}

	if (save_before != el_id)
	{
		if (save_before)
		{
			document.getElementById(save_before).style.display = 'none';
			document.getElementById(save_before).innerHTML = '';
		}

		document.getElementById(el_id).style.display = '';
		document.getElementById(el_id).innerHTML = save_html;
		// 댓글 수정
		if (work == 'cu')
		{
			document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
			if (typeof char_count != 'undefined')
				check_byte('wr_content', 'char_count');
			if (document.getElementById('secret_comment_'+comment_id).value)
				document.getElementById('wr_secret').checked = true;
			else
				document.getElementById('wr_secret').checked = false;
			<?php if ($is_anonymous) { ?>
			if (document.getElementById('anonymous_id_'+comment_id).value)
				document.getElementById('anonymous').checked = true;
			else
				document.getElementById('anonymous').checked = false;
			<?php } ?>
			var imgname = document.getElementById('imgname_' + comment_id).value;
			if(imgname) {
				var delchk_str = '<label class="checkbox"><input type="checkbox" name="del_cmtimg" value="1"><i></i><span class="font-size-12">파일삭제 ('+imgname+')</span></label>';
				$("#del_cmtimg").html('');
				$("#del_cmtimg").html(delchk_str);
			}
		}

		document.getElementById('comment_id').value = comment_id;
		document.getElementById('w').value = work;

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
			$("#scloud_url").val('');
		});
		<?php } ?>

		if(save_before)
			$("#captcha_reload").trigger("click");

		save_before = el_id;
	}
}

function comment_delete()
{
	return confirm("이 댓글을 삭제하시겠습니까?");
}

comment_box('', 'c'); // 댓글 입력폼이 보이도록 처리하기위해서 추가 (root님)

<?php if ($board["bo_use_sns"] && ($config["cf_facebook_appid"] || $config["cf_twitter_key"])) { ?>
// sns 등록
$(function() {
	$("#bo_vc_send_sns").load(
		"<?php echo G5_SNS_URL ?>/view_comment_write.sns.skin.php?bo_table=<?php echo $bo_table ?>",
		function() {
			save_html = document.getElementById('view-comment-write').innerHTML;
		}
	);
});
<?php } ?>
</script>

<script>
$(function() {
	// 댓글 추천, 비추천
	$(".goodcmt_button, .nogoodcmt_button").click(function() {
		excute_goodcmt(this.href, $(this));
		return false;
	});

	<?php if ($eyoom_board["bo_use_yellow_card"] == '1') { ?>
	// 신고버튼 클릭시, 댓글 cmt_id 설정
	$(".cmt_yellow_card, .cancel_cmt_yellow_card").click(function() {
		var cmt_id = $(this).attr('data-cmt-id');
		$(".yellowcard-modal #modal_cmt_id").val(cmt_id);
	});
	<?php } ?>
});

function excute_goodcmt(href, $el)
{
	var msg = ($el.hasClass('nogoodcmt_button')) ? '비추천' : '추천';
	var confirmed = confirm('이 댓글을 ' + msg + ' 하시겠습니까?');
	if (confirmed) {
		$.post(
			href,
			{ js: "on" },
			function(data) {
				if(data.error) {
					alert(data.error);
					return false;
				}

				if(data.count) {
					$el.find("strong").text(number_format(String(data.count)));
				}
			}, "json"
		);
	} else {
		return;
	}
}
</script>
<?php if ($eyoom_board["bo_use_cmt_infinite"] == '1') { ?>
<script>
$(document).ready(function(){
	var $container = $('.view-comment');

	$container.infinitescroll({
		navSelector  : "#infinite_pagination",
		nextSelector : "#infinite_pagination .next",
		itemSelector : ".view-comment-item",
		loading: {
			finishedMsg: 'END',
			img: '../../../image/loading.gif'
		}
	},

	function( newElements ) {
		var $newElems = $( newElements ).css({ opacity: 0 });
		$newElems.imagesLoaded(function(){
			$newElems.animate({ opacity: 1 });
			$container.append($newElems);
		});
	});

	$(window).unbind('.infscr');

	$('#view-comment-more').click(function(){
	   $container.infinitescroll('retrieve');
	   $('#infinite_pagination').show();
		return false;
	});
});
</script>
<?php } ?>
