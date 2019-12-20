<?php

// セッション開始
session_start();

$ini = parse_ini_file('./common.ini', false);
$_SESSION["INI"] = $ini;

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {

    // 1. ユーザIDの入力チェック
    if (empty($_POST["m_mail"])) {  // emptyは値が空のとき
        $errorMessage = 'メールアドレスが未入力です。';
    } elseif (empty($_POST["m_pw"])) {
        $errorMessage = 'パスワードが未入力です。';
    } else {
        // 入力したユーザIDを格納
        $m_mail = $_POST["m_mail"];
        $m_pw = $_POST["m_pw"];


        try {
            require_once './db/members.php';
            $member = new cls_members();
            $member = loginMember($m_mail, $m_pw);

            if ($member->m_seq==0) {
                $errorMessage = 'ログインできませんでした。';
            } else {
				$sn = $ini['sysname'];
                $_SESSION[$sn."SEQ"] = $member->m_seq;
                $_SESSION[$sn."ID"] = $member->m_id;
                $_SESSION[$sn."NAME"] = $member->m_name;

                header("Location: ./home.php");
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            echo $e->getMessage();
        }
    }
}

?>
<!DOCTYPE HTML>
<html lang="ja">

<head>
    <title><?php echo $ini['sysname']; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="asset/css/main.css" />
</head>

<body>

    <!-- Header -->
    <header id="header">
        <a href="javascript:void(0)" class="logo"><strong>PointSystem</strong> by SEES</a>
    </header>

    <!-- Banner -->
    <?php if(!empty($errorMessage)){ ?>
    <section id="banner2">
        <div class="inner">
            <h3><?php echo $errorMessage; ?></h3>
        </div>
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


    <!-- Footer -->
    <footer id="footer">
        <div class="copyright">
            &copy; SEES
        </div>
    </footer>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>