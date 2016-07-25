<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

$captcha_html = "";
if ($is_guest && $board['bo_comment_level'] < 2) {
    $captcha_html = captcha_html('_comment');
}

@include_once($board_skin_path.'/view_comment.head.skin.php');

$list = array();

$is_comment_write = false;
if ($member['mb_level'] >= $board['bo_comment_level'])
    $is_comment_write = true;

// 코멘트 출력
//$sql = " select * from {$write_table} where wr_parent = '{$wr_id}' and wr_is_comment = 1 order by wr_comment desc, wr_comment_reply ";
$sql = " select * from $write_table where wr_parent = '$wr_id' and wr_is_comment = 1 order by wr_comment, wr_comment_reply ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $list[$i] = $row;

    //$list[$i]['name'] = get_sideview($row['mb_id'], cut_str($row['wr_name'], 20, ''), $row['wr_email'], $row['wr_homepage']);

    $tmp_name = get_text(cut_str($row['wr_name'], $config['cf_cut_name'])); // 설정된 자리수 만큼만 이름 출력
    if ($board['bo_use_sideview'])
        $list[$i]['name'] = get_sideview($row['mb_id'], $tmp_name, $row['wr_email'], $row['wr_homepage']);
    else
        $list[$i]['name'] = '<span class="'.($row['mb_id']?'member':'guest').'">'.$tmp_name.'</span>';



    // 공백없이 연속 입력한 문자 자르기 (way 보드 참고. way.co.kr)
    //$list[$i]['content'] = eregi_replace("[^ \n<>]{130}", "\\0\n", $row['wr_content']);

    // $list[$i]['content'] = $list[$i]['content1']= '비밀글 입니다.';
    // if (!strstr($row['wr_option'], 'secret') ||
    //     $is_admin ||
    //     ($write['mb_id']==$member['mb_id'] && $member['mb_id']) ||
    //     ($row['mb_id']==$member['mb_id'] && $member['mb_id'])) {
    //     $list[$i]['content1'] = $row['wr_content'];
    //     $list[$i]['content'] = conv_content($row['wr_content'], 0, 'wr_content');
    //     $list[$i]['content'] = search_font($stx, $list[$i]['content']);

    //댓글의 비밀 댓글을 원댓글 작성자에게도 보여주기 시작
    $pre_comment_info = substr($row['wr_comment_reply'],0,-1);
    $pre_comment = sql_fetch(" select mb_id from {$write_table} where wr_parent = '{$wr_id}' and wr_is_comment = 1 and wr_comment = '{$row['wr_comment']}' and wr_comment_reply = '{$pre_comment_info}' ");

    $list[$i]['content'] = $list[$i]['content1']= '비밀글 입니다.';
    if (!strstr($row['wr_option'], 'secret') ||
        $is_admin ||
        ($pre_comment['mb_id']==$member['mb_id'] && $member['mb_id']) ||        //댓글의 비밀 댓글을 원댓글 작성자에게 보여주기
        ($write['mb_id']==$member['mb_id'] && $member['mb_id']) ||
        ($row['mb_id']==$member['mb_id'] && $member['mb_id'])) {
        $list[$i]['content1'] = $row['wr_content'];
        $list[$i]['content'] = conv_content($row['wr_content'], 0, 'wr_content');
        $list[$i]['content'] = search_font($stx, $list[$i]['content']);
    } else {        //댓글의 비밀 댓글을 원댓글 작성자에게도 보여주기 끝
        $ss_name = 'ss_secret_comment_'.$bo_table.'_'.$list[$i]['wr_id'];

        if(!get_session($ss_name))
            $list[$i]['content'] = '<span style="color:#aaaaaa">비밀글 입니다.</span>';
            // $list[$i]['content'] = '<a href="./password.php?w=sc&amp;bo_table='.$bo_table.'&amp;wr_id='.$list[$i]['wr_id'].$qstr.'" class="s_cmt">비밀글 입니다.</a>';
        else {
            $list[$i]['content'] = conv_content($row['wr_content'], 0, 'wr_content');
            $list[$i]['content'] = search_font($stx, $list[$i]['content']);
        }
    }

    $list[$i]['datetime'] = substr($row['wr_datetime'],2,14);

    // 관리자가 아니라면 중간 IP 주소를 감춘후 보여줍니다.
    $list[$i]['ip'] = $row['wr_ip'];
    if (!$is_admin)
        $list[$i]['ip'] = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", G5_IP_DISPLAY, $row['wr_ip']);

    $list[$i]['is_reply'] = false;
    $list[$i]['is_edit'] = false;
    $list[$i]['is_del']  = false;
    if ($is_comment_write || $is_admin)
    {
        $token = '';

        if ($member['mb_id'])
        {
            if ($row['mb_id'] == $member['mb_id'] || $is_admin)
            {
                set_session('ss_delete_comment_'.$row['wr_id'].'_token', $token = uniqid(time()));
                $list[$i]['del_link']  = './delete_comment.php?bo_table='.$bo_table.'&amp;comment_id='.$row['wr_id'].'&amp;token='.$token.'&amp;page='.$page.$qstr;
                $list[$i]['is_edit']   = true;
                $list[$i]['is_del']    = true;
            }
        }
        else
        {
            if (!$row['mb_id']) {
                $list[$i]['del_link'] = './password.php?w=x&amp;bo_table='.$bo_table.'&amp;comment_id='.$row['wr_id'].'&amp;page='.$page.$qstr;
                $list[$i]['is_del']   = true;
            }
        }

        if (strlen($row['wr_comment_reply']) < 5)
            $list[$i]['is_reply'] = true;
    }

    // 05.05.22
    // 답변있는 코멘트는 수정, 삭제 불가
    if ($i > 0 && !$is_admin)
    {
        if ($row['wr_comment_reply'])
        {
            $tmp_comment_reply = substr($row['wr_comment_reply'], 0, strlen($row['wr_comment_reply']) - 1);
            if ($tmp_comment_reply == $list[$i-1]['wr_comment_reply'])
            {
                if ($list[$i-1]['mb_id'] == $member['mb_id']) {
                  $list[$i-1]['is_edit'] = true;  // 루루아빠 수정 / 회원 본인의 댓글은 수정하기
                } else {
                  $list[$i-1]['is_edit'] = false;  // 루루아빠 수정 / 회원 본인의 댓글은 수정하기
                }
                $list[$i-1]['is_del'] = false;
            }
        }
    }
}

//  코멘트수 제한 설정값
if ($is_admin)
{
    $comment_min = $comment_max = 0;
}
else
{
    $comment_min = (int)$board['bo_comment_min'];
    $comment_max = (int)$board['bo_comment_max'];
}

if($bo_table == 'love') {
  include_once($board_skin_path.'/view_comment.skin_love.php');
} else {
  include_once($board_skin_path.'/view_comment.skin.php');
}

if (!$member['mb_id']) // 비회원일 경우에만
    echo '<script src="'.G5_JS_URL.'/md5.js"></script>'."\n";

@include_once($board_skin_path.'/view_comment.tail.skin.php');
?>
