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
$thisY = date('Y');
$thisM = date('m');
// 指定月の目標設定広告のデータを取得
$cnt_click_0 = countMonthlyClicks($thisY, $thisM, $LOGIN_ID, 0);
$pays_0 = countMonthlyPays($thisY, $thisM, $LOGIN_ID, 0);
// 指定月のクリック広告のデータを取得
$cnt_click_1 = countMonthlyClicks($thisY, $thisM, $LOGIN_ID, 1);
$pays_1 = countMonthlyPays($thisY, $thisM, $LOGIN_ID, 1);
// 指定月の投稿広告のデータを取得
//$pays_2 = countMonthlyPays($thisY, $thisM, $LOGIN_ID, 2);
$pays_2 = countMonthlyPaysAT2($thisY, $thisM, $LOGIN_ID);


$termHtml = date('Y年m月d日', strtotime("first day of this month"))."〜".date('m月d日', strtotime("now"));

// 直近５日間に公開されて、現在公開中の広告を取得する
//$ads = getAdwaresRecentry(5);
$ads = getAdwaresLimit(" AND (isFinish=0) AND `open`=1 ", 5, 0);

$pickupHtml='';
foreach ($ads as $ad) {
    $pickupHtml.='<div class="box">';
    $pickupHtml.='<a href="x10u_offer_detail.php?id='.$ad->id.'">';
    $pickupHtml.='<div class="box_upper">';
    $pickupHtml.='<figure class="box_img"><img src="'.$ad->banner.'" alt=""></figure>';
    $pickupHtml.='<div class="box_info">';
    $pickupHtml.='<p class="item_desc">'.$ad->ad_text.'</p>';
    $pickupHtml.='<h3 class="item_name">'.$ad->name.'</h3>';
    $pickupHtml.='<ul class="label_list flex-wrap">';
    if ($ad->adware_type=="0") {
        $pickupHtml.='<li class="bg_pink">成果報酬</li>';
    } else {
        $pickupHtml.='<li class="bg_grn">クリック</li>';
    }
    $pickupHtml.='</ul>';
    if ($ad->approvable=="1") {
        $pickupHtml.='<p class="label-op bg_orn">承認制</p>';
    }
    $pickupHtml.='</div>';
    $pickupHtml.='</div>';
    $pickupHtml.='<p class="box_text">'.abbrStr($ad->comment, 60).'</p>';
    $pickupHtml.='</a>';
    $pickupHtml.='</div>';
    $pickupHtml.='';
}


$newerHtml='';
foreach ($ads as $ad) {
    $newerHtml.='<div class="row">';
    $newerHtml.='<a href="x10u_offer_detail.php?id='.$ad->id.'">';
    if ($ad->adware_type=="0") {
        $newerHtml.='<p class="label"><span class="bg_pink">成果報酬</span></p>';
    } elseif ($ad->adware_type=="1") {
        $newerHtml.='<p class="label"><span class="bg_grn">クリック</span></p>';
    } elseif ($ad->adware_type=="2") {
        $newerHtml.='<p class="label"><span class="bg_gld">投稿</span></p>';
    }
    $wk = $ad->approvable=="1" ? '<span class="ap">承</span>' : '';
    $newerHtml.='<p class="row_text">'.$wk.$ad->name.'</p>';
    $newerHtml.='</a>';
    $newerHtml.='</div>';
    $newerHtml.='';
}
// $rcntyHtml='';
// foreach ($ads as $ad) {
//     $rcntyHtml .= '<tr><td>';
//     if ($ad->adware_type=="0") {
//         $rcntyHtml .= '[目標]';
//     } else {
//         $rcntyHtml .= '[クリック]';
//     }
//     if ($ad->approvable=="0") {
//         $rcntyHtml .= '</td><td><a href="x10n_adwares_info.php?id='.$ad->id.'">'.$ad->name.'</a></td><td>';
//     } else {
//         $rcntyHtml .= '</td><td><a href="x10n_adwares_info.php?id='.$ad->id.'">'.$ad->name.'</a> [承認制]</td><td>';
//     }
//     $rcntyHtml .= '</td></tr>';
// }
// if (empty($rcntyHtml)) {
//     $rcntyHtml='＞新着オファーはありません。';
// }

// 自身がオファー申請中の広告を全て取得する
$offering = getOfferingAdware($LOGIN_ID);

$offeringHtml = '';
foreach ($offering as $ofr) {
    $ad = getAdware($ofr->adware);
    if ($ad->isFinish=="0") {
        $offeringHtml .= '<div class="row">';
        $offeringHtml .= '<a href="x10u_offer_detail.php?id='.$ad->id.'">';
        if ($ofr->adware_type=="0") {
            $offeringHtml .= '<p class="label"><span class="bg_pink">成果報酬</span></p>';
        } elseif ($ofr->adware_type=="1") {
            $offeringHtml .= '<p class="label"><span class="bg_grn">クリック</span></p>';
        } elseif ($ofr->adware_type=="2") {
            $offeringHtml .= '<p class="label"><span class="bg_gld">投稿</span></p>';
        }
        $offeringHtml .= '<p class="row_text"><span class="ap">承</span>'.$ofr->name.'</p>';
        $offeringHtml .= '</a>';
        $offeringHtml .= '</div>';
        $offeringHtml .= '';
    }
}
if (empty($offeringHtml)) {
    $offeringHtml='';
}


$approved = getApprovedAdwareLimit($LOGIN_ID, 3);
$approvedHtml = '';
foreach ($approved as $app) {
    $approvedHtml .= '<div class="row">';
    $approvedHtml .= '<a href="x10u_offer_detail.php?id='.$app->adware.'">';
    if ($app->adware_type=="0") {
        $approvedHtml .= '<p class="label"><span class="bg_pink">成果報酬</span></p>';
    } elseif ($app->adware_type=="1") {
        $approvedHtml .= '<p class="label"><span class="bg_grn">クリック</span></p>';
    } elseif ($app->adware_type=="2") {
        $approvedHtml .= '<p class="label"><span class="bg_gld">投稿</span></p>';
    }
    $approvedHtml .= '<p class="row_text"><span class="ap">承</span>'.$app->name.'</p>';
    $approvedHtml .= '</a>';
    $approvedHtml .= '</div>';
    $approvedHtml .= '';
}
if (empty($approvedHtml)) {
    $approvedHtml='<div class="row"><p class="row_text">まだ承認済みオファーがありません</p></div>';
}

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
    <title>マイページ</title>
    <meta name="description" content="アフィリエイト管理画面">
    <?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
    <link rel="stylesheet" href="./x10u/assets/css/mypage.css">
</head>

<body>

    <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

    <main class="main">

        <div class="mainheader">
            <p class="breadcrumbs">
                <a href="#">トップ</a>
                <a href="#">マイページ</a>
            </p>
        </div>

        <section class="sec-achieve section">
      <div class="section__inner container">
        <h2 class="sec-title"><span class="icon_note"></span>今月の成果</h2>
        <div class="tab-style_table_area">
          <ul class="tab-style flex-wrap js-tab_list">
                        <li class="tab_item is-active">すべて</li>
                        <li class="tab_item">成果報酬</li>
                        <li class="tab_item">クリック報酬</li>
                        <li class="tab_item">投稿報酬</li>
                    </ul>
          <div class="tab-style_contents_wrap">
            <div class="tab-style_content tab_content is-show">
                            <p class="tab-style__content_date f-bold">今月の成果（<?php echo $termHtml; ?>）</p>
                            <div class="table_wrap">
                                <table class="table-style">
                                    <thead>
                                        <tr>
                                            <th>クリック</th>
                                            <th>発生成果</th>
                                            <th>確定成果</th>
                                            <th>未確定成果</th>
                                            <th>確定報酬</th>
                                            <th>確定待ち成果</th>
                                            <th>非認証</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="td-num"><?php echo(number_format($cnt_click_0 + $cnt_click_1)); ?>件</td>
                                            <td class="td-num"><?php echo(number_format($pays_0->cnt + $pays_1->cnt + $pays_2->cnt0)); ?>件</td>
                                            <td class="td-num"><?php echo(number_format($pays_0->cnt2 + $pays_1->cnt2 + $pays_2->cnt3)); ?>件</td>
                                            <td class="td-num"><?php echo(number_format($pays_0->cst0 + $pays_1->cst0 + $pays_2->cst2)); ?>円</td>
                                            <td class="td-num"><?php echo(number_format($pays_0->cst2 + $pays_1->cst2 + $pays_2->cst3)); ?>円</td>
                                            <td class="td-num"><?php echo number_format($pays_2->cnt2); ?>件</td>
                                            <td class="td-num">
                                                <?php echo($pays_0->cnt1 + $pays_1->cnt1 + $pays_2->cnt1); ?>件
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="achieve_content tab_content">
                            <p class="archieve__content_date f-bold">今月の成果（<?php echo $termHtml; ?>）</p>
                            <div class="table_wrap">
                                <table class="table-style">
                                    <thead>
                                        <tr>
                                            <th>クリック</th>
                                            <th>発生成果</th>
                                            <th>確定成果</th>
                                            <th>未確定成果</th>
                                            <th>確定報酬</th>
                                            <th>非認証</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="td-num"><?php echo number_format($cnt_click_0); ?>件</td>
                                            <td class="td-num"><?php echo number_format($pays_0->cnt); ?>件</td>
                                            <td class="td-num"><?php echo number_format($pays_0->cnt2); ?>件</td>
                                            <td class="td-num"><?php echo(number_format($pays_0->cst0)); ?>円</td>
                                            <td class="td-num"><?php echo number_format($pays_0->cst2); ?>円</td>
                                            <td class="td-num"><?php echo(number_format($pays_0->cnt1)); ?>件</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="achieve_content tab_content">
                            <p class="archieve__content_date f-bold">今月の成果（<?php echo $termHtml; ?>）</p>
                            <div class="table_wrap">
                                <table class="table-style">
                                    <thead>
                                        <tr>
                                            <th>クリック</th>
                                            <th>発生成果</th>
                                            <th>確定成果</th>
                                            <th>未確定成果</th>
                                            <th>確定報酬</th>
                                            <th>非認証</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="td-num"><?php echo number_format($cnt_click_1); ?>件</td>
                                            <td class="td-num"><?php echo number_format($pays_1->cnt); ?>件</td>
                                            <td class="td-num"><?php echo number_format($pays_1->cnt2); ?>件</td>
                                            <td class="td-num"><?php echo(number_format($pays_1->cst0)); ?>円</td>
                                            <td class="td-num"><?php echo number_format($pays_1->cst2); ?>円</td>
                                            <td class="td-num"><?php echo(number_format($pays_1->cnt1)); ?>件</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="achieve_content tab_content">
                            <p class="archieve__content_date f-bold">今月の成果（<?php echo $termHtml; ?>）</p>
                            <div class="table_wrap">
                                <table class="table-style">
                                    <thead>
                                        <tr>
                                            <th>発生成果</th>
                                            <th>確定待ち成果</th>
                                            <th>確定成果</th>
                                            <th>未確定成果</th>
                                            <th>確定報酬</th>
                                            <th>非認証</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="td-num"><?php echo number_format($pays_2->cnt0); ?>件</td>
                                            <td class="td-num"><?php echo number_format($pays_2->cnt2); ?>件</td>
                                            <td class="td-num"><?php echo number_format($pays_2->cnt3); ?>件</td>
                                            <td class="td-num"><?php echo number_format($pays_2->cst2); ?>円</td>
                                            <td class="td-num"><?php echo number_format($pays_2->cst3); ?>円</td>
                                            <td class="td-num"><?php echo number_format($pays_2->cnt1); ?>件</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <p class="add_link_btn text-right"><a href="x10u_result_list.php"><span class="icon_add"></span>詳しく見る</a></p>
                    </div>
                </div>
            </div>
        </section>

        <!--
        <section class="sec-pickup section">
            <div class="section__inner container">
                <h2 class="sec-title"><span class="icon_note"></span>新着ピックアップオファー</h2>
                <div class="affiliate_boxList flex-wrap">
                    <?php echo $pickupHtml; ?>
                </div>
        </section>-->

        <section class="sec-newOffer section">
            <div class="section__inner container">
                <h2 class="sec-title"><span class="icon_note"></span>新着オファー</h2>
                <div class="affiliate_rowList">
                    <?php echo $newerHtml; ?>
                </div>
                <p class="add_link_btn text-right"><a href="./x10u_offer_list.php"><span class="icon_add"></span>オファー一覧</a>
                </p>
            </div>
        </section>

        <section class="sec-apOffer section">
            <div class="section__inner container">
                <h2 class="sec-title"><span class="icon_note"></span>承認制オファー概要</h2>

                <?php if (!empty($offeringHtml)) { ?>
                <div class="affiliate_list__group">
                    <h3 class="bar-title"><span class="bar-title-text">リクエスト結果待機中</span></h3>
                    <div class="affiliate_rowList">
                        <?php echo $offeringHtml; ?>
                        <!--<div class="row">
              <a href="./offer_detail.html">
                <p class="label"><span class="bg_gld">投稿</span></p>
                <p class="row_text"><span class="ap">承</span>特定医療器具ダイエットグッズ「コシマワール」の購入</p>
              </a>
            </div>-->
                    </div>
                </div>
                <?php } ?>
                <?php if (!empty($approvedHtml)) { ?>
                <div class="affiliate_list__group">
                    <h3 class="bar-title"><span class="bar-title-text">承認済みオファー</span></h3>
                    <div class="affiliate_rowList">
                        <?php echo $approvedHtml; ?>
                        <!--<div class="row">
              <a href="./offer_detail.html">
                <p class="label"><span class="bg_pink">成果報酬</span></p>
                <p class="row_text"><span class="ap">承</span>特定医療器具ダイエットグッズ「コシマワール」の購入</p>
              </a>
            </div>
            <div class="row">
              <a href="./offer_detail.html">
                <p class="label"><span class="bg_grn">クリック</span></p>
                <p class="row_text"><span class="ap">承</span>特定医療器具ダイエットグッズ「コシマワール」の購入</p>
              </a>
            </div>
            <div class="row">
              <a href="./offer_detail.html">
                <p class="label"><span class="bg_gld">投稿</span></p>
                <p class="row_text"><span class="ap">承</span>特定医療器具ダイエットグッズ「コシマワール」の購入</p>
              </a>
            </div>-->
                    </div>
                </div>
                <?php } ?>
                <p class="add_link_btn text-right"><a href="javascript:frmN.submit()"><span class="icon_add"></span>承認制オファー一覧</a>
                </p>
                <form action="x10u_offer_list.php" method="POST" name="frmN">
                <input type="hidden" name="run" value="1">
                <input type="hidden" name="page" value="">
                <input type="hidden" name="isPaging" value="0">
                <input type="hidden" name="approvable[]" value="1">
                </form>
            </div>
        </section>

    </main>

    <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>

</html>