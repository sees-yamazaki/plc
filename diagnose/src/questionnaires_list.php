<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

 
// 全てのグループを取得
require_once './db/questionnaires.php';
$questionnaires = array();
$questionnaires = getQuestionnaires();


$html = "";
foreach ($questionnaires as $questionnaire) {
    $html .= "<tr><form  action='questionnaires_edit.php' method='POST'>";
    $html .= "<input type='hidden' name='queSeq' value='".$questionnaire->que_seq."'>";
    $html .= "<td>".$questionnaire->que_title."</td>";
    $html .= "<td>".$questionnaire->que_editable."</td>";
    $html .= "<td class='f80P' style='text-align:left;'>".nl2br($questionnaire->que_text)."</td>";
    $html .= "<td><button class='edit' type='submit'>編集</button></td>";
    $html .= "</form></tr>";
}


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
                <th style="width:300px;">アンケート名</th>
                <th style="width:70px;">編集</th>
                <th style="width:300px;">説明</th>
                <th style="width:100px;" class="add"><button type='button' onclick="location.href='questionnaires_edit.php'">新規登録</button></th>
            </tr>
            <?php echo $html; ?>
        </table>

    </div>
</body>

</html>