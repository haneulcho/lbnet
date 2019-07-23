<?php if (!defined('_GNUBOARD_')) exit; ?>

<div class="headline"><h6><strong>사이트 통계</strong></h6></div>
<div class="statistics-wrap">
	<ul class="list-unstyled statistics-list">
	<?php if ($is_admin) { ?>
		<li><a href="<?php echo G5_BBS_URL?>/current_connect_admin.php">현재접속자 : <b><?php echo $connect["total_cnt"] ?><?php if ($connect["mb_cnt"]) { ?> (<span class='color-red'>Member <?php echo $connect["mb_cnt"] ?></span>)<?php } ?></b></a></li>
		<li>최대방문자 : <b><?php echo $counter["visit_max"] ?></b></li>
		<?php if ( 1) { ?>
		<li>신규회원수 : <b><?php echo $counter["newby"] ?></b></li>
		<?php } ?>
	<?php } ?>
		<li>오늘방문자 : <b><?php echo $counter["visit_today"] ?></b></li>
		<li>어제방문자 : <b><?php echo $counter["visit_yesterday"] ?></b></li>
		<li>전체방문자 : <b><?php echo $counter["visit_total"] ?></b></li>
		<li>전체회원수 : <b><?php echo $counter["members"] ?></b></li>
		<li>전체게시물 : <b><?php echo $counter["write"] ?></b></li>
		<?php if ( 0) { ?>
		<li>전체코멘트 : <b><?php echo $counter["comment"] ?></b></li>
		<?php } ?>
	</ul>
</div>
<style>
.statistics-wrap {position:relative;overflow:hidden;border:1px solid #e5e5e5;padding:10px}
.statistics-wrap ul {margin-bottom:0}
.statistics-list li:first-child {border-top:none !important}
.statistics-list li {color:#555;font-size:11px;padding:6px 0;display:block;border-top:solid 1px #e8e8e8}
.statistics-list li a {color:#555;font-size:11px;display:block}
.statistics-list li b {color:#555;float:right}
</style>
