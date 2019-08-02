<?php
$sub_menu = "800500";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$sql_common = "  bn_type = '{$_POST['bn_type']}',
				 bn_location = '{$_POST['bn_location']}',
				 bn_link = '{$_POST['bn_link']}',
				 bn_target = '{$_POST['bn_target']}',
				 bn_theme = '{$_POST['theme']}',
				 bn_period = '{$_POST['bn_period']}',
				 bn_state = '{$_POST['bn_state']}',
				 bn_start = '{$_POST['bn_start']}',
				 bn_end = '{$_POST['bn_end']}',
				 bn_code = '".addslashes($_POST['bn_code'])."',
				 bn_view_level = '{$_POST['bn_view_level']}',
";

// 배너 이미지 업로드
// 외부 이미지 경로가 있을 경우 자체 업로드보다 높은 우선순위 적용
if ($_POST['bn_img_external']) {
	if (!preg_match("/\.(jpg|gif|png)$/i", $_POST['bn_img_external'])) {
		alert($_POST['bn_img_external'] . '은(는) jpg/gif/png 파일이 아닙니다.');
	} else if (!preg_match("/(http|https):/i", $_POST['bn_img_external'])) {
		alert($_POST['bn_img_external'] . '는 올바른 이미지 경로가 아닙니다.');
	} else {
		$file_name = $_POST['bn_img_external'];
		$sql_common .= "bn_img = '". $file_name ."',";
	}
} else {
	if (is_uploaded_file($_FILES['bn_img']['tmp_name'])) {
		$ext = $qfile->get_file_ext($_FILES['bn_img']['name']);
		$file_name = md5(time().$_FILES['bn_img']['name']).".".$ext;
		if (!preg_match("/\.(jpg|gif|png)$/i", $_FILES['bn_img']['name'])) {
			alert($_FILES['bn_img']['name'] . '은(는) jpg/gif/png 파일이 아닙니다.');
		}
	
		if (preg_match("/\.(jpg|gif|png)$/i", $_FILES['bn_img']['name'])) {
			@mkdir(G5_DATA_PATH.'/banner/'.$_POST['theme'].'/', G5_DIR_PERMISSION);
			@chmod(G5_DATA_PATH.'/banner/'.$_POST['theme'].'/', G5_DIR_PERMISSION);
	
			$dest_path = G5_DATA_PATH.'/banner/'.$_POST['theme'].'/'.$file_name;
	
			move_uploaded_file($_FILES['bn_img']['tmp_name'], $dest_path);
			chmod($dest_path, G5_FILE_PERMISSION);
	
			if (file_exists($dest_path)) {
				$size = getimagesize($dest_path);
				$sql_common .= "bn_img = '". $file_name ."',";
			}
		}
	}
}

if ($w == '') {
	sql_query(" insert into {$g5['eyoom_banner']} set {$sql_common} bn_regdt = '".G5_TIME_YMDHIS."'");
	$bn_no = sql_insert_id();
	$msg = "배너/광고를 추가하였습니다.";
} else if ($w == 'u') {
	if($del_bn_img) {
		$banner_file = G5_DATA_PATH.'/banner/'.$del_bn_img_name;
		if (file_exists($banner_file)) {
			@unlink($banner_file);
		}
	}
	$sql = " update {$g5['eyoom_banner']} set {$sql_common} bn_regdt=bn_regdt where bn_no = '{$bn_no}' ";
	sql_query($sql);
	$msg = "배너/광고를 정상적으로 수정하였습니다.";
} else {
	alert('제대로 된 값이 넘어오지 않았습니다.');
}

// 배너/광고 등록, 수정 시 배너 캐시 삭제하도록 설정
if ($w == '' || $w == 'u') {
	delete_cache_latest('bannerlist');
}

alert($msg,'./banner_form.php?'.$qstr.'&amp;thema='.$_POST['theme'].'&amp;w=u&amp;bn_no='.$bn_no);
?>