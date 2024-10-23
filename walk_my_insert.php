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
$memberId = $member['id'];

// 회원이 선택한 산책로 관리번호
$manage_num = $_GET['manage_num'];

// 내 산책로 리스트를 가져올 쿼리
$likeQuery = "SELECT * FROM like_list WHERE id = '{$memberId}' AND manage_num = '{$manage_num}'";
// 내 산책로 쿼리 질의를 실행
$likeResult = mysqli_query($DBCON, $likeQuery);
// 내 산책로 관리번호를 담을 배열
$likeRow = mysqli_fetch_array($likeResult);

// 이미 찜한 산책로인지 확인
if ($likeRow) {
    echo ("<script>
        alert('이미 찜한 산책로입니다.');
        window.location.href = './walk_my.php';
        </script>");
} else {
    // 인서트 쿼리 작성
    $listInsertQuery = "INSERT INTO like_list(`id`, `manage_num`) VALUES ('{$memberId}', '{$manage_num}')";
    // 인서트 쿼리문 실행
    $insertResult = mysqli_query($DBCON, $listInsertQuery);
    
    // 산책로 정보 테이블에서 해당 관리번호의 찜 갯수 +1 하는 쿼리
    $updateCountQuery = "UPDATE data SET like_count = like_count + 1 WHERE manage_num = '{$manage_num}'";
    mysqli_query($DBCON, $updateCountQuery);

    if ($insertResult) {
        echo ("<script>
        alert('산책로가 찜 목록에 추가되었습니다!');
        window.location.href = './walk_info.php?manage_num=$manage_num';
        </script>");
    } else {
        echo ("<script>
        alert('추가 중 오류가 발생했습니다');
        window.location.href = './walk_info.php?manage_num=$manage_num';
        </script>");
    }
}


?>