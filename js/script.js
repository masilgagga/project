document.addEventListener("DOMContentLoaded", () => {
  let links = document.querySelectorAll(".walk_post");
  links.forEach((link) => {
    link.addEventListener("click", () => {
      window.location.href = "./walk_info.php";
    });
  });
});
