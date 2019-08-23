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
            
            

            $sql = "UPDATE `employee` SET `work1_from`=?,`work1_to`=?,`work1_status`=?,`work1_company`=?,`work1_location`=?,`work1_job`=?,`work2_from`=?,`work2_to`=?,`work2_status`=?,`work2_company`=?,`work2_location`=?,`work2_job`=?,`work3_from`=?,`work3_to`=?,`work3_status`=?,`work3_company`=?,`work3_location`=?,`work3_job`=?,`work4_from`=?,`work4_to`=?,`work4_status`=?,`work4_company`=?,`work4_location`=?,`work4_job`=?,`work5_from`=?,`work5_to`=?,`work5_status`=?,`work5_company`=?,`work5_location`=?,`work5_job`=?,`work_remarks`=? WHERE `employee_seq`=?";

            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
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
    
    <form action="staffInfo6.php" method="POST">
        <table class="work1st fnt2em">

            <tr>
                <th colspan=2>職歴１</th>
            </tr>
            <tr>
                <th>期間</th>
                <td><input type="month" name="work1_from" class="txtS month"
                        value="<?php echo $work1_from; ?>">　〜　<input type="month" name="work1_to" class="txtS month"
                        value="<?php echo $work1_to; ?>"></td>
            </tr>
            <tr>
                <th>雇用形態<span class="fnt1em"> (20)</span></th>
                <td><input type="text" name="work1_status" class="txtS" maxlength=20 style="ime-mode: active;"
                        value="<?php echo $work1_status; ?>"></td>
            </tr>
            <tr>
                <th>会社名称<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="work1_company" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $work1_company; ?>"></td>
            </tr>
            <tr>
                <th>就業場所<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="work1_location" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $work1_location; ?>"></td>
            </tr>
            <tr>
                <th>業務内容<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="work1_job" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $work1_job; ?>"></td>
            </tr>

            <tr>
                <td colspan=2></td>
            </tr>
            <tr>
                <th colspan=2>職歴２</th>
            </tr>
            <tr>
                <th>期間</th>
                <td><input type="month" name="work2_from" class="txtS month"
                        value="<?php echo $work2_from; ?>">　〜　<input type="month" name="work2_to" class="txtS month"
                        value="<?php echo $work2_to; ?>"></td>
            </tr>
            <tr>
                <th>雇用形態<span class="fnt1em"> (20)</span></th>
                <td><input type="text" name="work2_status" class="txtS" maxlength=20 style="ime-mode: active;"
                        value="<?php echo $work2_status; ?>"></td>
            </tr>
            <tr>
                <th>会社名称<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="work2_company" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $work2_company; ?>"></td>
            </tr>
            <tr>
                <th>就業場所<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="work2_location" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $work2_location; ?>"></td>
            </tr>
            <tr>
                <th>業務内容<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="work2_job" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $work2_job; ?>"></td>
            </tr>


            <tr>
                <td colspan=2></td>
            </tr>
            <tr>
                <th colspan=2>職歴３</th>
            </tr>
            <tr>
                <th>期間</th>
                <td><input type="month" name="work3_from" class="txtS month"
                        value="<?php echo $work3_from; ?>">　〜　<input type="month" name="work3_to" class="txtS month"
                        value="<?php echo $work3_to; ?>"></td>
            </tr>
            <tr>
                <th>雇用形態<span class="fnt1em"> (20)</span></th>
                <td><input type="text" name="work3_status" class="txtS" maxlength=20 style="ime-mode: active;"
                        value="<?php echo $work3_status; ?>"></td>
            </tr>
            <tr>
                <th>会社名称<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="work3_company" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $work3_company; ?>"></td>
            </tr>
            <tr>
                <th>就業場所<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="work3_location" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $work3_location; ?>"></td>
            </tr>
            <tr>
                <th>業務内容<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="work3_job" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $work3_job; ?>"></td>
            </tr>


            <tr>
                <td colspan=2></td>
            </tr>

            <tr>
                <th colspan=2>職歴４</th>
            </tr>
            <tr>
                <th>期間</th>
                <td><input type="month" name="work4_from" class="txtS month"
                        value="<?php echo $work4_from; ?>">　〜　<input type="month" name="work4_to" class="txtS month"
                        value="<?php echo $work4_to; ?>"></td>
            </tr>
            <tr>
                <th>雇用形態<span class="fnt1em"> (20)</span></th>
                <td><input type="text" name="work4_status" class="txtS" maxlength=20 style="ime-mode: active;"
                        value="<?php echo $work4_status; ?>"></td>
            </tr>
            <tr>
                <th>会社名称<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="work4_company" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $work4_company; ?>"></td>
            </tr>
            <tr>
                <th>就業場所<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="work4_location" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $work4_location; ?>"></td>
            </tr>
            <tr>
                <th>業務内容<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="work4_job" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $work4_job; ?>"></td>
            </tr>


            <tr>
                <td colspan=2></td>
            </tr>

            <tr>
                <th colspan=2>職歴５</th>
            </tr>
            <tr>
                <th>期間</th>
                <td><input type="month" name="work5_from" class="txtS month"
                        value="<?php echo $work5_from; ?>">　〜　<input type="month" name="work5_to" class="txtS month"
                        value="<?php echo $work5_to; ?>"></td>
            </tr>
            <tr>
                <th>雇用形態<span class="fnt1em"> (20)</span></th>
                <td><input type="text" name="work5_status" class="txtS" maxlength=20 style="ime-mode: active;"
                        value="<?php echo $work5_status; ?>"></td>
            </tr>
            <tr>
                <th>会社名称<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="work5_company" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $work5_company; ?>"></td>
            </tr>
            <tr>
                <th>就業場所<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="work5_location" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $work5_location; ?>"></td>
            </tr>
            <tr>
                <th>業務内容<span class="fnt1em"> (30)</span></th>
                <td><input type="text" name="work5_job" class="txtS" maxlength=30 style="ime-mode: active;"
                        value="<?php echo $work5_job; ?>"></td>
            </tr>


            <tr>
                <td colspan=2></td>
            </tr>
            <tr>
                <td colspan=2></td>
            </tr>
            <tr>
                <th>備考</th>
                <td><textarea name="work_remarks" class="txtS" rows=4><?php echo $work_remarks; ?></textarea>
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