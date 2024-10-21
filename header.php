<link rel="stylesheet" href="./css/header.css" />
<link rel="stylesheet" href="./css/index_side_bar.css" />
<script src="./js/jquery-3.7.1.min.js"></script>
<script>
$(function() {
    // 사이드바
    $(".menu").click(function() {
        $(".sidebar").toggleClass("toggle");

        // 토글 상태에 따라 오버레이 표시
        if ($(".sidebar").hasClass("toggle")) {
            $(".overlay").fadeIn();
        } else {
            // 사이드바가 닫힐 때 opacity를 0으로 설정
            $(".overlay").fadeOut();
        }
    });

    // 오버레이 클릭 시 사이드바 닫기
    $(".overlay").click(function() {
        $(".sidebar").removeClass("toggle");
        $(".overlay").fadeOut();
    });
});
</script>
<header class="content">
    <div class="head_wrap">
        <div class="logo"><a href="./index.php"><img src="./image/logo.png" alt="로고" /></a></div>
        <div class="gnb">
            <div><a href="./walk_correctly.php">바르게 걷기</a></div>
            <div><a href="./walk_finder.php">산책길 찾기</a></div>
            <div><a href="./walk_my.php">My 산책길</a></div>
        </div>
        <div class="login"><a href="./walk_login.php">로그인</a></div>
        <div class="menu"><img src="./image/menu.png" alt="메뉴"></div>
    </div>
    <!-- 사이드바 -->
    <div class="overlay"></div>
    <div class="sidebar">
        <div class="userInfoWrap">
            <div class="userInfo">
                <div class="userIcon">
                    <img src="./image/usericon.png" alt="아이콘" />
                </div>
                <div class="userText">
                    <div class="userName">test Id 님</div>
                    <a href="" class="logout">
                        <div>로그아웃</div>
                    </a>
                </div>
            </div>
        </div>
        <ul>
            <a href="./walk_correctly.php">
                <li>바르게 걷기</li>
            </a>
            <a href="./walk_finder.php">
                <li>산책길 찾기</li>
            </a>
            <a href="./walk_my.php">
                <li>My 산책길</li>
            </a>
        </ul>
    </div>


</header>