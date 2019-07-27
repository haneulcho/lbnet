<?php if (!defined('_GNUBOARD_')) exit; ?>

<span class="sv_wrap">
	<a href="<?php echo $head["link"] ?>" class="sv_member" title="<?php echo $head["title"] ?>" target="_blank" onclick="return false;"><i class="fa fa-user"></i><?php echo $head["name"] ?></a>
<?php ob_start(); ?>
	<span class="sv dropdown-menu" role="menu">
	<?php if ($mb_id && $member["mb_id"]) { ?>
		<a href="<?php echo G5_BBS_URL ?>/memo_form.php?bt=<?php echo $bo_table ?>&amp;mid=<?php echo $wr_id ?>" class="win_memo" id="ol_after_memo"><i class="fa fa-envelope-o"></i> 쪽지보내기</a>
		<?php if ($is_admin) { ?>
		<a href="<?php echo G5_BBS_URL ?>/search.php?gr_id=leb&amp;sfl=mb_id&amp;stx=<?php echo $mb_id ?>&amp;sop=and"><i class="fa fa-search"></i> 게시물 확인</a>
		<?php } ?>
	<?php } ?>
	</span>
<?php
	$mb_name = ob_get_contents();
	ob_end_clean();
?>
<?php echo $mb_name; ?>

<?php if (!$is_anonymous) { ?>
<noscript class="sv_nojs"><?php echo $noscript;?></noscript>
<?php } ?>
</span>
