<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/font-awesome/css/font-awesome.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style.min.css" type="text/css" media="screen">',0);
?>

<div class="memo-view">
	<h5 class="margin-bottom-20"><strong><?php echo $g5['title'] ?></strong></h5>
	<div class="tab-e1">
		<ul class="nav nav-tabs">
			<li<?php if ($kind == 'recv') { ?> class="active"<?php } ?>><a href="./memo.php?kind=recv">받은쪽지</a></li>
			<li<?php if ($kind == 'send') { ?> class="active"<?php } ?>><a href="./memo.php?kind=send">보낸쪽지</a></li>
			<?php if ($is_admin) { ?><li><a href="./memo_form.php">쪽지쓰기</a></li><?php } ?>
		</ul>
		<div class="tab-content">
			<!--{* 쪽지 보기 시작 *}-->
			<div class="note margin-bottom-10"><strong>쪽지 내용</strong></div>
			<div class="content-box margin-bottom-10">
				<ul class="list-unstyled">
					<li class="margin-bottom-10">
						<span><i class="fa fa-user"></i> <?php echo $kind_str ?>사람: </span>
						<strong><?php echo $mb['mb_nick'] ?></strong>
					</li>
					<li>
						<span><i class="fa fa-clock-o"></i> <?php echo $kind_date ?>시간: </span>
						<strong><?php echo $memo['me_send_datetime'] ?></strong>
					</li>
				</ul>
				<div class="margin-hr-10"></div>
				<p>
					<?php echo conv_content($memo['me_memo'], 0) ?>
				</p>
			</div>
			<!--{* 쪽지 보기 끝 *}-->
		</div>
	</div>

	<div class="text-center">
		<?php if ($prev_link) { ?>
		<a href="{_prev_link}" class="btn-e btn-e-light-grey">이전쪽지</a>
		<?php } ?>
		<?php if ($next_link) { ?>
		<a href="{_next_link}" class="btn-e btn-e-light-grey">다음쪽지</a>
		<?php } ?>
		<?php if ($kind == 'recv') { ?>
		<a href="./memo_form.php?me_id=<?php echo $memo['me_id'] ?>" class="btn-e btn-e-red">답장</a>
		<?php } ?>
		<a href="./memo.php?kind=<?php echo $kind ?>" class="btn-e btn-e-default">목록보기</a>
		<button type="button" onclick="window.close();" class="btn-e btn-e-dark">창닫기</button>
	</div>

</div>

<style>
.margin-hr-10 {height:1px;border-top:1px dotted #ddd;margin:10px 0}
.memo-view {padding:15px;font-size:12px}
.memo-view .content-box {border:1px solid #e5e5e5;padding:10px}
</style>

<?php
// tail_sub 템플릿 출력
@include_once(EYOOM_THEME_PATH.'/'.$theme.'/layout/tail_sub.php');
?>