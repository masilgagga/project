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

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- css -->
    <link rel="stylesheet" href="./css/index/header.css" />
    <link rel="stylesheet" href="./css/index/index.css" />
    <link rel="stylesheet" href="./css/index/footer.css" />
    <link rel="stylesheet" href="./css/index/side_bar.css" />

    <!-- js -->
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/script.js"></script>
    <!-- 프로젝트 명 -->
    <title>마실가까</title>
  </head>
  <body>
    <div class="overlay"></div>
    <main>
      <header>
        <div class="headerWrapLeft">
          <div class="headerInnerWrap">
            <a href="#">
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

            <a class="account" href="#">아이콘 </a>
          </div>
        </div>
      </header>
      <!-- PC모드 메인 -->
      <div class="mainContentsWrap">
        <div class="mainContents"></div>
      </div>
      <!-- 상단 추천 산책로 섹션  -->
      <section class="sectionTop">
        <div class="contentWrap">
          <!-- 산책로 나열 -->
          <div class="contentInnerWrap">
            <div class="recommend">
              <div class="check">svg</div>
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
            <a href="" class="infoWrap">
              <div class="info">
                <div class="infoText">
                  <div>바르게</div>
                  <div>걷기</div>
                </div>
              </div>
            </a>
            <a href="" class="infoWrap">
              <div class="info">
                <div class="infoText">
                  <div>산책길</div>
                  <div>찾기</div>
                </div>
              </div>
            </a>
            <a href="" class="infoWrap">
              <div class="info">
                <div class="infoText">
                  <div>My</div>
                  <div>산책길</div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </section>
      <footer>foot</footer>
    </main>
    <!-- 사이드바 -->

    <div class="sidebar">
      <div class="userInfoWrap">
        <div class="userInfo">
          <div class="userIcon">
            <img src="" alt="아이콘" />
          </div>
          <div class="userText">
            <div class="userName">test Id</div>
            <a href="" class="logout">
              <div>로그아웃</div>
            </a>
          </div>
        </div>
      </div>
      <ul>
        <a href=""><li>바르게 걷기</li></a>
        <a href=""><li>산책길 찾기</li></a>
        <a href=""><li>My 산책길</li></a>
      </ul>
    </div>
  </body>
</html>
