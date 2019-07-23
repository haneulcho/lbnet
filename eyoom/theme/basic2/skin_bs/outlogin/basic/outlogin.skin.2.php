<?php if (!defined("_GNUBOARD_")) exit; ?>

<!--{* 로그인 후 아웃로그인 시작 *}-->
<section class="ol-after">
	<div class="ol-member-box">
		<div class="member-info">
			<div class="member-name">
				<h6>
					<strong><?php echo $nick?></strong> <span class="font-size-11 pull-right"><?php if ($is_admin) { ?>최고관리자<?php } else { ?><?php echo $lvinfo["gnu_name"] ?>/<?php echo $lvinfo["name"] ?><?php } ?></span>
				</h6>
			</div>
			<div class="member-point">
				<a href="<?php echo G5_BBS_URL?>/point.php" target="_blank" id="ol_after_pt">
					<i class="fa fa-tachometer"></i>
					<span class="service-heading"><?php echo $levelset["gnu_name"] ?> :</span>
					<span><?php echo $point?></span>
				</a>
			</div>
			<div class="member-lv">
				<div class="width-50 pull-left">
					<p class="margin-bottom-0">레벨</p>
					<?php if ($is_member && $member["mb_woman"] == 1) { ?>
					<p class="color-red"><?php echo $eyoomer["level"] ?> (인증회원)</p>
					<?php } else { ?>
					<p class="color-red"><?php echo $eyoomer["level"] ?> (미인증회원)</p>
					<?php } ?>
				</div>
				<div class="widht-50 pull-right text-right">
					<p class="margin-bottom-0"><?php echo $levelset["eyoom_name"] ?></p>
					<p class="color-red"><?php echo number_format($eyoomer["level_point"]) ?></p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="member-statistics">
				<p class="heading-xs">Progress Bar <span class="pull-right"><?php echo $lvinfo["ratio"] ?>%</span></p>
				<div class="progress progress-e progress-xxs">
					<div style="width: <?php echo $lvinfo["ratio"] ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $lvinfo["ratio"] ?>" role="progressbar" class="progress-bar progress-bar-e">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="ol-after-bottom">
	<div class="width-50 pull-left">
		<div class="btn-group">
			<button type="button" class="btn-e btn-e-dark dropdown-toggle" data-toggle="dropdown">내메뉴</button>
			<button type="button" class="btn-e btn-e-dark btn-e-split-dark dropdown-toggle" data-toggle="dropdown">
				<i class="fa fa-sort"></i>
				<span class="sr-only">Toggle Dropdown</span>
			</button>
			<ul class="dropdown-menu" role="menu">
				<?php if ($member["mb_woman"] == 0 || $member["mb_woman"] == 3 || $is_admin) { ?>
				<li><a href="<?php echo G5_BBS_URL?>/board.php?bo_table=levelup">등업신청</a></li>
				<li class="divider"></li>
				<?php } ?>
				<li><a href="<?php echo G5_BBS_URL?>/memo.php" target="_blank" id="ol_after_memo" class="win_memo">쪽지</a></li>
				<li><a href="<?php echo G5_BBS_URL?>/respond.php">내글반응</a></li>
				<li><a href="<?php echo G5_BBS_URL?>/mine.php">내가 쓴 글</a></li>
				<li><a href="<?php echo G5_BBS_URL?>/mine.php?type=cmt">내가 쓴 댓글</a></li>
				<?php if ($is_admin) { ?>
				<li class="divider"></li>
				<li><a href="<?php echo G5_BBS_URL?>/declare.php">신고/블라인드</a></li>
				<?php } ?>
				<?php if ($is_admin=='super' || $is_auth) { ?>
				<li class="divider"></li>
				<li><a href="<?php echo G5_ADMIN_URL?>">관리자페이지</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div class="width-50 pull-right text-right">
		<a href="<?php echo G5_BBS_URL?>/logout.php" type="button" class="btn-e">로그아웃</a>
	</div>
	<div class="clearfix"></div>
</section>

<!--{* 로그인 후 아웃로그인 끝 *}-->
