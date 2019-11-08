<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $sSeq = $_POST['sSeq'];
    $bSeq = $_POST['bSeq'];
    $wSeq = $_POST['wSeq'];
    $tSeq = $_POST['tSeq'];

    require './db/tasks.php';
    $task = new cls_tasks();

    try {

        $task->bus_seq = $_POST['bSeq'];
        $task->sys_seq = $_POST['sSeq'];
        $task->wk_seq = $_POST['wSeq'];
        $task->tsk_seq = $_POST['tSeq'];
        $task->tsk_que = $_POST['tsk_que'];
        $task->tsk_name = $_POST['tsk_name'];
        
        if(isset($_POST['tskEdit'])){

            if(!empty($tSeq)){
                updateTask($task);
            }else{
                insertTask($task);
            }
            
            if(empty($errorMessage)){
                header("Location: ./tasks_list.php?sSeq=".$task->sys_seq."&bSeq=".$task->bus_seq."&wSeq=".$task->wk_seq );
            }

        }else if(isset($_POST['tskDel'])){

            deleteTask($task);

            header("Location: ./tasks_list.php?sSeq=".$task->sys_seq."&bSeq=".$task->bus_seq."&wSeq=".$task->wk_seq );

        }else{
            
            $task = getTask($tSeq);
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
            <form action="tasks_list.php" method="POST">
            <input type="hidden" name="sSeq" value="<?php echo $sSeq; ?>">
            <input type="hidden" name="bSeq" value="<?php echo $bSeq; ?>">
            <input type="hidden" name="wSeq" value="<?php echo $wSeq; ?>">
            <button type="submit" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
            </form>
        </div><br>

        <form action="tasks_edit.php" method="POST" onsubmit="return addcheck()">

            <input type="hidden" name="sSeq" value="<?php echo $sSeq; ?>">
            <input type="hidden" name="bSeq" value="<?php echo $bSeq; ?>">
            <input type="hidden" name="wSeq" value="<?php echo $wSeq; ?>">
            <input type="hidden" name="tSeq" value="<?php echo $tSeq; ?>">
            <input type="hidden" name="tsk_que" value="<?php echo $task->tsk_que; ?>">

            <table class="edit">
                <tr>
                    <th><span class="required">*</span>実行タスク<span class="f50P"> (30)</span></th>
                    <td><input type="text" name="tsk_name" class="f130P wdtL" maxlength=30
                            style="ime-mode: active;" required placeholder="" value="<?php echo $task->tsk_name; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="tskEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if(!empty($tSeq)){ ?>

        <form action="tasks_edit.php" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="sSeq" value="<?php echo $sSeq; ?>">
            <input type="hidden" name="bSeq" value="<?php echo $bSeq; ?>">
            <input type="hidden" name="wSeq" value="<?php echo $wSeq; ?>">
            <input type="hidden" name="tSeq" value="<?php echo $tSeq; ?>">

            <table class="del">
                <tr>
                    <td colspan=2><button type=submit name="tskDel" class="del wdtLL">削除する</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>
    </div>
</body>

</html>