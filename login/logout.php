<?php
// 로그인 여부 체크
include "login_check.php";

session_destroy();

echo "<script>";
echo "window.location.href='./login.php';";
echo "</script>";
exit;
?>