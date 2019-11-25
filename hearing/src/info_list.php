<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

$iSeq = $_POST['iSeq'];
// if(empty($sSeq)){
//     $sSeq = $_GET['sSeq'];
// }
 

$iSeq = $_POST['iSeq'];
 
require './db/infos.php';

try {

    if (isset($_POST['infoDel'])) {
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
    <title></title>
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
                <th style="width:100px;"></th>
                <th style="width:100px;"></th>
            </tr>
            <?php foreach ($infos as $info) { ?>
            <tr>
                <form action='hearingsheet1.php' method='POST' onsubmit="return selectcheck()">
                    <input type='hidden' name='iSeq' value='<?php echo $info->infos_seq; ?>'>
                    <td><?php echo $info->createdate; ?></td>
                    <td><?php echo $info->title1; ?></td>
                    <td><?php echo $info->title2; ?></td>
                    <td><button class='editM wdtS' type='submit'>選択</button></td>
                </form>
                <form action='' method='POST' onsubmit="return delcheck()">
                    <input type='hidden' name='iSeq' value='<?php echo $info->infos_seq; ?>'>
                    <td><button name="infoDel" class='editM wdtS' type='submit'>削除</button></td>
                </form>
            </tr>
            <?php } ?>
        </table>

    </div>
</body>

</html>