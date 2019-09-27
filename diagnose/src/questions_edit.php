<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $qSeq = $_POST['qSeq'];

    require './db/questions.php';
    $question = new cls_questions();

    try {

        
        if(isset($_POST['questionEdit'])){

            $question->q_seq = $_POST['qSeq'];
            $question->q_id = $_POST['q_id'];
            $question->q_text = $_POST['q_text'];
            $question->types_seq = $_POST['types_seq'];

            
            if(!empty($qSeq)){
                updateQuestion($question);
            }else{
                insertQuestion($question);
            }
            
            
            if(empty($errorMessage)){
                header("Location: ./questions_list.php");
            }

        }else if(isset($_POST['questionDel'])){

            $question->q_seq = $_POST['qSeq'];
            
            deleteQuestion($question);

            header("Location: ./types_list.php");

        }else{
            
            $question = getQuestion($qSeq);

        }

        require './db/types.php';
        $types = array();
        $types = getTypes();

        foreach ($types as $type) {
            if($type->types_seq == $question->types_seq ){
                $html .= "<option value='".$type->types_seq."' selected>".$type->types_name."</option>";
            }else{
                $html .= "<option value='".$type->types_seq."'>".$type->types_name."</option>";
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
            <button type="button" onclick="location.href='questions_list.php'" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <form action="questions_edit.php" method="POST" onsubmit="return submitChk()">

            <input type="hidden" name="qSeq" value="<?php echo $qSeq; ?>">
            <input type="hidden" name="q_id" value="<?php echo $question->q_id; ?>">

            <table class="edit">
                <tr>
                    <th><span class="required">*</span>設問<span class="f50P"> (200)</span></th>
                    <td><textarea name="q_text"  class="f130P wdtL" rows=5 maxlength=200 required><?php echo $question->q_text; ?></textarea></td>
                </tr>
                <tr>
                    <th><span class="required">*</span>タイプ</th>
                    <td>
                        <select name="types_seq" class="f130P" required>
                            <option value="">選択してください</option>
                            <?php echo $html; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="questionEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if(!empty($qSeq)){ ?>
        <form action="questions_edit.php" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="tSeq" value="<?php echo $tSeq; ?>">

            <table class="del">
                <tr>
                    <td><button type=submit name="questionDel" class="del">このタイプを削除する</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>
    </div>
</body>

</html>