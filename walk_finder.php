<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/walk_finder.css" />
    <title>마실가까</title>
    <script src="https://kit.fontawesome.com/d035e75539.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="./js/script.js"></script>
</head>

<body>
    <?php include "./header.php";

    // 내 산책길 아이콘 변수
    $likeIcon = "";
    
    // DB 연결을 상수 파일에 넣은 변수로 한 상태
    // 필터링을 위한 GET 변수 설정
    $dongFilter = isset($_GET['dong']) ? mysqli_real_escape_string($DBCON, $_GET['dong']) : '';
    $surfaceFilter = isset($_GET['surface']) ? mysqli_real_escape_string($DBCON, $_GET['surface']) : '';
    $difficultyFilter = isset($_GET['difficulty']) ? mysqli_real_escape_string($DBCON, $_GET['difficulty']) : '';
    $gongFilter = isset($_GET['location_name']) ? mysqli_real_escape_string($DBCON, $_GET['location_name']) : '';

    // 콤보박스에 넣을 데이터
    $valuesSql = "SELECT DISTINCT dong, pave, level, location_name FROM data";
    $valuesResult = mysqli_query($DBCON, $valuesSql);

    // 데이터를 넣을 배열 선언
    $dongSet = [];
    $surfaceSet = [];
    $difficultySet = [];
   

    // 중복되는 데이터를 필터링
    while ($row = mysqli_fetch_assoc($valuesResult)) {
        if (!in_array($row['dong'], $dongSet)) {
            $dongSet[] = $row['dong'];
        }
        if (!in_array($row['pave'], $surfaceSet)) {
            $surfaceSet[] = $row['pave'];
        }
        if (!in_array($row['level'], $difficultySet)) {
            $difficultySet[] = $row['level'];
        }
       
    }


    // 총 데이터 수 가져오기
    $total_query = "SELECT COUNT(*) as total FROM data WHERE 1=1";
    if ($dongFilter) {
        $total_query .= " AND dong = '$dongFilter'";
    }
    if ($surfaceFilter) {
        $total_query .= " AND pave = '$surfaceFilter'";
    }
    if ($difficultyFilter) {
        $total_query .= " AND level = '$difficultyFilter'";
    }
   
       // SQL 쿼리 (OFFSET 사용)
       $sql = "SELECT * FROM data WHERE 1=1";
       if ($dongFilter) {
           $sql .= " AND dong = '$dongFilter'";
       }
       if ($surfaceFilter) {
           $sql .= " AND pave = '$surfaceFilter'";
       }
       if ($difficultyFilter) {
           $sql .= " AND level = '$difficultyFilter'";
       }

    
    // 페이지 번호 설정
    $items_per_page = 6; // 한 페이지에 보여줄 항목 수
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($current_page - 1) * $items_per_page;   

    $total_result = $DBCON->query($total_query);
    $total_row = $total_result->fetch_assoc();
    $total_items = $total_row['total'];
    $total_pages = ceil($total_items / $items_per_page); // 총 페이지 수
  
    $sql .= " LIMIT $items_per_page OFFSET $offset"; // 테이블 이름 확인
    $result = $DBCON->query($sql);
    ?>

    <div class="content wrap">
        <!-- 산책길 찾기 타이틀 & 셀렉트 검색 -->
        <section>
            <!-- 타이틀 -->
            <div class="title_bg">
                <div class="title">산책길 찾기</div>
            </div>
            <!-- 셀렉트 검색 -->
            <div class="search_box">
                <form class="select" method="GET">
                    <div class="select_box">
                        <!-- 읍면동 -->
                        <div>
                            <div class="select_title">읍 / 면 / 동</div>
                            <div>
                                <select name="dong">
                                    <option value="">전체</option>
                                    <?php
                                    foreach ($dongSet as $d) {
                                        echo '<option value="' . htmlspecialchars($d) . '" ' . ($dongFilter === $d ? 'selected' : '') . '>' . htmlspecialchars($d) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- 포장 유무 -->
                        <div>
                            <div class="select_title">포장 유무</div>
                            <div>
                                <select name="surface">
                                    <option value="">전체</option>
                                    <?php
                                    foreach ($surfaceSet as $s) {
                                        echo '<option value="' . htmlspecialchars($s) . '" ' . ($surfaceFilter === $s ? 'selected' : '') . '>' . htmlspecialchars($s) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- 구간 난이도 -->
                        <div>
                            <div class="select_title">구간 난이도</div>
                            <div>
                                <select name="difficulty">
                                    <!-- sql에서 정렬이 잘 안 되서 직접 생성함 -->
                                    <option value="">전체</option>
                                    <option value="상">상</option>
                                    <option value="중">중</option>
                                    <option value="하">하</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div>
                        <!-- 찾기 버튼 -->
                        <div class="find_btn">
                            <button type="submit">찾기</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <!-- 결과 체크 및 출력 -->
        <section>
            <div class="page_num">
                <?php
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
                    echo "<a href='?page=" . ($current_page - 5) . "&dong=$dongFilter&surface=$surfaceFilter&difficulty=$difficultyFilter'><span><img src='./image/walk_finder/list_arrow_l.png' alt='앞 페이지' /></span></a>";
                } else {
                    echo "<a href='?page=1&dong=$dongFilter&surface=$surfaceFilter&difficulty=$difficultyFilter'><span><img src='./image/walk_finder/list_arrow_l.png' alt='앞 페이지' /></span></a>";
                }

                echo "<div>";

                // 현재 페이지 주변의 페이지 링크 출력
                for ($page = $start_page; $page <= $end_page; $page++) {
                    if ($page == $current_page) {
                        echo "<span class='active'>$page</span> "; // 현재 페이지 강조
                    } else {
                        echo "<a href='?page=$page&dong=$dongFilter&surface=$surfaceFilter&difficulty=$difficultyFilter'><span>$page</span></a> "; // 페이지 링크
                    }
                }

                echo "</div>";

                // 다음 페이지 링크 (5씩 증가)
                if ($current_page + 5 > $total_pages) {
                    // 현재 페이지에서 5를 더한 값이 총 페이지 수를 초과하는 경우
                    echo "<a href='?page=$total_pages&dong=$dongFilter&surface=$surfaceFilter&difficulty=$difficultyFilter'><span><img src='./image/walk_finder/list_arrow_r.png' alt='마지막 페이지로 이동' /></span></a>";
                } else {
                    // 다음 페이지로 이동
                    echo "<a href='?page=" . ($current_page + 5) . "&dong=$dongFilter&surface=$surfaceFilter&difficulty=$difficultyFilter'><span><img src='./image/walk_finder/list_arrow_r.png' alt='다음 페이지' /></span></a>";
                }
                ?>
            </div>
        </section>

        <!-- 산책로 목록 -->
        <section>
            <div class="walk_list">
                <?php
                if ($result->num_rows > 0) {
                    $index = 0;
                    while ($row = $result->fetch_assoc()) {
                        $manage_num = $row['manage_num'];
                        
                        // 비로그인 상태
                        if(!isset($_SESSION['memberNum'])){
                            $likeIcon = "<i class='fa-regular fa-heart' onclick='login()'></i>";
                        }else{ // 로그인 상태
                            // 회원번호
                            $_SESSION['memberNum'];
                            
                            // 세션에 저장된 회원번호로 해당하는 회원정보 쿼리 질의
                            $memberInfoQuery = "SELECT * FROM member WHERE member_num = {$_SESSION['memberNum']}";
                    
                            // 회원정보 쿼리 질의를 실행
                            $memberResult = mysqli_query($DBCON, $memberInfoQuery);
                            // 실행한 결과값을 $member변수 값에 저장
                            $member = mysqli_fetch_array($memberResult);
                            // 회원의 아이디
                            $member_id = $member['id'];
                            
                            // 내 산책로에 정보가 있는지 확인
                            $likeSelectQuery = "SELECT * FROM like_list WHERE id = '{$member_id}' AND manage_num = '{$manage_num}'";
                            $likeResult = mysqli_query($DBCON, $likeSelectQuery);
                            $likeRow = mysqli_fetch_assoc($likeResult);
                    
                            // 내 산책로에 있다면
                            if($likeRow){
                                $likeIcon = "<i class='fa-solid fa-heart' onclick='likeDelete(\"$manage_num\")'></i>";
                            }else{ //내 산책로에 없다면
                                $likeIcon = "<i class='fa-regular fa-heart' onclick='likeInsert(\"$manage_num\")'></i>";
                            }
                        }
                    ?>
                <!-- 각각 산책로 div -->
                <div class="walk_post">
                    <div class="walk_img"
                        style="background: url('./image/park_photo/<?=$row['park_manage_num']?>.jpg') center no-repeat; background-size: cover;">
                    </div>
                    <div class="walk_info">
                        <div class="walk_info_like"><?=$likeIcon?> <?= htmlspecialchars($row['like_count']) ?></div>
                        <form id="walkInfo<?=$index?>" action="./walk_info.php" method="get">
                            <input type="hidden" value="<?= $manage_num ?>" name="manage_num">
                            <button type="button" onclick="document.getElementById('walkInfo<?=$index?>').submit()">
                                <div class='walk_info_name'>
                                    <div><?= htmlspecialchars($row['location_name']) ?></div>
                                    <span><?= htmlspecialchars($row['dong']) ?></span>
                                </div>
                                <div class="walk_info_link">더 알아보기</div>
                            </button>
                        </form>
                    </div>
                </div>
                <?php
                    $index++;
                    }
                } else { echo "<div>검색 결과가 없습니다.</div>";}
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

    function likeInsert(manage_num) {
        window.location.href = "./walk_my_insert.php?manage_num=" + manage_num;
    }

    function likeDelete(manage_num) {
        window.location.href = "./walk_my_delete.php?manage_num=" + manage_num;
    }
    </script>
</body>

</html>