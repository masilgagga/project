<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/walk_my.css" />
    <title>마실가까</title>
    <script src="https://kit.fontawesome.com/d035e75539.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include "header.php";
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
    // 회원등급
    $member_grade = $member['member_grade'];

    if($member_grade == 1){
    ?>
    <div class="content wrap">
        <!-- 산책길 찾기 타이틀 -->
        <section>
            <!-- 타이틀 -->
            <div class="title_bg">
                <div class="title">관리자 페이지</div>
            </div>
        </section>
        <section>
            회원 관리
            <?php
            // $memberListQuery = "SELECT * FROM member";
            $memberListQuery = "SELECT m.name, m.created_at, m.member_grade, c.content FROM member m LEFT JOIN comment c on m.member_num = c.member_num";
            $mListResult = mysqli_query($DBCON, $memberListQuery);
                                
            // 회원 숫자만큼 반복하여 배열에 저장
            while($mListRow = $mListResult->fetch_assoc()){
                ?>
            <div><?=$mListRow['name']?></div>
            <div><?=$mListRow['created_at']?></div>
            <div><?=$mListRow['content']?></div>
            <div><?=$mListRow['member_grade']?></div>

            <?php
            }
            ?>
        </section>
        <?php
    }
    else{
        echo ("<script>
            alert('관리자가 아닙니다!');
            window.location.href='./index.php';
            </script>");
    }
    ?>
</body>

</html>