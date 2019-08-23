<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

$ini = parse_ini_file('./common.ini', FALSE);

if (isset($_POST["info"])) {
            try {

                require_once 'dns.php';

            $stmt = $pdo->prepare('update information set info = ? where user_level =  ?');

            $stmt->execute(array($_POST["infoTxt"],$_POST["infoLvl"]));
                    header("Location: home.php");  // メイン画面へ遷移
                    exit();  // 処理終了
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            // echo $e->getMessage();
        }

}
    


    if (!empty($_SESSION["LEVEL"])) {

        // SESSIONのユーザLEVELを格納
        $userlvl = $_SESSION["LEVEL"];
        
        // 編集権限の確認
        $isEdit = false;
        if($userlvl=="1"){
            $isEdit = true;
        }else if($userlvl=="2"){
            if($_GET['infoLvl']=="3"){
                $isEdit = true;
            }
        }
        
        // 3. エラー処理
        try {

            require_once 'dns.php';
            
            $stmt = $pdo->prepare('SELECT * FROM information WHERE user_level = ?');
            $stmt->execute(array($userlvl));

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $info = $row['info'];

            } else {
                // 4. 認証成功なら、セッションIDを新規に発行する
                // 該当データなし
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

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/main.js"></script>
</head>

<body>
    <?php include('./menu.php'); ?>

    <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>

    <form id="infoFrm" action="" method="POST">
        <input type="hidden" name="infoLvl" value="<?php echo $_GET['infoLvl']; ?>">
        <textarea name="infoTxt" class="info" rows="8"><?php echo $info; ?></textarea>
        <button type="button"  onclick="history.back();" class="back">戻る</button>
        <?php if(isEdit==true){ ?> 
        <button type="submit" id="info" name="info" class="edit">更新</button>
        <?php } ?>
    </form>
</body>

</html>
