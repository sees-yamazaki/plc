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
echo $_SESSION["MODE"];
    if ($_SESSION["MODE"]=="TEMP") {
        
        // 3. エラー処理
        try {
            
            require_once 'dns.php';
            $uSeq = $_SESSION['SEQ'];
            $wY = intval(date('Y',  $tgtTime));
            $wM = intval(date('m',  $tgtTime));
            $wD = intval(date('d',  $tgtTime));
            
            require_once './dns.php';
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
                $html.="<tr><th class='arrow_box'>".$wM." / ".$i."</th><td class='plan'>".$str."</td></tr>";
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

    <?php echo $errorMessage; ?>

    <table class="work 1p5em">
        <tr>
            <td style="text-align:left"><a href="staff_cal.php?ty=<?php echo $lastY; ?>&tm=<?php echo $lastM; ?>" class="btn-sticky">＜＜前月</a></td>
            <td class="titleYM"><?php echo $wY; ?> / <?php echo $wM; ?></td>
            <td style="text-align:right"><a href="staff_cal.php?ty=<?php echo $nextY; ?>&tm=<?php echo $nextM; ?>" class="btn-sticky">翌月＞＞</a></td>
        </tr><?php echo $html; ?>
    </table>

</body>

</html>
