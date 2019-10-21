<?php
session_start();

    // タイムゾーンを設定
    date_default_timezone_set('Asia/Tokyo');

    $sSeq = $_GET['sSeq'];
    $ymd = $_GET['ymd'];

    $mCal = $_POST['mCal'];
    if(empty($mCal)){
        $mCal = $_GET['mCal'];
    }

    
    try {
        
        require './db/schedules.php';
        $sche = new cls_schedules();
        $sche = getSchedules($sSeq);

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
    <title>会議室使用</title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../js/main.js"></script>
</head>

<body>

    <?php include('./menu.php'); ?>

    <div id="content">

        <div class="nav">
            <?php if(empty($mCal)){ ?>
                <button type="button" onclick="location.href='cal_day.php?ymd=<?php echo $ymd; ?>'" class="back">戻る</button>
            <?php }else{ ?>
                <button type="button" onclick="location.href='cal_month.php?ym=<?php echo $mCal; ?>'" class="back">戻る</button>
            <?php }?>
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <form action="sche_edit.php" method="POST" onsubmit="return submitChk()">

            <input type="hidden" name="sSeq" value="<?php echo $sSeq; ?>">
            <input type="hidden" name="ymd" value="<?php echo $ymd; ?>">
            <input type="hidden" name="mCal" value="<?php echo $mCal; ?>">

            <table class="edit">
                <tr>
                    <th>会議室名</th>
                    <td>
                        <?php echo $sche->rooms_name; ?>
                    </td>
                </tr>
                <tr>
                    <th>開始日時</th>
                    <td>
                        <?php echo date('Y-m-d H:i',  strtotime($sche->sche_start_dt)); ?>
                    </td>
                </tr>
                <tr>
                    <th>終了日時</th>
                    <td>
                    <?php echo date('Y-m-d H:i',  strtotime($sche->sche_end_dt)); ?>
                    </td>
                </tr>
            </table>

        </form>

    </div>
</body>

</html>