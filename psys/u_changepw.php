<?php

require('session.php');
require('logging.php');
require('db/members.php');
require('db/mails.php');

// セッション開始
session_start();
setMyName('psys_m');
setSsnCrntPage(__FILE__);

//遷移元の確認
// if(!checkPrev(__FILE__)){
//     setSsnMsg('Invalid transition');
//     header('Location: ./u_error.php');
// }

//メニュー内容
$menu_m_url="./asset/image/title_mypage.png";
$menu_m_click="location.href='u_home.php'";

require_once './db/views.php';
$point = getPoint(getSsn("SEQ"));

// エラーメッセージの初期化
$errorMessage = '';

if (isset($_POST['doEdit'])) {

    $member = getMember(getSsn('SEQ'));

    if($member->m_pw<>$_POST['old_pw']){
        $errorMessage .= '現在のパスワードが異なります。<br>';
    }
    
    if ($_POST['new_pw1']<>$_POST['new_pw2']) {
        //if(!empty($errorMessage)){$errorMessage .= '<br>';}
        $errorMessage .= '新しいパスワードが一致しません。<br>';
    }else{
        if(preg_match('/\A(?=.*?[a-zA-Z])(?=.*?\d)[a-zA-Z\d]{8,12}+\z/i', $_POST['new_pw1'])==0){
            $errorMessage .= '新しいパスワードは<br>半角英数混合8～12文字で入力してください。<br>';
        }
    }
    
    if(empty($errorMessage)){

        updatePw($member->m_seq,$_POST['new_pw1']);

        $mails = getMails();
        $dt = date('Y年m月d日　H時i分s秒',strtotime("now") );
        $text = str_replace('__TIME__', $dt , $mails->change_pw_text);

        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        $to      = $member->m_mail;
        $subject = $mails->change_pw_title;
        $message = $text;
//        $message .= "\n\n\n\nログイン後にパスワードの再設定を行ってください。";
        $headers = "From: noreply";
        
        mb_send_mail($to, $subject, $message, $headers);

        
        header('Location: u_changedpw.php');
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
        <?php include('./u_top_menu.php'); ?>
    </div>


    <div id="contents">
        <h3><br>パスワード変更</h3>
        <?php if (!empty($errorMessage)) { ?>
        <span class="err"><?php echo $errorMessage; ?></span>
        <?php } ?>
        <div name="editFrm" class="editFrm">
            <form action="" method="POST" name="frm">

                現在のパスワード<br>
                <input type="password" name="old_pw" class="input-text w90p"
                    value=""
                    placeholder="現在のパスワード" maxlength='20' required /><br><br>
                新しいパスワード<br>
                <input type="password" name="new_pw1"  class="input-text w90p"
                    value=""
                    placeholder="新しいパスワード" minlength=8 maxlength='12' required /><br>
                    <input type="password" name="new_pw2" class="input-text w90p"
                    value=""
                    placeholder="確認のため再度入力してください" minlength=8 maxlength='12' required /><br><br>


                <input type="submit" class="rButton w90p btn-red" value="登録する">
                <input type="hidden" name="doEdit">

            </form>
        </div>

    </div>

    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</body>

</html>