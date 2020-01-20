<?php

require('session.php');
require('logging.php');

// セッション開始
session_start();
setMyName('psys_m');
setSsnCrntPage(basename(__FILE__));

// エラーメッセージの初期化
$errorMessage = '';

// ログインボタンが押された場合
if (isset($_POST['login'])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST['m_mail'])) {  // emptyは値が空のとき
        $errorMessage = 'メールアドレスが未入力です。';
    } elseif (empty($_POST['m_pw'])) {
        $errorMessage = 'パスワードが未入力です。';
    } else {
        // 入力したユーザIDを格納
        $m_mail = $_POST['m_mail'];
        $m_pw = $_POST['m_pw'];


        require_once './db/members.php';
        $member = new cls_members();
        $member = loginMember($m_mail, $m_pw);

        if ($member->m_seq == 0) {
            $errorMessage = 'ログインできませんでした。';
        } else {
            require_once './db/systems.php';
            $system = new cls_systems();
            $system = getSystems();

            setSsnKV('URL_PARENT', $system->url_parent);
            setSsnKV('URL_CHILD', $system->url_child);
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

            header('Location: ./u_home.php');
        }
    }
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
<div id="menu">
    <div id="top_menu_info">
        <div class="top_menu_contents">
            <img src="./asset/image/u_menu_logo.png" alt="logo" onclick="location.href='u_login.php'" />
        </div>
        <div class="top_menu_contents">
            <img src="./asset/image/u_menu_exit.png" alt="logo" onclick="location.href='u_login.php'" />
        </div>
    </div>
</div>


    <div id="contents">
        <div class="infoMenu">お知らせ</div>
        <div class="infoText">現在発送できない商品がございます。</div>

        <div class="infoMenu">利用規約</div>
        <div class="infoText">利用規約。利用規約。利用規約。利用規約。利用規約。利用規約。利用規約。利用規約。利用規約。</div>

        <div class="infoMenuJump" onclick="location.href='u_membership.php'">新規登録</div>
        <div class="infoMenuJump" onclick="location.href='u_login.php'">ログイン</div>

    </div>

</body>

</html>