<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $sSeq = $_POST['sSeq'];
    $bSeq = $_POST['bSeq'];

    require './db/businesses.php';
    $business = new cls_businesses();

    try {

        $business->bus_seq = $_POST['bSeq'];
        $business->sys_seq = $_POST['sSeq'];
        $business->bus_que = $_POST['bus_que'];
        $business->bus_name = $_POST['bus_name'];
        
        if(isset($_POST['busEdit'])){

            if(!empty($bSeq)){
                updateBusiness($business);
            }else{
                insertBusiness($business);
            }
            
            if(empty($errorMessage)){
                header("Location: ./businesses_list.php?sSeq=".$business->sys_seq );
            }

        }else if(isset($_POST['busDel'])){

            deleteBusiness($business);

            header("Location: ./businesses_list.php?sSeq=".$business->sys_seq );

        }else{
            
            $business = getBusiness($bSeq);
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
    <title>PROGRESS</title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../js/main.js"></script>
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

        <div class="nav">
            <form action="businesses_list.php" method="POST">
            <input type="hidden" name="sSeq" value="<?php echo $sSeq; ?>">
            <button type="submit" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
            </form>
        </div><br>

        <form action="businesses_edit.php" method="POST" onsubmit="return addcheck()">

            <input type="hidden" name="sSeq" value="<?php echo $sSeq; ?>">
            <input type="hidden" name="bSeq" value="<?php echo $bSeq; ?>">
            <input type="hidden" name="bus_que" value="<?php echo $business->bus_que; ?>">

            <table class="edit">
                <tr>
                    <th><span class="required">*</span>中項目名<span class="f50P"> (20)</span></th>
                    <td><input type="text" name="bus_name" class="f130P wdtL" maxlength=20
                            style="ime-mode: active;" required placeholder="" value="<?php echo $business->bus_name; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="busEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if(!empty($bSeq)){ ?>

        <form action="businesses_edit.php" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="sSeq" value="<?php echo $sSeq; ?>">
            <input type="hidden" name="bSeq" value="<?php echo $bSeq; ?>">

            <table class="del">
                <tr>
                    <td colspan=2><button type=submit name="busDel" class="del wdtLL">削除する</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>
    </div>
</body>

</html>