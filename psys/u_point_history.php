<?php

require('session.php');
require('logging.php');
require('db/members.php');
require('db/mails.php');
require('db/views.php');

// セッション開始
session_start();
setMyName('psys_m');
//セッションの確認
if (!getSsnIsLogin()) {
    setSsnMsg('Invalid transition');
    header('Location: ./u_error.php');
}
setSsnCrntPage(__FILE__);

//遷移元の確認
// if(!checkPrev(__FILE__)){
//     setSsnMsg('Invalid transition');
//     header('Location: ./u_error.php');
// }

//メニュー内容
$menu_m_url="./asset/image/title_mypage.png";
$menu_m_click="location.href='u_home.php'";

require_once './db/views.php';
$point = getPoint(getSsn("SEQ"));

// エラーメッセージの初期化
$errorMessage = '';


$usepoints = getVUsepointsAndShips(getSsn('SEQ'));

$html = '';
foreach ($usepoints as $usepoint) {
    $html .= '<table class="w100p">';
    $html .= '<tr><td class="hist_ttl txt-left">ポイント交換日</td></tr>';
    $html .= '<tr><td class="hist_txt txt-left">'.$usepoint->createdt.'</td></tr>';
    $html .= '</table>';
    $html .= '<table class="w100p">';
    $html .= '<tr><td class="hist_ttl txt-left">使用ポイント</td></tr>';
    $html .= '<tr><td class="hist_txt txt-left">'.$usepoint->up_point.'pt</td></tr>';
    $html .= '</table>';
    $html .= '<table class="w100p">';
    $html .= '<tr><td class="hist_ttl txt-left">ポイント交換商品</td></tr>';
    $html .= '<tr><td class="hist_txt txt-left">'.$usepoint->pz_title.'</td></tr>';
    $html .= '</table>';
    $html .= '<table class="w100p">';
    $html .= '<tr><td class="hist_ttl txt-left">発送状況</td></tr>';
    if ($usepoint->sp_flg=="0") {
        $html .= '<tr><td class="hist_txt txt-left"><a href="u_point_history2.php?spid='.$usepoint->sp_seq.'">未発送</td></tr>';
    } else {
        $html .= '<tr><td class="hist_txt txt-left"><a href="u_point_history2.php?spid='.$usepoint->sp_seq.'">発送済み</td></tr>';
    }
    $html .= '</table>';
    $html .= '<hr>';
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo getSsnMyname(); ?>
    </title>
    <link rel="stylesheet" href="./asset/css/u_main.css">
    <style>
        .hist_ttl {
            background-color: #aaa;
            color: white;
            font-size: 1rem;

        }

        .hist_txt {
            background-color: #fff;
            font-size: 1rem;
        }
    </style>
</head>

<body>

    <div id="menu">
        <?php include('./u_top_menu.php'); ?>
    </div>


    <div id="contents">
        <h3><br>ポイント交換履歴</h3>
        <?php if (!empty($errorMessage)) { ?>
        <span class="err"><?php echo $errorMessage; ?></span>
        <?php } ?>

        <?php if (empty($html)) { ?>
        ポイント交換履歴はありません。
        <?php } else { ?>
        <div class="w80p waku">
            <?php echo $html; ?>
        </div>
        <?php } ?>

    </div>

    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</body>

</html>