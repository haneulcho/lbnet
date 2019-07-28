<?php if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
	add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
	add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/font-awesome/css/font-awesome.min.css" type="text/css" media="screen">',0);
	add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/eyoom-form/css/eyoom-form.min.css" type="text/css" media="screen">',0);
	if (G5_IS_MOBILE) {
		add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style_m.min.css" type="text/css" media="screen">',0);
	} else {
		add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style.min.css" type="text/css" media="screen">',0);
	}
	$menus = empty($menu) || !is_array($menu) ? 0 : count($menu);
	include_once(EYOOM_FUNCTION_PATH.'/eb_outlogin.php');
	include_once(EYOOM_FUNCTION_PATH.'/eb_banner.php');
?>

<?php if (!$wmode) { ?>
<div class="wrapper">
<?php if (!G5_IS_MOBILE) { ?>
<!--{* PC 화면 시작 *}-->
	<div class="header-fixed basic-layout">
		<!--{* Header Nav *}-->
		<div class="header-nav nav-background-light header-sticky">
			<!--{* Header Topbar *}-->
			<div class="header-topbar">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<ul class="list-unstyled topbar-left">
								<li><a id="bookmarkme" href="javascript:void(0);" rel="sidebar" title="bookmark this page">즐겨찾기</a></li>
								<?php if ($is_admin) { ?>
									<li><a href="<?php echo G5_BBS_URL ?>/current_connect_admin.php">접속자 <?php echo $connect["total_cnt"] ?><?php if ($connect["mb_cnt"]) { ?> (<span><?php echo $connect["mb_cnt"] ?></span>)<?php } ?></a></li>
									<li><a href="<?php echo G5_BBS_URL ?>/declare.php">신고/블라인드</a></li>
								<?php } ?>
								<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=qna">1:1문의</a></li>
							</ul>
						</div>
						<div class="col-md-6">
							<ul class="list-unstyled topbar-right">
								<?php if ($is_member) { ?>
									<?php if ($is_admin == 'super') { ?>
									<li><a href="<?php echo G5_ADMIN_URL ?>">관리자</a></li>
									<?php } ?>
									<li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">정보수정</a></li>
									<li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
									<!--{* 쪽지 최신글 *}-->
									<?php echo $latest->latest_memo('memo_latest','count=6||cut_subject=20||photo=y')?>
									<!--{* 내글반응 최신글 *}-->
									<?php echo $latest->latest_respond('respond_latest','count=6||cut_subject=20||photo=y')?>
								<?php } else { ?>
									<li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
									<li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!--{* End Header Topbar *}-->
			<div class="navbar mega-menu" role="navigation">
				<div class="container">
					<div class="menu-container">
						<!--{* ------------- Header Logo 영역 시작 ------------- *}-->
						<div class="header-logo">
							<a class="navbar-brand" href="<?php echo G5_URL ?>"><img src="/eyoom/theme/basic2/image/lebolution_logo.png" class="img-responsive" alt="<?php echo $config['cf_title']; ?> LOGO"></a>
						</div>
						<!--{* ------------- Header Logo 영역 끝 ------------- *}-->
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="fa fa-align-justify"></span>
						</button>
						<?php if ($is_admin) { ?>
						<div class="nav-in-right">
							<ul class="menu-icons-list">
								<li class="menu-icons">
									<i class="menu-icons-style search search-close search-btn fa fa-search"></i>
								</li>
							</ul>
						</div>
						<?php } ?>
					</div>
					<?php if ($is_admin) { ?>
					<div class="menu-container">
						<div class="search-open">
							<form name="fsearchbox" method="get" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);">
							<input type="hidden" name="sfl" value="wr_subject||wr_content">
							<input type="hidden" name="sop" value="and">
							<label for="sch_stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
							<input type="text" name="stx" id="sch_stx" maxlength="20" class="form-control" class="form-control" placeholder="전체검색... [검색어를 입력하세요]">
							</form>
							<script>
							function fsearchbox_submit(f) {
								if (f.stx.value.length < 2 || f.stx.value == $("#sch_stx").attr("placeholder")) {
									alert("검색어는 두글자 이상 입력하십시오.");
									f.stx.select();
									f.stx.focus();
									return false;
								}
								var cnt = 0;
								for (var i=0; i<f.stx.value.length; i++) {
									if (f.stx.value.charAt(i) == ' ') cnt++;
								}
								if (cnt > 1) {
									alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
									f.stx.select();
									f.stx.focus();
									return false;
								}
								return true;
							}
							</script>
						</div>
					</div>
  					<?php } ?>
					<div class="collapse navbar-collapse navbar-responsive-collapse">
						<div class="menu-container">
							<ul class="nav navbar-nav">
								<!--{* Menu *}-->
								<?php if ($is_member) { ?>
									<?php if ($is_admin || $member['mb_woman'] == 0 || $member['mb_woman'] == 3) { ?>
									<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=levelup"><i class="fa fa-pencil-square-o"></i> 등업신청</a></li>
									<?php } ?>

									<?php if ($member['mb_level'] > 2) { ?>

<?php if($menus){foreach($menu as $menu_v1){
$submenus=empty($menu_v1["submenu"])||!is_array($menu_v1["submenu"])?0:count($menu_v1["submenu"]);?>
<?php if($menu_v1["active"]){?>
<?php $liClass = 'active' ?>
<?php }?>
<?php if($menu_v1["submenu"]){?>
<?php $space = '' ?>
<?php if($menu_v1["active"]){?>
<?php $space = ' ' ?>
<?php }?>
<?php $liClass = $space.'dropdown' ?>
<?php }?>
<li<?php if($menu_v1["active"]){?> class="<?php echo $liClass; ?>"<?php }?>>
<a href="<?php echo $menu_v1["me_link"]?>" target="_<?php echo $menu_v1["me_target"]?>" class="dropdown-toggle"<?php if($menu_v1["submenu"]){?> data-hover="dropdown"<?php }?>>
<?php if($menu_v1["me_icon"]){?><i class="fa <?php echo $menu_v1["me_icon"]?>"></i> <?php }?><?php echo $menu_v1["me_name"]?><?php if($menu_v1["new"]){?>&nbsp;<i class="fa fa-check-circle color-red"></i><?php }?>
</a>
<?php if($submenus){$i2=-1;foreach($menu_v1["submenu"] as $menu_v2){$i2++;
$subsubmenus=empty($menu_v2["subsub"])||!is_array($menu_v2["subsub"])?0:count($menu_v2["subsub"]);?>
<?php if($i2== 0){?>
<ul class="dropdown-menu">
<?php }?>
<li class="dropdown-submenu <?php if($menu_v2["active"]){?>active<?php }?>">
<a href="<?php echo $menu_v2["me_link"]?>" target="_<?php echo $menu_v2["me_target"]?>"><?php if($menu_v2["me_icon"]){?><i class="fa <?php echo $menu_v2["me_icon"]?>"></i> <?php }?><?php echo $menu_v2["me_name"]?><?php if($menu_v2["new"]){?>&nbsp;<i class="fa fa-check-circle color-red"></i><?php }?><?php if($menu_v2["sub"]=='on'){?><i class="fa fa-angle-right sub-caret hidden-sm hidden-xs"></i><i class="fa fa-angle-down sub-caret hidden-md hidden-lg"></i><?php }?></a>
<?php if($subsubmenus){$i3=-1;foreach($menu_v2["subsub"] as $menu_v3){$i3++;?>
<?php if($i3== 0){?>
<ul class="dropdown-menu <?php if($menu_v3["active"]){?>active<?php }?>">
<?php }?>
<li class="dropdown-submenu">
<a href="<?php echo $menu_v3["me_link"]?>" target="_<?php echo $menu_v3["me_target"]?>"><?php if($menu_v3["me_icon"]){?><i class="fa <?php echo $menu_v3["me_icon"]?>"></i> <?php }?><?php echo $menu_v3["me_name"]?><?php if($menu_v3["new"]){?>&nbsp;<i class="fa fa-check-circle color-red"></i><?php }?><?php if($menu_v3["sub"]=='on'){?><i class="fa fa-angle-right sub-caret hidden-sm hidden-xs"></i><i class="fa fa-angle-down sub-caret hidden-md hidden-lg"></i><?php }?></a>
</li>
<?php if($i3==$subsubmenus- 1){?>
</ul>
<?php }?>
<?php }}?>
</li>
<?php if($i2==$submenus- 1){?>
</ul>
<?php }?>
<?php }}?>
</li>
<?php }}?>
<?php }?>
<?php }?>
</ul>
						</div>
					</div><!--{* navbar-collapse *}-->
				</div>
			</div>
			<!--{* End Navbar *}-->
		</div>
		<!--{* End Header Nav *}-->

		<div class="header-sticky-space"></div>

		<?php if (!defined('_INDEX_')) { ?>
		<!--{* Page Title *}-->
  		<div class="board-title">
  			<div class="container">
  				<h3 class="pull-left"><i class="fa fa-map-marker"></i> <a href="<?php echo $subinfo["title_link"] ?>"><?php echo $subinfo["title"] ?></a></h3>
  			</div>
  		</div>
		<!--{* End Board Title *}-->
		<?php } ?>
		<!--{* Basic Body *}-->
		<div class="basic-body container">
			<div class="row">
				<?php if ($eyoom["use_main_side_layout"] == 'y') { ?>
				<div class="basic-body-main col-sm-9">
				<?php } else { ?>
				<div class="basic-body-main col-md-12">
				<?php } ?>

				<?php if (defined('_INDEX_')) { ?>
				<!--{* 상단 배너 시작 *}-->
				<div class="row banner_top margin-bottom-20">
					<div class="col-sm-12">
						<?php echo eb_banner(1, 48) ?>
					</div>
				</div>
				<!--{* 상단 배너 끝 *}-->
				<?php } ?>
<!--{* PC 화면 끝 *}-->

<?php } else { ?>
<!--{* 모바일 화면 시작 *}-->
	<div class="header-fixed basic-layout">
		<!--{* Header Nav *}-->
		<div class="header-nav nav-background-light header-sticky">
			<!--{* Header Topbar *}-->
			<div class="header-topbar">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<ul class="list-unstyled topbar-left">
								<?php if ($is_admin) { ?>
								<li><a href="<?php echo G5_BBS_URL ?>/current_connect_admin.php">접속자 <?php echo $connect["total_cnt"] ?><?php if ($connect["mb_cnt"]) { ?> (<span><?php echo $connect["mb_cnt"] ?></span>)<?php } ?></a></li>
								<li><a href="<?php echo G5_BBS_URL ?>/declare.php">신고/블라인드</a></li>
								<?php } ?>
								<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=qna">1:1문의</a></li>
							</ul>
						</div>
						<div class="col-md-6">
							<ul class="list-unstyled topbar-right">
								<?php if ($is_member) { ?>
									<?php if ($is_admin == 'super') { ?>
									<li><a href="<?php echo G5_ADMIN_URL ?>">관리자</a></li>
									<?php } ?>
									<!--{* 쪽지 최신글 *}-->
									<?php echo $latest->latest_memo('memo_latest','count=6||cut_subject=20||photo=y')?>
									<!--{* 내글반응 최신글 *}-->
									<?php echo $latest->latest_respond('respond_latest','count=6||cut_subject=20||photo=y')?>
								<?php } else { ?>
									<li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
									<li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!--{* End Header Topbar *}-->
			<div class="lb_m_header">
				<!--{* ------------- Header Logo 영역 시작 ------------- *}-->
				<?php if (defined('_INDEX_')) { ?>
				<div class="header-logo"><a class="navbar-brand" href="<?php echo G5_URL ?>"><img src="/eyoom/theme/basic2/image/lebolution_logo.png" class="img-responsive" alt="<?php echo $config["cf_title"] ?> LOGO"></a></div>
				<?php } else { ?>
				<span class="lbbread"><a href="<?php echo $subinfo["title_link"] ?>"><?php echo $subinfo["title"] ?></a></span>
				<?php } ?>
				<!--{* ------------- Header Logo 영역 끝 ------------- *}-->

				<?php if ($is_member) { ?>
				<div class="lb_toggle btn_menu">
					<button type="button">
						<span class="sr-only">기본 메뉴 열기</span>
						<span class="fa fa-bars"></span>
					</button>
				</div>
				<div class="lb_toggle btn_myinfo">
					<button type="button">
						<span class="sr-only">내 메뉴 열기</span>
						<span class="fa fa-user-circle"></span>
					</button>
				</div>
				<?php } ?>
			</div>
			<!--{* End Topbar *}-->
		</div>
		<!--{* End Header Nav *}-->

		<div class="header-sticky-space"></div>

		<div class="lb_m_nav left" role="navigation">
			<div class="lb_m_nav_cont">
				<div class="lb_m_nav_top">
					<a class="navbar-brand" href="<?php echo G5_URL ?>"><img src="/eyoom/theme/basic2/image/lebolution_logo2.png" class="img-responsive" alt="<?php echo $config["cf_title"] ?> LOGO"></a>
					<a href="#" class="btn_navClose"><span class="sr-only">메뉴 닫기</span><i class="fa fa-times"></i></a>
				</div>
				<div class="lb_m_nav_menu">
					<ul>
						<!--{* Menu *}-->
						<?php if ($is_member) { ?>
							<?php if ($is_admin || $member["mb_woman"] == 0 || $member["mb_woman"] == 3) { ?>
							<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=levelup"><i class="fa fa-pencil-square-o"></i> 등업신청</a></li>
							<?php } ?>
							<?php if ($member["mb_level"] > 2) { ?>
								<?php if ($menus) { foreach ($menu as $menu_v1) { $submenus = empty($menu_v1["submenu"]) || !is_array($menu_v1["submenu"]) ? 0 : count($menu_v1["submenu"]); ?>
								<?php if ($menu_v1["active"]) { ?>
								<?php $liClass = 'active' ?>
								<?php } ?>
								<?php if ($menu_v1["submenu"]) { ?>
								<?php $space = '' ?>
								<?php if ($menu_v1["active"]) { ?>
								<?php $space = ' ' ?>
								<?php } ?>
								<?php $liClass = $space . 'dropdown' ?>
								<?php } ?>
								<li<?php if ($menu_v1["active"]) { ?> class="<?php echo $liClass; ?>"<?php } ?>>
								<a href="<?php echo $menu_v1["me_link"] ?>" target="_<?php echo $menu_v1["me_target"] ?>" class="dropdown-toggle"<?php if ($menu_v1["submenu"]) { ?> data-toggle="dropdown"<?php } ?>>
								<?php if ($menu_v1["me_icon"]) { ?><i class="fa <?php echo $menu_v1["me_icon"] ?>"></i> <?php } ?><?php echo $menu_v1["me_name"] ?><?php if ($menu_v1["new"]) { ?>&nbsp;<i class="fa fa-check-circle color-red"></i><?php } ?>
								</a>
								<?php if ($submenus) { $i2 = -1; foreach ($menu_v1["submenu"] as $menu_v2) { $i2++; $subsubmenus = empty($menu_v2["subsub"]) || !is_array($menu_v2["subsub"]) ? 0 : count($menu_v2["subsub"]); ?>
								<?php if ($i2 == 0) { ?>
								<ul class="dropdown-menu">
								<?php } ?>
								<li class="dropdown-submenu <?php if ($menu_v2["active"]) { ?>active<?php } ?>">
								<a href="<?php echo $menu_v2["me_link"] ?>" target="_<?php echo $menu_v2["me_target"] ?>"><?php if ($menu_v2["me_icon"]) { ?><i class="fa <?php echo $menu_v2["me_icon"] ?>"></i> <?php } ?><?php echo $menu_v2["me_name"] ?><?php if ($menu_v2["new"]) { ?>&nbsp;<i class="fa fa-check-circle color-red"></i><?php } ?><?php if ($menu_v2["sub"] == 'on') { ?><i class="fa fa-angle-right sub-caret hidden-sm hidden-xs"></i><i class="fa fa-angle-down sub-caret hidden-md hidden-lg"></i><?php } ?></a>
								<?php if ($subsubmenus) { $i3 = -1; foreach ($menu_v2["subsub"] as $menu_v3) { $i3++; ?>
								<?php if ($i3 == 0) { ?>
								<ul class="dropdown-menu <?php if ($menu_v3["active"]) { ?>active<?php } ?>">
								<?php } ?>
								<li class="dropdown-submenu">
								<a href="<?php echo $menu_v3["me_link"] ?>" target="_<?php echo $menu_v3["me_target"] ?>"><?php if ($menu_v3["me_icon"]) { ?><i class="fa <?php echo $menu_v3["me_icon"] ?>"></i> <?php } ?><?php echo $menu_v3["me_name"] ?><?php if ($menu_v3["new"]) { ?>&nbsp;<i class="fa fa-check-circle color-red"></i><?php } ?><?php if ($menu_v3["sub"] == 'on') { ?><i class="fa fa-angle-right sub-caret hidden-sm hidden-xs"></i><i class="fa fa-angle-down sub-caret hidden-md hidden-lg"></i><?php } ?></a>
								</li>
								<?php if ($i3 == $subsubmenus - 1) { ?>
								</ul>
								<?php } ?>
								<?php } } ?>
								</li>
								<?php if ($i2 == $submenus - 1) { ?>
											</ul>
											<?php } ?>
										<?php } } ?>
									</li>
								<?php } } ?>
								<!--{* End Menu 반복 *}-->
							<?php } ?>
						<?php } ?>
						<!--{* End Menu *}-->
					</ul>
				</div>
			</div>
		</div>


		<?php if ($member["mb_id"] && $member["mb_level"] > 1) { ?>
		<div class="lb_m_nav right" role="navigation">
			<div class="lb_m_nav_cont">
				<div class="lb_m_nav_top">
					<a href="#" class="btn_navClose"><span class="sr-only">메뉴 닫기</span><i class="fa fa-times"></i></a>
				</div>
				<div class="lb_m_nav_myinfo">
						<?php if ($is_member) { ?>
						<?php if ($eyoom["use_gnu_outlogin"] == 'y') { ?><?php echo outlogin('basic') ?><?php } else { ?><?php echo eb_outlogin($eyoom["outlogin_skin"]) ?><?php } ?>
						<?php } ?>
						<div class="lb_m_nav_menu">
						<ul>
							<li class="open">
								<a href="/bbs/board.php?bo_table=meet" target="_self" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-heart"></i> 내 메뉴</a>
								<ul class="dropdown-menu">
									<li class="dropdown-submenu">
										<a href="<?php echo G5_BBS_URL ?>/memo.php" target="_blank">쪽지</span></a>
									</li>
									<li class="dropdown-submenu">
										<a href="<?php echo G5_BBS_URL ?>/respond.php" target="_blank">내글반응</span></a>
									</li>
									<li class="dropdown-submenu">
										<a href="<?php echo G5_BBS_URL ?>/mine.php">내가 쓴 글</a>
									</li>
									<li class="dropdown-submenu">
										<a href="<?php echo G5_BBS_URL ?>/mine.php?type=cmt">내가 쓴 댓글</a>
									</li>
									<?php if ($is_admin) { ?>
									<li class="dropdown-submenu">
										<a href="<?php echo G5_BBS_URL ?>/declare.php"><span class="color-red">신고/블라인드</span></a>
									</li>
									<?php } ?>
									<li class="dropdown-submenu">
										<a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">내 정보수정</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>

		<!--{* Basic Body *}-->
		<div class="basic-body container">
			<div class="row">
				<?php if ($eyoom["use_main_side_layout"] == 'y') { ?>
				<div class="basic-body-main col-sm-9">
				<?php } else { ?>
				<div class="basic-body-main col-md-12">
				<?php } ?>
				<?php if (defined('_INDEX_')) { ?>
				<!--{* 상단 배너 시작 *}-->
				<div class="row banner_top">
					<div class="col-sm-12 margin-bottom-10">
						<?php echo eb_banner(1, 48) ?>
					</div>
				</div>
				<!--{* 상단 배너 끝 *}-->
				<?php } ?>
<?php } ?>
<!--{* 모바일 화면 끝 *}-->

<?php } ?>
<!-- {* !_wmode END *} -->
