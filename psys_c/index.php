<?php

// セッション開始
session_start();
require('session.php');
require('../psys/logging.php');

$ini = parse_ini_file('./common.ini', false);
setSsnIni($ini);

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


        require_once '../psys/db/members.php';
        $member = new cls_members();
        $member = loginMember($m_mail, $m_pw);

        if ($member->m_seq == 0) {
            $errorMessage = 'ログインできませんでした。';
        } else {
            require_once '../psys/db/systems.php';
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

            require_once '../psys/db/log.php';
            log_login($member->m_seq);

            header('Location: ./home.php');
        }
    }
}

?>
<!DOCTYPE HTML>
<html lang="ja">

<head>
    <title><?php echo getSsnMyname(); ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="asset/css/main.css" />
</head>

<body>

    <!-- Header -->
    <header id="header">
        <a href="javascript:void(0)" class="logo"><strong><?php echo getSsnMyname(); ?></strong> by itty</a>
    </header>

    <!-- Banner -->
    <?php if (!empty($errorMessage)) { ?>
    <section id="banner8" class="err">
            <h3><?php echo $errorMessage; ?></h3>
    </section>
    <?php } ?>

    <section id="banner">
        <div class="inner">
            <form action="" method="POST" name="frm">
                <h1>ログインフォーム</h1>
                <div class="">
                    <input type="text" name="m_mail" id="m_mail" value="" placeholder="メールアドレス" />
                    <input type="password" name="m_pw" id="m_pw" value="" placeholder="パスワード" />
                </div><br>
                <ul class="actions">
                    <li><a href="javascript:frm.submit()" class="button alt scrolly big">ログイン</a></li>
                </ul>
                <input type="hidden" name="login" id="login" value="1" />
            </form>
        </div>
    </section>

    <section id="banner2">
        <div class="inner">
            <h1><a href="membership.php">新規登録はこちら</a></h1>
        </div>
    </section>


    <?php include './footer.php'; ?>

</body>

</html>