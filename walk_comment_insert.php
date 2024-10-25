<?php
include "./config/const.php";

$memberNum = $_POST["memberNum"];
$content = $_POST["content"];
$regist_day = date("Y-m-d (H:i:s)");

$insertSql = "insert into comment( member_num, content, regist_day,type) "; 
$insertSql .= "values( '$memberNum ', '$content', '$regist_day' , 'instar')";

$result = mysqli_query($DBCON, $insertSql);
mysqli_close($DBCON);

echo ("
	<script>
		alert('댓글 작성이 완료되었습니다.');
		location.href = './walk_event_detail.php';
	</script>
	");


?>