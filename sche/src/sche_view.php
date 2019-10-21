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

        if(($sche->sche_type=="2") && ($sche->users_seq<>$_SESSION['SEQ'])){
            $sche = new cls_schedules();
            $errorMessage = 'この情報を閲覧することはできません';
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
    <title>スケジュール編集</title>
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
                    <th>開始日時</th>
                    <td>
                        <?php if($sche->sche_allday=="0"){ ?>
                            <?php echo date('Y-m-d H:i',  strtotime($sche->sche_start_dt)); ?>
                        <?php }else{ ?>
                            <?php echo date('Y-m-d',  strtotime($sche->sche_start_dt)); ?>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th>終了日時</th>
                    <td>
                    <?php if($sche->sche_allday=="0"){ ?>
                        <?php echo date('Y-m-d H:i',  strtotime($sche->sche_end_dt)); ?>
                    <?php }else{ ?>
                        <?php echo date('Y-m-d',  strtotime($sche->sche_end_dt)); ?>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th>タイトル</th>
                    <td>
                        <?php echo $sche->sche_title; ?>
                    </td>
                </tr>
                <tr>
                    <th>公開範囲</th>
                    <td>
                        <?php
                            if($sche->sche_type =="1"){
                                $type="公開";
                            }else{
                                $type="非公開";
                            }
                        ?>
                        <?php echo $type; ?>
                    </td>
                </tr>
                <tr>
                    <th>スケジュール</th>
                    <td><?php echo nl2br($sche->sche_note); ?></td>
                </tr>
                <tr>
                    <th>会議室</th>
                    <td>
                        <?php if($sche->rooms_seq==0){ ?>
                            使用無し
                        <?php }else{ ?>
                            <?php echo $sche->rooms_name; ?>
                        <?php } ?>
                    </td>
                </tr>
                <?php if($sche->users_seq==$_SESSION['SEQ']){  ?>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="scheView" class="sbmt f110P">編集</button>
                    </td>
                </tr>
                <?php } ?>
            </table>

        </form>

    </div>
</body>

</html>