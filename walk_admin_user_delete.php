<?php 

include "./config/const.php";

$userNum = $_POST["userNum"];

// 회원 삭제 쿼리
$deleteMemberQuery = "DELETE FROM member WHERE member_num = '{$userNum}';";
// 댓글 삭제 쿼리
$deleteCommentsQuery = "DELETE FROM comment WHERE member_num = '{$userNum}';";
// 내산책길 삭제 쿼리
$deleteLikeListQuery = "DELETE FROM member WHERE member_num = '{$userNum}';";

// 데이터베이스에 쿼리 실행
mysqli_query($DBCON, $deleteMemberQuery);
mysqli_query($DBCON, $deleteCommentsQuery);
mysqli_query($DBCON, $deleteLikeListQuery);

mysqli_close($DBCON);

echo "
	      <script>
		  	alert('회원 정보가 삭제 되었습니다.');
	        window.location.href='./walk_admin.php';
	      </script>
	  ";

?>