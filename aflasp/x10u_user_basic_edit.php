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


if (isset($_POST['doCheck'])) {
    $isErr ='';
    if (empty($_POST['mail']) || empty($_POST['mail_confirm'])) {
        $err_mail_div = ' is-error';
        $err_mail_msg = '<p class="form-row-error-text">メールアドレスとメールアドレス（再入力）を入力してください。</p>';
        $isErr ='e';
    } elseif ($_POST['mail'] <> $_POST['mail_confirm']) {
        $err_mail_div = ' is-error';
        $err_mail_msg = '<p class="form-row-error-text">メールアドレスが一致しません。</p>';
        $isErr ='e';
    } elseif (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\+\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['mail'])) {
        $err_mail_div = ' is-error';
        $err_mail_msg = '<p class="form-row-error-text">メールアドレスが正しい形式ではありません。</p>';
        $isErr ='e';
    } elseif (countNUserByMailOthers($_POST['mail'], $LOGIN_ID)>0) {
        $err_mail_div = ' is-error';
        $err_mail_msg = '<p class="form-row-error-text">このメールアドレスは使用されています。</p>';
        $isErr ='e';
    }
    
    if (empty($_POST['pass']) || empty($_POST['pass_confirm'])) {
        $err_pass_div = ' is-error';
        $err_pass_msg = '<p class="form-row-error-text">パスワードとパスワード（再入力）を入力してください。</p>';
        $isErr ='e';
    } elseif ($_POST['pass'] <> $_POST['pass_confirm']) {
        $err_pass_div = ' is-error';
        $err_pass_msg = '<p class="form-row-error-text">パスワードが一致しません。</p>';
        $isErr ='e';
    } elseif (mb_strlen($_POST['pass'])<8) {
        $err_pass_div = ' is-error';
        $err_pass_msg = '<p class="form-row-error-text">パスワードは８文字以上で入力してください。</p>';
        $isErr ='e';
    } elseif (!preg_match("/^[\w]+$/", $_POST['pass'])) {
        $err_pass_div = ' is-error';
        $err_pass_msg = '<p class="form-row-error-text">パスワードは半角英数字で入力してください。</p>';
        $isErr ='e';
    }
    
    if (empty($_POST['name'])) {
        $err_name_div = ' is-error';
        $err_name_msg = '<p class="form-row-error-text">お名前を入力してください。</p>';
        $isErr ='e';
    }
    
    if (empty($_POST['kana'])) {
        $err_kana_div = ' is-error';
        $err_kana_msg = '<p class="form-row-error-text">フリガナを入力してください。</p>';
        $isErr ='e';
    } elseif (!empty($_POST['kana']) && preg_match("/[^ァ-ヶー　 ]/u", $_POST['kana'])) {
        $err_kana_div = ' is-error';
        $err_kana_msg = '<p class="form-row-error-text">全角カナで入力してください。</p>';
        $isErr ='e';
    }

    $tel = str_replace('-', '', $_POST['tel']);
    if (empty($_POST['tel'])) {
        $err_tel_div = ' is-error';
        $err_tel_msg = '<p class="form-row-error-text">電話番号を入力してください。</p>';
        $isErr ='e';
    } elseif (!preg_match("/^(0{1}\d{9,10})$/", $tel)) {
        $err_tel_div = ' is-error';
        $err_tel_msg = '<p class="form-row-error-text">電話番号が正しい形式ではありません。</p>';
        $isErr ='e';
    }
    
    if (empty($_POST['birthday-y']) || empty($_POST['birthday-m']) || empty($_POST['birthday-d'])) {
        $err_birthday_div = ' is-error';
        $err_birthday_msg = '<p class="form-row-error-text">生年月日を選択してください。</p>';
        $isErr ='e';
    }

    if (empty($isErr)) {
        header('Location: x10u_user_basic_confirm.php', true, 307);
    }

    $nUser->mail = $_POST['mail'];
    $nUser->mail_confirm = $_POST['mail_confirm'];
    $nUser->pass = $_POST['pass'];
    $nUser->pass_confirm = $_POST['pass_confirm'];
    $nUser->name = $_POST['name'];
    $nUser->zip1 = $_POST['zip'];
    $nUser->add_sub = $_POST['addr'];
    $nUser->tel = $_POST['tel'];
    $pref_ = $_POST['pref'];
    $nUserX = new cls_nuser();
    $nUserX->kubun = $_POST['kubun'];
    $nUserX->kana = $_POST['kana'];
} elseif (isset($_POST['4back'])) {
    $nUser->mail = $_POST['mail'];
    $nUser->mail_confirm = $_POST['mail_confirm'];
    $nUser->pass = $_POST['pass'];
    $nUser->pass_confirm = $_POST['pass_confirm'];
    $nUser->name = $_POST['name'];
    $nUser->tel = $_POST['tel'];
    $nUser->zip1 = $_POST['zip'];
    $nUser->add_sub = $_POST['addr'];
    $pref_ = $_POST['pref'];
    $nUserX = new cls_nuser();
    $nUserX->kubun = $_POST['kubun'];
    $nUserX->kana = $_POST['kana'];
} else {
    $nUser = getNuser($LOGIN_ID);
    $nUserX = getNuserX10($LOGIN_ID);
    $nUser->pass = "nochange";
    $nUser->mail_confirm = $nUser->mail;
    $nUser->pass_confirm = $nUser->pass;
    $pref_ = getPrefectureById($nUser->adds);
}

$prefs = ['北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','新潟県','富山県','石川県','福井県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県'];
$prefHtml='';
foreach ($prefs as $pref) {
    $wk = $pref_==$pref ? ' selected' : '';
    $prefHtml.='<option value="'.$pref.'"'.$wk.'>'.$pref.'</option>';
}

$bithdayYHtml='';
for ($i = 1945; $i <= 2020; $i++) {
    $wk = $_POST['birthday-y']==$i ? ' selected' : '';
    $bithdayYHtml.='<option value="'.$i.'"'.$wk.'>'.$i.'</option>';
}
$bithdayMHtml='';
for ($i = 1; $i <= 12; $i++) {
    $wk = $_POST['birthday-m']==$i ? ' selected' : '';
    $bithdayMHtml.='<option value="'.$i.'"'.$wk.'>'.$i.'</option>';
}
$bithdayDHtml='';
for ($i = 1; $i <= 31; $i++) {
    $wk = $_POST['birthday-d']==$i ? ' selected' : '';
    $bithdayDHtml.='<option value="'.$i.'"'.$wk.'>'.$i.'</option>';
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>基本情報を編集する</title>
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
                <a href="#">基本情報を編集する</a>
            </p>
        </div>

        <div class="pageheader">
            <div class="pageheader__inner container">
                <h1 class="pageheader_title">基本情報を編集する</h1>
            </div>
        </div>

        <section class="sec-user section">
            <div class="sec__inner container">
                <form action="" method="post" class="form__basic_user">
                    <div class="form__user__basic form__content_block">
                        <h3 class="bar-title"><span class="bar-title-text">基本情報</span></h3>
                        <div class="form-row <?php echo $err_mail_div; ?>">
                            <p class="form-row-text"><span class="req">必須</span>メールアドレス</p>
                              <?php echo $err_mail_msg; ?>
                            <input type="text" name="mail" value="<?php echo $nUser->mail;?>" placeholder="メールアドレスを入力" required>
                            <p class="form-row-anno">※注意書きがここに入ります</p>
                        </div>
                        <div class="form-row <?php echo $err_mail_div; ?>">
                            <p class="form-row-text"><span class="req">必須</span>メールアドレス（再入力）</p>
                            <input type="text" name="mail_confirm" value="<?php echo $nUser->mail_confirm;?>"
                                placeholder="メールアドレスを入力" required>
                            <p class="form-row-anno">※注意書きがここに入ります</p>
                        </div>
                        <div class="form-row <?php echo $err_pass_div; ?>">
                            <p class="form-row-text"><span class="req">必須</span>パスワード</p>
                              <?php echo $err_pass_msg; ?>
                            <input type="password" name="pass" value="<?php echo $nUser->pass;?>"　placeholder="パスワードを入力">
                            <p class="form-row-anno">※注意書きがここに入ります</p>
                        </div>
                        <div class="form-row <?php echo $err_pass_div; ?>">
                            <p class="form-row-text"><span class="req">必須</span>パスワード（再入力）</p>
                            <input type="password" name="pass_confirm" value="<?php echo $nUser->pass_confirm;?>"
                                placeholder="パスワードを入力">
                            <p class="form-row-anno">※注意書きがここに入ります</p>
                        </div>
            <div class="form-row">
              <p class="form-row-text"><span class="req">必須</span>区分</p>
              <?php
                if ($nUserX->kubun=="1") {
                    $kbn1 = " checked";
                } else {
                    $kbn0 = " checked";
                }
                ?>
              <label class="label-radio"><input type="radio" class="radiocheck" name="kubun" value="0" <?php echo $kbn0;?>>個人または個人事業主</label>
              <label class="label-radio"><input type="radio" class="radiocheck" name="kubun" value="1" <?php echo $kbn1;?>>法人</label>
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
                        <div class="form-row <?php echo $err_name_div; ?>">
                            <p class="form-row-text"><span class="req">必須</span>お名前</p>
                              <?php echo $err_name_msg; ?>
                            <input type="text" name="name" value="<?php echo $nUser->name;?>" placeholder="お名前を入力" required>
                            <p class="form-row-anno">※注意書きがここに入ります</p>
                        </div>
                        <div class="form-row <?php echo $err_kana_div; ?>">
                            <p class="form-row-text"><span class="req">必須</span>フリガナ</p>
                              <?php echo $err_kana_msg; ?>
                            <input type="text" name="kana" value="<?php echo $nUserX->kana;?>" placeholder="フリガナを入力" required>
                            <p class="form-row-anno">※注意書きがここに入ります</p>
                        </div>

<div class="form-row">
  <p class="form-row-text"><span class="op">任意</span>住所</p>
  <input type="text" name="zip" value="<?php echo $nUser->zip1.$nUser->zip2;?>" placeholder="郵便番号を入力" class="w200"><span class="js-form__btn_addr from__btn_addr">住所検索</span>
  <p class="form-row-anno">※注意書きがここに入ります</p>
  <br>
  <select name="pref" class="w200">
    <option value="" selected>都道府県を選択</option>
    <?php echo $prefHtml; ?>
  </select>
  <br><br>
  <input name="addr" type="text" value="<?php echo $nUser->add_sub;?>" placeholder="住所を入力">
  <p class="form-row-anno">※注意書きがここに入ります</p>
</div>


            
<div class="form-row <?php echo $err_birthday_div; ?>">
              <p class="form-row-text"><span class="req">必須</span>生年月日</p>
              <?php echo $err_birthday_msg; ?>
              <select name="birthday-y" class="w200">
                <option value="" selected>年を選択</option>
                <?php echo $bithdayYHtml; ?>
              </select>
              <select name="birthday-m" class="w200">
                <option value="" selected>月を選択</option>
                <?php echo $bithdayMHtml; ?>
              </select>
              <select name="birthday-d" class="w200">
                <option value="" selected>日を選択</option>
                <?php echo $bithdayDHtml; ?>
              </select>
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>

                        <div class="form-row <?php echo $err_tel_div; ?>">
                            <p class="form-row-text"><span class="req">必須</span>電話番号</p>
                              <?php echo $err_tel_msg; ?>
                            <input type="tel" name="tel" value="<?php echo $nUser->tel;?>" placeholder="電話番号を入力" required>
                            <p class="form-row-anno">※注意書きがここに入ります</p>
                        </div>
                    </div>

                    <div class="form__submit">
                        <div class="btn bd_blu"><input type="button" value="ユーザー情報設定変更へ戻る"
                                onclick="location.href='x10u_user.php'"></div>
                        <div class="btn bg_blu"><input type="submit" value="入力内容を確認する"></div>
                        <input name="doCheck" type="hidden" value="0">
                    </div>

                </form>
            </div>
        </section>

    </main>

    <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>

</html>