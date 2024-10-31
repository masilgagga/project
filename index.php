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

<body style="overflow-x: hidden">
    <main>
        <?php include "header.php";?>
        <!-- PC모드 메인 -->
        <div class="mainContentsWrap">
            <div class="mainContetnsBtn">
                <a href="./walk_info.php?manage_num=27290-00179-03-001">
                    <img src="./image/index/main_dulyu.png" alt="두류">
                </a>
                <a href="./walk_info.php?manage_num=27260-00072-03-001">
                    <img src="./image/index/main_beomeo.png" alt="범어">
                </a>
                <a href="./walk_info.php?manage_num=27200-00029-03-001">
                    <img src="./image/index/main_apsan.png" alt="앞산">
                </a>
                <a href="./walk_info.php?manage_num=27140-00001-03-001">
                    <img src="./image/index/main_sinam.png" alt="신암">
                </a>
                <a href="./walk_info.php?manage_num=27230-00001-03-001">
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
                        <div>추천&nbsp;</div>
                        <div>산책길</div>
                    </div>
                    <div class="cardWrap">
                        <div class="cardInnerWrap">
                            <a href="./walk_info.php?manage_num=27290-00179-03-001" class="cardLink">
                                <div class="card">
                                    <div class="cardTitle">두류공원</div>
                                    <div class="cardPlace">성당동</div>
                                </div>
                            </a>
                        </div>
                        <div class="cardInnerWrap">
                            <a href="./walk_info.php?manage_num=27260-00072-03-001" class="cardLink">
                                <div class="card">
                                    <div class="cardTitle">범어공원</div>
                                    <div class="cardPlace">황금1동</div>
                                </div>
                            </a>
                        </div>
                        <div class="cardInnerWrap third">
                            <a href="./walk_info.php?manage_num=27230-00001-03-001" class="cardLink">
                                <div class="card">
                                    <div class="cardTitle">침산공원</div>
                                    <div class="cardPlace">침산1동</div>
                                </div>
                            </a>
                        </div>

                        <div class="cardInnerWrap last">
                            <a href="./walk_info.php?manage_num=27200-00029-03-001" class="cardLink">
                                <div class="card">
                                    <div class="cardTitle">앞산공원</div>
                                    <div class="cardPlace">대명9동</div>
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
                    <a href="./walk_event.php" class="infoWrap">
                        <div class="info">
                            <div class="infoImg"><img src="./image/index/walk4.png" alt=""></div>
                            <div class="infoText">
                                <div>산책길 Event</div>
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