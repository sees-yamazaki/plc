<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

$uSeq = $_SESSION['SEQ'];

$ini = parse_ini_file('../common.ini', FALSE);


    try {

        require_once 'dns.php';
    

        $stmt = $pdo->prepare('SELECT * FROM employee where employee_level=99 and employee_seq = ?');
        $stmt->execute(array($uSeq));
        
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
    <meta name="google" content="notranslate" />
    <link rel="stylesheet" href="../css/staff.css">
    <link rel="stylesheet" type="text/css" href="../css/hiraku.css">
    <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="../js/hiraku.js"></script>
</head>

<body>

    <?php include('./staffMenu.php'); ?>

    <div class='headbutton'><a href='staff.php'><img src='../img/home.png'></a></div>

    <form action="staffInfo2.php" method="POST">
        <table class="work1st">
            <tr>
                <th colspan=2>基本情報</th>
            </tr>
            <tr>
                <th>フリガナ</th>
                <td><?php echo $name_kana; ?></td>
            </tr>
            <tr>
                <th>氏名</th>
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    <?php if(!isset($sex) || $sex=="1"){ ?>
                    男
                    <?php }else{ ?>
                    女
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>生年月日</th>
                <td><?php echo $birthday; ?></td>
            </tr>
            <tr>
                <th>郵便番号</th>
                <td><?php echo $post; ?></td>
            </tr>
            <tr>
                <th>フリガナ</th>
                <td><?php echo $address_kana; ?></td>
            </tr>
            <tr>
                <th>現住所</th>
                <td><?php echo $address; ?></td>
            </tr>
            <tr>
                <th>連絡先</th>
                <td><?php echo $tel1; ?></td>
            </tr>
            <tr>
                <th>携帯電話</th>
                <td><?php echo $tel2; ?></td>
            </tr>
            <tr>
                <th>留守電の有無</th>
                <td>
                    <?php if($answering=="1"){ ?>
                    有
                    <?php }else{ ?>
                    無
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>FAXの有無</th>
                <td>
                    <?php if($fax=="1"){ ?>
                    有
                    <?php }else{ ?>
                    無
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>E-mail：携帯</th>
                <td><?php echo $email1; ?></td>
            </tr>
            <tr>
                <th>E-mail：PC</th>
                <td><?php echo $email2; ?></td>
            </tr>
            <tr>
                <th>指定アドレス</th>
                <td>
                    <?php if(!isset($sex)){ ?>
                    <?php }elseif($sex=="1"){ ?>
                    携帯
                    <?php }else{ ?>
                    PC
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td colspan=2 class="edit"><button type='submit' name='edit'>編集</button></td>
            </tr>
        </table>
    </form>

    <form action="staffInfo3.php" method="POST">
        <table class="work2nd">
            <tr>
                <th colspan=2>交通情報</th>
            </tr>
            <tr>
                <th>最寄りの路線・駅</th>
                <td><?php echo $route."線"; ?><br><?php echo $station."駅"; ?></td>
            </tr>
            <tr>
                <th>バス利用</th>
                <td>
                    <?php if($bus=="1"){ ?>
                    有
                    <?php }else{ ?>
                    無
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>バスの路線名</th>
                <td><?php echo $bus_name; ?></td>
            </tr>
            <tr>
                <th>バス停名</th>
                <td><?php echo $bus_stop; ?></td>
            </tr>
            <tr>
                <td colspan=2 class="edit"><button type='submit' name='edit'>編集</button></td>
            </tr>
        </table>
    </form>

    <form action="staffInfo4.php" method="POST">
        <table class="work2nd">
            <tr>
                <th colspan=2>銀行口座</th>
            </tr>
            <tr>
                <th>フリガナ</th>
                <td><?php echo $bank_kana; ?></td>
            </tr>
            <tr>
                <th>銀行名</th>
                <td><?php echo $bank; ?></td>
            </tr>
            <tr>
                <th>支店番号</th>
                <td><?php echo $branch_code; ?></td>
            </tr>
            <tr>
                <th>フリガナ</th>
                <td><?php echo $branch_kana; ?></td>
            </tr>
            <tr>
                <th>支店名</th>
                <td><?php echo $branch; ?></td>
            </tr>
            <tr>
                <th>口座番号</th>
                <td><?php echo $account; ?></td>
            </tr>
            <tr>
                <td colspan=2 class="edit"><button type='submit' name='edit'>編集</button></td>
            </tr>
        </table>
    </form>
    </form>

    <form action="staffInfo5.php" method="POST">
        <table class="work2nd">
            <tr>
                <th colspan=2>学歴</th>
            </tr>
            <tr>
                <th>学歴</th>
                <td><?php echo $education_from; ?>　〜　<?php echo $education_to; ?></td>
            </tr>
            <tr>
                <th>学校名</th>
                <td><?php echo $school; ?></td>
            </tr>
            <tr>
                <th>卒業予定年月日</th>
                <td><?php echo $graduate; ?></td>
            </tr>
            <tr>
                <td colspan=2 class="edit"><button type='submit' name='edit'>編集</button></td>
            </tr>
        </table>
    </form>

    <form action="staffInfo5.php" method="POST">
        <table class="work2nd">
            <tr>
                <th>応募媒体</th>
                <td><?php echo $recruit; ?></td>
            </tr>
            <tr>
                <td colspan=2 class="edit"><button type='submit' name='edit'>編集</button></td>
            </tr>
        </table>
    </form>

    <form action="staffInfo6.php" method="POST">
        <table class="work2nd">
            <tr>
                <th colspan=2>職歴</th>
            </tr>
            <tr>
                <th>職歴１</th>
                <td>
                    期間：<?php echo $work1_from; ?>　〜　<?php echo $work1_to; ?><br>
                    雇用形態：<?php echo $work1_status; ?><br>
                    会社名称：<?php echo $work1_company; ?><br>
                    就業場所：<?php echo $work1_location; ?><br>
                    業務内容：<?php echo $work1_job; ?><br>
                </td>
            </tr>
            <tr>
                <th>職歴２</th>
                <td>
                    期間：<?php echo $work2_from; ?>　〜　<?php echo $work2_to ?><br>
                    雇用形態：<?php echo $work2_status; ?><br>
                    会社名称：<?php echo $work2_company; ?><br>
                    就業場所：<?php echo $work2_location; ?><br>
                    業務内容：<?php echo $work2_job; ?><br>
                </td>
            </tr>
            <tr>
                <th>職歴３</th>
                <td>
                    期間：<?php echo $work3_from; ?>　〜　<?php echo $work3_to; ?><br>
                    雇用形態：<?php echo $work3_status; ?><br>
                    会社名称：<?php echo $work3_company; ?><br>
                    就業場所：<?php echo $work3_location; ?><br>
                    業務内容：<?php echo $work3_job; ?><br>
                </td>
            </tr>
            <tr>
                <th>職歴４</th>
                <td>
                    期間：<?php echo $work4_from; ?>　〜　<?php echo $work4_to; ?><br>
                    雇用形態：<?php echo $work4_status; ?><br>
                    会社名称：<?php echo $work4_company; ?><br>
                    就業場所：<?php echo $work4_location; ?><br>
                    業務内容：<?php echo $work4_job; ?><br>
                </td>
            </tr>
            <tr>
                <th>職歴５</th>
                <td>
                    期間：<?php echo $work5_from; ?>　〜　<?php echo $work5_to; ?><br>
                    雇用形態：<?php echo $work5_status; ?><br>
                    会社名称：<?php echo $work5_company; ?><br>
                    就業場所：<?php echo $work5_location; ?><br>
                    業務内容：<?php echo $work5_job; ?><br>
                </td>
            </tr>
            <tr>
                <th>備考</th>
                <td><?php echo nl2br($work_remarks); ?></td>
            </tr>
            <tr>
                <td colspan=2 class="edit"><button type='submit' name='edit'>編集</button></td>
            </tr>
        </table>
    </form>



    <form action="staffInfo7.php" method="POST">
        <table class="work2nd">
            <tr>
                <th colspan=2>緊急連絡先</th>
            </tr>
            <tr>
                <th>フリガナ</th>
                <td><?php echo $emergency_kana; ?></td>
            </tr>
            <tr>
                <th>連絡人</th>
                <td><?php echo $emergency; ?></td>
            </tr>
            <tr>
                <th>郵便番号</th>
                <td><?php echo $post2; ?></td>
            </tr>
            <tr>
                <th>現住所</th>
                <td><?php echo $address2; ?></td>
            </tr>
            <tr>
                <th>固定回線</th>
                <td><?php echo $tel10; ?></td>
            </tr>
            <tr>
                <th>携帯電話</th>
                <td><?php echo $tel11; ?></td>
            </tr>
            <tr>
                <th>指定連絡先</th>
                <td>
                    <?php if(!isset($priority_tel)){ ?>
                    <?php }elseif($priority_tel=="1"){ ?>
                    固定
                    <?php }else{ ?>
                    携帯
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td colspan=2 class="edit"><button type='submit' name='edit'>編集</button></td>
            </tr>
        </table>
    </form>





</body>

</html>