<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';
include 'x10c/db/nuser.php';
include 'x10c/db/system.php';

// セッション再開
session_start();

//Timezone
date_default_timezone_set('Asia/Tokyo');

// エラーメッセージの初期化
$errorMessage = '';

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
if (empty($LOGIN_ID)) {
    header('Location: x10u_logoff.php');
}

$nUser = getNuser($LOGIN_ID);

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-167856896-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167856896-1');
</script>
    <meta charset="UTF-8">
    <title>口座情報を編集する【完了】</title>
    <meta name="description" content="アフィリエイト管理画面">
    <?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
</head>

<body>

    <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

    <main class="main">

        <div class="mainheader">
            <p class="breadcrumbs">
                <a href="#">トップ</a>
                <a href="#">ユーザー情報設定変更</a>
                <a href="#">口座情報を編集する【完了】</a>
            </p>
        </div>

        <div class="pageheader">
            <div class="pageheader__inner container">
                <h1 class="pageheader_title">口座情報を編集する【完了】</h1>
            </div>
        </div>

        <section class="sec-user section">
            <div class="sec__inner container">
                <form action="./user_bank_complete.html" method="post" class="form__bank_user">
                    <div class="form__bank__basic form__content_block">

                        <div class="alert_box_complete">
                            <h4 class="alert_box_complete_title"><span class="icon_check_grn"></span>変更が完了しました。</h4>
                            <p class="alert_box_text">下記より編集項目が変更されている事をご確認ください。</p>
                        </div>

                        <h3 class="bar-title"><span class="bar-title-text">報酬支払い口座設定</span></h3>

                        <div class="dl-style">
                            <dl>
                                <dt>金融機関名</dt>
                                <dd><?php echo $nUser->bank; ?></dd>
                            </dl>
                            <dl>
                                <dt>支店名</dt>
                                <dd><?php echo $nUser->branch; ?></dd>
                            </dl>
                            <dl>
                                <dt>種別</dt>
                                <?php
                                if ($nUser->bank_type=="4") {
                                    $bankType = "貯蓄";
                                } elseif ($nUser->bank_type=="2") {
                                    $bankType = "当座";
                                } else {
                                    $bankType = "普通";
                                }
                                ?>
                                <dd><?php echo $bankType; ?></dd>
                            </dl>
                            <dl>
                                <dt>口座名義（カナ）</dt>
                                <dd><?php echo $nUser->bank_name; ?></dd>
                            </dl>
                            <dl>
                                <dt>口座番号</dt>
                                <dd><?php echo $nUser->number; ?></dd>
                            </dl>
                        </div>
                    </div>

                    <div class="form__submit">
                        <div class="btn"><a href="./x10u_user.php" class="bg_blu">ユーザー情報設定トップへ</a></div>
                    </div>

                </form>
            </div>
        </section>

    </main>

    <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>

</html>