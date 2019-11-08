<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

    $tSeq = $_POST['tSeq'];

    require './db/tasks.php';
    $task = new cls_tasks();

    try {

        $task->tsk_seq = $_POST['tSeq'];
        $task->tsk_k1 = $_POST['tsk_k1'];
        $task->tsk_k2 = $_POST['tsk_k2'];
        $task->tsk_i1 = $_POST['tsk_i1'];
        $task->tsk_i2 = $_POST['tsk_i2'];
        $task->tsk_i3 = $_POST['tsk_i3'];
        $task->tsk_i4 = $_POST['tsk_i4'];
        $task->tsk_i5 = $_POST['tsk_i5'];
        $task->tsk_i6 = $_POST['tsk_i6'];
        $task->tsk_i7 = $_POST['tsk_i7'];
        $task->tsk_i8 = $_POST['tsk_i8'];
        $task->tsk_i9 = $_POST['tsk_i9'];
        $task->tsk_i10 = $_POST['tsk_i10'];
        
        if(isset($_POST['tskEdit'])){

            updateTaskStts($task);
            
            if(empty($errorMessage)){
                header("Location: ./progress.php");
            }

        }else{
            
            $task = getTask($tSeq);
        }


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    if($task->tsk_k1==1){ $k1_1 = " checked"; }else{ $k1_0 = " checked"; }
    if($task->tsk_k2==1){ $k2_1 = " checked"; }else{ $k2_0 = " checked"; }
    if($task->tsk_i1==1){ $i1_1 = " checked"; }else{ $i1_0 = " checked"; }
    if($task->tsk_i2==1){ $i2_1 = " checked"; }else{ $i2_0 = " checked"; }
    if($task->tsk_i3==1){ $i3_1 = " checked"; }else{ $i3_0 = " checked"; }
    if($task->tsk_i4==1){ $i4_1 = " checked"; }else{ $i4_0 = " checked"; }
    if($task->tsk_i5==1){ $i5_1 = " checked"; }else{ $i5_0 = " checked"; }
    if($task->tsk_i6==1){ $i6_1 = " checked"; }else{ $i6_0 = " checked"; }
    if($task->tsk_i7==1){ $i7_1 = " checked"; }else{ $i7_0 = " checked"; }
    if($task->tsk_i8==1){ $i8_1 = " checked"; }else{ $i8_0 = " checked"; }
    if($task->tsk_i9==1){ $i9_1 = " checked"; }else{ $i9_0 = " checked"; }
    if($task->tsk_i10==1){ $i10_1 = " checked"; }else{ $i10_0 = " checked"; }

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
            <form action="progress.php" method="POST">
            <button type="submit" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
            </form>
        </div><br>

        <form action="tasks_check.php" method="POST" onsubmit="return addcheck()">

            <input type="hidden" name="tSeq" value="<?php echo $tSeq; ?>">

            <table class="edit">
                <tr>
                    <th><span class="required">*</span>実行タスク<span class="f50P"> (30)</span></th>
                    <td><?php echo $task->tsk_name; ?></td>
                </tr>
                <tr>
                    <th><span class="required">*</span>機電1G</th>
                    <td>
                        <input type="radio" name="tsk_k1" value="0" <?php echo $k1_0; ?>>未済　
                        <input type="radio" name="tsk_k1" value="1" <?php echo $k1_1; ?>>済　
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>機電2G</th>
                    <td>
                        <input type="radio" name="tsk_k2" value="0" <?php echo $k2_0; ?>>未済　
                        <input type="radio" name="tsk_k2" value="1" <?php echo $k2_1; ?>>済　
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>ITS1G</th>
                    <td>
                        <input type="radio" name="tsk_i1" value="0" <?php echo $i1_0; ?>>未済　
                        <input type="radio" name="tsk_i1" value="1" <?php echo $i1_1; ?>>済　
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>ITS2G</th>
                    <td>
                        <input type="radio" name="tsk_i2" value="0" <?php echo $i2_0; ?>>未済　
                        <input type="radio" name="tsk_i2" value="1" <?php echo $i2_1; ?>>済　
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>ITS3G</th>
                    <td>
                        <input type="radio" name="tsk_i3" value="0" <?php echo $i3_0; ?>>未済　
                        <input type="radio" name="tsk_i3" value="1" <?php echo $i3_1; ?>>済　
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>ITS4G</th>
                    <td>
                        <input type="radio" name="tsk_i4" value="0" <?php echo $i4_0; ?>>未済　
                        <input type="radio" name="tsk_i4" value="1" <?php echo $i4_1; ?>>済　
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>ITS5G</th>
                    <td>
                        <input type="radio" name="tsk_i5" value="0" <?php echo $i5_0; ?>>未済　
                        <input type="radio" name="tsk_i5" value="1" <?php echo $i5_1; ?>>済　
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>ITS6G</th>
                    <td>
                        <input type="radio" name="tsk_i6" value="0" <?php echo $i6_0; ?>>未済　
                        <input type="radio" name="tsk_i6" value="1" <?php echo $i6_1; ?>>済　
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>ITS7G</th>
                    <td>
                        <input type="radio" name="tsk_i7" value="0" <?php echo $i7_0; ?>>未済　
                        <input type="radio" name="tsk_i7" value="1" <?php echo $i7_1; ?>>済　
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>ITS8G</th>
                    <td>
                        <input type="radio" name="tsk_i8" value="0" <?php echo $i8_0; ?>>未済　
                        <input type="radio" name="tsk_i8" value="1" <?php echo $i8_1; ?>>済　
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>ITS9G</th>
                    <td>
                        <input type="radio" name="tsk_i9" value="0" <?php echo $i9_0; ?>>未済　
                        <input type="radio" name="tsk_i9" value="1" <?php echo $i9_1; ?>>済　
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>ITS10G</th>
                    <td>
                        <input type="radio" name="tsk_i10" value="0" <?php echo $i10_0; ?>>未済　
                        <input type="radio" name="tsk_i10" value="1" <?php echo $i10_1; ?>>済　
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="tskEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>

    </div>
</body>

</html>