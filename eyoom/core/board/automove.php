<?php
	if (!defined('_GNUBOARD_')) exit;

	// 기존 view.head.skin에 위치하던 게시물 자동 이동 기능 추천 버튼 클릭 시로 로직 변경
	// 자동 이동/복사 기능을 사용하고 조건값들이 있을 때 
	// 이동/복사 실행여부
	$is_exec = false;

	// 이동/복사 조건
	switch ($bo_automove['type']) {
		case 'hit': if($write['wr_hit'] >= $bo_automove['count']) $is_exec = true; $auto_type = '조회수'; break;
		case 'good': if($write['wr_good'] >= $bo_automove['count']) $is_exec = true; $auto_type = '추천수'; break;
		case 'nogood': if($write['wr_nogood'] >= $bo_automove['count']) $is_exec = true; $auto_type = '비추천수'; break;
	}

	$sw = $bo_automove['action'];
	switch($sw) {
		case 'copy': $act = '복사'; break;
		case 'move': $act = '이동'; break;
	}

	$tg_table = $bo_automove['target'];
	
	// 관리자가 작성한 공지글은 제외하기
	$arr_notice = explode(',', trim($board['bo_notice']));
	// 이동/복사 실행
	if ($is_exec && !in_array($wr_id, $arr_notice)) {
		$move_table = $g5['write_prefix'].$bo_automove['target'];
		$move_sql = " select count(*) as cnt from $move_table where mb_id = '{$write['mb_id']}' and wr_name = '{$write['wr_name']}' and wr_datetime = '{$write['wr_datetime']}' ";
		$move_row = sql_fetch($move_sql);
		if ($move_row['cnt'] == 0) {
			define("G5_AUTOMOVE", true);
			$_POST['chk_bo_table'] = array($tg_table);
			$wr_id_list = $wr_id;

			@include_once(EYOOM_CORE_PATH . "/board/move_update.php");
		} else {
			$msg = '이미 [인기글]로 '.$act.'된 게시물입니다!';
			$move_href = './board.php?bo_table='.$tg_table;
		}
	}
?>