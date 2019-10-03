<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

 
// 全てのグループを取得
require_once './db/questionnaires.php';
$questionnaires = array();
$questionnaires = getQuestionnaires();



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
                <th style="width:300px;">問題集</th>
                <th style="width:100px;">結果タイプ</th>
                <th style="width:100px;">質問</th>
                <th style="width:100px;" class="add"><button type='button' class='addM' onclick="location.href='questionnaires_edit.php'">&nbsp;新規登録&nbsp;</button></th>
            </tr>
            <?php foreach ($questionnaires as $questionnaire) { ?>
                <tr>

                    <td><?php echo $questionnaire->que_title; ?></td>

                    <form  action='types_list.php' method='POST'>
                    <input type='hidden' name='queSeq' value='<?php echo $questionnaire->que_seq; ?>'>
                    <input type='hidden' name='que_title' value='<?php echo $questionnaire->que_title; ?>'>
                    <input type='hidden' name='que_editable' value='<?php echo $questionnaire->que_editable; ?>'>
                    <?php if(empty($questionnaire->tCnt)){ ?>
                        <td>登録なし 
                    <?php }else{ ?>
                        <td>登録あり <span class='f50P'>(<?php echo $questionnaire->tCnt; ?>) </span>
                    <?php } ?>
                        <input type="submit" name="btn_submit" value="" style="background:url('../img/edit_s.png');width:25px;height:25px;border:0px solid;cursor:pointer;" /></td>
                    </form>

                    <form  action='questions_list.php' method='POST'>
                    <input type='hidden' name='queSeq' value='<?php echo $questionnaire->que_seq; ?>'>
                    <input type='hidden' name='que_title' value='<?php echo $questionnaire->que_title; ?>'>
                    <input type='hidden' name='que_editable' value='<?php echo $questionnaire->que_editable; ?>'>
                    <?php if(empty($questionnaire->qCnt)){ ?>
                        <td>登録なし 
                    <?php }else{ ?>
                        <td>登録あり <span class='f50P'>(<?php echo $questionnaire->qCnt; ?>) </span>
                    <?php } ?>
                        <input type="submit" name="btn_submit" value="" style="background:url('../img/edit_s.png');width:25px;height:25px;border:0px solid;cursor:pointer;" /></td>
                    </form>

                    <form  action='questionnaires_edit.php' method='POST'>
                    <input type='hidden' name='queSeq' value='<?php echo $questionnaire->que_seq; ?>'>
                    <input type='hidden' name='que_title' value='<?php echo $questionnaire->que_title; ?>'>
                    <td><button class='editM wdtS' type='submit'>編集</button></td>
                    </form>

                </tr>
            <?php } ?>
        </table>

    </div>
</body>

</html>