<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $queSeq = $_POST['queSeq'];

    require './db/questionnaires.php';
    $questionnaire = new cls_questionnaires();

    try {

        
        if(isset($_POST['queEdit'])){

            $questionnaire->que_seq = $_POST['queSeq'];
            $questionnaire->que_title = $_POST['que_title'];
            $questionnaire->que_text = $_POST['que_text'];
            $questionnaire->que_create_time = $_POST['que_create_time'];
            $questionnaire->que_editable = $_POST['que_editable'];
            
            if(!empty($queSeq)){
                updateQuestionnaire($questionnaire);
            }else{
                insertQuestionnaire($questionnaire);
            }
            
            
            if(empty($errorMessage)){
                header("Location: ./questionnaires_list.php");
            }

        }else if(isset($_POST['queDel'])){

            require './db/accepting.php';
            deleteAcceptingQueWithQueSeq($queSeq);
            require './db/types.php';
            deleteTypeWithQueSeq($queSeq);
            require './db/answers.php';
            deleteAnswersNoteWithQueSeq($queSeq);
            require './db/questions.php';
            deleteQuestionWithQueSeq($queSeq);
            deleteQuestionnaire($queSeq);

            header("Location: ./questionnaires_list.php");

        }else{
            
            $questionnaire = getQuestionnaire($queSeq);
            if($questionnaire->que_editable=="0"){
                $qEdit0=" checked";
                $qEdit1="";
            }else{
                $qEdit0="";
                $qEdit1=" checked";
            }

            require './db/answers.php';
            $cntAnswered = countAnsweredNote($queSeq);
            require './db/types.php';
            $cntTypes = countTypes($queSeq);
            require './db/accepting.php';
            $cntAQ = countAcceptingQues($queSeq);
            require './db/questions.php';
            $cntQ = countQuestions($queSeq);

        }


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
            <button type="button" onclick="location.href='questionnaires_list.php'" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <form action="questionnaires_edit.php" method="POST" onsubmit="return submitChk()">

            <input type="hidden" name="queSeq" value="<?php echo $queSeq; ?>">

            <table class="edit">
                <tr>
                    <th><span class="required">*</span>問題集<span class="f50P"> (30)</span></th>
                    <td><input type="text" name="que_title" class="f130P wdtL" maxlength=30
                            style="ime-mode: active;" required placeholder="" value="<?php echo $questionnaire->que_title; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <th>説明</th>
                    <td><textarea name="que_text"  class="f130P wdtL" rows=8><?php echo $questionnaire->que_text; ?></textarea></td>
                </tr>
                <tr>
                    <th><span class="required">*</span>編集</th>
                    <td>
                        <input type="radio" name="que_editable" class="f130P" value="0" required <?php echo $qEdit0; ?>>可能　
                        <input type="radio" name="que_editable" class="f130P" value="1" <?php echo $qEdit1; ?>>不可　
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="queEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if(!empty($queSeq)){ ?>
        <form action="questionnaires_edit.php" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="queSeq" value="<?php echo $queSeq; ?>">

            <table class="del">
                <tr>
                    <td colspan=2><button type=submit name="queDel" class="del wdtLL">この問題集を削除する</button></td>
                </tr>
                <tr>
                    <td colspan=2><span class="err">関連する情報も削除されます</span></td>
                </tr>
                <tr>
                    <td style="text-align:right; width:70%;">
                        開催中のアンケート　：　<br>
                        回答済みのアンケート　：　<br>
                        紐付く設問　：　<br>
                        紐付く結果タイプ　：　<br>
                    </td>
                    <td style="text-align:left">
                        <?php echo $cntAQ; ?><br>
                        <?php echo $cntAnswered; ?><br>
                        <?php echo $cntQ; ?><br>
                        <?php echo $cntTypes; ?><br>
                    </td>
                </tr>
                <tr>
                    <td colspan=2><button type=submit name="queDel" class="del wdtLL">この問題集を削除する</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>
    </div>
</body>

</html>