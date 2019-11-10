<?php
function getSchedule($uSeq, $tDate){
    
    $ini = parse_ini_file('../common.ini', FALSE);
    $wY = intval(date('Y',  strtotime($tDate)));
    $wM = intval(date('m',  strtotime($tDate)));
    $wD = intval(date('d',  strtotime($tDate)));
//    echo $uSeq . " -a- " . $wY .  " -b- " . $wM .  " -c- " . $wD  .  " -|- ";
    $pdo = new PDO('mysql:dbname=' . $ini['dbname'] . ';host=' . $ini['host'] , $ini['dbuser'] , $ini['dbpass'] );
    $stmt = $pdo->prepare('SELECT * FROM schedule WHERE user_seq = ? and work_y = ? and work_m = ? and work_d = ?');
    $stmt->execute(array($uSeq,$wY,$wM,$wD));

    return $stmt->fetch(PDO::FETCH_ASSOC);
}



session_start();


    // ログイン状態チェック
    if (!isset($_SESSION["NAME"])) {
        header("Location: Logout.php");
        exit;
    }

    $ini = parse_ini_file('../common.ini', FALSE);

    $w = date("w");
    $week_name = array("日", "月", "火", "水", "木", "金", "土");

    $printDate = date("Y/m/d") ."(" . ($week_name[$w]) . ")"; 

    if (!isset($_SESSION["MODE"])) {
        echo "access denied";
        //header("Location: home.php");
    }
    

    if ($_SESSION["MODE"]=="TEMP") {
        
        // 3. エラー処理
        try {
            
            require_once 'dns.php';
            
            // 作業情報を取得する
            if($row = getSchedule($_SESSION["SEQ"],date('Y-m-d'))){
                $hasSchedule = TRUE;
            }else{
                $hasSchedule = FALSE;
            }
            
            // 編集の場合は　STTS指定あり
            if(isset($_GET["stts"])){
                $stts = (int)$_GET["stts"];
                $sSeq = $_SESSION["sche_seq"];
            }else{
                $stts = 0;
            }

            // 元レーコードが存在する場合だけ更新処理を実行
            if ($hasSchedule){
                if($stts==1){
                    if(!isset($row['leave_time'])){
                        $stmt = $pdo->prepare('UPDATE schedule SET leave_time = NOW() WHERE sche_seq = ?');
                        $stmt->execute(array($sSeq));
                    }
                }elseif($stts==2){
                    if(!isset($row['start_time'])){
                        $stmt = $pdo->prepare('UPDATE schedule SET start_time = NOW() WHERE sche_seq = ?');
                        $stmt->execute(array($sSeq));
                    }
                }elseif($stts==3){
                    if(!isset($row['end_time'])){
                        $stmt = $pdo->prepare('UPDATE schedule SET end_time = NOW() WHERE sche_seq = ?');
                        $stmt->execute(array($sSeq));
                    }
                }
                // 作業情報を更新する
                $row = getSchedule($_SESSION["SEQ"],date('Y-m-d'));
            }

            if ($hasSchedule){
                $_SESSION["sche_seq"] = $row['sche_seq'];
                if(isset($row['plan_start_time'])){
                    $pTime = date('H:i',  strtotime($row['plan_start_time']))." - ".date('H:i',  strtotime($row['plan_end_time']));
                }else{
                    $pTime = "未登録　※シフト入力がされてない場合は担当営業に連絡してください。";
                    $stts = 99;
                }
                if(isset($row['leave_time'])){
                    $lTime = date('H:i',  strtotime($row['leave_time']));
                    $stts = 1;
                }else{
                    $lTime = "未登録";
                }
                if(isset($row['start_time'])){
                    $sTime = date('H:i',  strtotime($row['start_time']));
                    $stts = 2;
                }else{
                    $sTime = "未登録";
                }
                if(isset($row['end_time'])){
                    $eTime = date('H:i',  strtotime($row['end_time']));
                    $stts = 3;
                }else{
                    $eTime = "未登録";
                }
                

            } else {
                //作業データ無し
                $pTime = "未登録　※シフト入力がされてない場合は担当営業に連絡してください。";
                $stts = 99;
                $errorMessage = '情報の取得に失敗しました。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            if(strcmp("1",$ini['debug'])==0){
                echo $e->getMessage();
            }
        }
    }


?>
<!DOCTYPE html>
<html>

<head class="wf-sawarabigothic">
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/staff.css">
    <link rel="stylesheet" type="text/css" href="../css/hiraku.css">
    <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="../js/hiraku.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
</head>

<body>

    <?php include('./staffMenu.php'); ?>

    <div class='headbutton'><a href='staff.php'><img src='../img/home.png'></a></div>

    <?php echo $errorMessage; ?>


    <table class="work fnt3em">
        <tbody>
            <tr>
                <th class="arrow_box">日付</th>
                <td colspan="2"><?php echo $printDate; ?></td>
            </tr>
            <tr>
                <th class="arrow_box">シフト</th>
                <td colspan="2"><?php echo $pTime; ?></td>
            </tr>

            <tr>
                <th class="arrow_box">出発時間</th>
                <td class="time"><?php echo $lTime; ?></td>
                <?php if($stts==0){ ?>
                <td class="btn"><a href="staffWork.php?stts=1" class="btn-sticky">登録</a></td>
                <?php }else{ ?>
                <td class="btn"><a href="#" class="btn-sticky-off">登録</a></td>
                <?php } ?>
            </tr>
            <tr>
                <th class="arrow_box">入店時間</th>
                <td class="time"><?php echo $sTime; ?></td>
                <?php if($stts==1){ ?>
                <td class="btn"><a href="staffWork.php?stts=2" class="btn-sticky">登録</a></td>
                <?php }else{ ?>
                <td class="btn"><a href="#2" class="btn-sticky-off">登録</a></td>
                <?php } ?>
            </tr>
            <tr>
                <th class="arrow_box">退店時間</th>
                <td class="time"><?php echo $eTime; ?></td>
                <?php if($stts==2){ ?>
                <td class="btn"><a href="staffWork.php?stts=3" class="btn-sticky">登録</a></td>
                <?php }else{ ?>
                <td class="btn"><a href="#" class="btn-sticky-off">登録</a></td>
                <?php } ?>
            </tr>
        </tbody>
    </table>


</body>

</html>
