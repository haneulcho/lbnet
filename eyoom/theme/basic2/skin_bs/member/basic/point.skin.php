<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/font-awesome/css/font-awesome.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style.min.css" type="text/css" media="screen">',0);

$lists = empty($list) || !is_array($list) ? 0 : count($list);
include_once(EYOOM_FUNCTION_PATH.'/eb_paging.php');
?>

<div class="point-list">
	<h5 class="margin-bottom-20"><strong><?php echo $g5['title'] ?></strong></h5>
	<div class="tab-e1">
		<ul class="nav nav-tabs">
			<li class="active"><a><?php echo $levelset["gnu_name"] ?></a></li>
		</ul>
		<div class="tab-content">
			<div class="note margin-bottom-10"><strong><?php echo $levelset["gnu_name"] ?> 사용내역 목록</strong></div>
			<!--{* 포인트 목록 시작 *}-->
			<div class="table-list-eb">
				<div class="board-list-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>일시</th>
								<th>내용</th>
								<th class="hidden-xs">만료일</th>
								<th class="hidden-xs">지급<?php echo $levelset["gnu_name"] ?></th>
								<th class="hidden-xs">사용<?php echo $levelset["gnu_name"] ?></th>
							</tr>
						</thead>
						<tbody>
							<?php if ($lists) { foreach ($list as $item) { ?>
							<tr>
								<td class="text-center"><?php echo substr($item["po_datetime"], 0, 16)?></td>
								<td class="td-width"><?php echo $item["po_content"] ?></td>
								<td class="text-center hidden-xs">
								<?php if ($item["po_expired"] == 1) { ?>
									만료 <?php echo substr(str_replace('-','',$item["po_expire_date"]), 2)?>
								<?php } else { ?>
									<?php if ($item["po_expire_date"] == '9999-12-31') { ?>-<?php } else { ?><?php echo $item["po_expire_date"] ?><?php } ?>
								<?php } ?>
								</td>
								<td class="text-center hidden-xs"><?php echo $item["point1"] ?></td>
								<td class="text-center hidden-xs"><?php echo $item["point2"] ?></td>
							</tr>
							<tr class="td-mobile visible-xs"><!--{* 767px 이하에서만 보임 *}-->
								<td colspan="2" class="text-right">
									<span>
									<?php if ($item["po_expired"] == 1) { ?>
										만료 <?php echo substr(str_replace('-','',$item["po_expire_date"]), 2)?>
									<?php } else { ?>
										<?php if ($item["po_expire_date"] == '9999-12-31') { ?>-<?php } else { ?><?php echo $item["po_expire_date"] ?><?php } ?>
									<?php } ?>
									</span>
									<span>[지급] <?php echo $item["point1"] ?></span>
									<span>[사용] <?php echo $item["point2"] ?></span>
								</td>
							</tr>
							<?php } } else { ?>
							<tr><td colspan="5" class="text-center">자료가 없습니다.</td></tr>
							<?php } ?>
						</tbody>
						<tfoot>
							<tr class="hidden-xs">
								<th colspan="3" class="hidden-xs">소계</th>
								<td class="text-center"><?php echo $sum_point1 ?></td>
								<td class="text-center"><?php echo $sum_point2 ?></td>
							</tr>
							<tr class="tfoot-td-mobile visible-xs"><!--{* 767px 이하에서만 보임 *}-->
								<td colspan="2" class="text-right">
									<span>[지급소계] <strong class="color-red"><?php echo $sum_point1 ?></strong></span>
									<span>[사용소계] <strong class="color-red"><?php echo $sum_point2 ?></strong></span>
								</td>
							</tr>
							<tr class="hidden-xs">
								<th colspan="3">보유<?php echo $levelset["gnu_name"] ?></th>
								<td colspan="2" class="text-center"><?php echo number_format($member['mb_point']); ?></td>
							</tr>
							<tr class="tfoot-td-mobile visible-xs"><!--{* 767px 이하에서만 보임 *}-->
								<td colspan="2" class="text-right"><span>[보유포인트] <strong class="color-red"><?php echo number_format($member['mb_point']); ?></strong></span></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<!--{* 포인트 목록 끝 *}-->

			<?php echo eb_paging('basic') ?>

			<div class="text-center">
				<button type="button" onclick="window.close();" class="btn-e btn-e-dark">창닫기</button>
			</div>
		</div>
	</div>

</div>

<style>
.margin-hr-10 {height:1px;border-top:1px dotted #ddd;margin:10px 0}
.point-list {padding:15px;font-size:12px}
.table-list-eb .table thead > tr > th {border-bottom:1px solid #000}
.table-list-eb .table tbody > tr > td {padding:8px 5px}
.table-list-eb .table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {background:#fafafa}
.table-list-eb thead {border-top:1px solid #000;border-bottom:1px solid #000;background:#fff}
.table-list-eb th {color:#000;font-weight:bold;white-space:nowrap}
.table-list-eb .td-mobile td {border-top:1px solid #f0f0f0;padding:4px 5px !important;font-size:10px;color:#999;background:#fcfcfc}
.table-list-eb .td-mobile td span {margin-right:5px}
.table-list-eb .tfoot-td-mobile td {border-top:1px solid #ddd;padding:8px 5px !important;font-size:11px;color:#000;background:#f4f4f4}
.table-list-eb .tfoot-td-mobile td span {margin-right:5px;font-weight:bold}
</style>