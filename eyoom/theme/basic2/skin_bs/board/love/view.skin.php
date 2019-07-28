<?php if (!defined('_GNUBOARD_')) exit;
$view_files = empty($view_file) || !is_array($view_file) ? 0 : count($view_file);
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
		<strong><?php echo cut_str(get_text($view["wr_subject"]), 70)?></strong>
		</h4>

		<?php echo $file_conts ?>

		<!--{* 본문 내용 시작 *}-->
		<div class="board-view-con view-content">
			<?php if ($ycard["yc_blind"] == 'y') { ?>
				<?php if ($is_admin) { ?>
			  <p class='text-center'>-- 블라인드 처리된 글입니다. --</p>
			  <?php echo $view_content ?>
			  <?php } else { ?>
			  <p class='text-center'>-- 블라인드 처리된 글입니다. --</p>
			<?php } ?>
			<?php } else { ?>
		  <?php echo $view_content ?>
		  <?php } ?>
		</div>
		<!--{* 본문 내용 끝 *}-->

		<?php if ($view["wr_area"] != '' && $view["lb_id"] != 'lebolution') { ?>
		<div class="lbvinfo lbvinfo_default">
			<h2><i class="fa fa-heart"></i>기본정보</h2>
			<dl>
				<dt>지역</dt>
				<dd><?php echo $view["wr_area"] ?></dd>
				<dt>성향</dt>
				<dd><?php echo $view["wr_type"] ?></dd>
				<dt>나이</dt>
				<dd><?php echo $view["wr_age"] ?></dd>
			</dl>
		</div>
		<?php if ($view["wr_send_moreinfo"] == '1') { ?>
		<div class="lbvinfo lbvinfo_additional">
			<h2><i class="fa fa-heart"></i>추가정보</h2>
			<dl>
				<?php if ($view["wr_job"] != '') { ?>
				<dt>직업</dt>
				<dd><?php echo $view["wr_job"] ?></dd>
				<?php } ?>
				<?php if ($view["wr_height"] != '') { ?>
				<dt>키</dt>
				<dd><?php echo $view["wr_height"] ?></dd>
				<?php } ?>
				<?php if ($view["wr_weight"] != '') { ?>
				<dt>체형</dt>
				<dd><?php echo $view["wr_weight"] ?></dd>
				<?php } ?>
				<?php if ($view["wr_etc"] != '') { ?>
				<dt>흡연유무</dt>
				<dd><?php echo $view["wr_etc"] ?></dd>
				<?php } ?>
				<?php if ($view["wr_interest"] != '') { ?>
				<dt>관심사</dt>
				<dd><?php echo $view["wr_interest"] ?></dd>
				<?php } ?>
			</dl>
		</div>
		<?php } ?>
		<?php } ?>
		<div class="board-view-btn">
		<?php if ($update_href) { ?><a href="<?php echo $update_href ?>" class="lbbtn_light" type="button"><i class="fa fa-pencil"></i>수정</a><?php } ?>
		<?php if ($delete_href) { ?>
			<a href="<?php echo $delete_href ?>" class="lbbtn_light" type="button" onclick="del(this.href); return false;"><i class="fa fa-trash-o"></i>삭제</a>
		<?php } ?>
		</div>
	</section>

	<div class="clearfix"></div>

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

$(function() {
	// 본문, 댓글 이미지 갤러리 처리
	$('.venobox').venobox({
	  numeratio: true,
	  infinigall: true
	});
	$('#wr_send_moreinfo').change(function() {
	  if(this.checked) {
		$('#moreinfo').slideDown('200');
		$(this).val('1').attr('checked', 'checked');
	  } else {
		$('#moreinfo').slideUp('200');
		$(this).val('0').removeAttr('checked');
	  }
	});
});
</script>
