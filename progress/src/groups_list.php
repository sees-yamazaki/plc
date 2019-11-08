<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

 
// 全てのユーザを取得
require_once './db/groups.php';
$groups = array();
$groups = getGroups();

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
                <th style="width:300px;">名称</th>
                <th style="width:100px;">マネージャー</th>
                <th style="width:150px;"></th>
                <!--
                <th class="add" style="width:150px;"><button type='button' class="addM" onclick="location.href='groups_edit.php'">&nbsp;新規登録&nbsp;</button></th>
-->
            </tr>
            <?php foreach ($groups as $group) { ?>
                <tr>
                    <form  action='groups_edit.php' method='POST'>
                    <input type='hidden' name='gSeq' value='<?php echo $group->groups_seq; ?>'>
                    <td><?php echo $group->groups_que; ?></td>
                    <td><?php echo $group->groups_name; ?></td>
                    <td><?php echo $group->users_name; ?></td>
                    <td><button class='editM wdtS' type='submit'>編集</button></td>
                    </form>
                </tr>
            <?php } ?>
        </table>

    </div>
</body>

</html>