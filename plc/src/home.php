<?php
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


try {

    require_once './dns.php';
    
    $stmt = $pdo->prepare('SELECT * FROM information');
    $stmt->execute(array());

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        $info1 = $row['info_staff'];
        $info2 = $row['info_temp'];
    }

    $stmt = $pdo->prepare('SELECT * FROM auth_work WHERE `status`=1');
    $stmt->execute(array());
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $info3 ="未承認のシフト申請があります。　<a class='link' href='employeeAuth.php'>[確認する]</a>";
    }



} catch (PDOException $e) {
    $errorMessage = 'データベースエラー';
    //$errorMessage = $sql;
    if(strcmp("1",$ini['debug'])==0){
        echo $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../js/main.js"></script>
</head>

<body>
    <?php include('./menu.php'); ?>

<?php
if (!empty($msg)){
    echo "<script>alert('".$msg."');</script>";
}
?>
    <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    <br><br>
    <div class="info"><span class="infoTitle">社員用</span>
        <p><?php echo nl2br($info1); ?></p>
    </div>
<br><br>
    <div class="info"><span class="infoTitle">派遣社員用</span>
        <p><?php echo nl2br($info2); ?></p>
    </div>

    <?php if(!empty($info3)) { ?>
<br><br>
    <div class="info"><span class="infoTitle">システムからお知らせ</span>
        <p><?php echo nl2br($info3); ?></p>
    </div>
    <?php } ?>



</body>

</html>
