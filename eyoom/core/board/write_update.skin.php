<?php
	if (!defined('_GNUBOARD_')) exit;

	// 답변글에 대한 내글반응 적용하기
	if ($w == 'r') {
		$respond = array();
		$respond['type']		= 'reply';
		$respond['bo_table']	= $bo_table;
		$respond['pr_id']		= $_POST['wr_id'];
		$respond['wr_id']		= $wr_id;
		$respond['wr_subject']	= $wr_subject;
		$respond['wr_mb_id']	= $wr['mb_id'];
		if($_POST['anonymous'] == 'y') $anonymous = true;
		$eb->respond($respond);
	}

	// 업로드된 파일 정보 가져오기
	$result = sql_query(" select * from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ");
	for($i=0; $row=sql_fetch_array($result);$i++) {
		if(!preg_match("/.(gif|jpg|jpeg|png)$/i",$row['bf_file'])) continue;
		$wr_image['bf'][$i] = "/data/file/{$bo_table}/".$row['bf_file'];
	}

	// 내용중의 링크 이미지 정보 가져오기
	$matches = get_editor_image(stripslashes($wr_content),false);
	if($matches[1]) {
		foreach($matches[1] as $k => $image) {
			$p = parse_url($image);
			$host = preg_replace("/www\./i","",$p['host']);
			$_host = preg_replace("/www\./i","",$_SERVER['HTTP_HOST']);

			$ex_url = '';
			if($host != $_host) $ex_url = "http://".$host;
			$wr_image['url'][$k] = $ex_url . $p['path'];
		}
	}
	if($wr_image) $wr_image = serialize($wr_image);

	// 여유필드 wr_4 활용
	$wr_4 = unserialize($eb->decrypt_md5($wr_4));
	$wr_4 = serialize($wr_4);
	
	// 리턴 이미지가 있다면 $write_table update 
	$up_set['wr_4'] = $wr_4;

	// 내용글에서 텍스트 추출
	$content = addslashes($eb->eyoom_text_abstract($wr_content, 300));

	$where = "bo_table = '{$bo_table}' and wr_id = '{$wr_id}'";
	
	// 공통 $set
	$common_set['bo_table'] 	= $bo_table;
	$common_set['wr_id'] 		= $wr_id;
	$common_set['wr_subject'] 	= $wr_subject;
	$common_set['wr_content'] 	= $content;
	$common_set['wr_option'] 	= "{$html},{$secret},{$mail}";
	$common_set['wr_image'] 	= $wr_image;
	$common_set['wr_1'] 		= $wr_1;
	$common_set['wr_2'] 		= $wr_2;
	$common_set['wr_3'] 		= $wr_3;
	$common_set['wr_4'] 		= $wr_4;
	$common_set['wr_5'] 		= $wr_5;
	$common_set['wr_6'] 		= $wr_6;
	$common_set['wr_7'] 		= $wr_7;
	$common_set['wr_8'] 		= $wr_8;
	$common_set['wr_9'] 		= $wr_9;
	$common_set['wr_10'] 		= $wr_10;
	
	$cmset = $eb->make_sql_set($common_set);
	unset($common_set);

	// 이윰 New insert set
	$mb_nick = $member['mb_id'] ? $member['mb_nick']: $wr_name;
	
	$insert_set['pr_id'] 		= $respond['pr_id'];
	$insert_set['wr_parent'] 	= $wr_id;
	$insert_set['ca_name'] 		= $ca_name;
	$insert_set['mb_id']		= $member['mb_id'];
	$insert_set['mb_name']		= $wr_name;
	$insert_set['mb_nick']		= $mb_nick;
	$insert_set['mb_level']		= $member['mb_level'];
	$insert_set['wr_video']		= $wr_video;
	$insert_set['wr_sound']		= $wr_sound;
	$insert_set['wr_comment']	= 0;
	$insert_set['wr_hit']		= 0;
	$insert_set['bn_datetime']	= G5_TIME_YMDHIS;
	
	$inset = $eb->make_sql_set($insert_set);
	
	$insert_new = "insert into {$g5['eyoom_new']} set {$cmset},{$inset}";
	unset($insert_set, $inset);
	
	// 이윰 New update set
	$update_set['pr_id']		= $respond['pr_id'];
	$update_set['wr_parent'] 	= $wr_id;
	$update_set['ca_name'] 		= $ca_name;
	
	$upset = $eb->make_sql_set($update_set);;
	
	$update_new = "update {$g5['eyoom_new']} set {$cmset},{$upset} where {$where}";
	unset($update_set, $upset);

	// Eyoom 새글
	if ($w == '' || $w == 'r') {
		$new_query = $insert_new;
		
		// 나의활동 
		switch($w) {
			default  : $act_type = 'new'; $eb->level_point($levelset['write']); break;
			case 'r' : $act_type = 'reply'; $eb->level_point($levelset['reply']); break;
		}
		// $act_contents = array();
		// $act_contents['bo_table'] = $bo_table;
		// $act_contents['bo_name'] = $board['bo_subject'];
		// $act_contents['wr_id'] = $wr_id;
		// $act_contents['subject'] = $wr_subject;
		// $act_contents['content'] = $content;
		// $eb->insert_activity($member['mb_id'],$act_type,$act_contents);

	} else if($w == 'u') {
		// 새글 정보가 이미 있다면 업데이트
		$new_post = sql_fetch("select * from {$g5['eyoom_new']} where $where");
		$new_query = $new_post['bn_id'] ? $update_new : $insert_new;
	}
	// if(isset($new_query)) sql_query($new_query, false);
	unset($cmset, $new_query, $insert_new, $update_new);
	
	// $up_set 대상이 있다면 
	// if(count($up_set) > 0 && is_array($up_set) ) {
	// 	$j=0;
	// 	foreach($up_set as $key => $val) {
	// 		$set[$j] = " {$key} = '{$val}' ";
	// 		$j++;
	// 	}
	// 	sql_query("update $write_table set " . implode(',', $set) ." where wr_id='{$wr_id}'");
	// }

	// 무한스크롤 리스트에서 뷰창을 띄웠을 경우
	$qstr .= $wmode ? $qstr.'&wmode=1':'';

?>