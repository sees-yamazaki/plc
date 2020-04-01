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
if(empty($LOGIN_ID)){ header('Location: x10u_logoff.php'); }


$nUser = getNuser($LOGIN_ID);
$nUserX = getNuserX10($LOGIN_ID);


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ユーザー情報設定変更</title>
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
            </p>
        </div>

        <div class="pageheader">
            <div class="pageheader__inner container">
                <h1 class="pageheader_title">ユーザー情報設定変更</h1>
            </div>
        </div>

        <section class="sec-member section">
            <div class="sec__inner container">
                <div class="form__contents">

                    <div class="form__content_block">
                        <h3 class="bar-title"><span class="bar-title-text">基本情報</span></h3>
                        <div class="dl-style">
                            <dl>
                                <dt>メールアドレス</dt>
                                <dd><?php echo $nUser->mail; ?></dd>
                            </dl>
                            <dl>
                                <dt>パスワード</dt>
                                <dd>*********</dd>
                            </dl>
                            <dl>
                                <dt>お名前</dt>
                                <dd><?php echo $nUser->name; ?></dd>
                            </dl>
                            <dl>
                                <dt>電話番号</dt>
                                <dd><?php echo $nUser->tel; ?></dd>
                            </dl>
                        </div>
                        <div class="btn_wrap">
                            <div class="btn btn_edit"><a href="./x10u_user_basic_edit.php" class="bg_blu"><span
                                        class="icon_edit"></span>基本情報を編集する</a></div>
                        </div>
                    </div>


                    <div class="form__content_block">
                        <h3 class="bar-title"><span class="bar-title-text">SNSアカウント</span></h3>
                        <?php if(empty($nUserX->instagram) && empty($nUserX->twitter) && empty($nUserX->facebook) && empty($nUserX->youtube) ){ ?>
                            <div class="alert_box">
                            <h4 class="alert_box_title"><span class="icon_chuui_pnk"></span>まだSNSアカウントが未設定です。</h4>
                            <p class="alert_box_text">ＳＮＳアカウント設定を行うとより報酬の高いオファーを受けることが出来ます。<br><a
                                    href="./user_sns_edit.html" target="_blank"
                                    class="text-link text-underline">こちら</a>から設定して下さい。</p>
                            </div>
                        <?php } ?>    
                        <div class="dl-style">
                                            <?php if(!empty($nUserX->instagram)){  ?>
                            <dl>
                                <dt>Instagram</dt>
                                <dd>
                                    <div class="icon-sns-wrap">
                                        <span class="icon-sns icon-sns-insta"></span>
                                        <p class="input-sns">&nbsp;
                                            <a href="https://www.instagram.com/<?php echo $nUserX->instagram; ?>/?hl=ja"
                                                target="_blank" class="text-link text-underline">
                                                <?php echo $nUserX->instagram; ?>
                                                <span class="icon_gaibulink"></span></a>
                                        </p>
                                    </div>
                                </dd>
                            </dl>
                                            <?php }  ?>
                                            <?php if(!empty($nUserX->twitter)){  ?>
                            <dl>
                                <dt>Twitter</dt>
                                <dd>
                                    <div class="icon-sns-wrap">
                                        <span class="icon-sns icon-sns-tw"></span>
                                        <p class="input-sns">&nbsp;
                                            <a href="https://twitter.com/<?php echo $nUserX->twitter; ?>"
                                                target="_blank" class="text-link text-underline">
                                                <?php echo $nUserX->twitter; ?>
                                                <span class="icon_gaibulink"></span></a>
                                        </p>
                                    </div>
                                </dd>
                            </dl>
                                            <?php }  ?>
                                            <?php if(!empty($nUserX->facebook)){  ?>
                            <dl>
                                <dt>Facebook</dt>
                                <dd>
                                    <div class="icon-sns-wrap">
                                        <span class="icon-sns icon-sns-fb"></span>
                                        <p class="input-sns">&nbsp;
                                            <a href="https://www.facebook.com/<?php echo $nUserX->facebook; ?>"
                                                target="_blank" class="text-link text-underline">
                                                <?php echo $nUserX->facebook; ?>
                                                <span class="icon_gaibulink"></span></a>
                                        </p>
                                    </div>
                                </dd>
                            </dl>
                                            <?php }  ?>
                                            <?php if(!empty($nUserX->youtube)){  ?>
                            <dl>
                                <dt>Youtube</dt>
                                <dd>
                                    <div class="icon-sns-wrap">
                                        <span class="icon-sns icon-sns-yt"></span>
                                        <p class="input-sns">&nbsp;
                                            <a href="https://www.youtube.com/user/<?php echo $nUserX->youtube;  ?>"
                                                target="_blank" class="text-link text-underline">
                                                <?php echo $nUserX->youtube;  ?>
                                                <span class="icon_gaibulink"></span></a>
                                        </p>
                                    </div>
                                </dd>
                            </dl>
                                            <?php }  ?>
                        </div>
                        <div class="btn_wrap">
                            <div class="btn btn_edit"><a href="./x10u_user_sns_edit.php" class="bg_blu"><span
                                        class="icon_edit"></span>SNSアカウントを編集する</a></div>
                        </div>
                    </div>

                    <div class="form__content_block">
                        <h3 class="bar-title"><span class="bar-title-text">口座情報</span></h3>
                        <?php if(empty($nUser->bank) || empty($nUser->branch) || empty($nUser->bank_name) || empty($nUser->number) ){ ?>
                            <div class="alert_box">
                                <h4 class="alert_box_title"><span class="icon_chuui_pnk"></span>まだ口座情報が未設定です。</h4>
                                <p class="alert_box_text">口座情報の設定を行わないと報酬の支払いが行われません。<br><a href="./user_bank_edit.html"
                                        target="_blank" class="text-link text-underline">こちら</a>から設定して下さい。</p>
                            </div>
                        <?php } ?>
                        <div class="dl-style">
                                            <?php if(!empty($nUser->bank)){  ?>
                            <dl>
                                <dt>金融機関名</dt>
                                <dd><?php echo $nUser->bank; ?></dd>
                            </dl>
                                            <?php }  ?>
                                            <?php if(!empty($nUser->branch)){  ?>
                            <dl>
                                <dt>支店名</dt>
                                <dd><?php echo $nUser->branch; ?></dd>
                            </dl>
                                            <?php }  ?>
                                            <?php if(!empty($nUser->bank_name)){  ?>
                            <dl>
                                <dt>種別</dt>
                                <?php
                                if ($nUser->bank_type=="4") {
                                    $bankType = "貯蓄";
                                } elseif ($nUser->bank_type=="2") {
                                    $bankType = "当座";
                                } elseif ($nUser->bank_type=="1") {
                                    $bankType = "普通";
                                } else {
                                    $bankType = "";
                                }
                                ?>
                                <dd><?php echo $bankType; ?></dd>
                            </dl>
                                            <?php }  ?>
                                            <?php if(!empty($nUser->bank_name)){  ?>
                            <dl>
                                <dt>口座名義（カナ）</dt>
                                <dd><?php echo $nUser->bank_name; ?></dd>
                            </dl>
                                            <?php }  ?>
                                            <?php if(!empty($nUser->number)){  ?>
                            <dl>
                                <dt>口座番号</dt>
                                <dd><?php echo $nUser->number; ?></dd>
                            </dl>
                                            <?php }  ?>
                        </div>
                        <div class="btn_wrap">
                            <div class="btn btn_edit"><a href="./x10u_user_bank_edit.php" class="bg_blu"><span
                                        class="icon_edit"></span>口座情報を編集する</a></div>
                        </div>
                    </div>

                    <div class="btn"><a href="x10u_user_withdrawal_confirm.php" class="bg_gry_dark">退会</a></div>

                </div>
            </div>
        </section>

    </main>

    <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>

</html>