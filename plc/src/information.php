<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

$ini = parse_ini_file('../common.ini', FALSE);

if (isset($_POST["info_staff"])) {
            try {

                require_once 'dns.php';

                $stmt = $pdo->prepare('update information set info_staff=?,info_temp=?  where info_seq=1');
                $stmt->execute(array($_POST["info_staff"],$_POST["info_temp"]));

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

        
        try {

            require_once 'dns.php';
            
            $stmt = $pdo->prepare('SELECT * FROM information');
            $stmt->execute(array());

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $info_staff = $row['info_staff'];
                $info_temp = $row['info_temp'];

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
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../js/main.js"></script>
</head>

<body>
    <?php include('./menu.php'); ?>

    <div class="nav">
    <button type="button" onclick="location.href='home.php'" class="back">戻る</button>
    <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    </div><br>

    <form id="infoFrm" action="" method="POST">

        <div class="info">
            <span class="infoTitle">社員用</span>
            <textarea name="info_staff" class="info" rows="8"><?php echo $info_staff; ?></textarea>
        </div>
        <div class="info">
            <span class="infoTitle">派遣社員用</span>
            <textarea name="info_temp" class="info" rows="8"><?php echo $info_temp; ?></textarea>
        </div>
        <div class="temp" style="width:70%">
        <button type="submit" id="info" name="info" class="edit">更新</button>
        </div>
        
    </form>

</body>

</html>