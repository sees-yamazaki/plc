<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');


    $rSeq = $_POST['rSeq'];

    require './db/rooms.php';
    $room = new cls_rooms();

    try {

        
        if(isset($_POST['roomEdit'])){

            $room->rooms_seq = $_POST['rSeq'];
            $room->rooms_name = $_POST['rooms_name'];
            $room->rooms_text = $_POST['rooms_text'];

            if(!empty($rSeq)){
                updateRoom($room);
            }else{
                insertRoom($room);
            }
            
            
            if(empty($errorMessage)){
                header("Location: ./room_list.php");
            }

        }else if(isset($_POST['roomDel'])){

            $room->rooms_seq = $_POST['rSeq'];
            
            deleteRoom($room);

            header("Location: ./room_list.php");

        }else{
            
            $room = getRoom($rSeq);

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
    <title>会議室編集</title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../js/main.js"></script>
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

        <div class="nav">
            <button type="button" onclick="location.href='room_list.php'" class="back">戻る</button>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <form action="room_edit.php" method="POST" onsubmit="return submitChk()">

            <input type="hidden" name="rSeq" value="<?php echo $rSeq; ?>">

            <table class="edit">
                <tr>
                    <th><span class="required">*</span>会議室名<span class="f50P"> (20)</span></th>
                    <td><input type="text" id="rooms_name" name="rooms_name" class="f130P wdtL" maxlength=20
                            style="ime-mode: active;" required placeholder="" value="<?php echo $room->rooms_name; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <th>備考</th>
                    <td><textarea name="rooms_text" class="f130P wdtL" rows=5><?php echo $room->rooms_text; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="roomEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if(!empty($rSeq)){ ?>
        <form action="room_edit.php" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="rSeq" value="<?php echo $rSeq; ?>">

            <table class="del">
                <tr>
                    <td><button type=submit name="roomDel" class="del">この会議室を削除する</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>
    </div>
</body>

</html>