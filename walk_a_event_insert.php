<?php 
session_start();
// 상수 선언
include "./config/const.php";
// 로그인 여부 체크
include "./login/login_check.php";

$event_name = $_POST['event_name'];
$thumbnail = $_POST['thumbnail'];
$detail_1 = $_POST['detail_1'];
$detail_2 = $_POST['detail_2'];
$start_day = $_POST['start_day'];
$end_day = $_POST['end_day'];

// 이벤트 내용을 입력하는 쿼리
$eventInsertQuery = "INSERT INTO event (`event_name`, `thumbnail`, `detail_1`, `detail_2`, `start_day`, `end_day`)
     VALUES ('$event_name', '$thumbnail', '$detail_1', '$detail_2', '$start_day', '$end_day')";

// 이벤트 입력 쿼리 질의를 실행
$insertResult = mysqli_query($DBCON, $eventInsertQuery);

echo "<script>";
if ($insertResult) {
    echo "alert('이벤트가 등록되었습니다.');";
} else {
    echo "alert('이벤트 등록이 실패하였습니다.');";
}
echo ("window.location.href = './walk_admin_event.php';
    </script>");
?>