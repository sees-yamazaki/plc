<?php

require('session.php');
require('logging.php');

// セッションのクリア
session_start();
setMyName('psys_m');
$sysname = getSsnMyname();
unsetSsn();

// セッション再開
session_start();
setMyName('psys_m');
setSsnCrntPage(basename(__FILE__));

setSsnIni(parse_ini_file('./common.ini', false));
setSsnTran(parse_ini_file('./transition.ini', false));
setSsnCrntPage(basename(__FILE__));

//メニュー内容
$menu_m_url="./asset/image/title_login.png";
$menu_m_click="location.href='u_login.php'";

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

    <div id="premenu">
        <?php include('./u_top_menu.php'); ?>
    </div>

    <div id="precontents">
        <h3>ログイン</h3>
        <?php if (!empty($errorMessage)) { ?>
        <span class="err"><?php echo $errorMessage; ?></span>
        <?php } ?>
        <div name="editFrm">
            <form action="" method="POST" name="frm">
                <input type="text" name="m_mail" id="m_mail" class="input-text w80p" placeholder="メールアドレス"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?php echo $m_mail; ?>" required /><br><br>
                <input type="password" name="m_pw" id="m_pw" class="input-text w80p" placeholder="パスワード"
                    required><br><br>
                <input type="button" class="rButton w80p btn-blue" onclick="javascript:frm.submit()" value="ログイン" />
                <input type="hidden" name="login" id="login" value="1" />
            </form>
        </div>
        <div class="forgotpw">
        <a href='u_forgetpw.php'>パスワードをお忘れですか？</a>
        </div>

    </div>

</body>

</html>