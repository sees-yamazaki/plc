<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

$eSeq = $_SESSION['SEQ'];

$ini = parse_ini_file('../common.ini', FALSE);


    try {

        require_once 'dns.php';
        
        
        if(isset($_POST['staffInfo'])){

            $address_kana = $_POST['address_kana'];
            $address = $_POST['address'];
            $tel1 = $_POST['tel1'];
            $tel2 = $_POST['tel2'];
            $answering = $_POST['answering'];
            $fax = $_POST['fax'];
            $email1 = $_POST['email1'];
            $email2 = $_POST['email2'];
            $priority_email = $_POST['priority_email'];
            
            
            $sql = "UPDATE `employee` SET `address_kana`=?,`address`=?,`tel1`=?,`tel2`=?,`answering`=?,`fax`=?,`email1`=?,`email2`=?,`priority_email`=? WHERE `employee_seq`=?";

            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                $address_kana,
                $address,
                $tel1,
                $tel2,
                $answering,
                $fax,
                $email1,
                $email2,
                $priority_email,
                $eSeq));


                //$_SESSION['MSG'] = "パスワードを更新しました。";

            header("Location: ./staffInfo1.php");

        }else{

            $stmt = $pdo->prepare('SELECT * FROM employee where employee_level=99 and employee_seq = ?');
            $stmt->execute(array($eSeq));
            
            if($row = $stmt->fetch()){

                $employee_id = $row['employee_id'];
                $status = $row['status'];
                $group_seq = $row['group_seq'];
                $kind = $row['kind'];
                $insurance = $row['insurance'];
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
                $user_seq = $row['user_seq'];
            }


        }


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
    
    $fButton = "<div class='headbutton'><a href='staffInfo1.php'><img src='../img/back.png'></a></div>";

?>
<!DOCTYPE html>
<html>

<head class="wf-sawarabigothic">
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/staff.css">
    <link rel="stylesheet" type="text/css" href="../css/hiraku.css">
    <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="../js/hiraku.js"></script>
</head>

<body>

    <?php include('./staffMenu.php'); ?>

    <form action="staffInfo2.php" method="POST">
        <input type="hidden" name="eSeq" value="<?php echo $eSeq; ?>">
        <table class="work1st fnt2em">
            <tbody>
                <tr>
                    <th class="arrow_box">ジュウショ<span class="fnt1em"> (100)</span></th>
                    <td><textarea name="address_kana" class="txtS" rows=4 maxlength=100
                            pattern="[-ァ-ヴー\s　０-９0-9a-zA-Z]+" title="カタカナ、数字、スペース、英字"
                            placeholder="全角カタカナ、数字、英字、スペース"><?php echo $address_kana; ?></textarea></td>
                </tr>
                <tr>
                    <th class="arrow_box">住所<span class="fnt1em"> (100)</span></th>
                    <td><textarea name="address" class="txtS" rows=4 maxlength=100><?php echo $address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th><span class="required">連絡先<span class="fnt1em"> (13)</span></span></th>
                    <td><input type="tel" id="tel1" name="tel1" class="txtS" maxlength=13 style="ime-mode:disabled"
                            placeholder="090-1234-5678" pattern="\d{2,4}-?\d{3,4}-?\d{3,4}" title="電話番号" required
                            value="<?php echo $tel1; ?>"></td>
                </tr>
                <tr>
                    <th>携帯電話<span class="fnt1em"> (13)</span></th>
                    <td><input type="tel" id="tel2" name="tel2" class="txtS" maxlength=13 style="ime-mode:disabled"
                            placeholder="090-1234-5678" pattern="\d{2,4}-?\d{3,4}-?\d{3,4}" title="電話番号"
                            value="<?php echo $tel2; ?>"></td>
                </tr>
                <tr>
                    <th>留守電の有無</th>
                    <td>
                        <?php if($answering=="1"){ ?>
                        <input type="radio" name="answering" class="fnt1em" value="1" checked>有
                        <input type="radio" name="answering" class="fnt1em" value="2">無
                        <?php }else{ ?>
                        <input type="radio" name="answering" class="fnt1em" value="1">有
                        <input type="radio" name="answering" class="fnt1em" value="2" checked>無
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th>FAXの有無</th>
                    <td>
                        <?php if($fax=="1"){ ?>
                        <input type="radio" name="fax" class="fnt1em" value="1" checked>有
                        <input type="radio" name="fax" class="fnt1em" value="2">無
                        <?php }else{ ?>
                        <input type="radio" name="fax" class="fnt1em" value="1">有
                        <input type="radio" name="fax" class="fnt1em" value="2" checked>無
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th><span class="required">E-mail：携帯<span class="f50P"> (50)</span></span></th>
                    <td><input type="email" id="email1" name="email1" style="ime-mode:disabled" class="txtS"
                            maxlength=50 placeholder="localname@domain.com"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス" required
                            value="<?php echo $email1; ?>"></td>
                </tr>
                <tr>
                    <th>E-mail：PC<span class="fnt1em"> (50)</span></th>
                    <td><input type="email" id="email2" name="email2" style="ime-mode:disabled" class="txtS"
                            maxlength=50 placeholder="localname@domain.com"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="メールアドレス"
                            value="<?php echo $email2; ?>"></td>
                </tr>
                <tr>
                    <th><span class="required">指定アドレス</span></th>
                    <td>
                        <?php if(!isset($sex)){ ?>
                        <input type="radio" name="priority_email" class="fnt1em" value="1" required>携帯
                        <input type="radio" name="priority_email" class="fnt1em" value="2">PC
                        <?php }elseif($sex=="1"){ ?>
                        <input type="radio" name="priority_email" class="fnt1em" value="1" required checked>携帯
                        <input type="radio" name="priority_email" class="fnt1em" value="2">PC
                        <?php }else{ ?>
                        <input type="radio" name="priority_email" class="fnt1em" value="1" required>携帯
                        <input type="radio" name="priority_email" class="fnt1em" value="2" checked>PC
                        <?php } ?>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="edit"><button type=submit name="staffInfo">登録</button></td>
                </tr>
            </tbody>
        </table>
    </form>


</body>

</html>