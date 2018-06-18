<?php
	if (!defined('_GNUBOARD_')) exit;
	// Your Program - Start
	$qna = array(
		array("ques"=>"1번질문", "ans"=>"1답"),
		array("ques"=>"2번질문", "ans"=>"2답"),
		array("ques"=>"3번질문", "ans"=>"3답"),
		array("ques"=>"4번질문", "ans"=>"4답"),
		array("ques"=>"5번질문", "ans"=>"5답"),
		array("ques"=>"6번질문", "ans"=>"6답"),
		array("ques"=>"7번질문", "ans"=>"7답"),
		array("ques"=>"8번질문", "ans"=>"8답"),
		array("ques"=>"9번질문", "ans"=>"9답"),
		array("ques"=>"10번질문", "ans"=>"10답"),
	);

	$rand_ques = array_rand($qna, 2);
	$list = array();

	for($i=0; $i<count($rand_ques); $i++) {
		// echo $qna[$rand_ques[$i]]['ques'];
		unset($data);

		$data['ques'] = $qna[$rand_ques[$i]]['ques'];
		$data['ans'] = $qna[$rand_ques[$i]]['ans'];
		$list[$i] = $data;
	}

	// Your Program - End

	// 변수 할당하기 - /eyoom/inc/tpl.assign.php 파일 참조
	$tpl->assign(array(
	));
?>
