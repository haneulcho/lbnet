<?php if (!defined('_GNUBOARD_')) exit;
	$loops = empty($loop) || !is_array($loop) ? 0 : count($loop);
?>

<div class="headline">
	<h6><i class="fa fa-map-marker"></i><strong><?php echo $title ?></strong></h6>
</div>

<div class="basic-latest">
	<ul class="list-unstyled">
	<?php if ($loops) { foreach ($loop as $item) { ?>
		<li>
			<a class="lblink" href="<?php echo $item["href"] ?>">
				<div class="lbtitle txtonly">
				<?php echo $item["wr_subject"] ?><?php if ($item["wr_comment"]) { ?><span class="lbcomment"><i class="fa fa-comment-o"></i><?php echo number_format($item["wr_comment"]) ?></span><?php } ?><?php if ($item["wr_good"]) { ?><span class="lbup"><i class="fa fa-thumbs-up"></i><?php echo number_format($item["wr_good"]) ?></span><?php } ?>
				</div>
			</a>
		</li>
	<?php } } else { ?>
		<li><p class="text-center font-size-12 margin-top-30">최신글이 없습니다.</p></li>
	<?php } ?>
	</ul>
</div>
