<?php if (!defined('_GNUBOARD_')) exit;
	add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/scrollbar/src/perfect-scrollbar.css" id="style_color" type="text/css" media="screen">',0);
	$chk = ($memo_not_read > 0 || $respond > 0) ? 1 : 0;
	$loops = empty($loop) || !is_array($loop) ? 0 : count($loop);
?>

<li class="dropdown dropdown-extended dropdown-respond">
	<a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-target="#" style="cursor:pointer">
		내글반응
		<span class="badge rounded-2x badge-e badge-dark"><?php echo $respond?></span>
	</a>
	<ul class="dropdown-menu">
		<li class="external">
			<h5>미확인 내글반응이 <strong class="color-red"><?php echo $respond?>건</strong> 있습니다.</h5>
			<a href="<?php echo G5_BBS_URL?>/respond.php">more</a>
		</li>
		<li>
			<ul class="dropdown-menu-list contentHolder" style="height:275px;">
			<?php if ($loops) { foreach ($loop as $item) { ?>
				<?php if ($item["is_read"]) { ?>
				<li class="read-disable">
				<?php } else { ?>
				<li>
				<?php } ?>
					<a href="<?php echo $item["href"] ?>">
						<?php if ($photo == 'y') {?>
						<span class="photo">
							<span class="user_icon"><i class="fa fa-user respond-photo"></i></span>
						</span>
						<?php } ?>
						<?php if ( 0) {?>
						<span class="description">
							<span class="from color-black"><?php echo $item["mb_name"] ?></span>
							<span class="cate"><?php echo $item["type"] ?></span>
						</span>
						<?php } ?>
						<span class="subject color-grey">글제목: <?php echo $item["wr_subject"] ?></span>
						<span class="message"><?php echo $item["mention"] ?></span>
						<span class="time"><?php if ($item["is_read"]) { ?>읽음<?php } else { ?><strong class="color-red">읽지않음</strong><?php } ?> <?php echo $eb->date_time('Y-m-d H:i', $item["datetime"])?></span>
						<div class="clearfix"></div>
					</a>
				</li>
			<?php } } else { ?>
				<li class="display-block"><p class="text-center margin-top-20 font-size-12">확인하지 않은 내글반응이 없습니다.</p></li>
			<?php } ?>
			</ul>
		</li>
	</ul>
</li>

<script type="text/javascript" src="/eyoom/theme/basic2/plugins/scrollbar/src/jquery.mousewheel.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/scrollbar/src/perfect-scrollbar.js"></script>
<script>
	jQuery(document).ready(function ($) {
		"use strict";
		$('.contentHolder').perfectScrollbar();
		var chk = '<?php echo $chk; ?>';
		if(chk == 1) {
			$('.header-topbar').addClass('chk');
		}
	});
</script>
