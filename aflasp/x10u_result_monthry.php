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

$adtype =  isset($_GET['adtype']) ? $_GET['adtype'] : $_POST['adtype'] ;

$thisY = empty($_POST['thisY']) ? date('Y') : $_POST['thisY'];
$thisM = empty($_POST['thisM']) ? date('m') : $_POST['thisM'];
//$cnt_click = countMonthlyClicks($thisY, $thisM, $LOGIN_ID, $adtype);
//$pays = countMonthlyPaysGroups($thisY, $thisM, $LOGIN_ID, $adtype);
if ($adtype=="2") {
    $pays = getPaysX10MonthlyAT2($thisY, $thisM, $LOGIN_ID);
} else {
    $pays = getPaysX10Monthly($thisY, $thisM, $LOGIN_ID);
}
$nextYM = date('Ym', strtotime(date($thisY.'-'.$thisM.'-1') . '+1 month'));
$lastYM = date('Ym', strtotime(date($thisY.'-'.$thisM.'-1') . '-1 month'));

$ads = getAdwaresRecentry(7);

$titleHtml='';
$backHtml='';
if ($adtype=="0") {
    $titleHtml .= '成果報酬報酬成果一覧（月別）';
    $backHtml='<a href="x10u_result_occurrence.php?adtype=0" class="bd_blu">目的達成報酬（発生別）へ</a>';
} elseif ($adtype=="1") {
    $titleHtml .= 'クリック報酬成果一覧（月別）';
    $backHtml='<a href="x10u_result_occurrence.php?adtype=1" class="bd_blu">クリック報酬（発生別）へ</a>';
} elseif ($adtype=="2") {
    $titleHtml .= '投稿報酬成果一覧（月別）';
    $backHtml='<a href="x10u_result_occurrence.php?adtype=2" class="bd_blu">投稿報酬（発生別）へ</a>';
}

$yHtml='';
for ($i = 2020; $i <= date('Y'); $i++) {
    $sd = $i==$thisY ? ' selected' : '';
    $yHtml.="<option value='".$i."' ".$sd.">".$i."</option>";
}

$mHtml='';
for ($i = 1; $i <= 12; $i++) {
    $sd = $i==($thisM*1) ? ' selected' : '';
    $mHtml.="<option value='".sprintf('%02d', $i)."' ".$sd.">".sprintf('%02d', $i)."</option>";
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
<title><?php echo $titleHtml; ?></title>
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
        <a href="#"><?php echo $titleHtml; ?></a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title"><?php echo $titleHtml; ?></h1>
      </div>
    </div>

    <section class="sec-search section">
      <div class="section__inner container">
        <h3 class="bar-title"><span class="bar-title-text"><?php echo $thisY; ?>年<?php echo $thisM; ?>月の成果一覧</span></h3>
        <div class="search__contents_wrap">
          <div class="custom__btn_drop sp"><a class="js-drop_btn" href="">月を選択</a></div>
          <div class="search__contents drop_contents">
            <form class="search__form" action="" method="post">
              <div class="search__form_row_wrap">
                <div class="search__select_wrap">
                  <select class="" name="thisY">
                    <option value="">西暦を選択</option>
                    <?php echo $yHtml; ?>
                  </select>　
                </div>
                <span>　</span>
                <div class="search__select_wrap">
                  <select class="" name="thisM">
                    <option value="">月を選択</option>
                    <?php echo $mHtml; ?>
                  </select>　
                </div>
                <div class="access__submit search__submit">
                  <input type="submit" value="表示する" class="input_base">
    <input type="hidden" name="adtype" value="<?php echo $adtype; ?>">
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="result__table_wrap">
          <div class="table_wrap">
            <table class="table-style">
              <thead>
                <tr>
                  <th>案件名</th>
                  <?php if ($adtype<>"2") { ?>
                    <th>クリック</th>
                  <?php } ?>
                  <th>発生成果</th>
                  <?php if ($adtype=="2") { ?>
                    <th>確定待ち成果</th>
                  <?php } ?>
                  <th>確定成果</th>
                  <th>未確定成果</th>
                  <th>確定報酬</th>
                  <th>非認証</th>
                </tr>
              </thead>
              <tbody>
        <?php foreach ($pays as $p) { ?>
        <?php if ($p->adware_type==$adtype) { ?>
        <tr>
            <?php $stts = isAdwareFinish(getAdwareStatus($p->id));?>
            <?php $wk =  $stts =="0" ? "": "[終了]"; ?>
            <td><a href='x10u_offer_detail.php?id=<?php echo $p->id; ?>'><?php echo $wk.$p->name; ?></a></td>
            <?php $cnt = countMonthlyClicksAdwares($thisY, $thisM, $LOGIN_ID, $p->id); ?>
            <?php if ($p->adware_type<>"2") { ?>
                <td><?php echo $cnt; ?>件</td>
                <td><?php echo $p->cnt; ?>件</td>
                <td><?php echo $p->cnt2; ?>件</td>
                <td><?php echo number_format($p->cst0 + $p->cst1); ?>円</td>
                <td><?php echo number_format($p->cst2); ?>円</td>
                <td><?php echo($p->cnt1); ?>件</td>
            <?php } else { ?>
                <td class="td-num"><?php echo number_format($p->cnt0); ?>件</td>
                <td class="td-num"><?php echo number_format($p->cnt2); ?>件</td>
                <td class="td-num"><?php echo number_format($p->cnt3); ?>件</td>
                <td class="td-num"><?php echo number_format($p->cst2); ?>円</td>
                <td class="td-num"><?php echo number_format($p->cst3); ?>円</td>
                <td class="td-num"><?php echo number_format($p->cnt1); ?>件</td>
        <?php } ?>
        </tr>
        <?php } ?>
        <?php } ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="pager flex">
        <form action="" method="POST" name="frmL">
          <a href="javascript:frmL.submit()" class="prev2">前月へ</a>
            <input type="hidden" name="thisY" value="<?php echo substr($lastYM, 0, 4); ?>">
            <input type="hidden" name="thisM" value="<?php echo substr($lastYM, 4); ?>">
            <input type="hidden" name="adtype" value="<?php echo $adtype; ?>">
        </form>
        <form action="" method="POST" name="frmN">
          <a href="javascript:frmN.submit()" class="next2">翌月へ</a>
            <input type="hidden" name="thisY" value="<?php echo substr($nextYM, 0, 4); ?>">
            <input type="hidden" name="thisM" value="<?php echo substr($nextYM, 4); ?>">
            <input type="hidden" name="adtype" value="<?php echo $adtype; ?>">
        </form>
        </div>

        <br><br>

        <div class="result__link_btn_list">
          <div class="btn"><a href="./x10u_result_list.php" class="bd_blu">成果情報トップへ戻る</a></div>
          <div class="btn"><?php echo $backHtml; ?></div>
        </div>

      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
