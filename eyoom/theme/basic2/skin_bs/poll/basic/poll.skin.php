<?php if (!defined('_GNUBOARD_')) exit;
$polls = empty($poll) || !is_array($poll) ? 0 : count($poll);
?>

<!--{* 설문조사 시작 *}-->
<div class="poll">
	<div class="headline">
		<h6><i class="fa fa-check-square-o"></i><strong>설문조사</strong><?php if ($is_admin=="super") { ?><span class="pull-right"><a href="<?php echo G5_ADMIN_URL?>/poll_form.php?w=u&amp;po_id=<?php echo $po_id ?>">설문설정</a></span><?php } ?></h6>
	</div>
	<form name="fpoll" action="<?php echo G5_BBS_URL ?>/poll_update.php" onsubmit="return fpoll_submit(this);" method="post" class="eyoom-form">
	<input type="hidden" name="po_id" value="<?php echo $po_id ?>">
	<input type="hidden" name="skin_dir" value="<?php echo $skin_dir ?>">
	<section class="poll-box">
		<h6><span class="qq">Q.</span> <?php echo $po["po_subject"]?></h6>
		<div class="margin-hr-5"></div>
		<ul class="list-unstyled">
		<?php if ($polls) { foreach ($poll as $k => $v) { ?>
			<li>
				<label for="gb_poll_<?php echo $k ?>" class="radio"><input type="radio" name="gb_poll" value="<?php echo $k ?>" id="gb_poll_<?php echo $k ?>"><i class="rounded-x"></i><span class="font-size-12"><?php echo $v["po_poll"] ?></span></label>
			</li>
		<?php } } ?>
		</ul>
		<div class="margin-hr-5"></div>
		<div class="pull-right margin-top-5">
			<input type="submit" value="투표하기" class="btn-e btn-e-red margin-top-1"> <a href="<?php echo G5_BBS_URL ?>/poll_result.php?po_id=<?php echo $po_id ?>&amp;skin_dir=<?php echo $skin_dir ?>" target="_blank" onclick="poll_result(this.href); return false;" class="btn-e btn-e-dark">결과보기</a>
		</div>
		<div class="clearfix"></div>
	</section>
	</form>
</div>

<style>
.poll {border:1px solid #e5e5e5;background-color:#fff;}
.poll h6 {font-size:12px;}
.poll-box h6 {position:relative;padding-left:20px;}
.poll .qq {position:absolute;top:0;left:0;color:#818a91;font-size:15px;}
.poll .headline span {padding-top:6px;font-size:11px}
.poll .poll-box {background:#fff;padding:11px 15px;margin-bottom:0;}
.poll .margin-hr-5 {height:1px;border-top:1px dotted #ddd;margin:5px 0}
.poll .margin-top-1 {margin-top:-1px}
</style>

<script>
function fpoll_submit(f) {
	<?php if ($member["mb_level"] < $po["po_level"]) { ?>
		alert('권한 <?php echo $po["po_level"] ?> 이상의 회원만 투표에 참여하실 수 있습니다.'); return false;
	<?php } ?>
	var chk = false;
	for (i = 0; i < f.gb_poll.length; i++) {
		if (f.gb_poll[i].checked == true) {
			chk = f.gb_poll[i].value;
			break;
		}
	}
	if (!chk) {
		alert("투표하실 설문항목을 선택하세요");
		return false;
	}
	var new_win = window.open("about:blank", "win_poll", "width=616,height=500,scrollbars=yes,resizable=yes");
	f.target = "win_poll";
	return true;
}

function poll_result(url) {
	<?php if ($member["mb_level"] < $po["po_level"]) { ?>
		alert('권한 <?php echo $po["po_level"] ?> 이상의 회원만 결과를 보실 수 있습니다.'); return false;
	<?php } ?>
	win_poll(url);
}
</script>
<!--{* 설문조사 끝 *}-->
