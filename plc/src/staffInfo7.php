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

            $emergency_kana = $_POST['emergency_kana'];
            $emergency = $_POST['emergency'];
            $tel10 = $_POST['tel10'];
            $tel11 = $_POST['tel11'];
            $priority_tel = $_POST['priority_tel'];
            $post2 = $_POST['post2'];
            $address2 = $_POST['address2'];
        
            
            $sql = "UPDATE `employee` SET `emergency_kana`=?,`emergency`=?,`tel10`=?,`tel11`=?,`priority_tel`=?,`post2`=?,`address2`=? WHERE `employee_seq`=?";

            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                $emergency_kana,
                $emergency,
                $tel10,
                $tel11,
                $priority_tel,
                $post2,
                $address2,
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

    <div class='headbutton'><a href='staffInfo1.php'><img src='../img/back.png'></a></div>

    <form action="staffInfo7.php" method="POST">
        <table class="work1st fnt2em">

            <tr>
                <th>フリガナ<span class="fnt1em"> (30)</span></th>
                <td><input type="text" id="emergency_kana" name="emergency_kana" class="txtS" maxlength=30
                        style="ime-mode: active;" pattern="[ァ-ヴー\s　]+" title="カタカナ" placeholder="全角カタカナ"
                        onblur="harf2wide(this);" value="<?php echo $emergency_kana; ?>"></td>
            </tr>
            <tr>
                <th>連絡人<span class="fnt1em"> (30)</span></th>
                <td><input type="text" id="emergency" name="emergency" class="txtS" maxlength=30
                        style="ime-mode: active;" value="<?php echo $emergency; ?>"></td>
            </tr>
            <tr>
                <th>郵便番号<span class="fnt1em"> (8)</span></th>
                <td><input type="text" id="post2" name="post2" class="txtS" maxlength=8 style="ime-mode:disabled"
                        placeholder="123-4567" pattern="\d{3}-?\d{4}" title="郵便番号" value="<?php echo $post2; ?>"></td>
            </tr>
            <tr>
                <th>現住所<span class="fnt1em"> (100)</span></th>
                <td><input type="text" id="address2" name="address2" class="txtS" maxlength=100
                        style="ime-mode: active;" value="<?php echo $address2; ?>"></td>
            </tr>
            <tr>
                <th>固定回線<span class="fnt1em"> (13)</span></th>
                <td><input type="tel" id="tel10" name="tel10" class="txtS" maxlength=13 style="ime-mode:disabled"
                        placeholder="090-1234-5678" pattern="\d{2,4}-?\d{3,4}-?\d{3,4}" value="<?php echo $tel10; ?>">
                </td>
            </tr>
            <tr>
                <th>携帯電話<span class="fnt1em"> (13)</span></th>
                <td><input type="tel" id="tel11" name="tel11" class="txtS" maxlength=13 style="ime-mode:disabled"
                        placeholder="090-1234-5678" pattern="\d{2,4}-?\d{3,4}-?\d{3,4}" value="<?php echo $tel11; ?>">
                </td>
            </tr>
            <tr>
                <th>指定連絡先</th>
                <td>
                    <?php
                        if($priority_tel=="1"){
                            $pt1 = " checked";
                            $pt2 = "";
                        }elseif($priority_tel=="2"){
                            $pt1 = "";
                            $pt2 = " checked";
                        }else{
                            $pt1 = "";
                            $pt2 = "";
                        }
                    ?>
                    <input type="radio" name="priority_tel" class="fnt1em" value="1" <?php echo $pt1; ?>>固定
                    <input type="radio" name="priority_tel" class="fnt1em" value="2" <?php echo $pt2; ?>>携帯
                </td>
            </tr>

            <tr>
                <td colspan="2"><button type=submit name="staffInfo" class="btn-sticky">登録</button></td>
            </tr>
            </tbody>
        </table>
    </form>


</body>

</html>