<?php
$DBCON = mysqli_connect('localhost', 'zinee', 'tmakxmdnpqdoq5!', 'zinee');
// define('$DBCON', mysqli_connect('192.168.0.68', 'zinee', 'tmakxmdnpqdoq5!', 'zinee'));
define('KAKAO_API','8f85f03110bc90298656843bc90d610b');
define('NAVER_API','VFLcg6_eRDHpMF_apBzQ');
define('NAVER_SECRET','MXZZ1J0H1D');
define('KAKAO_REDIRECT_URI','http://localhost/project_1/login/login_kakao.php');
define('NAVER_REDIRECT_URI','http://localhost/project_1/login/login_naver.php');
// define('KAKAO_REDIRECT_URI','http://zinee.dothome.co.kr/project_1/login/login_kakao.php');
// define('NAVER_REDIRECT_URI','http://zinee.dothome.co.kr/project_1/login/login_naver.php');
define('KAKAO_MAP_API','50166727d5578945598d30faa7d31dd4');

?>