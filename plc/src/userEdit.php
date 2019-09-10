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
            $route = $_POST['route'];
            $station = $_POST['station'];
            $bus = $_POST['bus'];
            $bus_name = $_POST['bus_name'];
            $bus_stop = $_POST['bus_stop'];
            $bank_kana = $_POST['bank_kana'];
            $bank = $_POST['bank'];
            $branch_code = $_POST['branch_code'];
            $branch_kana = $_POST['branch_kana'];
            $branch = $_POST['branch'];
            $account = $_POST['account'];
            $education_from = $_POST['education_from'];
            $education_to = $_POST['education_to'];
            $school = $_POST['school'];
            $graduate = $_POST['graduate'];
            $recruit = $_POST['recruit'];
            $work1_from = $_POST['work1_from'];
            $work1_to = $_POST['work1_to'];
            $work1_status = $_POST['work1_status'];
            $work1_company = $_POST['work1_company'];
            $work1_location = $_POST['work1_location'];
            $work1_job = $_POST['work1_job'];
            $work2_from = $_POST['work2_from'];
            $work2_to = $_POST['work2_to'];
            $work2_status = $_POST['work2_status'];
            $work2_company = $_POST['work2_company'];
            $work2_location = $_POST['work2_location'];
            $work2_job = $_POST['work2_job'];
            $work3_from = $_POST['work3_from'];
            $work3_to = $_POST['work3_to'];
            $work3_status = $_POST['work3_status'];
            $work3_company = $_POST['work3_company'];
            $work3_location = $_POST['work3_location'];
            $work3_job = $_POST['work3_job'];
            $work4_from = $_POST['work4_from'];
            $work4_to = $_POST['work4_to'];
            $work4_status = $_POST['work4_status'];
            $work4_company = $_POST['work4_company'];
            $work4_location = $_POST['work4_location'];
            $work4_job = $_POST['work4_job'];
            $work5_from = $_POST['work5_from'];
            $work5_to = $_POST['work5_to'];
            $work5_status = $_POST['work5_status'];
            $work5_company = $_POST['work5_company'];
            $work5_location = $_POST['work5_location'];
            $work5_job = $_POST['work5_job'];
            $work_remarks = $_POST['work_remarks'];
            $emergency_kana = $_POST['emergency_kana'];
            $emergency = $_POST['emergency'];
            $tel10 = $_POST['tel10'];
            $tel11 = $_POST['tel11'];
            $priority_tel = $_POST['priority_tel'];
            $post2 = $_POST['post2'];
            $address2 = $_POST['address2'];
            $remarks = $_POST['remarks'];
            $alert_time = $_POST['alert_time'];
            $pay_type = $_POST['pay_type'];
            $pay_unitcost = $_POST['pay_unitcost'];
            $sales_unitcost = $_POST['sales_unitcost'];
            $transport_unitcosts = $_POST['transport_unitcosts'];
            $pass_cost = $_POST['pass_cost'];
            
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
                    $sql = "UPDATE `employee` SET `employee_id`=?,`name_kana`=?,`name`=?,`sex`=?,`birthday`=?,`post`=?,`address_kana`=?,`address`=?,`tel1`=?,`tel2`=?,`answering`=?,`fax`=?,`email1`=?,`email2`=?,`priority_email`=?,`route`=?,`station`=?,`bus`=?,`bus_name`=?,`bus_stop`=?,`bank_kana`=?,`bank`=?,`branch_code`=?,`branch_kana`=?,`branch`=?,`account`=?,`education_from`=?,`education_to`=?,`school`=?,`graduate`=?,`recruit`=?,`work1_from`=?,`work1_to`=?,`work1_status`=?,`work1_company`=?,`work1_location`=?,`work1_job`=?,`work2_from`=?,`work2_to`=?,`work2_status`=?,`work2_company`=?,`work2_location`=?,`work2_job`=?,`work3_from`=?,`work3_to`=?,`work3_status`=?,`work3_company`=?,`work3_location`=?,`work3_job`=?,`work4_from`=?,`work4_to`=?,`work4_status`=?,`work4_company`=?,`work4_location`=?,`work4_job`=?,`work5_from`=?,`work5_to`=?,`work5_status`=?,`work5_company`=?,`work5_location`=?,`work5_job`=?,`work_remarks`=?,`emergency_kana`=?,`emergency`=?,`tel10`=?,`tel11`=?,`priority_tel`=?,`post2`=?,`address2`=?,`remarks`=?,`alert_time`=?,`pay_type`=?,`pay_unitcost`=?,`sales_unitcost`=?,`transport_unitcosts`=?,`pass_cost`=?,`employee_level`=?,`group_seq`=?,`alert_mail_0`=?,`alert_mail_1`=?,`alert_mail_2`=?,`alert_mail_3`=?,`alert_mail_4`=? WHERE `employee_seq`=?";

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
                        $route,
                        $station,
                        $bus,
                        $bus_name,
                        $bus_stop,
                        $bank_kana,
                        $bank,
                        $branch_code,
                        $branch_kana,
                        $branch,
                        $account,
                        $education_from,
                        $education_to,
                        $school,
                        $graduate,
                        $recruit,
                        $work1_from,
                        $work1_to,
                        $work1_status,
                        $work1_company,
                        $work1_location,
                        $work1_job,
                        $work2_from,
                        $work2_to,
                        $work2_status,
                        $work2_company,
                        $work2_location,
                        $work2_job,
                        $work3_from,
                        $work3_to,
                        $work3_status,
                        $work3_company,
                        $work3_location,
                        $work3_job,
                        $work4_from,
                        $work4_to,
                        $work4_status,
                        $work4_company,
                        $work4_location,
                        $work4_job,
                        $work5_from,
                        $work5_to,
                        $work5_status,
                        $work5_company,
                        $work5_location,
                        $work5_job,
                        $work_remarks,
                        $emergency_kana,
                        $emergency,
                        $tel10,
                        $tel11,
                        $priority_tel,
                        $post2,
                        $address2,
                        $remarks,
                        $alert_time,
                        $pay_type,
                        $pay_unitcost,
                        $sales_unitcost,
                        $transport_unitcosts,
                        $pass_cost,
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
                    $sql = "INSERT INTO `employee`(`employee_id`, `name_kana`, `name`, `sex`, `birthday`, `post`, `address_kana`, `address`, `tel1`, `tel2`, `answering`, `fax`, `email1`, `email2`, `priority_email`, `route`, `station`, `bus`, `bus_name`, `bus_stop`, `bank_kana`, `bank`, `branch_code`, `branch_kana`, `branch`, `account`, `education_from`, `education_to`, `school`, `graduate`, `recruit`, `work1_from`, `work1_to`, `work1_status`, `work1_company`, `work1_location`, `work1_job`, `work2_from`, `work2_to`, `work2_status`, `work2_company`, `work2_location`, `work2_job`, `work3_from`, `work3_to`, `work3_status`, `work3_company`, `work3_location`, `work3_job`, `work4_from`, `work4_to`, `work4_status`, `work4_company`, `work4_location`, `work4_job`, `work5_from`, `work5_to`, `work5_status`, `work5_company`, `work5_location`, `work5_job`, `work_remarks`, `emergency_kana`, `emergency`, `tel10`, `tel11`, `priority_tel`, `post2`, `address2`, `remarks`,`alert_time`, `pay_type`,`pay_unitcost`,`sales_unitcost`,`transport_unitcosts`,`pass_cost`, `employee_level`, `employee_pw`, `group_seq`, `alert_mail_0`, `alert_mail_1`, `alert_mail_2`, `alert_mail_3`, `alert_mail_4`,`user_seq`)  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

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
                        $route,
                        $station,
                        $bus,
                        $bus_name,
                        $bus_stop,
                        $bank_kana,
                        $bank,
                        $branch_code,
                        $branch_kana,
                        $branch,
                        $account,
                        $education_from,
                        $education_to,
                        $school,
                        $graduate,
                        $recruit,
                        $work1_from,
                        $work1_to,
                        $work1_status,
                        $work1_company,
                        $work1_location,
                        $work1_job,
                        $work2_from,
                        $work2_to,
                        $work2_status,
                        $work2_company,
                        $work2_location,
                        $work2_job,
                        $work3_from,
                        $work3_to,
                        $work3_status,
                        $work3_company,
                        $work3_location,
                        $work3_job,
                        $work4_from,
                        $work4_to,
                        $work4_status,
                        $work4_company,
                        $work4_location,
                        $work4_job,
                        $work5_from,
                        $work5_to,
                        $work5_status,
                        $work5_company,
                        $work5_location,
                        $work5_job,
                        $work_remarks,
                        $emergency_kana,
                        $emergency,
                        $tel10,
                        $tel11,
                        $priority_tel,
                        $post2,
                        $address2,
                        $remarks,
                        $alert_time,
                        $pay_type,
                        $pay_unitcost,
                        $sales_unitcost,
                        $transport_unitcosts,
                        $pass_cost,
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
                $route = $row['route'];
                $station = $row['station'];
                $bus = $row['bus'];
                $bus_name = $row['bus_name'];
                $bus_stop = $row['bus_stop'];
                $bank_kana = $row['bank_kana'];
                $bank = $row['bank'];
                $branch_code = $row['branch_code'];
                $branch_kana = $row['branch_kana'];
                $branch = $row['branch'];
                $account = $row['account'];
                $education_from = $row['education_from'];
                $education_to = $row['education_to'];
                $school = $row['school'];
                $graduate = $row['graduate'];
                $recruit = $row['recruit'];
                $work1_from = $row['work1_from'];
                $work1_to = $row['work1_to'];
                $work1_status = $row['work1_status'];
                $work1_company = $row['work1_company'];
                $work1_location = $row['work1_location'];
                $work1_job = $row['work1_job'];
                $work2_from = $row['work2_from'];
                $work2_to = $row['work2_to'];
                $work2_status = $row['work2_status'];
                $work2_company = $row['work2_company'];
                $work2_location = $row['work2_location'];
                $work2_job = $row['work2_job'];
                $work3_from = $row['work3_from'];
                $work3_to = $row['work3_to'];
                $work3_status = $row['work3_status'];
                $work3_company = $row['work3_company'];
                $work3_location = $row['work3_location'];
                $work3_job = $row['work3_job'];
                $work4_from = $row['work4_from'];
                $work4_to = $row['work4_to'];
                $work4_status = $row['work4_status'];
                $work4_company = $row['work4_company'];
                $work4_location = $row['work4_location'];
                $work4_job = $row['work4_job'];
                $work5_from = $row['work5_from'];
                $work5_to = $row['work5_to'];
                $work5_status = $row['work5_status'];
                $work5_company = $row['work5_company'];
                $work5_location = $row['work5_location'];
                $work5_job = $row['work5_job'];
                $work_remarks = $row['work_remarks'];
                $emergency_kana = $row['emergency_kana'];
                $emergency = $row['emergency'];
                $tel10 = $row['tel10'];
                $tel11 = $row['tel11'];
                $priority_tel = $row['priority_tel'];
                $post2 = $row['post2'];
                $address2 = $row['address2'];
                $remarks = $row['remarks'];
                $alert_time = $row['alert_time'];
                $pay_type = $row['pay_type'];
                $pay_unitcost = $row['pay_unitcost'];
                $sales_unitcost = $row['sales_unitcost'];
                $transport_unitcosts = $row['transport_unitcosts'];
                $pass_cost = $row['pass_cost'];
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

            // 給与形態
            if($pay_type==1){
                $pt1 = "selected";
            }elseif($pay_type==2){
                $pt2 = "selected";
            }else{
                $pt3 = "selected";
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
                <td><input type="text" id="name_kana" name="name_kana" class="f130P wdtL" maxlength=30  style="ime-mode: active;" pattern="[ァ-ヴー\s　]+" title="カタカナ" placeholder="全角カタカナ" onblur="harf2wide(this);" value="<?php echo $name_kana; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th><span class="required">氏名<span class="f50P"> (30)</span></span></th>
                <td><input type="text" id="name" name="name" class="f130P wdtL" maxlength=30 style="ime-mode: active;" required placeholder="" value="<?php echo $name; ?>" autocomplete="off">
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
                <td><input type="email" name="alert_mail_1" class="f130P wdtM" maxlength=50  style="ime-mode:disabled" placeholder="localname@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス"  value="<?php echo $alert_mail_1; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>アラート送信先2<span class="f50P"> (50)</span></th>
                <td><input type="email" name="alert_mail_2" class="f130P wdtM" maxlength=50  style="ime-mode:disabled" placeholder="localname@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス"  value="<?php echo $alert_mail_2; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>アラート送信先3<span class="f50P"> (50)</span></th>
                <td><input type="email" name="alert_mail_3" class="f130P wdtM" maxlength=50  style="ime-mode:disabled" placeholder="localname@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス"  value="<?php echo $alert_mail_3; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>アラート送信先4<span class="f50P"> (50)</span></th>
                <td><input type="email" name="alert_mail_4" class="f130P wdtM" maxlength=50  style="ime-mode:disabled" placeholder="localname@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス"  value="<?php echo $alert_mail_4; ?>" autocomplete="off"></td>
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
                <td><input type="text" id="post" name="post" class="f130P wdtSS" maxlength=8 style="ime-mode:disabled" placeholder="123-4567" pattern="\d{3}-?\d{4}" title="郵便番号" value="<?php echo $post; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>フリガナ<span class="f50P"> (100)</span></th>
                <td><input type="text" id="address_kana" name="address_kana" class="f130P wdtL" maxlength=100 pattern="[-ァ-ヴー\s　０-９0-9a-zA-Z]+" title="カタカナ、数字、スペース、英字" placeholder="全角カタカナ、数字、英字、スペース" onblur="harf2wide(this);" value="<?php echo $address_kana; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>現住所<span class="f50P"> (100)</span></th>
                <td><input type="text" id="address" name="address" class="f130P wdtL" maxlength=100 value="<?php echo $address; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>連絡先<span class="f50P"> (13)</span></th>
                <td><input type="tel" id="tel1" name="tel1" class="f130P wdtS" maxlength=13  style="ime-mode:disabled" placeholder="090-1234-5678" pattern="\d{2,4}-?\d{3,4}-?\d{3,4}" title="電話番号" value="<?php echo $tel1; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>携帯電話<span class="f50P"> (13)</span></th>
                <td><input type="tel" id="tel2" name="tel2" class="f130P wdtS" maxlength=13  style="ime-mode:disabled" placeholder="090-1234-5678" pattern="\d{2,4}-?\d{3,4}-?\d{3,4}" title="電話番号" value="<?php echo $tel2; ?>" autocomplete="off"></td>
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
                <td><input type="email" id="email1" name="email1" style="ime-mode:disabled" class="f130P wdtM" maxlength=50 placeholder="localname@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス" value="<?php echo $email1; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>E-mail：PC<span class="f50P"> (50)</span></th>
                <td><input type="email" id="email2" name="email2" style="ime-mode:disabled" class="f130P wdtM" maxlength=50 placeholder="localname@domain.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス" value="<?php echo $email2; ?>" autocomplete="off"></td>
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


        <table class="edit">
            <caption>コスト情報</caption>

            <tr>
                <th><span class="required">契約形態</span></th>
                <td>
                    <select id="pay_type" name="pay_type"  class="f130P" required>
                        <option value="1" <?php echo $pt1; ?>>時給</option>
                        <option value="2" <?php echo $pt2; ?>>日給</option>
                        <option value="3" <?php echo $pt3; ?>>月給</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><span class="required">給与単価<span class="f50P"> (7)</span></span></th>
                <td><input type="number" id="pay_unitcost" name="pay_unitcost" class="f130P wdtS"  oninput="sliceMaxLength(this, 7)" style="ime-mode: disabled;"  value="<?php echo $pay_unitcost; ?>" required><span class="f50P"> 　未使用の場合は０を入力してください</span></td>
            </tr>
            <tr>
                <th><span class="required">売上単価<span class="f50P"> (7)</span></span></th>
                <td><input type="number" id="sales_unitcost" name="sales_unitcost" class="f130P wdtS"   oninput="sliceMaxLength(this, 7)" style="ime-mode: disabled;"  value="<?php echo $sales_unitcost; ?>" required><span class="f50P"> 　未使用の場合は０を入力してください</span></td>
            </tr>
            <tr>
                <th><span class="required">交通費<span class="f50P"> (7)</span></span></th>
                <td>1日（往復）：<input type="number" id="transport_unitcosts" class="f130P wdtS"   oninput="sliceMaxLength(this, 7)" name="transport_unitcosts" style="ime-mode: disabled;"  value="<?php echo $transport_unitcosts; ?>" required><span class="f50P"> 　未使用の場合は０を入力してください</span><br>
                    １ヶ月定期：<input type="number" id="pass_cost" name="pass_cost" class="f130P wdtS"   oninput="sliceMaxLength(this, 7)" style="ime-mode: disabled;"  value="<?php echo $pass_cost; ?>" required><span class="f50P"> 　未使用の場合は０を入力してください</span></td>
            </tr>
        </table>

        <table class="edit">
            <caption>交通情報</caption>
            <tr>
                <th>最寄りの路線・駅<span class="f50P"> (30)</span></th>
                <td><input type="text" id="route" name="route" class="f130P wdtS" maxlength=30 style="ime-mode: active;"  value="<?php echo $route; ?>">線　
                <input type="text" id="station" name="station" class="f130P wdtS" maxlength=30 style="ime-mode: active;"  value="<?php echo $station; ?>">駅</td>
            </tr>
            <tr>
                <th>バス利用</th>
                <td>
                    <?php if($bus=="1"){ ?>
                    <input type="radio" id="bus1" name="bus" value="1" checked>有
                    <input type="radio" name="bus" value="2">無
                    <?php }else{ ?>
                    <input type="radio" id="bus1" name="bus" value="1">有
                    <input type="radio" name="bus" value="2" checked>無
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>バスの路線名<span class="f50P"> (30)</span></th>
                <td><input type="text" id="bus_name" name="bus_name" class="f130P wdtS" maxlength=30 style="ime-mode: active;"  value="<?php echo $bus_name; ?>"></td>
            </tr>
            <tr>
                <th>バス停名<span class="f50P"> (30)</span></th>
                <td><input type="text" id="bus_stop" name="bus_stop" class="f130P wdtS" maxlength=30 style="ime-mode: active;"  value="<?php echo $bus_stop; ?>"></td>
            </tr>
        </table>


        <table class="edit">
            <caption>銀行口座</caption>
            <tr>
                <th>フリガナ<span class="f50P"> (30)</span></th>
                <td><input type="text" id="bank_kana" name="bank_kana" class="f130P wdtM" maxlength=30 style="ime-mode: active;" pattern="[ァ-ヴー\s　]+" title="カタカナ" placeholder="全角カタカナ" onblur="harf2wide(this);" value="<?php echo $bank_kana; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>銀行名<span class="f50P"> (30)</span></th>
                <td><input type="text" id="bank" name="bank" class="f130P wdtM" maxlength=30 style="ime-mode: active;" value="<?php echo $bank; ?>"></td>
            </tr>
            <tr>
                <th>支店番号<span class="f50P"> (3)</span></th>
                <td><input type="number" id="branch_code" name="branch_code" class="f130P wdtSS"  oninput="sliceMaxLength(this, 3)" style="ime-mode:disabled" pattern="[0-9]+" title="半角数字" value="<?php echo $branch_code; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>フリガナ<span class="f50P"> (30)</span></th>
                <td><input type="text" id="branch_kana" name="branch_kana" class="f130P wdtM" maxlength=30 style="ime-mode: active;" pattern="[ァ-ヴー\s　]+" title="カタカナ" placeholder="全角カタカナ" onblur="harf2wide(this);" value="<?php echo $branch_kana; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>支店名<span class="f50P"> (30)</span></th>
                <td><input type="text" id="branch" name="branch" class="f130P wdtM" maxlength=30 style="ime-mode: active;" value="<?php echo $branch; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>口座番号<span class="f50P"> (7)</span></th>
                <td><input type="number" id="account" name="account" class="f130P wdtS"  oninput="sliceMaxLength(this, 7)" style="ime-mode:disabled" pattern="[0-9]+" title="半角数字" value="<?php echo $account; ?>" autocomplete="off"></td>
            </tr>
        </table>


        <table class="edit">
            <caption>学歴</caption>
            <tr>
                <th>学歴</th>
                <td><input type="month" id="education_from" name="education_from" class="f130P" value="<?php echo $education_from; ?>">　〜　<input type="month" id="education_to" name="education_to" class="f130P" value="<?php echo $education_to; ?>"></td>
            </tr>
            <tr>
                <th>学校名<span class="f50P"> (30)</span></th>
                <td><input type="text" id="school" name="school" class="f130P wdtL" maxlength=30 style="ime-mode: active;"  value="<?php echo $school; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>卒業予定年月日<span class="f50P"> (30)</span></th>
                <td><input type="text" id="graduate" name="graduate" class="f130P wdtS" maxlength=30 style="ime-mode: active;"  value="<?php echo $graduate; ?>" autocomplete="off">※在学中の方のみご記入下さい</td>
            </tr>
        </table>


        <table class="edit">
            <caption>応募媒体</caption>
            <tr>
                <th>応募媒体<span class="f50P"> (50)</span></th>
                <td><input type="text" id="recruit" name="recruit" class="f130P wdtL" maxlength=50 style="ime-mode: active;"  value="<?php echo $recruit; ?>"></td>
            </tr>
        </table>

        <table class="edit">
            <caption>職歴</caption>
            <tr>
                <th>職歴１</th>
                <td>
                    期間：<input type="month" id="work1_from" name="work1_from" class="f130P" value="<?php echo $work1_from; ?>">　〜　<input type="month" id="work1_to" name="work1_to" class="f130P" value="<?php echo $work1_to; ?>"><br>
                    雇用形態<span class="f50P"> (20)</span>：<input type="text" id="work1_status" name="work1_status"  class="f130P wdtM" maxlength=20 style="ime-mode: active;"  value="<?php echo $work1_status; ?>"><br>
                    会社名称<span class="f50P"> (30)</span>：<input type="text" id="work1_company" name="work1_company" class="f130P wdtM" maxlength=30 style="ime-mode: active;"  value="<?php echo $work1_company; ?>" autocomplete="off"><br>
                    就業場所<span class="f50P"> (30)</span>：<input type="text" id="work1_location" name="work1_location" class="f130P wdtM" maxlength=30 style="ime-mode: active;"  value="<?php echo $work1_location; ?>" autocomplete="off"><br>
                    業務内容<span class="f50P"> (30)</span>：<input type="text" id="work1_job" name="work1_job" class="f130P wdtM" maxlength=30 style="ime-mode: active;"  value="<?php echo $work1_job; ?>" autocomplete="off"><br>
                </td>
            </tr>
            <tr>
                <th>職歴２</th>
                <td>
                    期間：<input type="month" id="work2_from" name="work2_from" class="f130P" value="<?php echo $work2_from; ?>">　〜　<input type="month" id="work2_to" name="work2_to" class="f130P" value="<?php echo $work2_to; ?>"><br>
                    雇用形態<span class="f50P"> (20)</span>：<input type="text" id="work2_status" name="work2_status"  class="f130P wdtM" maxlength=20 style="ime-mode: active;"  value="<?php echo $work2_status; ?>"><br>
                    会社名称<span class="f50P"> (30)</span>：<input type="text" id="work2_company" name="work2_company" class="f130P wdtM" maxlength=30 style="ime-mode: active;"  value="<?php echo $work2_company; ?>" autocomplete="off"><br>
                    就業場所<span class="f50P"> (30)</span>：<input type="text" id="work2_location" name="work2_location" class="f130P wdtM" maxlength=30 style="ime-mode: active;"  value="<?php echo $work2_location; ?>" autocomplete="off"><br>
                    業務内容<span class="f50P"> (30)</span>：<input type="text" id="work2_job" name="work2_job" class="f130P wdtM" maxlength=30 style="ime-mode: active;"  value="<?php echo $work2_job; ?>" autocomplete="off"><br>
                </td>
            </tr>
            <tr>
                <th>職歴３</th>
                <td>
                    期間：<input type="month" id="work3_from" name="work3_from" class="f130P" value="<?php echo $work3_from; ?>">　〜　<input type="month" id="work3_to" name="work3_to" class="f130P" value="<?php echo $work3_to; ?>"><br>
                    雇用形態<span class="f50P"> (20)</span>：<input type="text" id="work3_status" name="work3_status"  class="f130P wdtM" maxlength=20 style="ime-mode: active;"  value="<?php echo $work3_status; ?>"><br>
                    会社名称<span class="f50P"> (30)</span>：<input type="text" id="work3_company" name="work3_company" class="f130P wdtM" maxlength=30 style="ime-mode: active;"  value="<?php echo $work3_company; ?>" autocomplete="off"><br>
                    就業場所<span class="f50P"> (30)</span>：<input type="text" id="work3_location" name="work3_location" class="f130P wdtM" maxlength=30 style="ime-mode: active;"  value="<?php echo $work3_location; ?>" autocomplete="off"><br>
                    業務内容<span class="f50P"> (30)</span>：<input type="text" id="work3_job" name="work3_job" class="f130P wdtM" maxlength=30 style="ime-mode: active;"  value="<?php echo $work3_job; ?>" autocomplete="off"><br>
                </td>
            </tr>
            <tr>
                <th>職歴４</th>
                <td>
                    期間：<input type="month" id="work4_from" name="work4_from" class="f130P" value="<?php echo $work4_from; ?>">　〜　<input type="month" id="work4_to" name="work4_to" class="f130P" value="<?php echo $work4_to; ?>"><br>
                    雇用形態<span class="f50P"> (20)</span>：<input type="text" id="work4_status" name="work4_status"  class="f130P wdtM" maxlength=20 style="ime-mode: active;"  value="<?php echo $work4_status; ?>"><br>
                    会社名称<span class="f50P"> (30)</span>：<input type="text" id="work4_company" name="work4_company" class="f130P wdtM" maxlength=30 style="ime-mode: active;"  value="<?php echo $work4_company; ?>" autocomplete="off"><br>
                    就業場所<span class="f50P"> (30)</span>：<input type="text" id="work4_location" name="work4_location" class="f130P wdtM" maxlength=30 style="ime-mode: active;"  value="<?php echo $work4_location; ?>" autocomplete="off"><br>
                    業務内容<span class="f50P"> (30)</span>：<input type="text" id="work4_job" name="work4_job" class="f130P wdtM" maxlength=30 style="ime-mode: active;"  value="<?php echo $work4_job; ?>" autocomplete="off"><br>
                </td>
            </tr>
            <tr>
                <th>職歴５</th>
                <td>
                    期間：<input type="month" id="work5_from" name="work5_from" class="f130P" value="<?php echo $work5_from; ?>">　〜　<input type="month" id="work5_to" name="work5_to" class="f130P" value="<?php echo $work5_to; ?>"><br>
                    雇用形態<span class="f50P"> (20)</span>：<input type="text" id="work5_status" name="work5_status"  class="f130P wdtM" maxlength=20 style="ime-mode: active;"  value="<?php echo $work5_status; ?>"><br>
                    会社名称<span class="f50P"> (30)</span>：<input type="text" id="work5_company" name="work5_company" class="f130P wdtM" maxlength=30 style="ime-mode: active;"  value="<?php echo $work5_company; ?>" autocomplete="off"><br>
                    就業場所<span class="f50P"> (30)</span>：<input type="text" id="work5_location" name="work5_location" class="f130P wdtM" maxlength=30 style="ime-mode: active;"  value="<?php echo $work5_location; ?>" autocomplete="off"><br>
                    業務内容<span class="f50P"> (30)</span>：<input type="text" id="work5_job" name="work5_job" class="f130P wdtM" maxlength=30 style="ime-mode: active;"  value="<?php echo $work5_job; ?>" autocomplete="off"><br>
                </td>
            </tr>
            <tr>
                <th>備考</th>
                <td><textarea id="work_remarks" name="work_remarks"  class="f130P wdtL" rows=3><?php echo $work_remarks; ?></textarea></td>
            </tr>
        </table>




        <table class="edit">
            <caption>緊急連絡先</caption>
            <tr>
                <th>フリガナ<span class="f50P"> (30)</span></th>
                <td><input type="text" id="emergency_kana" name="emergency_kana" class="f130P wdtM" maxlength=30 style="ime-mode: active;" pattern="[ァ-ヴー\s　]+" title="カタカナ" placeholder="全角カタカナ" onblur="harf2wide(this);"  value="<?php echo $emergency_kana; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>連絡人<span class="f50P"> (30)</span></th>
                <td><input type="text" id="emergency" name="emergency" class="f130P wdtM" maxlength=30 style="ime-mode: active;"  value="<?php echo $emergency; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>郵便番号<span class="f50P"> (8)</span></th>
                <td><input type="text" id="post2" name="post2" class="f130P wdtSS" maxlength=8 style="ime-mode:disabled" placeholder="123-4567" pattern="\d{3}-?\d{4}" title="郵便番号"  value="<?php echo $post2; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>現住所<span class="f50P"> (100)</span></th>
                <td><input type="text" id="address2" name="address2" class="f130P wdtL" maxlength=100 style="ime-mode: active;"  value="<?php echo $address2; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>固定回線<span class="f50P"> (13)</span></th>
                <td><input type="tel" id="tel10" name="tel10" class="f130P wdtS" maxlength=13 style="ime-mode:disabled" placeholder="090-1234-5678" pattern="\d{2,4}-?\d{3,4}-?\d{3,4}"  value="<?php echo $tel10; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>携帯電話<span class="f50P"> (13)</span></th>
                <td><input type="tel" id="tel11" name="tel11" class="f130P wdtS" maxlength=13 style="ime-mode:disabled" placeholder="090-1234-5678" pattern="\d{2,4}-?\d{3,4}-?\d{3,4}"  value="<?php echo $tel11; ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <th>指定連絡先</th>
                <td>
                    <?php if(!isset($priority_tel)){ ?>
                    <input type="radio" id="priority_tel1" name="priority_tel" value="1" checked>固定
                    <input type="radio" name="priority_tel" value="2">携帯
                    <?php }elseif($priority_tel=="1"){ ?>
                    <input type="radio" id="priority_tel1" name="priority_tel" value="1" checked>固定
                    <input type="radio" name="priority_tel" value="2">携帯
                    <?php }else{ ?>
                    <input type="radio" id="priority_tel1" name="priority_tel" value="1">固定
                    <input type="radio" name="priority_tel" value="2" checked>携帯
                    <?php } ?>
                </td>
            </tr>
        </table>




        <table class="edit">
            <caption>その他</caption>
            <tr>
                <th>備考</th>
                <td><textarea id="remarks" name="remarks"  class="f130P wdtL" rows=5><?php echo $remarks; ?></textarea></td>
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
