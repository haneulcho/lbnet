<?php if (!defined('_GNUBOARD_')) exit;
$lists = empty($list) || !is_array($list) ? 0 : count($list);
include_once(EYOOM_FUNCTION_PATH.'/eb_paging.php');
?>

<div class="respond-list">
<?php if ($is_admin) { ?>
	<form name="frespond" method="get" class="eyoom-form">
	<div class="row">
		<section class="col col-3">
			<label for="chk" class="sound_only">검색대상</label>
			<label class="select">
				<select name="chk" id="chk" class="form-control" onchange="this.form.submit();">
					<option value="">읽음여부|전체</option>
					<option value="y" <?php if ($chk == 'y'){?>selected<?php } ?>>읽음</option>
					<option value="n" <?php if ($chk == 'n') { ?>selected<?php } ?>>읽지않음</option>
				</select>
				<i></i>
			</label>
		</section>
		<section class="col col-3">
			<label class="select">
				<select name="type" id="type" class="form-control" onchange="this.form.submit();">
					<option value="">글타입|전체</option>
					<option value="reply" <?php if ($type == 'reply') { ?>selected<?php } ?>>답글</option>
					<option value="cmt" <?php if ($type == 'cmt') { ?>selected<?php } ?>>댓글</option>
					<option value="cmt_re" <?php if ($type == 'cmt_re') { ?>selected<?php } ?>>대댓글</option>
				</select>
				<i></i>
			</label>
		</section>
		<section class="col col-3">
			<label class="select">
				<select name="stx" id="stx" class="form-control" onchange="this.form.submit();">
					<option value="">검색대상</option>
					<option value="id" <?php if ($stx == 'id') { ?>selected<?php } ?>>아이디</option>
					<option value="nick" <?php if ($stx == 'nick') { ?>selected<?php } ?>>닉네임</option>
				</select>
				<i></i>
			</label>
		</section>
		<section class="col col-3">
			<div class="input-group">
				<label for="stw" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
				<label class="input">
					<input type="text" name="stw" value="<?php echo $stw?>" id="stw" required class="form-control">
				</label>
				<span class="input-group-btn">
					<button class="btn btn-default btn-e-group" type="submit" value="검색">검색</button>
				</span>
			</div>
		</section>
	</div>
	</form>
	<div class="margin-bottom-10"></div>
<?php } ?>

	<form name="frespondlist" method="post" action="#" onsubmit="return frespond_submit(this);" class="eyoom-form">
	<input type="hidden" name="act"      value="">
	<input type="hidden" name="chk"      value="<?php echo $chk ?>">
	<input type="hidden" name="type"     value="<?php echo $type ?>">
	<input type="hidden" name="mb_id"    value="<?php echo $mb_id ?>">
	<input type="hidden" name="page"     value="<?php echo $page ?>">
	<input type="hidden" name="pressed"  value="">

	<div class="table-list-eb margin-bottom-20">
		<div class="board-list-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<?php if ($is_member) { ?>
						<th>
							<label for="all_chk" class="sound_only">목록 전체</label>
							<label class="checkbox">
								<input type="checkbox" id="all_chk"><i></i>
							</label>
						</th>
						<?php } ?>
						<th>총 <span class="color-red"><?php echo $total_count ?></span>건이 있습니다</th>
						<th class="hidden-xs">날짜</th>
						<th class="hidden-xs">확인</th>
						<th class="hidden-xs">종류</th>
						<th class="hidden-xs">삭제</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($lists) { foreach ($list as $k => $v) { ?>
					<tr>
						<?php if ($is_member) { ?>
						<td class="td-chk">
							<label for="chk_bn_id_<?php echo $k ?>" class="sound_only"><?php echo $v["num"] ?>번</label>
							<label class="checkbox">
								<input type="checkbox" name="rid[]" value="<?php echo $v["rid"] ?>" id="chk_bn_id_<?php echo $k ?>"><i></i>
							</label>
						</td>
						<?php } ?>
						<td class="td-width">
							<a href="<?php echo $v["href"] ?>">
								<div class="td-mention ellipsis">
									<span class="td-photo"><?php if ($v["mb_photo"]) { ?><?php echo $v["mb_photo"] ?><?php }else{?><span class="respond-user-icon"><i class="fa fa-user"></i></span><?php } ?></span> <?php echo $v["mention"] ?>
								</div>
								<div class="td-subject ellipsis">
									<?php echo stripslashes($v["wr_subject"])?>
								</div>
							</a>
						</td>
						<td class="text-center hidden-xs"><?php echo $v["datetime"] ?></td>
						<td class="td-chked text-center hidden-xs">
							<?php if ($v["chk"] == 1) { ?>
							<span class="read">확인</span>
							<?php } else { ?>
							<strong class="noread">미확인</strong>
							<?php } ?>
						</td>
						<td class="text-center hidden-xs"><?php echo $v["type"] ?></td>
						<td class="text-center hidden-xs"><a href="<?php echo $v["delete"] ?>" onclick="return confirm('선택한 반응글을 정말로 삭제하시겠습니까?');">삭제</a></td>
					</tr>
					<tr class="td-mobile visible-xs"><!--{* 767px 이하에서만 보임 *}-->
						<td colspan="4">
							<span><i class="fa fa-clock-o"></i> <?php echo $v["datetime"] ?></span>
							<span class="td-chked">
								<?php if ($v["chk"] == 1) { ?>
								<strong class="read">확인</strong>
								<?php } else { ?>
								<strong class="noread">미확인</strong>
								<?php } ?>
							</span>
							<span>[<?php echo $v["type"] ?>]</span>
							<span class="pull-right"><a href="<?php echo $v["delete"] ?>" onclick="return confirm('선택한 반응글을 정말로 삭제하시겠습니까?');">삭제</a></span>
						</td>
					</tr>
					<?php } } else { ?>
					<tr><td colspan="6" class="text-center">내글 반응이 없습니다.</td></tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<?php if ($is_member) { ?>
	<button class="btn-e btn-e-light-grey" type="submit" onclick="document.pressed=this.value" value="선택 삭제">선택삭제</button>
	<button class="btn-e btn-e-light-grey" type="button" onclick="delete_all();">모두삭제</button>
	<button class="btn-e btn-e-light-grey" type="button" onclick="check_read();">선택읽음</button>
	<?php } ?>
	</form>

	<?php echo eb_paging('basic') ?>
</div>

<style>
.respond-list {font-size:12px}
.respond-list .eyoom-form .radio i,.respond-list .eyoom-form .checkbox i {top:2px}
.respond-list .eyoom-form .radio, .respond-list .eyoom-form .checkbox {margin-bottom:0}
.table-list-eb .table thead > tr > th {border-bottom:1px solid #000}
.table-list-eb .table tbody > tr > td {padding:8px 5px}
.table-list-eb .table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {background:#fafafa}
.table-list-eb thead {border-top:1px solid #000;border-bottom:1px solid #000;background:#fff}
.table-list-eb th {color:#000;font-weight:bold;white-space:nowrap}
.table-list-eb .td-photo img {width:20px;height:20px;margin-right:2px}
.table-list-eb .td-photo .respond-user-icon {width:20px;height:20px;font-size:14px;line-height:20px;text-align:center;background:#84848a;color:#fff;margin-right:2px;display:inline-block;white-space:nowrap;vertical-align:baseline}
.table-list-eb .td-mention {width:300px;margin-bottom:4px}
.table-list-eb .td-subject {width:300px;font-size:11px;color:#000}
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

<?php if ($is_member) { ?>
<script>
$(function(){
	$('#all_chk').click(function(){
		$('[name="rid[]"]').attr('checked', this.checked);
	});
});

function frespond_submit(f)
{
	f.pressed.value = document.pressed;
	f.act.value = 'chkdel';
	var cnt = 0;
	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "rid[]" && f.elements[i].checked)
			cnt++;
	}
	if (!cnt) {
		alert(document.pressed+"할 반응글을 하나 이상 선택하세요.");
		return false;
	}
	if (!confirm("선택한 내글반응 항목을 정말 "+document.pressed+" 하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다")) {
		return false;
	}
	f.action = "./respond_chk.php";
	return true;
}

function delete_all() {
	var f = document.frespondlist;
	f.act.value = 'alldel';
	if (!confirm("내글반응 기록을 모두 삭제하시겠습니까?")) {
		return false;
	}
	f.action = "./respond_chk.php";
	f.submit();
	return true;
}

function check_read() {
	var f = document.frespondlist;
	f.act.value = 'chkread';
	var cnt = 0;
	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "rid[]" && f.elements[i].checked)
			cnt++;
	}

	if (!cnt) {
		alert("반응글을 하나 이상 선택하세요.");
		return false;
	}

	if (!confirm("선택한 내글반응을 읽음표시로 처리하시겠습니까?")) {
		return false;
	}
	f.action = "./respond_chk.php";
	f.submit();
	return true;
}
</script>
<?php } ?>

<?php echo $write_pages ?>
