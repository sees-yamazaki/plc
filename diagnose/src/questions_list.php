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
require_once './db/questions.php';
$questions = array();
$questions = getQuestions($queSeq);


$html = "";
foreach ($questions as $question) {
    $html .= "<tr>";
    $html .= "<td>".$question->q_id."</td>";
    $html .= "<td>".$question->q_text."</td>";
    $html .= "<td>".$question->types_name."</td>";
    if($que_editable<>"1"){
    $html .= "<form action='questions_edit.php' method='POST'>";
    $html .= "<td>";
    $html .= "<button type='submit' class='editM wdtS'>編集</button>";
    $html .= "</td>";
    $html .= "<input type='hidden' name='queSeq' value='".$queSeq."'>";
    $html .= "<input type='hidden' name='qSeq' value='".$question->q_seq."'>";
    $html .= "</form>";
    }
    $html .= "</tr>";
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
                <th>問題集</th>
                <td style="width:500px;"><?php echo $que_title; ?></td>
            </tr>
        </table>
        <br><br>



        <table class="vw">
            <form  action='questions_edit.php' method='POST'>
            <input type="hidden" name="queSeq" value="<?php echo $queSeq; ?>">
            <tr>
                <th>ID</th>
                <th style="width:500px;">設問</th>
                <th>結果タイプ</th>
                <?php if($que_editable<>"1"){ ?>
                <th class="add"><button type='submit' class="addM">&nbsp;新規登録&nbsp;</button></th>
                <?php } ?>
            </tr>
            </form>
            <?php echo $html; ?>
        </table>

    </div>
</body>

</html>