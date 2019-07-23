<?php if (!defined('_GNUBOARD_')) exit;
	$loops = empty($loop) || !is_array($loop) ? 0 : count($loop);
?>
<div class="headline">
	<h6><i class="fa fa-map-marker"></i><strong><?php echo $title ?></strong></h6>
</div>
<div class="webzine-latest">
	<div class="row">
	<?php if ($loops) { foreach ($loop as $item) { ?>
		<div class="col-md-6">
			<div class="webzine-item">
				<div class="webzine-img">
					<a href="<?php echo $item["href"] ?>">
						<div class="img-box">
						<?php if ($item["image"]) { ?>
							<img class="img-responsive" src="<?php echo $item["image"] ?>">
							<?php if ($item["is_video"]) { ?><span class="video-icon"><i class="fa fa-play-circle-o"></i></span><?php } ?>
						<?php } else { ?>
							<span class="no-image">No Image</span>
						<?php } ?>
						<?php if ($item["wr_good"]) { ?>
							<div class="img-caption"><span><i class="fa fa-thumbs-up"></i> <?php echo number_format($item["wr_good"]) ?></span><?php if ($item["wr_nogood"]) { ?><span><i class="fa fa-thumbs-down"></i> <?php echo number_format($item["wr_nogood"])?></span><?php } ?>
							</div>
						<?php } ?>
						</div>
					</a>
				</div>
				<div class="webzine-txt">
					<a href="<?php echo $item["href"] ?>">
						<div class="txt-subj">
							<h5><?php echo $item["wr_subject"] ?></h5>
						</div>
						<?php if ($content == 'y') { ?>
						<p class="txt-cont"><?php echo $item["wr_content"] ?></p>
						<?php } ?>
						<div class="lbdes">
							<span class="lbnick"><i class="fa fa-user"></i><?php echo $item["mb_nick"] ?></span>
							<span class="lbcomment"><i class="fa fa-comment-o"></i><?php if ($item["wr_comment"]) { ?><?php echo number_format($item["wr_comment"])?><?php } else { ?>0<?php } ?></span>
							<span class="lbtime"><i class="fa fa-clock-o"></i><?php echo $eb->date_time('Y-m-d H:i', $item["datetime"])?></span>
						</div>
					</a>
				</div>
			</div>
		</div>
	<?php } } else { ?>
		<p class="text-center font-size-12 margin-top-30">최신글이 없습니다.</p>
	<?php } ?>
	</div>
</div>
<script>
$(function(){
	var duration = 120;
	var $img_cap = $('.webzine-latest .webzine-img');
	$img_cap.find('.img-box')
		.on('mouseover', function(){
			$(this).find('.img-caption').stop(true).animate({bottom: '0px'}, duration);
		})
		.on('mouseout', function(){
			$(this).find('.img-caption').stop(true).animate({bottom: '-26px'}, duration);
		});
});
</script>
<style>
.webzine-latest {position:relative;overflow:hidden;padding:15px 15px 0px;min-height:207px}
.webzine-item {position:relative;overflow:hidden;margin-bottom:15px}
.webzine-latest .webzine-img {position:relative;overflow:hidden;float:left;width:36%}
.webzine-latest .img-box {position:relative;overflow:hidden;height:98px;background:#34343a;line-height:98px;text-align:center}
.webzine-latest .img-box .no-image {color:#888;font-size:11px}
.webzine-latest .img-comment {position:absolute;top:8px;left:8px;display:inline-block;min-width:35px;padding:0px 3px;font-size:10px;font-weight:300;line-height:13px;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;background:#74747a}
.webzine-latest .img-box .video-icon {position:absolute;top:5px;right:5px;color:#fff;font-size:20px;line-height:20px}
.webzine-latest .img-caption {color:#fff;font-size:11px;position:absolute;left:0;bottom:-26px;display:block;z-index:1;background:rgba(0, 0, 0, 0.7);text-align:left;width:100%;height:26px;line-height:20px;margin-bottom:0;padding:3px 10px}
.webzine-latest .img-caption span {margin-right:7px}
.webzine-latest .img-caption span i {color:#aaa}
.webzine-latest .webzine-txt {position:relative;overflow:hidden;float:right;padding-left:15px;padding-top:8px;width:64%}
.webzine-latest .txt-subj {margin-bottom:5px}
.webzine-latest .txt-subj h5 {font-size:13px;font-weight:bold;margin:0;display:block;text-overflow:ellipsis;white-space:nowrap;word-wrap:normal;overflow:hidden;line-height:1.2;margin-bottom:5px;}
.webzine-latest .webzine-txt a:hover .txt-subj h5 {color:#f44455;}
.webzine-latest .txt-cont {position:relative;overflow:hidden;height:34px;font-size:11px;color:#888;margin-bottom:12px}
.webzine-latest .txt-photo img {width:20px;height:20px;margin-right:2px}
.webzine-latest .txt-photo .txt-user-icon {width:20px;height:20px;font-size:14px;line-height:20px;text-align:center;background:#84848a;color:#fff;margin-right:2px;display:inline-block;white-space:nowrap;vertical-align:baseline}
.webzine-latest .txt-nick {font-size:11px;color:#555}
.webzine-latest .txt-time {font-size:11px;color:#555;margin-left:5px}
.webzine-latest .txt-time .i-color {color:#bbb}
@media (max-width: 1199px) {
	.webzine-latest .img-box {height:80px}
	.webzine-latest .txt-cont {height:17px}
}
</style>
