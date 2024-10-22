<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>마실가까</title>
    <link rel="stylesheet" href="./css/walk_login.css" />
</head>

<body>
    <?php 
    include "header.php";
    
    // 로그인 상태일 때
    // isset($_SESSION['memberNum']): SESSION에 memberNum 키가 존재하는지 확인
    if(isset($_SESSION['memberNum']) && $_SESSION['memberNum']){
        echo "<script>";
        echo "alert('로그인 되어있습니다.');";
        echo "window.location.href='./index.php';";
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

    <form action="./login/login_check.php" method="POST">
        <div class="content login_content">
            <div class="social_login">
                <div class="social_title">간편로그인</div>
                <a id="kakao-login-btn" href="<?=$kakaoLoginUrl ?>">
                    <img src="./image/walk_login/kakao_login.png" alt="카카오 로그인">
                </a>
                <br />
                <a href="<?=$naverApiUrl ?>"><img src="./image/walk_login/naver_login.png" alt="네이버 로그인"></a>
            </div>
        </div>
    </form>
    <?php include "footer.php";?>
</body>

</html>