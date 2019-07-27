<?php if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/bootstrap/css/bootstrap.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/plugins/font-awesome/css/font-awesome.min.css" type="text/css" media="screen">',0);
add_stylesheet('<link rel="stylesheet" href="/eyoom/theme/basic2/css/style.min.css" type="text/css" media="screen">',0);
?>

<div class="member-profile">
	<h5 class="margin-bottom-20"><strong><?php echo $mb['mb_nick'] ?> 님의 프로필</strong></h5>
	<div class="tab-e1">
		<ul class="nav nav-tabs">
			<li class="active"><a>프로필</a></li>
		</ul>
		<div class="tab-content">
			<!--{* 자기소개 시작 *}-->
			<div class="margin-bottom-10"></div>
			<section class="member-profile-photo">
				<?php echo $mb_photo ?>
			</section>
			<section>
				<div class="table-list-eb">
					<table class="table table-hover">
						<tbody>
							<tr>
								<th>회원권한:</th>
								<td><?php echo $mb['mb_level'] ?></td>
							</tr>
							<tr>
								<th>포인트:</th>
								<td><?php echo number_format($mb['mb_point']) ?></td>
							</tr>
							<?php if ($mb_homepage) { ?>
							<tr>
								<th>홈페이지:</th>
								<td><a href="<?php echo $mb_homepage ?>" target="_blank"><?php echo $mb_homepage ?></a></td>
							</tr>
							<?php } ?>
							<tr>
								<th>회원가입일:</th>
								<td><?php echo ($member['mb_level'] >= $mb['mb_level']) ? substr($mb['mb_datetime'], 0, 10) ." (".number_format($mb_reg_after)." 일)" : "알 수 없음"; ?></td>
							</tr>
							<tr>
								<th>최종접속일:</th>
								<td><?php echo ($member['mb_level'] >= $mb['mb_level']) ? $mb['mb_today_login'] : "알 수 없음"; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</section>
			<div class="clearfix"></div>
			<h6><strong>인사말</strong></h6>
			<div class="member-profile-box">
				<?php echo $mb_profile ?>
			</div>
			<!--{* 자기소개 끝 *}-->
			<div class="text-center margin-top-20">
				<button type="button" onclick="window.close();" class="btn-e btn-e-dark">창닫기</button>
			</div>
		</div>
	</div>

</div>
<style>
.member-profile {padding:15px}
.member-profile .tab-e1 .tab-content img {margin-top:0;margin-bottom:15}
.member-profile .member-profile-box {border:1px solid #e5e5e5;margin-bottom:30px;padding:10px}
.member-profile .member-profile-photo img {width:70px;height:70px}
</style>

<?php
// tail_sub 템플릿 출력
@include_once(EYOOM_THEME_PATH.'/'.$theme.'/layout/tail_sub.php');
?>