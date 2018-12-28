<?php
	if (!defined('_GNUBOARD_')) exit;

	// 선택삭제으로 인해 셀합치기가 가변적으로 변함
	$colspan = 4;

	if ($is_admin) $colspan++;

	// 그룹정보 가져오기
	$sel_group = $eb->get_group();

	$newlist = $list;
	unset($list);
	for ($i=0; $i<count($newlist); $i++)
	{
		// 익명글 제외
		// $level = $newlist[$i]['wr_1'] ? $eb->level_info($newlist[$i]['wr_1']):'';
		// if(is_array($level) && $level['anonymous']) continue;

		$num = $total_count - ($page - 1) * $config['cf_page_rows'] - $i;
		$bo_subject = cut_str($newlist[$i]['bo_subject'], 20);
		$wr_subject = get_text(cut_str($newlist[$i]['wr_subject'], 80));
    	$wr_content = get_text(cut_str($newlist[$i]['wr_content'], 120));

		unset($data);

		$data['num'] = $num;
		$data['bo_subject'] = $bo_subject;
		$data['wr_subject'] = $wr_subject;
		$data['wr_content'] = $wr_content;
		$data['wr_comment'] = $newlist[$i]['wr_comment'];
		$data['wr_good'] 	= $newlist[$i]['wr_good'];
		$data['bo_table']	= $newlist[$i]['bo_table'];
		$data['wr_id']		= $newlist[$i]['wr_id'];
		// $data['gr_id']		= $newlist[$i]['gr_id'];
		$data['comment']	= $newlist[$i]['comment'];
		$data['name']		= $newlist[$i]['name'];
		$data['href']		= $newlist[$i]['href'];
		$data['datetime']	= $newlist[$i]['datetime'];
		$data['datetime_mobile']	= $newlist[$i]['datetime_mobile'];

		$list[$i] = $data;
	}

	// Paging
	$paging = $thema->pg_pages($tpl_name,"?type=$view&amp;page=");

	// 사용자 프로그램
	@include_once(EYOOM_USER_PATH.'/mine/mine.skin.php');

	// Template define
	$tpl->define_template('mine',$eyoom['mine_skin'],'mine.skin.html');

	@include EYOOM_INC_PATH.'/tpl.assign.php';
	$tpl->print_($tpl_name);

?>
