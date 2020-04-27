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



$pays = getPayLimit($startdt, $enddt, $LOGIN_ID, $adtype, $limitPage, $offsetPage);

$titleHtml='';
$backHtml='';
if ($adtype=="0") {
    $titleHtml .= '目標達成報酬（発生別）';
    $backHtml='<a href="x10u_result_monthry.php?adtype=0" class="bd_blu">目的達成報酬（月別）へ</a>';
} elseif ($adtype=="1") {
    $titleHtml .= 'クリック報酬（発生別）';
    $backHtml='<a href="x10u_result_monthry.php?adtype=1" class="bd_blu">クリック報酬（月別）へ</a>';
} elseif ($adtype=="2") {
    $titleHtml .= '投稿報酬（発生別）';
    $backHtml='<a href="x10u_result_monthry.php?adtype=2" class="bd_blu">投稿報酬（月別）へ</a>';
}

$txt_state = array('認定中','非認証','認証');

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title><?php echo $titleHtml; ?></title>
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
        <h3 class="bar-title"><span class="bar-title-text">発生別一覧</span></h3>
        <div class="search__contents_wrap">
          <div class="custom__btn_drop sp"><a class="js-drop_btn" href="">期間を選択</a></div>
          <div class="search__contents drop_contents">
            <form class="search__form" action="" method="post" name="frm">
              <div class="search__form_row_wrap access__form_row_wrap">
                <div class="form-row">
                  <span class="input_date_wrap"><input type="date" name="startdt"
            value="<?php echo $startdt; ?>" placeholder="日付を選択して下さい"><img class="icon_calendar" src="./x10u/assets/img/icon_calendar.svg" alt=""></span> から　
                </div>
                <div class="form-row">
                  <span class="input_date_wrap"><input type="date" name="enddt"
            value="<?php echo $enddt; ?>" placeholder="日付を選択して下さい"><img class="icon_calendar" src="./x10u/assets/img/icon_calendar.svg" alt=""></span> まで　
                </div>
                <div class="search__submit search__submit">
                  <input type="submit" value="表示する" class="input_base">
        <input type="hidden" name="page" value=""><br>
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
                  <th>日付</th>
                  <th>案件名</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
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
              </tbody>
            </table>
          </div>
        </div>


        <?php echo $pagerhtml; ?>

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
