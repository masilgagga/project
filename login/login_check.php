<?php
session_start();

// 비로그인 상태
if(!$_SESSION['memberNum']){
    echo "<script>";
    echo "alert('로그인이 필요합니다.');";
    echo "window.location.href='./login.php';";
    echo "</script>";
    exit;
}
?>