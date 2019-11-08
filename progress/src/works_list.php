<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

$bSeq = $_POST['bSeq'];
if(empty($bSeq)){
    $bSeq = $_GET['bSeq'];
}
$sSeq = $_POST['sSeq'];
if(empty($sSeq)){
    $sSeq = $_GET['sSeq'];
}
 
// 全てのユーザを取得
require_once './db/works.php';
$works = array();
$works = getWorks($bSeq);

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>PROGRESS</title>
    <link rel="stylesheet" href="../css/main.css" />
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

        <div class="nav">
            <button type="button" onclick="location.href='progress.php'" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <table class="vw">
            <tr>
                <th style="width:70px;">並び順</th>
                <th style="width:300px;">小項目名</th>
                <th class="add" style="width:150px;">
                    <form action='works_edit.php' method='POST'>
                        <input type='hidden' name='sSeq' value='<?php echo $sSeq; ?>'>
                        <input type='hidden' name='bSeq' value='<?php echo $bSeq; ?>'>
                        <button type='submit' class="addM">&nbsp;新規登録&nbsp;</button>
                    </form>
                </th>
            </tr>
            <?php foreach ($works as $work) { ?>
            <tr>
                <form action='works_edit.php' method='POST'>
                    <input type='hidden' name='sSeq' value='<?php echo $work->sys_seq; ?>'>
                    <input type='hidden' name='bSeq' value='<?php echo $work->bus_seq; ?>'>
                    <input type='hidden' name='wSeq' value='<?php echo $work->wk_seq; ?>'>
                    <td><?php echo $work->wk_que; ?></td>
                    <td><?php echo $work->wk_name; ?></td>
                    <td><button class='editM wdtS' type='submit'>編集</button></td>
                </form>
            </tr>
            <?php } ?>
        </table>

    </div>
</body>

</html>