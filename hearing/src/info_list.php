<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: logoff.php");
    exit;
}

$iSeq = $_POST['iSeq'];
// if(empty($sSeq)){
//     $sSeq = $_GET['sSeq'];
// }
 

$iSeq = $_POST['iSeq'];
 
require './db/infos.php';

try {

    if (isset($_POST['stts']) &&  $_POST['stts']=="del") {
        delteInfos($iSeq);
    }

} catch (PDOException $e) {
    $errorMessage = 'データベースエラー';
    if (strcmp("1", $ini['debug'])==0) {
        echo $e->getMessage();
    }
}

$infos = array();
$infos = getInfos();

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

    <form id="sakubun1" class="" action='hearingsheet1.php' method='POST'>
        <div class='menu no_print'>
            <ul class='topnav2'>
                <li><a id="back" href="#" onclick="back2();">戻る</a></li>
            </ul>
        </div>
    </form>

    <div id="content">

        <div class="nav">
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>


        <table class="hs">
            <tr>
                <th style="width:200px;">登録日時</th>
                <th style="width:300px;">タイトル1</th>
                <th style="width:300px;">タイトル2</th>
                <th style="width:200px;">登録者</th>
                <th style="width:150px;"></th>
            </tr>
            <?php foreach ($infos as $info) { ?>
            <tr>
                <td><?php echo date('Y/m/d/ H:i',  strtotime($info->createdate)); ?></td>
                <td><?php echo $info->title1; ?></td>
                <td><?php echo $info->title2; ?></td>
                <td><?php echo $info->users_name; ?></td>
                <td>
                    <button class='btnBlue' type='button' onclick='infoSelect(<?php echo $info->infos_seq; ?>)'>選択</button>
                    <button class='btnRed' type='button' onclick='infoDelete(<?php echo $info->infos_seq; ?>)'>削除</button>
                </td>
            </tr>
            <?php } ?>
        </table>

    </div>
    <form name="frmSelect" action='hearingsheet1.php' method='POST' onsubmit="return delcheck()">
        <input type='hidden' name='iSeq' value=''>
        <input type='hidden' name='stts' value='edit'>
    </form>
    <form name="frmDelte" action='' method='POST' onsubmit="return delcheck()">
        <input type='hidden' name='iSeq' value=''>
        <input type='hidden' name='stts' value='del'>
    </form>
    <script type="text/javascript">
    function infoSelect(val) {
        if (confirm('選択したデータを読み込んでよろしいですか？？')) {
            document.frmSelect.iSeq.value = val;
            document.frmSelect.submit();
        }
    }

    function infoDelete(val) {
        if (confirm('選択したデータを削除してもよろしいですか？？')) {
            document.frmDelte.iSeq.value = val;
            document.frmDelte.submit();
        }
    }
    </script>
</body>

</html>