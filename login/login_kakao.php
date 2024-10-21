<?php
// 상수 선언
include "../config/const.php";

session_start();

// 카카오톡에서 보내준 AUTHORIZE_CODE 값
$code = $_GET['code'];
// code = AUTHORIZE_CODE

//카카오톡에 토큰을 받기위해 요청해야할 URL
$tokenRequestUrl = "https://kauth.kakao.com/oauth/token";

// 카카오톡에 토큰을 받기위해 요청해야 할 데이터
$data = [
    'grant_type' => 'authorization_code', // 고정값
    'client_id' => KAKAO_API, // 카카오톡 API 키 값
    'redirect_uri' => KAKAO_REDIRECT_URI, // 카카오톡에 등록한 redirect_url 값
    'code' => $code //카카오톡에 로그인 후 보내주는 AUTHORIZE_CODE 값
];

// 카카오톡에 셋팅된 값을 통해 토큰값을 요청
$token = fetch($tokenRequestUrl,$data);

// 카카오톡에서 보내주는 access_token값, 이후 사용자 정보 가져올 때 사용할 값
$accessToken = $token['access_token'];

// 카카오톡 로그아웃을 위한 카카오톡 토큰을 세션에 저장
$_SESSION['KAKAO_ACCESS_TOKEN'] = $accessToken;

// 카카오톡 로그인 프로필 정보를 가져오기 위한 url
$profileRequestUrl = "https://kapi.kakao.com/v2/user/me";

// 카카오톡 로그인 프로필 정보를 가져오기 위해 전송할 헤더값
$header = [
    "Authorization: Bearer {$accessToken}"
];

// 카카오톡 로그인 프로필 정보를 가져오기 위해 전송할 본문값
$data = [];

$profile = fetch($profileRequestUrl,$data,$header);

$socialId = $profile['id'];
$name = $profile['properties']['nickname'];
$email = $profile['kakao_account']['email'];
$photo = $profile['properties']['thumbnail_image'];
$socialType = 'KAKAO';

// 소셜 가입 된 이력을 확인하기 위한 쿼리질의
$idCheckQuery = "SELECT * FROM member WHERE id='{$socialId}' AND social_type='{$socialType}'";

// 연결한 DB에 해당하는 쿼리 질의 실행
$result = mysqli_query(DBCON, $idCheckQuery);

// 쿼리 질의 실행한 결과 값
$row = mysqli_fetch_array($result);

// 소셜 가입된 이력이 있음
if($row){
    $_SESSION['memberNum'] = $row['member_num'];

    echo "<script>";
    echo "window.location.href='../index.php';";
    echo "</script>";
    exit;
    
// 소셜 가입된 이력이 없음
}else{
    date_default_timezone_set('Asia/Seoul'); // 기준 시간 설정 (ini 파일을 변경하는 방법도 있음)
    $date = date("Y-m-d H:i:s"); // 현재 시간

    // 회원가입을 시키기 위한 질의
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
    
    // 연결한 DB에 해당하는 쿼리 질의 실행
    $result = mysqli_query(DBCON,$idInsertQuery);
    
    // 소셜 가입 된 이력을 확인하기 위한 쿼리질의
    $idCheckQuery = "SELECT * FROM member WHERE id='{$socialId}' AND social_type='{$socialType}'";

    // 생성한 쿼리 질의를 디비에 실행
    $result = mysqli_query(DBCON, $idCheckQuery);

    // 쿼리 질의 실행 결과값을 변수에 삽입
    $row = mysqli_fetch_array($result);
    
    $_SESSION['memberNum'] = $row['member_num'];

    echo "<script>";
    echo "alert('회원가입이 완료되었습니다');";
    echo "window.location.href='../index.php';";
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