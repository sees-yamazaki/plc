<?php

session_start();

require_once 'date.php';

    // ログイン状態チェック
    if (!isset($_SESSION["NAME"])) {
        header("Location: Logout.php");
        exit;
    }

    $ini = parse_ini_file('../common.ini', FALSE);
    if(isset($_GET['ty'])){
        $tgtTime = getTimestamp_LastDate($_GET['ty'],$_GET['tm']);
        $firstday =  getTimestamp($_GET['ty'],$_GET['tm']);
    }else{
        $tgtTime = getTimestamp_LastDate('','');
        $firstday =  getTimestamp('','');
    }

    $nextTime = getTimestamp_NextMonth($firstday);
    $nextY = date('Y',  $nextTime);
    $nextM = date('m',  $nextTime);
    $lastTime = getTimestamp_LastMonth($firstday);
    $lastY = date('Y',  $lastTime);
    $lastM = date('m',  $lastTime);

    if ($_SESSION["MODE"]=="TEMP") {
        
        // 3. エラー処理
        try {
            
            require_once 'dns.php';
            $uSeq = $_SESSION['SEQ'];
            $wY = intval(date('Y',  $tgtTime));
            $wM = intval(date('m',  $tgtTime));
            $wD = intval(date('d',  $tgtTime));
            
            $wk = intval(date("w",  $firstday));
            $week_name = array("日", "月", "火", "水", "木", "金", "土");

            
            $stmt = $pdo->prepare('SELECT * FROM schedule WHERE user_seq = ? and work_y = ? and work_m = ? ');
            $stmt->execute(array($uSeq,$wY,$wM));
            $rows = $stmt->fetchAll();
            
            $html="";
            for($i = 1; $i <= idate('t',$tgtTime); ++$i) {
                $str="";
                foreach ($rows as $row) {
                    if($row['work_d']==$i){
                        $str = date('H:i',  strtotime($row['plan_start_time']))." - ".date('H:i',  strtotime($row['plan_end_time']));
                    }
                }
                if($str==""){
                    $str="--:-- - --:--";
                }
                $x = ($wk + $i - 1) % 7;
                $html.="<tr><th>".$wM." / ".$i." (" . ($week_name[$x]) . ")</th><td class='plan' colspan=2>".$str."</td></tr>";
            }



            //申請情報の状況を確認する
            $realNextTime = getTimestamp_RealNextMonth();
            $realNextY = date('Y',  $realNextTime);
            $realNextM = date('m',  $realNextTime);
            if($wY==$realNextY && $wM==$realNextM){
                $stmt = $pdo->prepare('SELECT * FROM auth_work WHERE employee_seq = ? and work_y = ? and work_m = ? ');
                $stmt->execute(array($uSeq,$realNextY,$realNextM));
                if($row = $stmt->fetch()){
                    $status = $row['status'];
                }else{
                    $status="0";
                }
            }else{
                $status="2";
            }
            
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            if(strcmp("1",$ini['debug'])==0){
                echo $e->getMessage();
            }
        }
    }

    //$fButton = "<div class='headbutton'><a href='staff.php'><img src='../img/home.png'></a></div>";
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
    <div class="wrapper">

        <?php include('./staffMenu.php'); ?>

        <div class='headbutton'><a href='staff.php'><img src='../img/home.png'></a></div>

        <?php echo $errorMessage; ?>

        <table class="cal fnt2em">
            <tr>
                <td style="text-align:left"><a href="staffCal.php?ty=<?php echo $lastY; ?>&tm=<?php echo $lastM; ?>" class="btn-sticky">＜＜</a></td>
                <td class="titleYM fnt1p5em"><?php echo $wY; ?> / <?php echo $wM; ?></td>
                <td style="text-align:right"><a href="staffCal.php?ty=<?php echo $nextY; ?>&tm=<?php echo $nextM; ?>" class="btn-sticky">＞＞</a></td>
            </tr>
            <?php if($status<>"2"){ ?>
            <form action="staffRec.php" method="post">
            <tr><td colspan="3"><button type=submit name="" class="btn-sticky-wide" width="100%">シフト申請する</button></td></tr>
            </form>
            <?php } ?>
            <?php echo $html; ?>
        </table>

        <?php include('./footer.php'); ?>
    </div>
</body>

</html>
