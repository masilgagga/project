<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>마실가까</title>
    <link rel="stylesheet" href="./css/walk_info.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/d035e75539.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php 
    include "./header.php";
    
    $manage_num = $_POST['manage_num'];

    // 산책로 정보 가져오기
    $walkSelectQuery = "SELECT * FROM data WHERE manage_num = '$manage_num'";
    $walkResult = mysqli_query($DBCON, $walkSelectQuery);
    $walkRow = mysqli_fetch_assoc($walkResult);
    
    // 내 산책로 아이콘 변수
    $like = "";
    
    // 비로그인 상태
    if(!isset($_SESSION['memberNum'])){
        $like = "<i class='fa-regular fa-heart' onclick='alert('로그인이 필요합니다.');window.location.href='./walk_login.php';'></i>";
    }else{ // 로그인 상태
        // 회원번호
        $_SESSION['memberNum'];
        
        // 세션에 저장된 회원번호로 해당하는 회원정보 쿼리 질의
        $memberInfoQuery = "SELECT * FROM member WHERE member_num = {$_SESSION['memberNum']}";
    
        // 회원정보 쿼리 질의를 실행
        $result = mysqli_query($DBCON, $memberInfoQuery);
        // 실행한 결과값을 $member변수 값에 저장
        $member = mysqli_fetch_array($result);
        // 회원의 아이디
        $memberId = $member['id'];
        
        // 내 산책로에 정보가 있는지 확인
        $likeSelectQuery = "SELECT * FROM like_list WHERE id = '{$member_id}' AND manage_num = '{$manage_num}'";
        $result = mysqli_query($DBCON, $likeSelectQuery);
        $row = mysqli_fetch_assoc($result);

        // 내 산책로에 있다면
        if($row){
            $like = "<i class='fa-solid fa-heart'></i>";
        }else{ //내 산책로에 없다면
            $like = "<i class='fa-regular fa-heart' onclick='walk_my_insert.php?manage_num=$manage_num'></i>";
        }
    }
    ?>
    <div class="content wrap">
        <!-- 산책길 정보 -->
        <section>
            <!-- 타이틀 -->
            <div class="title_bg">
                <div class="title"><?=$walkRow['location_name']?></div>
            </div>
        </section>
        <!-- 이미지 & 공원 정보 & 산책길 위치 안내 -->
        <section class="walk_info">
            <!-- 이미지 & 공원 정보 -->
            <div class="walk_info_box">
                <!-- 이미지 -->
                <div class="info_img"></div>
                <!-- 공원 정보 -->
                <div class="info_box">
                    <div class="info_name">
                        <div class="info_name_txt">
                            <div><img src="./image/walk_info/title_icon.png" alt="나무 아이콘"></div>
                            <div><?=$walkRow['location_name']?></div>
                        </div>
                        <div><?=$like?></div>
                    </div>
                    <div class="info_txt"><?=$walkRow['explanation']?></div>
                    <div class="info_table">
                        <div class="boxContent">
                            <div class="b1">편의 시설</div>
                            <div class="b1">체육 시설</div>
                            <div class="b1">관리 시설</div>
                            <div class="b1">휴양 시설</div>
                        </div>
                        <div class="boxCount">
                            <div class="b2"><?=$walkRow['comfort']?></div>
                            <div class="b2"><?=$walkRow['sports']?></div>
                            <div class="b2"><?=$walkRow['manage_equip']?></div>
                            <div class="b2"><?=$walkRow['recreation']?></div>
                        </div>
                    </div>
                    <!-- 산책길 난이도, 포장, 관리기관 정보 -->
                    <div class="info_info">
                        <div class="info_info_box">
                            <div class="info_green">구간 난이도</div>
                            <div class="info_info_txt"><?=$walkRow['level']?></div>
                            <div class="info_green">산책로 포장</div>
                            <div class="info_info_txt"><?=$walkRow['pave']?></div>
                        </div>
                        <div><span class="info_green">관리기관</span> &nbsp; <?=$walkRow['manage_name']?>
                            (<?=$walkRow['manage_call']?>)</div>
                    </div>
                </div>
            </div>
            <!-- 산책길 위치 안내 -->
            <div class="walk_location">
                <div class="walk_location_txt">
                    <div class="info_green">산책 시작 위치</div>
                    <div><?=$walkRow['start']?></div>
                </div>
                <div class="walk_location_txt">
                    <div class="info_green">산책 종점 위치</div>
                    <div><?=$walkRow['end']?></div>
                </div>
            </div>
        </section>
        <!-- 산책길 위치 지도 -->
        <section>
            <div class="walk_map">
                <div class="walk_map_address"><i class="fa-solid fa-location-dot"></i> 대구광역시 달서구 공원순환로 36</div>
                <div class="walk_map_api">지도</div>
            </div>
        </section>
    </div>
    <?php include "footer.php";?>
</body>

</html>