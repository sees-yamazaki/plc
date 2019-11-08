<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $sSeq = $_POST['sSeq'];
    $bSeq = $_POST['bSeq'];
    $wSeq = $_POST['wSeq'];

    require './db/works.php';
    $work = new cls_works();

    try {

        $work->bus_seq = $_POST['bSeq'];
        $work->sys_seq = $_POST['sSeq'];
        $work->wk_seq = $_POST['wSeq'];
        $work->wk_que = $_POST['wk_que'];
        $work->wk_name = $_POST['wk_name'];
        $work->wk_note = $_POST['wk_note'];
        $work->wk_level = $_POST['wk_level'];
        
        if(isset($_POST['wkEdit'])){

            if(!empty($wSeq)){
                updateWork($work);
            }else{
                insertWork($work);
            }
            
            if(empty($errorMessage)){
                header("Location: ./works_list.php?sSeq=".$work->sys_seq."&bSeq=".$work->bus_seq );
            }

        }else if(isset($_POST['wkDel'])){

            deleteWork($work);

            header("Location: ./works_list.php?sSeq=".$work->sys_seq."&bSeq=".$work->bus_seq );

        }else{
            
            $work = getWork($wSeq);
        }


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
    if($work->wk_level=="1"){
        $lv1=" checked";
    }else if($work->wk_level=="2"){
        $lv2=" checked";
    }else if($work->wk_level=="3"){
        $lv3=" checked";
    }else if($work->wk_level=="4"){
        $lv4=" checked";
    }else if($work->wk_level=="5"){
        $lv5=" checked";
    }else if($work->wk_level=="6"){
        $lv6=" checked";
    }else{
        $lv0=" checked";
    }
    

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>PROGRESS</title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../js/main.js"></script>
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

        <div class="nav">
            <form action="works_list.php" method="POST">
            <input type="hidden" name="sSeq" value="<?php echo $sSeq; ?>">
            <input type="hidden" name="bSeq" value="<?php echo $bSeq; ?>">
            <button type="submit" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
            </form>
        </div><br>

        <form action="works_edit.php" method="POST" onsubmit="return addcheck()">

            <input type="hidden" name="sSeq" value="<?php echo $sSeq; ?>">
            <input type="hidden" name="bSeq" value="<?php echo $bSeq; ?>">
            <input type="hidden" name="wSeq" value="<?php echo $wSeq; ?>">
            <input type="hidden" name="wk_que" value="<?php echo $work->wk_que; ?>">

            <table class="edit">
                <tr>
                    <th><span class="required">*</span>小項目名<span class="f50P"> (20)</span></th>
                    <td><input type="text" name="wk_name" class="f130P wdtL" maxlength=20
                            style="ime-mode: active;" required placeholder="" value="<?php echo $work->wk_name; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>優先度</th>
                    <td>
                        <input type="radio" name="wk_level" value="1" required <?php echo $lv1; ?>>SSS　
                        <input type="radio" name="wk_level" value="2" <?php echo $lv2; ?>>SS　
                        <input type="radio" name="wk_level" value="3" <?php echo $lv3; ?>>S　
                        <input type="radio" name="wk_level" value="4" <?php echo $lv4; ?>>A　
                        <input type="radio" name="wk_level" value="5" <?php echo $lv5; ?>>B　
                        <input type="radio" name="wk_level" value="6" <?php echo $lv6; ?>>C　
                        <input type="radio" name="wk_level" value="0" <?php echo $lv0; ?>>-　
                    </td>
                </tr>
                <tr>
                    <th>備考<span class="f50P"> (200)</span></th>
                    <td><textarea name="wk_note"  class="f130P wdtL" rows=8><?php echo $work->wk_note; ?></textarea></td>

                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="wkEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if(!empty($wSeq)){ ?>

        <form action="works_edit.php" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="sSeq" value="<?php echo $sSeq; ?>">
            <input type="hidden" name="bSeq" value="<?php echo $bSeq; ?>">
            <input type="hidden" name="wSeq" value="<?php echo $wSeq; ?>">

            <table class="del">
                <tr>
                    <td colspan=2><button type=submit name="wkDel" class="del wdtLL">削除する</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>
    </div>
</body>

</html>