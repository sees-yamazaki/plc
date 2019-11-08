<?php

// セッション開始
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

require_once './db/giji.php';
$gijis = array();
$gijis = getGijis();

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

        <table class="vw">
            <tr>
            <th style="width:120px;">開催日</th>
                <th style="width:100px;">ID</th>
                <th style="width:300px;">名称</th>
                <th style="width:150px;">添付ファイル</th>
                <th class="add" style="width:150px;"><button type='button' class="addM"
                        onclick="location.href='giji_edit.php'">&nbsp;新規登録&nbsp;</button></th>
            </tr>
            <?php foreach ($gijis as $giji) { ?>
            <tr>
                <form action='giji_edit.php' method='POST'>
                    <input type='hidden' name='gSeq' value='<?php echo $giji->giji_seq; ?>'>
                    <td><?php echo $giji->giji_date; ?></td>
                    <td><?php echo $giji->giji_id; ?></td>
                    <td><?php echo $giji->giji_title; ?></td>
                    <td><a href="../files/<?php echo $giji->giji_seq; ?>/<?php echo $giji->giji_file1; ?>" download="<?php echo $giji->giji_file1; ?>"><?php echo $giji->giji_file1; ?></a></td>
                    <td><button class='editM wdtS' type='submit'>編集</button></td>
                </form>
            </tr>
            <?php } ?>
        </table>


    </div>

</body>

</html>