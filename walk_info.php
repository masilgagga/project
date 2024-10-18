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
    <?php include "header.php";?>
    <div class="content wrap">
        <!-- 산책길 정보 -->
        <section>
            <!-- 타이틀 -->
            <div class="title_bg">
                <div class="title">두류 공원</div>
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
                            <div>두류공원</div>
                        </div>
                        <div><i class="fa-regular fa-heart"></i></div>
                    </div>
                    <div class="info_txt">상서고등학교 건너 두류공원 입구에서 두류 제1여울길 합류지점</div>
                    <div class="info_table">
                        <div class="boxContent">
                            <div class="b1">편의 시설</div>
                            <div class="b1">체육 시설</div>
                            <div class="b1">관리 시설</div>
                            <div class="b1">휴양 시설</div>
                        </div>
                        <div class="boxCount">
                            <div class="b2">0</div>
                            <div class="b2">0</div>
                            <div class="b2">14</div>
                            <div class="b2">0</div>
                        </div>
                    </div>
                    <!-- 산책길 난이도, 포장, 관리기관 정보 -->
                    <div class="info_info">
                        <div class="info_info_box">
                            <div class="info_green">구간 난이도</div>
                            <div class="info_info_txt">하</div>
                            <div class="info_green">산책로 포장</div>
                            <div class="info_info_txt">복합</div>
                        </div>
                        <div><span class="info_green">관리기관</span> 두류공원관리사무소(053-803-7480)</div>
                    </div>
                </div>
            </div>
            <!-- 산책길 위치 안내 -->
            <div class="walk_location">
                <div class="walk_location_txt">
                    <div class="info_green">산책 시작 위치</div>
                    <div>시민 광장 입구</div>
                </div>
                <div class="walk_location_txt">
                    <div class="info_green">산책 종점 위치</div>
                    <div>상서고등학교 맞은편 두류공원 오르막 입구에서 두류 제1여울길 합류 지점</div>
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