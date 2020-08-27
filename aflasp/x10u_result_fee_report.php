<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';

// セッション再開
session_start();

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
if (empty($LOGIN_ID)) {
    header('Location: x10u_logoff.php');
}

//Timezone
date_default_timezone_set('Asia/Tokyo');

// エラーメッセージの初期化
$errorMessage = '';

$tgtYM = empty($_POST['tgtYM']) ? date('Ym') : $_POST['tgtYM'];
$tgtY = substr($tgtYM, 0, 4);
$tgtM = substr($tgtYM, -2);

//対象年以前の報酬と支払いを取得する
//報酬は２ヶ月前基準
$where = " AND regist < ".strtotime(($tgtY-1).'-11-01 00:00:00');
$past_cost = getTotalCost($where, $LOGIN_ID);
//支払いは当月基準
$where = " AND regist < ".strtotime($tgtY.'-01-01 00:00:00');
$past_pay = getTotalPay($where, $LOGIN_ID);
$carry = $past_cost - $past_pay;

$dataHtml ='';
$oe = "even";
for ($i = 1; $i <= 12; $i++) {
    //報酬は２ヶ月前
    $stt = strtotime(date('Y-m-d 00:00:00', mktime(0, 0, 0, $i - 2, 1, $tgtY)));
    $end = strtotime(date('Y-m-d 23:59:59', mktime(0, 0, 0, $i - 1, 0, $tgtY)));
    $kijun = date('Y年n月', $stt);
    // echo '$tgtY'.$tgtY.PHP_EOL;
    // echo '$i'.$i.PHP_EOL;
    // echo 'stt'.$stt.PHP_EOL;
    // echo 'end'.$end.PHP_EOL;
    $where = " AND regist  BETWEEN ".$stt." AND ".$end;
    $tmp_cost = getTotalCost($where, $LOGIN_ID);

    //支払いは当月
    $stt = strtotime($tgtY.'-'.$i.'-01 00:00:00');
    $end = strtotime(date('Y-m-d 23:59:59', mktime(0, 0, 0, $i + 1, 0, $tgtY)));
    $where = " AND regist  BETWEEN ".$stt." AND ".$end;
    $tmp_pay = getTotalPay($where, $LOGIN_ID);

    $oe = $oe=='even' ? "odd" : "even";
    $dataHtml2 ='<tr class="'.$oe.'">';
    $dataHtml2 .='<td>'.$tgtY.'年'.$i.'月</td>';
    $dataHtml2 .='<td class="sitename">'.$kijun.'</td>';
    $tax = round($tmp_cost * 0.1);
    $dataHtml2 .='<td>'.number_format($tmp_cost).'</td>';//成果報酬額・税込
    $dataHtml2 .='<td>'.number_format($tmp_cost-$tax).'</td>';//成果報酬額・税別
    $dataHtml2 .='<td>'.number_format($tax).'</td>';//成果報酬額・税金
    $dataHtml2 .='<td>'.number_format($carry).'</td>';//先月繰越金額
    $dataHtml2 .='<td>'.number_format($carry+$tmp_cost).'</td>';//振込対象金額
    $dataHtml2 .='<td>00</td>';//手数料
    $dataHtml2 .='<td class="bold bgcheck">'.number_format($tmp_pay).'</td>';//振込金額

    $carry = $carry + $tmp_cost - $tmp_pay;
    $dataHtml2 .='<td>'.number_format($carry).'</td>';//繰越金額
    $dataHtml2 .='</tr>';

    $dataHtml = $dataHtml2.$dataHtml;

    if (date('Ym', $stt) == date('Ym', strtotime("NOW"))) {
        break;
    }
}


?>
!DOCTYPE html>
<html lang="ja">

<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-167856896-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-167856896-1');
    </script>
    <meta charset="UTF-8">
    <title>報酬・振込レポート</title>
    <meta name="description" content="アフィリエイト管理画面">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="./x10u/assets/img/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon-precomposed" href="./x10u/assets/img/apple-touch-icon-precomposed.png">
    <link rel="stylesheet" href="./x10u/assets/css/style.css">
    <script type="text/javascript" src="./x10u/assets/js/jquery.js"></script>
    <script type="text/javascript" src="./x10u/assets/js/common.js"></script>
    <link rel="stylesheet" href="./x10u/assets/css/result.css">
</head>

<body>

    <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

    <main class="main">

        <div class="mainheader">
            <p class="breadcrumbs">
                <a href="#">トップ</a>
                <a href="#">報酬・振込レポート</a>
            </p>
        </div>

        <div class="pageheader">
            <div class="pageheader__inner container">
                <h1 class="pageheader_title">報酬・振込レポート</h1>
            </div>
        </div>

        <section class="sec-fee-report section">
            <div class="sec__inner container">
                <h3 class="bar-title"><span class="bar-title-text">振込予定金額</span></h3>
                <?php
            
            $thisY = date('Y');
            $thisM = date('m');
            $where = " AND regist < ".strtotime(date('Y-m-d 00:00:00', mktime(0, 0, 0, $thisM - 1, 1, $thisY)));
            $present_cost = getTotalCost($where, $LOGIN_ID);
            //支払いは当月基準
            $present_pay = getTotalPay("", $LOGIN_ID);
            $present_carry = $present_cost - $present_pay;
            $ari = $present_carry>4999 ? "あり" : "なし";
        ?>
                <div class="dl-style">
                    <dl>
                        <dt>来月振込予定</dt>
                        <dd><?php echo $ari ?></dd>
                    </dl>
                    <dl>
                        <dt>繰越金額合計</dt>
                        <dd><?php echo number_format($present_carry) ?>円</dd>
                    </dl>
                </div>
            </div>
        </section>
        <section class="sec-fee-report section">
            <div class="section__inner container">
                <h3 class="bar-title"><span class="bar-title-text"><?php echo $tgtY ?>年のレポート</span></h3>
                
                <div class="search__contents_wrap">
                    <div class="custom__btn_drop sp">
                    <a class="js-drop_btn" href="">表示期間を選択</a>
                    </div>
                    <div class="search__contents drop_contents">
                        <form class="search__form" action="" method="post">
                            <div class="search__form_row_wrap">
                                <div class="search__select_wrap">
                                    <select class="" name="tgtYM">
                                        <?php
                                        for ($i = 2019; $i <= date('Y'); $i++) {
                                            $wk = ($i==$tgtY) ? " selected" : "";
                                            echo "<option value='".$i."' ".$wk.">".$i."</option>";
                                        }
                                        ?>
                                    </select>　
                                </div>
                                <span>　</span>
                                <div class="access__submit search__submit">
                                    <input type="submit" value="表示期間" class="input_base">
                                    <input type="hidden" name="adtype" value="0">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div>
                    <p style="text-align:right;">
                        レポート最終更新日：<?php echo date('Y年n月j日 G時i分') ?><br>
                        単位（金額は全て円） <br>
                        ※報酬額は税込です<br>
                    </p>
                </div>
                <div class="result__table_wrap">
                    <div class="table_wrap">
                        <table id="reportSortTable" class="table-style reportTable">
                            <thead>
                                <tr>
                                    <th class="bg3" rowspan="2">振込年月</th>
                                    <th class="bg1 pay" colspan="6">対象成果報酬額</th>
                                    <th class="pay" colspan="3">振込金額</th>
                                </tr>
                                <tr>
                                    <th class="bg1">対象年月</th>
                                    <th class="bg1">成果報酬額・税込</th>
                                    <th class="bg1">成果報酬額・税別</th>
                                    <th class="bg1">成果報酬額・税金</th>
                                    <th class="bg1">先月繰越金額</th>
                                    <th class="bg1">振込対象金額</th>
                                    <th>手数料</th>
                                    <th class="bold">振込金額</th>
                                    <th>繰越金額</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- 奇数行ならclass="odd"、奇数行ならclass="even" -->

                                <?php echo $dataHtml; ?>

                            </tbody>
                        </table>

                    </div>
                </div>


                <div class="result__link_btn_list">
                    表示データをダウンロード: 
                    <form  method="post" action="x10u_result_fee_report_csv.php" download='data_'.$tgtYM.'.csv'>
                        <input type="hidden" name="tgtYM" value="<?php echo $tgtYM ?>">
                        <input type="submit" class="btn btn-info" value="CSV">
                    </form> | 
                    <form  method="post" action="x10u_result_fee_report_xls.php" download='data_'.$tgtYM.'.xlsx'>
                        <input type="hidden" name="tgtYM" value="<?php echo $tgtYM ?>">
                        <input type="submit" class="btn btn-info" value="EXCEL">
                    </form>

                </div>

            </div>
        </section>

    </main>

    <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>

</html>