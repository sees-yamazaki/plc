<?php
session_start();

    // ログイン状態チェック
    if (!isset($_SESSION["NAME"])) {
        header("Location: logoff.php");
        exit;
    }

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

 
require_once './db/kubuns.php';
$kubuns = array();
$kubuns = getKubuns();



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
                <th style="width:300px;">フォーマット名</th>
                <th style="width:150px;"><button type='button' class="btnOrange"
                        onclick="location.href='kubuns_edit.php'">&nbsp;新規登録&nbsp;</button></th>
            </tr>
            <?php foreach ($kubuns as $kubun) { ?>
            <tr>
                <form action='kubuns_edit.php' method='POST'>
                    <input type='hidden' name='kSeq' value='<?php echo $kubun->k_seq; ?>'>
                    <td><?php echo $kubun->k_title; ?></td>
                    <td><button class='btnBlue' type='submit'>編　集</button></td>
                </form>
            </tr>
            <?php } ?>
        </table>

    </div>
</body>

</html>