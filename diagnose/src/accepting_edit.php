<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $aqSeq = $_POST['aqSeq'];

    require './db/accepting.php';
    $accepting = new cls_accepting();

    try {

        
        if(isset($_POST['aqEdit'])){

            $accepting->aq_seq = $_POST['aqSeq'];
            $accepting->aq_title = $_POST['aq_title'];
            $accepting->aq_start_time = $_POST['aq_start_time'];
            $accepting->aq_end_time = $_POST['aq_end_time'];
            $accepting->aq_text = $_POST['aq_text'];
            $accepting->que_seq = $_POST['que_seq'];
            
            if(!empty($aqSeq)){
                updateAcceptingQue($accepting);
            }else{
                insertAcceptingQue($accepting);
            }
            
            
            if(empty($errorMessage)){
                header("Location: ./accepting_list.php");
            }

        }else if(isset($_POST['aqDel'])){

            $accepting->que_seq  = $_POST['aqSeq'];
            
            deleteAcceptingQue($accepting);

            require './db/answers.php';
            deleteAnswersNoteWithQueSeq($accepting->que_seq);

            header("Location: ./accepting_list.php");

        }else{
            
            $accepting = getAcceptingQue($aqSeq);

            require './db/answers.php';
            $cntAnswered = countAnsweredNote($accepting->que_seq);

        }


        require_once './db/questionnaires.php';
        $questionnaires = array();
        $questionnaires = getQuestionnaires();
        $qHtml = "";
        foreach($questionnaires as $questionnaire){
            if($questionnaire->que_seq==$accepting->que_seq){
                $qHtml .= "<option value='".$questionnaire->que_seq."' selected>".$questionnaire->que_title."</option>";
            }else{
                $qHtml .= "<option value='".$questionnaire->que_seq."'>".$questionnaire->que_title."</option>";
            }

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
            <button type="button" onclick="location.href='accepting_list.php'" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <form action="accepting_edit.php" method="POST" onsubmit="return submitChk()">

            <input type="hidden" name="aqSeq" value="<?php echo $aqSeq; ?>">

            <table class="edit">
                <tr>
                    <th><span class="required">*</span>アンケート名<span class="f50P"> (30)</span></th>
                    <td><input type="text" name="aq_title" class="f130P wdtL" maxlength=30
                            style="ime-mode: active;" required placeholder="" value="<?php echo $accepting->aq_title; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>問題集</th>
                    <td>
                        <select name="que_seq" class="f130P" required width="100%">
                            <option value="">選択してください</option>
                            <?php echo $qHtml; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>開始日時</th>
                    <td><input type="date" name="aq_start_time" class="f130P" value="<?php echo $accepting->aq_start_time; ?>"></td>
                </tr>
                <tr>
                    <th><span class="required">*</span>終了日時</th>
                    <td><input type="date" name="aq_end_time" class="f130P" value="<?php echo $accepting->aq_end_time; ?>"></td>
                </tr>
                <tr>
                    <th>説明</th>
                    <td><textarea name="aq_text"  class="f130P wdtL" rows=8><?php echo $accepting->aq_text; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="aqEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if(!empty($aqSeq)){ ?>
        <form action="accepting_edit.php" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="aqSeq" value="<?php echo $aqSeq; ?>">

            <table class="del">
                <tr>
                    <td colspan=2><button type=submit name="aqDel" class="del wdtLL">このアンケートを削除する</button></td>
                </tr>
                <tr>
                    <td colspan=2><span class="err">関連する情報も削除されます</span></td>
                </tr>
                <tr>
                    <td style="text-align:right; width:70%;">
                        回答済みのアンケート　：　<br>
                    </td>
                    <td style="text-align:left">
                        <?php echo $cntAnswered; ?><br>
                    </td>
                </tr>
                <tr>
                    <td colspan=2><button type=submit name="aqDel" class="del wdtLL">このアンケートを削除する</button></td>
                </tr>

            </table>

        </form>
        <?php } ?>
    </div>
</body>

</html>