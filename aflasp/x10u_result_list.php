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

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
$thisY = date('Y');
$thisM = date('m');
// 指定月の目標設定広告のデータを取得
$cnt_click_0 = countMonthlyClicks($thisY, $thisM, $LOGIN_ID, 0);
$pays_0 = countMonthlyPays($thisY, $thisM, $LOGIN_ID, 0);
// 指定月のクリック広告のデータを取得
$cnt_click_1 = countMonthlyClicks($thisY, $thisM, $LOGIN_ID, 1);
$pays_1 = countMonthlyPays($thisY, $thisM, $LOGIN_ID, 1);
// 指定月の投稿広告のデータを取得
$pays_2 = countMonthlyPays($thisY, $thisM, $LOGIN_ID, 2);

$past_cnt_click = countPastClicks($thisY, $thisM, $LOGIN_ID);
$past_pays_0 = countPastPays($thisY, $thisM, $LOGIN_ID, 0);
$past_pays_1 = countPastPays($thisY, $thisM, $LOGIN_ID, 1);
$past_pays_2 = countPastPays($thisY, $thisM, $LOGIN_ID, 2);


$startdt = $_POST['startdt'];
$enddt = $_POST['enddt'];


$termHtml = date('Y年m月d日', strtotime("first day of this month"))."〜".date('m月d日', strtotime("now"));

$offsetPage = 0;
$limitPage = 5;
$crntPage = empty($_POST['page']) ? 1: $_POST['page'];


//検索結果件数を取得
$cnt = countAccess($startdt, $enddt, $LOGIN_ID);

//ページ数を計算
$pages = ceil($cnt / $limitPage);

//オフセットページ
$offsetPage = ($crntPage - 1) * $limitPage;



$pagerhtml='<div class="pager flex">';
if ($offsetPage==0) {
    $pagerhtml .= '<a href="javascript:void(0)" class="prev"></a>';
} else {
    $pagerhtml .= '<a href="javascript:paging('.($crntPage - 1).')" class="prev"></a>';
}

$pagerhtml .= '<p class="pager-num">'.$cnt.'件中<br>'.$crntPage.'/'.$pages .'ページ</p>';

if ($crntPage==$pages || $pages==0) {
    $pagerhtml .= '<a href="javascript:void(0)" class="next"></a>';
} else {
    $pagerhtml .= '<a href="javascript:paging('.($crntPage + 1).')" class="next"></a>';
}
$pagerhtml .= '</div>';


$accss = getAccessLimit($startdt, $enddt, $LOGIN_ID, $limitPage, $offsetPage);

$adHtml='<div class="affiliate_rowList">';
foreach ($accss as $ad) {
    $adHtml.='<div class="row">';
    $adHtml.='<a href="x10u_offer_detail.php?id='.$ad->adware.'">';
    if ($ad->adware_type=="0") {
        $adHtml .= '<p class="label"><span class="bg_pink">目標達成</span>';
    } else {
        $adHtml .= '<p class="label"><span class="bg_grn">クリック</span>';
    }
    if ($ad->isFinish=="1") {
        $adHtml .= '<span class="bg_gry_dark2">掲載終了</span>';
    }
    $adHtml .= '<span class="time">'.date('Y-m-d H:i:s', $ad->regist).'</span></p>';

    $wk = $ad->approvable=="1" ? '<span class="ap">承</span>' : '';
    $adHtml.='<p class="row_text">'.$wk.$ad->name.'</p>';
    $adHtml.='</a>';
    $adHtml.='</div>';
}
$adHtml.='</div>';


?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>成果情報</title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
<link rel="stylesheet" href="./x10u/assets/css/result.css">
<script>
    function paging(vlu) {
        document.frm.page.value = vlu;
        document.frm.submit();
    }
</script>
</head>

<body>

  <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

  <main class="main">

    <div class="mainheader">
      <p class="breadcrumbs">
        <a href="#">トップ</a>
        <a href="#">成果情報</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">成果情報</h1>
      </div>
    </div>

    <section class="sec-result section">
      <div class="section__inner container">
        <div class="result__table_wrap">
          <div class="tab-style_table_area">
            <ul class="tab-style flex-wrap js-tab_list">
              <li class="tab_item is-active">今月の成果</li>
              <li class="tab_item">これまでの成果</li>
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
                        <th>非認証</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                                            <td class="td-num"><?php echo(number_format($cnt_click_0 + $cnt_click_1)); ?>件</td>
                                            <td class="td-num"><?php echo(number_format($pays_0->cnt + $pays_1->cnt + $pays_2->cnt)); ?>件</td>
                                            <td class="td-num"><?php echo(number_format($pays_0->cnt2 + $pays_1->cnt2 + $pays_2->cnt2)); ?>件</td>
                                            <td class="td-num"><?php echo(number_format($pays_0->cst0 + $pays_0->cst1 + $pays_1->cst0 + $pays_1->cst1 + $pays_2->cst0 + $pays_2->cst1)); ?>円</td>
                                            <td class="td-num"><?php echo(number_format($pays_0->cst2 + $pays_1->cst2 + $pays_2->cst2)); ?>円</td>
                                            <td class="td-num">
                                                <?php echo($pays_0->cnt0 + $pays_0->cnt1 + $pays_1->cnt0 + $pays_1->cnt1 + $pays_2->cnt0 + $pays_2->cnt1); ?>件
                                            </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-style_content tab_content">
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
            <td class="td-num"><?php echo(number_format($past_cnt_click)); ?>件</td>
            <td class="td-num"><?php echo(number_format($past_pays_0->cnt + $past_pays_1->cnt + $past_pays_2->cnt)); ?>件</td>
            <td class="td-num"><?php echo(number_format($past_pays_0->cnt2 + $past_pays_1->cnt2 + $past_pays_2->cnt2)); ?>件
            </td>
            <td class="td-num"><?php echo(number_format($past_pays_0->cst0 + $past_pays_0->cst1 + $past_pays_1->cst0 + $past_pays_1->cst1 + $past_pays_2->cst0 + $past_pays_2->cst1)); ?>円
            </td>
            <td class="td-num"><?php echo(number_format($past_pays_0->cst2 + $past_pays_1->cst2 + $past_pays_2->cst2)); ?>円
            </td>
            <td class="td-num"><?php echo(number_format($past_pays_0->cnt0 + $past_pays_0->cnt1 + $past_pays_1->cnt0 + $past_pays_1->cnt1 + $past_pays_2->cnt0 + $past_pays_2->cnt1)); ?>件
            </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="sec-result-type section">
      <div class="section__inner container">
        <h3 class="bar-title"><span class="bar-title-text">報酬別成果情報</span></h3>
        <div class="dl-style">
          <dl>
            <dt>目的達成報酬</dt>
            <dd>
              <ul class="result__type_btn_list cmn__column2_btn_list flex">
                <li class="result__type_btn_item cmn__column2_btn_item"><a href="./x10u_result_monthry.php?adtype=0" class="bg_blu">月別</a></li>
                <li class="result__type_btn_item cmn__column2_btn_item"><a href="./x10u_result_occurrence.php?adtype=0" class="bg_blu">発生別</a></li>
              </ul>
            </dd>
          </dl>
          <dl>
            <dt>クリック報酬</dt>
            <dd>
              <ul class="result__type_btn_list flex">
                <li class="result__type_btn_item cmn__column2_btn_item"><a href="./x10u_result_monthry.php?adtype=1" class="bg_blu">月別</a></li>
                <li class="result__type_btn_item cmn__column2_btn_item"><a href="./x10u_result_occurrence.php?adtype=1" class="bg_blu">発生別</a></li>
              </ul>
            </dd>
          </dl>
          <dl>
            <dt>投稿報酬</dt>
            <dd>
              <ul class="result__type_btn_list flex">
                <li class="result__type_btn_item cmn__column2_btn_item"><a href="./x10u_result_monthry.php?adtype=2" class="bg_blu">月別</a></li>
                <li class="result__type_btn_item cmn__column2_btn_item"><a href="./x10u_result_occurrence.php?adtype=2" class="bg_blu">発生別</a></li>
              </ul>
            </dd>
          </dl>
        </div>
      </div>
    </section>

    <section class="sec-access section">
      <div class="section__inner container">
        <h3 class="bar-title"><span class="bar-title-text">アクセスリスト</span></h3>
        <div class="search__contents_wrap">
          <div class="custom__btn_drop sp"><a class="js-drop_btn" href="">期間を選択</a></div>
          <div class="search__contents drop_contents">
            <form class="search__form" action="" method="post" name="frm">
              <div class="search__form_row_wrap access__form_row_wrap">
                <div class="form-row">
                  <span class="input_date_wrap"><input type="date" name="startdt" value="<?php echo $startdt; ?>" placeholder="日付を選択して下さい"><img class="icon_calendar" src="./x10u/assets/img/icon_calendar.svg" alt=""></span> から　
                </div>
                <div class="form-row">
                  <span class="input_date_wrap"><input type="date" name="enddt" value="<?php echo $enddt; ?>" placeholder="日付を選択して下さい"><img class="icon_calendar" src="./x10u/assets/img/icon_calendar.svg" alt=""></span> まで　
                </div>
                <div class="search__submit search__submit">
                  <input type="submit" value="表示する" class="input_base">
                    <input type="hidden" name="page" value="">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <section class="sec-newOffer section">
      <div class="section__inner container">

      <?php echo $pagerhtml; ?>

      <?php echo $adHtml; ?>

      <?php echo $pagerhtml; ?>
      

        <br><br>

        <div class="btn">
          <a href="/" class="bd_blu">トップへ戻る</a>
        </div>

      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
