<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

$uSeq = $_SESSION['SEQ'];

$ini = parse_ini_file('../common.ini', FALSE);

if (!empty($_SESSION["LEVEL"])) {

    try {

        require_once 'dns.php';
        
        $eSeq = $_POST['eSeq'];

        
        if(isset($_POST['userEdit'])){
            
            $name_kana = $_POST['name_kana'];
            $name = $_POST['name'];
            $employee_id = $_POST['employee_id'];
            $old_employee_id = $_POST['old_employee_id'];
            $employee_level = $_POST['employee_level'];
            $group_seq = $_POST['group_seq'];
            $alert_mail_0 = $_POST['alert_mail_0'];
            $alert_mail_1 = $_POST['alert_mail_1'];
            $alert_mail_2 = $_POST['alert_mail_2'];
            $alert_mail_3 = $_POST['alert_mail_3'];
            $alert_mail_4 = $_POST['alert_mail_4'];
            $sex = $_POST['sex'];
            $birthday = $_POST['birthday'];
            $post = $_POST['post'];
            $address_kana = $_POST['address_kana'];
            $address = $_POST['address'];
            $tel1 = $_POST['tel1'];
            $tel2 = $_POST['tel2'];
            $answering = $_POST['answering'];
            $fax = $_POST['fax'];
            $email1 = $_POST['email1'];
            $email2 = $_POST['email2'];
            $priority_email = $_POST['priority_email'];

            
            if(!empty($eSeq)){

                //社員番号の確認
                if(empty($employee_id)){
                    require_once './db/counting.php';
                    $no = getEmployeeNo();
                    $employee_id = sprintf('%04d', $no);
                }

                $employee_id = sprintf('%04d', $employee_id);

                $stmt = $pdo->prepare('SELECT * FROM employee where employee_id = ? and employee_id <> ?');
                $stmt->execute(array($employee_id,$old_employee_id));

                if($row = $stmt->fetch()){
                    $errorMessage = "社員番号(".$employee_id.")はすでに使用されています。";
                }else{
                    $sql = "UPDATE `employee` SET `employee_id`=?,`name_kana`=?,`name`=?,`sex`=?,`birthday`=?,`post`=?,`address_kana`=?,`address`=?,`tel1`=?,`tel2`=?,`answering`=?,`fax`=?,`email1`=?,`email2`=?,`priority_email`=?,`employee_level`=?,`group_seq`=?,`alert_mail_0`=?,`alert_mail_1`=?,`alert_mail_2`=?,`alert_mail_3`=?,`alert_mail_4`=? WHERE `employee_seq`=?";

                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array(
                        $employee_id,
                        $name_kana,
                        $name,
                        $sex,
                        $birthday,
                        $post,
                        $address_kana,
                        $address,
                        $tel1,
                        $tel2,
                        $answering,
                        $fax,
                        $email1,
                        $email2,
                        $priority_email,
                        $employee_level,
                        $group_seq,
                        $alert_mail_0,
                        $alert_mail_1,
                        $alert_mail_2,
                        $alert_mail_3,
                        $alert_mail_4,
                        $eSeq));
                }

            }else{
                //社員番号の確認
                if(empty($employee_id)){
                    require_once './db/counting.php';
                    $no = getEmployeeNo();
                    $employee_id = sprintf('%04d', $no);
                }

                $employee_id = sprintf('%04d', $employee_id);
                $stmt = $pdo->prepare('SELECT * FROM employee where employee_id = ?');
                $stmt->execute(array($employee_id));

                if($row = $stmt->fetch()){
                    $errorMessage = "社員番号(".$employee_id.")はすでに使用されています。";
                }else{
                    $sql = "INSERT INTO `employee`(`employee_id`, `name_kana`, `name`, `sex`, `birthday`, `post`, `address_kana`, `address`, `tel1`, `tel2`, `answering`, `fax`, `email1`, `email2`, `priority_email`, `employee_level`, `employee_pw`, `group_seq`, `alert_mail_0`, `alert_mail_1`, `alert_mail_2`, `alert_mail_3`, `alert_mail_4`,`user_seq`)  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array(
                        $employee_id,
                        $name_kana,
                        $name,
                        $sex,
                        $birthday,
                        $post,
                        $address_kana,
                        $address,
                        $tel1,
                        $tel2,
                        $answering,
                        $fax,
                        $email1,
                        $email2,
                        $priority_email,
                        $employee_level,
                        $employee_id,
                        $group_seq,
                        $alert_mail_0,
                        $alert_mail_1,
                        $alert_mail_2,
                        $alert_mail_3,
                        $alert_mail_4,
                        $uSeq));
                    }
                    
            }
            
            if(empty($errorMessage)){
                header("Location: ./userList.php");
            }

        }else if(isset($_POST['userDel'])){
            
                    $sql = "DELETE FROM `employee` WHERE `employee_seq`=?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array($eSeq));

                    $sql = "DELETE FROM `officer` WHERE `employee_seq`=?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array($eSeq));



                header("Location: ./userList.php");

        }else if(isset($_POST['officer'])){
            header('Location: userOfficer.php', true, 307);
        }else if(isset($_POST['view'])){
            header('Location: userView.php', true, 307);
        }else{
            
            $stmt = $pdo->prepare('SELECT * FROM employee where employee_seq = ?');
            $stmt->execute(array($eSeq));
            
            if($row = $stmt->fetch()){
                
                $name_kana = $row['name_kana'];
                $name = $row['name'];
                $sex = $row['sex'];
                $birthday = $row['birthday'];
                $post = $row['post'];
                $address_kana = $row['address_kana'];
                $address = $row['address'];
                $tel1 = $row['tel1'];
                $tel2 = $row['tel2'];
                $answering = $row['answering'];
                $fax = $row['fax'];
                $email1 = $row['email1'];
                $email2 = $row['email2'];
                $priority_email = $row['priority_email'];
                $employee_id = $row['employee_id'];
                $employee_level = $row['employee_level'];
                $group_seq = $row['group_seq'];
                $alert_mail_0 = $row['alert_mail_0'];
                $alert_mail_1 = $row['alert_mail_1'];
                $alert_mail_2 = $row['alert_mail_2'];
                $alert_mail_3 = $row['alert_mail_3'];
                $alert_mail_4 = $row['alert_mail_4'];
            }

            if(empty($alert_mail_0)){
                // 共通メール
                $stmt = $pdo->prepare('SELECT * FROM `system_info`');
                $stmt->execute(array());
                if($row = $stmt->fetch()){
                    $alert_mail_0 = $row['alert_mail_0'];
                }
            }

        }

        
        // グループ
        $stmt = $pdo->prepare('SELECT * FROM `group` order by group_seq');
        $stmt->execute(array());
        $rows = $stmt->fetchAll();

        foreach ($rows as $row) {
            if($row['group_seq']==$group_seq){
                $group .= "<option value='".$row['group_seq']."' selected>".$row['group_name']."</option>";
            }else{
                $group .= "<option value='".$row['group_seq']."'>".$row['group_name']."</option>";
            }
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
    <button type="button" onclick="location.href='userList.php'" class="back">戻る</button>
    <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    </div>

    <form action="userEdit.php" method="POST" onsubmit="return submitChk()">

        <input type="hidden" name="eSeq" value="<?php echo $eSeq; ?>">

        <table class="edit">
            <caption>ユーザ情報</caption>
            <tr>
                <th>フリガナ<span class="f50P"> (30)</span></th>
                <td><input type="text" id="name_kana" name="name_kana" class="f130P wdtL" maxlength=30  style="ime-mode: active;" pattern="[ァ-ヴー\s　]+" title="カタカナ" placeholder="全角カタカナ" onblur="harf2wide(this);" value="<?php echo $name_kana; ?>"></td>
            </tr>
            <tr>
                <th><span class="required">氏名<span class="f50P"> (30)</span></span></th>
                <td><input type="text" id="name" name="name" class="f130P wdtL" maxlength=30 style="ime-mode: active;" required placeholder="" value="<?php echo $name; ?>">
                </td>
            </tr>
            <tr>
                <th>社員番号<span class="f50P"> (4)</span></th>
                <td>
                    <input type="number" id="employee_id" name="employee_id" class="f130P wdtSS" oninput="sliceMaxLength(this, 4)" style="ime-mode: disabled;" pattern="[0-9][0-9][0-9][0-9]" title="数字" placeholder="" value="<?php echo $employee_id; ?>">
                    未入力の場合は自動的に採番されます<input type="hidden" id="old_employee_id" name="old_employee_id" value="<?php echo $employee_id; ?>">
                </td>
            </tr>
            <tr>
                <th>アカウント種別</th>
                <td>
                    <?php if($employee_level=="2"){ ?>
                    <input type="radio" name="employee_level" value="2" checked>管理者
                    <input type="radio" name="employee_level" value="3">社員　　
                    <input type="radio" name="employee_level" value="9">退職
                    <?php }elseif($employee_level=="9"){ ?>
                    <input type="radio" name="employee_level" value="2">管理者
                    <input type="radio" name="employee_level" value="3">社員　　
                    <input type="radio" name="employee_level" value="9" checked>退職
                    <?php }else{ ?>
                    <input type="radio" name="employee_level" value="2">管理者
                    <input type="radio" name="employee_level" value="3" checked>社員　　
                    <input type="radio" name="employee_level" value="9">退職
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th><span class="required">グループ</span></th>
                <td>
                    <select name="group_seq" class="f130P" required>
                        <option value="">選択してください</option>
                        <?php echo $group; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>アラート送信先(共通)<span class="f50P"> (50)</span></th>
                <td><input type="email" name="alert_mail_0" class="f130P wdtM" maxlength=50  style="ime-mode:disabled" placeholder="localname@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス"  value="<?php echo $alert_mail_0; ?>"  readonly>　変更不可</td>
            </tr>
            <tr>
                <th>アラート送信先1<span class="f50P"> (50)</span></th>
                <td><input type="email" name="alert_mail_1" class="f130P wdtM" maxlength=50  style="ime-mode:disabled" placeholder="localname@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス"  value="<?php echo $alert_mail_1; ?>"></td>
            </tr>
            <tr>
                <th>アラート送信先2<span class="f50P"> (50)</span></th>
                <td><input type="email" name="alert_mail_2" class="f130P wdtM" maxlength=50  style="ime-mode:disabled" placeholder="localname@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス"  value="<?php echo $alert_mail_2; ?>"></td>
            </tr>
            <tr>
                <th>アラート送信先3<span class="f50P"> (50)</span></th>
                <td><input type="email" name="alert_mail_3" class="f130P wdtM" maxlength=50  style="ime-mode:disabled" placeholder="localname@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス"  value="<?php echo $alert_mail_3; ?>"></td>
            </tr>
            <tr>
                <th>アラート送信先4<span class="f50P"> (50)</span></th>
                <td><input type="email" name="alert_mail_4" class="f130P wdtM" maxlength=50  style="ime-mode:disabled" placeholder="localname@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス"  value="<?php echo $alert_mail_4; ?>"></td>
            </tr>
        </table>


        <table class="edit">
            <caption>基本情報</caption>
            <tr>
                <th>性別</th>
                <td>
                    <?php if(!isset($sex) || $sex=="1"){ ?>
                    <input type="radio" id="sex1" name="sex" value="1" checked>男
                    <input type="radio" name="sex" value="2">女
                    <?php }else{ ?>
                    <input type="radio" id="sex1" name="sex" value="1">男
                    <input type="radio" name="sex" value="2" checked>女
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>生年月日</th>
                <td><input type="date" id="birthday" name="birthday" class="f130P" value="<?php echo $birthday; ?>"></td>
            </tr>
            <tr>
                <th>郵便番号<span class="f50P"> (8)</span></th>
                <td><input type="text" id="post" name="post" class="f130P wdtSS" maxlength=8 style="ime-mode:disabled" placeholder="123-4567" pattern="\d{3}-?\d{4}" title="郵便番号" value="<?php echo $post; ?>"></td>
            </tr>
            <tr>
                <th>フリガナ<span class="f50P"> (100)</span></th>
                <td><input type="text" id="address_kana" name="address_kana" class="f130P wdtL" maxlength=100 pattern="[-ァ-ヴー\s　０-９0-9a-zA-Z]+" title="カタカナ、数字、スペース、英字" placeholder="全角カタカナ、数字、英字、スペース" onblur="harf2wide(this);" value="<?php echo $address_kana; ?>"></td>
            </tr>
            <tr>
                <th>現住所<span class="f50P"> (100)</span></th>
                <td><input type="text" id="address" name="address" class="f130P wdtL" maxlength=100 value="<?php echo $address; ?>"></td>
            </tr>
            <tr>
                <th>連絡先<span class="f50P"> (13)</span></th>
                <td><input type="tel" id="tel1" name="tel1" class="f130P wdtS" maxlength=13  style="ime-mode:disabled" placeholder="090-1234-5678" pattern="\d{2,4}-?\d{3,4}-?\d{3,4}" title="電話番号" value="<?php echo $tel1; ?>"></td>
            </tr>
            <tr>
                <th>携帯電話<span class="f50P"> (13)</span></th>
                <td><input type="tel" id="tel2" name="tel2" class="f130P wdtS" maxlength=13  style="ime-mode:disabled" placeholder="090-1234-5678" pattern="\d{2,4}-?\d{3,4}-?\d{3,4}" title="電話番号" value="<?php echo $tel2; ?>"></td>
            </tr>
            <tr>
                <th>留守電の有無</th>
                <td>
                    <?php if($answering=="1"){ ?>
                    <input type="radio" name="answering" value="1" checked>有
                    <input type="radio" name="answering" value="2">無
                    <?php }else{ ?>
                    <input type="radio" name="answering" value="1">有
                    <input type="radio" name="answering" value="2" checked>無
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>FAXの有無</th>
                <td>
                    <?php if($fax=="1"){ ?>
                    <input type="radio" name="fax" value="1" checked>有
                    <input type="radio" name="fax" value="2">無
                    <?php }else{ ?>
                    <input type="radio" name="fax" value="1">有
                    <input type="radio" name="fax" value="2" checked>無
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>E-mail：携帯<span class="f50P"> (50)</span></th>
                <td><input type="email" id="email1" name="email1" style="ime-mode:disabled" class="f130P wdtM" maxlength=50 placeholder="localname@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス" value="<?php echo $email1; ?>"></td>
            </tr>
            <tr>
                <th>E-mail：PC<span class="f50P"> (50)</span></th>
                <td><input type="email" id="email2" name="email2" style="ime-mode:disabled" class="f130P wdtM" maxlength=50 placeholder="localname@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス" value="<?php echo $email2; ?>"></td>
            </tr>
            <tr>
                <th>指定アドレス</th>
                <td>
                    <?php if(!isset($sex)){ ?>
                    <input type="radio" id="priority_email1" name="priority_email" value="1" checked>携帯
                    <input type="radio" name="priority_email" value="2">PC
                    <?php }elseif($sex=="1"){ ?>
                    <input type="radio" id="priority_email1" name="priority_email" value="1" checked>携帯
                    <input type="radio" name="priority_email" value="2">PC
                    <?php }else{ ?>
                    <input type="radio" id="priority_email1" name="priority_email" value="1">携帯
                    <input type="radio" name="priority_email" value="2" checked>PC
                    <?php } ?>
                </td>
            </tr>
        </table>

        <table class="edit" style="width:40%">
            <tr><td><button type="submit" name="userEdit" class="cal">登録</button></td></tr>
        </table>


    </form>


    <?php if(!empty($eSeq)){ ?>
    <form action="userEdit.php" method="POST" onsubmit="return delcheck()">

        <input type="hidden" name="eSeq" value="<?php echo $eSeq; ?>">

        <table class="del">
            <tr>
                <td><button type=submit name="userDel" class="del">このユーザを削除する</button></td>
            </tr>
        </table>

    </form>
    <?php } ?>

</body>

</html>
