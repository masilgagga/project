<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/walk_admin_event.css" />
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
                <div class="title">이벤트 관리자 페이지</div>
            </div>
        </section>
        <section><br>
            <a href="./walk_admin.php" style="font-size:20px;color:#555555;font-weight:bold">회원 관리</a>
            <form id="event_insert" action="./walk_a_event_insert.php" method="post" enctype="multipart/form-data">
                <div class="content e_tap">
                    <h3>이벤트 등록</h3>
                    <div class="event_form">
                        <div><span>이벤트명</span><input type="text" name="event_name"></div>
                        <!-- <input type="text" name="thumbnail"><input type="text" name="detail_1"><input type="text" name="detail_2"> -->
                        <div><span>썸네일 이미지(파일명)</span><input type="file" name="eventImg[]"></div>
                        <div><span>상세_1 이미지(파일명)</span><input type="file" name="eventImg[]"></div>
                        <div><span>상세_2 이미지(파일명)</span><input type="file" name="eventImg[]"></div>
                        <div><span>이벤트 시작날짜</span><input type="date" name="start_day"></div>
                        <div><span>이벤트 종료날짜</span><input type="date" name="end_day"></div>
                        <button type="submit" form="event_insert">이벤트 등록</button>
                    </div>
                </div>
            </form>
        </section>
        <section>
            <div class="content e_tap">
                <h3>이벤트 리스트</h3>
                <?php
                $event_num = "";
                $event_name = "";
                $thumbnail = "";
                $detail_1 = "";
                $detail_2 = "";
                $start_day = "";
                $end_day = "";
                $today = date("Y-m-d");
                $event_check = "";

                $eventListQuery = "SELECT * FROM event";
                $eListResult = mysqli_query($DBCON, $eventListQuery);
                
                mysqli_close($DBCON);

                // 회원 숫자만큼 반복하여 배열에 저장
                while($eListRow = $eListResult->fetch_assoc()){
                    $event_num = $eListRow['event_num'];
                    $event_name = $eListRow['event_name'];
                    $thumbnail = $eListRow['thumbnail'];
                    $detail_1 = $eListRow['detail_1'];
                    $detail_2 = $eListRow['detail_2'];
                    $start_day = $eListRow['start_day'];
                    $end_day = $eListRow['end_day'];

                    if(strtotime($end_day) > strtotime($today)) $event_check = "진행중인 이벤트 입니다";
                    else $event_check = "종료된 이벤트 입니다.";
            ?>
                <div class="event_list">
                    <div class="event_content">
                        <div><span>이벤트명</span> : <?=$event_name?></div>
                        <div><span>썸네일 이미지(파일명)</span>: <?=$thumbnail?></div>
                        <div><span>상세_1 이미지(파일명)</span>: <?=$detail_1?></div>
                        <div><span>상세_2 이미지(파일명)</span>: <?=$detail_2?></div>
                        <div><span>이벤트 시작날짜</span>: <?=$start_day?></div>
                        <div><span>이벤트 종료날짜</span>: <?=$end_day?></div>
                        <div class="event_check"><?=$event_check?></div>
                    </div>
                    <div class="event_delete"><?=$event_name?> 이벤트
                        <button onclick="window.location.href='./walk_a_event_delete.php?event_num=<?=$event_num?>'">
                            삭제하기</button>
                    </div>
                </div>
                <?php
                
            }
        echo "</div>
        </section>";
    }
    else{
        echo ("<script>
            alert('관리자가 아닙니다!');
            window.location.href='./index.php';
            </script>");
    }

    include_once "./footer.php"
    ?>
</body>

</html>