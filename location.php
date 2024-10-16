<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- css -->
    <link rel="stylesheet" href="./css/locationStyle.css" />

    <!-- js -->
    <!-- <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/script.js"></script> -->
    <!-- 프로젝트 명 -->
    <title>마실가까</title>
  </head>
  <body>
    <main>
      <header>
        <div class="headerWrapLeft">
          <div class="headerInnerWrap">
            <a href="./location.php">
              <div>마실가까</div>
            </a>
          </div>
        </div>
        <div class="headerWrapCenter">
          <div class="headerInnerWrapTop">
            <div><a href="#">산책은?</a></div>
            <div><a href="#">산책길 찾기</a></div>
            <div><a href="#">내 산책로</a></div>
          </div>
        </div>
        <div class="headerWrapRight">
          <div class="headerInnerWrapTop">
            <a class="loginText" href="#"><div>로그인</div></a>

            <a class="account" href="#"><div>아이콘</div></a>
          </div>
        </div>
      </header>
      <section class="locationSectionTop">
        <div class="searchFormContentWrap">
          <div class="block"></div>
          <div class="searchPlaceWrap">
            <div class="searchPlace">
              <div class="searchTitle">
                <div class="searchTitleText">
                  산책길 찾기
                </div>
              </div>
              <div class="searchBoxWrap">
                <form class="searchBox">
                <label for="options1">읍/면/동</label>
        <select id="options1" name="options1">
            <option value="option1">옵션 1</option>
            <option value="option2">옵션 2</option>
            <option value="option3">옵션 3</option>
           
        </select>
        <label for="options2">포장유무</label>
        <select id="options2" name="options2">
            <option value="pave1">포장</option>
            <option value="pave2">복합</option>
        </select>

        <label for="options3">구간 난이도</label>
        <select id="options3" name="options3">
            <option value="difficulty1">상</option>
            <option value="difficulty2">중</option>
            <option value="difficulty3">하</option>
          
        </select>
        <button type="submit">찾기</button>
                </form>
              </div>
            </div>
          </div>
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
<!--  결과 체크 및 출력 -->
<div class="searchContentsWrap">

<!--  페이지네이션 -->

 <?php # echo '<div class="pagination">';
# for ($page = 1; $page <= $total_pages; $page++) {
 #   if ($page == $current_page) {
  #      echo "<strong>$page</strong> "; // 현재 페이지 강조
   # } else {
   #     echo "<a href='?page=$page'>$page</a> "; // 페이지 링크
   # }
#}

# echo '</div>'  ?>
<!-- 페이지 -->
<div class="pagination">
<a href="">
        <img src="" alt="#">
      </a>
    <?php
    $total_pages = ceil($total_items / $items_per_page); // 총 페이지 수

 

    // 페이지 링크 범위 설정
    $start_page = max(1, $current_page - 4); // 현재 페이지를 기준으로 시작 페이지
    $end_page = min($total_pages - 1, $start_page + 9); // 최대 10개 페이지 표시

    // 시작 페이지 조정
    if ($end_page - $start_page < 9) {
        $end_page = min($total_pages - 1, $start_page + 9);
        $start_page = max(2, $end_page - 9);
    }

    // 현재 페이지 주변의 페이지 링크 출력
    for ($page = $start_page; $page <= $end_page; $page++) {
        if ($page == $current_page) {
            echo "<strong>$page</strong> "; // 현재 페이지 강조
        } else {
            echo "<a href='?page=$page'>$page</a> "; // 페이지 링크
        }
    }

    ?>
      <a href="">
        <img src="" alt="#">
      </a>
</div>

      <!-- 모바일(숫자 5개씩) -->
    <?php /* echo '<div class="pagination">';
    $total_pages = ceil($total_items / $items_per_page); // 총 페이지 수

    // 페이지 링크 범위 설정
    $start_page = max(1, $current_page - 2); // 현재 페이지를 기준으로 시작 페이지 (2개 이전)
    $end_page = min($total_pages, $start_page + 4); // 최대 5개 페이지 표시

    // 시작 페이지 조정
    if ($end_page - $start_page < 4) {
        $start_page = max(1, $end_page - 4); // 시작 페이지 재조정
    }

    // 현재 페이지 주변의 페이지 링크 출력
    for ($page = $start_page; $page <= $end_page; $page++) {
        if ($page == $current_page) {
            echo "<strong>$page</strong> "; // 현재 페이지 강조
        } else {
            echo "<a href='?page=$page'>$page</a> "; // 페이지 링크
        }
    }
    
   echo '</div>'    */  ?>


<!-- 페이지 끝 -->

</section>
<section class="locationSectionBottom">
  <div class="bottomWrap">
   <div class="parkGrid">

<?php
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    ?>
     <a href="#" class="parkGridWrap">
         <div class="searchCardWrap" >
           <div class="searchCard">
             <div class="searchCardImg">
              <img src="#" alt="img">
             </div>
             <div class="searchCardTextWrap">  
              <div class="searchCardText">  
                 <div class="searchCardTitle">
              <?=   $row["location_name"]   // 필요한 필드로 변경 ?>
                 </div>
                 <div class="searchCardLocation">
                 <?=    $row["dong"]   ?>
                 </div>
               </div> 
                <div class="searchCardLocationText"> 
                '위치 확인하기'
               </div> 
             </div> 
           </div>
         </div>
       </a>
<?php
  } 
  ?>

<?php } else {
  echo "0 결과";
}
   echo '</div>';
  echo '</div>';
echo ' </section>';
// 연결 종료
$conn->close();
?>
  </div>
    

      <footer>foot</footer>
    </main>
  </body>
</html>
