<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';
include 'x10c/db/nuser.php';
include 'x10c/db/system.php';

session_start();

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
if(empty($LOGIN_ID)){ header('Location: x10n_logoff.php'); }

$errorMessage='';

$nUser = new cls_nuser();

    $nUser->mail = $_POST['mail'];
    $nUser->mail_confirm = $_POST['mail_confirm'];
    $nUser->pass = $_POST['pass'];
    $nUser->pass_confirm = $_POST['pass_confirm'];
    $nUser->name = $_POST['name'];
    $nUser->zip1 = $_POST['zip1'];
    $nUser->zip2 = $_POST['zip2'];
    $nUser->adds = $_POST['adds'];
    $nUser->add_sub = $_POST['add_sub'];
    $nUser->tel = $_POST['tel'];
    $nUser->fax = $_POST['fax'];
    $nUser->url = $_POST['url'];
    $nUser->bank = $_POST['bank'];
    $nUser->bank_code = $_POST['bank_code'];
    $nUser->branch = $_POST['branch'];
    $nUser->branch_code = $_POST['branch_code'];
    $nUser->bank_type = $_POST['bank_type'];
    $nUser->number = $_POST['number'];
    $nUser->bank_name = $_POST['bank_name'];

if (isset($_POST['doCheck'])) {



}elseif (isset($_POST['doEdit'])) {
    if (countNUserByMail($nUser->mail)>0) {
        $errorMessage='このメールアドレスは使用されています。';
    }else{

        $pw1 = preg_replace('/^\w+:/', '', $nUser->pass);
        $pw2 = openssl_encrypt($pw1, 'aes-256-ecb', base64_encode('AES'));
        $nUser->pass = $pw2;

        $nId = insertNuser($nUser);


    $sys = getSystem();

    mb_language("Japanese");
    mb_internal_encoding("UTF-8");

    $text = "\n\nメールアドレスを認証するために、下記URLをクリックしてください。\n\n";
    if (substr($sys->home, -1)=='/') {
        $sys->home = substr($sys->home, 0, -1);
    }
    $md5 = md5( $nId . $nUser->mail );
    $text .= $sys->home."/activate.php?type=nUser&id=".$nId."&md5=".$md5;
    $text .= "\n\n".$sys->site_title."\n\n".$sys->home;

    $to      = $nUser->mail;
    $subject = "【".$sys->site_title."】メールアドレスの認証が完了しました。";
    $message = $text;
    $headers = 'From:"'.mb_encode_mimeheader($sys->mail_name).'" <'. trim($sys->mail_address).'>';
    logging($text);
    mb_send_mail($to, $subject, $message, $headers);








        header('Location: x10n_nuser_edited.php');

    }
}elseif (isset($_POST['doBack'])) {
    header('Location: x10n_nuser_edit.php', true, 307);
}

$prefs = getPrefectures();
$prefName = "";
foreach($prefs as $pref){
    if($nUser->adds==$pref->id){
        $prefName = $pref->name;
    }
}





?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo ""; ?></title>
</head>

<body>


    <div id="inc_side_body">


        <?php if (!empty($errorMessage)) { ?>
        <span class="err"><?php echo $errorMessage; ?></span>
        <?php } ?>

        メールアドレス<br>
        <?php echo $nUser->mail;?><br>

        お名前<br>
        <?php echo $nUser->name;?><br>

        現住所<br>
        <?php echo $nUser->zip1;?>-<?php echo $nUser->zip2;?><br>
        <?php echo $prefName;?><?php echo $nUser->add_sub;?><br>

        電話番号<br>
        <?php echo $nUser->tel;?><br>

        FAX番号<br>
        <?php echo $nUser->tel;?><br>

        バナー掲載ＵＲＬ<br>
        <?php echo $nUser->url;?><br>

        金融機関名<br>
        <?php echo $nUser->bank;?><br>

        金融機関番号<br>
        <?php echo $nUser->bank_code;?><br>

        支店名<br>
        <?php echo $nUser->branch;?><br>

        支店番号<br>
        <?php echo $nUser->branch_code;?><br>

        種別<br>
        <?php echo $nUser->bank_type;?><br>

        口座番号<br>
        <?php echo $nUser->number;?><br>

        口座名義(カナ)<br>
        <?php echo $nUser->bank_name;?><br>




        <div class="input_box">

            <form action="" method="POST">
                <input type="submit" name="doEdit" value="登録する" class="input_base">
                <input type="submit" name="doBack" value="戻る" class="input_base">
                <input type="hidden" name="mail" value="<?php echo $nUser->mail; ?>">
                <input type="hidden" name="mail_confirm" value="<?php echo $nUser->mail_confirm; ?>">
                <input type="hidden" name="pass" value="<?php echo $nUser->pass; ?>">
                <input type="hidden" name="pass_confirm" value="<?php echo $nUser->pass_confirm; ?>">
                <input type="hidden" name="name" value="<?php echo $nUser->name; ?>">
                <input type="hidden" name="zip1" value="<?php echo $nUser->zip1; ?>">
                <input type="hidden" name="zip2" value="<?php echo $nUser->zip2; ?>">
                <input type="hidden" name="adds" value="<?php echo $nUser->adds; ?>">
                <input type="hidden" name="add_sub" value="<?php echo $nUser->add_sub; ?>">
                <input type="hidden" name="tel" value="<?php echo $nUser->tel; ?>">
                <input type="hidden" name="fax" value="<?php echo $nUser->fax; ?>">
                <input type="hidden" name="url" value="<?php echo $nUser->url; ?>">
                <input type="hidden" name="bank" value="<?php echo $nUser->bank; ?>">
                <input type="hidden" name="bank_code" value="<?php echo $nUser->bank_code; ?>">
                <input type="hidden" name="branch" value="<?php echo $nUser->branch; ?>">
                <input type="hidden" name="branch_code" value="<?php echo $nUser->branch_code; ?>">
                <input type="hidden" name="bank_type" value="<?php echo $nUser->bank_type; ?>">
                <input type="hidden" name="number" value="<?php echo $nUser->number; ?>">
                <input type="hidden" name="bank_name" value="<?php echo $nUser->bank_name; ?>">
            </form>
        </div>

    </div>

</body>

</html>