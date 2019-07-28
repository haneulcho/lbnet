<?php

/* Return Banner Data Function */

function eb_banner($loccd, $cache_time=1) {
	global $g5, $theme, $eb, $member;

	$link_path = G5_DATA_URL.'/banner/';
	
	if(!$member['mb_level']) $member['mb_level'] = 1;

	$cache_fwrite = false;
	if(G5_USE_CACHE) {
		$cache_file = G5_DATA_PATH."/cache/latest-bannerlist-main.php";

		if(!file_exists($cache_file)) {
			$cache_fwrite = true;
		} else {
			if($cache_time > 0) {
				$filetime = filemtime($cache_file);
				if($filetime && $filetime < (G5_SERVER_TIME - 3600 * $cache_time)) {
					@unlink($cache_file);
					$cache_fwrite = true;
				}
			}

			if(!$cache_fwrite)
				include($cache_file);
		}
	}

	if(!G5_USE_CACHE || $cache_fwrite) {
		// 배너위치로 등록된 배너 불러오기
		$sql = "select * from {$g5['eyoom_banner']} where bn_view_level <= '{$member['mb_level']}' and bn_theme='{$theme}' and bn_location = '" . $loccd . "' and bn_state = '1' order by bn_regdt desc";
		$result = sql_query($sql, false);
		
		$this_date = date('Ymd');
		for ($i = 0; $row = sql_fetch_array($result); $i++) {
			if ($row['bn_period'] == '2') {
				if ($this_date >= $row['bn_start'] && $this_date <= $row['bn_end']) {
					$banner[$i] = $row;
				} else continue;
			} else {
				$banner[$i] = $row;
			}
			if (is_array($banner[$i]) && !empty($banner[$i])) {
				if($banner[$i]['bn_type'] == 'intra') {
					$img = $banner[$i]['bn_img'];
					$banner[$i]['image'] = $link_path.$theme .'/'. $img;
	
					if($banner[$i]['bn_link'] == '') $banner[$i]['bn_link'] = 'nolink';
	
					$banner[$i]['tag_img'] = '<img class="img-responsive full-width" src="'.$banner[$i]['image'].'" align="absmiddle">';
	
					if ( $banner[$i]['bn_link'] != '' && $banner[$i]['bn_link'] != 'nolink' ){
						$tocken = $eb->encrypt_md5($bn_no . "||" . $_SERVER['REMOTE_ADDR'] . "||" . $banner[$i]['bn_link']);
						$banner[$i]['html'] = '<a id="banner_' . $banner[$i]['bn_no'] . '" href="' . G5_BBS_URL . '/banner.php?tocken=' . $tocken . '" target="' . $banner[$i]['bn_target'] . '">';
						$banner[$i]['html'] .= $banner[$i]['tag_img'];
						$banner[$i]['html'] .= '</a>';
					} else {
						$banner[$i]['html'] = $banner[$i]['tag_img'];
					}
				} else if($banner[$i]['bn_type'] == 'extra') {
					$banner[$i]['html'] = stripslashes($banner[$i]['bn_code']);
				}
			}
		}

		if ($cache_fwrite) {
			$handle = fopen($cache_file, 'w');
			$cache_content = "<?php\nif (!defined('_GNUBOARD_')) exit;\n\$banners=".var_export($banner, true)."?>";
			fwrite($handle, $cache_content);
			fclose($handle);
		}

		if (!$banners || empty($banners)) { $banners = $banner; }
	}

	if (is_array($banners) && !empty($banners)) {
		foreach ($banners as $item) {
			$bn_no = $item['bn_no'];
			echo '<div class="row banner_top"><div class="col-sm-12 margin-bottom-10">'.$item['html'].'</div></div>';
			sql_query("update {$g5['eyoom_banner']} set bn_exposed = bn_exposed + 1 where bn_no = '{$bn_no}'");
		}
	}
}
