<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $tSeq = $_POST['tSeq'];

    require './db/types.php';
    $type = new cls_types();

    try {

        
        if(isset($_POST['typeEdit'])){

            $type->types_seq = $_POST['tSeq'];
            $type->types_id = $_POST['types_id'];
            $type->types_name = $_POST['types_name'];
            $type->types_note = $_POST['types_note'];

            
            if(!empty($tSeq)){
                updateType($type);
            }else{

                //$tmp = new cls_types();
                $tmp = getATypeByName($type->types_name);

                if(empty($tmp->types_seq)){
                    insertType($type);
                }else{
                    $errorMessage = 'INSERTエラー';
                }

            }
            
            
            if(empty($errorMessage)){
                header("Location: ./types_list.php");
            }

        }else if(isset($_POST['typeDel'])){

            $type->types_seq  = $_POST['tSeq'];
            
            deleteType($type);

            header("Location: ./types_list.php");

        }else{
            
            $type = getAType($tSeq);

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
            <button type="button" onclick="location.href='types_list.php'" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <form action="types_edit.php" method="POST" onsubmit="return submitChk()">

            <input type="hidden" name="tSeq" value="<?php echo $tSeq; ?>">
            <input type="hidden" name="types_id" value="<?php echo $type->types_id; ?>">

            <table class="edit">
                <tr>
                    <th><span class="required">*</span>タイプ<span class="f50P"> (10)</span></th>
                    <td><input type="text" name="types_name" class="f130P wdtL" maxlength=10
                            style="ime-mode: active;" required placeholder="" value="<?php echo $type->types_name; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <th>タイプ説明</th>
                    <td><textarea name="types_note"  class="f130P wdtL" rows=8><?php echo $type->types_note; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="typeEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if(!empty($tSeq)){ ?>
        <form action="types_edit.php" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="tSeq" value="<?php echo $tSeq; ?>">

            <table class="del">
                <tr>
                    <td><button type=submit name="typeDel" class="del">このタイプを削除する</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>
    </div>
</body>

</html>