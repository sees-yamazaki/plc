<?php
require('session.php');
require('helper.php');
require('logging.php');
require('db/members.php');

// セッション開始
session_start();



// エラーメッセージの初期化
$errorMessage = "";

$grp = isset($_GET['grp']) ? $_GET['grp'] : $_POST['grp'];

$grps = array('ENG1G','ENG2G','ITS1G','ITS2G','ITS3G','ITS4G','ITS5G','ITS6G','ITS7G','ITS8G','ITS9G','ITS10G');
$youbi = array('(日)','(月)','(火)','(水)','(木)','(金)','(土)');

$members = getAppMembers();

$html="";
$date="";
$time="";
$grpHtml = array('ENG1G'=>'','ENG2G'=>'','ITS1G'=>'','ITS2G'=>'','ITS3G'=>'','ITS4G'=>'','ITS5G'=>'','ITS6G'=>'','ITS7G'=>'','ITS8G'=>'','ITS9G'=>'','ITS10G'=>'');

foreach ($members as $member) {
    if (!empty($date) && $date<>$member->m_date) {
        foreach ($grps as $grp) {
            $html .=  "<td>".$grpHtml[$grp]."</a></td>";
            $grpHtml[$grp]='';
        }
        $html .= '</tr>';
    }

    if (empty($date) || $date<>$member->m_date) {
        $date = $member->m_date;
        $w = $youbi[date('w', strtotime($date))];
        $html .= '<tr>';
        $html .= "<td>".$date." ".$w."</td>";
    }

    // $tmp = ($member->m_flg1==0) ? '*' : '';
    // $grpHtml[$member->m_group].= '<a href="Javascript:scDL('.$member->m_seq.')" class="app">'.$tmp." ".substr($member->m_time, 0, 5)." ".$member->m_name."</a><br>";

    if ($member->m_flg1=="0") {
        $grpHtml[$member->m_group].= '<a href="Javascript:scDL('.$member->m_seq.')" class="app2">* '.substr($member->m_time, 0, 5)." ".$member->m_name."</a><br>";
    } elseif ($member->m_flg1=="9") {
        //
    } else {
        $grpHtml[$member->m_group].= '<a href="Javascript:scDL('.$member->m_seq.')" class="app">'.substr($member->m_time, 0, 5)." ".$member->m_name."</a><br>";
    }
}
$ttlHtml='';
foreach ($grps as $grp) {
    $html .=  "<td>".$grpHtml[$grp]."</td>";
    $grpHtml[$grp]='';
    $ttlHtml.='<th>'.$grp.'</th>';
}
$html .= '</tr>';



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
    </form>

    <?php include('./menu.php'); ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">
                <span class="clrRed" id="errSpan"><?php echo $errorMessage; ?></span>
                *は仮予約です。
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th></th>
                            <?php echo $ttlHtml; ?>
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