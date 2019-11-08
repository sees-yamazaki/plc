<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

 
// 全てのユーザを取得
require_once './db/users.php';
$users = array();
$users = getUsers();

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
                <th style="width:70px;">ID</th>
                <th style="width:300px;">名前</th>
                <th class="add" style="width:150px;"><button type='button' class="addM" onclick="location.href='users_edit.php'">&nbsp;新規登録&nbsp;</button></th>
            </tr>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <form  action='users_edit.php' method='POST'>
                    <input type='hidden' name='uSeq' value='<?php echo $user->users_seq; ?>'>
                    <td><?php echo $user->users_id; ?></td>
                    <td><?php echo $user->users_name; ?></td>
                    <td><button class='editM wdtS' type='submit'>編集</button></td>
                    </form>
                </tr>
            <?php } ?>
        </table>

    </div>
</body>

</html>