<?php

    session_start();

    // ログイン状態チェック
    if (!isset($_SESSION["NAME"])) {
        header("Location: Logout.php");
        exit;
    }

    $ini = parse_ini_file('../common.ini', FALSE);

    if (!empty($_SESSION["LEVEL"])) {

        try {

            require_once 'dns.php';
            
            $jSeq = $_POST['jSeq'];
            
            if(isset($_POST['jobEdit'])){
                
                $job_id = $_POST['job_id'];
                $name = $_POST['name'];
                $client_seq = $_POST['client_seq'];
                $kind = $_POST['kind'];
                $remarks = $_POST['remarks'];

                
                if(!empty($jSeq)){
                    $sql = "UPDATE `job` SET `name`=?,`client_seq`=?,`kind`=?,`remarks`=? WHERE `job_seq`=?";

                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array(
                        $name,
                        $client_seq,
                        $kind,
                        $remarks,
                        $jSeq));
                }else{
                    require_once './db/counting.php';
                    $no = getJobNo();
                    $job_id = sprintf('%04d', $no);

                    $sql = "INSERT INTO `job`(`job_id`, `name`, `client_seq`, `kind`, `remarks`) VALUES(?,?,?,?,?)";

                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array(
                        $job_id,
                        $name,
                        $client_seq,
                        $kind,
                        $remarks));
                }

                header("Location: ./jobList.php");

            }else if(isset($_POST['jobDel'])){
                
                $stmt = $pdo->prepare('SELECT * FROM schedule where job_seq = ?');
                $stmt->execute(array($jSeq));
                
                if($row = $stmt->fetch()){
                    $errorMessage = "この案件を使用するシフトが存在します。先にシフトを見直してください。";

                }else{
                        $sql = "DELETE FROM `job` WHERE `job_seq`=?";
                        $stmt2 = $pdo->prepare($sql);
                        $stmt2->execute(array($jSeq));
    
                    header("Location: ./jobList.php");
                } 

            }
            
            $stmt = $pdo->prepare('SELECT * FROM job where job_seq = ?');
            $stmt->execute(array($jSeq));
            
            if($row = $stmt->fetch()){
                $job_id = $row['job_id'];
                $name = $row['name'];
                $client_seq = $row['client_seq'];
                $kind = $row['kind'];
                $remarks = $row['remarks'];
            }

            
            // グループ
            $stmt = $pdo->prepare('SELECT * FROM `client` order by client_seq');
            $stmt->execute(array());
            $rows = $stmt->fetchAll();

            foreach ($rows as $row) {
                if($row['client_seq']==$client_seq){
                    $client .= "<option value='".$row['client_seq']."' selected>".$row['name']."</option>";
                }else{
                    $client .= "<option value='".$row['client_seq']."'>".$row['name']."</option>";
                }
            }
            
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
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/employeeEdit.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/employeeEdit.js"></script>
</head>

<body>

    <?php include('./menu.php'); ?>

    <div class="nav">
        <button type="button" onclick="location.href='jobList.php'" class="back">戻る</button>
        <font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
    </div><br>


    <form id="editUser" action="jobEdit.php" method="POST">

        <input type="hidden" name="jSeq" value="<?php echo $jSeq; ?>">

        <table class="edit">
            <caption>案件情報</caption>
            <tr>
                <th><span class="required">案件名<span class="f50P"> (30)</span></span></th>
                <td><input type="text" id="name" name="name" class="f130P wdtL" maxlength=30 style="ime-mode: active;" required placeholder=""
                        value="<?php echo $name; ?>">
                </td>
            </tr>
            <tr>
                <th><span class="required">クライアント名</span></th>
                <td>
                    <select id="client_seq" name="client_seq" class="f130P"  required>
                        <option value="">選択してください</option>
                        <?php echo $client; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>属性</th>
                <td>
                    <?php if(!isset($kind) || $kind=="1"){ ?>
                    <input type="radio" name="kind" value="1" required checked>派遣社員
                    <input type="radio" name="kind" value="2">CP
                    <?php }else{ ?>
                    <input type="radio" name="kind" value="1" required>派遣社員
                    <input type="radio" name="kind" value="2" checked>CP
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>備考</th>
                <td><textarea id="remarks" name="remarks"  class="f130P wdtL" rows=5><?php echo $remarks; ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;"><button type=submit name="jobEdit" class="cal2">登録</button>
                </td>
            </tr>
        </table>

    </form>

    <?php if(!empty($jSeq)){ ?>
    <form id="editUser" action="jobEdit.php" method="POST" onsubmit="return delcheck()">

        <input type="hidden" name="jSeq" value="<?php echo $jSeq; ?>">

        <table class="del">
            <tr>
                <td><button type=submit name="jobDel" class="del">この案件を削除する</button></td>
            </tr>
        </table>

    </form>
    <?php } ?>

</body>

</html>