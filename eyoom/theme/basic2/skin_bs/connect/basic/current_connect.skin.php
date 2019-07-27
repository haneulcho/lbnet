<?php if (!defined('_GNUBOARD_')) exit;
$lists = empty($list) || !is_array($list) ? 0 : count($list);
include_once(EYOOM_FUNCTION_PATH.'/eb_nameview.php');
?>

<!--{* 현재접속자 목록 시작 *}-->
<div class="table-list-eb margin-bottom-20">
	<div class="board-list-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="th-num">번호</th>
					<th>이름</th>
					<th class="hidden-xs">위치</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($lists) { foreach ($list as $item) { ?>
				<tr>
					<td class="text-left"><?php echo $item["num"]?></td>
					<td><?php if ($item["mb_id"]) { ?>
						<?php echo eb_nameview('basic', $item["mb_id"], $item["mb_nick"], $item["mb_email"], $item["mb_homepage"]); ?><?php } else { ?><?php echo $item["name"]?><?php } ?></td>
					<td class="td-width hidden-xs">
						<div class="td-location">
							<?php if ($item["lo_url"] && $is_admin == 'super') { ?>
							<a href="<?php echo $item["lo_url"] ?>"><?php echo $item["lo_location"] ?></a>
							<?php } else { ?>
							<?php echo $item["lo_location"] ?>
							<?php } ?>
						</div>
					</td>
				</tr>
				<tr class="td-mobile visible-xs"><!--{* 767px 이하에서만 보임 *}-->
					<td colspan="2">
						<?php if ($item["lo_url"] && $is_admin == 'super') { ?>
						<a href="<?php echo $item["lo_url"] ?>"><?php echo $item["lo_location"] ?></a>
						<?php } else { ?>
						<?php echo $item["lo_location"] ?>
						<?php } ?>
					</td>
				</tr>
				<?php } } else { ?>
				<tr><td colspan="3" class="text-center">현재 접속자가 없습니다.</td></tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<!--{* 현재접속자 목록 끝 *}-->

<style>
.table-list-eb .table thead > tr > th {border-bottom:1px solid #000}
.table-list-eb .table tbody > tr > td {padding:8px 5px}
.table-list-eb .table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {background:#fafafa}
.table-list-eb thead {border-top:1px solid #000;border-bottom:1px solid #000;background:#fff}
.table-list-eb th {color:#000;font-weight:bold;white-space:nowrap}
.table-list-eb .th-num {text-align:left !important;padding:8px 5px}
.table-list-eb .td-location {width:300px}
@media (max-width: 1199px) {
	.table-list-eb .td-location {width:260px}
}
@media (max-width: 767px) {
	.table-list-eb .td-width {width:inherit}
	.table-list-eb .td-location {width:280px}
}
.table-list-eb .td-mobile td {border-top:1px solid #f0f0f0;padding:4px 5px !important;font-size:10px;color:#999;background:#fafafa}
</style>