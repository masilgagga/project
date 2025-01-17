<?php
session_start();

include_once "./config/const.php";

// 비로그인 상태
$mvLogin = "<div class='userName'>로그인 해주세요</div><div><a href='./walk_login.php'>로그인</a></div>";
$pcLogin = "<a href='./walk_login.php'>로그인</a>";
$memberPhoto = "./image/usericon.png";
$memberName = "";
$memberGrade = 0;
$admin = "";

// 로그인 상태
if(isset($_SESSION['memberNum']) && $_SESSION['memberNum']){
    // 세션에 저장된 회원번호로 해당하는 회원정보 쿼리 질의
    $memberInfoQuery = "SELECT * FROM member WHERE member_num = {$_SESSION['memberNum']}";
    // 회원정보 쿼리 질의를 실행
    $result = mysqli_query($DBCON, $memberInfoQuery);
    // 실행한 결과값을 $member변수 값에 저장
    $member = mysqli_fetch_array($result);
    // 회원의 아이디
    $memberId = $member['id'];
    $memberName = $member['name'];
    $memberPhoto = $member['photo'];
    $memberGrade = $member['member_grade'];

    if($memberGrade == 1){
        $admin = "<a href='./walk_admin.php'>관리자페이지</a>";
    }

    $mvLogin = "<div class='userName'>$memberName 님</div><div>$admin <a href='./login/logout.php'>로그아웃</a></div>";
    $pcLogin = "<div class='userName_pc'>$memberName 님</div><div>$admin <a href='./login/logout.php'>로그아웃</a></div>";
}
?>

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

// scroll 이벤트에 대한 Top 버튼 제어
$(window).scroll(function() {
    if ($(window).scrollTop() > 100) {
        //$("#top_btn").show();
        $("#top_btn").fadeIn();
    } else {
        //$("#top_btn").hide();
        $("#top_btn").fadeOut();
    }
});
</script>
<header class="content">
    <div class="head_wrap">
        <div class="logo"><a href="./index.php"><img src="./image/logo.png" alt="로고" /></a></div>
        <div class="gnb">
            <div><a href="./walk_correctly.php">바르게 걷기</a></div>
            <div><a href="./walk_finder.php">산책길 찾기</a></div>
            <div><a href="./walk_event.php">산책길 Event</a></div>
            <div><a href="./walk_my.php">My 산책길</a></div>
        </div>
        <div class="login"><?=$pcLogin?></div>
        <div class="menu"><img src="./image/menu.png" alt="메뉴"></div>
    </div>
    <!-- 사이드바 -->
    <div class="overlay"></div>
    <div class="sidebar">
        <div class="userInfoWrap">
            <div class="userInfo">
                <div class="userIcon"><img src=<?=$memberPhoto?> alt="프로필사진" /></div>
                <div class="userText"><?=$mvLogin?></div>
            </div>
        </div>
        <ul>
            <a href="./walk_correctly.php">
                <li>바르게 걷기</li>
            </a>
            <a href="./walk_finder.php">
                <li>산책길 찾기</li>
            </a>
            <a href="./walk_event.php">
                <li>산책길 Event</li>
            </a>
            <a href="./walk_my.php">
                <li>My 산책길</li>
            </a>
        </ul>
    </div>

    <!-- 페이지 Top 버튼 -->
    <nav id="top_btn">
        <a id="top_a" href="#"><img src="./image/top.png" alt="top"></a>
    </nav>
</header>