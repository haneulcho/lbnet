<?php if (!defined('_GNUBOARD_')) exit;
	add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/owl-carousel/owl-carousel/owl.carousel.css" type="text/css" media="screen">',0);
	$loops = empty($loop) || !is_array($loop) ? 0 : count($loop);
?>
<style>
.lb_userad .owl-nav, .lb_userad .owl-dots {display:none !important}
.lb_userad {min-height:261px;max-height:261px;margin-bottom:15px;background-color:#fff;box-shadow:0 5px 19px rgb(232, 232, 232)}
.lb_userad .headline {position:relative;background-color:#eaeae6}
.lb_userad .owl-navi {position:absolute;top:10px;right:10px}
.lb_userad .owl-navi a.owl-btn {color:#fff;cursor:pointer;width:20px;height:20px;line-height:20px;font-size:12px;text-align:center;background:#a5a5a5}
.lb_userad .owl-navi a.owl-btn:hover {color:#fff;background:#f44455;-webkit-transition:all 0.2s ease-in-out;-moz-transition:all 0.2s ease-in-out;-o-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out}
.lb_userad .owl-navi a.owl-btn.prev-notice-balloon {position:absolute;right:24px;z-index:1}
.lb_userad .owl-navi a.owl-btn.next-notice-balloon {position:absolute;right:0;z-index:1}
#userad {position:relative;overflow:hidden;width:100%;max-height:222px;margin:0;padding:0}
#userad:after {display:block;content:'';clear:both}
#userad .ad_item {float:left;position:relative;width:100%;margin:0}
#userad .ad_item .item:nth-child(1) .lblink {color:#f44455}
#userad .ad_item .item:nth-child(2) .lblink {color:#e6880f}
#userad .ad_item .item:nth-child(3) .lblink {color:#c5b20b}
#userad .ad_item .item:nth-child(4) .lblink {color:#08c1a9}
#userad .ad_item .item:nth-child(5) .lblink {color:#8165e2}
#userad .lbcheck {float:left;padding:0;margin-top:8px}
#userad .lblink {position:relative;-webkit-box-sizing:border-box;box-sizing:border-box;box-shadow:0 5px 19px rgb(232, 232, 232);background-color:#fff;padding:10px 16px}
#userad .lblink:hover .lbtitle {color:#D42E2E}
#userad .lbtitle {display:block;font-size:13px;margin-bottom:0}
#userad .txtonly .lblink:after {display:block;visibility:hidden;clear:both;content:""}
#userad.txtonly .item {margin:0;border-bottom:1px solid #eee}
#userad.txtonly .lblink {box-shadow:none}
#userad.txtonly .item:hover .lblink,
#userad.txtonly .item.active .lblink {background-color:#f8f8f8;box-shadow:none}
#userad.txtonly .lblink:after {display:block;visibility:hidden;clear:both;content:""}
#userad.txtonly .lbtitle {float:left}
</style>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/owl-carousel/owl-carousel/owl.carousel.min.js"></script>
<script>
$(document).ready(function() {
	var owl = jQuery("#userad");
	owl.owlCarousel({
		loop: true,
		autoplay: true,
		autoplayTimeout: 5000,
		autoplaySpeed: 1000,
		autoplayHoverPause: true,
		navSpeed: 1000,
		items : 1,
		smartSpeed: 1000,
		pagination: false
	});
	jQuery(".next-notice-balloon").click(function(){
		owl.trigger('next.owl.carousel');
	});
	jQuery(".prev-notice-balloon").click(function(){
		owl.trigger('prev.owl.carousel');
	});
});
</script>

<div class="lb_userad">
	<div class="headline">
		<h6><i class="fa fa-bullhorn"></i><strong><?php echo $title ?></strong></h6>
		<div class="owl-navi">
			<a class="owl-btn prev-notice-balloon"><i class="fa fa-angle-left"></i></a>
			<a class="owl-btn next-notice-balloon"><i class="fa fa-angle-right"></i></a>
		</div>
	</div>
	<div id="userad" class="txtonly owl-carousel" style="display:block">
	<?php if ($loops) { $i = -1; foreach ($loop as $item) { $i++; ?>
		<?php if ($i % 5 == 0) { // 전광판에 톰빌리 콜라보 공지사항 고정 ?>
		<div class="ad_item">
			<div class="item">
				<a class="lblink" style="background-color:#f44454" href="/bbs/board.php?bo_table=free2&amp;wr_id=445427">
					<div class="lbtitle txtonly" style="color:#fff;font-weight:bold">
						<i class="fa fa-picture-o"></i> 레볼루션 생일 축하해! x 톰빌리 이벤트 안내💕
					</div>
				</a>
			</div>
		<?php } ?>
			<div class="item">
				<a class="lblink" href="<?php echo $item["href"] ?>">
					<div class="lbtitle txtonly">
						<?php if ($item["image"]) { ?><i class="fa fa-picture-o color-red"></i> <?php } ?><?php echo $item["wr_subject"] ?><?php if ($item["wr_comment"]) { ?><span class="lbcomment"><i class="fa fa-comment-o"></i><?php echo number_format($item["wr_comment"]) ?></span><?php } ?><?php if ($item["wr_good"]) { ?><span class="lbup"><i class="fa fa-thumbs-up"></i><?php echo number_format($item["wr_good"]) ?></span><?php } ?>
					</div>
				</a>
			</div>
		<?php if ($i == $loops -1 || $i % 5 == 4) { ?>
		</div>
		<?php } ?>
	<?php } } else { ?>
		<div class="ad_item empty"><p class="text-center font-size-12 margin-top-30">전광판에 등록된 게시글이 없습니다.</p></div>
	<?php } ?>
	</div>
</div>
