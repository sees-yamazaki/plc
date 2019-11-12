<?php

// セッション開始
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

    $uSeq = $_SESSION['SEQ'];



    try {


        require_once './db/meetings.php';
        $meetings = array();
        $meetings = getMeeintgs();


    } catch (PDOException $e) {

        $errorMessage = 'データベースエラー';
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }


?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>DIAGNOSE</title>
    <link rel="stylesheet" href="../css/main.css" />
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

    <?php foreach ($meetings as $meeting) { ?>
    <table class='vw'>
        <tr>
            <th style='width:120px;'>開催日</th>
            <th style='width:400px;'>会議名</th>
            <th style='width:150px;' class='f80P'>出席</th>
            <th style='width:150px;' class='f80P'>欠席</th>
            <th style='width:150px;' class='f80P'>未定</th>
        </tr>
        <?php 
            $vMeetings = getMeetingView($meeting->meet_seq);
            foreach ($vMeetings as $vMeeting) {
                if($vMeeting->mm_status==1){
                    $html1 .= $vMeeting->groups_name.", ";
                }else if($vMeeting->mm_status==3){
                    $html1 .= "【".$vMeeting->groups_name."】, ";
                }else if($vMeeting->mm_status==2){
                    $html2 .= $vMeeting->groups_name.":".$vMeeting->users_name.", ";
                }else{
                    $html0 .= $vMeeting->groups_name.", ";
                }
                
            }
        ?>
        <tr>
            <form action='meetings_attend.php' name="attend" method='POST'>
                <input type='hidden' name='mSeq' value='<?php echo $meeting->meet_seq;?>'>
                <td><?php echo $meeting->meet_date; ?></td>
                <td><a href="javascript:attend.submit()"><?php echo $meeting->meet_title;  ?></a></td>
                <td class="f80P"><?php echo $html1; ?></td>
                <td class="f80P"><?php echo $html2; ?></td>
                <td class="f80P"><?php echo $html0; ?></td>
            </form>
        </tr>
    </table>
    <?php }  ?>


    </div>

</body>

</html>