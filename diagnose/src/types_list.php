<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

$queSeq = $_POST['queSeq'];
$que_editable = $_POST['que_editable'];

if(empty($queSeq)){
    $queSeq = $_SESSION['queSeq'];
}else{
    $_SESSION['queSeq'] = $queSeq;
}
$que_title = $_POST['que_title'];
if(empty($que_title)){
    $que_title = $_SESSION['que_title'];
}else{
    $_SESSION['que_title'] = $que_title;
}
 
// 全てのグループを取得
require_once './db/types.php';
$types = array();
$types = getTypes($queSeq);


$html = "";
foreach ($types as $type) {
    $html .= "<tr><form  action='types_edit.php' method='POST'>";
    $html .= "<input type='hidden' name='tSeq' value='".$type->types_seq."'>";
    $html .= "<input type='hidden' name='queSeq' value='".$type->que_seq."'>";
    $html .= "<td>".$type->types_id."</td>";
    $html .= "<td>".$type->types_name."</td>";
    $html .= "<td class='f80P' style='text-align:left;'>".nl2br($type->types_note)."</td>";
    if($que_editable<>"1"){
    $html .= "<td><button class='editM wdtS' type='submit'>編集</button></td>";
    }
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

    <div class="nav">
        <button type="button" onclick="location.href='questionnaires_list.php'" class="back">戻る</button>
        <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
    </div><br>

        <table class="vw">
            <tr>
                <th>アンケート名</th>
                <td style="width:500px;"><?php echo $que_title; ?></td>
            </tr>
        </table>
        <br><br>

        <table class="vw">
            <tr>
                <th style="width:70px;">ID</th>
                <th>結果タイプ</th>
                <th style="width:600px;">説明</th>
                <?php if($que_editable<>"1"){ ?>
                <th class="add" style="width:100px;">
                    <form  action='types_edit.php' method='POST'>
                    <button type='submit' class="addM">&nbsp;新規登録&nbsp;</button>
                    <input type="hidden" name="queSeq" value="<?php echo $queSeq; ?>">
                    </form>
                </th>
                <?php } ?>
            </tr>

            <?php echo $html; ?>
        </table>

    </div>
</body>

</html>