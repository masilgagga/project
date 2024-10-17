<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/walk_finder.css" />
    <title>산책길 찾기</title>
    <script src="https://kit.fontawesome.com/d035e75539.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include "header.php";?>
    <div>
        <div class="top_padding"></div>
        <!-- 산책길 찾기 타이틀 & 셀렉트 검색 -->
        <section>
            <!-- 타이틀 -->
            <div class="title_bg">
                <div class="title">산책길 찾기</div>
            </div>
            <!-- 셀렉트 검색 -->
            <div class="search_box">
                <div class="select">
                    <div class="select_box">
                        <!-- 읍면동 -->
                        <div>
                            <div class="select_title">읍 / 면 / 동</div>
                            <div>
                                <select name="" id="">
                                    전체
                                </select>
                            </div>
                        </div>
                        <!-- 포장 유무 -->
                        <div>
                            <div class="select_title">포장 유무</div>
                            <div>
                                <select name="" id="">
                                    전체
                                </select>
                            </div>
                        </div>
                        <!-- 구간 난이도 -->
                        <div>
                            <div class="select_title">구간 난이도</div>
                            <div>
                                <select name="" id="">
                                    전체
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <!-- 찾기 버튼 -->
                        <div class="find_btn">
                            <button>찾기</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- 목록 페이지 번호 -->
        <section>
            <div class="page_num">
                <span><img src="./image/walk_finder/list_arrow_l.png" alt="앞 페이지" /></span>
                <div>
                    <span>1</span>
                    <span>2</span>
                    <span>3</span>
                    <span>4</span>
                    <span>5</span>
                    <span>6</span>
                    <span>7</span>
                    <span>8</span>
                    <span>9</span>
                    <span>10</span>
                </div>
                <span><img src="./image/walk_finder/list_arrow_r.png" alt="뒷 페이지" /></span>
            </div>
        </section>
        <!-- 산책로 목록 -->
        <section>
            <div class="walk_list">
                <!-- 각각 산책로 div -->
                <div class="walk_post">
                    <div class="walk_img"></div>
                    <div class="walk_info">
                        <div class="walk_info_like"><i class="fa-regular fa-heart"></i> 20</div>
                        <!-- <i class="fa-solid fa-heart"></i> 찜한 하트 -->
                        <div class="walk_info_name">두류공원 <span>성당동</span></div>
                        <div class="walk_info_link">위치 확인하기 >></div>
                    </div>
                </div>
                <!-- 각각 산책로 div -->
                <div class="walk_post">
                    <div class="walk_img"></div>
                    <div class="walk_info">
                        <div class="walk_info_like"><i class="fa-regular fa-heart"></i> 20</div>
                        <!-- <i class="fa-solid fa-heart"></i> 찜한 하트 -->
                        <div class="walk_info_name">두류공원 <span>성당동</span></div>
                        <div class="walk_info_link">위치 확인하기 >></div>
                    </div>
                </div>
                <!-- 각각 산책로 div -->
                <div class="walk_post">
                    <div class="walk_img"></div>
                    <div class="walk_info">
                        <div class="walk_info_like"><i class="fa-regular fa-heart"></i> 20</div>
                        <!-- <i class="fa-solid fa-heart"></i> 찜한 하트 -->
                        <div class="walk_info_name">두류공원 <span>성당동</span></div>
                        <div class="walk_info_link">위치 확인하기 >></div>
                    </div>
                </div>
                <!-- 각각 산책로 div -->
                <div class="walk_post">
                    <div class="walk_img"></div>
                    <div class="walk_info">
                        <div class="walk_info_like"><i class="fa-regular fa-heart"></i> 20</div>
                        <!-- <i class="fa-solid fa-heart"></i> 찜한 하트 -->
                        <div class="walk_info_name">두류공원 <span>성당동</span></div>
                        <div class="walk_info_link">위치 확인하기 >></div>
                    </div>
                </div>
                <!-- 각각 산책로 div -->
                <div class="walk_post">
                    <div class="walk_img"></div>
                    <div class="walk_info">
                        <div class="walk_info_like"><i class="fa-regular fa-heart"></i> 20</div>
                        <!-- <i class="fa-solid fa-heart"></i> 찜한 하트 -->
                        <div class="walk_info_name">두류공원 <span>성당동</span></div>
                        <div class="walk_info_link">위치 확인하기 >></div>
                    </div>
                </div>
                <!-- 각각 산책로 div -->
                <div class="walk_post">
                    <div class="walk_img"></div>
                    <div class="walk_info">
                        <div class="walk_info_like"><i class="fa-regular fa-heart"></i> 20</div>
                        <!-- <i class="fa-solid fa-heart"></i> 찜한 하트 -->
                        <div class="walk_info_name">두류공원 <span>성당동</span></div>
                        <div class="walk_info_link">위치 확인하기 >></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include "footer.php" ?>
</body>

</html>