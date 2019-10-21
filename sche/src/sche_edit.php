<?php
session_start();

    // タイムゾーンを設定
    date_default_timezone_set('Asia/Tokyo');

    $sSeq = $_POST['sSeq'];
    $ymd = $_POST['ymd'];
    if(empty($ymd)){
        $ymd = $_GET['ymd'];
    }

    $mCal = $_POST['mCal'];
    if(empty($mCal)){
        $mCal = $_GET['mCal'];
    }

    $hm = date('H:i', time());

    require './db/schedules.php';
    $sche = new cls_schedules();

    try {

        
        if(isset($_POST['scheEdit'])){

            $sche->sche_seq = $_POST['sSeq'];
            $sche->users_seq = $_SESSION['SEQ'];
            $sche->sche_allday = $_POST['sche_allday'];
            if($sche->sche_allday=="0"){
                $sche->sche_start_dt = $_POST['sche_start_ymd']." ".$_POST['sche_start_hm'];
                $sche->sche_start_hm = str_replace(":","",$_POST['sche_start_hm']);
                $sche->sche_end_dt = $_POST['sche_end_ymd']." ".$_POST['sche_end_hm'];
                $sche->sche_end_hm = str_replace(":","",$_POST['sche_end_hm']);
            }else{
                $sche->sche_start_dt = $_POST['sche_start_ymd']." 00:00";
                $sche->sche_start_hm = "0000";
                $sche->sche_end_dt = $_POST['sche_end_ymd']." 23:59";
                $sche->sche_end_hm = "2359";
            }
            //$sche->users_name = $_POST['users_name'];
            $sche->sche_start_ymd = str_replace("-","",$_POST['sche_start_ymd']);
            $tmpSYMD =  $_POST['sche_start_ymd'];
            $sche->sche_start_ym = substr($sche->sche_start_ymd,0,6);
            $sche->sche_end_ymd = str_replace("-","",$_POST['sche_end_ymd']);
            $sche->sche_end_ym = substr($sche->sche_end_ymd,0,6);
            $sche->sche_title = $_POST['sche_title'];
            $sche->sche_note = $_POST['sche_note'];
            $sche->sche_type = $_POST['sche_type'];
            $sche->rooms_seq = $_POST['rooms_seq'];

            if($sche->sche_start_dt > $sche->sche_end_dt  ){
                $errorMessage = '開始日時と終了日時の指定が間違っています';
            }else{
                if(!empty($sSeq)){
                    updateSchedule($sche);
                }else{
                    insertSchedule($sche);
                }

            }
                
            if(empty($errorMessage)){
                if(empty($mCal)){
                    header("Location: ./cal_day.php?ymd=".$tmpSYMD);
                }else{
                    header("Location: ./cal_month.php?ym=".$mCal);
                }
            }

            

        }else if(isset($_POST['scheDel'])){

            $sche->sche_seq = $_POST['sSeq'];
            
            deleteSchedule($sche);

            if(empty($mCal)){
                header("Location: ./cal_day.php?ymd=".$tmpSYMD);
            }else{
                header("Location: ./cal_month.php?ym=".$mCal);
            }

        }else{
            
            $sche = getSchedules($sSeq);

            if((!empty($sSeq)) && ($sche->users_seq<>$_SESSION['SEQ'])){
                $sche = new cls_schedules();
                $errorMessage = 'この情報を編集することができません';
            }

            if(empty($sSeq)){
                $sche->sche_start_dt = $ymd." ".$hm;
                $sche->sche_end_dt = $ymd." ".$hm;
            }

        }


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    $ad0 = " checked";
    $ad1 = "";
    if($sche->sche_allday=="1"){
        $ad0 = "";
        $ad1 = " checked";
    }
        

        
        // 全ての会議室を取得
        require './db/rooms.php';
        $rooms = array();
        $rooms = getRooms();

        $html="";
        foreach ($rooms as $room) {
            if($room->rooms_seq==$sche->rooms_seq){
                $html .= "<option value='".$room->rooms_seq."' selected>".$room->rooms_name."</option>";
            }else{
                $html .= "<option value='".$room->rooms_seq."'>".$room->rooms_name."</option>";
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
    <script type="text/javascript">
        window.onload = function()
        {
            // 通常のチェンジイベントを登録
            var ad0 = document.getElementById("sche_allday0");
            var ad1 = document.getElementById("sche_allday1");
            var shm = document.getElementById("sche_start_hm");
            var ehm = document.getElementById("sche_end_hm");

            if(ad1.checked){
                shm.style.visibility = "hidden";
                ehm.style.visibility = "hidden";
            }
            
            ad0.addEventListener("change", function(e){
                shm.style.visibility = "visible";
                ehm.style.visibility = "visible";
            }, false);
            ad1.addEventListener("change", function(e){
                shm.style.visibility = "hidden";
                ehm.style.visibility = "hidden";
            }, false);
            shm.addEventListener("change", function(e){
                const date1 = new Date(2000,1,1,shm.value.substring(0,2),shm.value.substring(3));
                date1.setHours(date1.getHours() + 1);
                var hh = date1.getHours();
                var mm = date1.getMinutes();
                if(hh<10){ hh = "0" + hh; }
                if(mm<10){ mm = "0" + mm; }
                if(hh=="00"){
                    ehm.value = "23:" + mm;
                }else{
                    ehm.value = hh + ":" + mm;
                }
            }, false);
            
        };
    </script>
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
                    <th><span class="required">*</span>指定方法</th>
                    <td>
                        <input type="radio" name="sche_allday"  id="sche_allday0" class="f130P" onclick="funcAllDay(0)" value="0" <?php echo $ad0; ?>>時刻指定
                        <input type="radio" name="sche_allday"  id="sche_allday1" class="f130P" onclick="funcAllDay(1)" value="1" <?php echo $ad1; ?>>日付指定
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>開始日時</th>
                    <td>
                        <input type="date" name="sche_start_ymd" class="f130P" value="<?php echo date('Y-m-d',  strtotime($sche->sche_start_dt)); ?>">
                        <input type="time" name="sche_start_hm" id="sche_start_hm" class="f130P" value="<?php echo date('H:i',  strtotime($sche->sche_start_dt)); ?>">
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>終了日時</th>
                    <td>
                        <input type="date" name="sche_end_ymd" class="f130P" value="<?php echo date('Y-m-d',  strtotime($sche->sche_end_dt)); ?>">
                        <input type="time" name="sche_end_hm" id="sche_end_hm" class="f130P" value="<?php echo date('H:i',  strtotime($sche->sche_end_dt)); ?>">
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>タイトル<span class="f50P"> (50)</span></th>
                    <td><input type="text" name="sche_title" class="f130P wdtL" maxlength=50
                            style="ime-mode: active;" required placeholder="" value="<?php echo $sche->sche_title; ?>" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <th><span class="required">*</span>公開範囲</th>
                    <td>
                        <?php
                            if(empty($sche->sche_type) || $sche->sche_type =="1"){
                                $type1=" checked";
                                $type2="";
                            }else{
                                $type1="";
                                $type2=" checked";
                            }
                        ?>
                        <input type="radio" name="sche_type" value="1" <?php echo $type1; ?>>公開
                        <input type="radio" name="sche_type" value="2" <?php echo $type2; ?>>非公開
                    </td>
                </tr>
                <tr>
                    <th>スケジュール</th>
                    <td><textarea name="sche_note" class="f130P wdtL" rows=5><?php echo $sche->sche_note; ?></textarea></td>
                </tr>
                <tr>
                    <th>会議室</th>
                    <td>
                        <select name="rooms_seq" class="f130P wdtL">
                            <option value='0'>使用しない</option>
                            <?php echo $html; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <button type=submit name="scheEdit" class="sbmt f110P">登録</button>
                    </td>
                </tr>
            </table>

        </form>


        <?php if(!empty($sSeq)){ ?>
        <form action="sche_edit.php" method="POST" onsubmit="return delcheck()">

            <input type="hidden" name="sSeq" value="<?php echo $sSeq; ?>">
            <input type="hidden" name="ymd" value="<?php echo $ymd; ?>">
            <input type="hidden" name="mCal" value="<?php echo $mCal; ?>">

            <table class="del">
                <tr>
                    <td><button type=submit name="scheDel" class="del">このスケジュールを削除する</button></td>
                </tr>
            </table>

        </form>
        <?php } ?>
    </div>
</body>

</html>