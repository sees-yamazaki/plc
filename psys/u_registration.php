<?php

require('session.php');
require('logging.php');
require('db/premembers.php');
require('db/members.php');
require('db/mails.php');

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
$prm_acd = $_GET['acd'];
if (empty($_GET['acd'])) {
    $prm_acd = $_POST['acd'];
}
if ((empty($_GET['acd']) && empty($_GET['doRegst']))
  || empty($prm_acd)) {
    setSsnMsg('Invalid transition');
    header('Location: ./u_error.php');
}

$acd = explode("x", $prm_acd);
$pm_seq = $acd[0];
$pm_id = substr($acd[1], 0, 10);
$limitdt = substr($acd[1], 10);

$tmp = new cls_premembers();
$tmp = getPreMember($pm_seq);
$cnt = $tmp->m_seq;
if ($cnt==0) {
    $errorMessage="すでに認証処理は実施済みです。" ;
} else {
    if ($limitdt < strtotime("now")) {
        $errorMessage="有効期限を過ぎています。" ;
    }
}



if (isset($_POST['doRegst'])) {
    $premember = new cls_premembers();
    $premember = getPreMember($pm_seq);

    $m_pw = $_POST['m_pw'];

    if ($m_pw==$premember->m_pw) {
        $cnt = checkMemberByMail(0, $premember->m_mail);
        if ($cnt==0) {
            registMember($pm_seq);

            //MAIL
            $mails = getMails();

            mb_language("Japanese");
            mb_internal_encoding("UTF-8");
            $text = str_replace('__NAME__', $premember->m_name, $mails->insert_member_text);

            $to      = $premember->m_mail;
            $subject = $mails->insert_member_title;
            $message = $text;
            $headers = "From: noreply";
    
            mb_send_mail($to, $subject, $message, $headers);



            header('Location: ./u_registrated.php');
        } else {
            $errorMessage="このメールアドレスはすでに登録されています。<br>".$premember->m_mail;
        }
    } else {
        $errorMessage="入力したパスワードが間違っています。";
    }
} else {
    //
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
        <h3><br>会員認証</h3>
        <span class="">登録時に設定したパスワードで<br>認証を行なってください。<br><br></span>
        <?php if (!empty($errorMessage)) { ?>
        <span class="err"><?php echo $errorMessage; ?><br><br></span>
        <?php } ?>
        <div name="editFrm" class="editFrm">
            <form action="" method="POST" name="frm">

                有効期限：<?php echo date('Y-m-d H:i:s', $limitdt) ?>まで<br><br>
                パスワード<br>
                <input type="password" name="m_pw" id="m_pw" class="input-text w90p" value="" maxlength='10'
                    required /><br><br>

                <?php if ($cnt!=0) { ?>
                <input type="submit" class="rButton w90p btn-red" value="認証する">
                <?php } ?>
                <input type="hidden" name="acd" value="<?php echo $prm_acd ?>">
                <input type="hidden" name="doRegst">

            </form>
        </div>

    </div>

    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</body>

</html>