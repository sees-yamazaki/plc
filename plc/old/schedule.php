<?php
session_start();

function getSE($workList,$userSeq,$y,$m,$d){
    foreach($workList as $row2){
        if($row2['user_seq']==$userSeq && $row2['work_y']==$y && $row2['work_m']==$m && $row2['work_d']==$d ){
            $sTime = strtotime($row2['plan_start_time']);
            $eTime = strtotime($row2['plan_end_time']);
            $fmtSTime = idate('H',$sTime).":".sprintf('%02d',idate('i',$sTime));
            $fmtETime = idate('H',$eTime).":".sprintf('%02d',idate('i',$eTime));
            return $fmtSTime." - ".$fmtETime;
        }
    }
    return "";
}

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

$ini = parse_ini_file('./common.ini', FALSE);

    if (!empty($_SESSION["LEVEL"])) {

        // SESSIONのユーザLEVELを格納
        $userlvl = $_SESSION["LEVEL"];

        // 3. エラー処理
        try {

            require_once 'dns.php';
            
            $stmt = $pdo->prepare('SELECT * FROM  user where user_level=3 order by user_seq');
            $stmt->execute();
            $userList = $stmt->fetchAll();

            
            
            $date = new DateTime('now');
            $lastDate = date('Y-m-d', strtotime('last day of ' . $date->format('Y-m')));
            $timestamp = strtotime($lastDate);            

            $html="<tr><td></td>";
            foreach($userList as $row){ 
                $html.="<th>".$row['user_name']."</th>";
            }
            $html.="</tr>";
            
            $stmt = $pdo->prepare('SELECT CONCAT(user_seq,work_y,work_m,work_d) AS searchkey, schedule.* FROM schedule where work_y=? and work_m=?');

            $stmt->execute(array(idate('Y',$timestamp),idate('m',$timestamp)));
            $scheList = $stmt->fetchAll();
            
            

            for($i = 0; $i <= idate('t',$timestamp); ++$i) {
                
                $html.="<tr><td>".$i."</td>";
                foreach($userList as $row){ 
                    $rtn = getSE($scheList,$row['user_seq'],idate('Y',$timestamp),idate('m',$timestamp),$i);
                    $html.="<td>".$rtn."</td>";
                }
                    $html.="</tr>";
            }
            
                             /*
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            //if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                
                if(strcmp("1",$row['user_level'])==0){
                    $info1 = $row['info'];
                }
                if(strcmp("2",$row['user_level'])==0){
                    $info2 = $row['info'];
                }
                if(strcmp("3",$row['user_level'])==0){
                    $info3 = $row['info'];
                }
            }
            */
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

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/table.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/main.js"></script>
</head>

<body>
    <?php include('./menu.php'); ?>

    <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    
    <table class="vw"><?php echo $html; ?></table>
    <?php if(strcmp($userlvl, "1")==0) { ?>
    <div class="info"><span class="infoTitle">管理者用</span>
        <p><?php echo nl2br($info1); ?></p>
        <button type="button" class="edit" onclick="location.href='information.php?infoLvl=1'">edit</button>

    </div>
    <?php } ?>




</body>

</html>
