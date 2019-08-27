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

            $education_from = $_POST['education_from'];
            $education_to = $_POST['education_to'];
            $school = $_POST['school'];
            $graduate = $_POST['graduate'];
            $recruit = $_POST['recruit'];
            
            
            $sql = "UPDATE `employee` SET `education_from`=?,`education_to`=?,`school`=?,`graduate`=?,`recruit`=? WHERE `employee_seq`=?";

            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                $education_from,
                $education_to,
                $school,
                $graduate,
                $recruit,
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

    <form action="staffInfo5.php" method="POST">
        <table class="work fnt2em">

            <tr>
                <th>学歴</th>
                <td><input type="month" name="education_from" class="txtS"
                        value="<?php echo $education_from; ?>">　〜　<input type="month" id="education_to"
                        name="education_to" class="txtS" value="<?php echo $education_to; ?>"></td>
            </tr>
            <tr>
                <th>学校名<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="school" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $school; ?>"></td>
            </tr>
            <tr>
                <th>卒業予定年月日<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="graduate" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $graduate; ?>">※在学中の方のみご記入下さい</td>
            </tr>
            <tr>
                <td colspan=2></td>
            </tr>
            <tr>
                <td colspan=2></td>
            </tr>
            <tr>
                <th>応募媒体<span class="fnt1em"> (50)</span></th>
                <td><input type="text" name="recruit" class="txtS" maxlength=50 style="ime-mode: active;"
                        value="<?php echo $recruit; ?>"></td>
            </tr>

            <tr>
                <td colspan="2"><button type=submit name="staffInfo" class="btn-sticky">登録</button></td>
            </tr>
            </tbody>
        </table>
    </form>


</body>

</html>