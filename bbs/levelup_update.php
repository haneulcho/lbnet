<?php
include_once('./_common.php');
include_once(EYOOM_PATH.'/common.php');

$mb_id = '';
if (isset($_POST['mb_id']) && $is_admin) {
    $mb_id = $_POST['mb_id'];
    $admin_id = $member['mb_id'];
    $level_limit = 3;
}
if ($mb_id == '') {
    $msg = '오류가 발생하였습니다! 아이디 값이 정상적으로 넘어오지 않았습니다.';
}
if (isset($_POST['bo_table'])) {
    $bo_table = $_POST['bo_table'];
    $bo_write_table = 'g5_write_'.$_POST['bo_table'];
} else {
    $msg = '오류가 발생하였습니다! bo_table 값이 정상적으로 넘어오지 않았습니다.';
}
if (isset($_POST['wr_id'])) {
    $wr_id = $_POST['wr_id'];
} else {
    $msg = '오류가 발생하였습니다! wr_id 값이 정상적으로 넘어오지 않았습니다.';
}

// 작업 처리 후 이동 할 URL에 현재 page 적용
$url = G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id;
if (isset($_POST['page'])) {
    $page = (int)$_POST['page'];
    if ($page)
        $url .= '&amp;page=' . urlencode($page);
}

if ($member['mb_id'] && $is_admin) {
    // 등업하기 버튼 클릭, 등업 완료 시 게시글에 등록된 첨부파일 자동 삭제
    $sql = " select bf_file from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ";
    $result = sql_query($sql);
    
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        @unlink(G5_DATA_PATH.'/file/'.$bo_table.'/'.$row['bf_file']);
        // 첨부파일 썸네일 삭제
        if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['bf_file'])) {
            delete_board_thumbnail($bo_table, $row['bf_file']);
        }
        // board_file 테이블 내용 삭제
        sql_query(" delete from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");
    }

    // 첨부파일 삭제 후 남은 파일 개수 게시물에 업데이트, 카테고리 완료 처리
    $row = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ");
    sql_query(" update {$bo_write_table} set wr_file = '{$row['cnt']}', ca_name = '완료' where wr_id = '{$wr_id}' ");

    // 회원 정보 업데이트
    sql_query(" update {$g5['member_table']} set mb_name = '익명니니', mb_memo = '등업운영진: ".$admin_id."', mb_level = '{$level_limit}', mb_woman = '1', mb_email_certify = '".G5_TIME_YMDHIS."' where mb_id = '{$mb_id}' ");

    // 게시판 최신글 캐시 파일 삭제
    delete_cache_latest($bo_table);

    $msg = '등업이 완료되었습니다. 아이디: '.$mb_id;
} else {
    $msg = '잘못된 접근을 통한 정보 탈취는 불법입니다. \n3회 이상 시도시 법적 처벌을 받을 수 있습니다!';
    $url = G5_URL;
}

if ($msg) {
    alert($msg, $url);
}
?>
