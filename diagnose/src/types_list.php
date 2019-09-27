<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

 
// 全てのグループを取得
require_once './db/types.php';
$types = array();
$types = getTypes();


$html = "";
foreach ($types as $type) {
    $html .= "<tr><form  action='types_edit.php' method='POST'>";
    $html .= "<input type='hidden' name='tSeq' value='".$type->types_seq."'>";
    $html .= "<td>".$type->types_id."</td>";
    $html .= "<td>".$type->types_name."</td>";
    $html .= "<td class='f80P' style='text-align:left;'>".nl2br($type->types_note)."</td>";
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
                <th style="width:70px;">ID</th>
                <th>結果タイプ</th>
                <th style="width:700px;">説明</th>
                <th class="add"><button type='button' onclick="location.href='types_edit.php'">新規登録</button></th>
            </tr>
            <?php echo $html; ?>
        </table>

    </div>
</body>

</html>