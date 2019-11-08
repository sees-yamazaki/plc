<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

 
// 全てのユーザを取得
require_once './db/systems.php';
$systems = array();
$systems = getSystems();

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
                <th style="width:70px;">並び順</th>
                <th style="width:300px;">大項目名</th>
                <th class="add" style="width:150px;">
                    <form action='systems_edit.php' method='POST'>
                        <button type='submit' class="addM">&nbsp;新規登録&nbsp;</button>
                    </form>
                </th>
            </tr>
            <?php foreach ($systems as $system) { ?>
                <tr>
                    <form  action='systems_edit.php' method='POST'>
                    <input type='hidden' name='sSeq' value='<?php echo $system->sys_seq; ?>'>
                    <td><?php echo $system->sys_que; ?></td>
                    <td><?php echo $system->sys_name; ?></td>
                    <td><button class='editM wdtS' type='submit'>編集</button></td>
                    </form>
                </tr>
            <?php } ?>
        </table>

    </div>
</body>

</html>