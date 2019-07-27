<?php
	function eb_paging($skin_dir="") {
		global $paging, $page, $total_page, $g5, $theme, $prev_part_href, $next_part_href;

		if(!$skin_dir) $skin_dir = "basic";
		$cur_page	= $page;
		$pg_pages	= $paging['pages'];
		$pg_url		= $paging['url'];

		$pg_url		= preg_replace('#&amp;page=[0-9]*#', '', $pg_url).'&amp;page=';
		$start_page = (((int)(($cur_page-1)/$pg_pages))*$pg_pages)+1;
		$end_page	= $start_page+$pg_pages-1;

		if ($end_page >= $total_page) $end_page = $total_page;

		$str = array();
		if ($total_page > 1) {
			for ($k=$start_page;$k<=$end_page;$k++) {
				$str[$k]['url'] = $pg_url.$k.$add;
				if ($cur_page != $k)
					$str[$k]['on'] = false;
				else
					$str[$k]['on'] = true;
			}
		}

		$paging_skin_path = EYOOM_THEME_PATH.'/'.$theme.'/skin_bs/paging/'.$skin_dir;

		ob_start();
		include_once($paging_skin_path.'/paging.skin.php');
		$content = ob_get_contents();
		ob_end_clean();
	
		return $content;
	}
?>