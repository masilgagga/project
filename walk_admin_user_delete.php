<?php 

include "./config/const.php";


$userNum = $_GET["userNum"];




// 관련 데이터 삭제 쿼리
$deleteCommentsQuery = "DELETE FROM comment WHERE member_num = '{$userNum}';";
$deleteMemberQuery = "DELETE FROM member WHERE member_num = '{$userNum}';";

// 데이터베이스에 쿼리 실행
mysqli_query($DBCON, $deleteCommentsQuery);
mysqli_query($DBCON, $deleteMemberQuery);


mysqli_close($DBCON);

echo "
	      <script>
		  		alert('회원 정보가 삭제 되었습니다.');
	        window.history.back(-1);
	      </script>
	  ";

?>