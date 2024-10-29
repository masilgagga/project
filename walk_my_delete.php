<?php
session_start();

// 상수 선언
include "./config/const.php";
// 로그인 여부 체크
include "./login/login_check.php";

// 회원번호
$_SESSION['memberNum'];

// 세션에 저장된 회원번호로 해당하는 회원정보 쿼리 질의
$memberInfoQuery = "SELECT * FROM member WHERE member_num = {$_SESSION['memberNum']}";

// 회원정보 쿼리 질의를 실행
$result = mysqli_query($DBCON, $memberInfoQuery);
// 실행한 결과값을 $member변수 값에 저장
$member = mysqli_fetch_array($result);
// 회원의 아이디
$member_id = $member['id'];

// 회원이 선택한 산책로 관리번호
$manage_num = $_GET['manage_num'];

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
    global $DBCON;
    
    // 내 산책로에 정보가 있는지 확인
    $selectQuery = "SELECT * FROM like_list WHERE id = '{$member_id}' AND manage_num = '{$manage_num}'";
    $result = mysqli_query($DBCON, $selectQuery);
    $row = mysqli_fetch_assoc($result);

    echo "<script>";
   // 쿼리 실행
    if ($row) {
        // 해당 산책로의 찜 갯수를 불러오는 쿼리
        $selectCountQuery = "SELECT like_count FROM data WHERE manage_num = '{$manage_num}'";
        $countResult = mysqli_query($DBCON, $selectCountQuery);
        $countRow = mysqli_fetch_assoc($countResult);
        
        if($countRow['like_count'] > 0){
            // 산책로 정보 테이블에서 해당 관리번호의 찜 갯수 -1 하는 쿼리
            $updateCountQuery = "UPDATE data SET like_count = like_count - 1 WHERE manage_num = '{$manage_num}'";
            mysqli_query($DBCON, $updateCountQuery);
        }

        // 내 산책로 삭제 쿼리
        $deleteQuery = "DELETE FROM like_list WHERE id = '{$member_id}' AND manage_num = '{$manage_num}';";
        // 내 산책로 쿼리 질의를 실행
        mysqli_query($DBCON, $deleteQuery);
        
        echo "alert('내 산책길에서 삭제를 성공하였습니다.');";
   } else {
        echo "alert('내 산책길에서 삭제를 실패하였습니다.');";
   }
   echo "window.history.back();";
   echo "</script>";
}
?>