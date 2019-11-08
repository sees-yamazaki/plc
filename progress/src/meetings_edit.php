<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $mSeq = $_POST['mSeq'];

    require './db/meetings.php';
    $meeting = new cls_meetings();

    try {

        $meeting->meet_seq = $_POST['mSeq'];
        $meeting->meet_date = $_POST['meet_date'];
        $meeting->meet_title = $_POST['meet_title'];
        $meeting->gSeqs =  $_POST['gSeq'];
        
        if(isset($_POST['meetEdit'])){

            if(!empty($mSeq)){
                updateMeeting($meeting);
            }else{
                insertMeeting($meeting);
            }
            
            if(empty($errorMessage)){
                header("Location: ./meetings_list.php");
            }

        }else if(isset($_POST['meetDel'])){

            deleteMeeting($meeting);

            header("Location: ./meetings_list.php");

        }else{
            
            $meeting = getMeeting($mSeq);

        }


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    require './db/groups.php';
    $groups = array();
    $groups = getGroups();
    
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
            <button type="button" onclick="location.href='meetings_list.php'" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <form action="meetings_edit.php" method="POST" onsubmit="return addcheck()">

            <input type="hidden" name="mSeq" value="<?php echo $mSeq; ?>">

            
            <table class="edit">
                <tr>
                    <th><span class="required">*</span>開催日<span class="f50P"> (20)</span></th>
                    <td><input type="date" name="meet_date" class="f130P wdtS" required value="<?php echo $meeting->meet_date; ?>"></td>
                </tr>
                <tr>
                    <th><span class="required">*</span>会議名<span class="f50P"> (20)</span></th>
                    <td><input type="text" name="meet_title" class="f130P wdtL" maxlength=20
                            style="ime-mode: active;" required placeholder="" value="<?php echo $meeting->meet_title; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>マネージャー<span class="f50P"> (10)</span></th>
                    <td>
                    <?php foreach ($groups as $group) { ?>
                        <input type="checkbox" name="gSeq[]" value="<?php echo $group->groups_seq; ?>"><?php echo $group->groups_name; ?>　
                    <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="meetEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if(!empty($mSeq)){ ?>

        <form action="meetings_edit.php" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="mSeq" value="<?php echo $mSeq; ?>">

            <table class="del">
                <tr>
                    <td colspan=2><button type=submit name="meetDel" class="del wdtLL">このユーザを削除する</button></td>
                </tr>
                <tr>
                    <td colspan=2><button type=submit name="meetDel" class="del wdtLL">このユーザを削除する</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>
    </div>
</body>

</html>