<?php
include_once('./_common.php');
include_once(EYOOM_PATH.'/common.php');

if (!$is_member) {
	alert('로그인해 주세요.', G5_BBS_URL.'/login.php?url='.urlencode(G5_BBS_URL.'/current_connect_admin.php'));
} else {
	if (!$is_admin) {
		alert('잘못된 접근을 통한 정보 탈취는 불법입니다. \n3회 이상 시도시 법적 처벌을 받을 수 있습니다!', G5_URL);
	}
}

$g5['title'] = '현재접속자';
include_once('./_head.php');

$list = array();

$sql = " select a.mb_id, b.mb_nick, b.mb_name, b.mb_email, b.mb_homepage, b.mb_open, b.mb_point, a.lo_ip, a.lo_location, a.lo_url
            from {$g5['login_table']} a left join {$g5['member_table']} b on (a.mb_id = b.mb_id)
            where a.mb_id <> '{$config['cf_admin']}'
            order by a.lo_datetime desc ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $row['lo_url'] = get_text($row['lo_url']);
    $list[$i] = $row;

    if ($row['mb_id']) {
        $list[$i]['name'] = get_sideview($row['mb_id'], cut_str($row['mb_nick'], $config['cf_cut_name']), $row['mb_email'], $row['mb_homepage']);
    } else {
        if ($is_admin)
            $list[$i]['name'] = $row['lo_ip'];
        else
            $list[$i]['name'] = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", G5_IP_DISPLAY, $row['lo_ip']);
    }

    $list[$i]['num'] = sprintf('%03d',$i+1);
}

include_once($connect_skin_path.'/current_connect.skin.php');

include_once('./_tail.php');
?>