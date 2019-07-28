<?php if (!defined('_GNUBOARD_')) exit;
$view_files = empty($view_file) || !is_array($view_file) ? 0 : count($view_file);
$tags = empty($view_tags) || !is_array($view_tags) ? 0 : count($view_tags);
include_once(EYOOM_FUNCTION_PATH.'/eb_lbnameview.php');
?>
<div class="board-area">
<article class="board-view">
	<section class="board-view-info">
		<div class="pull-left">
			<div class="lbdes<?php if ($view["is_lb_admin"]) { ?> admin<?php } ?>">
			<span class="lbnick"><?php if ($view["is_mine"]) { ?><?php echo eb_lbnameview('basic',$view["wr_id"],$view["lb_id"],$view["wr_name"]) ?><b class="color-red">*</b><?php }else{?><?php echo eb_lbnameview('basic', $view["wr_id"], $view["lb_id"], $view["wr_name"]) ?><?php } ?></span>
			<span class="lbhit"><i class="fa fa-eye"></i><?php echo number_format($view["wr_hit"]) ?>
			</span>
			<span class="lbtime"><i class="fa fa-clock-o"></i><?php if ($eyoom_board["bo_sel_date_type"] == '1') { ?>
			<?php echo $eb->date_time('m-d H:i', $view["wr_datetime"]) ?><?php } elseif ($eyoom_board["bo_sel_date_type"] == '2') { ?><?php echo $eb->date_format('Y.m.d', $view["wr_datetime"]) ?><?php } ?></span>
			<?php if ($is_ip_view && $is_admin) { ?>
			<div class="margin-bottom-0 margin-top-10"><span>(<?php echo $view["lb_id"] ?> / <?php echo $view["lb_nickname"] ?> / <?php echo $ip ?>)</span></div>
			<?php } ?>
			</div>
		</div>
		<div class="clearfix"></div>
	</section>

	<?php if ($cnt > 0 && $is_admin) { ?>
	<!--{* 첨부파일 시작 *}-->
	<section class="board-view-file">
		<h2>첨부파일</h2>
		<ul class="list-unstyled">
		<?php if ($view_files) { foreach ($view_file as $item) { ?>
			<li>
				<div class="pull-left">
					- 첨부파일: <a href="<?php echo $item["href"] ?>" class="view_file_download"><strong><?php echo $item["source"] ?></strong> <?php echo $item["content"] ?> (<?php echo $item["size"] ?>)</a>
				</div>
				<div class="pull-right text-right">
					<span><i class="fa fa-download color-grey"></i> <?php echo $item["download"] ?></span>
					<span><i class="fa fa-clock-o color-grey"></i> <?php echo $item["datetime"] ?></span>
				</div>
				<div class="clearfix"></div>
			</li>
		<?php } } ?>
		</ul>
	</section>
	<!--{* 첨부파일 끝 *}-->
	<?php } ?>

	<?php if ($eyoom_board["bo_use_rating"] == '1') { ?>
	<section class="board-view-star">
		<h2>별점</h2>
		<ul class="list-unstyled star-ratings-view">
			<li>- 별점통계: </li>
			<li><i class="rating<?php if ($rating["star"] > 0) { ?>-selected<?php } ?> fa fa-star"></i></li>
			<li><i class="rating<?php if ($rating["star"] > 1) { ?>-selected<?php } ?> fa fa-star"></i></li>
			<li><i class="rating<?php if ($rating["star"] > 2) { ?>-selected<?php } ?> fa fa-star"></i></li>
			<li><i class="rating<?php if ($rating["star"] > 3) { ?>-selected<?php } ?> fa fa-star"></i></li>
			<li><i class="rating<?php if ($rating["star"] > 4) { ?>-selected<?php } ?> fa fa-star"></i></li>
			<li class="margin-left-5">- 평점 : <?php echo $rating["point"] ?>점 (<?php echo number_format($rating["members"]) ?>명 참여)</li>
		</ul>
		<div class="clearfix"></div>
	</section>
	<?php } ?>

	<!--{* 게시물 상단 버튼 시작 *}-->
	<?php if ($prev_href || $next_href) { ?>
	<div class="view-top-btn">
		<ul class="top-btn-left list-unstyled pull-left">
			<?php if ($prev_href) { ?><li><a href="<?php echo $prev_href ?>" class="btn-e btn-e-light-grey" type="button">이전글</a></li><?php } ?>
			<?php if ($next_href) { ?><li><a href="<?php echo $next_href ?>" class="btn-e btn-e-light-grey" type="button">다음글</a></li><?php } ?>
		</ul>
		<div class="clearfix"></div>
	</div>
	<?php } ?>
	<!--{* 게시물 상단 버튼 끝 *}-->

	<section class="board-view-atc">
		<h4 class="lbvtitle">
		<?php if ($category_name) { ?><span class="lbvcate">[<?php echo $view["ca_name"] ?>]</span><?php } ?>
		<strong><?php echo cut_str(get_text($view["wr_subject"]), 70)?></strong>
		</h4>

		<?php if ($view["ca_name"] == '공지') { ?>
		<?php echo $file_conts ?>
		<?php } else { ?>
			<?php if ($is_admin || $view["is_mine"]) { ?>
			<?php echo $file_conts ?>
			<?php } ?>
		<?php } ?>

		<!--{* 본문 내용 시작 *}-->
		<div class="board-view-con view-content">
			<?php if ($ycard["yc_blind"] == 'y') { ?>
				<?php if ($is_admin) { ?>
			  <p class='text-center'>-- 블라인드 처리된 글입니다. --</p>
			  <?php echo $view_content ?>
			<? } else { ?>
			  <p class='text-center'>-- 블라인드 처리된 글입니다. --</p>
			<?php } ?>
		  <? } else { ?>
			<?php if ($view["ca_name"] == '공지') { ?>
				<?php echo $view_content ?>
			<? } else { ?>
				<?php if ($is_admin || $view["is_mine"]) { ?>
				<?php echo $view_content ?>
				<? } else { ?>
					<p>* 글쓴이와 운영진만 게시글 내용을 확인할 수 있습니다!</p>
				<?php } ?>
			<?php } ?>
		  <?php } ?>
		</div>
		<?php if (($is_admin) && $view["ca_name"] != '공지') { ?>
			<div class="lbvinfo lbvinfo_default">
				<h2><i class="fa fa-star"></i>레볼루션에 등록된 정보</h2>
				<dl>
					<dt>닉네임</dt>
					<dd><?php echo $view["lb_nickname"] ?></dd>
					<dt>아이디</dt>
					<dd><?php echo $view["lb_id"] ?></dd>
					<dt>이메일</dt>
					<dd><?php echo $view["lb_email"] ?></dd>
				</dl>
			</div>
			<?php if (($is_admin) && $view["ca_name"] != '완료') { ?>
				<form name="flevelup" id="flevelup" action="./levelup_update.php" method="post" enctype="multipart/form-data" autocomplete="off" class="eyoom-form margin-bottom-20">
				<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
				<input type="hidden" name="mb_id" value="<?php echo $view["lb_id"] ?>">
				<input type="hidden" name="wr_id" value="<?php echo $view["wr_id"] ?>">
				<input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>">
					<div class="text-center">
						<p style="margin-bottom:10px">첨부된 사진의 아이디, 이메일과 레볼루션에 등록된 정보가 일치하는지 확인하신 후, 등업하기를 눌러 주세요.<br><strong>*등업하기 버튼을 누르시면 취소하실 수 없습니다!</strong></p>
						<button type="submit" id="btn_submit" class="btn-e btn-e-lg btn-e-yellow margin-top-m-2">등업하기</button>
					</div>
				</form>
			<?php } ?>
		<?php } ?>
		<!--{* 본문 내용 끝 *}-->

		<?php if ($eyoom["use_tag"] == 'y' && $eyoom_board["bo_use_tag"] == '1' && $tags > 0) { ?>
		<div class="board-view-tag">
			<i class="fa fa-tags"></i>
			<?php if ($tags) { foreach ($view_tags as $item) { ?>
			<span><a href="<?php echo $item["href"] ?>"><?php echo $item["tag"] ?></a></span>
			<?php } } ?>
			<div class="clearfix"></div>
		</div>
		<?php } ?>

		<!--{* 추천 비추천 시작 *}-->
		<?php if ($good_href || $nogood_href == '1') { ?>
		<div class="board-view-good-btn">
			<?php if ($good_href) { ?>
			<span class="board-view-act-gng">
				<a href="<?php echo $good_href ?>&amp;<?php echo $qstr ?>" id="good_button" class="act-gng-btn" type="button"><i class="fa fa-thumbs-up"></i><span><?php echo number_format($view["wr_good"]) ?></span><div class="mask"><h5>좋아요!</h5></div></a>
			</span>
		  <b class="board-view-act-good"></b>
			<?php } ?>
			<?php if ($nogood_href) { ?>
			<span class="board-view-act-gng">
				<a href="<?php echo $nogood_href ?>&amp;<?php echo $qstr ?>" id="nogood_button" class="act-gng-btn" type="button"><i class="fa fa-thumbs-down"></i><span><?php echo number_format($view["wr_nogood"]) ?></span><div class="mask"><h5>글쎄요~</h5></div></a>
			</span>
		  <b class="board-view-act-nogood"></b>
			<?php } ?>
		</div>
		<?php } ?>
		<!--{* 추천 비추천 끝 *}-->

		<!--{* 별점평가 시작 *}-->
		<?php if ($eyoom_board["bo_use_rating"] == '1' && $is_member) { ?>
		<form class="eyoom-form">
		<div class="eb-rating clearfix">
			<div class="rating">
				<input type="radio" name="quality" id="quality-5" value="5">
				<label for="quality-5"><i class="fa fa-star"></i></label>
				<input type="radio" name="quality" id="quality-4" value="4">
				<label for="quality-4"><i class="fa fa-star"></i></label>
				<input type="radio" name="quality" id="quality-3" value="3">
				<label for="quality-3"><i class="fa fa-star"></i></label>
				<input type="radio" name="quality" id="quality-2" value="2">
				<label for="quality-2"><i class="fa fa-star"></i></label>
				<input type="radio" name="quality" id="quality-1" value="1">
				<label for="quality-1"><i class="fa fa-star"></i></label>
				<strong>별점평가하기</strong>
			</div>
		</div>
		</form>
		<?php } ?>
		<!--{* 별점평가 끝 *}-->

		<!--{* 스크랩 신고 블라인드 시작 *}-->
		<div class="board-view-btn">
		<?php if ($is_admin) { ?>
			<?php if ($copy_href) { ?><a href="<?php echo $copy_href ?>" class="btn-e btn-e-light-grey" type="button" onclick="board_move(this.href); return false;">복사</a><?php } ?>
			<?php if ($move_href) { ?><a href="<?php echo $move_href ?>" class="btn-e btn-e-light-grey" type="button" onclick="board_move(this.href); return false;">이동</a><?php } ?>
		<?php } ?>
		<?php if ($update_href) { ?><a href="<?php echo $update_href ?>" class="lbbtn_light" type="button"><i class="fa fa-pencil"></i>수정</a><?php } ?>
		<?php if ($delete_href) { ?>
			<?php if ($view["is_declared"]) { ?>
			<a href="<?php echo $delete_href ?>" class="lbbtn_light" type="button" onclick="alert('신고된 댓글이 존재하여 삭제할 수 없습니다.\n글 삭제 요청은 문의방에 부탁드립니다.'); return false;"><i class="fa fa-trash-o"></i>삭제</a>
			<?php } else { ?>
			<a href="<?php echo $delete_href ?>" class="lbbtn_light" type="button" onclick="del(this.href); return false;"><i class="fa fa-trash-o"></i>삭제</a>
			<?php } ?>
		<?php } ?>

		<?php if ($eyoom_board["bo_use_yellow_card"] == '1') { ?>
			<?php if ($eyoom_board["bo_use_yellow_card"] == '1' && $is_member) { ?>

				<?php if ($view["is_mine"]) { ?>
					<button id="yellow_card" class="lbbtn_light" onclick="javascript:alert('자신의 글은 신고할 수 없습니다!')"><i class="fa fa-exclamation-triangle"></i>신고 <span><?php echo number_format($ycard["yc_count"]) ?></span></button>
				<? } else { ?>
					<?php if (!$mb_ycard["mb_id"]) { ?>
						<button id="yellow_card" class="lbbtn_light" data-toggle="modal" data-target=".yellowcard-modal"><i class="fa fa-exclamation-triangle"></i>신고 <span><?php echo number_format($ycard["yc_count"]) ?></span></button>
					<? } else { ?>
						<button id="cancel_yellow_card" class="lbbtn_light">신고 취소 <span><?php echo number_format($ycard["yc_count"]) ?></span></button>
					<?php } ?>
				<?php } ?>

				<?php if ($is_admin) { ?>
					<?php if ($blind_direct) { ?>
						<?php if ($ycard["yc_blind"]!='y') { ?>
						<button id="direct_blind" class="lbbtn_light btn-blind">블라인드</button>
						<?php } elseif ($ycard["yc_blind"] == 'y') { ?>
						<button id="cancel_blind" class="btn-e btn-e-red btn-blind">블라인드 취소</button>
						<?php } ?>
					<?php } ?>
				<?php } ?>

			<?php } ?>
		<?php } ?>
	  </div>
		<!--{* 스크랩 신고 블라인드 끝 *}-->
	</section>

	<!--{* 댓글 시작 *}-->
	<?php include_once($cmt_bs) ?>
	<!--{* 댓글 끝 *}-->

	<!--{* 링크 버튼 시작 *}-->
	<div class="board-view-bot">
		<?php echo $link_buttons ?>
	</div>
	<!--{* 링크 버튼 끝 *}-->

</article>
<div class="board-list-footer margin-top-10">
  <div class="pull-left">
	<ul class="list-unstyled board-btn-adm pull-left">
		<li><a href="<?php echo $list_href ?>" <?php if ($wmode) { ?>onclick="close_modal();return false;"<?php } ?> class="btn-e btn-e-dark" type="button">목록</a></li>
	</ul>
  </div>
  <div class="pull-right">
  <?php if ($list_href || $write_href) { ?>
	<ul class="list-unstyled pull-right">
	<?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn-e btn-e-red" type="button">글쓰기</a></li><?php } ?>
	</ul>
	<?php } ?>
  </div>
  <div class="clearfix"></div>
</div>
</div> <!-- board-area END -->
<div class="margin-bottom-10"></div>

<?php if ($eyoom_board["bo_use_yellow_card"] == '1') { ?>
<div class="modal fade yellowcard-modal" tabindex="-1" role="dialog" aria-labelledby="yellowcardModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h6 id="myLargeModalLabel" class="modal-title"><strong>게시물 신고하기</strong></h6>
			</div>
			<div class="modal-body">
				<!--{* 게시판 검색 시작 *}-->
				<fieldset id="bo_ycard" class="eyoom-form">
					<!--{* <legend>게시물 검색</legend> *}-->
					<form name="fycard">
					<input type="hidden" name="modal_cmt_id" id="modal_cmt_id" value="">
					<label for="sfl" class="sound_only">신고사유</label>
					<label class="label">신고 항목을 선택하고 사유를 적어 주세요.</label>
					<section class="bg-light">
						<div class="inline-group margin-bottom-0">
							<label class="radio" for="ycard_reason_1">
								<input type="radio" name="ycard_reason" id="ycard_reason_1" value="1"><i class="rounded-x"></i>광고성
							</label>
							<label class="radio" for="ycard_reason_2">
								<input type="radio" name="ycard_reason" id="ycard_reason_2" value="2"><i class="rounded-x"></i>음란성
							</label>
							<label class="radio" for="ycard_reason_3">
								<input type="radio" name="ycard_reason" id="ycard_reason_3" value="3"><i class="rounded-x"></i>비방성
							</label>
							<label class="radio" for="ycard_reason_4">
								<input type="radio" name="ycard_reason" id="ycard_reason_4" value="4"><i class="rounded-x"></i>혐오성
							</label>
							<label class="radio" for="ycard_reason_5">
								<input type="radio" name="ycard_reason" id="ycard_reason_5" value="5"><i class="rounded-x"></i>기타
							</label>
						</div>
						<textarea rows="7" id="ycard_memo" class="textarea" style="width:100%" name="ycard_memo" maxlength="10000" required="required" title="신고 상세사유"></textarea>
					</section>
					<div class="alert alert-danger padding-all-10 margin-top-10 margin-bottom-15">
						<strong>Note:</strong> 반드시 신고 사유를 적어 주세요. (미기입 시 운영진 확인 후 신고 취소 처리)
					</div>
					<div class="text-center margin-top-20 margin-bottom-10">
						<button type="button" class="btn-e btn-e-red">신고하기</button>
					</div>
					</form>
				</fieldset>
				<!--{* 게시판 검색 끝 *}-->
			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn-e btn-e-dark" type="button">닫기</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<!-- <script src="/js/viewimageresize.js"></script> -->

<?php if ($eyoom_board["bo_use_addon_map"] == '1') { ?>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script src="http://openapi.map.naver.com/openapi/naverMap.naver?ver=2.0&key=네이버지도_api_key"></script>
<script src="http://apis.daum.net/maps/maps3.js?apikey=다음_api_key"></script>
<script src="/eyoom/theme/basic2/js/eyoom.map.js"></script>
<script>
$(function(){
	$(".map-content-wrap").each(function(){
		var id      = $(this).find('div').attr('id');
		var type    = $(this).attr('data-map-type');
		var name    = $(this).attr('data-map-name');
		var x       = $(this).attr('data-map-x');
		var y       = $(this).attr('data-map-y');
		var address = $(this).attr('data-map-address');

		switch(type) {
			case 'google':
				loading_google_map(id, x, y, name, address);
				break;
			case 'naver':
				loading_naver_map(id, x, y, name, address);
				break;
			case 'daum':
				loading_daum_map(id, x, y, name, address);
				break;
		}
	});
});
</script>
<?php } ?>

<script>
<?php if ($board["bo_download_point"] < 0) { ?>
$(function() {
	$("a.view_file_download").click(function() {
		if(!g5_is_member) {
			alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
			return false;
		}

		var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board["bo_download_point"]) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

		if(confirm(msg)) {
			var href = $(this).attr("href")+"&js=on";
			$(this).attr("href", href);

			return true;
		} else {
			return false;
		}
	});
});
<?php } ?>

function close_modal(wr_id) {
	window.parent.closeModal(wr_id);
}

function board_move(href)
{
	window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
$(function() {
	// 본문, 댓글 이미지 갤러리 처리
	$('.venobox').venobox({
	  numeratio: true,
	  infinigall: true
	});

	// 추천, 비추천
	$("#good_button, #nogood_button").click(function() {
		var $tx;
		if(this.id == "good_button")
			$tx = $(".board-view-act-good");
		else
			$tx = $(".board-view-act-nogood");

		excute_good(this.href, $(this), $tx);
		return false;
	});

	<?php if ($eyoom_board["bo_use_yellow_card"] == '1' && $is_member) { ?>
	// 게시물 신고
	$('body').on('click', '.yellowcard-modal .modal-body button', function () {
		var cmt_id = $("#modal_cmt_id").val();
		var yc_reason = $(':radio[name="ycard_reason"]:checked').val();
		var yc_memo = $('#ycard_memo').val();
		if (!yc_reason) {
			alert('신고 항목을 선택해 주세요.');
			return;
		} else if (!yc_memo) {
			alert('신고 사유를 작성해 주세요.');
			$('#ycard_memo').focus();
			return;
		} else {
			$.post(
				'<?php echo EYOOM_CORE_URL?>/board/yellow_card.php',
				{ bo_table: "<?php echo $bo_table ?>", wr_id: "<?php echo $wr_id ?>", cmt_id: cmt_id, action: "add", reason: yc_reason, memo: yc_memo },
				function(data) {
					if(data.count && !data.error) {
						if(!cmt_id) {
							if($('#yc_card').text() == '') {
								$('#yellow_card').wrap('<span id="yc_card"></span>');
							} else {
								$('#yc_card').html('');
							}
							$('#yellow_card').remove();
							var yc_html = '<button id="cancel_yellow_card" class="btn-e btn-e-dark"><i class="fa fa-exclamation-triangle"></i> 신고 취소 <span>' + number_format(String(data.count)) + '</span></button>';
							$('#yc_card').html(yc_html);
						} else {
							var obj = $("#cmt_yellow_card_li_"+cmt_id);
							obj.html('');
							$("#modal_cmt_id").val('');
							var yc_html = '<button id="cancel_cmt_yellow_card_'+cmt_id+'" class="lbbtn_light cancel_cmt_yellow_card" data-cmt-id="'+cmt_id+'"><i class="fa fa-exclamation-triangle"></i> <span>' + number_format(String(data.count)) + '</span></button>';
							obj.html(yc_html).attr('id', 'cancel_cmt_yellow_card_li_'+cmt_id);
						}
					}
					if(data.msg) alert(data.msg);
					$('.yellowcard-modal').modal('hide');
				}, "json"
			);
		}
	});

	// 게시물 신고 취소
	$('body').on('click', '#cancel_yellow_card, .cancel_yellow_card, .cancel_cmt_yellow_card', function () {
		var cmt_id = $("#modal_cmt_id").val();
		if(confirm('신고를 취소하시겠습니까?')) {
			$.post(
				'<?php echo EYOOM_CORE_URL?>/board/yellow_card.php',
				{ bo_table: "<?php echo $bo_table ?>", wr_id: "<?php echo $wr_id ?>", cmt_id: cmt_id, action: "cancel" },
				function(data) {
					if(data.count>=0 && !data.error) {
						if(!cmt_id) {
							if($('#yc_card').text() == '') {
								$('#cancel_yellow_card').wrap('<span id="yc_card"></span>');
							} else {
								$('#yc_card').html('');
							}
							$('#cancel_yellow_card').remove();
							var yc_html = '<button id="yellow_card" class="lbbtn_light" data-toggle="modal" data-target=".yellowcard-modal"><i class="fa fa-exclamation-triangle"></i>신고 <span>' + number_format(String(data.count)) + '</span></button>';
							$('#yc_card').html(yc_html);
						} else {
							var obj = $("#cancel_cmt_yellow_card_li_"+cmt_id);
							obj.html('');
							$("#modal_cmt_id").val('');
							var yc_html = '<button id="cmt_yellow_card_'+cmt_id+'" class="lbbtn_light cmt_yellow_card" data-toggle="modal" data-target=".yellowcard-modal" data-cmt-id="'+cmt_id+'"><i class="fa fa-exclamation-triangle"></i> <span>' + number_format(String(data.count)) + '</span></button>';
							obj.html(yc_html).attr('id', 'cmt_yellow_card_li_'+cmt_id);
						}
					}
					if(data.msg) alert(data.msg);
				}, "json"
			);
		}
	});

	// 원글의 신고취소를 위해 modal_cmt_id 값을 리셋
	$('body').on('click', '#yellow_card', function () {
		$("#modal_cmt_id").val('');
	});

	<?php if ($blind_direct) { ?>
	// 블라인드 처리 권한을 가진 회원
	$('body').on('click', '.btn-blind, .btn-cmt-blind', function () {
		var id = $(this).attr('id');
		var cmt_id = $(this).attr('data-cmt-id');
		if(typeof(cmt_id) == 'undefined') var cmt_id = '';

		switch(id) {
			case 'direct_blind':
				if(confirm('본 게시물을 바로 블라인드 처리합니다.\n\n계속 진행하시겠습니까?'))    {
					var action = 'db'; // direct blind
					var re_id = !cmt_id ? 'cancel_blind' : 'cancel_cmt_blind_li_'+cmt_id;
					var re_class = !cmt_id ? 'btn-e btn-e-red btn-blind' : 'btn-e btn-e-dark btn-e-xs btn-blind';
					var re_text = '블라인드 취소';
				}
				break;
			case 'cancel_blind':
				if(confirm('본 게시물을 블라인드 취소처리합니다.\n\n계속 진행하시겠습니까?'))     {
					var action = 'cb'; // cancel blind
					var re_id = !cmt_id ? 'direct_blind' : 'direct_cmt_blind_li_'+cmt_id;
					var re_class = !cmt_id ? 'lbbtn_light btn-blind' : 'btn-e btn-e-red btn-e-xs btn-blind';
					var re_text = '블라인드';
				}
				break;
			case 'direct_cmt_blind_li_'+cmt_id:
				if(confirm('본 댓글을 바로 블라인드 처리합니다.\n\n계속 진행하시겠습니까?'))     {
					var action = 'db'; // direct blind
					var re_id = 'cancel_cmt_blind_li_'+cmt_id;
					var re_class = 'btn-e btn-e-dark btn-e-xs btn-cmt-blind';
				}
				break;
			case 'cancel_cmt_blind_li_'+cmt_id:
				if(confirm('본 댓글을 블라인드 취소처리합니다.\n\n계속 진행하시겠습니까?'))  {
					var action = 'cb'; // cancel blind
					var re_id = 'direct_cmt_blind_li_'+cmt_id;
					var re_class = 'btn-e btn-e-red btn-e-xs btn-cmt-blind';
				}
				break;
		}

		if(typeof(action) != 'undefined') {
			$.post(
				'<?php echo EYOOM_CORE_URL?>/board/direct_blind.php',
				{ bo_table: "<?php echo $bo_table ?>", wr_id: "<?php echo $wr_id ?>", cmt_id: cmt_id, action: action },
				function(data) {
					if(!cmt_id) {
						$('.btn-blind').attr('id', re_id);
						$('.btn-blind').attr('class', re_class);
						$('.btn-blind').text(re_text);
					} else {
						$('.btn-cmt-blind').attr('id', re_id);
						$('.btn-cmt-blind').attr('class', re_class);
					}
					if(data.msg) alert(data.msg);
				}, "json"
			);
		}
	});
	<?php } ?>

	<?php } ?>

	<?php if ($eyoom_board["bo_use_rating"] == '1' && $is_member) { ?>
	$(".rating > input").click(function() {
		var score = $(this).val();
		if(score && confirm("별점 " + score + " 점을 클릭하였습니다.\n\n본 게시물의 별점평가에 참여하시겠습니까?") ){
			$.post(
				'<?php echo EYOOM_CORE_URL?>/board/star_rating.php',
				{ bo_table: "<?php echo $bo_table ?>", wr_id: "<?php echo $wr_id ?>", score: score },
				function(data) {
					if(data.msg) alert(data.msg);
				}, "json"
			);
		}
	});
	<?php } ?>
});

function excute_good(href, $el, $tx)
{
	var msg = ($tx.attr("class").search("nogood") > -1) ? '비추천' : '추천';
	var confirmed = confirm('이 글을 ' + msg + ' 하시겠습니까?');
	$tx.html('처리 중입니다.').show();
	if (confirmed) {
		$.post(
			href,
			{ js: "on" },
			function(data) {
				if(data.error) {
					alert(data.error);
					if (data.move_href) {
						window.location.href = data.move_href;
					} else {
						$tx.delay(100).fadeOut(350);
						return false;
					}
				}
				if(data.count) {
					$el.find("span").text(number_format(String(data.count)));
					if($tx.attr("class").search("nogood") > -1) {
						$tx.html('<i class="fa fa-thumbs-down"></i> 이 글을 비추천했어요!');
						setTimeout(function () {
							$tx.fadeOut(350);
						}, 400);
					} else {
						$tx.html('<i class="fa fa-thumbs-up"></i> 이 글을 추천했어요!');
						setTimeout(function () {
							$tx.fadeOut(350);
						}, 400);
					}
					if (data.msg && data.move_href) {
						alert(data.msg);
						$tx.fadeOut(350);
						window.location.href = data.move_href;
					}
				}
			}, "json"
		);
	} else {
		return;
	}
}
</script>
