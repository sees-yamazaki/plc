<?php
session_start();

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
            
            $stmt = $pdo->prepare('SELECT * FROM information');
            $stmt->execute(array($userlvl));

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/main.js"></script>
</head>

<body>
    <?php include('./menu.php'); ?>

    <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>

    <?php if(strcmp($userlvl, "1")==0) { ?>
    <div class="info"><span class="infoTitle">管理者用</span>
        <p><?php echo nl2br($info1); ?></p>
        <button type="button" class="edit" onclick="location.href='information.php?infoLvl=1'">edit</button>

    </div>
    <?php } ?>

    <?php if(strcmp($userlvl, "1")==0 || strcmp($userlvl, "2")==0) { ?>
    <div class="info"><span class="infoTitle">社員用</span>
        <p><?php echo nl2br($info2); ?></p>
        <button type="button" class="edit" onclick="location.href='information.php?infoLvl=2'">edit</button>
    </div>
    <?php } ?>

    <div class="info"><span class="infoTitle">スタッフ用</span>
        <p><?php echo nl2br($info3); ?></p>
        <?php if(strcmp($userlvl, "1")==0 || strcmp($userlvl, "2")==0) { ?>
        <button type="button" class="edit" onclick="location.href='information.php?infoLvl=2'">edit</button>
        <?php } ?>
    </div>


</body>

</html>
