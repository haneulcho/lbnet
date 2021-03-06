<?php if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 ?>
<?php if ($is_member && $member['mb_level'] > 1) { ?>
	<?php if ($member['mb_level'] < 3 && $member['mb_woman'] == 3) { ?>
		<div class="guest_msg">
		<p>기존 회원 등업 시도 하였으나 답을 틀리셨네요.<br>[기존 회원 등업] 메뉴에서 다시 시도해 주세요. 7월 31일 이전 신청자에 한해 답이 맞을 때까지 재시도 가능합니다.</p>
		</div>
	<?php } ?>
	<?php if ($member['mb_level'] < 3 && $member['mb_woman'] == 0) { ?>
		<div class="guest_msg">
		<p>메뉴 접근 권한이 없습니다.<br>[등업신청] 메뉴 공지사항을 읽고 등업 신청글을 남겨 주세요.</p>
		</div>
	<?php } ?>
	<?php if ($member['mb_level'] > 2 && $member['mb_woman'] == 1) { ?>
		<!--{* ------------- Basic 최신글 영역 시작 ------------- *}-->
		<div class="margin-bottom-20">
			<div class="lbbox">
			<!--{* 전광판 등록 게시글 *}-->
				<?php echo $latest->latest_userad('basic_lb_ad','title=전광판||bo_table=free2||period=30||count=15||cut_subject=38||img_view=y||bo_direct=y||cache_time=6') ?>
			</div>
		</div>
		<div class="row margin-bottom-20">
			<div class="col-sm-6 md-margin-bottom-20">
			<div class="lbbox">
			<!--{* 아래 title=게시판명, bo_table=게시판id 설정 *}-->
				<?php echo $latest->latest_eyoom('basic_lb','title=수다방||bo_table=free2||period=2||count=5||cut_subject=20||secret=n||bo_direct=y') ?>
			</div>
			</div>
			<div class="col-sm-6 md-margin-bottom-20 md-padding-left-0">
			<div class="lbbox">
			<!--{* 아래 title=게시판명, bo_table=게시판id 설정 *}-->
				<?php echo $latest->latest_eyoom('basic_lb','title=동네번개방||bo_table=meet||period=14||count=5||cut_subject=20||bo_direct=y||cache_time=48') ?>
			</div>
			</div>
		</div>
		<div class="row margin-bottom-20">
			<div class="col-sm-6 md-margin-bottom-20">
			<div class="lbbox">
			<!--{* 아래 title=게시판명, bo_table=게시판id 설정 *}-->
				<?php echo $latest->latest_eyoom('basic_lb','title=고민방||bo_table=mind||period=14||count=5||cut_subject=20||bo_direct=y||cache_time=48') ?>
			</div>
			</div>
			<div class="col-sm-6 md-margin-bottom-20 md-padding-left-0">
			<div class="lbbox">
			<!--{* 아래 title=게시판명, bo_table=게시판id 설정 *}-->
				<?php echo $latest->latest_eyoom('basic_lb','title=페미방||bo_table=feminist||period=14||count=5||cut_subject=20||bo_direct=y||cache_time=48') ?>
			</div>
			</div>
		</div>
		<div class="row margin-bottom-20">
			<div class="col-sm-6 md-margin-bottom-20">
			<div class="lbbox">
			<!--{* 아래 title=게시판명, bo_table=게시판id 설정 *}-->
				<?php echo $latest->latest_eyoom('basic_lb','title=친구/모임/SNS방||bo_table=friends||period=14||count=5||cut_subject=20||bo_direct=y||cache_time=48') ?>
			</div>
			</div>
			<div class="col-sm-6 md-margin-bottom-20 md-padding-left-0">
			<div class="lbbox">
			<!--{* 아래 title=게시판명, bo_table=게시판id 설정 *}-->
				<?php echo $latest->latest_eyoom('basic_lb','title=인기글||bo_table=best||period=31||count=5||cut_subject=20||bo_direct=y||cache_time=48') ?>
			</div>
			</div>
		</div>
		<!--{* ------------- Basic 최신글 영역 끝 ------------- *}-->

		<!--{* ------------- Webzine 최신글 영역 시작 ------------- *}-->
		<div>
			<div class="lbbox">
			<!--{* 아래 title=게시판명, bo_table=게시판id 설정 *}-->
			<?php echo $latest->latest_eyoom('webzine','title=정보방||bo_table=etc||period=14||count=4||cut_subject=50||img_view=y||img_width=300||content=y||cut_content=25||secret=n||bo_direct=y||cache_time=48') ?>
			</div>
		</div>
		<!--{* ------------- Webzine 최신글 영역 끝 ------------- *}-->
	<?php } ?>
<?php } else { ?>
	<div class="guest_msg">
		<p>회원만 확인 가능합니다. 로그인 해 주세요.</p>
	</div>
<?php } ?>
