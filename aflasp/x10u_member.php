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

// $LOGIN_ID = $_SESSION[ $SESSION_NAME ];
// if(empty($LOGIN_ID)){ header('Location: x10n_logoff.php'); }

//Timezone
date_default_timezone_set('Asia/Tokyo');

// エラーメッセージの初期化
$errorMessage = '';

$nUser = new cls_nuser();

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
    } elseif (countNUserByMail($_POST['mail'])>0) {
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

    if (empty($_POST['bank'])) {
        $err_bank_div = ' is-error';
        $err_bank_msg = '<p class="form-row-error-text">金融機関名を入力してください。</p>';
        $isErr ='e';
    }
    if (empty($_POST['branch'])) {
        $err_branch_div = ' is-error';
        $err_branch_msg = '<p class="form-row-error-text">支店名を入力してください。</p>';
        $isErr ='e';
    }
    if (empty($_POST['bank-type'])) {
        $err_bank_type_div = ' is-error';
        $err_bank_type_msg = '<p class="form-row-error-text">種別を選択してください。</p>';
        $isErr ='e';
    }

    if (empty($_POST['number'])) {
        $err_number_div = ' is-error';
        $err_number_msg = '<p class="form-row-error-text">口座番号を入力してください。</p>';
        $isErr ='e';
    } elseif (!empty($_POST['number']) && !preg_match("/^[0-9]+$/", $_POST['number'])) {
        $err_number_div = ' is-error';
        $err_number_msg = '<p class="form-row-error-text">半角数字で入力してください。</p>';
        $isErr ='e';
    }
    if (empty($_POST['bank_name'])) {
        $err_bank_name_div = ' is-error';
        $err_bank_name_msg = '<p class="form-row-error-text">口座名義（カナ）を入力してください。</p>';
        $isErr ='e';
    } elseif (!empty($_POST['bank_name']) && preg_match("/[^ァ-ヶー　 ]/u", $_POST['bank_name'])) {
        $err_bank_name_div = ' is-error';
        $err_bank_name_msg = '<p class="form-row-error-text">全角カナで入力してください。</p>';
        $isErr ='e';
    }
    if (empty($_POST['privacy-check'])) {
        $err_privacy_check_msg = '<p class="form-row-error-text">チェックしてください。</p>';
        $isErr ='e';
    }
    if (empty($isErr)) {
        header('Location: x10u_member_confirm.php', true, 307);
    }
} elseif (isset($_POST['back'])) {
    //
}

$prefs = ['北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','新潟県','富山県','石川県','福井県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県'];
$prefHtml='';
foreach ($prefs as $pref) {
    $wk = $_POST['pref']==$pref ? ' selected' : '';
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
<title>新規会員登録（会員情報入力）</title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
<link rel="stylesheet" href="./x10u/assets/css/member.css">
    <script src="https://zipaddr.github.io/bankauto0.js" charset="UTF-8"></script>
</head>

<body>

  <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

  <main class="main">

    <div class="mainheader">
      <p class="breadcrumbs">
        <a href="./x10u_index.php">トップ</a>
        <a href="#">新規会員登録（会員情報入力）</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">新規会員登録（会員情報入力）</h1>
      </div>
    </div>

    <div class="form__nav">
      <div class="form__nav_inner container">
        <div class="form__nav_list flex">
          <div class="form__nav_step is-current">
            <span class="num">1</span>
            <p>会員情報<br class="sp">入力</p>
          </div>
          <div class="form__nav_step">
            <span class="num">2</span>
            <p>内容確認</p>
          </div>
          <div class="form__nav_step">
            <span class="num">3</span>
            <p>完了</p>
          </div>
        </div>
        <p class="form__nav_text">必要事項をご入力いただき、「入力内容を確認する」ボタンを押して下さい。</p>
      </div>
    </div>

    <section class="sec-member section">
      <div class="sec__inner container">
        <form action="" method="post" class="form__member">
          <div class="form__member__basic form__content_block">
            <div class="form-row <?php echo $err_mail_div; ?>">
              <p class="form-row-text"><span class="req">必須</span>メールアドレス</p>
              <?php echo $err_mail_msg; ?>
              <input type="text" name="mail"
            value="<?php echo $_POST['mail'];?>"  placeholder="メールアドレスを入力">
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
            <div class="form-row <?php echo $err_mail_div; ?>">
              <p class="form-row-text"><span class="req">必須</span>メールアドレス（再入力）</p>
              <input type="text" name="mail_confirm"
            value="<?php echo $_POST['mail_confirm'];?>" placeholder="メールアドレスを入力">
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
            <div class="form-row <?php echo $err_pass_div; ?>">
              <p class="form-row-text"><span class="req">必須</span>パスワード（8文字以上の英数字）</p>
              <?php echo $err_pass_msg; ?>
              <input type="text" name="pass" placeholder="パスワードを入力" value="<?php echo $_POST['pass'];?>">
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
            <div class="form-row <?php echo $err_pass_div; ?>">
              <p class="form-row-text"><span class="req">必須</span>パスワード（再入力）</p>
              <input type="text" name="pass_confirm" placeholder="パスワードを入力" value="<?php echo $_POST['pass_confirm'];?>">
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
            <div class="form-row">
              <p class="form-row-text"><span class="req">必須</span>区分</p>
              <?php
                if ($_POST['kubun']=="1") {
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
              <input type="text" name="name"
            value="<?php echo $_POST['name'];?>"  placeholder="お名前を入力">
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
            <div class="form-row <?php echo $err_kana_div; ?>">
              <p class="form-row-text"><span class="req">必須</span>フリガナ</p>
              <?php echo $err_kana_msg; ?>
              <input type="text" name="kana"
            value="<?php echo $_POST['kana'];?>"  placeholder="フリガナを入力">
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>

            <div class="form-row">
              <p class="form-row-text"><span class="op">任意</span>住所</p>
              <input type="text" name="zip" value="<?php echo $_POST['zip'];?>" placeholder="郵便番号を入力" class="w200"><span class="js-form__btn_addr from__btn_addr">住所検索</span>
              <p class="form-row-anno">※注意書きがここに入ります</p>
              <br>
              <select name="pref" class="w200">
                <option value="" selected>都道府県を選択</option>
                <?php echo $prefHtml; ?>
              </select>
              <br><br>
              <input name="addr" type="text" value="<?php echo $_POST['addr'];?>" placeholder="住所を入力">
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>

            <div class="form-row <?php echo $err_tel_div; ?>">
              <p class="form-row-text"><span class="req">必須</span>電話番号</p>
              <?php echo $err_tel_msg; ?>
              <input type="tel" name="tel"
            value="<?php echo $_POST['tel'];?>" placeholder="電話番号を入力">
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


          </div>
          <div class="form__member__sns form__content_block">
            <h3 class="bar-title"><span class="bar-title-text">SNSアカウント設定</span></h3>
            <div class="form-row">
              <p class="form-row-text"><span class="op">任意</span>Instagramアカウント名</p>
              <div class="icon-sns-wrap">
                <span class="icon-sns icon-sns-insta"></span><input type="text" name="instagram"
            value="<?php echo $_POST['instagram'];?>" placeholder="アカウント名を入力" class="input-sns">
              </div>
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
            <div class="form-row">
              <p class="form-row-text"><span class="op">任意</span>Twitterアカウント名</p>
              <div class="icon-sns-wrap">
                <span class="icon-sns icon-sns-tw"></span><input type="text" name="twitter"
            value="<?php echo $_POST['twitter'];?>" placeholder="アカウント名を入力" class="input-sns">
              </div>
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
            <div class="form-row">
              <p class="form-row-text"><span class="op">任意</span>Facebookアカウント名</p>
              <div class="icon-sns-wrap">
                <span class="icon-sns icon-sns-fb"></span><input type="text" name="facebook"
            value="<?php echo $_POST['facebook'];?>" placeholder="アカウント名を入力" class="input-sns">
              </div>
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
            <div class="form-row">
              <p class="form-row-text"><span class="op">任意</span>Youtubeアカウント名</p>
              <div class="icon-sns-wrap">
                <span class="icon-sns icon-sns-yt"></span><input type="text" name="youtube"
            value="<?php echo $_POST['youtube'];?>" placeholder="アカウント名を入力" class="input-sns">
              </div>
              <p class="form-row-anno">※注意書きがここに入ります</p>
            </div>
          </div>

          <div class="form__member__bank form__content_block">
            <h3 class="bar-title"><span class="bar-title-text">報酬支払い口座設定</span></h3>
            <div class="form-row <?php echo $err_bank_div; ?>">
              <p class="form-row-text"><span class="req">必須</span>金融機関名</p>
              <?php echo $err_bank_msg; ?>
              <input type="text" id="bank_name" name="bank"
            value="<?php echo $_POST['bank'];?>" placeholder="金融機関名を入力">
            </div>
            <div class="form-row <?php echo $err_branch_div; ?>">
              <p class="form-row-text"><span class="req">必須</span>支店名</p>
              <?php echo $err_branch_msg; ?>
              <input type="text" id="branch_name" name="branch"
            value="<?php echo $_POST['branch'];?>" placeholder="支店名を入力">
            </div>
            <div class="form-row <?php echo $err_bank_type_div; ?>">
              <p class="form-row-text"><span class="req">必須</span>種別</p>
                <?php
                if ($_POST['bank-type']=="4") {
                    $bt4 = " checked";
                } elseif ($_POST['bank-type']=="2") {
                    $bt2 = " checked";
                } elseif ($_POST['bank-type']=="1") {
                    $bt1 = " checked";
                } else {
                }
                ?>
                <?php echo $err_bank_type_msg; ?>
              <label class="label-radio"><input type="radio" class="radiocheck" name="bank-type" value="1" <?php echo $bt1;?>>普通</label>
              <label class="label-radio"><input type="radio" class="radiocheck" name="bank-type" value="2" <?php echo $bt2;?>>当座</label>
              <label class="label-radio"><input type="radio" class="radiocheck" name="bank-type" value="4" <?php echo $bt4;?>>貯蓄</label>
            </div>
            <div class="form-row <?php echo $err_number_div; ?>">
              <p class="form-row-text"><span class="req">必須</span>口座番号</p>
              <?php echo $err_number_msg; ?>
              <input type="text" name="number"
            value="<?php echo $_POST['number'];?>" placeholder="お名前を入力">
            </div>
            <div class="form-row <?php echo $err_bank_name_div; ?>">
              <p class="form-row-text"><span class="req">必須</span>口座名義（カナ）</p>
              <?php echo $err_bank_name_msg; ?>
              <input type="text" name="bank_name"
            value="<?php echo $_POST['bank_name'];?>" placeholder="お名前を入力">
            </div>
          </div>

          <p class="form__privacy-check"><label><input type="checkbox" name="privacy-check" value="1"><a href="" class="text-link text-underline">個人情報の取り扱い</a>について同意</label></p><?php echo $err_privacy_check_msg; ?>

          <div class="form__submit">
            <div class="btn bg_blu"><input type="submit" value="入力内容を確認する"></div>
            <input name="doCheck" type="hidden" value="0">
            <input type="hidden" id="bank_code">
            <input type="hidden" id="branch_code">
          </div>

        </form>
      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
