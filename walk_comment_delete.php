<?php
include "./config/const.php";

$event_num = $_GET['event_num'];
$comment_num = $_POST["comment_num"];

$deleteQuery = "DELETE FROM comment WHERE comment_num = '{$comment_num}';";

$result = mysqli_query($DBCON, $deleteQuery);
mysqli_close($DBCON);

echo ("
	<script>
		alert('댓글 삭제가 완료되었습니다.');
		location.href = './walk_event_detail.php?event_num=$event_num';
	</script>
	");
?>