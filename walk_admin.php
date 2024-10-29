<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/walk_admin.css" />
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
                <div class="title">회원 관리자 페이지</div>
            </div>
        </section>
        <main class="manage">
            <section class="memberList">
                <a href="./walk_admin_event.php">이벤트 관리</a><br><br>
                회원 관리<br><br>
                <?php
                    $memberListQuery = "SELECT * FROM member ";
                    $mListResult = mysqli_query($DBCON, $memberListQuery);
                                        
                    // 회원 숫자만큼 반복하여 배열에 저장
                    while($mListRow = $mListResult->fetch_assoc()){
                ?>
                <form method="post">
                    <button style="display: flex; border:none;">
                        <input type="hidden" name="member_num" value="<?=$mListRow['member_num']?>">
                        <input type="hidden" name="member_grade" value="<?=$mListRow['member_grade']?>">
                        <input type="hidden" name="member_name" value="<?=$mListRow['name']?>">
                        <input type="hidden" name="member_create" value="<?=$mListRow['created_at']?>">
                        <input type="hidden" name="member_photo" value="<?=$mListRow['photo']?>">
                        <div style="margin-right: 10px;"><?=$mListRow['member_num']?></div>
                        <div><?=$mListRow['name']?></div>
                    </button>
                </form>
                <?php
                    }
            ?>
            </section>
            <section class="manageContents">
                <?php 
                // post으로 member_num이 설정되어 있는지 확인
                if (isset($_POST["member_num"])) {
                    $member_num = intval($_POST["member_num"]); // 입력값을 안전하게 처리하기 위해 intval 사용

                    $memberCommentQuery = 
                    " SELECT m.name, m.created_at, m.member_grade, m.photo, c.content, c.comment_num, c.regist_day
                    FROM member m 
                    LEFT JOIN comment c
                    ON m.member_num = c.member_num 
                    WHERE m.member_num = $member_num"; // WHERE 절 추가

                    $mCommentResult = mysqli_query($DBCON, $memberCommentQuery);
                ?>
                <section class="memberDelete">
                    <!-- 유저 삭제기능 -->
                    <form action="./walk_admin_user_delete.php" method="post">
                        <img src="<?=$_POST['member_photo']?>" alt="">
                        <input type="hidden" name="userNum" value="<?=$_POST['member_num']?>">
                        <?php
                    if($member_grade == 1 && $member_grade != $_POST['member_grade'] ){
                    ?>
                        <button type="submit"
                            onclick='return confirm("정말 <?=$_POST["member_name"]?>님의 정보를 삭제하시겠습니까?") && confirm("정말로 이 작업을 진행하시겠습니까?")'>
                            회원 삭제</button>
                        <?php
                    }
                    ?>
                    </form>

                </section>
                <div class="comment_list">
                    <?php
                    while ($commentRow = $mCommentResult->fetch_assoc()) {
                        if($commentRow['content']){
                ?>
                    <!-- 댓글 확인 및 삭제 기능 -->
                    <form action=" ./walk_a_comment_delete.php" method="post">
                        <table>
                            <tr>
                                <td class="comment_title">댓글 번호 :</td>
                                <td><?=$commentRow['comment_num']?></td>
                            </tr>
                            <tr>
                                <td class="comment_title">댓글 내용 :</td>
                                <td><?=$commentRow['content']?></td>
                            </tr>
                            <tr>
                                <td class="comment_title">작성 일자 :</td>
                                <td><?=$commentRow['regist_day'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" onclick='return confirm("정말 댓글을 삭제하시겠습니까?")'>삭제</button>
                                </td>
                            </tr>
                            <input name="comment_num" type="hidden" value="<?=$commentRow['comment_num']?>">
                        </table>
                    </form>
                    <?php
                        }else{
                            echo "<div>{$commentRow['name']} <br>가입일자 : ({$commentRow['created_at']})</div>";
                            // echo "<img src='{$commentRow['photo']}'></img>";
                        }

                    }
                ?>
                </div>
            </section>
            <?php
                } 
            ?>
        </main>
        <?php include "footer.php";?>
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