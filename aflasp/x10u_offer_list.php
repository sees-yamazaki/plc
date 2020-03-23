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

$category = $_POST['category'];
$adware_type = $_POST['adware_type'];
$approvable = $_POST['approvable'];
$apprv = $_POST['apprv'];
$isPaging = $_POST['isPaging'];


$offsetPage = 0;
$limitPage = 10;
$crntPage = empty($_POST['page']) ? 1: $_POST['page'];

if (!isset($_POST['run'])) {
    $apprv=9; //初期表示
} elseif ($isPaging=="1" && $apprv==9) {
    $apprv=9; //初期表示のページング
} else {
    $apprv=1;
}

$adtyped = array('','','');
$aprved = array('','','');


if (isset($_POST['run'])) {
    $tmp = array();

    if (!empty($category)) {
        $tmp[] = "(category='".$category."')";
    }

    foreach ((array)$adware_type as $at) {
        if ($at=="0") {
            $tmp3[] = "(adware_type=0)";
            $adtyped[0]= " checked";
        } elseif ($at=="1") {
            $tmp3[] = "(adware_type=1)";
            $adtyped[1]= " checked";
        }
    }
    if (!empty($tmp3)) {
        $tmp[] = "(".implode(" OR ", $tmp3).")";
    }

    if (count($tmp)>0) {
        $where .= " AND ".implode(" AND ", $tmp);
    }
}


if ($apprv==1) {
    if (is_array($approvable)) {
        $where .=  " AND (approvable=1) ";
        $aprved[1]= " checked";
    } else {
        $where .= " AND (approvable=0) ";
    }
}
$where .= " AND (isFinish=0) ";

//検索結果件数を取得
$cnt = countAdwares($where);

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



$adHtml='<div class="affiliate_rowList">';
$ads = getAdwaresLimit($where, $limitPage, $offsetPage);
foreach ($ads as $ad) {
    $adHtml.='<div class="row">';
    $adHtml.='<a href="x10u_offer_detail.php?id='.$ad->id.'">';
    if ($ad->adware_type=="0") {
        $adHtml .= '<p class="label"><span class="bg_pink">目標達成</span></p>';
    } else {
        $adHtml .= '<p class="label"><span class="bg_grn">クリック</span></p>';
    }
    $wk = $ad->approvable=="1" ? '<span class="ap">承</span>' : '';
    $adHtml.='<p class="row_text">'.$wk.$ad->name.'</p>';
    $adHtml.='</a>';
    $adHtml.='</div>';
}
$adHtml.='</div>';


$html="<option value=''>選択しない</option>";
$categories = getCategories();
foreach ($categories as $cat) {
    $wk = in_array($cat->id, (array)$category) ? " selected" : "";
    $html .= "<option  value='".$cat->id."' ".$wk.">".$cat->name."</option>";
}



?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>オファー一覧</title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
<link rel="stylesheet" href="./x10u/assets/css/offer_list.css">
<script>
function paging(vlu) {
    document.frm.page.value = vlu;
    document.frm.isPaging.value = 1;
    document.frm.reset();
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
        <a href="#">オファー一覧</a>
      </p>
    </div>

    <section class="sec-search section">
      <div class="section__inner container">
        <h2 class="sec-title"><span class="icon_note"></span>オファー一覧</h2>
        <div class="search__contents_wrap">
          <div class="search__btn_drop"><a class="js-drop_btn" href="">絞り込んで検索</a></div>
          <div class="search__contents drop_contents">
            <form action="" method="POST" name="frm">
              <div class="search__contents_block">
                <h3 class="bar-title"><span class="bar-title-text">オファー種別</span></h3>
                <div class="search__offer-type flex-wrap">
                  <label class="offer-type_label">
                    <input type="checkbox" name="adware_type[]" value="0" <?php echo $adtyped[0]; ?>>
                    <span class="box">
                      <span class="icon icon-handshake">
                        <img class="off" src="./x10u/assets/img/icon_handshake.svg" alt="">
                        <img class="on" src="./x10u/assets/img/icon_handshake_wh.svg" alt="">
                      </span>
                      <span class="text">目標達成<br>報酬タイプ</span>
                    </span>
                  </label>
                  <label class="offer-type_label">
                    <input type="checkbox" name="adware_type[]" value="1" <?php echo $adtyped[1]; ?>>
                    <span class="box">
                      <span class="icon icon-window">
                        <img class="off" src="./x10u/assets/img/icon_window.svg" alt="">
                        <img class="on" src="./x10u/assets/img/icon_window_wh.svg" alt="">
                      </span>
                      <span class="text">クリック<br>報酬タイプ</span>
                    </span>
                  </label>
                  <!--
                  <label class="offer-type_label">
                    <input type="checkbox" name="adware_type[]" value="0">
                    <span class="box">
                      <span class="icon icon-article">
                        <img class="off" src="./x10u/assets/img/icon_article.svg" alt="">
                        <img class="on" src="./x10u/assets/img/icon_article_wh.svg" alt="">
                      </span>
                      <span class="text">投稿<br>報酬タイプ</span>
                    </span>
                  </label>-->
                </div>
                <div class="search__op_row flex">
                  <p class="op_row_text">承認制オファー</p>
                  <div class="op-switch">
                    <input type="checkbox" id="switch" name="approvable[]" value="1" <?php echo $aprved[1]; ?>>
                    <label for="switch"><span></span></label>
                    <div class="switch-ball"></div>
                  </div>
                </div>
              </div>
              <div class="search__contents_block">
                <h3 class="bar-title"><span class="bar-title-text">カテゴリ</span></h3>
                <div class="search__select_wrap">
                  <select name="category">
                      <?php  echo $html; ?>
                  </select>
                </div>
              </div>

              <div class="search__submit">
                <input type="submit" value="絞り込む" class="input_base">
                <input type="hidden" name="run" value="1">
                <input type="hidden" name="page" value="">
                <input type="hidden" name="isPaging" value="0">
                <input type="hidden" name="apprv" value="<?php echo $apprv ?>">
              </div>

            </form>

          </div>
        </div>
      </div>
    </section>

    <section class="sec-offer section">
      <div class="section__inner container">

        <?php echo $pagerhtml; ?>

        <?php echo $adHtml; ?>

        <?php echo $pagerhtml; ?>

      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
