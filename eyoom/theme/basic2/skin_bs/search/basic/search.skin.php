<?php if (!defined('_GNUBOARD_')) exit;
$sel_groups = empty($sel_group) || !is_array($sel_group) ? 0 : count($sel_group);
$loops = empty($loop) || !is_array($loop) ? 0 : count($loop);
include_once(EYOOM_FUNCTION_PATH.'/eb_paging.php');
?>

<!--{* 전체검색 시작 *}-->
<div class="search-result">
	<form name="fsearch" onsubmit="return fsearch_submit(this);" method="get" class="eyoom-form">
	<input type="hidden" name="srows" value="<?php echo $srows?>">
	<div class="row">
		<section class="col col-3">
			<label class="select">
				<select name="gr_id" id="gr_id" class="form-control">
					<option value="">전체그룹</option>
					<?php if ($sel_groups) { foreach ($sel_group as $item) { ?>
					<option value='<?php echo $item["gr_id"] ?>'><?php echo $item["gr_subject"] ?></option>
					<?php } } ?>
				</select>
				<i></i>
			</label>
		</section>
		<script>document.getElementById("gr_id").value = "<?php echo $gr_id ?>";</script>
		<section class="col col-3">
			<label for="sfl" class="sound_only">검색조건</label>
			<label class="select">
				<select name="sfl" id="sfl" class="form-control">
					<option value="wr_subject||wr_content" <?php echo get_selected($_GET['sfl'], "wr_subject||wr_content") ?>>제목+내용</option>
					<option value="wr_subject" <?php echo get_selected($_GET['sfl'], "wr_subject") ?>>제목</option>
					<option value="wr_content" <?php echo get_selected($_GET['sfl'], "wr_content") ?>>내용</option>
					<option value="mb_id" <?php echo get_selected($_GET['sfl'], "mb_id") ?>>회원아이디</option>
					<option value="wr_name" <?php echo get_selected($_GET['sfl'], "wr_name") ?>>이름</option>
				</select>
				<i></i>
			</label>
		</section>
		<section class="col col-3">
			<div class="input-group">
				<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
				<label class="input">
					<input type="text" name="stx" value="<?php echo $text_stx ?>" id="stx" required required class="form-control" maxlength="20">
				</label>
				<span class="input-group-btn">
					<button class="btn btn-default btn-e-group" type="submit" value="검색">검색</button>
				</span>
			</div>
		</section>
		<section class="col col-3 inline-group">
			<label for="sop_or" class="radio"><input type="radio" value="or" <?php if ($sop == 'or') { ?>checked<?php } ?> id="sop_or" name="sop"><i class="rounded-x"></i>OR</label>
			<label for="sop_and" class="radio"><input type="radio" value="and" <?php if ($sop == 'and') { ?>checked<?php } ?> id="sop_and" name="sop"><i class="rounded-x"></i>AND</label>
		</section>
		<script>
		function fsearch_submit(f)
		{
			if (f.stx.value.length < 2) {
				alert("검색어는 두글자 이상 입력하십시오.");
				f.stx.select();
				f.stx.focus();
				return false;
			}

			// 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
			var cnt = 0;
			for (var i=0; i<f.stx.value.length; i++) {
				if (f.stx.value.charAt(i) == ' ')
					cnt++;
			}

			if (cnt > 1) {
				alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
				f.stx.select();
				f.stx.focus();
				return false;
			}

			f.action = "";
			return true;
		}
		</script>
	</div>
	</form>

	<div class="margin-bottom-10"></div>

	<?php if ($stx) { ?>
		<?php if ($board_count) { ?>
		<section class="margin-bottom-20">
			<div class="alert alert-warning padding-all-10">
				<h6><strong class="color-red"><?php echo $stx ?></strong> 전체검색 결과</h6>
				게시판 -<strong> <?php echo $board_count ?></strong> 개 |
				게시물 -<strong> <?php echo number_format($total_count) ?></strong> 개
				<small class="pull-right"><?php echo number_format($page) ?> / <?php echo number_format($total_page) ?> 페이지 열람 중</small>
			</div>
		</section>
		<?php } ?>
	<?php } ?>

	<?php if ($stx) { ?>
		<?php if ($board_count) { ?>
		<section class="tab-e1">
			<ul class="nav nav-tabs">
				<li class="active"><a href="?<?php echo $search_query ?>&amp;gr_id=<?php echo $gr_id ?>" <?php echo $sch_all ?>>전체게시판</a></li>
				<?php echo $str_board_list ?>
			</ul>
		</section>
		<?php } else { ?>
	<div class="text-center margin-bottom-10">검색된 자료가 하나도 없습니다.</div>
		<?php } ?>
	<?php } ?>

	<div class="margin-bottom-20"></div>

	<?php if ($stx && $board_count) { ?>
	<section class="search-result-list">
	<?php } ?>

	<?php if ($loops) { foreach ($loop as $item) {
		$lists = empty($item["list"]) || !is_array($item["list"]) ? 0 : count($item["list"]);
	?>
		<h5>
			<a href="./board.php?bo_table=<?php echo $item["bo_table"] ?>&amp;<?php echo $search_query ?>">
				<strong><i class="fa fa-search"></i> <span class="color-red"><?php echo $item["bo_subject"] ?></span> 게시판 내 결과</strong>
			</a>
		</h5>
		<ul class="list-unstyled result-list">
		<?php if ($lists) { foreach ($item["list"] as $item2) { ?>
			<li>
				<h6 class="font-size-12">
					<a href="<?php echo $item2["href"] ?><?php echo $item2["comment_href"] ?>"><strong><?php echo $item2["comment_def"] ?><?php echo $item2["subject"] ?></strong></a>
					<a href="<?php echo $item2["href"] ?><?php echo $item2["comment_href"] ?>" target="_blank" class="font-size-14 pull-right tooltips" data-placement="top" data-toggle="tooltip" data-original-title="새창"><i class="fa fa-external-link"></i></a>
				</h6>
				<div class="clearfix"></div>
				<p class="font-size-12"><?php echo $item2["content"] ?></p>
				<p class="color-light-grey font-size-11 margin-bottom-0"><i class="fa fa-user"></i> <?php echo $item2["name"] ?> <i class="fa fa-clock-o"></i> <?php echo $item2["wr_datetime"] ?></p>
			</li>
		<?php } } ?>
		</ul>
		<div class="text-right"><a href="./board.php?bo_table=<?php echo $item["bo_table"] ?>&amp;<?php echo $search_query ?>" class="btn-e btn-e-dark btn-e-sm"><strong><?php echo $item["bo_subject"] ?></strong> 결과 더보기</a></div>
	<?php } } else { ?>
		<?php if ($stx && $board_count) { ?>
		</section>
		<?php } ?>
	<?php } ?>

	<?php echo eb_paging('basic') ?>
</div>

<style>
.search-result {font-size:12px}
.search-result .eyoom-form .inline-group .radio {margin-right:10px}
.search-result .tab-e1 .nav-tabs a {font-size:12px}
.search-result .tab-e1 .nav-tabs {border-bottom:1px solid #555}
.search-result .tab-e1 .nav-tabs > .active > a,.search-result .tab-e1 .nav-tabs > .active > a:hover,.search-result .tab-e1 .nav-tabs > .active > a:focus {background:#555}
.search-result .tab-e1 .nav-tabs > li > a:hover {background:#555}
.search-result .tab-e1 .sch_on {color:#e33334}@media (max-width: 767px){.search-result .tab-e1 .nav-tabs{border:1px solid #ddd;padding:7px;background:#fafafa}}
.search-result-list .result-list li {padding:10px 0;border-bottom:1px dotted #ddd}
.search-result-list .result-list li:hover {background:#fafafa}
.search-result-list .result-list li:first-child {border-top:1px dotted #ddd}
.search-result-list .sch_word {color:#f44455}
</style>
