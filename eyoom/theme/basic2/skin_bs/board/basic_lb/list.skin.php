<?php if (!defined('_GNUBOARD_')) exit;
$bocate = empty($categories) || !is_array($categories) ? 0 : count($categories);
$lists = empty($list) || !is_array($list)? 0 : count($list);
include_once(EYOOM_FUNCTION_PATH.'/eb_paging.php');
?>

<div class="board-area">

<?php if (!$wr_id && $is_timer) { ?>
	<?php if ($is_timer) { ?>
		<p>게시판 공개 시작 시간: <?php echo $timer_start ?></p>
		<p>게시판 공개 마감 시간: <?php echo $timer_end ?></p>
		<p>게시판 접근 기능을 쓰고 있지 않습니다!</p>
	<?php } else { ?>
		<p>게시판 접근 기능을 쓰고 있습니다!</p>
	<?php } ?>
<?php } ?>

<?php if (!$wr_id && $bo_table =='free2') { ?>
<section class="board-write">
<form name="fwrite" id="fwrite" action="./write_update.php" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" class="eyoom-form margin-bottom-20">
<input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
<input type="hidden" name="sca" value="<?php echo $sca ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="spt" value="<?php echo $spt ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="ca_name" value="일상">
<input type="hidden" name="board_skin_path" value="<?php echo EYOOM_CORE_PATH ?>/board">
<input type="hidden" name="wr_1" id="wr_1" value="<?php echo $wr_1 ?>">
<input type="hidden" name="wr_2" id="wr_2" value="<?php echo $wr_2 ?>">
<input type="hidden" name="wr_3" id="wr_3" value="<?php echo $wr_3 ?>">
<input type="hidden" name="wr_4" id="wr_4" value="<?php echo $wr_4 ?>">
<input type="hidden" name="wr_5" id="wr_5" value="<?php echo $wr_5 ?>">
<input type="hidden" name="wmode" id="wmode" value="<?php echo $wmode ?>">
<div class="tbl_frm01 tbl_wrap">
	<div class="lbrow">
		<div class="lbtop">
			<div class="lbsubject">
				<div class="lbanonymous">
					<?php if ($is_anonymous) { ?>
					<label for="anonymous" class="checkbox"><input type="checkbox" id="anonymous" name="anonymous" value="y" checked><i></i>익명글</label>
					<?php }?>
				</div>
				<label for="wr_subject" class="sound_only">제목<strong class="sound_only"> 필수</strong></label>
				<label class="input">
					<i class="icon-prepend fa fa-edit"></i>
					<input type="text" name="wr_subject" value="<?php echo $subject?>" id="wr_subject" required class="form-control" size="50" maxlength="255" placeholder="제목을 입력해 주세요.">
					<b class="tooltip tooltip-top-left">제목을 입력해 주세요.</b>
				</label>
			</div>
		</div>
		<div class="lbbottom">
			<div class="wr_content">
				<!--{* 에디터 사용시는 에디터로, 아니면 textarea 로 노출 *}-->
				<textarea id="wr_content" name="wr_content" style="height:36px;" required maxlength="65536" placeholder="내용을 입력해 주세요."></textarea>
			</div>
			<div class="lbsubmit">
				<button type="submit" id="btn_submit" accesskey="s" class="btn-e btn-e-lg btn-e-yellow margin-top-m-2"><i class="fa fa-paper-plane" aria-hidden="true"></i> 입력</button>
			</div>
		</div>
	</div>
	<div class="margin-hr-10"></div>
</div>
</form>
</section>

<script>
$save_val = $("#wr_content").val();
function fwrite_submit(f)
{
	<?php if ($is_anonymous) { ?>
	var wr_1 = '<?php echo $wr_1 ?>';
	if($("#anonymous").is(':checked')) {
		wr_1 = wr_1+'|y';
		$("#wr_1").val(wr_1);
	}
	<?php } ?>

	var subject = "";
	var content = "";

	if (!f.wr_subject.value || f.wr_subject.value == '제목을 입력해 주세요.') {
		alert("제목을 입력해 주세요!");
		f.wr_subject.focus();
		return false;
	}
	if (!f.wr_content.value || f.wr_content.value == '내용을 입력해 주세요.') {
		alert("내용을 입력해 주세요!");
		f.wr_content.focus();
		return false;
	}
	$.ajax({
		url: g5_bbs_url+"/ajax.filter.php",
		type: "POST",
		data: {
			"subject": f.wr_subject.value,
			"content": f.wr_content.value
		},
		dataType: "json",
		async: false,
		cache: false,
		success: function(data, textStatus) {
			subject = data.subject;
			content = data.content;
		}
	});

	if (subject) {
		alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
		f.wr_subject.focus();
		return false;
	}

	if (content) {
		alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
		if (typeof(ed_wr_content) != "undefined")
			ed_wr_content.returnFalse();
		else
			f.wr_content.focus();
		return false;
	}
	document.getElementById("btn_submit").disabled = "disabled";

	return true;
}
</script>
<style>
.board-write .board-write-title {border-bottom:1px solid #e5e5e5;padding-bottom:10px}
.wr_content {padding-right:70px;}
#wr_content {
box-sizing:border-box;
width:100% !important;
font-size:13px;line-height:1.35;}
#wr_content:focus {height:120px !important;}
</style>
<?php } ?>

<!--{* 전광판 등록 게시글 *}-->
<?php if ($eyoom_board["bo_use_hotgul"] == 1 && !$wr_id && $bo_table == 'free2') { ?>
<?php echo $latest->latest_userad('basic_lb_ad','title=전광판||bo_table=free2||period=30||count=15||cut_subject=38||img_view=y||bo_direct=y') ?>
<?php } ?>
<div class="board-list">
	<!--{* 게시판 페이지 정보 및 버튼 시작 *}-->
	<div class="board-info margin-bottom-10">
		<div class="clearfix"></div>
	</div>
	<!--{* 게시판 페이지 정보 및 버튼 끝 *}-->

	<!--{* 게시판 카테고리 시작 *}-->
	<?php if ($is_category) { ?>
		<script>
			// 카테고리 이동
			function category_view(sca) {
				if(sca)	var url = "<?php echo $category_href ?>&sca="+sca;
				else var url = "<?php echo $category_href ?>";
				$(location).attr('href',url);
				return false;
			}
		</script>
		<?php if (!G5_IS_MOBILE) { ?>
		<div class="lb_category">
			<ul class="lb_cate_nav">
				<li>분류</li>
				<li class="<?php if (!$decode_sca) { ?>active<?php } ?>">
					<a href="<?php echo $category_href ?>">전체</a>
				</li>
				<?php if ($bocate) { foreach ($categories as $key => $val) { ?>
				<li class="<?php if ($decode_sca == trim($val)) { ?>active<?php } ?>">
					<a href="<?php echo $category_href ?>&sca=<?php echo urlencode($val) ?>"><?php echo trim($val) ?></a>
				</li>
				<?php } } ?>
			</ul>
		</div>
		<?php } else { ?>
		<nav class="margin-bottom-20 margin-top-15">
			<div class="eyoom-form">
				<label class="select">
					<select name="ca_name" id="ca_name" required onchange="return category_view(this.value);">
						<option value="">전체 카테고리</option>
						<?php if ($bocate) { foreach ($categories as $key => $val) { ?>
						<option value="<?php echo urlencode($val) ?>" <?php if ($decode_sca == trim($val)) { ?>selected<?php } ?>><?php echo trim($val) ?></option>
						<?php } } ?>
					</select>
					<i></i>
				</label>
			</div>
		</nav>
		<?php } ?>
	<?php } ?>
	<!--{* 게시판 카테고리 끝 *}-->

	<?php if ($is_admin) { ?>
	<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post" class="eyoom-form">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table?>">
		<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
		<input type="hidden" name="stx" value="<?php echo $stx ?>">
		<input type="hidden" name="spt" value="<?php echo $spt ?>">
		<input type="hidden" name="sca" value="<?php echo $sca ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
		<input type="hidden" name="sw" value="">
	<?php } ?>
	<div class="table-list-eb margin-bottom-20">
		<div class="board-list-body">
		<ul id="lbboard" class="txtonly">
		<?php if ($lists) { foreach ($list as $k => $item) { ?>
			<?php if ($item["is_notice"] || $item["is_lb_admin"] || $wr_id == $item["wr_id"]) { ?>
				<?php if ($bo_table == 'notice') { ?>
					<li class="<?php if ($item["is_notice"]) { ?>notice <?php } ?><?php if ($wr_id == $item["wr_id"]) { ?>active <?php } ?>">
				<?php } else { ?>
					<li class="<?php if ($item["is_notice"]) { ?>notice <?php } ?><?php if ($item["is_lb_admin"]) { ?>admin <?php } ?><?php if ($wr_id == $item["wr_id"]) { ?>active <?php } ?>">
				<?php } ?>
			<?php } else { ?>
				<li>
			<?php } ?>
			<?php if ($is_checkbox && $is_admin) { ?>
				<div class="lbcheck">
					<span class="lst_chk">
						<label for="chk_wr_id_<?php echo $k?>" class="sound_only"><?php echo $item["subject"] ?></label>
						<label class="checkbox">
						<input type="checkbox" name="chk_wr_id[]" value="<?php echo $item["wr_id"] ?>" id="chk_wr_id_<?php echo $k ?>"><i></i>
						</label>
					</span>
				</div>
			<?php } ?>
				<a class="lblink<?php if ($is_admin) { ?> admin<?php } ?>" href="<?php echo $item["href"] ?>">
					<div class="lbtitle<?php if ($item["wr_comment"] > 30) { ?> lbhot<?php } elseif ($item["wr_comment"] > 100) { ?> lbbest<?php } ?> txtonly">
					<?php if (!$item["is_notice"] && $is_category && $item["ca_name"]) { ?>
					<span class="lbcate"><?php echo $item["ca_name"] ?></span>
					<?php } ?>
					<?php if ($item["is_notice"]) { ?><i class="fa fa-smile-o"></i> <b><?php echo $item["subject"] ?></b><?php } else { ?><?php if ($item["icon_file"]) { ?><i class="fa fa-picture-o color-red"></i><?php } ?> <?php if ($bo_table == 'qna' && !$is_admin) { ?>할 말 있어요.<?php } else { ?><?php echo $item["subject"] ?><?php } ?><?php } ?><?php if ($item["icon_new"]) { ?>&nbsp;<i class="fa fa-circle"></i>&nbsp;<?php } ?><?php if ($item["icon_secret"]) { ?>&nbsp;<i class="fa fa-lock"></i>&nbsp;<?php } ?><?php if ($item["comment_cnt"]) { ?><span class="lbcomment"><i class="fa fa-comment-o"></i><?php echo number_format($item["wr_comment"])?></span><?php } ?><?php if (!$item["is_notice"] && $is_good && $item["wr_good"]> 0) { ?><span class="lbup"><i class="fa fa-thumbs-up"></i><?php echo number_format($item["wr_good"])?></span><?php } ?>
					</div>
					<?php if (!$item["is_notice"]) { ?>
						<div class="lbdes txtonly">
						<?php if ($bo_table=='qna' && $is_admin) { ?>
						<span class="lbnick"><i class="fa fa-user"></i><?php if ($item["is_mine"]) { ?><?php echo $item["wr_name"] ?>(<?php echo $item["lb_id"] ?>)<b class="color-red">*</b><?php } else { ?><?php echo $item["wr_name"] ?>(<?php echo $item["lb_id"] ?>)<?php } ?></span>
						<?php } else { ?>
						<span class="lbnick"><i class="fa fa-user"></i><?php if ($item["is_mine"]) { ?><?php echo $item["wr_name"] ?><b class="color-red">*</b><?php } else { ?><?php echo $item["wr_name"] ?><?php } ?></span>
						<?php } ?>
						<span class="lbhit"><i class="fa fa-eye"></i><?php echo number_format($item["wr_hit"])?>
						</span>
						<span class="lbtime"><i class="fa fa-clock-o"></i><?php if ($eyoom_board["bo_sel_date_type"] == '1') { ?><?php echo $eb->date_time('y-m-d H:i',$item["wr_datetime"])?><?php } elseif ($eyoom_board["bo_sel_date_type"] == '2') { ?><?php echo $eb->date_format('Y.m.d',$item["wr_datetime"])?><?php } ?>
						</span>
						</div>
					<?php } ?>
				</a>
			</li>
		<?php } } else { ?>
			<li><span class="text-center">게시물이 없습니다.</span></li>
		<?php } ?>
		</ul>
	</div>
	</div>
	<div class="board-list-footer">
		<div class="pull-left">
			<ul class="list-unstyled board-btn-adm pull-left">
			<?php if ($is_checkbox) { ?>
				<li><button class="btn-e btn-e-light-grey" type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value">선택삭제</button></li>
				<li><button class="btn-e btn-e-light-grey" type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value">선택복사</button></li>
				<li><button class="btn-e btn-e-light-grey" type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value">선택이동</button></li>
					<?php } ?>
					<?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn-e btn-e-dark margin-right-5" type="button">관리자</a></li><?php } ?>
<?php if ($eyoom_href) { ?><li><a href="<?php echo $eyoom_href ?>" class="btn-e btn-e-dark margin-right-5" type="button">이윰설정</a></li><?php } ?>
			</ul>
			<?php if ($is_member) { ?>
			<span class="pull-left">
				<?php if ($rss_href) { ?><a href="<?php echo $rss_href ?>" class="btn-e btn-e-yellow" type="button"><i class="fa fa-rss"></i></a><?php } ?>
	<a href="javascript:;" class="btn-e btn-e-dark" type="button" data-toggle="modal" data-target=".search-modal"><i class="fa fa-search"></i></a>
			</span>
			<?php } ?>
		</div>
		<div class="pull-right">
			<?php if ($list_href || $write_href) { ?>
			<ul class="list-unstyled pull-right">
				<?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn-e btn-e-red" type="button">글쓰기</a></li><?php } ?>
			</ul>
			<?php } ?>
		</div>
		<div class="clearfix"></div>
	</div>
	<?php if ($is_admin) { ?></form><?php } ?>
</div>

<!--{* Small modal *}-->
<div class="modal fade search-modal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h5 id="myLargeModalLabel" class="modal-title"><strong><?php echo $board["bo_subject"] ?> 검색</strong></h5>
			</div>
			<div class="modal-body">
				<!--{* 게시판 검색 시작 *}-->
				<fieldset id="bo_sch" class="eyoom-form">
					<!--legend>게시물 검색</legend-->
					<form name="fsearch" method="get">
					<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
					<input type="hidden" name="sca" value="<?php echo $sca ?>">
					<input type="hidden" name="sop" value="and">
					<label for="sfl" class="sound_only">검색대상</label>
					<section class="margin-top-10">
						<label class="select">
							<select name="sfl" id="sfl" class="form-control">
								<option value="wr_subject"<?php echo get_selected($sfl,'wr_subject',true)?>>제목</option>
								<option value="wr_content"<?php echo get_selected($sfl,'wr_content')?>>내용</option>
								<option value="wr_subject||wr_content"<?php echo get_selected($sfl,'wr_subject||wr_content')?>>제목+내용</option>
								<?php if ($is_admin == 'super') { ?>
								<option value="mb_id,1"<?php echo get_selected($sfl,'mb_id,1')?>>회원아이디</option>
								<option value="mb_id,0"<?php echo get_selected($sfl,'mb_id,0')?>>회원아이디(코)</option>
								<option value="wr_name,1"<?php echo get_selected($sfl,'wr_name,1')?>>글쓴이</option>
								<option value="wr_name,0"<?php echo get_selected($sfl,'wr_name,0')?>>글쓴이(코)</option>
										<?php } ?>
							</select>
							<i></i>
						</label>
					</section>
					<section>
						<div class="input-group">
							<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
							<label class="input">
								<input type="text" name="stx" value="<?php echo stripslashes($stx)?>" required id="stx" class="form-control">
							</label>
							<span class="input-group-btn">
								<button class="btn btn-default btn-e-group" type="submit" value="검색">검색</button>
							</span>
						</div>
					</section>
					</form>
				</fieldset>
				<!--{* 게시판 검색 끝 *}-->
			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn-e btn-e-dark" type="button">닫기</button>
			</div>
		</div>
	</div>
</div>
<iframe name="photoframe" id="photoframe" style="display:none;"></iframe>
<!--{* End Small Modal *}-->

<?php if ($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!--{* 페이지 *}-->
<?php echo eb_paging('basic') ?>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
	var f = document.fboardlist;
	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "chk_wr_id[]")
			f.elements[i].checked = sw;
	}
}

function fboardlist_submit(f) {
	var chk_count = 0;
	for (var i=0; i<f.length; i++) {
		if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
			chk_count++;
	}
	if (!chk_count) {
		alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
		return false;
	}
	if(document.pressed == "선택복사") {
		select_copy("copy");
		return;
	}
	if(document.pressed == "선택이동") {
		select_copy("move");
		return;
	}
	if(document.pressed == "선택삭제") {
		if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
			return false;
		f.removeAttribute("target");
		f.action = "./board_list_update.php";
	}
	return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
	var f = document.fboardlist;
	if (sw == "copy")
		str = "복사";
	else
		str = "이동";

	var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");
	f.sw.value = sw;
	f.target = "move";
	f.action = "./move.php";
	f.submit();
}
</script>
<?php } ?>
</div>
