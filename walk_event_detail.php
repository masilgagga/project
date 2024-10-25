<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>마실가까</title>
    <link rel="stylesheet" href="./css/walk_event_detail.css" />
</head>

<body>
    <?php
        include "header.php";
    
        $event_num = "";
        $event_name = "";
        $detail_1 = "";
        $detail_2 = "";

        if(isset($_GET['event_num']) && $_GET['event_num'] != null){
            $event_num = $_GET['event_num'];

            $eventQuery = "SELECT * FROM event WHERE event_num = $event_num";
            $eventResult = mysqli_query($DBCON, $eventQuery);            
            $eventRow = mysqli_fetch_assoc($eventResult);

            if($eventRow){
                $event_name = $eventRow['event_name'];
                $detail_1 = $eventRow['detail_1'];
                $detail_2 = $eventRow['detail_2'];
    ?>
    <div class="content wrap">
        <section>
            <!-- 타이틀 -->
            <div class="title_bg">
                <div class="title">Event</div>
            </div>
        </section>
        <div class="e_detail_conteiner">
            <div class="e_detail">
                <img src="./image/walk_event/<?=$detail_1?>" alt="<?=$event_name?> 이미지1" />
                <img src="./image/walk_event/<?=$detail_2?>" alt="<?=$event_name?> 이미지2" />
            </div>
        </div>
        <!-- DB 데이터 받아오기 -->
        <?php 
            $Sql = "SELECT a.content,a.regist_day,a.comment_num, b.name,b.photo,b.member_num
            FROM comment a
            INNER JOIN member b
            ON a.member_num = b.member_num;";

            $con = mysqli_query($DBCON, $Sql);
            $conSql = "SELECT count(*)  FROM comment WHERE event_num='$event_num'";

            $contentSet = mysqli_query($DBCON, $conSql);
            $contents= mysqli_fetch_row($contentSet);
        ?>

        <div class="comment_conteiner">
            <!-- 댓글 작성 영역  -->
            <form action="./walk_comment_insert.php?event_num=<?=$event_num?>" method="post">
                <div>댓글 총 <span style="color: red"><?=$contents[0]?></span>개</div>
                <div class="comment_write">
                    <?php 
                    // 로그인 상태 확인
                    if (isset($_SESSION['memberNum']) && $_SESSION['memberNum']) {
                    ?>
                    <textarea name="content" placeholder="댓글을 작성하세요."></textarea>
                    <input type="hidden" name="memberNum" value="<?=$_SESSION['memberNum']?>">
                    <button type="submit">등록</button>
                    <?php 
                    } else { 
                ?>
                    <textarea name="content" placeholder="로그인이 필요합니다." disabled></textarea>
                    <button type="button" disabled>등록</button>
                    <?php 
                    }
                ?>
                </div>
            </form>
            <!-- 댓글 영역 -->
            <div class="comments">
                <?php
                    if ($con && $con->num_rows > 0){
                        while ($row = $con->fetch_assoc()) {
                ?>
                <form class="comment" action="./walk_comment_delete.php?event_num=<?=$event_num?>" method="post">
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
                    }
                } else { echo "댓글이 없습니다.";}
                ?>
            </div>
        </div>
    </div>
    <?php
            mysqli_close($DBCON);
            
            }else{
                echo ("<script>
                    alert('잘못된 경로입니다.');
                    window.history.back();
                    </script>");
            }
        }else{
            echo ("<script>
                alert('잘못된 경로입니다.');
                window.history.back();
                </script>");
        }
    ?>
</body>

</html>