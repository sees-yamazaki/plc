<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

 
// 全てのグループを取得
require_once './db/accepting.php';
$acceptings = array();
$acceptings = getAcceptingQues();


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
                <th style="width:300px;">アンケート名</th>
                <th style="width:100px;">開始日時</th>
                <th style="width:100px;">終了日時</th>
                <th style="width:100px;" class="add"><button type='button' class="addM" onclick="location.href='accepting_edit.php'">&nbsp;新規登録&nbsp;</button></th>
            </tr>
            <?php foreach ($acceptings as $accepting) { ?>
                <tr>

                    <form  action='accepting_edit.php' method='POST'>
                    <td><?php echo $accepting->aq_title; ?></td>
                    <td><?php echo $accepting->aq_start_time; ?></td>
                    <td><?php echo $accepting->aq_end_time; ?></td>
                    <td><button type='submit' class='editM wdtS'>編集</button></td>
                    <input type='hidden' name='aqSeq' value='<?php echo $accepting->aq_seq; ?>'>
                    </form>

                </tr>
            <?php } ?>
        </table>

    </div>
</body>

</html>