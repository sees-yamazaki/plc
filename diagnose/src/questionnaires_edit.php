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

            $questionnaire->que_title  = $_POST['queSeq'];
            
            deleteQuestionnaire($queSeq);

            header("Location: ./questionnaires_list.php");

        }else{
            
            $questionnaire = getQuestionnaire($queSeq);

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
                    <th><span class="required">*</span>アンケート名<span class="f50P"> (30)</span></th>
                    <td><input type="text" name="que_title" class="f130P wdtL" maxlength=30
                            style="ime-mode: active;" required placeholder="" value="<?php echo $questionnaire->que_title; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <th>説明</th>
                    <td><textarea name="que_text"  class="f130P wdtL" rows=8><?php echo $questionnaire->que_text; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="queEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if(!empty($tSeq)){ ?>
        <form action="types_edit.php" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="queSeq" value="<?php echo $queSeq; ?>">

            <table class="del">
                <tr>
                    <td><button type=submit name="queDel" class="del">このタイプを削除する</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>
    </div>
</body>

</html>