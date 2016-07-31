<?php
	if (!defined('_GNUBOARD_')) exit;

	if($eyoom_board['bo_use_yellow_card'] == '1') {
		// 바로 블라인드 처리할 수 있는 권한인지 체크
		if($is_admin || $member['mb_level'] >= $eyoom_board['bo_blind_direct'] ) {
			$blind_direct = true;
		}
	}

	unset($comment);
	$cmt_amt = count($list);
	for ($i=0; $i<$cmt_amt; $i++) {
		$comment[$i]['comment_id'] = $list[$i]['wr_id'];
		$comment[$i]['cmt_depth'] = "";
		$comment[$i]['cmt_depth'] = strlen($list[$i]['wr_comment_reply']) * 15;
		$content = $list[$i]['content'];
		$comment[$i]['comment'] = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $content);
		$comment[$i]['comment'] = $eb->eyoom_content($comment[$i]['comment']);
		$comment[$i]['cmt_sv'] = $cmt_amt - $i + 1; // 댓글 헤더 z-index 재설정 ie8 이하 사이드뷰 겹침 문제 해결
		$comment[$i]['wr_name'] = get_text($list[$i]['wr_name']);
		$comment[$i]['name'] = $list[$i]['name'];
		$comment[$i]['mb_id'] = $list[$i]['mb_id'];
		$comment[$i]['ip'] = $list[$i]['ip'];
		$comment[$i]['datetime'] = $list[$i]['wr_datetime'];
		$comment[$i]['wr_option'] = $list[$i]['wr_option'];
		$comment[$i]['content1'] = get_text($list[$i]['content1'], 0);

		$comment[$i]['wr_area'] = $list[$i]['wr_area'];
		$comment[$i]['wr_type'] = $list[$i]['wr_type'];
		$comment[$i]['wr_age'] = $list[$i]['wr_age'];
		$comment[$i]['wr_send_moreinfo'] = $list[$i]['wr_send_moreinfo'];
		$comment[$i]['wr_recv_moreinfo'] = $list[$i]['wr_recv_moreinfo'];

		if(strpos($comment[$i]['comment'], '비밀글 입니다.') !== false) {
			$comment[$i]['wr_is_secret'] = true;
		} else {
			$comment[$i]['wr_is_secret'] = false;
		}

		if(!empty($list[$i]['wr_etc'])) {
			$comment[$i]['wr_etc'] = $list[$i]['wr_etc'];
		}
		if(!empty($list[$i]['wr_job'])) {
			$comment[$i]['wr_job'] = $list[$i]['wr_job'];
		}
		if(!empty($list[$i]['wr_figure'])) {
			$wr_figure = explode(',', $list[$i]['wr_figure']);
			$comment[$i]['wr_figure1'] = $wr_figure[0];
			$comment[$i]['wr_figure2'] = $wr_figure[1];
		}
		if(!empty($list[$i]['wr_interest'])) {
			$comment[$i]['wr_interest'] = str_replace(',',', ', $list[$i]['wr_interest']);
		}

		// wr_link2를 활용하여 댓글에 이미지표현
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

		$level = $list[$i]['wr_1'] ? $eb->level_info($list[$i]['wr_1']):'';
		if(is_array($level)) {
			if ($member['mb_id'] == $comment[$i]['mb_id']) {
				$comment[$i]['is_mine'] = true; // 내가 쓴 댓글 여부 변수에 담기
			}
			if ($view['lb_id'] == $comment[$i]['mb_id']) {
				$comment[$i]['is_origin'] = true; // 글쓴이와 댓글쓴이 일치 여부 변수에 담기
			}
			$comment[$i]['lb_id'] = $comment[$i]['mb_id']; // 댓글쓴이 닉네임 저장하기
			if(!$level['anonymous']) {
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
				$sql = " select wr_id, wr_content from $write_table where wr_id = '$c_id' and wr_is_comment = '1' ";
				$cmt = sql_fetch($sql);
				$comment[$i]['c_wr_content'] = $cmt['wr_content'];
			}
			$comment[$i]['c_reply_href'] = './board.php?'.$query_string.'&amp;c_id='.$comment[$i]['comment_id'].'&amp;w=c#bo_vc_w';
			$comment[$i]['c_edit_href'] = './board.php?'.$query_string.'&amp;c_id='.$comment[$i]['comment_id'].'&amp;w=cu#bo_vc_w';
		}

	}

	// paging 처리 및 댓글 무한스크롤 기능 구현
	if ($eyoom_board['bo_use_cmt_infinite'] == '1' && is_array($comment) ) {
		$cpage = (int)$_GET['cpage'];
		if(!$cpage) $cpage = 1;
		if(!$page_rows) $page_rows = $board['bo_page_rows'] ? $board['bo_page_rows'] : 15;
		$from_record = ($cpage - 1) * $page_rows; // 시작 열을 구함
		$comment = array_slice($comment,$from_record,$page_rows);
	}

	// 댓글에 이미지 첨부파일 용량 제한
	$upload_max_filesize = ini_get('upload_max_filesize') . ' 바이트';

	// 사용자 프로그램
	@include_once(EYOOM_USER_PATH.'/board/view_comment.skin.php');

	// Template assign
	@include EYOOM_INC_PATH.'/tpl.assign.php';
?>
