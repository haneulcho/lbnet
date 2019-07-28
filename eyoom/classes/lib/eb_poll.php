<?php

function eb_poll($skin_dir='basic', $po_id=false) {
	global $config, $member, $g5, $theme, $is_admin;

	$cache_time = 48;
	$poll_skin_path = EYOOM_THEME_PATH.'/'.$theme.'/skin_bs/poll/'.$skin_dir;
	
	$cache_fwrite = false;
	if(G5_USE_CACHE) {
		$cache_file = G5_DATA_PATH."/cache/latest-polllist-main.php";

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
		// 투표번호가 넘어오지 않았다면 가장 큰(최근에 등록한) 투표번호를 얻는다
		if (!$po_id) {
			$row = sql_fetch(" select MAX(po_id) as max_po_id from {$g5['poll_table']} ");
			$po_id = $row['max_po_id'];
		}

		if (!$po_id) {
			return;
		} else {
			$po = sql_fetch(" select * from {$g5['poll_table']} where po_id = '$po_id' ");
			$po_subject = $po['po_subject'];
	
			for ($i = 1; $i <= 9 && $po["po_poll{$i}"]; $i++) {
				$poll[$i]['po_poll'] = $po["po_poll{$i}"];
			}
	
			if($cache_fwrite) {
				$handle = fopen($cache_file, 'w');
				$cache_content = "<?php\nif (!defined('_GNUBOARD_')) exit;\n\$po_subject='".$po_subject."';\n\$poll=".var_export($poll, true)."?>";
				fwrite($handle, $cache_content);
				fclose($handle);
			}
		}

	}

	ob_start();
	include_once ($poll_skin_path.'/poll.skin.php');
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}
?>