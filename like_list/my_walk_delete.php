<?php
// 상수 선언
include "../config/const.php";
// 로그인 여부 체크
include "../login/login_check.php";

// id와 관리번호 받아옴
$member_id = $_POST['member_id'];
$manage_num = $_POST['manage_num'];

// 삭제 요청 처리
if (isset($member_id) && isset($manage_num)) {
    deleteLike($member_id, $manage_num);
}else{
    echo "<script>";
    echo "window.history.back();";
    echo "</script>";
}

// like_list 테이블에서 아이디와 관리번호를 모두 만족하는 row를 찾아서 삭제
function deleteLike($member_id, $manage_num){
   // 내 산책로 삭제 쿼리 
   $deleteQuery = "DELETE FROM like_list WHERE id = '{$member_id}' AND manage_num = '{$manage_num}';";

   // 내 산책로 쿼리 질의를 실행
   $result = mysqli_query(DBCON, $deleteQuery);

   echo "<script>";
   // 쿼리 실행
   if ($result) {
       echo "alert('내 산책로에서 삭제를 성공하였습니다.');";
   } else {
       echo "alert('내 산책로에서 삭제를 실패하였습니다.');";
   }
   echo "window.history.back();";
   echo "</script>";
}
?>