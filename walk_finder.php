<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/walk_finder.css" />
    <title>마실가까</title>
    <script src="https://kit.fontawesome.com/d035e75539.js" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
</head>

<body>
    <?php include "header.php";?>
    <div class="content wrap">
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
                                    <option value="">전체</option>
                                </select>
                            </div>
                        </div>
                        <!-- 포장 유무 -->
                        <div>
                            <div class="select_title">포장 유무</div>
                            <div>
                                <select name="" id="">
                                    <option value="">전체</option>
                                </select>
                            </div>
                        </div>
                        <!-- 구간 난이도 -->
                        <div>
                            <div class="select_title">구간 난이도</div>
                            <div>
                                <select name="" id="">
                                    <option value="">전체</option>
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
        <?php
// 데이터베이스 정보
$host = '192.168.0.68';
$db = 'zinee'; // 실제 데이터베이스 이름으로 변경
$user = 'zinee'; // 사용자 이름
$pass = 'tmakxmdnpqdoq5!'; // 비밀번호

// 데이터베이스 연결
$conn = new mysqli($host, $user, $pass, $db);

// 연결 체크
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// 페이지 번호 설정
$items_per_page = 6; // 한 페이지에 보여줄 항목 수
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// 총 데이터 수 가져오기
$total_query = "SELECT COUNT(*) as total FROM data"; // 테이블 이름 확인
$total_result = $conn->query($total_query);
$total_row = $total_result->fetch_assoc();
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $items_per_page); // 총 페이지 수

// SQL 쿼리 (OFFSET 사용)
$sql = "SELECT * FROM data LIMIT $items_per_page OFFSET $offset"; // 테이블 이름 확인
$result = $conn->query($sql);
?>
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
            echo "<a href='?page=" . ($current_page - 5) . "'><span><img src='./image/walk_finder/list_arrow_l.png' alt='앞 페이지' /></span></a>";
        }else {
            echo "<a href='?page=" . ($current_page = 1) . "'><span><img src='./image/walk_finder/list_arrow_l.png' alt='앞 페이지' /></span></a>";
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
        echo "<a href='?page=" . $total_pages . "'><span><img src='./image/walk_finder/list_arrow_r.png' alt='마지막 페이지로 이동' /></span></a>";
    } else {
    // 다음 페이지로 이동
        echo "<a href='?page=" . ($current_page + 5) . "'><span><img src='./image/walk_finder/list_arrow_r.png' alt='다음 페이지' /></span></a>";
    }
        ?>
    </div>
</section>

<!-- 산책로 목록 -->
<section>
    <div class="walk_list">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <!-- 각각 산책로 div -->
                <div class="walk_post">
                    <div class="walk_img"></div>
                    <div class="walk_info">
                        <div class="walk_info_like"><i class="fa-regular fa-heart"></i> 20</div>
                        <div class='walk_info_name'><?= $row['location_name'] ?> <span><?= $row['dong'] ?></span></div>
                        <div class="walk_info_link">위치 확인하기 >></div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</section>
</div>
    <?php include "footer.php" ?>
</body>

</html>