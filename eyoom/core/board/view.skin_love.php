<?php
	if (!defined('_GNUBOARD_')) exit;

	include_once(G5_LIB_PATH.'/thumbnail.lib.php');
	include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

	// 글쓴이 정보를 가져옴
	if(!$mb) $mb = get_member($view['mb_id']);
	$user = $eb->get_user_info($mb['mb_id'])+$mb;
	$lvuser = $eb->user_level_info($user);

	// 읽는사람 포인트 주기 및 이윰뉴 테이블의 히트수/댓글수 일치 시키기
	$spv_name = 'spv_board_'.$bo_table.'_'.$wr_id;
	if (!get_session($spv_name)) {
	  set_session($spv_name, TRUE);

		// 이윰뉴 테이블에 wr_hit 적용
		// $where = "wr_id = '{$wr_id}' ";
		// $parent = sql_fetch("select wr_hit, wr_comment from {$write_table} where $where");
		// sql_query("update {$g5['eyoom_new']} set wr_hit = '{$parent['wr_hit']}', wr_comment = '{$parent['wr_comment']}' where $where and bo_table='{$bo_table}'");
		// sql_query("update {$g5['eyoom_tag_write']} set wr_hit = '{$parent['wr_hit']}' where $where and bo_table='{$bo_table}' and tw_theme='{$theme}'");
	}

	// 짤은주소 체크 및 생성
	if(!($short_url = $eb->get_short_url())) {
		$short_url = $eb->make_short_url();
	}

	// 첨부파일 정보 가져오기
	if ($view['file']['count']) {
		$cnt = 0;
		for ($i=0; $i<count($view['file']); $i++) {
			if (isset($view['file'][$i]['source']) && $view['file'][$i]['source']) {
				$view_file[$cnt] = $view['file'][$i];
				$cnt++;
			}
		}
	}

	// 링크 정보 가져오기
	$i=1;
	foreach($view['link'] as $k => $v) {
		if(!$v) break;
		$view_link[$i]['link']	= cut_str($view['link'][$i], 70);
		$view_link[$i]['href']	= $view['link_href'][$i];
		$view_link[$i]['hit']	= $view['link_hit'][$i];
		$i++;
	}

	// 파일 출력
	$v_img_count = count($view['file']);
	if($v_img_count) {
		$file_conts = "<div id=\"bo_v_img\">\n";

		for ($i=0; $i<=count($view['file']); $i++) {
			if ($view['file'][$i]['view']) {
				//echo $view['file'][$i]['view'];
				$file_conts .= $eb->get_thumbnail($view['file'][$i]['view']);
				$file_conts .= "<br><br>\n";
			}
		}
		$file_conts .= "</div>\n";
	}
	// $view_content = $eb->eyoom_content($view['content']);
	$view_content = $view['content'];

	// 작성자 레벨정보 가져오기
	if($view['wr_1']) {
		$lv = $eb->level_info($view['wr_1']);
	} else {
		$lv['gnu_level'] = '';
		$lv['gnu_icon'] = '';
		$lv['eyoom_icon'] = '';
		$lv['gnu_name'] = '';
		$lv['name'] = '';
	}

	// 운영진 여부 변수에 담기
	$view['is_lb_admin'] = false;

	// 익명 여부 관계 없이 원글 아이디 변수에 담기
	$view['lb_id'] = $view['mb_id'];

	// 등업게시판용 작성자 닉네임, 이메일 변수에 담기
	$view['lb_nickname'] = $view['wr_name'];
	$view['lb_email'] = $view['wr_email'];

	// 익명글 기능
	if(!$lv['anonymous']) {
		// 작성자 프로필 사진
		$view['mb_photo'] = $eb->mb_photo($view['mb_id']);
		if ($view['mb_id'] == 'lebolution') {
			$view['is_lb_admin'] = true;
		} else if ($gr_admin_tmp) {
			$tmpArr= explode(',', $gr_admin_tmp);
			if (in_array($view['mb_id'], $tmpArr)) {
				$view['is_lb_admin'] = true;
			}
		}
	} else {
		$view['mb_photo'] = '';
		if ($member['mb_id'] == $view['mb_id']) {
			$view['is_mine'] = true; // 내가 쓴 글 여부 변수에 담기
		}
		$view['mb_id'] = 'anonymous';
		$view['wr_name'] = '익명';
	}

	if(!empty($view['wr_figure'])) {
		$view['wr_figure'] = explode(',',$view['wr_figure']);
		$view['wr_height'] = $view['wr_figure'][0];
		$view['wr_weight'] = $view['wr_figure'][1];
	}

	if(!empty($view['wr_interest'])) {
		$view['wr_interest'] = str_replace(',',', ', $view['wr_interest']);
	}

	// 글쓴이가 추가정보 받기를 켜두면, 댓글쓴이 is_moreinfo true
	if($view['wr_recv_moreinfo'] == 1) {
		$view['is_moreinfo'] = true;
	} else {
		$view['is_moreinfo'] = false;
	}

	// Window Mode 사용시
	if($wmode) {
		// 목록 출력을 강제로 막음
		$board['bo_use_list_view'] = 0;

		// 일반 버튼들 wmode 적용하기
		$add_query = '&wmode=1';
		$prev_href .= $prev_href ? $add_query:'';
		$next_href .= $next_href ? $add_query:'';
		$update_href .= $update_href ? $add_query:'';
		$delete_href .= $delete_href ? $add_query:'';
		$copy_href .= $copy_href ? $add_query:'';
		$move_href .= $move_href ? $add_query:'';
		$search_href .= $search_href ? $add_query:'';
		$reply_href .= $reply_href ? $add_query:'';
		$write_href .= $write_href ? $add_query:'';
	}

	// wr_1에 작성자의 레벨정보 입력
	if($is_member) $wr_1 = $member['mb_level']."|".$eyoomer['level'];

	include_once(G5_BBS_PATH.'/view_comment.php');

	$cmt_bs = '/skin_bs/board/'.$eyoom_board['bo_skin'].'/view_comment.skin.php';

	include_once(EYOOM_THEME_PATH.'/'.$theme.'/skin_bs/board/'.$eyoom_board['bo_skin'].'/view.skin.php');
?>
