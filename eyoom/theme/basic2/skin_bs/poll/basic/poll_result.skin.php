<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/font-awesome/css/font-awesome.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style.min.css" type="text/css" media="screen">',0);

$list_1 = empty($list) || !is_array($list) ? 0 : count($list);
$list2_1 = empty($list2) || !is_array($list2) ? 0 : count($list2);
$list3_1 = empty($list3) || !is_array($list3) ? 0 : count($list3);
?>

<!--{* 설문조사 결과 시작 *}-->
<div class="poll-result">
	<h5 class="margin-bottom-20"><strong><?php echo $po_subject ?> 결과</strong></h5>
	<div class="tab-e1 margin-bottom-10">
		<ul class="nav nav-tabs">
			<li class="active"><a>투표결과</a></li>
		</ul>
		<div class="tab-content">
			<!--{* 설문조사 결과 그래프 시작 *}-->
			<section>
				<div class="service-block-e">
					<h6 class="text-right color-red"><strong>전체 <?php echo $nf_total_po_cnt ?>표</strong></h6>
					<div class="margin-hr-10"></div>
				<?php if ($list_1) { foreach ($list as $item) { ?>
					<div class="result-list">
						<div class="row">
							<div class="col-xs-9 service-in">
								<span><i class="fa fa-circle"></i> <?php echo $item["content"] ?></span>
							</div>
							<div class="col-xs-3 text-right service-in">
								<span><?php echo $item["cnt"] ?> 표</span>
							</div>
						</div>
						<div class="row">
							<div class="progress-list">
								<span class="heading-xs font-size-11">Progress Bar <span class="pull-right"><?php echo number_format($item["rate"], 1) ?>%</span></span>
								<div class="progress progress-e progress-xxs">
									<div style="width: <?php echo number_format($item["rate"], 1) ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo number_format($item["rate"], 1) ?>" role="progressbar" class="progress-bar progress-bar-orange">
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } } ?>
				</div>
			</section>
			<!--{* 설문조사 결과 그래프 끝 *}-->
		</div>
	</div>

	<?php if ($is_etc) { ?>
	<div class="tab-e1 margin-bottom-10">
		<ul class="nav nav-tabs">
			<li class="active"><a>기타의견</a></li>
		</ul>
		<div class="tab-content">
			<!--{* 설문조사 기타의견 시작 *}-->
			<section>
				<div class="etc-box margin-bottom-10">
				<?php if ($list2_1) { foreach ($list2 as $item) { ?>
					<article class="etc-list">
						<div>
							<span class="pull-left"><?php echo $item["pc_name"] ?> 님의 의견</span>
							<span class="pull-right color-grey"><i class="fa fa-clock-o"></i> <?php echo $item["datetime"] ?></span>
						</div>
						<div class="clearfix"></div>
						<p><?php echo $item["idea"] ?></p>
						<div class="clearfix"></div>
						<div class="text-right">
							<?php if ($item["del"]) { ?><?php echo $item["del"] ?><span class="btn-e btn-e-xs btn-e-dark">삭제</span></a><?php }?>
						</div>
						<div class="clearfix"></div>
					</article>
				<?php } } ?>
				</div>

				<?php if ($member["mb_level"] >= $po["po_level"]) { ?>
				<form name="fpollresult" action="./poll_etc_update.php" onsubmit="return fpollresult_submit(this);" method="post" autocomplete="off" class="eyoom-form">
				<input type="hidden" name="po_id" value="<?php echo $po_id ?>">
				<input type="hidden" name="w" value="">
				<input type="hidden" name="skin_dir" value="<?php echo $skin_dir ?>">
				<?php if ($is_member) { ?><input type="hidden" name="pc_name" value="<?php echo cut_str($member['mb_nick'], 255) ?>"><?php }?>

				<div class="heading heading-e6 margin-top-10"><h2 class="heading-sm"><?php echo $po_etc ?></h2></div>

				<div class="margin-hr-10"></div>

				<?php if ($is_guest) { ?>
				<div class="row">
					<section class="col col-4">
						<label for="pc_name" class="label">이름<strong class="sound_only">필수</strong></label>
						<label class="input">
							<i class="icon-append fa fa-user"></i>
							<input type="text" name="pc_name" id="pc_name" required size="10">
						</label>
					</section>
				</div>
				<div class="margin-hr-10"></div>
				<?php } ?>
				<section>
					<label for="pc_idea" class="label">의견<strong class="sound_only">필수</strong></label>
					<label class="input">
						<i class="icon-append fa fa-pencil"></i>
						<input type="text" id="pc_idea" name="pc_idea" required size="47" maxlength="100">
					</label>
				</section>
				<?php if ($is_guest) { ?>
				<section>
					<label class="label">자동등록방지</label>
					<div class="vc-captcha"><?php echo captcha_html() ?></div>
				</section>
				<?php } ?>
				<div class="text-center margin-bottom-10 margin-top-20">
					<input type="submit" class="btn-e btn-e-red" value="의견남기기">
				</div>
				</form>
				<?php } ?>
			</section>
			<!--{* 설문조사 기타의견 끝 *}-->
			<!--{* 설문조사 다른 결과 보기 끝 *}-->
		</div>
	</div>
	<?php } ?>

	<div class="tab-e1">
		<ul class="nav nav-tabs">
			<li class="active"><a>다른투표 결과보기</a></li>
		</ul>
		<div class="tab-content">
			<!--{* 설문조사 다른 결과 보기 시작 *}-->
			<section>
				<ul class="list-unstyled">
				<?php if ($list3_1) { foreach ($list3 as $item) { ?>
					<li><a href="./poll_result.php?po_id=<?php echo $item["po_id"] ?>&amp;skin_dir=<?php echo $skin_dir ?>"><i class="fa fa-circle"></i> [<?php echo $item["date"] ?>] <?php echo $item["subject"] ?></a></li>
				<?php } } ?>
				</ul>
			</section>
			<!--{* 설문조사 다른 결과 보기 끝 *}-->
		</div>
	</div>

	<div class="margin-hr-10"></div>
	<div class="text-center margin-top-15">
		<button class="btn-e btn-e-dark" type="button" onclick="window.close();">창닫기</button>
	</div>
</div>
<!--{* 설문조사 결과 끝 *}-->

<style>
.poll-result {padding:15px;font-size:12px}
.poll-result .margin-hr-10 {height:1px;border-top:1px dotted #ddd;margin:10px 0;clear:both}
.poll-result .service-block-e {padding:15px;border:1px solid #eee}
.poll-result .result-list {margin:10px 0}
.poll-result .progress-list {padding:0 15px}
.poll-result .etc-box {border:1px solid #eee;border-bottom:0}
.poll-result .etc-list {border-bottom:1px solid #eee;padding:10px 15px}
.poll-result .tab-e1 .tab-content img {margin-top:0;margin-bottom:0}
.poll-result .table-responsive {overflow-y:auto}
</style>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-form/jquery.form.min.js"></script>
<script>
$(function() {
	$(".poll_delete").click(function() {
		if(!confirm("해당 기타의견을 삭제하시겠습니까?"))
			return false;
	});
});

function fpollresult_submit(f) {
	<?php if ($is_guest) { ?>
	chk_captcha_js();
	<?php } ?>

	return true;
}
</script>
<!--{* 설문조사 결과 끝 *}-->
<?php @include_once(EYOOM_THEME_PATH.'/'.$theme.'/layout/tail_sub.php'); ?>