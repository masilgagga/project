<?php
// 상수 선언
include "../config/const.php";
// 로그인 여부 체크
include "../login/login_check.php";

// 회원번호
$_SESSION['memberNum'];

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
    array_push($likeWalkNum, "'".$row['manage_num']."'");
}

// 내 산책로 관리번호를 문자열로 변환 ('관리번호','관리번호','관리번호'...)
$likeList = implode(",", $likeWalkNum);

// 내 산책로 리스트 정보을 담을 배열
$likeWalk = [];

// 회원이 선택한 내 산책로 리스트가 있다면 실행
if($likeList){
    // 선택한 산책로 리스트를 모두 불러올 쿼리
    $walkQuery = "SELECT * FROM data WHERE manage_num IN ($likeList)";
    
    // 산책로 쿼리 질의를 실행
    $result = mysqli_query(DBCON, $walkQuery);

    // 내 산책로 숫자만큼 반복하여 배열에 저장
    while($row = mysqli_fetch_array($result)){
        array_push($likeWalk, $row);
    }
}

echo "내 산책로";
echo "<ul>";
// 내 산책로 정보를 담은 배열에서 산책로 이름을 출력
if($likeWalk){
    foreach ($likeWalk as $num) {
        $locationName = $num['location_name'];
        $manageNum = $num['manage_num'];
        echo "<li>$locationName 
                <form method='POST' style='display:inline;' action='my_walk_delete.php'>
                    <input type='hidden' name='member_id' value='$memberId'>
                    <input type='hidden' name='manage_num' value='$manageNum'>
                    <button type='submit' onclick='return confirm(\"정말 삭제하시겠습니까?\")'>삭제</button>
                </form>
            </li>";
    }
}
else{
    echo "찜한 산책로가 없습니다.";
}
echo "</ul>";
?>