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

$socialText = '';
if($member['social_type'] != ''){
    $socialText = "회원님은 {$member['social_type']}로 로그인하셨습니다.";
}

$logoutLink = './logout.php';

if($member['social_type'] == "KAKAO"){
    $kakaoRestApiKey = "8f85f03110bc90298656843bc90d610b";
    $kakaoLogoutRedirectUri = "http://localhost/project_1/login/logout.php";
    $logoutLink = "https://kauth.kakao.com/oauth/logout?client_id={$kakaoRestApiKey}&logout_redirect_uri={$kakaoLogoutRedirectUri}";

}else if($member['social_type'] == "NAVER"){
    $logoutLink = '../login/logout.php';
}
?>

<img src=<?=$member['photo']?> alt="프로필 사진" width="40px">
<?=$member['name']?>님 어서오세요.<br>
<?=$socialText?><br>

메인페이지
<br>
<a href='<?=$logoutLink ?>'>로그아웃</a>