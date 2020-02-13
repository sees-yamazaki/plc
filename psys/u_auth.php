<?php

require('session.php');
require('logging.php');
require('db/premembers.php');
require('db/members.php');

// セッション開始
session_start();
setMyName('psys_m');
setSsnCrntPage(__FILE__);

setSsnIni(parse_ini_file('./common.ini', false));
setSsnTran(parse_ini_file('./transition.ini', false));

//遷移元の確認
// if(!checkPrev(__FILE__)){
//     setSsnMsg('Invalid transition');
//     header('Location: ./u_error.php');
// }

//メニュー内容
$menu_m_url="./asset/image/title_login.png";
$menu_m_click="location.href='u_login.php'";

// エラーメッセージの初期化
$errorMessage = '';

// 変数の初期化
$prm_acd = $_GET['code'];


$code = explode("z", $prm_acd);
$up_seq = $code[0];
$mail_md5 = $code[1];
$m_seq = $code[2];

require_once './db/members.php';
$member = getMember($m_seq);

$md5 = md5($member->m_mail.$member->m_pw);
if ($md5==$mail_md5) {
    require_once './db/systems.php';
    $system = new cls_systems();
    $system = getSystems();

    setSsnKV('PATH_PROMO', $system->path_root."/".$system->path_promo);
    setSsnKV('PATH_GAME', $system->path_root."/".$system->path_game);
    setSsnKV('PATH_INFO', $system->path_root."/".$system->path_info);
    setSsnKV('PATH_SCODE', $system->path_root."/".$system->path_scode);
    setSsnKV('SYSTEM_NAME', $system->system_name);
    setSsnKV('POINT_ENTRY', $system->point_entry);
    setSsnKV('POINT_GAME', $system->point_game);
    setSsnKV('SHIP_LIMIT', $system->ship_limit);
    setSsnKV('SEQ', $member->m_seq);
    setSsnKV('ID', $member->m_id);
    setSsnKV('NAME', $member->m_name);

    require_once './db/log.php';
    log_login($member->m_seq);

    header('Location: u_point_history2.php?spid='.$up_seq);

}else{
    $msg="ng";
}

//メニュー内容
$menu_m_url="./asset/image/title_login.png";
$menu_m_click="location.href='u_login.php'";


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

    <div id="premenu">
        <?php include('./u_top_menu.php'); ?>
    </div>

    <div id="precontents">
        <br><br>
        自動ログインできませんでした。<br><br>
        ログイン画面からログインして、メニューのポイント使用履歴から、発送先の変更を行なってください。<br>
        <br>
        <br>
    <input type="button" class="rButton w80p btn-red" onclick="location.href='u_login.php'" value="ログインする" />

    </div>

</body>

</html>