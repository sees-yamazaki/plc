<?php

// セッション開始
session_start();
require('session.php');

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

// ログイン状態チェック
if (getSsnIsLogin()==false) {
    header('Location: a_logoff.php');
    exit;
}

// エラーメッセージの初期化
$errorMessage = '';

    $iSeq = $_POST['iSeq'];
    if (!isset($mSeq)) {
        $iSeq = $_GET['iSeq'];
    }

    $tDate = $_GET['tDate'];

    require './db/infos.php';

    if (isset($iSeq)) {
        $info = new cls_infos();
        $info = getInfo($iSeq);

        $html1 = '';
        if (strlen($info->inf_text1)>0) {
            $html1 .= "<h3>".nl2br($info->inf_text1)."</h3>";
        }
        if (strlen($info->inf_img)>0) {
            $html1 .= "<img class='img80' border=0 src='./".getSsn('PATH_INFO')."/".$info->inf_seq."/".$info->inf_img."'>";
        }
        if (strlen($info->inf_text2)>0) {
            $html1 .= "<h3>".nl2br($info->inf_text2)."</h3>";
        }
    } else {
        $infos = getOpenInfos($tDate);

        $html1 = '';
        foreach ($infos as $info) {
            if (strlen($info->inf_text1)>0) {
                $html1 .= "<h3>".nl2br($info->inf_text1)."</h3>";
            }
            if (strlen($info->inf_img)>0) {
                $html1 .= "<img class='img80' border=0 src='../psys/".getSsn('PATH_INFO')."/".$info->inf_seq."/".$info->inf_img."'>";
            }
            if (strlen($info->inf_text2)>0) {
                $html1 .= "<h3>".nl2br($info->inf_text2)."</h3>";
            }
            $html1 .= "<hr>";
        }
        $html1 = substr($html1, 0, -4);
    }

?>

<!DOCTYPE HTML>
<html lang="ja">

<head>
    <title><?php echo getSsnMyname(); ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../psys_c/assets/css/main.css" />
    <link rel="stylesheet" href="../psys_c/asset/css/main.css" />
    <script>
    function choise(vlu) {
        document.frm.pzSeq.value = vlu;
        document.frm.submit();
    }
    </script>
</head>

<body>

    <section id="banner8">
        <div class="inner">
            <?php echo $html1; ?>
        </div>
    </section>

    <section id="banner">
        <div class="inner">
            <h1>現在のポイント：9999PT</h1>
            <ul class="actions">
                <li><a href="javascript:void(0)" class="button alt scrolly big">ポイント登録する</a></li>
            </ul>
        </div>
    </section>

    <section id="banner">
        <div class="inner">
            <h1>20ポイント貯まりました！！</h1>
            <ul class="actions">
                <li><a href="javascript:void(0)" class="button alt scrolly big">ゲームにチャレンジ</a></li>
            </ul>
        </div>
    </section>

</body>

</html>