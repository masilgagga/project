<?php 
session_start();
// 상수 선언
include "./config/const.php";
// 로그인 여부 체크
include "./login/login_check.php";

$event_num = $_GET['event_num'];

// 이벤트 내용을 삭제하는 쿼리
$eventDeleteQuery = "DELETE FROM event WHERE event_num='$event_num'";

// 이벤트 삭제 쿼리 질의를 실행
$deleteResult = mysqli_query($DBCON, $eventDeleteQuery);

echo "<script>";
if ($deleteResult) {
    echo "alert('이벤트가 삭제되었습니다.');";
} else {
    echo "alert('이벤트 삭제를 실패하였습니다.');";
}
echo ("window.location.href = './walk_admin_event.php';
    </script>");
?>