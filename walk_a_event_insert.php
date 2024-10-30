<?php 
session_start();
// 상수 선언
include "./config/const.php";
// 로그인 여부 체크
include "./login/login_check.php";

$event_name = $_POST['event_name'];
// $thumbnail = $_POST['thumbnail'];
// $detail_1 = $_POST['detail_1'];
// $detail_2 = $_POST['detail_2'];
$start_day = $_POST['start_day'];
$end_day = $_POST['end_day'];

// 이미지 업로드 처리
if (isset($_POST['submit'])) {
    $uploadDir = 'image/walk_event/';


    // 파일 배열을 순회하며 각각의 이미지 처리
    foreach ($_FILES['eventImg']['tmp_name'] as $key => $tmpName) {
        $fileName = basename($_FILES['eventImg']['name'][$key]);
        $filePath = $uploadDir . $fileName;

        // 이미지 서버에 저장
        if (move_uploaded_file($tmpName, $filePath)) {
            // DB에 이미지 정보 저장
            $stmt = $conn->prepare("INSERT INTO images (image_name, image_path) VALUES (?, ?)");
            $stmt->bind_param("ss", $fileName, $filePath);
            $stmt->execute();
            $stmt->close();
            echo "Image {$fileName} uploaded and saved successfully.<br>";
        } else {
            echo "Error uploading image {$fileName}.<br>";
        }
    }
}

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