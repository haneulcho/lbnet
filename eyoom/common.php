<?php
	if (!defined('_EYOOM_')) exit;

	// Eyoom Builder
	define('_EYOOM_COMMON_',true);

	// Version
	define('_EYOOM_VESION_','EyoomBuilder_1.2.6');

	// GNUBOARD5 Library
	include_once(G5_LIB_PATH.'/common.lib.php');
	include_once(G5_LIB_PATH.'/latest.lib.php');
	include_once(G5_LIB_PATH.'/outlogin.lib.php');
	include_once(G5_LIB_PATH.'/poll.lib.php');
	include_once(G5_LIB_PATH.'/visit.lib.php');
	include_once(G5_LIB_PATH.'/connect.lib.php');
	include_once(G5_LIB_PATH.'/popular.lib.php');
	include_once(G5_LIB_PATH.'/thumbnail.lib.php');

	// Eyoom Member
	$eyoomer = array();
	if($member['mb_id']) {
		$eyoomer = $eb->get_user_info($member['mb_id']);

		// 그누레벨 자동조정
		// 180523 로그인 시, 레벨 자동 조정되지 않도록 수정
		// 2: 회원가입 시 초기 레벨
		// 3: 인증 대기 회원 (인증 게시판에 글 작성 시 3레벨로 자동 조절, 로그인 시 매회 확인처리)
		// 4: 인증 회원
		//if(!$is_admin && $member['mb_level'] <= $levelset['max_use_gnu_level']) $eb->set_gnu_level($eyoomer['level']);
	}

	// Eyoom Board 설정
	if($bo_table) {

		// $eyoom_board 설정값 가져오기
		$eyoom_board = $eb->eyoom_board_info($bo_table, $theme);
		if(!$eyoom_board) {
			// DB에 입력된 정보가 없을 때, 기본값 가져오기
			$eyoom_board = $eb->eyoom_board_default($bo_table);
		}

		// 게시물 자동 이동/복사를 위한 변수
		(array)$bo_automove = unserialize($eyoom_board['bo_automove']);

		// 익명글쓰기 체크
		$is_anonymous = $eyoom_board['bo_use_anonymous'] == 1 ? true:false;

		// 익명내글반응 체크
		$is_anonymous_respond = $eyoom_board['bo_use_anonymous_respond'] == 1 ? true:false;

		// 게시판 접근 시간 설정 사용여부 체크
		$is_timer = $eyoom_board['bo_use_timer'] == 1 ? true:false;

		// 게시판 접근 시간 설정 사용시 변수 담기
		if($is_timer) {
			$timer_start = $eyoom_board['bo_timer_start'];
			$timer_end = $eyoom_board['bo_timer_end'];
		}

		// 무한스크롤 기능을 사용하면 wmode를 활성화
		if($eyoom_board['bo_use_infinite_scroll'] == 1) {
			$user_agent = $eb->user_agent();
			if($user_agent != 'ios') {
				$_wmode = true;
				if($wmode) define('_WMODE_',true);
			} else {
				$eyoom_board['bo_use_infinite_scroll'] = 2;
			}
		}
	}

	// SNS용 이미지/제목/내용 추가 메타태그
	if(($bo_table && $wr_id) || $it_id) {
		if($bo_table && $wr_id) {
			$head_title = strip_tags(conv_subject($write['wr_subject'], 255)) . ' > ' . $board['bo_subject'] . ' | ' . $config['cf_title'];
			$first_image = get_list_thumbnail($bo_table, $wr_id, 600, 0);
			$sns_image = $first_image['src'];
			$target_url = G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id;
			$contents = cut_str(trim(str_replace(array("\r\n","\r","\n"),'',strip_tags(preg_replace("/\?/","",$write['wr_content'])))),200, '…');
		}
		// if($it_id) {
		// 	$sitem = sql_fetch("select * from {$g5['g5_shop_item_table']} where it_id = '".$it_id."'");
		// 	$head_title = strip_tags(conv_subject($sitem['it_name'], 255)) . ' | ' . $config['cf_title'];
		// 	$sns_image = G5_DATA_URL . '/item/'.$sitem['it_img1'];
		// 	$target_url = G5_SHOP_URL.'/item.php?it_id='.$it_id;
		// 	$contents = cut_str(trim(str_replace(array("\r\n","\r","\n"),'',strip_tags(preg_replace("/\?/","",$sitem['it_explan'])))),200, '…');
		// }
		$config['cf_add_meta'] .= '
			<meta property="og:id" content="'.G5_URL.'" />
			<meta property="og:url" content="'.$target_url.'" />
			<meta property="og:type" content="article" />
			<meta property="og:title" content="'.preg_replace('/"/','',$head_title).'" />
			<meta property="og:site_name" content="'.$config['cf_title'].'" />
			<meta property="og:description" content="'.$contents.'"/>
			<meta property="og:image" content="'.$sns_image.'" />
		';
	}

	// Eyoom Core Path
	$board_skin_path    = EYOOM_CORE_PATH.'/board';
	$member_skin_path   = EYOOM_CORE_PATH.'/member';
	$new_skin_path		= EYOOM_CORE_PATH.'/new';
	$search_skin_path	= EYOOM_CORE_PATH.'/search';
	$connect_skin_path	= EYOOM_CORE_PATH.'/connect';
	$faq_skin_path		= EYOOM_CORE_PATH.'/faq';
	$qa_skin_path		= EYOOM_CORE_PATH.'/qa';
	$poll_skin_path		= EYOOM_CORE_PATH.'/poll';
	$respond_skin_path	= EYOOM_CORE_PATH.'/respond';
	$mine_skin_path	= EYOOM_CORE_PATH.'/mine';
	$declare_skin_path	= EYOOM_CORE_PATH.'/declare';
	$mypage_skin_path	= EYOOM_CORE_PATH.'/mypage';
	$page_skin_path		= EYOOM_CORE_PATH.'/page';
	$tag_skin_path		= EYOOM_CORE_PATH.'/tag';

	// GNUBOARD Skin 사용여부 체크
	if($eyoom_board['use_gnu_skin'] == 'y') { // 이윰보드 설정에서 그누보드 사용여부 체크
		if(G5_IS_MOBILE) {
			$board_skin_path    = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/board/'.$board['bo_mobile_skin'];
			$board_skin_url     = G5_MOBILE_URL .'/'.G5_SKIN_DIR.'/board/'.$board['bo_mobile_skin'];
		} else {
			$board_skin_path    = G5_SKIN_PATH.'/board/'.$board['bo_skin'];
			$board_skin_url     = G5_SKIN_URL .'/board/'.$board['bo_skin'];
		}
	}
	if($eyoom['use_gnu_member'] == 'y') {
		if(G5_IS_MOBILE) {
			$member_skin_path   = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/member/'.$config['cf_mobile_member_skin'];
			$member_skin_url    = G5_MOBILE_URL .'/'.G5_SKIN_DIR.'/member/'.$config['cf_mobile_member_skin'];
		} else {
			$member_skin_path   = G5_SKIN_PATH.'/member/'.$config['cf_member_skin'];
			$member_skin_url    = G5_SKIN_URL .'/member/'.$config['cf_member_skin'];
		}
	}
	if($eyoom['use_gnu_new'] == 'y') {
		if(G5_IS_MOBILE) {
			$new_skin_path      = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/new/'.$config['cf_mobile_new_skin'];
			$new_skin_url       = G5_MOBILE_URL .'/'.G5_SKIN_DIR.'/new/'.$config['cf_mobile_new_skin'];
		} else {
			$new_skin_path      = G5_SKIN_PATH.'/new/'.$config['cf_new_skin'];
			$new_skin_url       = G5_SKIN_URL .'/new/'.$config['cf_new_skin'];
		}
	}
	if($eyoom['use_gnu_search'] == 'y') {
		if(G5_IS_MOBILE) {
			$search_skin_path   = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/search/'.$config['cf_mobile_search_skin'];
			$search_skin_url    = G5_MOBILE_URL .'/'.G5_SKIN_DIR.'/search/'.$config['cf_mobile_search_skin'];
		} else {
			$search_skin_path   = G5_SKIN_PATH.'/search/'.$config['cf_search_skin'];
			$search_skin_url    = G5_SKIN_URL .'/search/'.$config['cf_search_skin'];
		}
	}
	if($eyoom['use_gnu_connect'] == 'y') {
		if(G5_IS_MOBILE) {
			$connect_skin_path  = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/connect/'.$config['cf_mobile_connect_skin'];
			$connect_skin_url   = G5_MOBILE_URL .'/'.G5_SKIN_DIR.'/connect/'.$config['cf_mobile_connect_skin'];
		} else {
			$connect_skin_path  = G5_SKIN_PATH.'/connect/'.$config['cf_connect_skin'];
			$connect_skin_url   = G5_SKIN_URL .'/connect/'.$config['cf_connect_skin'];
		}
	}
	if($eyoom['use_gnu_faq'] == 'y') {
		if(G5_IS_MOBILE) {
			$faq_skin_path      = G5_MOBILE_PATH .'/'.G5_SKIN_DIR.'/faq/'.$config['cf_mobile_faq_skin'];
			$faq_skin_url       = G5_MOBILE_URL .'/'.G5_SKIN_DIR.'/faq/'.$config['cf_mobile_faq_skin'];
		} else {
			$faq_skin_path      = G5_SKIN_PATH.'/faq/'.$config['cf_faq_skin'];
			$faq_skin_url       = G5_SKIN_URL.'/faq/'.$config['cf_faq_skin'];
		}
	}
	if($eyoom['use_gnu_qa'] == 'y') {
		if(G5_IS_MOBILE) {
			$qa_skin_path      = G5_MOBILE_PATH .'/'.G5_SKIN_DIR.'/qa/'.$qaconfig['qa_skin'];
			$qa_skin_url       = G5_MOBILE_URL .'/'.G5_SKIN_DIR.'/qa/'.$qaconfig['qa_skin'];
		} else {
			$qa_skin_path      = G5_SKIN_PATH.'/qa/'.$qaconfig['qa_skin'];
			$qa_skin_url       = G5_SKIN_URL.'/qa/'.$qaconfig['qa_skin'];
		}
	}

	// 일정 기간이 지난 DB 데이터 삭제 및 최적화
	include_once(EYOOM_INC_PATH.'/db_table.optimize.php');

?>
