<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';

// セッション再開
session_start();

$LOGIN_ID = $_SESSION[ $SESSION_NAME ];
if(empty($LOGIN_ID)){ header('Location: x10u_logoff.php'); }

//Timezone
date_default_timezone_set('Asia/Tokyo');

// エラーメッセージの初期化
$errorMessage = '';

$adtype =  isset($_GET['adtype']) ? $_GET['adtype'] : $_POST['adtype'] ;

$thisY = empty($_POST['thisY']) ? date('Y') : $_POST['thisY'];
$thisM = empty($_POST['thisM']) ? date('m') : $_POST['thisM'];
//$cnt_click = countMonthlyClicks($thisY, $thisM, $LOGIN_ID, $adtype);
//$pays = countMonthlyPaysGroups($thisY, $thisM, $LOGIN_ID, $adtype);
$pays = getPaysX10Monthly($thisY, $thisM, $LOGIN_ID);
$nextYM = date('Ym', strtotime(date($thisY.'-'.$thisM.'-1') . '+1 month'));
$lastYM = date('Ym', strtotime(date($thisY.'-'.$thisM.'-1') . '-1 month'));

$ads = getAdwaresRecentry(7);

$titleHtml='';
$backHtml='';
if ($adtype=="0") {
    $titleHtml .= '目標達成報酬成果一覧（月別）';
    $backHtml='<a href="x10u_result_occurrence.php?adtype=0" class="bd_blu">目的達成報酬（発生別）へ</a>';
} else {
    $titleHtml .= 'クリック報酬成果一覧（月別）';
    $backHtml='<a href="x10u_result_occurrence.php?adtype=1" class="bd_blu">クリック報酬（発生別）へ</a>';
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
                  <th>クリック</th>
                  <th>発生成果</th>
                  <th>確定成果</th>
                  <th>未確定成果</th>
                  <th>確定報酬</th>
                  <th>非認証</th>
                </tr>
              </thead>
              <tbody>
        <?php foreach($pays as $p){ ?>
        <?php if($p->adware_type==$adtype){ ?>
        <tr>
            <?php $stts = isAdwareFinish(getAdwareStatus($p->id));?>
            <?php $wk =  $stts =="0" ? "": "[終了]"; ?>
            <td><a href='x10u_offer_detail.php?id=<?php echo $p->id; ?>'><?php echo $wk.$p->name; ?></a></td>
            <?php $cnt = countMonthlyClicksAdwares($thisY, $thisM, $LOGIN_ID, $p->id); ?>
            <td><?php echo $cnt; ?>件</td>
            <td><?php echo $p->cnt; ?>件</td>
            <td><?php echo $p->cnt2; ?>件</td>
            <td><?php echo($p->cst0 + $p->cst1); ?>円</td>
            <td><?php echo $p->cst2; ?>円</td>
            <td><?php echo($p->cnt0 + $p->cnt1); ?>件</td>
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
            <input type="hidden" name="thisY" value="<?php echo substr($lastYM,0,4); ?>">
            <input type="hidden" name="thisM" value="<?php echo substr($lastYM,4); ?>">
            <input type="hidden" name="adtype" value="<?php echo $adtype; ?>">
        </form>
        <form action="" method="POST" name="frmN">
          <a href="javascript:frmN.submit()" class="next2">翌月へ</a>
            <input type="hidden" name="thisY" value="<?php echo substr($nextYM,0,4); ?>">
            <input type="hidden" name="thisM" value="<?php echo substr($nextYM,4); ?>">
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
