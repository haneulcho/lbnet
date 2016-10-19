<?php
include_once('./_common.php');
?>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<?php
include_once(G5_PATH.'/head.sub.php');

$sql = " select * from g5_write_free ORDER BY wr_id desc LIMIT 1 ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++)
{
  echo $row['wr_content'].'<br><br>';
}
//echo json_decode('"\uD83D\uDE00"');

?>

<section class="board-write">
	<form name="fwrite" id="fwrite" action="./test1.php" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data">
	<div class="tbl_frm01 tbl_wrap">
			<div class="lbbottom">
				<div class="wr_content">
					<!--{* 에디터 사용시는 에디터로, 아니면 textarea 로 노출 *}-->
					<textarea id="wr_content" name="wr_content" style="height:36px;" maxlength="65536"></textarea>
				</div>
				<div class="lbsubmit">
					<button type="submit" id="btn_submit" accesskey="s" class="btn-e btn-e-lg btn-e-yellow margin-top-m-2"><i class="fa fa-paper-plane" aria-hidden="true"></i> 입력</button>
				</div>
			</div>
		<div class="margin-hr-10"></div>
	</div>
	</form>
</section>

<?php

include_once(G5_PATH.'/tail.sub.php');
?>
