<link rel="stylesheet" href="./css/header.css" />
<link rel="stylesheet" href="./css/index_side_bar.css" />
<script src="./js/jquery-3.7.1.min.js"></script>
<script>
    console.log("js")
        $(function () {
// 사이드바
$(".menu").click(function () {
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
$(".overlay").click(function () {
  $(".sidebar").removeClass("toggle");
  $(".overlay").fadeOut();
});
});
    </script>
<header>
    <div class="head_wrap">
        <div class="logo"><img src="./image/logo.png" alt="로고" /></div>
        <div class="gnb">
            <div><a href="">바르게 걷기</a></div>
            <div><a href="">산책길 찾기</a></div>
            <div><a href="">My 산책길</a></div>
        </div>
        <div class="login">로그인</div>
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
            <a href="">
                <li>바르게 걷기</li>
            </a>
            <a href="">
                <li>산책길 찾기</li>
            </a>
            <a href="">
                <li>My 산책길</li>
            </a>
        </ul>
    </div>
 
  
</header>