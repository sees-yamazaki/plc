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

            $bank_kana = $_POST['bank_kana'];
            $bank = $_POST['bank'];
            $branch_code = $_POST['branch_code'];
            $branch_kana = $_POST['branch_kana'];
            $branch = $_POST['branch'];
            $account = $_POST['account'];
            
            
            $sql = "UPDATE `employee` SET `bank_kana`=?,`bank`=?,`branch_code`=?,`branch_kana`=?,`branch`=? ,`account`=? WHERE `employee_seq`=?";

            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                $bank_kana,
                $bank,
                $branch_code,
                $branch_kana,
                $branch,
                $account,
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

    <form action="staffInfo4.php" method="POST">
        <table class="work fnt2em">
            <tr>
                <th>フリガナ<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="bank_kana" class="txtS" maxlength=30 style="ime-mode: active;"
                        pattern="[ァ-ヴー\s　]+" title="カタカナ" placeholder="全角カタカナ" onblur="harf2wide(this);"
                        value="<?php echo $bank_kana; ?>"></td>
            </tr>
            <tr>
                <th>銀行名<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="bank" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $bank; ?>"></td>
            </tr>
            <tr>
                <th>支店番号<span class="fnt1em"> (3)</span></th>
                <td><input type="number" name="branch_code" class="txtS" oninput="sliceMaxLength(this, 3)"
                        style="ime-mode:disabled" pattern="[0-9]+" title="半角数字" value="<?php echo $branch_code; ?>">
                </td>
            </tr>
            <tr>
                <th>フリガナ<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="branch_kana" class="txtS" maxlength=30 style="ime-mode: active;"
                        pattern="[ァ-ヴー\s　]+" title="カタカナ" placeholder="全角カタカナ" onblur="harf2wide(this);"
                        value="<?php echo $branch_kana; ?>"></td>
            </tr>
            <tr>
                <th>支店名<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="branch" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $branch; ?>"></td>
            </tr>
            <tr>
                <th>口座番号<span class="fnt1em"> (7)</span></th>
                <td><input type="number" name="account" class="txtS" oninput="sliceMaxLength(this, 7)"
                        style="ime-mode:disabled" pattern="[0-9]+" title="半角数字" value="<?php echo $account; ?>"></td>
            </tr>


            <tr>
                <td colspan="2"><button type=submit name="staffInfo" class="btn-sticky">登録</button></td>
            </tr>
            </tbody>
        </table>
    </form>


</body>

</html>