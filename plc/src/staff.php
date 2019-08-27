<?php
function getInformation4Staff(){
    
    $ini = parse_ini_file('../common.ini', FALSE);
    $pdo = new PDO('mysql:dbname=' . $ini['dbname'] . ';charset=utf8;host=' . $ini['host'] , $ini['dbuser'] , $ini['dbpass'] );
    $stmt = $pdo->prepare('SELECT * FROM information WHERE info_seq = 1');
    $stmt->execute(array());
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        return $row['info_temp'];
    }else{
        return "";
    }
}



session_start();

    // ログイン状態チェック
    if (!isset($_SESSION["NAME"])) {
        header("Location: Logout.php");
        exit;
    }


if(!empty($_SESSION['MSG'])){
    $msg =$_SESSION['MSG'];
    $_SESSION['MSG'] = "";
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
            
            $sInfo = getInformation4Staff();
            
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

<?php
if (!empty($msg)){
    echo "<script>alert('".$msg."');</script>";
}
?>
    <div class="wrapper">

        <?php include('./staffMenu.php'); ?>

        <?php echo $errorMessage; ?>

        <div class="inf">
            <div class="boxDate"><?php echo $printDate; ?></div>
            <div class="box30">
                <div class="box-title">INFORMATION </div>
                <p><?php echo nl2br($sInfo); ?></p>
            </div>
        </div>
        


        <?php include('./footer.php'); ?>
    </div>
</body>

</html>
