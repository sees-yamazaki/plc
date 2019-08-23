<?php

    session_start();

    // ログイン状態チェック
    if (!isset($_SESSION["NAME"])) {
        header("Location: Logout.php");
        exit;
    }
/*
    require_once 'model/client.php';
    $client = new cls_client();
*/

    $ini = parse_ini_file('../common.ini', FALSE);

    if (!empty($_SESSION["LEVEL"])) {

        try {

            require_once 'dns.php';
            
            $cSeq = $_POST['cSeq'];
            
            if(isset($_POST['clientEdit'])){

                $name = $_POST['name'];
                $section = $_POST['section'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                $person = $_POST['person'];
                $email = $_POST['email'];
                $remarks = $_POST['remarks'];
/*
                $client->name = $_POST['name'];
                $client->section = $_POST['section'];
                $client->address = $_POST['address'];
                $client->tel = $_POST['tel'];
                $client->person = $_POST['person'];
                $client->email = $_POST['email'];
                $client->remarks = $_POST['remarks'];
*/                
                if(!empty($cSeq)){
                    $sql = "UPDATE `client` SET `name`=?,`section`=?,`address`=?,`tel`=?,`person`=?,`email`=?,`remarks`=? WHERE `client_seq`=?";

                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array(
                        $name,
                        $section,
                        $address,
                        $tel,
                        $person,
                        $email,
                        $remarks,
                        $cSeq));
                }else{

                    $sql = "INSERT INTO `client`(`name`, `section`, `address`, `tel`, `person`, `email`, `remarks`) VALUES(?,?,?,?,?,?,?)";

                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array(
                        $name,
                        $section,
                        $address,
                        $tel,
                        $person,
                        $email,
                        $remarks));
                }

                header("Location: ./clientList.php");

            }elseif(isset($_POST['clientDel'])){

                $stmt = $pdo->prepare('SELECT * FROM job where client_seq = ?');
                $stmt->execute(array($cSeq));
                
                if($row = $stmt->fetch()){
                    $errorMessage = "このクライアントに紐付く案件が存在します。案件を先に削除してください。";
                }else{
                    $stmt2 = $pdo->prepare('DELETE FROM client where client_seq = ?');
                    $stmt2->execute(array($cSeq));
                    header("Location: ./clientList.php");
                }

            }

            $stmt = $pdo->prepare('SELECT * FROM client where client_seq = ?');
            $stmt->execute(array($cSeq));
            
            if($row = $stmt->fetch()){
                $name = $row['name'];
                $section = $row['section'];
                $address = $row['address'];
                $tel = $row['tel'];
                $person = $row['person'];
                $email = $row['email'];
                $remarks = $row['remarks'];
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
<html lang=”ja”>

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
        <button type="button" onclick="location.href='clientList.php'" class="back">戻る</button>
        <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    </div><br>


    <form id="editUser" action="clientEdit.php" method="POST" onsubmit="return submitChk()">

        <input type="hidden" name="cSeq" value="<?php echo $cSeq; ?>">

        <table class="edit">
            <caption>クライアント情報</caption>
            <tr>
                <th><span class="required">クライアント名<span class="f50P"> (30)</span></span></th>
                <td><input type="text" id="name" name="name" class="f130P wdtL" maxlength=30  style="ime-mode: active;" required placeholder="" value="<?php echo $name; ?>">
                </td>
            </tr>
            <tr>
                <th>部署名<span class="f50P"> (30)</span></th>
                <td><input type="text" id="section" name="section" class="f130P wdtL" maxlength=30  style="ime-mode: active;" placeholder="" value="<?php echo $section; ?>">
                </td>
            </tr>
            <tr>
                <th>住所<span class="f50P"> (100)</span></th>
                <td><input type="text" id="address" name="address" class="f130P wdtL" maxlength=100 value="<?php echo $address; ?>"></td>
            </tr>
            <tr>
                <th>電話番号<span class="f50P"> (13)</span></th>
                <td><input type="tel" id="tel" name="tel" style="ime-mode:disabled" class="f130P wdtS" maxlength=13  placeholder="090-1234-5678" pattern="\d{2,4}-?\d{3,4}-?\d{3,4}" title="電話番号"  value="<?php echo $tel; ?>"></td>
            </tr>
            <tr>
                <th>担当者名<span class="f50P"> (30)</span></th>
                <td><input type="text" id="person" name="person" class="f130P wdtL" maxlength=30  style="ime-mode: active;" placeholder="" value="<?php echo $person; ?>">
                </td>
            </tr>
            <tr>
                <th>E-mail<span class="f50P"> (50)</span></th>
                <td><input type="email" id="email" name="email" style="ime-mode:disabled" class="f130P wdtM" maxlength=50  placeholder="localname@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス"  value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <th>備考</th>
                <td><textarea id="remarks" name="remarks"  class="f130P wdtL" rows=5><?php echo $remarks; ?></textarea></td>
            </tr>
            <tr><td colspan="2" style="text-align:center;"><button type=submit name="clientEdit" class="cal2">登録</button></td></tr>
        </table>

    </form>

    <?php if(!empty($cSeq)){ ?>
    <form id="editUser" action="clientEdit.php" method="POST" onsubmit="return delcheck()">

        <input type="hidden" name="cSeq" value="<?php echo $cSeq; ?>">

        <table class="del">
            <tr><td><button type=submit name="clientDel" class="del">このクライアントを削除する</button></td></tr>
        </table>

    </form>
    <?php } ?>

</body>

</html>
