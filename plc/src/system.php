<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

$ini = parse_ini_file('../common.ini', FALSE);

if (!empty($_SESSION["LEVEL"])) {

    try {

        require_once 'dns.php';
        
        
        if(isset($_POST['editSys'])){

            $old_alert_mail_0 = $_POST['old_alert_mail_0'];
            $alert_mail_0 = $_POST['alert_mail_0'];
            $from_mail = $_POST['from_mail'];
            $mail_title = $_POST['mail_title'];
            $mail_body1 = $_POST['mail_body1'];
            $mail_body2 = $_POST['mail_body2'];
            
            $sql = "UPDATE `system_info` SET `alert_mail_0`=? , `from_mail`=?, mail_title=?, mail_body1=?, mail_body2=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array( $alert_mail_0, $from_mail,$mail_title,$mail_body1,$mail_body2));

            if($old_alert_mail_0<>$alert_mail_0){
                $sql = "UPDATE `employee` SET `alert_mail_0`=? WHERE `employee_level`<>99";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array($alert_mail_0));
            }

            $_SESSION['MSG'] = "システム情報を更新しました。";

            header("Location: ./home.php");

        }

        $stmt = $pdo->prepare('SELECT * FROM system_info');
        $stmt->execute(array());
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $alert_mail_0 = $row['alert_mail_0'];
            $from_mail = $row['from_mail'];
            $mail_title = $row['mail_title'];
            $mail_body1 = $row['mail_body1'];
            $mail_body2 = $row['mail_body2'];
        }


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
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
    <link rel="stylesheet" href="../css/employeeEdit.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/employeeEdit.js"></script>
</head>

<body>

    <?php include('./menu.php'); ?>


    <div class="nav">
    <button type="button" onclick="location.href='home.php'" class="back">戻る</button>
    <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    </div>

    <form action="system.php" method="POST">

        <table class="edit" style="width:90%">
            <caption>システム情報</caption>
            <tr>
                <th>共通メール</th>
                <td><input type="text" id="alert_mail_0" name="alert_mail_0" class="f150P wdtM" maxlength=50 style="ime-mode:disabled" placeholder="localname@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス形式" required value="<?php echo $alert_mail_0; ?>">
                <input type="hidden" id="old_alert_mail_0" name="old_alert_mail_0" value="<?php echo $alert_mail_0; ?>">
                </td>
            </tr>
            <tr>
                <th>返信用メール</th>
                <td><input type="text" id="from_mail" name="from_mail" class="f150P wdtM" maxlength=50  style="ime-mode:disabled" placeholder="localname@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス形式" required value="<?php echo $from_mail; ?>">
                </td>
            </tr>
            <tr>
                <th>メール内容</th>
                <td>
                    タイトル<br>
                    <input type="text" name="mail_title" class="f130P wdtL" maxlength=30 style="ime-mode: active;" required placeholder=""
                    value="<?php echo $mail_title; ?>"><br>
                    本文上<br>
                    <textarea type="text" name="mail_body1" class="f130P wdtL" style="ime-mode: active;" rows=7 cols=70><?php echo $mail_body1; ?></textarea><br>
                    本文下<br>
                    <textarea type="text" name="mail_body2" class="f130P wdtL" style="ime-mode: active;" rows=7 cols=70><?php echo $mail_body2; ?></textarea>
                </td>
            </tr>
            <tr style="text-align:center"><td colspan="2" class="cal2"><button type=submit name="editSys" class="cal2">更新</button></td></tr>
        </table>

    </form>


</body>

</html>
