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
    
    $manage_num = $_GET['manage_num'];
    
    // 산책로 정보 가져오기
    $walkSelectQuery = "SELECT * FROM data WHERE manage_num = '$manage_num'";
    $walkResult = mysqli_query($DBCON, $walkSelectQuery);
    $walkRow = mysqli_fetch_assoc($walkResult);
    
    // 내 산책로 아이콘 변수
    $like = "";
    
    // 비로그인 상태
    if(!isset($_SESSION['memberNum'])){
        $like = "<i class='fa-regular fa-heart' onclick='login()'></i>";
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
        $member_id = $member['id'];
        
        // 내 산책로에 정보가 있는지 확인
        $likeSelectQuery = "SELECT * FROM like_list WHERE id = '{$member_id}' AND manage_num = '{$manage_num}'";
        $result = mysqli_query($DBCON, $likeSelectQuery);
        $row = mysqli_fetch_assoc($result);

        // 내 산책로에 있다면
        if($row){
            $like = "<i class='fa-solid fa-heart'></i>";
        }else{ //내 산책로에 없다면
            $like = "<i class='fa-regular fa-heart' onclick='insert()'></i>";
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
                <div class="walk_map_address"><i class="fa-solid fa-location-dot locationIcon"></i><?=$walkRow['address']?> </div>
                <!-- 지도 -->
                <div class="walk_map_api" id="map">
        
                <script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?=KAKAO_MAP_API?>"></script>
                <script>
                    
                    var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
                    mapOption = 
                        {
                            center: new kakao.maps.LatLng(<?=$walkRow['latitude']?>, <?=$walkRow['longitude']?>), // 지도의 중심좌표
                            level: 3, // 지도의 확대 레벨
                            mapTypeId : kakao.maps.MapTypeId.ROADMAP // 지도종류
                        }; 

                        // 지도를 생성한다 
                        var map = new kakao.maps.Map(mapContainer, mapOption); 

 

                        // 지도에 마커를 생성하고 표시한다
                        var marker = new kakao.maps.Marker({
                            position: new kakao.maps.LatLng(<?=$walkRow['latitude']?>, <?=$walkRow['longitude']?>), // 마커의 좌표
                            map: map // 마커를 표시할 지도 객체
                        });
                        // 마커 위에 표시할 인포윈도우를 생성한다
                        var infowindow = new kakao.maps.InfoWindow({
                        content : '<div style="padding:5px;"><?=$walkRow['location_name']?></div>' // 인포윈도우에 표시할 내용
                        });

                        // 인포윈도우를 지도에 표시한다
                        infowindow.open(map, marker);


                </script>
                </div>
            </div>
        </section>
    </div>
    <script>
    function login() {
        alert('로그인이 필요합니다.');
        window.location.href = './walk_login.php';
    }

    function insert() {
        window.location.href = 'walk_my_insert.php?manage_num=<?=$manage_num?>';
    }
    </script>
    <?php include "footer.php";?>
</body>

</html>