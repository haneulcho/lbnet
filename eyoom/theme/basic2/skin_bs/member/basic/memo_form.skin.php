<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/font-awesome/css/font-awesome.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style.min.css" type="text/css" media="screen">',0);
?>

<div class="memo-write">
	<h5 class="margin-bottom-20"><strong>쪽지 보내기</strong></h5>
	<div class="tab-e1">
		<ul class="nav nav-tabs">
			<li><a href="./memo.php?kind=recv">받은쪽지</a></li>
			<li><a href="./memo.php?kind=send">보낸쪽지</a></li>
			<?php if ($is_admin) { ?><li class="active"><a href="./memo_form.php">쪽지쓰기</a></li><?php } ?>
		</ul>
		<div class="tab-content">
			<!-- 쪽지 쓰기 시작 -->
			<form name="fmemoform" action="<?php echo $memo_action_url; ?>" onsubmit="return fmemoform_submit(this);" method="post" autocomplete="off" class="eyoom-form">
			<section>
							<?php if ($me_id) { ?>
								<input type="hidden" name="lbme_id" value="<?php echo $me_id ?>" id="lbme_id">
								<!--{* 원본 쪽지 보기 시작 *}-->
						<div class="content-box margin-bottom-10">
							<ul class="list-unstyled">
								<li class="margin-bottom-10">
									<span><i class="fa fa-user"></i> 보낸사람: </span>
									<strong><?php echo $me_recv_nick ?></strong>
								</li>
								<li>
									<span><i class="fa fa-clock-o"></i> 받은시간: </span>
									<strong><?php echo $row['me_send_datetime'] ?></strong>
								</li>
							</ul>
							<div class="margin-hr-10"></div>
							<p>
							<?php echo $content ?>
							</p>
						</div>
						<!--{* 원본 쪽지 보기 끝 *}-->
							<?php } else { ?>
								<?php if ($is_admin) { ?>
						<label for="me_recv_mb_id" class="label">받는 회원아이디<strong class="sound_only">필수</strong></label>
						<label class="input">
							<i class="icon-append fa fa-user"></i>
							<input type="text" name="me_recv_mb_id" value="<?php echo $me_recv_mb_id ?>" id="me_recv_mb_id" required size="47">
						</label>
						<div class="note margin-bottom-10"><strong>Note:</strong> 여러 회원에게 보낼때는 컴마(,)로 구분하세요.</div>
								<?php } else { ?>
								<input type="hidden" name="bt" value="<?php echo $bt ?>">
								<input type="hidden" name="mid" value="<?php echo $mid ?>">
								<div class="content-box margin-bottom-10">
									<ul class="list-unstyled">
											<li>
													<span><i class="fa fa-user"></i> 받는사람: </span>
													<strong><?php echo $me_recv_nick ?></strong>
											</li>
									</ul>
								</div>
							<?php } ?>
						<?php } ?>
			</section>
			<div class="margin-hr-10"></div>
		<section>
					<label for="me_memo" class="label" style="float:left"><?php if ($me_id) { ?>답장 <?php } ?>보낼 쪽지 내용</label>
					<?php if ($is_recv_admin) { ?>
						<input type="hidden" name="me_send_anonymous" value="0" id="me_send_anonymous">
					<?php } else { ?>
						<?php if ($me_id) { ?>
							<?php if ($me_send_anonymous) { ?>
							<input type="hidden" name="me_send_anonymous" value="1" id="me_send_anonymous">
							<?php } else { ?>
							<input type="hidden" name="me_send_anonymous" value="0" id="me_send_anonymous">
							<?php } ?>
						<?php } else { ?>
							<div><label class="checkbox pull-left margin-left-10" style="margin-top:-4px;margin-left:20px"><input type="checkbox" name="me_send_anonymous" value="1" id="me_send_anonymous" checked><i></i>익명 사용</label></div>
						<?php } ?>
					<?php } ?>
					<div class="clearfix"></div>
					<label class="textarea textarea-resizable">
						<textarea name="me_memo" id="me_memo" required></textarea>
					</label>
					<div class="note margin-bottom-10 font-size-11">
						<strong>Note: </strong>
						<?php if ($is_recv_admin) { ?>
							운영진에게 쪽지를 보낼 때는 닉네임이 기록됩니다.
						<?php } else { ?>
							<?php if ($me_id) { ?>
								<?php if ($me_send_anonymous) { ?>
									익명으로 온 쪽지는 익명으로만 답할 수 있습니다.
								<?php } else { ?>
									익명이 아닌 쪽지는 답장 시 보낸이의 닉네임이 기록됩니다.
								<?php } ?>
							<?php } else { ?>
								익명 사용에 체크하면 익명으로 쪽지가 발송됩니다.
							<?php } ?>
						<?php } ?>
					</div>
		</section>
			<div class="margin-hr-10"></div>
			<div class="text-center margin-bottom-20">
				<input type="submit" value="보내기" id="btn_submit" class="btn-e btn-e-red">
				<button type="button" onclick="window.close();" class="btn-e btn-e-dark">창닫기</button>
			</div>
		</form>
	</div>
</div>

<style>
#me_memo {height:130px}
.note {color:#f44455 !important}
.margin-hr-10 {height:1px;border-top:1px dotted #ddd;margin:10px 0}
.memo-write {padding:15px;font-size:12px}
.memo-write .tab-e1 .tab-content img {margin-top:0;margin-bottom:0}
.memo-write .content-box {border:1px solid #e5e5e5;padding:10px;background-color:#f0f0f0}
</style>

<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-form/jquery.form.min.js"></script>
<script>
function fmemoform_submit(f) {
		if($("#me_send_anonymous").is(':checked')) {
			$("#me_send_anonymous").val('1');
		}

	return true;
}
</script>
