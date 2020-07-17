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
if (empty($LOGIN_ID)) {
    header('Location: x10u_logoff.php');
}

$id = empty($_GET['id']) ? $_POST['id'] : $_GET['id'];

// 自身がオファー申請中の広告を全て取得する
$offering = getOfferingAdware($LOGIN_ID);

$ofrHtml='';
foreach ($offering as $ofr) {
    $ad = getAdware($ofr->adware);
    if ($ad->isFinish=="0") {
        $ofrHtml.='<div class="row">';
        $ofrHtml.='<a href="x10u_offer_detail.php?id='.$ofr->adware.'">';
        if ($ofr->adware_type=="0") {
            $ofrHtml .= '<p class="label"><span class="bg_pink">成果報酬</span></p>';
        } elseif ($ofr->adware_type=="1") {
            $ofrHtml .= '<p class="label"><span class="bg_grn">クリック</span></p>';
        } elseif ($ofr->adware_type=="2") {
            $ofrHtml .= '<p class="label"><span class="bg_gld">投稿</span></p>';
        }
        $wk = $ofr->approvable=="1" ? '<span class="ap">承</span>' : '';
        $ofrHtml.='<p class="row_text">'.$wk.$ofr->name.'</p>';
        $ofrHtml.='</a>';
        $ofrHtml.='</div>';
    }
}
if (empty($ofrHtml)) {
    $ofrHtml='<div class="row"><p class="row_text">リクエスト中のオファーはございません。</p></div>';
}



$pays = getPaysX10($LOGIN_ID);
$paysAT2 = getPaysX10AT2($LOGIN_ID);
// foreach ($pays as $pay) {
//     $pay->stts = isAdwareFinish(getAdwareStatus($pay->id));
// }
// $pays = countMonthlyPaysGroupsAll($LOGIN_ID,0);
// $clickpays = countMonthlyPaysGroupsAll($LOGIN_ID,1);

$today = date('Y-m-d');

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-167856896-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167856896-1');
</script>
    <meta charset="UTF-8">
    <title>承認制オファー概要 </title>
    <meta name="description" content="アフィリエイト管理画面">
    <?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
    <link rel="stylesheet" href="./x10u/assets/css/result.css">
</head>

<body>

    <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

    <main class="main">

        <div class="mainheader">
            <p class="breadcrumbs">
                <a href="#">トップ</a>
                <a href="#">承認制オファー概要 </a>
            </p>
        </div>

        <div class="pageheader">
            <div class="pageheader__inner container">
                <h1 class="pageheader_title">承認制オファー概要 </h1>
            </div>
        </div>

        <section class="sec-waiting section">
            <div class="section__inner container">
                <h3 class="bar-title"><span class="bar-title-text">リクエスト結果待機中</span></h3>
                <div class="affiliate_rowList">
                    <?php echo $ofrHtml; ?>
                </div>
            </div>
        </section>

        <section class="sec-opOffer section">
            <div class="section__inner container">
                <h3 class="bar-title"><span class="bar-title-text">承認済み進行中オファー</span></h3>
                <div class="tab-style_table_area">
                    <ul class="tab-style flex-wrap js-tab_list">
                        <li class="tab_item is-active">成果報酬</li>
                        <li class="tab_item">クリック報酬</li>
                        <li class="tab_item">投稿報酬</li>
                    </ul>
                    <div class="tab-style_contents_wrap">
                        <div class="tab-style_content tab_content is-show">
                            <div class="table_wrap">
                                <table class="table-style">
                                    <thead>
                                        <tr>
                                            <th>案件名</th>
                                            <th>クリック</th>
                                            <th>発生成果</th>
                                            <th>確定成果</th>
                                            <th>未確定成果</th>
                                            <th>確定報酬</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pays as $pay) { ?>
                                        <?php if ($pay->approvable=="1" && $pay->adware_type=="0" && $pay->isFinish=="0") { ?>
                                        <tr>
                                            <td class="td-text"><a
                                                    href='x10u_offer_detail.php?id=<?php echo $pay->id; ?>#url'><?php echo $pay->name; ?></a>
                                            </td>
                                            <?php $cnt = countClicksAdwares($LOGIN_ID, $pay->id); ?>
                                            <td class="td-num"><span class="num"><?php echo $cnt; ?></span>件</td>
                                            <td class="td-num"><span class="num"><?php echo $pay->cnt; ?></span>件</td>
                                            <td class="td-num"><span class="num"><?php echo $pay->cnt2; ?></span>件</td>
                                            <td class="td-num"><span
                                                    class="num"><?php echo($pay->cst0 + $pay->cst1); ?></span>円</td>
                                            <td class="td-num"><span class="num"><?php echo $pay->cst2; ?></span>円</td>
                                            <?php $wk = $cnt>0 ? "成果発生中" : "掲載用URL表示"; ?>
                                            <td class="td-text"><a
                                                    href='x10u_offer_detail.php?id=<?php echo $pay->id; ?>#url'><?php echo $wk; ?></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-style_content tab_content">
                            <div class="table_wrap">
                                <table class="table-style">
                                    <thead>
                                        <tr>
                                            <th>案件名</th>
                                            <th>クリック</th>
                                            <th>発生成果</th>
                                            <th>確定成果</th>
                                            <th>未確定成果</th>
                                            <th>確定報酬</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pays as $pay) { ?>
                                        <?php if ($pay->approvable=="1" && $pay->adware_type=="1" && $pay->isFinish=="0") { ?>
                                        <tr>
                                            <td class="td-text"><a
                                                    href='x10u_offer_detail.php?id=<?php echo $pay->id; ?>'><?php echo $pay->name; ?></a>
                                            </td>
                                            <?php $cnt = countClicksAdwares($LOGIN_ID, $pay->id); ?>
                                            <td class="td-num"><span class="num"><?php echo $cnt; ?></span>件</td>
                                            <td class="td-num"><span class="num"><?php echo $pay->cnt; ?></span>件</td>
                                            <td class="td-num"><span class="num"><?php echo $pay->cnt2; ?></span>件</td>
                                            <td class="td-num"><span
                                                    class="num"><?php echo($pay->cst0 + $pay->cst1); ?></span>円</td>
                                            <td class="td-num"><span class="num"><?php echo $pay->cst2; ?></span>円</td>
                                            <?php $wk = $cnt>0 ? "成果発生中" : "掲載用URL表示"; ?>
                                            <td class="td-text"><a
                                                    href='x10u_offer_detail.php?id=<?php echo $pay->id; ?>#url'><?php echo $wk; ?></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-style_content tab_content">
                            <div class="table_wrap">
                                <table class="table-style">
                                    <thead>
                                        <tr>
                                            <th>案件名</th>
                                            <th>発生成果</th>
                                            <th>確定待ち成果</th>
                                            <th>確定成果</th>
                                            <th>未確定成果</th>
                                            <th>確定報酬</th>
                                            <th>非認証</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($paysAT2 as $pay) { ?>
                                        <?php if ($pay->isFinish=="0") { ?>
                                        <tr>
                                            <td class="td-text">
                                                <a href='x10u_offer_detail.php?id=<?php echo $pay->id; ?>'><?php echo $pay->name; ?></a>
                                            </td>
                <td class="td-num"><?php echo number_format($pay->cnt0); ?>件</td>
                <td class="td-num"><?php echo number_format($pay->cnt2); ?>件</td>
                <td class="td-num"><?php echo number_format($pay->cnt3); ?>件</td>
                <td class="td-num"><?php echo number_format($pay->cst2); ?>円</td>
                <td class="td-num"><?php echo number_format($pay->cst3); ?>円</td>
                <td class="td-num"><?php echo number_format($pay->cnt1); ?>件</td>
                                            <?php $wk = $pay->cnt3>0 ? "成果発生中" : "掲載用URL表示"; ?>
                                            <td class="td-text">
                                                <a href='x10u_offer_detail.php?id=<?php echo $pay->id; ?>#url'><?php echo $wk; ?></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="sec-opOffer section">
            <div class="section__inner container">
                <h3 class="bar-title"><span class="bar-title-text">掲載終了オファー</span></h3>
                <div class="tab-style_table_area">
                    <ul class="tab-style flex-wrap js-tab_list">
                        <li class="tab_item is-active">成果報酬</li>
                        <li class="tab_item">クリック報酬</li>
                        <li class="tab_item">投稿報酬</li>
                    </ul>
                    <div class="tab-style_contents_wrap">
                        <div class="tab-style_content tab_content is-show">
                            <div class="table_wrap">
                                <table class="table-style">
                                    <thead>
                                        <tr>
                                            <th>案件名</th>
                                            <th>クリック</th>
                                            <th>発生成果</th>
                                            <th>確定成果</th>
                                            <th>未確定成果</th>
                                            <th>確定報酬</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pays as $pay) { ?>
                                        <?php if ($pay->approvable=="1" && $pay->adware_type=="0" && $pay->isFinish=="1") { ?>
                                        <tr>
                                            <td class="td-text"><a
                                                    href='x10u_offer_detail.php?id=<?php echo $pay->id; ?>'><?php echo $pay->name; ?></a>
                                            </td>
                                            <?php $cnt = countClicksAdwares($LOGIN_ID, $pay->id); ?>
                                            <td class="td-num"><span class="num"><?php echo $cnt; ?>件</span></td>
                                            <td class="td-num"><span class="num"><?php echo $pay->cnt; ?>件</span></td>
                                            <td class="td-num"><span class="num"><?php echo $pay->cnt2; ?>件</span></td>
                                            <td class="td-num"><span
                                                    class="num"><?php echo($pay->cst0 + $pay->cst1); ?>円</span></td>
                                            <td class="td-num"><span class="num"><?php echo $pay->cst2; ?>円</span></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-style_content tab_content">
                            <div class="table_wrap">
                                <table class="table-style">
                                    <thead>
                                        <tr>
                                            <th>案件名</th>
                                            <th>クリック</th>
                                            <th>発生成果</th>
                                            <th>確定成果</th>
                                            <th>未確定成果</th>
                                            <th>確定報酬</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pays as $pay) { ?>
                                        <?php if ($pay->approvable=="1" && $pay->adware_type=="1" && $pay->isFinish=="1") { ?>
                                        <tr>
                                            <td class="td-text"><a
                                                    href='x10u_offer_detail.php?id=<?php echo $pay->id; ?>'><?php echo $pay->name; ?></a>
                                            </td>
                                            <?php $cnt = countClicksAdwares($LOGIN_ID, $pay->id); ?>
                                            <td class="td-num"><span class="num"><?php echo $cnt; ?>件</span></td>
                                            <td class="td-num"><span class="num"><?php echo $pay->cnt; ?>件</span></td>
                                            <td class="td-num"><span class="num"><?php echo $pay->cnt2; ?>件</span></td>
                                            <td class="td-num"><span
                                                    class="num"><?php echo($pay->cst0 + $pay->cst1); ?>円</span></td>
                                            <td class="td-num"><span class="num"><?php echo $pay->cst2; ?>円</span></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-style_content tab_content">
                            <div class="table_wrap">
                                <table class="table-style">
                                    <thead>
                                        <tr>
                                            <th>案件名</th>
                                            <th>発生成果</th>
                                            <th>確定待ち成果</th>
                                            <th>確定成果</th>
                                            <th>未確定成果</th>
                                            <th>確定報酬</th>
                                            <th>非認証</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($paysAT2 as $pay) { ?>
                                        <?php if ($pay->isFinish=="1") { ?>
                                        <tr>
                                            <td class="td-text">
                                                <a href='x10u_offer_detail.php?id=<?php echo $pay->id; ?>'><?php echo $pay->name; ?></a>
                                            </td>
                <td class="td-num"><?php echo number_format($pay->cnt0); ?>件</td>
                <td class="td-num"><?php echo number_format($pay->cnt2); ?>件</td>
                <td class="td-num"><?php echo number_format($pay->cnt3); ?>件</td>
                <td class="td-num"><?php echo number_format($pay->cst2); ?>円</td>
                <td class="td-num"><?php echo number_format($pay->cst3); ?>円</td>
                <td class="td-num"><?php echo number_format($pay->cnt1); ?>件</td>
                                            <?php $wk = $pay->cnt3>0 ? "成果発生中" : "掲載用URL表示"; ?>
                                            <td class="td-text">
                                                <a href='x10u_offer_detail.php?id=<?php echo $pay->id; ?>#url'><?php echo $wk; ?></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <br><br><br>
                <div class="btn">
                    <a href="./x10u_mypage.php" class="bd_blu">トップへ戻る</a>
                </div>

            </div>
        </section>

    </main>

    <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>

</html>