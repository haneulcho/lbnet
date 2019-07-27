<?php if (!defined("_GNUBOARD_")) exit;
$pages = empty($str) || !is_array($str) ? 0 : count($str);
?>
<div class="text-center">
	<ul class="pagination">
		<?php if ($prev_part_href != '') { ?>
		<li><a href="<?php echo $prev_part_href ?>">이전검색</a></li>
		<?php } else { ?>
		<li><a href="<?php echo $pg_url ?>1<?php echo $add ?>"><i class="fa fa-angle-double-left"></i></a></li>
		<?php } ?>
		<li><a href="<?php echo $pg_url ?><?php if (($cur_page - 1) <= 0) { ?>1<?php } else { ?><?php echo ($cur_page - 1) ?><?php } ?><?php echo $add ?>"><i class="fa fa-angle-left"></i></a></li>
		<?php if ($pages) { foreach ($str as $k => $v) { ?>
		<li <?php if ($v["on"]) { ?>class="active"<?php } ?>><a href="<?php echo $v["url"] ?>"><?php echo $k ?><span class="sound_only">페이지</span></a></li>
		<?php } } else { ?>
		<li class="active"><a href="<?php echo $pg_url ?>1<?php echo $add ?>">1<span class="sound_only">페이지</span></a></li>
		<?php } ?>
		<li><a href="<?php echo $pg_url ?><?php if (($cur_page + 1) > $total_page) { ?><?php echo $total_page ?><?php } else { ?><?php echo ($cur_page + 1) ?><?php } ?><?php echo $add ?>"><i class="fa fa-angle-right"></i></a></li>
		<?php if ($next_part_href != '') { ?>
		<li><a href="<?php echo $next_part_href ?>">다음검색</a></li>
		<?php } else { ?>
		<li><a href="<?php echo $pg_url ?><?php echo $total_page ?><?php echo $add ?>"><i class="fa fa-angle-double-right"></i></a></li>
		<?php } ?>
	</ul>
</div>