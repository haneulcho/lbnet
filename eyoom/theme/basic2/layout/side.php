<?php if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
	$sidemenus = empty($sidemenu) || !is_array($sidemenu) ? 0 : count($sidemenu);
	include_once(EYOOM_FUNCTION_PATH.'/eb_poll.php');
	include_once(EYOOM_FUNCTION_PATH.'/eb_visit.php');
?>

<div class="basic-body-side <?php if ($eyoom["pos_side_layout"] == 'left') { ?>left<?php } else{ ?>right<?php } ?>-side col-sm-3">

	<?php if (!G5_IS_MOBILE) { ?>
	<div class="margin-bottom-20">
		<!--{* 아웃로그인 *}-->
		<?php if ($eyoom["use_gnu_outlogin"] == 'y') {
			echo outlogin('basic');
		} else {
			echo eb_outlogin($eyoom["outlogin_skin"]);
		} ?>
	</div>
	<?php } ?>

	<!--{* ------------- Side Nav 영역 시작 ------------- *}-->
	<?php if (!defined('_INDEX_')) { ?>
	<div class="margin-bottom-20">
		<ul class="list-group sidebar-nav-e1" id="sidebar-nav">
		<?php if ($sidemenus){foreach($sidemenu as $sidemenu_k1=>$sidemenu_v1){
$sidesidemenus=empty($sidemenu_v1["submenu"])||!is_array($sidemenu_v1["submenu"])?0:count($sidemenu_v1["submenu"]);?>
<li class="list-group-item list-toggle <?php if ($sidemenu_v1["active"]) { ?>active<?php } ?>">
<a <?php if (G5_IS_MOBILE&&$sidemenu_v1["submenu"]) { ?>data-toggle="collapse" data-parent="#sidebar-nav" href="#collapse-<?php echo $sidemenu_k1?>"<?php }else{?>href="<?php echo $sidemenu_v1["me_link"]?>" target="_<?php echo $sidemenu_v1["me_target"]?>"<?php } ?>><?php echo $sidemenu_v1["me_name"]?></a>
<ul id="collapse-<?php echo $sidemenu_k1?>" class="collapse <?php if ($sidemenu_v1["active"]) { ?>in<?php } ?>">
<?php if ($sidesidemenus){foreach($sidemenu_v1["submenu"] as $sidemenu_v2) { ?>
<li class="<?php if ($sidemenu_v2["active"]) { ?>active<?php } ?>"><?php if ($sidemenu_v2["new"]) { ?><span class="badge badge-red">new</span><?php } ?><a href="<?php echo $sidemenu_v2["me_link"]?>" target="_<?php echo $sidemenu_v2["me_target"]?>"><?php if ($sidemenu_v2["active"]) { ?><i class="fa fa-chevron-circle-right"></i><?php }else{?><i class="fa fa-circle"></i><?php } ?> <?php echo $sidemenu_v2["me_name"]?></a></li>
<?php }}?>
</ul>
</li>
<?php }}?>
</ul>
	</div>
	<?php } ?>
	<!--{* ------------- Side Nav 영역 끝 ------------- *}-->

	<?php if ($is_member && $member["mb_level"] > 1) { ?>
		<div class="margin-bottom-20">
			<!--{* 투표 *}-->
			<?php if ($eyoom["use_gnu_poll"] == 'y') {
				echo poll('basic');
			} else {
				echo eb_poll($eyoom["poll_skin"]);
			} ?>
		</div>
		<?php if ((defined('_INDEX_') && $member["mb_level"] >= 3 && !$is_admin) || $is_admin) { ?>
			<div class="margin-bottom-20">
			<!--{* 방문자 통계 *}-->
			<?php if ($eyoom["use_gnu_visit"] == 'y') {
				echo visit('basic');
			} else {
				echo eb_visit($eyoom["visit_skin"]);
			} ?>
			</div>
		<?php } ?>
	<?php } ?>
</div>

<script type="text/javascript" src="/eyoom/theme/basic2/js/theia-sticky-sidebar.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	App.initSideSticky();
});
</script>
