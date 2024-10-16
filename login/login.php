<?php
// 상수 선언
include "../config/const.php";

session_start();

// 로그인 상태일 때
// isset($_SESSION['memberNum']): SESSION에 memberNum 키가 존재하는지 확인

if(isset($_SESSION['memberNum']) && $_SESSION['memberNum']){
    echo "<script>";
    echo "alert('로그인 되어있습니다.');";
    echo "window.location.href='../config/main.php';";
    echo "</script>";
    exit;
}

// 카카오 로그인에 관련된 정보
$kakaoRestApiKey = "8f85f03110bc90298656843bc90d610b";
$kakaoRedirectUri = KAKAO_REDIRECT_URI;
$kakaoLoginUrl = "https://kauth.kakao.com/oauth/authorize?response_type=code&client_id={$kakaoRestApiKey}&redirect_uri={$kakaoRedirectUri}";

// 네이버 로그인에 관련된 정보
$naverClientId = "VFLcg6_eRDHpMF_apBzQ";
$naverRedirectUri = urlencode(NAVER_REDIRECT_URI);
$naverState = "RAMDOM_STATE";
$naverApiUrl = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id={$naverClientId}&redirect_uri={$naverRedirectUri}&state={$naverState}";
?>

<html>

<body>
    <form action="./login_check.php" method="POST">
        <!-- href="<?//php echo $kakaoLoginUrl ?>" -->
        <a id="kakao-login-btn" href="<?=$kakaoLoginUrl ?>">
            <img src="https://k.kakaocdn.net/14/dn/btroDszwNrM/I6efHub1SN5KCJqLm1Ovx1/o.jpg" alt="카카오 로그인"
                width="150" /></a><br>
        <a href="<?=$naverApiUrl ?>"><img src="http://static.nid.naver.com/oauth/small_g_in.PNG" height="40"
                alt="네이버 로그인" /></a>
        <br>
        <!-- <a href="./member_form.php">회원가입</a> -->
    </form>
</body>

</html>