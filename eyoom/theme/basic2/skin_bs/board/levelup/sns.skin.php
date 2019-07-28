<?php if (!defined('_GNUBOARD_')) exit; ?>

<?php if (G5_IS_MOBILE) && $config['cf_kakao_js_apikey'] { ?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/kakaolink.js"></script>
<script>
	// 사용할 앱의 Javascript 키를 설정해 주세요.
	Kakao.init("<?php echo $config['cf_kakao_js_apikey']; ?>");
</script>
<?php } ?>

<ul class="board-view-sns social-icons social-icons-color">
	<li><a href="<?php echo $facebook_url; ?>" target="_blank" data-original-title="Facebook" class="social_facebook"></a></li>
	<li><a href="<?php echo $twitter_url; ?>" target="_blank" data-original-title="Twitter" class="social_twitter"></a></li>
	<li><a href="<?php echo $gplus_url; ?>" target="_blank" data-original-title="Google Plus" class="social_google"></a></li>
	<?php if (G5_IS_MOBILE) && $config['cf_kakao_js_apikey'] { ?>
	<li><a href="javascript:kakaolink_send('<?php echo $sns_msg; ?>', '<?php echo $longurl; ?>');" data-original-title="Kakao" class="social_kakao"></a></li>
	<?php } ?>
	<li><a href="<?php echo $kakaostory_url; ?>" target="_blank" data-original-title="Kakao Story" class="social_kakaostory"></a></li>
	<li><a href="<?php echo $band_url; ?>" target="_blank" data-original-title="Band" class="social_band"></a></li>
</ul>