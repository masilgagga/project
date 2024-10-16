<?php
// API URL
$url = "https://api.odcloud.kr/api/15109660/v1/uddi:a80ce332-255e-47fd-a47e-dc6406da10fd?perPage=500&serviceKey=yjMALbH4vnvOzANfViLdWXu8mRpGGUkk4ARXp8XJjLHvKeZjNv4ycD2tnn1TK8g7FW%2BQzAO2Lysm2rB5lIFu8Q%3D%3D";

// cURL 초기화
$ch = curl_init();

// 옵션 설정
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// API 호출 및 응답 저장
$response = curl_exec($ch);

// cURL 종료
curl_close($ch);

// 응답 출력
if ($response !== false) {
    echo $response;
} else {
    echo "API 호출에 실패했습니다.";
}
?>