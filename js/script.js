$(function () {
  // 사이드바
  $(".account").click(function () {
    $(".sidebar").toggleClass("toggle");

    // 토글 상태에 따라 오버레이 표시
    if ($(".sidebar").hasClass("toggle")) {
      $(".overlay").fadeIn();
    } else {
      // 사이드바가 닫힐 때 opacity를 0으로 설정
      $(".overlay").fadeOut();
    }
  });

  // 오버레이 클릭 시 사이드바 닫기
  $(".overlay").click(function () {
    $(".sidebar").removeClass("toggle");
    $(".overlay").fadeOut();
  });
});
