<?php

    session_start();

    // ログイン状態チェック
    if (!isset($_SESSION["NAME"])) {
        header("Location: Logout.php");
        exit;
    }

    $ini = parse_ini_file('../common.ini', FALSE);

    if (!empty($_SESSION["LEVEL"])) {

        // SESSIONのユーザLEVELを格納
        $userlvl = $_SESSION["LEVEL"];

        
        // 3. エラー処理
        try {

            require_once 'dns.php';
            
            $eSeq = $_POST['eSeq'];

            $stmt = $pdo->prepare('SELECT * FROM employee where employee_seq = ?');
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
                if($pay_type=="1"){
                    $py1 = "checked";
                }elseif($pay_type=="2"){
                    $py2 = "checked";
                }elseif($pay_type=="3"){
                    $py3 = "checked";
                }
                $pay_unitcost = $row['pay_unitcost'];
                $sales_unitcost = $row['sales_unitcost'];
                $transport_unitcosts = $row['transport_unitcosts'];
                $pass_cost = $row['pass_cost'];
                $user_seq = $row['user_seq'];
            }



            
            // グループ
            $stmt = $pdo->prepare('SELECT * FROM `group` where group_seq = ?');
            $stmt->execute(array($group_seq));
            $row = $stmt->fetch();
            $group = $row['group_name'];

            
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
    <meta http-equiv="content-language" content="ja">
    <meta name="google" content="notranslate" />
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/employeeEdit.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/employeeEdit.js"></script>
</head>

<body>
    <?php $eSeq ?>
    <?php include('./menu.php'); ?>

    <div class="nav">
        <button type="button" onclick="location.href='employeeList.php'" class="back">戻る</button>
        <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    </div><br>


    <form id="editUser" action="employeeEdit.php" method="POST" onsubmit="return submitChk()">

        <input type="hidden" name="eSeq" value="<?php echo $eSeq; ?>">

        <table class="edit">
            <tr>
                <th>ステータス</th>
                <td>
                    <?php if(!isset($status) || $status=="1"){ ?>
                    稼動
                    <?php }else{ ?>
                    非稼動
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>会社グループ</th>
                <td>
                    <?php echo $group; ?>
                </td>
            </tr>
            <tr>
                <th>属性</th>
                <td>
                    <?php if(!isset($kind) || $kind=="1"){ ?>
                    CP
                    <?php }elseif($kind=="2"){ ?>
                    派遣社員
                    <?php }else{ ?>
                    社員
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>社会保険有無</th>
                <td>
                    <?php if(!isset($insurance) || $insurance=="1"){ ?>
                    加入
                    <?php }else{ ?>
                    未加入
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>アラート</th>
                <td><?php echo $alert_time; ?>分前</td>
            </tr>
        </table>



        <table class="edit">
            <caption>基本情報</caption>
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
        </table>



        <table class="edit">
            <caption>コスト情報</caption>
            <tr>
                <th>契約携帯</th>
                <td>
                    <?php if($pay_type=="1"){ ?>
                    時給
                    <?php }elseif($pay_type=="3"){ ?>
                    日給
                    <?php }else{ ?>
                    月給
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>契約単価</th>
                <td><?php echo number_format(intval($pay_unitcost)); ?></td>
            </tr>
            <tr>
                <th>売上単価</th>
                <td><?php echo number_format(intval($sales_unitcost)); ?></td>
            </tr>
            <tr>
                <th>交通費</th>
                <td>1日（往復）：<?php echo number_format(intval($transport_unitcosts)); ?><br>１ヶ月定期：<?php echo number_format(intval($pass_cost)); ?></td>
            </tr>
        </table>



        <table class="edit">
            <caption>交通情報</caption>
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
        </table>


        <table class="edit">
            <caption>銀行口座</caption>
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
        </table>


        <table class="edit">
            <caption>学歴</caption>
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
                <td><<?php echo $graduate; ?></td>
            </tr>
        </table>


        <table class="edit">
            <caption>応募媒体</caption>
            <tr>
                <th>応募媒体</th>
                <td><?php echo $recruit; ?></td>
            </tr>
        </table>

        <table class="edit">
            <caption>職歴</caption>
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
        </table>




        <table class="edit">
            <caption>緊急連絡先</caption>
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
        </table>




        <table class="edit">
            <caption>その他</caption>
            <tr>
                <th>備考</th>
                <td><?php echo nl2br($remarks); ?></td>
            </tr>
        </table>

        
    </form>



</body>

</html>
