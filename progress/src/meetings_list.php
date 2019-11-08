<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

 
// 全てのユーザを取得
require_once './db/meetings.php';
$meetings = array();
$meetings = getMeeintgs();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>DIAGNOSE</title>
    <link rel="stylesheet" href="../css/main.css" />
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

        <table class="vw">
            <tr>
                <th style="width:200px;">開催日</th>
                <th style="width:500px;">会議名</th>
                <th class="add" style="width:150px;"><button type='button' class="addM" onclick="location.href='meetings_edit.php'">&nbsp;新規登録&nbsp;</button></th>
            </tr>
            <?php foreach ($meetings as $meeting) { ?>
                <tr>
                    <form  action='meetings_edit.php' method='POST'>
                    <input type='hidden' name='mSeq' value='<?php echo $meeting->meet_seq; ?>'>
                    <td><?php echo $meeting->meet_date; ?></td>
                    <td><?php echo $meeting->meet_title; ?></td>
                    <td><button class='editM wdtS' type='submit'>編集</button></td>
                    </form>
                </tr>
            <?php } ?>
        </table>

    </div>
</body>

</html>