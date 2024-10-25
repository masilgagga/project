<?php


include "./config/const.php";

$comment_num = $_POST["comment_num"];



$deleteQuery = "DELETE FROM comment WHERE comment_num = '{$comment_num}';";

$result = mysqli_query($DBCON, $deleteQuery);
mysqli_close($DBCON);

echo "
	      <script>
		  		alert('댓글이 삭제 되었습니다.');
	        window.history.back(-1);
	      </script>
	  ";

?>
