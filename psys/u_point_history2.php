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

$spid = $_GET['spid'];


$ship = getVShip($spid);

$html = '';
foreach ((array)$usepoints as $usepoint) {
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
        $html .= '<tr><td class="hist_txt txt-left">未発送</td></tr>';
    } else {
        $html .= '<tr><td class="hist_txt txt-left">発送済み</td></tr>';
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
    <form action='u_point_history.php' method='POST' name="frmBack">
    </form>

    <div id="menu">
        <?php include('./u_top_menu.php'); ?>
    </div>


    <div id="contents">
        <div name="waku">

            <h3><br>発送先情報</h3>

            <table class="w100p">
                <tr>
                    <td class="hist_ttl txt-left">お名前</td>
                </tr>
                <tr>
                    <td class="hist_txt txt-left"><?php echo $ship->sp_name ?>
                    </td>
                </tr>
            </table>
            <table class="w100p">
                <tr>
                    <td class="hist_ttl txt-left">フリガナ</td>
                </tr>
                <tr>
                    <td class="hist_txt txt-left"><?php echo $ship->sp_kana ?>
                    </td>
                </tr>
            </table>
            <table class="w100p">
                <tr>
                    <td class="hist_ttl txt-left">郵便番号</td>
                </tr>
                <tr>
                    <td class="hist_txt txt-left"><?php echo $ship->sp_post ?>
                    </td>
                </tr>
            </table>
            <table class="w100p">
                <tr>
                    <td class="hist_ttl txt-left">住所</td>
                </tr>
                <tr>
                    <td class="hist_txt txt-left"><?php echo $ship->sp_address1 ?><br><?php echo $ship->sp_address2 ?>
                    </td>
                </tr>
            </table>
            <table class="w100p">
                <tr>
                    <td class="hist_ttl txt-left">電話</td>
                </tr>
                <tr>
                    <td class="hist_txt txt-left"><?php echo $ship->sp_tel ?>
                    </td>
                </tr>
            </table>
            <table class="w100p">
                <tr>
                    <td class="hist_ttl txt-left">備考</td>
                </tr>
                <tr>
                    <td class="hist_txt txt-left"><?php echo empty($ship->sp_text) ? "　" : $ship->sp_text ?>
                    </td>
                </tr>
            </table>

            <?php if ($ship->sp_flg=="0") { ?>
            <br>
            <form action="u_shipform.php" method="POST" name="frm">
                <input type="submit" class="rButton w80p btn-red" value="変更する">
                <input type="hidden" name="doChange">
                <input type="hidden" name="spSeq"
                    value="<?php echo $spid; ?>">
            </form>
            <?php } ?>

            <br>
            <input type="button" class="rButton w80p btn-red-rev" onclick="javascript:frmBack.submit()" value="戻る" />

        </div>
    </div>


</body>

</html>