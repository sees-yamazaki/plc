<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $gSeq = $_POST['gSeq'];

    require './db/giji.php';
    $giji = new cls_gijis();

    try {

        $giji->giji_seq = $gSeq;
        $giji->giji_id = $_POST['giji_id'];
        $giji->giji_date = $_POST['giji_date'];
        $giji->giji_title = $_POST['giji_title'];
        $giji->giji_note = $_POST['giji_note']; 
        $giji->giji_file1 =$_FILES['giji_file1']['name'];

        if(isset($_POST['gijiEdit'])){
            


            if(!empty($gSeq)){
                updateGiji($giji);
            }else{
                $gSeq = insertGiji($giji);
            }

            if(is_uploaded_file($_FILES['giji_file1']['tmp_name'])){
                if(move_uploaded_file($_FILES['giji_file1']['tmp_name'],"../files/".$gSeq."/".$_FILES['giji_file1']['name'])){
                    //
                }else{
                    echo "error while saving.";
                }
            }else{
                echo "file not uploaded.";
            }
        
            
            if(empty($errorMessage)){
                header("Location: ./home.php");
            }


        }else if(isset($_POST['gijiDel'])){

            deleteGiji($giji);

            header("Location: ./home.php");

        }else{
            
            $giji = getGiji($gSeq);

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
            <button type="button" onclick="location.href='home.php'" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <form action="" method="POST" onsubmit="return addcheck()" enctype="multipart/form-data">

            <input type="hidden" name="gSeq" value="<?php echo $gSeq; ?>">

            <table class="edit">
                <tr>
                    <th><span class="required">*</span>開催日</th>
                    <td>
                        <input type="date" name="giji_date" class="f130P wdtS" value="<?php echo $giji->giji_date; ?>" required>
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>管理番号<span class="f50P"> (10)</span></th>
                    <td><input type="text" name="giji_id" class="f130P wdtS" maxlength=10
                            style="ime-mode: active;" required  pattern="[0-9]+" title="半角数字" placeholder="半角数字" value="<?php echo $giji->giji_id; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>名称<span class="f50P"> (30)</span></th>
                    <td><input type="text" name="giji_title" class="f130P wdtL" maxlength=30
                            style="ime-mode: active;" required placeholder="" value="<?php echo $giji->giji_title; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <th>備考</th>
                    <td><textarea name="giji_note" class="f130P wdtL" rows=5><?php echo $giji->giji_note; ?></textarea></td>
                </tr>
                <tr>
                    <th>添付ファイル</th>
                    <td><input type="file" name="giji_file1"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="gijiEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if(!empty($gSeq)){ ?>


        <form action="" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="gSeq" value="<?php echo $gSeq; ?>">

            <table class="del">
                <tr>
                    <td colspan=2><button type=submit name="gijiDel" class="del wdtLL">削除する</button></td>
                </tr>
                <tr>
                    <td colspan=2><button type=submit name="gijiDel" class="del wdtLL">削除する</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>
    </div>
</body>

</html>