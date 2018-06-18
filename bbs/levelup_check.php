<?php
include_once('./_common.php');
include_once(EYOOM_PATH.'/common.php');
include_once(EYOOM_USER_PATH.'/levelup/levelup.skin.php');

$url = G5_URL;
$wr_hit = '';
if ($_POST['ans0'] == '' || $_POST['ans1'] == '') {
  $msg = '답변이 정상적으로 넘어오지 않았습니다.';
}
if (isset($_POST['ans0']) && isset($_POST['ans1'])) {
    $ans0 = $_POST['ans0'];
    $ans1 = $_POST['ans1'];
}
if ($msg) {
  alert($msg);
}

for($i=0; $i<count($rand_ques); $i++) {
  echo $qna[$rand_ques[$i]]['ques'];
  // unset($data);
  //
  // $data['ques'] = $qna[$rand_ques[$i]]['ques'];
  // $data['ans'] = $qna[$rand_ques[$i]]['ans'];
  // $list[$i] = $data;
}



// sql_query(" update {$bo_table} set wr_hit = '$wr_hit' where wr_id = '$wr_id' ");
// alert('기존 회원 등업 신청이 완료되었습니다.', $url);
?>
