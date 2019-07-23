<?php if (!defined('_GNUBOARD_')) exit;
	add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/scrollbar/src/perfect-scrollbar.css" id="style_color" type="text/css" media="screen">',0);
	$loops = empty($loop) || !is_array($loop) ? 0 : count($loop);
?>

<li class="dropdown dropdown-extended dropdown-memo">
	<a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-target="#" style="cursor:pointer">
		쪽지
		<span class="badge rounded-2x badge-e badge-dark"><?php echo $memo_not_read ?></span>
	</a>
	<ul class="dropdown-menu">
		<li class="external">
			<h5>미확인 쪽지가 <strong class="color-red"><?php echo $memo_not_read ?>건</strong> 있습니다.</h5>
			<a href="<?php echo G5_BBS_URL?>/memo.php" target="_blank" class="win_memo">more</a>
		</li>
		<li>
			<ul class="dropdown-menu-list contentHolder" style="height: 275px;">
			<?php if ($loops) { foreach ($loop as $item) { ?>
				<?php if ($item["is_read"]) { ?>
				<li class="read-disable">
				<?php } else { ?>
				<li>
				<?php } ?>
					<a href="<?php echo $item["href"] ?>" target="_blank" class="win_memo">
						<?php if ($photo == 'y') {?>
						<span class="photo">
							<span class="user_icon"><i class="fa fa-user memo-photo"></i></span>
						</span>
						<?php } ?>
						<span class="description">
							<span class="from color-black"><?php echo $item["mb_name"] ?> <span class="lbdes">님이 보낸 쪽지</span></span>
						</span>
						<span class="subject"><?php echo $item["memo"] ?></span>
						<span class="time"><?php if ($item["is_read"]) { ?>읽음<?php } else { ?><strong class="color-red">읽지않음</strong><?php } ?> <?php echo $eb->date_time('Y-m-d H:i', $item["datetime"]) ?></span>
						<div class="clearfix"></div>
					</a>
				</li>
			<?php } } else { ?>
				<li><p class="text-center margin-top-20 font-size-12">확인하지 않은 쪽지가 없습니다.</p></li>
			<?php } ?>
			</ul>
		</li>
	</ul>
</li>
