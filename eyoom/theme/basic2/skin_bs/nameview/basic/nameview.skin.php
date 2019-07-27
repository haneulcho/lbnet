<?php if (!defined('_GNUBOARD_')) exit; ?>

<span class="sv_wrap">
	<?php if (!$is_anonymous) { ?>
	<a href="<?php echo $head["link"] ?>" class="sv_member" title="<?php echo $head["title"] ?>" target="_blank" onclick="return false;"> <b><?php echo $head["name"] ?></b></a>
	<?php } else { ?>
	<b><?php echo $head["name"] ?></b>
	<?php } ?>
<?php  ob_start(); ?>
	<?php if (!$is_anonymous) { ?>
	<span class="sv dropdown-menu" role="menu">
	<?php if ($mb_id && $member["mb_id"]) {?>
		<a href="<?php echo G5_BBS_URL?>/memo_form.php?me_recv_mb_id=<?php echo $mb_id?>" class="win_memo" id="ol_after_memo">쪽지보내기</a>
		<a href="<?php echo $link["profile"] ?>" onclick="win_profile(this.href); return false;">자기소개</a>
	<?php } ?>

	<?php if ($email) {?>
		<a href="<?php echo $link["email"] ?>" onclick="win_email(this.href); return false;">메일보내기</a>
	<?php } ?>

	<?php if ($email) {?>
		<a href="<?php echo $link["home"] ?>" target="_blank">홈페이지</a>
	<?php } ?>

	<?php if ($bo_table) {?>
		<?php if ($mb_id) {?>
		<a href="<?php echo $link["sid"] ?>">아이디로 검색</a>
		<?php } else {?>
		<a href="<?php echo $link["sname"] ?>">이름으로 검색</a>
		<?php } ?>
	<?php } ?>
	<?php if ($g5["sms5_use_sideview"]) {?>
		<a href="<?php echo $link["sms"] ?>" class="win_sms5" target="_blank">문자보내기</a>
	<?php } ?>
	<?php if ($is_admin) {?>
		<a href="<?php echo $link["info"] ?>" target="_blank">회원정보변경</a>
		<a href="<?php echo $link["point"] ?>" target="_blank"><?php echo $levelset["gnu_name"] ?>내역</a>
		<a href="<?php echo G5_BBS_URL ?>/search.php?gr_id=leb&amp;sfl=mb_id&amp;stx=<?php echo $mb_id ?>&amp;sop=and"><i class="fa fa-search"></i> 게시물 확인</a>
	<?php } ?>
	</span>
	<?php } ?>
<?php
	$mb_name = ob_get_contents();
	ob_end_clean();
?>
<?php echo $mb_name; ?>
<?php if (!$is_anonymous) { ?>
<noscript class="sv_nojs"><?php echo $noscript;?></noscript>
<?php } ?>
</span>