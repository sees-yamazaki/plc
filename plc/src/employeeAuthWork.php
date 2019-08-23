<?php

    session_start();

    // ログイン状態チェック
    if (!isset($_SESSION["NAME"])) {
        header("Location: Logout.php");
        exit;
    }

    $ini = parse_ini_file('../common.ini', FALSE);

    
    try {

        require_once 'dns.php';
        
        if(isset($_POST['authWork'])){

            $aSeq = $_POST['aSeq'];
            $stmt = $pdo->prepare('UPDATE auth_work SET `status`=2 WHERE aw_seq = ?');
            $stmt->execute(array($aSeq));


            //job_seq から client_seq を取得
            $job_seq = $_POST['job_seq'];
            $stmt = $pdo->prepare('SELECT * FROM job where job_seq =  ? ');
            $stmt->execute(array($job_seq));
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $cSeq = $row['client_seq'];
            }

            $eSeq = $_POST['eSeq'];
            $tY = $_POST['tY'];
            $tM = $_POST['tM'];
            $stmt = $pdo->prepare('UPDATE schedule SET `job_seq`=?, `client_seq`=? WHERE user_seq = ? and work_y=? and work_m=? ');
            $stmt->execute(array($job_seq,$cSeq,$eSeq,$tY,$tM));

            header("Location: ./employeeAuth.php");

        }else{


            $aSeq = $_POST['aSeq'];
            $eName = $_POST['name'];
            //申請対象を取得する
            $stmt = $pdo->prepare('SELECT * FROM auth_work WHERE aw_seq = ?');
            $stmt->execute(array($aSeq));
            $row = $stmt->fetch();
            $eSeq = $row['employee_seq'];
            $tY = $row['work_y'];
            $tM = $row['work_m'];

            require_once 'date.php';
            $tgtTime = getTimestamp_LastDate($tY,$tM);
            $firstday =  getTimestamp($tY,$tM);


            $wk = intval(date("w",  $firstday));
            $week_name = array("日", "月", "火", "水", "木", "金", "土");
            
            $stmt = $pdo->prepare('SELECT * FROM schedule WHERE user_seq = ? and work_y = ? and work_m = ? ');
            $stmt->execute(array($eSeq,$tY,$tM));
            $rows = $stmt->fetchAll();
            
            $html="";
            for($i = 1; $i <= idate('t',$tgtTime); ++$i) {
                $str="";
                foreach ($rows as $row) {
                    if($row['work_d']==$i){
                        $str =  "";
                        // 出発時間
                        $str .= "<td>".date('H:i',  strtotime($row['plan_leave_time']))."</td>";
                        // 出勤時間
                        $str .= "<td>".date('H:i',  strtotime($row['plan_start_time']))."</td>";
                        // 退勤時間
                        $str .= "<td>".date('H:i',  strtotime($row['plan_end_time']))."</td>";
                    }
                }
                if($str==""){
                    $str="<td>--:--</td><td>--:--</td><td>--:--</td>";
                }
                $x = ($wk + $i - 1) % 7;
                $html.="<tr><th>".$tM." / ".$i." (" . ($week_name[$x]) . ")"."</th>".$str."</tr>";
            }
        }


        // 案件情報
        $stmt = $pdo->prepare('SELECT * FROM `job` order by job_seq');
        $stmt->execute(array());
        $rows = $stmt->fetchAll();

        $jName;
        foreach ($rows as $row) {
            if($row['job_seq']==$jSeq){
                $job .= "<option value='".$row['job_seq']."' selected>".$row['job_id'].":".$row['name']."</option>";
                $jName = $row['job_id'].":".$row['name'];
            }else{
                $job .= "<option value='".$row['job_seq']."'>".$row['job_id'].":".$row['name']."</option>";
            }
        }
        
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
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
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/employeeEdit.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/employeeEdit.js"></script>
</head>

<body>
    <?php $eSeq ?>
    <?php include('./menu.php'); ?>

    
    <div class="nav">
        <button type="button" onclick="location.href='employeeAuth.php'" class="back">戻る</button>
        <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    </div><br>

    <table class="cal" style="width:60%">
        <tr>
            <td class="titleYM"><?php echo $tY; ?> / <?php echo $tM; ?></td>
            <td class="titleYM" colspan=3>[ <?php echo $eName; ?> ]</td>
        </tr>
        <tr>
        </tr>
    </table>
    <br>

    <form action="employeeAuthWork.php" method="POST">
    <table class="cal" style="width:400px">
        <tr>
            <th>案件</th>
            <td width=500>
                <div class="cp_ipselect cp_sl04">
                <select id="job_seq" name="job_seq" required width="100%">
                    <option value="">選択してください</option>
                    <?php echo $job; ?>
                </select>
                </div>
            </td>
        </tr>
    </table>
    <br>
    <table class="cal" style="width:60%">
        <tr>
            <th class="add">
                    <button type='submit' name='authWork'>承認する</button>
                    <input type="hidden" name="aSeq" value="<?php echo $aSeq; ?>">
                    <input type="hidden" name="eSeq" value="<?php echo $eSeq; ?>">
                    <input type="hidden" name="tY" value="<?php echo $tY; ?>">
                    <input type="hidden" name="tM" value="<?php echo $tM; ?>">
            </th>
            <th>出発</th>
            <th>出勤</th>
            <th>退勤</th>
        </tr>
        <?php echo $html; ?>
    </table>
    </form>



</body>

</html>
