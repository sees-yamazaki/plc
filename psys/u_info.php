<?php

require('session.php');
require('logging.php');
require('db/infos.php');

// セッション開始
session_start();
setMyName('psys_m');
setSsnCrntPage(__FILE__);

//遷移元の確認
// if(!checkPrev(__FILE__)){
//     setSsnMsg('Invalid transition');
//     header('Location: ./u_error.php');
// }

//メニュー内容
if (empty(getSsn('SEQ'))) {
    $menu_m_url="./asset/image/title_login.png";
    $menu_m_click="location.href='u_login.php'";
} else {
    $menu_m_url="./asset/image/title_mypage.png";
    $menu_m_click="location.href='u_home.php'";
}

// エラーメッセージの初期化
$errorMessage = '';

$menu = $_GET['menu'];
if (!isset($_GET['menu'])) {
    $menu = 1;
}
if ($menu==1) {
    $menutitle="よくあるご質問";
    $menuhtml ='./asset/html/faq.html';
} elseif ($menu==2) {
    $menutitle="お問い合わせ";
    $menuhtml ='./asset/html/contact.html';
} elseif ($menu==3) {
    $menutitle="利用規約";
    $menuhtml ='./asset/html/tos.html';
} elseif ($menu==4) {
    $menutitle="プライバシーポリシー";
    $menuhtml ='./asset/html/pp.html';
} elseif ($menu==0) {
    $menutitle="お知らせ";
    $menuhtml ='';

    $infos = getOpenInfos(date('Y-m-d', strtotime('today')));

    $html1 = '';
    foreach ($infos as $info) {
        if (strlen($info->inf_text1)>0) {
            $html1 .= "<h3>".nl2br($info->inf_text1)."</h3>";
        }
        if (strlen($info->inf_img)>0) {
            $html1 .= "<img class='img80' border=0 src='".getSsn('PATH_INFO')."/".$info->inf_seq."/".$info->inf_img."'>";
        }
        if (strlen($info->inf_text2)>0) {
            $html1 .= "<h3>".nl2br($info->inf_text2)."</h3>";
        }
        $html1 .= "<hr>";
    }
    if (empty($html1)) {
        $html1 = "現在、お知らせは登録されていません。";
    }else{
        $html1 = substr($html1, 0, -4);
    }
} else {
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
</head>

<body>
    <form action='u_member_edit.php' method='POST' name="frmBack">
    </form>


    <div id="menu">
        <?php include('./u_top_menu.php'); ?>
    </div>



    <div id="contents">
        <div class="waku w80p txt-left">
            <?php if ($menu==0) { ?>
                <?php echo $html1; ?>
            <?php }else{ ?>
                <?php include($menuhtml); ?>
            <?php } ?>
        </div>

    </div>

</body>

</html>