<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- css -->
    <link rel="stylesheet" href="./css/index.css" />
    <!-- js -->
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/script.js"></script>
    <!-- 프로젝트 명 -->
    <title>마실가까</title>
</head>

<body>
    <main>
        <?php include "header.php";?>
        <!-- PC모드 메인 -->
        <div class="mainContentsWrap">
            <div class="mainContetnsBtn">
                <a href="">
                    <img src="./image/index/main_dulyu.png" alt="두류">
                </a>
                <a href="">
                    <img src="./image/index/main_beomeo.png" alt="범어">
                </a>
                <a href="">
                    <img src="./image/index/main_apsan.png" alt="앞산">
                </a>
                <a href="">
                    <img src="./image/index/main_sinam.png" alt="신암">
                </a>
                <a href="">
                    <img src="./image/index/main_chimsan.png" alt="침산">
                </a>
            </div>
            <div class="mainContents"><img src="./image/index/main_back.png" alt=""></div>
        </div>
        <!-- 상단 추천 산책로 섹션  -->
        <section class="sectionTop">
            <div class="contentWrap">
                <!-- 산책로 나열 -->
                <div class="contentInnerWrap">
                    <div class="recommend">

                        <div>추천</div>
                        <div>산책로</div>
                    </div>
                    <div class="cardWrap">
                        <div class="cardInnerWrap">
                            <a href="" class="cardLink">
                                <div class="card">
                                    <div class="cardTitle">어디공원</div>
                                    <div class="cardPlace">어디동</div>
                                </div>
                            </a>
                        </div>
                        <div class="cardInnerWrap">
                            <a href="" class="cardLink">
                                <div class="card">
                                    <div class="cardTitle">어디공원</div>
                                    <div class="cardPlace">어디동</div>
                                </div>
                            </a>
                        </div>
                        <div class="cardInnerWrap third">
                            <a href="" class="cardLink">
                                <div class="card">
                                    <div class="cardTitle">어디공원</div>
                                    <div class="cardPlace">어디동</div>
                                </div>
                            </a>
                        </div>

                        <div class="cardInnerWrap last">
                            <a href="" class="cardLink">
                                <div class="card">
                                    <div class="cardTitle">어디공원</div>
                                    <div class="cardPlace">어디동</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- 줄 -->
        <div class="sectionLine"></div>
        <!-- 하단 메뉴 섹션  -->
        <section class="sectionBottomWrap">
            <div class="sectionBottom">
                <div class="sectionBottomInnerWrap">
                    <a href="./walk_correctly.php" class="infoWrap">
                        <div class="info">
                            <div class="infoImg"><img src="./image/index/walk1.png" alt=""></div>
                            <div class="infoText">
                                <div>바르게 걷기</div>
                            </div>
                        </div>
                    </a>
                    <a href="./walk_finder.php" class="infoWrap">
                        <div class="info">
                            <div class="infoImg"><img src="./image/index/walk2.png" alt=""></div>
                            <div class="infoText">
                                <div>산책길 찾기</div>
                            </div>
                        </div>
                    </a>
                    <a href="./walk_my.php" class="infoWrap">
                        <div class="info">
                            <div class="infoImg"><img src="./image/index/walk3.png" alt=""></div>
                            <div class="infoText">
                                <div>My 산책길</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>

    </main>

    <?php include "footer.php" ?>
</body>

</html>