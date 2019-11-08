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
$wSeq = $_POST['wSeq'];
if(empty($wSeq)){
    $wSeq = $_GET['wSeq'];
}
 
require_once './db/tasks.php';
$tasks = array();
$tasks = getTasks($wSeq);

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
                <th style="width:300px;">実行タスク</th>
                <th class="add" style="width:150px;">
                    <form action='tasks_edit.php' method='POST'>
                        <input type='hidden' name='sSeq' value='<?php echo $sSeq; ?>'>
                        <input type='hidden' name='bSeq' value='<?php echo $bSeq; ?>'>
                        <input type='hidden' name='wSeq' value='<?php echo $wSeq; ?>'>
                        <button type='submit' class="addM">&nbsp;新規登録&nbsp;</button>
                    </form>
                </th>
            </tr>
            <?php foreach ($tasks as $task) { ?>
            <tr>
                <form action='tasks_edit.php' method='POST'>
                    <input type='hidden' name='sSeq' value='<?php echo $task->sys_seq; ?>'>
                    <input type='hidden' name='bSeq' value='<?php echo $task->bus_seq; ?>'>
                    <input type='hidden' name='wSeq' value='<?php echo $task->wk_seq; ?>'>
                    <input type='hidden' name='tSeq' value='<?php echo $task->tsk_seq; ?>'>
                    <td><?php echo $task->tsk_que; ?></td>
                    <td><?php echo $task->tsk_name; ?></td>
                    <td><button class='editM wdtS' type='submit'>編集</button></td>
                </form>
            </tr>
            <?php } ?>
        </table>

    </div>
</body>

</html>