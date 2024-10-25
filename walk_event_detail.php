<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/walk_event_detail.css" />
  </head>
  <body>
  <?php include "header.php"; ?>
    <div class="e_conteiner">
      <div class="e_tap">
        <a href="./walk_event.php">진행중인 이벤트</a>
        <a href="">종료된 이벤트</a>
      </div>
      <div class="e_detail_conteiner">
        <div class="e_detail">
          <img src="./image/walk_event/event_contents1.jpg" alt="" />
          <img src="./image/walk_event/event_contents2.jpg" alt="" />
        </div>
      </div>
      <!-- DB 데이터 받아오기 -->
    <?php 
           $Sql = "SELECT a.content,a.regist_day,a.comment_num, b.name,b.photo,b.member_num
           FROM comment a
           INNER JOIN member b
           ON a.member_num = b.member_num;";

            $con = mysqli_query($DBCON, $Sql);
            $conSql = "SELECT count(*)  FROM comment WHERE type='instar'";

           $contentSet = mysqli_query($DBCON, $conSql);
          $contents= mysqli_fetch_row($contentSet);
          
    ?>

      <div class="comment_conteiner">
       <!-- 댓글 작성 영역  -->
       <form action="./walk_comment_insert.php" method="post">
       <div>댓글 총 <span style="color: red"><?=$contents[0]?></span>개</div>
       <?php 
        // 로그인 상태 확인
        if (isset($_SESSION['memberNum']) && $_SESSION['memberNum']) {
        ?>
        <div class="comment_write">
        <textarea name="content"  placeholder="댓글을 작성하세요." ></textarea>
        <input type="hidden" name="memberNum" value="<?=$_SESSION['memberNum']?>">
        <button type="submit">제출</button>
        </div>
        <?php 
        } else { 
        ?><div class="comment_write">
       <textarea name="content"  placeholder="로그인이 필요합니다." disabled></textarea>
       <button type="button" disabled>제출</button>
       </div>     
        <?php 
        } 
        ?>
        </form>
            <!-- 댓글 영역 -->
        <div class="comments">
          <?php
          if ($con && $con->num_rows > 0){
            while ($row = $con->fetch_assoc()) {
          ?>
          <form class="comment"  action="./walk_comment_delete.php" method="post">
            <div class="user_img">
              <img src="<?=$row['photo'];?>" alt="userImg" />
            </div>
            <div class="comment_text">
              <div class="user_name">
                <span class="user_id"><b><?=$row['name'];?></b></span>
                <span class="write_day"><?=$row['regist_day'];?></span>
                <input type="hidden" name="comment_num" value="<?=$row['comment_num'];?>">
              </div>
              <div class="comment_detail">
                <p>
                <?=nl2br($row['content']);?>
                </p>
              </div>
            </div>
            <?php
                if (isset($_SESSION['memberNum']) && $_SESSION['memberNum'] == $row['member_num']) {
                     echo ("<div class='comment_delete'>
                              <button type='submit' onclick='return confirm(\"정말 삭제하시겠습니까?\")'>삭제</button>
                           </div>");
                } else {
                echo "";
                }
                ?>

          </form>
          <?php
                }} else {
                echo "댓글이 없습니다.";
                }
                ?>
        </div>
      </div>
    </div>
  </body>
</html>
