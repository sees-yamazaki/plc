<?php

// セッション開始
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

    $uSeq = $_POST['uSeq'];
    $an_id = $_POST['an_id'];

    try {

        require './db/answers.php';

        if(isset($_POST['delResult'])){
            deleteAnswersNoteWithANID($an_id);
        }


        $answered_notes = array();
        $answered_notes = getAnsweredNoteInfo($uSeq);

        require './db/users.php';
        $user = new cls_users();
        $user = getUser($uSeq);


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
    <script src="../js/main.js"></script>
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

        <div class="nav">
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>


        <table class="vw">
            <tr>
                <th style="width:400px"><?php echo $user->users_name; ?> さんの実施結果</th>
            </tr>
        </table>
        <br><br>


        <table class="vw">
            <tr>
                <th style="width:300px">アンケート名</th>
                <th style="width:200px">実施履歴</th>
                <th style="width:150px">タイプ</th>
                <th style="width:100px"></th>
                <th style="width:100px"></th>
            </tr>

            <?php foreach ($answered_notes as $answered_note) { ?>
                <tr>
                    <td><?php echo $answered_note->aq_title; ?></td>
                    <td><?php echo $answered_note->an_answered_time; ?></td>
                    <td class="f80P"><?php echo $answered_note->que_title; ?></td>
                    <td>
                        <form action="result_view.php" method="POST">
                        <input type="hidden" name="uSeq" value="<?php echo $answered_note->an_users_seq; ?>">
                        <input type="hidden" name="an_id" value="<?php echo $answered_note->an_id; ?>">
                        <button type='submit' class="editS wdtL">結果を見る</button>
                        </form>
                    </td>
                    <td>
                        <form action="result_user.php" method="POST" onsubmit="return delcheck()">
                        <input type="hidden" name="uSeq" value="<?php echo $answered_note->an_users_seq; ?>">
                        <input type="hidden" name="an_id" value="<?php echo $answered_note->an_id; ?>">
                        <button type='submit' name="delResult" class="del wdtM">削除する</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>

        </table>


    </div>

</body>

</html>