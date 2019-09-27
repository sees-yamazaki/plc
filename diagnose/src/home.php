<?php

// セッション開始
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

    $uSeq = $_SESSION['SEQ'];

    try {

        require './db/answers.php';
        $answered_notes = array();
        $answered_notes = getAnsweredNote($uSeq,"");

    } catch (PDOException $e) {

        $errorMessage = 'データベースエラー';
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }


?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>DIAGNOSE</title>
    <link rel="stylesheet" href="../css/main.css" />
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

        <div class="nav">
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>


        <table class="vw">
            <tr>
                <th style="width:300px">実施履歴</th>
                <th style="width:150px"></th>
            </tr>

            <?php foreach ($answered_notes as $answered_note) { ?>
            <form action="result_view.php" method="POST">
                <tr>
                    <input type="hidden" name="uSeq" value="<?php echo $answered_note->an_users_seq; ?>">
                    <input type="hidden" name="an_id" value="<?php echo $answered_note->an_id; ?>">
                    <td><?php echo $answered_note->an_answered_time; ?></textarea></td>
                    <td><button type='submit'>結果を見る</button></td>
                </tr>
            </form>
            <?php } ?>

        </table>


    </div>

</body>

</html>