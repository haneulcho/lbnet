<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/font-awesome/css/font-awesome.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style.min.css" type="text/css" media="screen">',0);
?>

<div class="scrap-popin">
	<h5 class="margin-bottom-20"><strong>스크랩하기</strong></h5>
	<div class="tab-e1">
		<ul class="nav nav-tabs">
			<li class="active"><a>스크랩</a></li>
		</ul>
		<div class="tab-content">
			<div class="note margin-bottom-10"><strong>제목 확인 및 댓글 쓰기</strong></div>
			<!--{* 스크랩 시작 *}-->
			<form name="f_scrap_popin" action="./scrap_popin_update.php" method="post" class="eyoom-form">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
			<section>
				<label for="subject" class="label">제목</label>
				<p><strong><?php echo $subject ?></strong></p>
			</section>
			<div class="margin-hr-10"></div>
			<section>
				<label for="wr_content" class="label">댓글</label>
				<label class="textarea textarea-resizable">
					<textarea name="wr_content" id="wr_content" required></textarea>
				</label>
			</section>
			<div class="note margin-bottom-20"><strong>Note:</strong> 스크랩을 하시면서 감사 혹은 격려의 댓글을 남기실 수 있습니다.</div>
			<div class="text-center margin-bottom-20">
				<input type="submit" value="스크랩 확인" class="btn-e btn-e-dark">
			</div>
			</form>
			<!--{* 스크랩 끝 *}-->
		</div>
	</div>

</div>

<style>
.margin-hr-10 {height:1px;border-top:1px dotted #ddd;margin:10px 0}
.scrap-popin {padding:15px;font-size:12px}
</style>

<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-form/jquery.form.min.js"></script>