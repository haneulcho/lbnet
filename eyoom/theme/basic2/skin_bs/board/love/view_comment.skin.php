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
	<?php if ($comments) { $i = - 1; foreach ($comment as $item) { ;$i++; ?>
	<div class="view-comment">
		<div id="c_<?php echo $item["comment_id"] ?>" class="view-comment-item<?php if ($item["is_lb_admin"]) { ?> admin<?php } ?><?php if ($item["is_cmt_best"]) { ?> cmt-best<?php } ?>">
			<div class="comment-item-body-pn">
				<div style="padding:10px 12px 6px">
				<div class="comment-item-info lbdes" style="<?php if ($item["cmt_depth"] && !$item["is_cmt_best"]) { ?>padding-left:<?php echo $item["cmt_depth"] ?>px;<?php } ?>">
					<span class="comment-name<?php if ($item["cmt_depth"] && !$item["is_cmt_best"]) { ?> lbdepth<?php } ?>"><?php if ($item["is_origin"]) { ?><b><?php echo eb_lbnameview('basic', $item["comment_id"], $item["lb_id"], $item["wr_name"]) ?></b><?php } else { ?><?php echo eb_lbnameview('basic', $item["comment_id"], $item["lb_id"], $item["wr_name"]) ?><?php } ?><?php if ($item["is_mine"]) { ?><b class="color-red">*</b><?php } ?></span> <?php if ($item["is_cmt_best"]) { ?><span class="badge badge-purple">BEST <?php echo $i + 1 ?></span><?php } ?>
					<span class="lbctime lbdes">
					<?php if ($eyoom_board["bo_sel_date_type"] == '1') { ?>
					<i class="fa fa-clock-o color-grey"></i><?php echo $eb->date_time('y-m-d H:i', $item["datetime"]) ?>
					<?php } elseif ($eyoom_board["bo_sel_date_type"] == '2') { ?>
					<i class="fa fa-clock-o color-grey"></i><?php echo $eb->date_format('m.d H:i', $item["datetime"]) ?></span>
					<?php } ?>
					<span class="comment-time">
						<ul class="lbcbtn">
						<?php if ($item["is_edit"]) { ?><li><a href="<?php echo $item["c_edit_href"] ?>" onclick="comment_box('<?php echo $item["comment_id"] ?>', 'cu'); return false;"><i class="fa fa-pencil"></i></a></li><?php } ?>
						<?php if ($item["is_del"]) { ?><li><a href="<?php echo $item["del_link"] ?>" onclick="return comment_delete();"><i class="fa fa-trash-o"></i></a></li><?php } ?>
						<?php if ($item["is_reply"]) { ?><li><a href="<?php echo $item["c_reply_href"] ?>" onclick="comment_box('<?php echo $item["comment_id"] ?>', 'c'); return false;"><i class="fa fa-comment-o"></i>댓글</a></li><?php } ?>
						</ul>
					</span>
				</div>

				<div class="comment-item-contents" style="<?php if ($item["cmt_depth"] && !$item["is_cmt_best"]) { ?>padding-left:<?php echo $item["cmt_depth"] ?>px;<?php } ?>">
				<?php if ($is_ip_view && $is_admin) { ?>
					<div class="comment-item-info lbdes"><span class="comment-ip">(<?php echo $item["lb_id"] ?> / <?php echo $item["lb_nickname"] ?> / <?php echo $item["ip"] ?>)</span></div>
				<?php } ?>
				<p>
					<?php if (strstr($item["wr_option"], 'secret')) { ?><i class="fa fa-lock" style="color:#aaa;"></i> <?php } ?>
					<?php echo $item["comment"] ?>
				</p>
				<?php if (!$item["wr_is_secret"]) { ?>
					<?php if ($item["wr_area"] != '') { ?>
					<div class="lbcinfo">
						<dl><dt>지역</dt><dd><?php echo $item["wr_area"] ?></dd><dt>성향</dt><dd><?php echo $item["wr_type"] ?></dd><dt>나이</dt><dd><?php echo $item["wr_age"] ?></dd></dl>
						<?php if ($item["wr_send_moreinfo"] == '1') { ?>
							<dl><?php if ($item["wr_job"] != '') { ?><dt>직업</dt><dd><?php echo $item["wr_job"] ?></dd><?php } ?><?php if ($item["wr_figure1"] != '') { ?><dt>키</dt><dd><?php echo $item["wr_figure1"] ?></dd><?php } ?><?php if ($item["wr_figure2"] != '') { ?><dt>체형</dt><dd><?php echo $item["wr_figure2"] ?></dd><?php } ?><?php if ($item["wr_etc"] != '') { ?><dt>흡연유무</dt><dd><?php echo $item["wr_etc"] ?></dd><?php } ?><?php if ($item["wr_interest"] != '') { ?><dt>관심사</dt><dd><?php echo $item["wr_interest"] ?></dd><?php } ?></dl>
						<?php } ?>
					</div>
					<?php } ?>
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
	<?php if (count($comment) > 0) { ?>
	<div class="view-comment-more">
		<a id="view-comment-more" href="#" class="btn-e btn-e-red btn-e-lg">댓글 더보기</a>
	</div>
	<?php } ?>
	<?php } ?>
	<!--{* 댓글 끝 *}-->



	<!--{* 댓글 쓰기 시작 *}-->
	<?php if ($is_comment_write) { ?>
	<div id="view-comment-write">
		<form name="fviewcomment" action="./write_comment_update_love.php" onsubmit="return fviewcomment_submit(this);" method="post" autocomplete="off" class="eyoom-form view-comment-write-box" enctype="multipart/form-data">
			<input type="hidden" name="w" value="<?php if (!$w) { ?>c<?php } else { ?><?php echo $w ?><?php } ?>" id="w">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
			<input type="hidden" name="comment_id" value="<?php echo $c_id ?>" id="comment_id">
			<input type="hidden" name="sca" value="<?php echo $sca ?>">
			<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
			<input type="hidden" name="stx" value="<?php echo $stx ?>">
			<input type="hidden" name="spt" value="<?php echo $spt ?>">
			<input type="hidden" name="page" value="<?php echo $page ?>">
			<input type="hidden" name="board_skin_path" value="<?php echo EYOOM_CORE_PATH ?>/board">
			<input type="hidden" name="wr_1" value="<?php echo $wr_1 ?>">
			<input type="hidden" name="cmt_amt" value="<?php echo $cmt_amt ?>">
			<input type="hidden" name="wmode" value="<?php echo $wmode ?>">
			<input type="hidden" name="wr_recv_moreinfo" value="0">

<!-- 댓글 쓰기 영역 -->
			<div class="comment-write-wrap">

				<div id="write_info">
					<div class="col-sm-6 md-margin-bottom-20">
						<fieldset class="lbbox">
							<h3><i class="fa fa-pencil-square-o"></i> <strong>기본정보 입력</strong></h3>
							<dl class="margin-bottom-15">
								<dt>지역</dt>
								<dd>
									<label class="select">
										<select name="wr_area" <?php if (!$is_admin) { ?>required <?php } ?>class="form-control c-select">
											<option value="">지역을 선택하세요.</option>
											<?php
												$area3 = array('서울', '인천/경기', '대전/충청', '광주/전라', '대구/경북', '부산/경남', '강원/제주', '해외');
												for($i = 0; $i < count($area3); $i++) {
											?>
											<option value="<?php echo $area3[$i]; ?>"><?php echo $area3[$i]; ?></option>
											<?php } ?>
										</select>
										<i></i>
									</label>
								</dd>
								<dt>성향</dt>
								<dd>
									<label class="select">
									<select name="wr_type" <?php if (!$is_admin) { ?>required <?php } ?>class="form-control c-select">
										<option value="">성향을 선택하세요.</option>
										<?php
											$type3 = array('팸', '부치', '전천', '무성향');
											for($i = 0; $i < count($type3); $i++) {
										?>
										<option value="<?php echo $type3[$i]; ?>"><?php echo $type3[$i]; ?></option>
										<?php } ?>
									</select>
										<i></i>
									</label>
								</dd>
								<dt>나이</dt>
								<dd>
									<label class="select">
									<select name="wr_age" <?php if (!$is_admin) { ?>required <?php } ?>class="form-control c-select">
										<option value="">나이를 선택하세요.</option>
										<?php
											$age3 = array('20~24', '25~29', '30~34', '35 이상');
											for($i = 0; $i < count($age3); $i++) {
										?>
										<option value="<?php echo $age3[$i]; ?>"><?php echo $age3[$i]; ?></option>
										<?php } ?>
									</select>
										<i></i>
									</label>
								</dd>
							</dl>
						</fieldset>
					</div>
					<div class="col-sm-6 md-margin-bottom-20">
						<fieldset class="lbbox">
							<h3><i class="fa fa-plus-square"></i> <strong>추가정보 입력</strong></h3>
							<?php if ($view["is_moreinfo"]) { ?>
								<input type="hidden" id="wr_send_moreinfo" name="wr_send_moreinfo" value="1"><i></i>
							<?php } else { ?>
							<div class="margin-bottom-15">
								<label for="wr_send_moreinfo" class="col-sm-4 form-control-label">추가정보 입력하기</label><label class="ui-switch primary m-t-xs m-r">
								<input type="checkbox" id="wr_send_moreinfo" name="wr_send_moreinfo" value="0"><i></i>
							</div>
							<?php } ?>
							<div class="alert alert-danger padding-all-10 margin-top-10 margin-bottom-15">
							<?php if ($view["is_moreinfo"]) { ?>
							<strong>Note:</strong> 추가정보 입력시 50포인트 적립 / 원글 니니가 상대 추가정보 받기를 켜두었어요. 댓글 니니는 무조건 추가정보를 입력해야 해요!
							<?php } else { ?>
							<strong>Note:</strong> 추가정보 입력시 50포인트 적립
							<?php } ?>
							</div>
							<?php if ($view["is_moreinfo"]) { ?>
							<dl id="moreinfo">
							<?php } else { ?>
							<dl id="moreinfo" style="display:none">
							<?php } ?>
								<dt>직업</dt>
								<dd>
									<label class="select">
									<select name="wr_job" <?php if ($view["is_moreinfo"]) { ?>required <?php } ?>class="form-control c-select">
										<option value="">직업을 선택하세요.</option>
										<?php
											$job = array('학생', '직장인(주5일)', '직장인(주6일)', '직장인(평일휴무)', '직장인(주말휴무)', '프리랜서', '무직');
											for($i = 0; $i < count($job); $i++) {
										?>
										<option value="<?php echo $job[$i]; ?>"><?php echo $job[$i]; ?></option>
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
										<option value="<?php echo $figure1[$i]; ?>"><?php echo $figure1[$i]; ?></option>
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
										<option value="<?php echo $figure2[$i]; ?>"><?php echo $figure2[$i]; ?></option>
										<?php } ?>
									</select>
										<i></i>
									</label>
								</dd>
								<dt>흡연유무</dt>
								<dd>
									<label for="wr_etc1" class="radio"><input type="radio" id="wr_etc1" name="wr_etc" value="흡연"><i class="rounded-x"></i>흡연</label>
									<label for="wr_etc2" class="radio"><input type="radio" id="wr_etc2" name="wr_etc" value="비흡연"><i class="rounded-x"></i>비흡연</label>
								</dd>
								<dt>관심사</dt>
								<dd>
									<?php
										$wr_interest_array = $wr_interest;
										$interest = array("독서/글쓰기","음악","영화/드라마","게임","운동","덕질","사진/영상","예술","정치/사회","반려동물");
										for($i = 0; $i < count($interest); $i++) {
									?>
										<label for="wr_interest<?php echo $i; ?>" class="checkbox pull-left"><input type="checkbox" id="wr_interest<?php echo $i; ?>" name="wr_interest[]" value="<?php echo $interest[$i]; ?>"><i></i><?php echo $interest[$i]; ?></label>
									<?php } ?>
								</dd>
							</dl>
						</fieldset>
					</div>
				</div>

				<div class="clearfix">
					<section class="col lbwoption">
						<?php if ($is_anonymous) { ?>
						<label class="checkbox pull-left"><input type="checkbox" name="anonymous" value="y" id="anonymous" checked><i></i>익명글</label>
						<?php } ?>
						<label class="checkbox pull-left" style="margin-left:15px;"><input type="checkbox" name="wr_secret" value="secret" id="wr_secret" checked readonly><i></i>비밀글</label>
						<div class="clearfix"></div>
					</section>

					<section class="clearfix">
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

			</div> <!--{* comment-write-wrap END *}-->
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

function fviewcomment_submit(f) {
	var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

	<?php if ($is_anonymous) { ?>
	var wr_1 = '<?php echo $wr_1 ?>';
	if($("#anonymous").is(':checked')) {
		wr_1 = wr_1+'|y';
		f.wr_1.value=wr_1;
	}
	<?php } ?>

	<?php if (!$is_admin) { ?>
	if($('#write_info').length) {
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

	<?php if($is_guest) echo chk_captcha_js();  ?>

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

		if (comment_id && work == 'c' || work == 'cu') {
			el_id = 'reply_' + comment_id;
			// 대댓글일 때는 추가정보 기입칸 제거
			$('#write_info').remove();
		}
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
		}

		document.getElementById('comment_id').value = comment_id;
		document.getElementById('w').value = work;

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
