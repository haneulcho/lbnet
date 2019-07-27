<?php if (!defined('_GNUBOARD_')) exit;
$lists = empty($list) || !is_array($list) ? 0 : count($list);
include_once(EYOOM_FUNCTION_PATH.'/eb_paging.php');
?>

<div class="new-list">

	<div class="table-list-eb margin-bottom-20">
		<div class="board-list-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th class="hidden-xs">유형</th>
						<th>신고사유</th>
						<th class="hidden-xs">게시판</th>
						<th class="hidden-xs">신고자 <i class="fa fa-caret-right" aria-hidden="true"></i> 피신고자</th>
						<th class="hidden-xs">날짜</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($lists) { foreach ($list as $item) { ?>
					<tr>
						<td class="text-center hidden-xs"><?php if ($item["is_cmt"]) { ?>댓글<?php } else { ?>글<?php } ?> <?php if ($item["is_blind"]) { ?>블라인드<?php } else { ?>신고<?php } ?></td>
						<td class="td-width">
							<a href="<?php echo $item["href"] ?>">
								<div class="td-mention">
								<?php if (!$item["is_blind"]) { ?>[<?php echo $item["yc_reason"] ?>] <?php echo stripslashes($item["yc_memo"])?><?php } ?>
								</div>
								<div class="td-subject sc"><?php if (!$item["is_delected"]) { ?>원글 제목: <?php echo stripslashes($item["wr_subject"])?><?php if ($item["is_cmt"]) { ?><br>댓글 내용: <?php echo stripslashes($item["wr_content"])?><?php } ?><?php } else { ?><i class="fa fa-exclamation-triangle"></i> 피신고자가 글/댓글을 삭제하였습니다.<?php } ?>
								</div>
							</a>
						</td>
						<td class="text-center hidden-xs"><a href="./board.php?bo_table=<?php echo $item["bo_table"] ?>"><?php echo $item["bo_subject"] ?></a></td>
						<td class="text-center hidden-xs"><div><?php echo $item["yc_id"] ?> <i class="fa fa-caret-right" aria-hidden="true"></i> <span class="color-red"><?php if (!$item["is_delected"]) { ?><?php echo $item["yc_pr_id"] ?><?php } else { ?><i class="fa fa-exclamation-triangle"></i><?php } ?></span></div></td>
						<td class="text-center hidden-xs"><?php echo $item["yc_datetime"] ?></td>
					</tr>
					<tr class="td-mobile visible-xs"><!--{* 767px 이하에서만 보임 *}-->
						<td colspan="5">
							<span><a href="./board.php?bo_table=<?php echo $item["bo_table"] ?>">[<?php echo $item["bo_subject"] ?>]</a></span>
							<span><i class="fa fa-user"></i> <?php echo $item["yc_id"] ?> <i class="fa fa-caret-right" aria-hidden="true"></i> <span class="color-red"><?php if (!$item["is_delected"]) { ?><?php echo $item["yc_pr_id"] ?><?php } else { ?><i class="fa fa-exclamation-triangle"></i><?php } ?></span></span><span><i class="fa fa-clock-o"></i> <?php echo $item["yc_datetime_mobile"] ?></span>
						</td>
					</tr>
					<?php } } else { ?>
					<tr><td colspan="5" class="text-center">신고/블라인드 내역이 없습니다.</td></tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

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
	.table-list-eb .td-mention {width:100%}
	.table-list-eb .td-subject {width:100%}
}
@media (max-width: 767px) {
	.table-list-eb .td-width {width:inherit}
	.table-list-eb .td-mention {width:100%}
	.table-list-eb .td-subject {width:100%}
}
.table-list-eb .td-chked .read{color:#aaa}
.table-list-eb .td-chked .noread{color:#000}
.table-list-eb .td-mobile td {border-top:1px solid #f0f0f0;padding:4px 5px !important;font-size:10px;color:#999;background:#fcfcfc}
.table-list-eb .td-mobile td span {margin-right:5px}
</style>
