<?php
// 상수 선언
include "../config/const.php";

session_start();

// 네이버에서 보내준 AUTHORIZE_CODE 값
$code = $_GET['code'];

// 네이버 토큰을 발급받기 위한 Url
$tokenRequestUrl = "https://nid.naver.com/oauth2.0/token";

// 네이버 토큰을 발급받기 위해 전송할 데이터 값
$data = [
    'grant_type' => 'authorization_code', // 발급이라면 authorization_code 입력
    'client_id' => NAVER_API, // 네이버 client_id
    'client_secret' => NAVER_SECRET, // 네이버 client_secret 값
    'code' => $code, // 네이버 로그인 후 전송받은 code 파라미터 값
    'state' => 'RAMDOM_STATE' // login 링크에 넣은 state 값과 동일하게 입력
];

// 토큰을 발급받기 위해 fetch 실행
$token = fetch($tokenRequestUrl, $data);

// 프로필 정보를 가져오기 위한 토큰 저장 (access_token)
$accessToken = $token['access_token'];

// 프로필 정보를 요청하기 위한 url
$profileRequestUrl = "https://openapi.naver.com/v1/nid/me";

// 프로필 정보를 요청하기 위해 셋팅할 헤더값
$profileRequestHeader = [
    "Authorization: Bearer {$accessToken}"
];

// 프로필 정보를 요청하기 위한 본문 값
$profileRequestData = [];

// 셋팅한 값으로 프로필 정보를 요청
$profile = fetch($profileRequestUrl, $profileRequestData, $profileRequestHeader);

$socialId = $profile['response']['id'];
$name = $profile['response']['name'];
$email = $profile['response']['email'];
$photo = $profile['response']['profile_image'];
$socialType = "NAVER";

// 소셜가입 된 이메일을 기반으로, DB에 중복되는 계정이 있는지 확인


// 소셜로그인 패스워드 강제 생성
$socialPass = $socialType.$socialId;

// 동일한 소셜로그인 체크 쿼리 질의문
$idCheckQuery = "SELECT * FROM member WHERE id='{$socialId}' AND social_type='{$socialType}'" ;

// 소셜로그인 체크 쿼리 실행
$result = mysqli_query(DBCON, $idCheckQuery);

// 소셜로그인 체크 쿼리 결과값 저장
$row = mysqli_fetch_array($result);

// 소셜로그인 회원일 경우
if($row){
    // 세션을 사용할 경우 제일 상단에 session_start(); 선언
    $_SESSION['memberNum'] = $row['member_num'];

    echo "<script>";
    echo "window.location.href='../config/main.php';";
    echo "</script>";
    exit;
// 소셜 가입된 이력이 없음
}else{
    date_default_timezone_set('Asia/Seoul'); // 기준 시간 설정 (ini 파일을 변경하는 방법도 있음)
    $date = date("Y-m-d H:i:s"); // 현재 시간

    // 회원 DB에 소셜 회원으로 가입시키기 위한 쿼리문 생성
    $idInsertQuery = "INSERT INTO member(
        id,
        name,
        email,
        photo,
        created_at,
        social_type,
        member_grade
    ) VALUES (
        '{$socialId}',
        '{$name}',
        '{$email}',
        '{$photo}',
        '{$date}',
        '{$socialType}',
        0
    )";

    // 지정된 쿼리문 실행
    $result = mysqli_query(DBCON, $idInsertQuery);
    
    // 지정된 회원정보를 가져오기 위한 회원정보 질의
    $idCheckQuery = "SELECT * FROM member WHERE id='{$socialId}' AND social_type='{$socialType}'";

    // 생성한 쿼리 질의를 디비에 실행
    $result = mysqli_query(DBCON, $idCheckQuery);

    // 실행한 쿼리문 결과를 변수에 저장
    $row = mysqli_fetch_array($result);
    
    $_SESSION['memberNum'] = $row['member_num'];

    echo "<script>";
    echo "alert('회원가입이 완료되었습니다');";
    echo "window.location.href='../config/main.php';";
    echo "</script>";
}

function fetch($url,$bodyData,$header = array())
{
    $ch = curl_init();

    $body = json_encode($bodyData);

    $bodyString = http_build_query($bodyData);
    $returnUrl = $url."?".$bodyString;

    // url 지정
    curl_setopt($ch,CURLOPT_URL,$returnUrl);
    // post로 전송
    curl_setopt($ch,CURLOPT_POST,true); 
    // 전송할 body값 입력
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    // 문자열로 변환
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    // header 입력
    curl_setopt($ch,CURLOPT_HTTPHEADER,$header);

    // curl 실행
    $response = curl_exec($ch);
    // CommonMethod::alert($response);
    // 응답받은 json 디코딩
    $data = json_decode($response,true);

    return $data;
}
?>