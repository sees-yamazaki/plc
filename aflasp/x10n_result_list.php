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
$thisY = date('Y');
$thisM = date('m');
$cnt_click_0 = countMonthlyClicks($thisY, $thisM, $LOGIN_ID, 0);
$pays_0 = countMonthlyPays($thisY, $thisM, $LOGIN_ID, 0);
$cnt_click_1 = countMonthlyClicks($thisY, $thisM, $LOGIN_ID, 1);
$pays_1 = countMonthlyPays($thisY, $thisM, $LOGIN_ID, 1);

$past_cnt_click = countPastClicks($thisY, $thisM, $LOGIN_ID);
$past_pays_0 = countPastPays($thisY, $thisM, $LOGIN_ID, 0);
$past_pays_1 = countPastPays($thisY, $thisM, $LOGIN_ID, 1);


$startdt = $_POST['startdt'];
$enddt = $_POST['enddt'];



$offsetPage = 0;
$limitPage = 5;
$crntPage = empty($_POST['page']) ? 1: $_POST['page'];


//検索結果件数を取得
$cnt = countAccess($startdt, $enddt, $LOGIN_ID);

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


$accss = getAccessLimit($startdt, $enddt, $LOGIN_ID, $limitPage, $offsetPage);



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
    成果情報<br>
    <br>

    今月の成果<br>
    <table>
        <tr>
            <td>クリック</td>
            <td>発生成果</td>
            <td>確定成果</td>
            <td>未確定成果</td>
            <td>確定報酬</td>
            <td>非認証</td>
        </tr>
        <tr>
            <td><?php echo($cnt_click_0 + $cnt_click_1); ?>件</td>
            <td><?php echo($pays_0->cnt + $pays_1->cnt); ?>件</td>
            <td><?php echo($pays_0->cnt2 + $pays_1->cnt2); ?>件</td>
            <td><?php echo($pays_0->cst0 + $pays_0->cst1 + $pays_1->cst0 + $pays_1->cst1); ?>円
            </td>
            <td><?php echo($pays_0->cst2 + $pays_1->cst2); ?>円</td>
            <td><?php echo($pays_0->cnt0 + $pays_0->cnt1 + $pays_1->cnt0 + $pays_1->cnt1); ?>件
            </td>
        </tr>
    </table>

    <br>

    これまでの成果<br>
    <table>
        <tr>
            <td>クリック</td>
            <td>発生成果</td>
            <td>確定成果</td>
            <td>未確定成果</td>
            <td>確定報酬</td>
            <td>非認証</td>
        </tr>
        <tr>
            <td><?php echo($past_cnt_click); ?>件</td>
            <td><?php echo($past_pays_0->cnt + $past_pays_1->cnt); ?>件</td>
            <td><?php echo($past_pays_0->cnt2 + $past_pays_1->cnt2); ?>件
            </td>
            <td><?php echo($past_pays_0->cst0 + $past_pays_0->cst1 + $past_pays_1->cst0 + $past_pays_1->cst1); ?>円
            </td>
            <td><?php echo($past_pays_0->cst2 + $past_pays_1->cst2); ?>円
            </td>
            <td><?php echo($past_pays_0->cnt0 + $past_pays_0->cnt1 + $past_pays_1->cnt0 + $past_pays_1->cnt1); ?>件
            </td>
        </tr>
    </table>

    <br><br>

    報酬別成果情報<br>
    <table>
        <tr>
            <td>目的達成報酬</td>
            <td><a href='x10n_result_monthly.php?adtype=0'>月別</a></td>
            <td><a href='x10n_result_action.php?adtype=0'>発生別</a></td>
        </tr>
        <tr>
            <td>クリック達成報酬</td>
            <td><a href='x10n_result_monthly.php?adtype=1'>月別</a></td>
            <td><a href='x10n_result_action.php?adtype=1'>発生別</a></td>
        </tr>
    </table>

    <br><br>

    アクセスリスト<br>
    期間<br>
    <form action="" method="POST" name="frm">
        <input type="date" name="startdt"
            value="<?php echo $startdt; ?>">〜
        <input type="date" name="enddt"
            value="<?php echo $enddt; ?>">
        <input type="hidden" name="page" value=""><br>
        <input type="submit" value="表示">
    </form>

    <!--ページャー-->
    <div class="pager_info">
        <p><span>全<?php echo $cnt; ?>件中</span><span><?php echo count($accss); ?>件を表示しています</span></p>
    </div>
    <!--ページャーここまで-->


    <table>
        <tr>
            <td>日付</td>
            <td>案件名</td>
        </tr>
        <?php foreach ((array)$accss as $acs) { ?>
        <tr>
            <td><?php echo date('Y-m-d H:i:s', $acs->regist); ?>
            </td>
            <td><?php echo $acs->name; ?>
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
    <input type="button" onclick="location.href='x10n_adwares_search.php'" value="オファー一覧へ">
</body>

</html>