<?php 
// 상수 선언
include "../config/const.php";
// 로그인 여부 체크
include "../login/login_check.php";

// 회원번호
$_SESSION['memberNum'];

// 회원이 선택한 산책로 관리번호
$selectNum = '27290-00179-03-003';

// 세션에 저장된 회원번호로 해당하는 회원정보 쿼리 질의
$memberInfoQuery = "SELECT * FROM member WHERE member_num = {$_SESSION['memberNum']}";

// 회원정보 쿼리 질의를 실행
$result = mysqli_query(DBCON, $memberInfoQuery);

// 실행한 결과값을 $member변수 값에 저장
$member = mysqli_fetch_array($result);

// 회원의 아이디
$memberId = $member['id'];

// 내 산책로 리스트를 가져올 쿼리
$listQuery = "SELECT * FROM like_list WHERE id = '{$memberId}'";

// 내 산책로 쿼리 질의를 실행
$result = mysqli_query(DBCON, $listQuery);

// 내 산책로 관리번호를 담을 배열
$likeWalkNum = [];

// 내 산책로 숫자만큼 반복하여 배열에 저장
while($row = mysqli_fetch_array($result)){
    array_push($likeWalkNum, $row['manage_num']);
}

// 회원이 선택한 산책로 리스트가 있다면
if ($likeWalkNum) {
    // 이미 찜한 산책로인지 확인
    if (in_array($selectNum, $likeWalkNum)) {
        echo "이미 찜한 산책로입니다.";
    } else {
        // 새로 찜한 산책로를 목록에 추가
        $likeWalkNum[] = $selectNum;

        // 인서트 쿼리 작성
        $listInsertQuery = "INSERT INTO like_list(
        `id`,
        `manage_num`
        ) VALUES (
        '{$memberId}',
        '{$selectNum}'
        )";

        // 지정된 쿼리문 실행
        $result = mysqli_query(DBCON, $listInsertQuery);

        if ($result) {
            echo "산책로가 찜 목록에 추가되었습니다!";
        } else {
            echo "추가 중 오류가 발생했습니다";
        }
    }
} else {
    // 새로 찜한 산책로를 목록에 추가
    $likeWalkNum[] = $selectNum;

    // 인서트 쿼리 작성
    $listInsertQuery = "INSERT INTO like_list(
    `id`,
    `manage_num`
    ) VALUES (
    '{$memberId}',
    '{$selectNum}'
    )";

    // 지정된 쿼리문 실행
    $result = mysqli_query(DBCON, $listInsertQuery);

    if ($result) {
        echo "산책로가 찜 목록에 추가되었습니다!";
    } else {
        echo "추가 중 오류가 발생했습니다";
    }
}


?>