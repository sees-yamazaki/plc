<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

 
// 全てのグループを取得
require_once './db/questions.php';
$questions = array();
$questions = getQuestions();


$html = "";
foreach ($questions as $question) {
    $html .= "<tr><form  action='questions_edit.php' method='POST'>";
    $html .= "<input type='hidden' name='qSeq' value='".$question->q_seq."'>";
    $html .= "<td>".$question->q_id."</td>";
    $html .= "<td>".$question->q_text."</td>";
    $html .= "<td>".$question->types_name."</td>";
    $html .= "<td><button type='submit'>編集</button></td>";
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
                <th>ID</th>
                <th style="width:500px;">設問</th>
                <th>タイプ</th>
                <th class="add"><button type='button' onclick="location.href='questions_edit.php'">新規登録</button></th>
            </tr>
            <?php echo $html; ?>
        </table>

    </div>
</body>

</html>