<?php
	if (!defined('_GNUBOARD_')) exit;

	// 추천 비추천 내글반응 적용하기
	if ($count || $href) {
		$respond = array();
		$respond['type']		= $good.'cmt';
		$respond['bo_table']	= $bo_table;
		$respond['wr_id']		= $wr_id;
		$respond['wr_cmt']		= $c_id;
		$respond['wr_subject']	= cut_str(strip_tags($cmt['wr_content']), 20, '…');
		$respond['wr_mb_id']	= $cmt['mb_id'];

		// 댓글 비공감, 비추천 시 내글반응 및 푸시 등록하지 않음
		if ($good != 'nogood') {
			$eb->respond($respond);
		}
	}

	// 나의 활동에는 적용하지 않기로 함. - DB 부하가 많아질 수 있기 때문
?>