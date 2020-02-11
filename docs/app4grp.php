<?php
require('session.php');
require('helper.php');
require('logging.php');
require('db/members.php');

// セッション開始
session_start();


// ログイン状態チェック
// if (getSsnIsLogin()==false) {
//     header("Location: a_logoff.php");
//     exit;
// }

// エラーメッセージの初期化
$errorMessage = "";

$grp = isset($_GET['grp']) ? $_GET['grp'] : $_POST['grp'];
//$grp = $_GET['grp'];


 try {
     //  if ($stts=="dl") {
     //      $readbook = getBook($bSeq);

     //      // if($readbook->bks_pw==$bPw){
     //      $fileNm = "./files/".$readbook->bks_seq."_".$readbook->bks_file;
     //      header('Content-Type: application/octet-stream');
     //      header('Content-Length: '.filesize($fileNm));
     //      header('Content-Disposition: attachment; filename='.$readbook->bks_file);
     //      readfile($fileNm);
     //      // }else{
     //     //     $errorMessage = "<h3>ダウンロードパスワードが一致しません。</h3>";
     //     // }
     //  }



     $members = getGroupMembers($grp);

     $html="";
     foreach ($members as $member) {
         $html .= '<tr>';
         $html .= "<td>";
         $html .= "&nbsp;<button type='button' name='edit' class='btn btn-inverse-secondary' onclick='scDL(".$member->m_seq.")'>EDIT</button>";
         $html .= "</td>";
         $html .= "<td>".$member->m_group."</td>";
         $html .= "<td>".$member->m_position."</td>";
         $html .= "<td>".$member->m_name."</td>";
         $html .= "<td>".$member->m_date." ".substr($member->m_time, 0, 5)."</td>";
         if (!empty($member->m_date) && $member->m_flg1==0) {
             $html .= "<td>仮</td>";
         } else {
             $html .= "<td></td>";
         }
         //$html .= "<td><input type='text' class='form-control w50p' id='pw".$book->bks_seq."' autocomplete='off'></td>";
         $html .= "</tr>";
     }
 } catch (PDOException $e) {
     $errorMessage = 'データベースエラー:'.$e->getMessage();
 }


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo getSsnMyname(); ?>
    </title>
    <link rel="stylesheet" href="./assets/vendors/iconfonts/mdi/css/materialdesignicons.css">
    <link rel="stylesheet" href="./assets/css/shared/style.css">
    <link rel="stylesheet" href="./assets/css/demo_1/style.css">
    <link rel="shortcut icon" href="../asssets/images/favicon.ico" />
    <link rel="stylesheet" href="./asset/css/main.css">
    <script>
        function scDL(vlu) {
            document.frm2.mSeq.value = vlu;
            //document.frm2.bPw.value = document.getElementById('pw'+vlu).value;
            document.frm2.submit();
        }
    </script>
</head>

<body class="header-fixed">
    <form action='doAppointment.php' method='POST' name="frm2">
        <input type='hidden' name='mSeq' value=''>
        <input type='hidden' name='grp' value='<?php echo $grp; ?>'>
    </form>

    <?php include('./menu.php'); ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">
                <span class="clrRed" id="errSpan"><?php echo $errorMessage; ?></span>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th></th>
                            <th>GROUP</th>
                            <th>POSITION</th>
                            <th>NAME</th>
                            <th>APPOINTMENT</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $html; ?>
                    </tbody>
                </table>
                <br>
            </div>
        </div>
    </div>


    </div>
    </div>
    <script src="./assets/vendors/js/core.js"></script>
    <script src="./assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="./assets/vendors/chartjs/Chart.min.js"></script>
    <script src="./assets/js/charts/chartjs.addon.js"></script>
    <script src="./assets/js/template.js"></script>
    <script src="./assets/js/dashboard.js"></script>
</body>

</html>