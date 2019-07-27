<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/font-awesome/css/font-awesome.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style.min.css" type="text/css" media="screen">',0);

include_once(EYOOM_FUNCTION_PATH.'/eb_paging.php');
?>

<div class="memo-list">
	<h5 class="margin-bottom-20"><strong><?php echo $g5['title'] ?></strong></h5>
	<div class="tab-e1">
		<ul class="nav nav-tabs">
			<li<?php if ($kind == 'recv') { ?> class="active"<?php } ?>><a href="./memo.php?kind=recv">받은쪽지</a></li>
			<li<?php if ($kind == 'send') { ?> class="active"<?php } ?>><a href="./memo.php?kind=send">보낸쪽지</a></li>
			<?php if ($is_admin) { ?><li><a href="./memo_form.php">쪽지쓰기</a></li><?php } ?>
		</ul>
		<div class="tab-content">
			<div class="note">전체 <?php echo $kind_title ?>쪽지: <strong class="color-red"><?php echo $total_count ?></strong>통</div>
			<div class="note margin-bottom-10 font-size-11"><strong>Note:</strong> 쪽지 보관일수는 최장 <strong class="color-red"><?php echo $config['cf_memo_del'] ?></strong>일 입니다.</div>
			<!-- 쪽지 목록 시작 -->
			<div class="table-list-eb">
				<div class="board-list-body">
					<table class="table table-hover margin-bottom-5">
						<thead>
							<tr>
								<th><?php echo ($kind == "recv") ? "보낸사람" : "받는사람"; ?></th>
								<th>내용</th>
								<th class="memo-hidden-sm">보낸시간</th>
								<th class="memo-hidden-sm">읽은시간</th>
								<th class="memo-hidden-sm">관리</th>
							</tr>
						</thead>
						<tbody>
							<?php for ($i = 0; $i < count($list); $i++) { ?>
							<tr>
								<td class="text-center"><?php echo $list[$i]['mb_nick'] ?></td>
								<td class="text-center"><a href="<?php echo $list[$i]['view_href'] ?>" class="btn-e btn-e-default btn-e-xs color-white <?php if ($read_datetime == '아직 읽지 않음') { ?>btn-e-red<?php } ?>">쪽지 보기</a></td>
								<td class="text-center memo-hidden-sm"><a href="<?php echo $list[$i]['view_href'] ?>"><?php echo $list[$i]['send_datetime'] ?></a></td>
								<td class="text-center memo-hidden-sm"><a href="<?php echo $list[$i]['view_href'] ?>"><?php echo $list[$i]['read_datetime'] ?></a></td>
								<td class="text-center memo-hidden-sm"><a href="<?php echo $list[$i]['del_href'] ?>" onclick="del(this.href); return false;">삭제</a></td>
							</tr>
							<tr class="td-mobile memo-hidden-lg"><!--{* 500px 이하에서만 보임 *}-->
								<td colspan="2">
									<span>[보낸시간] <strong class="color-black"><?php echo $list[$i]['send_datetime'] ?></strong></span>
									<span>[읽은시간] <strong class="color-black"><?php echo $list[$i]['read_datetime'] ?></strong></span>
									<span class="pull-right"><a href="<?php echo $list[$i]['del_href'] ?>" onclick="del(this.href); return false;">삭제</a></span>
								</td>
							</tr>
							<?php } ?>
							<?php if ($i==0) { echo '<tr><td colspan="5" class="text-center">자료가 없습니다.</td></tr>'; } ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- 쪽지 목록 끝 -->
		</div>
	</div>

	<div class="text-center margin-bottom-20">
		<?php echo eb_paging('basic') ?>
		<button type="button" onclick="window.close();" class="btn-e btn-e-dark">창닫기</button>
	</div>

</div>

<style>
.margin-hr-10 {height:1px;border-top:1px dotted #ddd;margin:10px 0}
.memo-list {padding:15px;font-size:12px}
.memo-list .memo-hidden-lg {display:none}
@media (max-width: 500px) {
	.memo-list .memo-hidden-sm {display:none}
	.memo-list .memo-hidden-lg {display:table-row !important}
}
.table-list-eb .table thead > tr > th {border-bottom:1px solid #000}
.table-list-eb .table tbody > tr > td {padding:8px 5px}
.table-list-eb .table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {background:#fafafa}
.table-list-eb thead {border-top:1px solid #000;border-bottom:1px solid #000;background:#fff}
.table-list-eb th {color:#000;font-weight:bold;white-space:nowrap}
.table-list-eb .td-mobile td {border-top:1px solid #f0f0f0;padding:4px 5px !important;font-size:10px;color:#999;background:#fcfcfc}
.table-list-eb .td-mobile td span {margin-right:5px}
</style>

<?php
// tail_sub 템플릿 출력
@include_once(EYOOM_THEME_PATH.'/'.$theme.'/layout/tail_sub.php');
?>