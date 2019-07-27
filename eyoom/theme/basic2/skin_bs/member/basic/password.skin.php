<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/font-awesome/css/font-awesome.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style.min.css" type="text/css" media="screen">',0);
?>
<?php if ($is_admin == 'super' || $is_admin == 'group' || $is_admin == 'board') { ?>
<div class="password-confirm">
	<h5 class="margin-bottom-20"><strong>비밀번호 확인</strong></h5>
	<div class="tab-e1">
		<ul class="nav nav-tabs">
			<li class="active"><a>비밀번호 입력</a></li>
		</ul>
		<div class="tab-content">
			<h6><strong>해당글: <span class="color-red"><?php echo $g5['title'] ?></span></strong></h6>
			<!-- 비밀번호 확인 시작 -->
			<form name="fboardpassword" action="<?php echo $action; ?>" method="post" class="eyoom-form">
			<input type="hidden" name="w" value="<?php echo $w ?>">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
			<input type="hidden" name="comment_id" value="<?php echo $comment_id ?>">
			<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
			<input type="hidden" name="stx" value="<?php echo $stx ?>">
			<input type="hidden" name="page" value="<?php echo $page ?>">
			<section>
				<?php if ($w == 'u') { ?>
				<div class="note margin-bottom-10"><strong>Note:</strong> 작성자만 글을 수정할 수 있습니다. 작성자 본인이라면, 글 작성시 입력한 비밀번호를 입력하여 글을 수정할 수 있습니다.</div>
				<?php } else if ($w == 'd' || $w == 'x') { ?>
				<div class="note margin-bottom-10"><strong>Note:</strong> 작성자만 글을 삭제할 수 있습니다. 작성자 본인이라면, 글 작성시 입력한 비밀번호를 입력하여 글을 삭제할 수 있습니다.</div>
				<?php } else { ?>
				<div class="note margin-bottom-10"><strong>Note:</strong> 비밀글 기능으로 보호된 글입니다. 작성자와 관리자만 열람하실 수 있습니다. 본인이라면 비밀번호를 입력하세요.</div>
				<?php } ?>
			</section>
			<div class="margin-hr-10"></div>
			<section>
				<label for="pw_wr_password" class="label">비밀번호<strong class="sound_only">필수</strong></label>
				<label class="input">
					<i class="icon-prepend fa fa-lock"></i>
					<i class="icon-append fa fa-question-circle"></i>
					<input type="password" name="wr_password" id="password_wr_password" required size="15" maxLength="20">
					<b class="tooltip tooltip-top-right">비밀번호 입력</b>
				</label>
			</section>
			<div class="margin-hr-10"></div>
			<div class="text-center margin-bottom-20">
				<input type="submit" value="확인" class="btn-e btn-e-yellow btn-e-lg">
			</div>
			</form>
			<!-- 비밀번호 확인 끝 -->
			<div class="margin-bottom-20"></div>
			<div class="text-center">
				<a href="<?php echo $return_url ?>" class="btn-e btn-e-dark">돌아가기</a>
			</div>
		</div>
	</div>

</div>
<style>
.margin-hr-10 {height:1px;border-top:1px dotted #ddd;margin:10px 0}
.password-confirm {padding:15px;font-size:12px}
</style>

<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-form/jquery.form.min.js"></script>
<?php } else {
	echo '<script type="text/javascript"> alert ("운영진과 글쓴이만 접근할 수 있습니다!"); window.history.back()</script>';
} ?>
