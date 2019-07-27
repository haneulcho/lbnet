<?php if (!defined('_GNUBOARD_')) exit;
$lists = empty($list) || !is_array($list) ? 0 : count($list);
include_once(EYOOM_FUNCTION_PATH.'/eb_paging.php');
?>

<div class="new-list">
	<form name="fnewlist" method="post" action="#" onsubmit="return fmine_submit(this);" class="eyoom-form">
	<input type="hidden" name="sw"       value="move">
	<input type="hidden" name="view"     value="<?php echo $view ?>">
	<input type="hidden" name="sfl"      value="<?php echo $sfl ?>">
	<input type="hidden" name="stx"      value="<?php echo $stx ?>">
	<input type="hidden" name="srows"    value="<?php echo $srows ?>">
	<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
	<input type="hidden" name="page"     value="<?php echo $page ?>">
	<?php if ($is_cmt) { ?>
	<input type="hidden" name="type"     value="cmt">
	<?php } ?>
	<input type="hidden" name="pressed"  value="">

	<div class="table-list-eb margin-bottom-20">
		<div class="board-list-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<?php if ($is_admin) { ?>
						<th>
							<label for="all_chk" class="sound_only">목록 전체</label>
							<label class="checkbox">
								<input type="checkbox" id="all_chk"><i></i>
							</label>
						</th>
						<?php } ?>
						<?php if ($is_cmt) { ?>
						<th>댓글 내용</th>
						<?php } else { ?>
						<th>제목</th>
						<?php } ?>
						<th class="hidden-xs">게시판</th>
						<th class="hidden-xs">닉네임</th>
						<th class="hidden-xs">날짜</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($lists) { foreach ($list as $k => $v) { ?>
					<tr>
						<?php if ($is_admin) { ?>
						<td>
							<label for="chk_bn_id_<?php echo $k ?>" class="sound_only"><?php echo $v["num"] ?>번</label>
							<label class="checkbox">
								<input type="checkbox" name="chk_bn_id[]" value="<?php echo $k ?>" id="chk_bn_id_<?php echo $k ?>"><i></i>
							</label>
							<input type="hidden" name="bo_table[<?php echo $k ?>]" value="<?php echo $v["bo_table"] ?>">
							<input type="hidden" name="wr_id[<?php echo $k ?>]" value="<?php echo $v["wr_id"] ?>">
						</td>
						<?php } ?>
						<td class="td-width">
				<?php if ($is_cmt) { ?>
					<a href="<?php echo $v["href"] ?>">
						<div class="td-mention ellipsis">
						<?php echo $v["wr_content"]?>
						</div>
						<div class="td-subject sc ellipsis">
						원글 제목: <?php echo stripslashes($v["wr_subject"]) ?>
						</div>
					</a>
				<?php } else { ?>
					<a href="<?php echo $v["href"]?>" class="lbtitle" style="font-size:12px"><?php echo stripslashes($v["wr_subject"]) ?><?php if($v["wr_comment"]> 0){?><span class="lbcomment"><i class="fa fa-comment-o"></i><?php echo number_format($v["wr_comment"]) ?></span><?php }?><?php if($v["wr_good"]> 0){?><span class="lbup"><i class="fa fa-thumbs-up"></i><?php echo number_format($v["wr_good"]) ?></span><?php }?></a>
				<?php } ?>
						</td>
						<td class="text-center hidden-xs"><a href="./board.php?bo_table=<?php echo $v["bo_table"] ?>"><?php echo $v["bo_subject"] ?></a></td>
						<td class="text-center hidden-xs"><div><?php echo $v["name"] ?></div></td>
						<td class="text-center hidden-xs"><?php echo $v["datetime"] ?></td>
					</tr>
					<tr class="td-mobile visible-xs"><!--{* 767px 이하에서만 보임 *}-->
						<td colspan="<?php echo $colspan ?>">
							<span><a href="./board.php?bo_table=<?php echo $v["bo_table"] ?>">[<?php echo $v["bo_subject"] ?>]</a></span>
							<span><i class="fa fa-user"></i> <?php echo $v["name"] ?></span>
							<span><i class="fa fa-clock-o"></i> <?php echo $v["datetime_mobile"] ?></span>
						</td>
					</tr>
					<?php } } else { ?>
					<tr><td colspan="<?php echo $colspan ?>" class="text-center">게시물이 없습니다.</td></tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<?php if ($is_admin) { ?>
	<input type="submit" onclick="document.pressed=this.value" value="선택삭제" class="btn-e btn-e-light-grey">
	<?php } ?>
	</form>

	<?php echo eb_paging('basic') ?>
</div>

<style>
.new-list {font-size:12px}
.new-list .eyoom-form .radio i, .new-list .eyoom-form .checkbox i {top:2px}
.new-list .eyoom-form .radio, .new-list .eyoom-form .checkbox {margin-bottom:0}
.table-list-eb .table thead > tr > th {border-bottom:1px solid #000}
.table-list-eb .table tbody > tr > td {padding:8px 5px}
.table-list-eb .table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {background:#fafafa}
.table-list-eb thead {border-top:1px solid #000;border-bottom:1px solid #000;background:#fff}
.table-list-eb th {color:#000;font-weight:bold;white-space:nowrap}
.table-list-eb .td-mention {width:300px;margin-bottom:4px}
.table-list-eb .td-subject {width:300px;font-size:11px;color:#000}
.table-list-eb .td-subject.sc {color:#777}
@media (max-width: 1199px) {
	.table-list-eb .td-mention {width:260px}
	.table-list-eb .td-subject {width:260px}
}
@media (max-width: 767px) {
	.table-list-eb .td-width {width:inherit}
	.table-list-eb .td-mention {width:280px}
	.table-list-eb .td-subject {width:280px}
}
.table-list-eb .td-chked .read{color:#aaa}
.table-list-eb .td-chked .noread{color:#000}
.table-list-eb .td-mobile td {border-top:1px solid #f0f0f0;padding:4px 5px !important;font-size:10px;color:#999;background:#fcfcfc}
.table-list-eb .td-mobile td span {margin-right:5px}
</style>

<?php if ($is_admin) { ?>
<script>
$(function(){
	$('#all_chk').click(function(){
		$('[name="chk_bn_id[]"]').attr('checked', this.checked);
	});
});

function fmine_submit(f)
{
	f.pressed.value = document.pressed;

	var cnt = 0;
	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "chk_bn_id[]" && f.elements[i].checked)
			cnt++;
	}

	if (!cnt) {
		alert(document.pressed+"할 게시물을 하나 이상 선택하세요.");
		return false;
	}

	if (!confirm("선택한 게시물을 정말 "+document.pressed+" 하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다")) {
		return false;
	}

	f.action = "./mine_delete.php";

	return true;
}
</script>
<?php } ?>
