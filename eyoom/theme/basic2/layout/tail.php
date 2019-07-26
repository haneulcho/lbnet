<?php if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 ?>
<?php if (!$wmode) { ?>
				</div>
				<?php if ( (defined('_INDEX_') && $eyoom["use_main_side_layout"] == 'y') || (!defined('_INDEX_') && $eyoom["use_sub_side_layout"] == 'y' && $subinfo["sidemenu"] != 'n') ) {
					@include_once(EYOOM_THEME_PATH.'/'.$theme.'/layout/side.php');
				} ?>
				<div class="clearfix"></div>
			</div><!--{* End row *}-->
		</div><!--{* End container *}-->
		<!--{* End Basic Body *}-->

		<!--{* Footer *}-->
		<div class="footer footer-light">
			<div class="copyright">
				<div class="container">
					<p class="text-center">Copyright &copy; <?php echo $config["cf_title"] ?>. All Rights Reserved.</p>
				</div>
			</div>
		</div>
		<!--{* End Footer *}-->
	</div><!--{* End Header Fixed *}-->
</div><!--{* End wrapper *}-->

<script type="text/javascript" src="/eyoom/theme/basic2/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/js/jquery.bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/js/jquery.sidebar.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/js/back-to-top.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/plugins/eyoom-form/plugins/jquery-form/jquery.form.min.js"></script>
<script type="text/javascript" src="/eyoom/theme/basic2/js/app.js"></script>
<!--[if lt IE 9]>
	<script src="/eyoom/theme/basic2/js/respond.js"></script>
	<script src="/eyoom/theme/basic2/js/html5shiv.js"></script>
	<script src="/eyoom/theme/basic2/plugins/eyoom-form/js/eyoom-form-ie8.js"></script>
<![endif]-->
<script type="text/javascript">
	jQuery(document).ready(function() {
		App.init();
	});
</script>
<?php } // !$wmode ?>
