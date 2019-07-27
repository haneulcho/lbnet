<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/font-awesome/css/font-awesome.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style.min.css" type="text/css" media="screen">',0);

$lists = empty($list) || !is_array($list) ? 0 : count($list);
include_once(EYOOM_FUNCTION_PATH.'/eb_paging.php');
?>

<div class="scrap-list">
	<h5 class="margin-bottom-20"><strong><?php echo $g5['title'] ?></strong></h5>
	<div class="tab-e1">
		<ul class="nav nav-tabs">
			<li class="active"><a>스크랩</a></li>
		</ul>
		<div class="tab-content">
			<div class="note margin-bottom-10"><strong>스크랩 목록</strong></div>
			<!--{* 스크랩목록 시작 *}-->
			<div class="table-list-eb">
				<div class="board-list-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>번호</th>
								<th>제목</th>
								<th class="scrap-hidden-sm">게시판</th>
								<th class="scrap-hidden-sm">보관일시</th>
								<th class="scrap-hidden-sm">삭제</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($lists) { foreach ($list as $item) { ?>
							<tr>
								<td class="text-center"><?php echo $item["num"] ?></td>
								<td class="td-width">
									<div class="td-subject ellipsis">
										<a href="<?php echo $item["opener_href_wr_id"] ?>" target="_blank" onclick="opener.document.location.href='<?php echo $item["opener_href_wr_id"] ?>'; return false;"><?php echo $item["subject"] ?></a>
									</div>
								</td>
								<td class="text-center scrap-hidden-sm"><a href="<?php echo $item["opener_href"] ?>" target="_blank" onclick="opener.document.location.href='<?php echo $item["opener_href"] ?>'; return false;"><?php echo $item["bo_subject"] ?></a></td>
								<td class="text-center scrap-hidden-sm"><?php echo $item["ms_datetime"] ?></td>
								<td class="text-center scrap-hidden-sm"><a href="<?php echo $item["del_href"] ?>" onclick="del(this.href); return false;">삭제</a></td>
							</tr>
							<tr class="td-mobile scrap-hidden-lg"><!--{* 600px 이하에서만 보임 *}-->
								<td colspan="2">
									<span><a href="<?php echo $item["opener_href"] ?>" target="_blank" onclick="opener.document.location.href='<?php echo $item["opener_href"] ?>'; return false;"><?php echo $item["bo_subject"] ?></a></span>
									<span><i class="fa fa-clock-o color-grey"></i> <?php echo $item["ms_datetime"] ?></span>
									<span class="pull-right"><a href="<?php echo $item["del_href"] ?>" onclick="del(this.href); return false;">삭제</a></span>
								</td>
							</tr>
							<?php } } else { ?>
							<tr><td colspan="5" class="text-center">자료가 없습니다.</td></tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<!--{* 스크랩목록 끝 *}-->

			<?php echo eb_paging('basic') ?>

			<div class="text-center">
				<button type="button" onclick="window.close();" class="btn-e btn-e-dark">창닫기</button>
			</div>
		</div>
	</div>

</div>

<style>
.margin-hr-10 {height:1px;border-top:1px dotted #ddd;margin:10px 0}
.scrap-list {padding:15px;font-size:12px}
.scrap-list .scrap-hidden-lg {display:none}
@media (max-width: 540px) {
	.scrap-list .scrap-hidden-sm {display:none}
	.scrap-list .scrap-hidden-lg {display:table-row !important}
}
.table-list-eb .td-subject {width:280px}
@media (max-width: 540px) {
	.table-list-eb .td-width {width:inherit}
	.table-list-eb .td-subject {width:280px}
}
.table-list-eb .table thead > tr > th {border-bottom:1px solid #000}
.table-list-eb .table tbody > tr > td {padding:8px 5px}
.table-list-eb .table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {background:#fafafa}
.table-list-eb thead {border-top:1px solid #000;border-bottom:1px solid #000;background:#fff}
.table-list-eb th {color:#000;font-weight:bold;white-space:nowrap}
.table-list-eb .td-mobile td {border-top:1px solid #f0f0f0;padding:4px 5px !important;font-size:10px;color:#999;background:#fcfcfc}
.table-list-eb .td-mobile td span {margin-right:5px}
</style>