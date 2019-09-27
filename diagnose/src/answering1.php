<?php

session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $qSeq = $_POST['qSeq'];

    require './db/questions.php';
    $questions = array();

    try {

        
        if(isset($_POST['answering'])){
            
            $date = new DateTime();
            $an_id = $date->format('YmdHis')."".$_SESSION['SEQ'];
            $startTime = $_POST['startTime'];

            require './db/answers.php';
            insertAnsweredNote($an_id,$startTime);

            foreach($_POST as $key => $value) {
                if(substr($key,0,3)=="ans"){
                    $answers = new cls_answers();
                    $answers->an_id = $an_id;
                    $answers->q_seq = intval(substr($key,3));
                    $answers->value = $value;
                    insertAnswers($answers);
                }
            }            
            
            if(empty($errorMessage)){
                header("Location: ./home.php");
            }
        }else{
            $startTime = date("Y/m/d H:i:s");
        }

        $questions = getQuestionsRand();

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>DIAGNOSE</title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../js/main.js"></script>
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

        <div class="nav">
            <button type="button" onclick="location.href='questions_list.php'" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <form action="answering1.php" method="POST" onsubmit="return submitChk()">

            <table class="edit">
                <tr>
                    <th style="width:50px">No.</th>
                    <th style="width:500px">設問</th>
                    <th style="width:50px" class="yes">YES</th>
                    <th style="width:50px" class="soso">SoSo</th>
                    <th style="width:50px" class="no">NO</th>
                </tr>
                <?php $i=1; ?>
                <?php foreach ($questions as $question) { ?>
                <tr>
                    <td><?php echo $i; $i++; ?></td>
                    <td><?php echo nl2br($question->q_text); ?></td>
                    <td class="yes"><input type="radio" name="ans<?php echo $question->q_seq; ?>" value="2" required></td>
                    <td class="soso"><input type="radio" name="ans<?php echo $question->q_seq; ?>" value="1" required></td>
                    <td class="no"><input type="radio" name="ans<?php echo $question->q_seq; ?>" value="0" required></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="5" style="text-align:center;">
                        <input type="hidden" name="startTime" value="<?php echo $startTime; ?>">
                        <button type=submit name="answering" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>

    </div>
</body>

</html>