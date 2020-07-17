<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';

// セッション再開
session_start();

//Timezone
date_default_timezone_set('Asia/Tokyo');

// エラーメッセージの初期化
$errorMessage = '';

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
if(empty($LOGIN_ID)){ header('Location: x10n_logoff.php'); }

$adtype =  isset($_GET['adtype']) ? $_GET['adtype'] : $_POST['adtype'] ;

$startdt = $_POST['startdt'];
$enddt = $_POST['enddt'];



$offsetPage = 0;
$limitPage = 5;
$crntPage = empty($_POST['page']) ? 1: $_POST['page'];


//検索結果件数を取得
$cnt = countPay($startdt, $enddt, $LOGIN_ID, $adtype);

//ページ数を計算
$pages = ceil($cnt / $limitPage);

//オフセットページ
$offsetPage = ($crntPage - 1) * $limitPage;


$pagerhtml='';
if ($offsetPage==0) {
    $pagerhtml .= '<span class="previous">&lt;&lt; 前はありません</span>';
} else {
    $pagerhtml .= '<span class="previous"><a href="javascript:paging('.($crntPage - 1).')">&lt;&lt; 前の'.$limitPage.' 件</a></span>';
}
for ($i = 1; $i <= $pages; $i++) {
    if ($i==$crntPage) {
        $pagerhtml .= '<span class="active">'.$i.'</span>';
    } else {
        $pagerhtml .= '<span><a href="javascript:paging('.$i.')">'.$i.'</a></span>';
    }
}
if ($crntPage==$pages || $pages==0) {
    $pagerhtml .= '<span class="next">次はありません &gt;&gt;</span>';
} elseif ($crntPage==($pages-1)) {
    $pagerhtml .= '<span class="next"><a href="javascript:paging('.($crntPage + 1).')">次の'.($cnt % $limitPage).'件 &gt;&gt;</a></span>';
} else {
    $pagerhtml .= '<span class="next"><a href="javascript:paging('.($crntPage + 1).')">次の'.$limitPage.'件 &gt;&gt;</a></span>';
}


$pays = getPayLimit($startdt, $enddt, $LOGIN_ID, $adtype, $limitPage, $offsetPage);

$titleHtml='';
$backHtml='';
if ($adtype=="0") {
    $titleHtml .= '成果報酬報酬（発生別）';
    $backHtml='<a href="x10n_result_monthly.php?adtype=0">目的達成報酬（月別）へ</a>';
} else {
    $titleHtml .= 'クリック報酬（発生別）';
    $backHtml='<a href="x10n_result_monthly.php?adtype=1">クリック報酬（月別）へ</a>';
}

$txt_state = array('認定中','非認証','認証');

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo ""; ?>
    </title>
    <link rel="stylesheet" href="x10n/css/main.css">
</head>

<body>

    <script>
        function paging(vlu) {
            document.frm.page.value = vlu;
            document.frm.submit();
        }
    </script>

    <?php if (!empty($errorMessage)) { ?>
    <span class="err"><?php echo $errorMessage; ?></span>
    <?php } ?>

    <?php echo $titleHtml; ?><br>

    成果発生期間<br>

    <form action="" method="POST" name="frm">
        <input type="date" name="startdt"
            value="<?php echo $startdt; ?>">〜
        <input type="date" name="enddt"
            value="<?php echo $enddt; ?>">
        <input type="hidden" name="page" value=""><br>
        <input type="submit" value="表示">
    <input type="hidden" name="adtype" value="<?php echo $adtype; ?>">
    </form>

    <!--ページャー-->
    <div class="pager_info">
        <p><span>全<?php echo $cnt; ?>件中</span><span><?php echo count($pays); ?>件を表示しています</span></p>
    </div>
    <!--ページャーここまで-->


    <table>
        <tr>
            <td>日付</td>
            <td>案件名</td>
        </tr>
        <?php foreach ((array)$pays as $pay) { ?>
        <tr>
            <td><?php echo date('Y-m-d H:i:s', $pay->regist); ?>
            </td>
            <td><?php echo $pay->name; ?>
            </td>
            <td><?php echo $txt_state[$pay->state]; ?>
            </td>
            <td><?php echo $pay->cost; ?>円
            </td>
        </tr>
        <?php } ?>
    </table>

    <!--ページャー-->
    <div class="pager">
        <p class="pagination">
            <?php echo $pagerhtml; ?>
        </p>
    </div>

    <!--ページャーここまで-->


    <br><br>
    <?php echo $backHtml; ?><br>
    <a href='x10n_result_list.php?adtype=0'>成果報酬トップへ</a><br><br>
    <input type="button" onclick="location.href='x10n_home.php'" value="トップへ">
</body>

</html>