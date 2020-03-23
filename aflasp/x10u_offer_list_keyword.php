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

$tag = empty($_GET['tag']) ? $_POST['tag'] : $_GET['tag'];
$id = empty($_GET['id']) ? $_POST['id'] : $_GET['id'];


$offsetPage = 0;
$limitPage = 5;
$crntPage = empty($_POST['page']) ? 1: $_POST['page'];

$ads = array();

$where = " AND keyword LIKE '%".$tag."%'";

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
        <h2 class="sec-title"><span class="icon_note"></span>【<?php echo $tag; ?>】のオファー一覧</h2>
    <form action="" method="POST" name="frm">
        <input type="hidden" name="page" value="">
        <input type="hidden" name="tag" value="<?php echo $tag; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
    </form>
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
