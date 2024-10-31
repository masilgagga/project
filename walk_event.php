<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>마실가까</title>
    <link rel="stylesheet" href="./css/walk_event.css" />
</head>

<body>
    <?php
        include "header.php";
    
        $event_ing = "ing";
        $event_num = "";
        $thumbnail = "";
        $query_str = ">=";
        $gray = "";

        if(isset($_GET['event_ing']) && $_GET['event_ing'] == 'end') $event_ing = "end";

        // 종료된 이벤트
        if($event_ing == 'end') {
            $query_str = "<";
            $gray = "style = 'filter: grayscale(100%)'";
        } 

    ?>
    <div class="content wrap">
        <section>
            <!-- 타이틀 -->
            <div class="title_bg">
                <div class="title">산책길 Event</div>
            </div>
        </section>
        <div class="e_tap">
            <a href="./walk_event.php?event_ing=ing" class="<?=$event_ing == 'ing' ? 'active' : '' ?>">진행중인 이벤트</a>
            <a href="./walk_event.php?event_ing=end" class="<?=$event_ing == 'end' ? 'active' : '' ?>">종료된 이벤트</a>
        </div>
        <div class="e_banner_container">
            <?php
            $eventListQuery = "SELECT * FROM event WHERE end_day ".$query_str." CURRENT_DATE() ORDER BY event.event_num DESC";
            $eListResult = mysqli_query($DBCON, $eventListQuery);
        
            // 이벤트 숫자만큼 반복
            while($eListRow = mysqli_fetch_assoc($eListResult)){
                $event_num = $eListRow['event_num'];
                $event_name = $eListRow['event_name'];
                $thumbnail = $eListRow['thumbnail'];

                $event_link = "<a href='./walk_event_detail.php?event_num=$event_num'>";
                $event_link_a = "</a>";
                if($event_ing == 'end') {
                    $event_link = "";
                    $event_link_a = "";
                }
        ?>
            <div><?=$event_link?>
                <img src="./image/walk_event/<?=$thumbnail?>" alt="<?=$event_name?>" <?=$gray?> /><?=$event_link_a?>
            </div>
            <?php
            }
            mysqli_close($DBCON);
        ?>
        </div>
    </div>
    <?php include "footer.php";?>
</body>

</html>