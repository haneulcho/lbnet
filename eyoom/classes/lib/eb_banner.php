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
				if ($banner[$i]['bn_type'] == 'intra') {
					$img = $banner[$i]['bn_img'];
					if ($img && preg_match("/(http|https):/i", $img)) {
						$banner[$i]['image'] = $img;
					} else {
						$banner[$i]['image'] = $link_path.$theme .'/'. $img;
					}
					if ($banner[$i]['bn_link'] == '') $banner[$i]['bn_link'] = 'nolink';
					$banner[$i]['tag_img'] = '<img class="img-responsive full-width" src="'.$banner[$i]['image'].'" align="absmiddle">';
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
		$prefix = '<div class="row banner_top"><div class="col-sm-12 margin-bottom-10">';
		$sufix = '</div></div>';
		foreach ($banners as $item) {
			$bn_no = $item['bn_no'];
			if ($item['bn_type'] == 'intra') {
				if ($item['bn_link'] != '' && $item['bn_link'] != 'nolink') {
					$tocken = $eb->encrypt_md5($bn_no . "||" . $_SERVER['REMOTE_ADDR'] . "||" . $item['bn_link']);
					if ($bn_no == 7) {
						$result = $prefix.'<a id="banner_'.$bn_no.'" href="'.G5_BBS_URL.'/banner.php?tocken='.$tocken.'" target="'.$item['bn_target'].'">'.$item['tag_img'].'</a><div style="clear:both;display:block;overflow:hidden"><a style="display:block;float:left;width:50%" href="/bbs/board.php?bo_table=free2&wr_id=445427"><img src="https://i.imgur.com/ZQsjPj1.png" style="max-width:100%" alt="레볼루션 x 톰빌리의 메시지 보기"></a><a style="display:block;float:left;width:50%" href="'.G5_BBS_URL.'/banner.php?tocken='.$tocken.'" target="'.$item['bn_target'].'"><img src="https://i.imgur.com/dLMLvfL.png" style="max-width:100%" alt="지금 참여하기"></a></div>'.$sufix;
					} else {
						$result = $prefix.'<a id="banner_'.$bn_no.'" href="'.G5_BBS_URL.'/banner.php?tocken='.$tocken.'" target="'.$item['bn_target'].'">'.$item['tag_img'].'</a>'.$sufix;
					}
				} else {
					$result = $prefix.$item['tag_img'].$sufix;
				}
			} else if ($item['bn_type'] == 'extra') {
				$result = $prefix.stripslashes($item['bn_code']).$sufix;
			} else {
				$result = '';
			}
			sql_query("update {$g5['eyoom_banner']} set bn_exposed = bn_exposed + 1 where bn_no = '{$bn_no}'");

			echo $result;
		}
	}
}
