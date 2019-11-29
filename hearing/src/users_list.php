<?php
session_start();

    // ログイン状態チェック
    if (!isset($_SESSION["NAME"])) {
        header("Location: logoff.php");
        exit;
    }

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
    <title>HearingSheet</title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../js/main.js"></script>
</head>

<body>

    <div class='menu no_print'>
        <ul class='topnav2'>
            <li><a id="back" href='./hearingsheet1.php'>戻る</a></li>
        </ul>
    </div>

    <div id="content">

        <table class="hs">
            <tr>
                <th style="width:70px;">ID</th>
                <th style="width:300px;">名前</th>
                <th style="width:150px;"><button type='button' class="btnOrange"
                        onclick="location.href='users_edit.php'">&nbsp;新規登録&nbsp;</button></th>
            </tr>
            <?php foreach ($users as $user) { ?>
            <tr>
                <form action='users_edit.php' method='POST'>
                    <input type='hidden' name='uSeq' value='<?php echo $user->users_seq; ?>'>
                    <td><?php echo $user->users_id; ?></td>
                    <td><?php echo $user->users_name; ?></td>
                    <td><button class='btnBlue' type='submit'>編　集</button></td>
                </form>
            </tr>
            <?php } ?>
        </table>

    </div>
</body>

</html>