<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/font-awesome/css/font-awesome.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style.min.css" type="text/css" media="screen">',0);
$lists = empty($list) || !is_array($list)? 0 : count($list);
?>

<div class="copy-move">
	<form name="fboardmoveall" method="post" action="./move_update.php" onsubmit="return fboardmoveall_submit(this);" class="eyoom-form">
	<input type="hidden" name="sw" value="<?php echo $sw ?>">
	<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
	<input type="hidden" name="wr_id_list" value="<?php echo $wr_id_list ?>">
	<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
	<input type="hidden" name="stx" value="<?php echo $stx ?>">
	<input type="hidden" name="spt" value="<?php echo $spt ?>">
	<input type="hidden" name="page" value="<?php echo $page ?>">
	<input type="hidden" name="act" value="<?php echo $act ?>">
	<input type="hidden" name="url" value="<?php echo $_SERVER["HTTP_REFERER"] ?>">
	<input type="hidden" name="wmode" value="<?php echo $wmode ?>">

	<h5 class="margin-bottom-5"><strong><?php echo $g5["title"] ?></strong></h5>
	<div class="tab-e1">
		<div class="tab-content">
			<div class="table-list-eb">
				<div class="board-list-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>
									<label for="chkall" class="sound_only">현재 페이지 게시판 전체</label>
									<label class="checkbox">
										<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);"><i></i>
									</label>
								</th>
								<th>게시판</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($lists) { foreach ($list as $k => $item) { ?>
							<tr class="<?php echo $item["atc_bg"] ?>">
								<td>
									<label for="chk<?php echo $k?>" class="sound_only"><?php echo $item["bo_table"] ?></label>
									<label class="checkbox">
									<input type="checkbox" value="<?php echo $item["bo_table"] ?>" id="chk<?php echo $k?>" name="chk_bo_table[]"><i></i>
									</label>
								</td>
								<td class="copy-move-list">
									<label for="chk<?php echo $k?>">
									<?php echo $item["gr_subject"] ?> / <?php echo $item["bo_subject"] ?>&nbsp;(<?php echo $item["bo_table"] ?>)&nbsp;<?php echo $item["atc_mark"] ?>
									</label>
								</td>
							</tr>
							<?php } } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="win-btn text-center">
		<input type="submit" value="<?php echo $act ?>" id="btn_submit" class="btn-e btn-e-red">
	</div>
	<div class="margin-bottom-20"></div>
	</form>
</div>

<style>
.margin-hr-10 {height:1px;border-top:1px dotted #ddd;margin:10px 0;clear:both}
.copy-move {padding:15px;font-size:12px}
.copy-move .eyoom-form {border:0}
.copy-move .copy-move-list labe l{margin-bottom:0}
.copy-move .copymove_current {color:#e33334}
.copy-move .eyoom-form .checkbox i {top:2px}
.table-list-eb .table thead > tr > th {border-bottom:1px solid #000}
.table-list-eb .table tbody > tr > td {padding:8px 5px}
.table-list-eb .table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {background:#fffcea}
.table-list-eb thead {border-top:1px solid #000;border-bottom:1px solid #000;background:#fff}
.table-list-eb th {color:#000;font-weight:bold;white-space:nowrap}
</style>

<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-form/jquery.form.min.js"></script>
<script>
$(function() {
	$(".win-btn").append("<button type=\"button\" class=\"btn-e btn-e-dark\">창닫기</button>");

	$(".win-btn button").click(function() {
		window.close();
	});
});

function all_checked(sw) {
	var f = document.fboardmoveall;

	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "chk_bo_table[]")
			f.elements[i].checked = sw;
	}
}

function fboardmoveall_submit(f) {
	var check = false;

	if (typeof(f.elements['chk_bo_table[]']) == 'undefined')
		;
	else {
		if (typeof(f.elements['chk_bo_table[]'].length) == 'undefined') {
			if (f.elements['chk_bo_table[]'].checked)
				check = true;
		} else {
			for (i=0; i<f.elements['chk_bo_table[]'].length; i++) {
				if (f.elements['chk_bo_table[]'][i].checked) {
					check = true;
					break;
				}
			}
		}
	}

	if (!check) {
		alert('게시물을 '+f.act.value+'할 게시판을 한개 이상 선택해 주십시오.');
		return false;
	}

	document.getElementById('btn_submit').disabled = true;

	f.action = './move_update.php';
	return true;
}
</script>

<?php
// tail_sub 템플릿 출력
@include_once(EYOOM_THEME_PATH.'/'.$theme.'/layout/tail_sub.php');
?>