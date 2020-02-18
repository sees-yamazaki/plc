<?php
require('../x10c/db/x10.php');
require('../x10c/logging.php');
require('../x10c/helper.php');
require('../x10c/db/nuser.php');

session_start();

$errorMessage='';

$key = isset($_GET['key']) ? $_GET['key'] : $_POST['key'];


$nUser = $_SESSION[$key];


if (isset($_POST['doEdit'])) {
    if (countNUserByMail($nUser->mail)>0) {
        $errorMessage='このメールアドレスは使用されています。';
    }else{

        insertNuser($nUser);
        header('Location: ./done.php');

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
            <?php echo $nUser->adds;?><?php echo $nUser->add_sub;?><br>

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
                    <input type="submit" value="入力内容の確認" class="input_base">
                    <input type="hidden" name="doEdit" value="0">
                    <input type="hidden" name="key" value="<?php echo $key; ?>">
                </form>
                <form action="nUser_add.php" method="POST">
                    <input type="submit" value="戻る" class="input_base">
                    <input type="hidden" name="key" value="<?php echo $key; ?>">
                    <input type="hidden" name="back" value="0">
                </form>
            </div>

    </div>

</body>

</html>