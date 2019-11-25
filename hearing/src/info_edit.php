<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

$iSeq = $_POST['iSeq'];
 
require './db/infos.php';
$infos = new cls_infos();

try {
    $infos->title1 = $_POST['title1'];
    $infos->title2 = $_POST['title2'];
    $infos->d2 = $_POST['d2'];
    $infos->d3 = $_POST['d3'];
    $infos->d4 = $_POST['d4'];
    $infos->d6 = $_POST['d6'];
    $infos->d8 = $_POST['d8'];
    $infos->f8 = $_POST['f8'];
    $infos->d11 = $_POST['d11'];
    $infos->d12 = $_POST['d12'];
    $infos->e13 = $_POST['e13'];
    $infos->d29 = $_POST['d29'];
    $infos->d30 = $_POST['d30'];
    $infos->d31 = $_POST['d31'];
    $infos->l29 = $_POST['l29'];
    $infos->l30 = $_POST['l30'];
    $infos->l31 = $_POST['l31'];
    $infos->d49 = $_POST['d49'];
    $infos->d50 = $_POST['d50'];
    $infos->e51 = $_POST['e51'];
    $infos->c68 = $_POST['c68'];
    $infos->c69 = $_POST['c69'];
    $infos->l73 = $_POST['l73'];
    $infos->c88 = $_POST['c88'];
    $infos->c89 = $_POST['c89'];
    $infos->i18 = $_POST['i18'];
    $infos->i56 = $_POST['i56'];
    $infos->a1r = $_POST['a1r'];
    $infos->a6r = $_POST['a6r'];
    $infos->a11r = $_POST['a11r'];
    $infos->a26r = $_POST['a26r'];
    $infos->a29r = $_POST['a29r'];
    $infos->a44r = $_POST['a44r'];
    $infos->a51r = $_POST['a51r'];
    $infos->a62r = $_POST['a62r'];
    $infos->a75r = $_POST['a75r'];
    $infos->a87r = $_POST['a87r'];
    $infos->a96r = $_POST['a96r'];
    
    if (isset($_POST['infoRec'])) {
        // if (!empty($sSeq)) {
        //     updateSystem($system);
        // } else {
             insertinfos($infos);
        // }
        if (empty($errorMessage)) {
            header("Location: ./info_list.php");
        }
    // } elseif (isset($_POST['infoRec'])) {
    //     deleteSystem($system);

    //     header("Location: ./systems_list.php");
    } else {
        //$system = getSystem($sSeq);
    }
} catch (PDOException $e) {
    $errorMessage = 'データベースエラー';
    if (strcmp("1", $ini['debug'])==0) {
        echo $e->getMessage();
    }
}


  ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../js/main.js"></script>
</head>

<body>

    <form id="sakubun1" class="" action='hearingsheet1.php' method='POST'>
        <div class='menu no_print'>
            <ul class='topnav2'>
                <li><a id="back" href="#" onclick="back1();">戻る</a></li>
            </ul>
        </div>
    </form>

    <div id="content">

        <div class="nav">
            <span class="err"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></span>
        </div><br>

        <form class="" action='' method='POST' onsubmit="return addcheck()">
            <input type="hidden" name="d2" value="<?php echo $_POST['d2'];  ?>">
            <input type="hidden" name="d3" value="<?php echo $_POST['d3'];  ?>">
            <input type="hidden" name="d4" value="<?php echo $_POST['d4'];  ?>">
            <input type="hidden" name="d6" value="<?php echo $_POST['d6'];  ?>">
            <input type="hidden" name="d8" value="<?php echo $_POST['d8'];  ?>">
            <input type="hidden" name="f8" value="<?php echo $_POST['f8'];  ?>">
            <input type="hidden" name="d11" value="<?php echo $_POST['d11'];  ?>">
            <input type="hidden" name="d12" value="<?php echo $_POST['d12'];  ?>">
            <input type="hidden" name="e13" value="<?php echo $_POST['e13'];  ?>">
            <input type="hidden" name="d29" value="<?php echo $_POST['d29'];  ?>">
            <input type="hidden" name="d30" value="<?php echo $_POST['d30'];  ?>">
            <input type="hidden" name="d31" value="<?php echo $_POST['d31'];  ?>">
            <input type="hidden" name="l29" value="<?php echo $_POST['l29'];  ?>">
            <input type="hidden" name="l30" value="<?php echo $_POST['l30'];  ?>">
            <input type="hidden" name="l31" value="<?php echo $_POST['l31'];  ?>">
            <input type="hidden" name="d49" value="<?php echo $_POST['d49'];  ?>">
            <input type="hidden" name="d50" value="<?php echo $_POST['d50'];  ?>">
            <input type="hidden" name="e51" value="<?php echo $_POST['e51'];  ?>">
            <input type="hidden" name="c68" value="<?php echo $_POST['c68'];  ?>">
            <input type="hidden" name="c69" value="<?php echo $_POST['c69'];  ?>">
            <input type="hidden" name="l73" value="<?php echo $_POST['l73'];  ?>">
            <input type="hidden" name="c88" value="<?php echo $_POST['c88'];  ?>">
            <input type="hidden" name="c89" value="<?php echo $_POST['c89'];  ?>">
            <input type="hidden" name="i18" value="<?php echo $_POST['i18'];  ?>">
            <input type="hidden" name="i56" value="<?php echo $_POST['i56'];  ?>">
            <input type="hidden" name="a1r" value="<?php echo $_POST['a1r'];  ?>">
            <input type="hidden" name="a6r" value="<?php echo $_POST['a6r'];  ?>">
            <input type="hidden" name="a11r" value="<?php echo $_POST['a11r'];  ?>">
            <input type="hidden" name="a26r" value="<?php echo $_POST['a26r'];  ?>">
            <input type="hidden" name="a29r" value="<?php echo $_POST['a29r'];  ?>">
            <input type="hidden" name="a44r" value="<?php echo $_POST['a44r'];  ?>">
            <input type="hidden" name="a51r" value="<?php echo $_POST['a51r'];  ?>">
            <input type="hidden" name="a62r" value="<?php echo $_POST['a62r'];  ?>">
            <input type="hidden" name="a75r" value="<?php echo $_POST['a75r'];  ?>">
            <input type="hidden" name="a87r" value="<?php echo $_POST['a87r'];  ?>">
            <input type="hidden" name="a96r" value="<?php echo $_POST['a96r'];  ?>">

            <table class="hs">
                <tr>
                    <td style="width:600px">
                        タイトル１：<input type=text name="title1" class="del wdtM" required><br>
                        タイトル２：<input type=text name="title2" class="del wdtM"></td>
                </tr>
                <tr>
                    <td><input type=submit name="infoRec" class="del wdtLL" value="登録"></td>
                </tr>
            </table>

        </form>

    </div>
</body>

</html>