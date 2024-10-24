<?php


include "./config/const.php";

$comment_num = $_POST["comment_num"];




$deleteQuery = "DELETE FROM comment WHERE comment_num = '{$comment_num}';";

$result = mysqli_query($DBCON, $deleteQuery);
mysqli_close($DBCON);

echo "
	      <script>
		  		alert('완료');
	          location.href = './walk_event_detail.php';
	      </script>
	  ";

?>
