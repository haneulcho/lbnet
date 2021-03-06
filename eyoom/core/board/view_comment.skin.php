<?php
	if (!defined('_GNUBOARD_')) exit;

	// TODO: 그누보드 튜닝 19.01.03

	if($eyoom_board['bo_use_yellow_card'] == '1') {
		// 바로 블라인드 처리할 수 있는 권한인지 체크
		if($is_admin || $member['mb_level'] >= $eyoom_board['bo_blind_direct'] ) {
			$blind_direct = true;
		}
	}

	// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	// if($eyoom_board['bo_use_addon_map'] == '1') {
	// 	add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
	// }

	unset($comment);
	$cmt_amt = count($list);
	for ($i=0; $i<$cmt_amt; $i++) {
		$comment[$i]['comment_id'] = $list[$i]['wr_id'];
		$comment[$i]['cmt_depth'] = "";
		$comment[$i]['cmt_depth'] = strlen($list[$i]['wr_comment_reply']) * 15;
		$content = $list[$i]['content'];
		// $comment[$i]['comment'] = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $content);
		// $comment[$i]['comment'] = $eb->eyoom_content($comment[$i]['comment']);
		$comment[$i]['comment'] = $content;
		$comment[$i]['cmt_sv'] = $cmt_amt - $i + 1; // 댓글 헤더 z-index 재설정 ie8 이하 사이드뷰 겹침 문제 해결
		$comment[$i]['wr_name'] = get_text($list[$i]['wr_name']);
		$comment[$i]['wr_email'] = $list[$i]['wr_email'];
		$comment[$i]['wr_homepage'] = $list[$i]['wr_homepage'];
		$comment[$i]['name'] = $list[$i]['name'];
		$comment[$i]['mb_id'] = $list[$i]['mb_id'];
		$comment[$i]['ip'] = $list[$i]['ip'];
		$comment[$i]['datetime'] = $list[$i]['wr_datetime'];
		$comment[$i]['wr_option'] = $list[$i]['wr_option'];
		$comment[$i]['content1'] = get_text($list[$i]['content1'], 0);

		// 댓글포인트
		// $point = $list[$i]['wr_link1'] ? @unserialize($list[$i]['wr_link1']):'';
		// if(is_array($point)) {
		// 	$comment[$i]['firstcmt_point'] = $point['firstcmt'] ? $point['firstcmt']:0;
		// 	$comment[$i]['bomb_point'] = is_array($point['bomb']) ? array_sum($point['bomb']):0;
		// 	$comment[$i]['lucky_point'] = $point['lucky'] ? $point['lucky']:0;
		// }

		// wr_link2를 활용하여 댓글에 이미지표현
		if (!empty($list[$i]['wr_link2'])) {
			$cmt_file = unserialize($list[$i]['wr_link2']);
			if(is_array($cmt_file)) {
				foreach($cmt_file as $k => $_file) {
					if(preg_match('/(gif|jpg|jpeg|png)/',strtolower($_file['source']))) {
						$comment[$i]['imgsrc'] = G5_DATA_URL . '/file/'.$bo_table.'/'.$_file['file'];
						$comment[$i]['imgname'] = $_file['file'];
					}
					break;
				}
			}
		}

		$level = $list[$i]['wr_1'] ? $eb->level_info($list[$i]['wr_1']):'';
		if(is_array($level)) {
			$comment[$i]['is_lb_admin'] = false; // 운영진 여부 변수에 담기
			if ($member['mb_id'] == $view['lb_id'] ) {
				$comment[$i]['is_myarticle'] = true; // 내가 쓴 글 여부 변수에 담기
			}
			if ($member['mb_id'] == $comment[$i]['mb_id']) {
				$comment[$i]['is_mine'] = true; // 내가 쓴 댓글 여부 변수에 담기
			}
			if ($view['lb_id'] == $comment[$i]['mb_id']) {
				$comment[$i]['is_origin'] = true; // 글쓴이와 댓글쓴이 일치 여부 변수에 담기
			}
			$comment[$i]['lb_id'] = $comment[$i]['mb_id']; // 익명 여부 관계 없이 댓글 아이디 변수에 담기
			$comment[$i]['lb_nickname'] = $comment[$i]['wr_name']; // 익명 여부 관계 없이 댓글 닉네임 변수에 담기
			if(!$level['anonymous']) {
				if ($comment[$i]['mb_id'] == 'lebolution') {
					$comment[$i]['is_lb_admin'] = true;
				} else if ($gr_admin_tmp) {
					$tmpArr= explode(',', $gr_admin_tmp);
					if (in_array($comment[$i]['mb_id'], $tmpArr)) {
						$comment[$i]['is_lb_admin'] = true;
					}
				}
				$comment[$i]['mb_photo'] = $eb->mb_photo($list[$i]['mb_id']);
				$comment[$i]['gnu_level'] = $level['gnu_level'];
				$comment[$i]['eyoom_level'] = $level['eyoom_level'];
				$comment[$i]['lv_gnu_name'] = $level['gnu_name'];
				$comment[$i]['lv_name'] = $level['name'];
				$comment[$i]['gnu_icon'] = $level['gnu_icon'];
				$comment[$i]['eyoom_icon'] = $level['eyoom_icon'];
			} else {
				list($gnu_level,$eyoom_level,$anonymous) = explode('|',$list[$i]['wr_1']);
				$comment[$i]['anonymous_id'] = $anonymous ? $gnu_level."|".$eyoom_level:'';
				$comment[$i]['mb_id'] = 'anonymous';
				$comment[$i]['wr_name'] = '익명';
				$comment[$i]['email'] = '';
				$comment[$i]['homepage'] = '';
				$comment[$i]['gnu_level'] = '';
				$comment[$i]['eyoom_level'] = '';
				$comment[$i]['lv_gnu_name'] = '';
				$comment[$i]['lv_name'] = '';
				$comment[$i]['gnu_icon'] = '';
				$comment[$i]['eyoom_icon'] = '';
			}
		}

		if($list[$i]['is_reply'] || $list[$i]['is_edit'] || $list[$i]['is_del']) {
			$comment[$i]['is_reply'] = $list[$i]['is_reply'];
			$comment[$i]['is_edit'] = $list[$i]['is_edit'];
			$comment[$i]['is_del'] = $list[$i]['is_del'];
			$comment[$i]['del_link'] = $wmode ? $list[$i]['del_link'].'&wmode=1':$list[$i]['del_link'];
			$query_string = str_replace("&", "&amp;", $_SERVER['QUERY_STRING']);

			if($w == 'cu') {
				$sql = " select wr_id, wr_content, mb_id from $write_table where wr_id = '$c_id' and wr_is_comment = '1' ";
				$cmt = sql_fetch($sql);
				if (!($is_admin || ($member['mb_id'] == $cmt['mb_id'] && $cmt['mb_id']))) {
					$cmt['wr_content'] = '';
				}
				$comment[$i]['c_wr_content'] = $cmt['wr_content'];
			}
			$comment[$i]['c_reply_href'] = './board.php?'.$query_string.'&amp;c_id='.$comment[$i]['comment_id'].'&amp;w=c#bo_vc_w';
			$comment[$i]['c_edit_href'] = './board.php?'.$query_string.'&amp;c_id='.$comment[$i]['comment_id'].'&amp;w=cu#bo_vc_w';
		}
		// 댓글 추천/비추천 링크
		if($board['bo_use_good'] || $board['bo_use_nogood']) {
			$comment[$i]['good'] = $list[$i]['wr_good'];
			$comment[$i]['nogood'] = $list[$i]['wr_nogood'];
			$comment[$i]['c_good_href'] = $board['bo_use_good'] ? './goodcmt.php?'.$query_string.'&amp;c_id='.$comment[$i]['comment_id'].'&amp;good=good':'';
			$comment[$i]['c_nogood_href'] = $board['bo_use_nogood'] ? './goodcmt.php?'.$query_string.'&amp;c_id='.$comment[$i]['comment_id'].'&amp;good=nogood':'';
		}

		// 블라인드 처리
		if($eyoom_board['bo_use_yellow_card'] == '1') {
			$cmt_ycard = unserialize($list[$i]['wr_4']);
			if(!$cmt_ycard) $cmt_ycard = array();
			$comment[$i]['yc_count'] = $cmt_ycard['yc_count'];
			// 한 번이라도 신고된 댓글이거나 블라인드 처리된 댓글이면, 댓글 수정 및 댓글 삭제가 불가능하게
			if (!$is_admin && ($cmt_ycard['yc_count'] > 0 || $cmt_ycard['yc_blind'] == 'y')) {
				$comment[$i]['is_edit'] = '';
				$comment[$i]['is_del'] = '';

				// 한 번이라도 신고된 댓글이 존재하면 원글 is_declared 변수값 true로 변경
				$view['is_declared'] = true;
			}
			if($cmt_ycard['yc_blind'] == 'y') {
				if(!$is_admin && $member['mb_level'] < $eyoom_board['bo_blind_view']) {
					// $comment[$i]['mb_ycard'] = $eb->mb_yellow_card($member['mb_id'],$bo_table, $comment[$i]['comment_id']);
					// if(!$comment[$i]['mb_ycard']) {
						$comment[$i]['yc_cannotsee'] = true;
					// }
				}
				$comment[$i]['yc_blind'] = true;
			}

			// 바로 블라인드 처리할 수 있는 권한인지 체크
			if($is_admin || $member['mb_level'] >= $eyoom_board['bo_blind_direct'] ) {
				$blind_direct = true;
			}
		}

		// 베스트 댓글용 raw data
		if($eyoom_board['bo_use_cmt_best'] == '1' && $comment[$i]['good']) {
			if($comment[$i]['good'] >= $eyoom_board['bo_cmt_best_min']) {
				$good_comment[$i] = $comment[$i]['good'];
				$best_comment[$i] = $comment[$i];
			}
		}
	}

	// paging 처리 및 댓글 무한스크롤 기능 구현
	// if ($eyoom_board['bo_use_cmt_infinite'] == '1' && is_array($comment) ) {
	// 	$cpage = (int)$_GET['cpage'];
	// 	if(!$cpage) $cpage = 1;
	// 	if(!$page_rows) $page_rows = $board['bo_page_rows'] ? $board['bo_page_rows'] : 15;
	// 	$from_record = ($cpage - 1) * $page_rows; // 시작 열을 구함
	// 	$comment = array_slice($comment,$from_record,$page_rows);
	// }

	// Best 댓글
	if(isset($good_comment) && is_array($good_comment)) {
		if(!isset($cpage) || (isset($cpage) && $cpage == 1) ) {
			arsort($good_comment);

			$i=0;
			foreach($good_comment as $key => $good) {
				// 베스트 댓글 추출 갯수 제한
				if( $eyoom_board['bo_cmt_best_limit'] <= $i) break;
				else {
					$best_comment[$key]['is_cmt_best'] = true;
					$best_cmt[$i] = $best_comment[$key];
				}
				$i++;
			}

			if(isset($best_cmt) && is_array($best_cmt)) {
				krsort($best_cmt);
				foreach($best_cmt as $key => $bestcmt) {
					array_unshift($comment, $bestcmt);
				}
			}
		}
	}

	// 댓글에 이미지 첨부파일 용량 제한
	$upload_max_filesize = ini_get('upload_max_filesize') . ' 바이트';

	// if($board['bo_use_sns']) {
	// 	ob_start();
	// 	include_once (G5_SNS_PATH."/view_comment_list.sns.skin.php");
	// 	$comment_sns = ob_get_contents();
	// 	ob_end_clean();
	// }

?>
