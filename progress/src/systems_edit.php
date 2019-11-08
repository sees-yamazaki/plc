<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $sSeq = $_POST['sSeq'];

    require './db/systems.php';
    $system = new cls_systems();

    try {

        $system->sys_seq = $_POST['sSeq'];
        $system->sys_que = $_POST['sys_que'];
        $system->sys_name = $_POST['sys_name'];
        
        if(isset($_POST['sysEdit'])){

            if(!empty($sSeq)){
                updateSystem($system);
            }else{
                insertSystem($system);
            }
            
            if(empty($errorMessage)){
                header("Location: ./systems_list.php");
            }

        }else if(isset($_POST['sysDel'])){

            deleteSystem($system);

            header("Location: ./systems_list.php");

        }else{
            
            $system = getSystem($sSeq);
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
            <form action="systems_list.php" method="POST">
            <button type="submit" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
            </form>
        </div><br>

        <form action="systems_edit.php" method="POST" onsubmit="return addcheck()">

            <input type="hidden" name="sSeq" value="<?php echo $sSeq; ?>">
            <input type="hidden" name="sys_que" value="<?php echo $system->sys_que; ?>">

            <table class="edit">
                <tr>
                    <th><span class="required">*</span>大項目名<span class="f50P"> (20)</span></th>
                    <td><input type="text" name="sys_name" class="f130P wdtL" maxlength=20
                            style="ime-mode: active;" required placeholder="" value="<?php echo $system->sys_name; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="sysEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if(!empty($sSeq)){ ?>

        <form action="systems_edit.php" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="sSeq" value="<?php echo $sSeq; ?>">

            <table class="del">
                <tr>
                    <td colspan=2><button type=submit name="sysDel" class="del wdtLL">削除する</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>
    </div>
</body>

</html>