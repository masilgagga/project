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
    $member_num = $_SESSION['memberNum'];
    $likeIcon = "";

    // 세션에 저장된 회원번호로 해당하는 회원정보 쿼리 질의
    // $memberInfoQuery = "SELECT * FROM member WHERE member_num = {$_SESSION['memberNum']}";
    // 회원정보 쿼리 질의를 실행
    // $result = mysqli_query($DBCON, $memberInfoQuery);
    // 실행한 결과값을 $member변수 값에 저장
    // $member = mysqli_fetch_array($result);
    // 회원의 아이디
    // $member_id = $member['id'];

    // 내 산책로 리스트를 가져올 쿼리
    $listQuery = "SELECT * FROM like_list WHERE member_num = '{$member_num}'";
    // 내 산책로 쿼리 질의를 실행
    $result = mysqli_query($DBCON, $listQuery);
    // 내 산책로 관리번호를 담을 배열
    $likeWalkNum = [];

    // 내 산책로 숫자만큼 반복하여 배열에 저장
    while($row = mysqli_fetch_array($result)){
        array_push($likeWalkNum, "'".$row['manage_num']."'");
    }

    // 내 산책로 관리번호를 문자열로 변환 ('관리번호','관리번호','관리번호'...)
    $likeList = implode(",", $likeWalkNum);

    // 내 산책로 리스트 정보을 담을 배열
    $likeWalk = [];
    ?>
    <div class="content wrap">
        <!-- 산책길 찾기 타이틀 -->
        <section>
            <!-- 타이틀 -->
            <div class="title_bg">
                <div class="title">My 산책길</div>
            </div>
        </section>
        <!-- 목록 페이지 번호 -->
        <?php

    // 회원이 선택한 내 산책로 리스트가 있다면 실행
    if($likeList){
        // 선택한 산책로 리스트를 모두 불러올 쿼리
        $walkQuery = "SELECT * FROM data WHERE manage_num IN ($likeList)";
            
        // 페이지 번호 설정
        $items_per_page = 6; // 한 페이지에 보여줄 항목 수
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($current_page - 1) * $items_per_page;
        
        // 총 데이터 수 가져오기
        $total_query = "SELECT COUNT(*) as total FROM data WHERE manage_num IN ($likeList)"; // 테이블 이름 확인
        $total_result = mysqli_query($DBCON, $total_query);
        $total_row = $total_result->fetch_assoc();
        $total_items = $total_row['total'];
        $total_pages = ceil($total_items / $items_per_page); // 총 페이지 수
        

        $walkQuery .= "   LIMIT $items_per_page OFFSET $offset"; // 테이블 이름 확인
        $result = mysqli_query($DBCON, $walkQuery);
        
        // 내 산책로 숫자만큼 반복하여 배열에 저장
        while($row = mysqli_fetch_array($result)){
            array_push($likeWalk, $row);
        }
        
        echo ("
        <section>
            <div class='page_num'>");

                // 페이지 링크 범위 설정
                $start_page = max(1, $current_page - 2); // 현재 페이지를 기준으로 2개 앞
                $end_page = min($total_pages, $current_page + 2); // 현재 페이지를 기준으로 2개 뒤

                // 시작 페이지 조정
                if ($end_page - $start_page < 4) {
                    if ($start_page === 1) {
                        $end_page = min(5, $total_pages); // 시작 페이지가 1이면 최대 5개 페이지 표시
                    } else {
                        $start_page = max(1, $end_page - 4); // 끝 페이지가 5보다 크면 시작 페이지 조정
                    }
                }

                // 이전 페이지 링크 (5씩 감소)
                if ($current_page > 5) {
                    echo "<a href='?page=" . ($current_page - 5) . "'><span><img src='./image/walk_my/my_arrow_l.png' alt='앞 페이지' /></span></a>";
                }else {
                    echo "<a href='?page=1'><span><img src='./image/walk_my/my_arrow_l.png' alt='앞 페이지' /></span></a>";
                }

                echo "<div>";

                // 현재 페이지 주변의 페이지 링크 출력
                for ($page = $start_page; $page <= $end_page; $page++) {
                    if ($page == $current_page) {
                        echo "<span class='active'>$page</span> "; // 현재 페이지 강조
                    } else {
                        echo "<a href='?page=$page'><span>$page</span></a> "; // 페이지 링크
                    }
                }

                echo "</div>";

            // 다음 페이지 링크 (5씩 증가)
            if ($current_page + 5 > $total_pages) {
            // 현재 페이지에서 5를 더한 값이 총 페이지 수를 초과하는 경우
                echo "<a href='?page=" . $total_pages . "'><span><img src='./image/walk_my/my_arrow_r.png' alt='마지막 페이지로 이동' /></span></a>";
            } else {
            // 다음 페이지로 이동
                echo "<a href='?page=" . ($current_page + 5) . "'><span><img src='./image/walk_my/my_arrow_r.png' alt='다음 페이지' /></span></a>";
            }
            echo ("</div>
        </section>");
        }
        ?>
        <!-- 산책로 목록 -->
        <section>
            <div class="walk_list">
                <?php
                if (count($likeWalk) > 0) {
                    $index = 0;
                    
                    foreach ($likeWalk as $num) {
                        $locationName = $num['location_name'];
                        $dong = $num['dong'];
                        $explanation = $num['explanation'];
                        $like_count = $num['like_count'];
                        $manage_num = $num['manage_num'];
                        
                        // 비로그인 상태
                        if(!isset($_SESSION['memberNum'])){
                            $likeIcon = "<i class='fa-regular fa-heart' onclick='login()'></i>";
                        }else{ // 로그인 상태
                            // 회원번호
                            $_SESSION['memberNum'];
                            
                            // 세션에 저장된 회원번호로 해당하는 회원정보 쿼리 질의
                            // $memberInfoQuery = "SELECT * FROM member WHERE member_num = {$_SESSION['memberNum']}";
                    
                            // 회원정보 쿼리 질의를 실행
                            // $memberResult = mysqli_query($DBCON, $memberInfoQuery);
                            // 실행한 결과값을 $member변수 값에 저장
                            // $member = mysqli_fetch_array($memberResult);
                            // 회원의 아이디
                            // $member_id = $member['id'];
                            
                            // 내 산책로에 정보가 있는지 확인
                            $likeSelectQuery = "SELECT * FROM like_list WHERE member_num = '{$member_num}' AND manage_num = '{$manage_num}'";
                            $likeResult = mysqli_query($DBCON, $likeSelectQuery);
                            $likeRow = mysqli_fetch_assoc($likeResult);
                    
                            // 내 산책로에 있다면
                            if($likeRow){
                                $likeIcon = "<span onclick='likeDelete(\"$manage_num\")'><i class='fa-solid fa-heart' title='내 산책길에서 삭제'></i> ".$num['like_count']."</span>";
                            }else{ //내 산책로에 없다면
                                $likeIcon = "<span onclick='likeInsert(\"$manage_num\")'><i class='fa-regular fa-heart' title='내 산책길에 추가'></i> ".$num['like_count']."</span>";
                            }
                        }
                ?>
                <!-- 각각 산책로 div -->
                <form id="walkInfo<?=$index?>" action="./walk_info.php" method="get">
                    <input type="hidden" value="<?= $manage_num ?>" name="manage_num">
                    <div class="walk_post">
                        <div class="walk_img" onclick="info(<?=$index?>)" title="산책길 정보보기"
                            style="background: url('./image/park_photo/<?=$num['park_manage_num']?>.jpg') center no-repeat; background-size: cover;">
                        </div>
                        <div class="walk_info">
                            <div class="walk_info_like"><?=$likeIcon?></div>
                            <div class="walk_info_name" onclick="info(<?=$index?>)" title="산책길 정보보기">
                                <div><?=$locationName?></div>
                                <span><?=$dong?></span>
                            </div>
                            <div class="walk_info_ex" onclick="info(<?=$index?>)" title="산책길 정보보기">
                                <?= $explanation ?></div>
                            <div class="walk_info_link" onclick="info(<?=$index?>)" title="산책길 정보보기">더 알아보기
                                <i class="fa-solid fa-arrow-right"></i>
                            </div>
                            </button>
                        </div>
                    </div>
                </form>
                <?php
                    $index++;
                    }
                }else{echo "<div class='wrap'>담아놓은 My 산책길이 없습니다.</div>";}
                ?>
            </div>
        </section>
    </div>
    <?php include "footer.php" ?>
    <script>
    function login() {
        alert('로그인이 필요합니다.');
        window.location.href = './walk_login.php';
    }

    function info(index) {
        document.getElementById('walkInfo' + index).submit();
    }

    function likeInsert(manage_num) {
        window.location.href = "./walk_my_insert.php?manage_num=" + manage_num;
    }

    function likeDelete(manage_num) {
        window.location.href = "./walk_my_delete.php?manage_num=" + manage_num;
    }
    </script>

</body>

</html>