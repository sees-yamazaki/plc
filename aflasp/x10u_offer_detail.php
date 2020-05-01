<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/adwares.php';
include 'x10c/db/x10.php';
include 'x10c/db/system.php';

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

$id_title = substr($id, 0, 1)=="A" ? 'adwares' : 's_adwares';

$ad = getAdware($id);

if ($ad->stts==0 || $ad->stts==10) {
    $limits = is_null($ad->limits) ? 0 :$ad->limits;
    $money_count = is_null($ad->money_count) ? 0 :$ad->money_count;
    if ($limits>0 && ($limits*0.7)<$money_count) {
        $ad->stts = $ad->stts + 1;
    }
}

if (isset($_GET['req'])) {
    if ($_GET['req']=="0") {
        $ofr = getOfferStatus($id, $LOGIN_ID);
        if (is_null($ofr->status)) {
            $ofr = new cls_offer();
            $ofr->adware = $id;
            $ofr->nuser = $LOGIN_ID ;
            $ofr->status = "0";
            insertX10Offer($ofr);
        }
    } elseif ($_GET['req']=="2") {
        updateX10Offer($id, $LOGIN_ID, 10);
    } elseif ($_GET['req']=="3") {
        updateX10Offer($id, $LOGIN_ID, 2);
    } else {
        $ofr = new cls_offer();
        $ofr->adware = $id;
        $ofr->nuser = $LOGIN_ID ;
        deleteX10Offer($ofr);
    }
}

$titleHtml = '';
$titleHtml .= '<div class="article__section_title">';
if ($ad->adware_type=="0") {
    $titleHtml .= '<p class="label"><span class="bg_pink">目標達成</span></p>';
} elseif ($ad->adware_type=="1") {
    $titleHtml .= '<p class="label"><span class="bg_grn">クリック</span></p>';
} elseif ($ad->adware_type=="2") {
    $titleHtml .= '<p class="label"><span class="bg_gld">投稿</span></p>';
}
$titleHtml .= '<h2 class="article__title">'.$ad->name.'</h2>';
if ($ad->approvable=="1") {
    $titleHtml .= '<p class="label-op bg_orn">承認制</p>';
}
$titleHtml .= '<div class="article__img"><img src="'.$ad->banner.'" alt=""></div>';
$titleHtml .= '<div class="article__section article__section_price">';
if ($ad->click_money>0) {
    $titleHtml .= '<h3 class="bar-title"><span class="bar-title-text">クリック単価</span></h3>';
    $titleHtml .= '<p class="price"><span class="num">'.number_format($ad->click_money).'</span>円/クリック</p>';
} else {
    $titleHtml .= '<h3 class="bar-title"><span class="bar-title-text">報酬単価</span></h3>';
    $titleHtml .= '<p class="price"><span class="num">'.number_format($ad->money).'</span>円/件</p>';
}
$titleHtml .= '</div>';

if ($ad->stts==22 || $ad->stts==21 || $ad->stts==20
  || $ad->stts==12 || $ad->stts==2) {
    $titleHtml .= '<div class="alert_box">';
    $titleHtml .= '<h4 class="alert_box_title"><span class="icon_chuui_pnk">このオファーは終了しています。</span></h4>';
    $titleHtml .= '<p class="alert_box_text">このオファーは終了しておりますので成果は計測されません</p>';
    $titleHtml .= '</div>';
}
if ($ad->stts==11 || $ad->stts==10) {
    $titleHtml .= '<div class="alert_box">';
    $titleHtml .= '<h4 class="alert_box_title"><span class="icon_chuui_pnk">このオファーは期間終了が近づいています。</span></h4>';
    $titleHtml .= '<p class="alert_box_text">期間終了後は成果が発生しませんのでご注意下さい</p>';
    $titleHtml .= '</div>';
}
if ($ad->stts==11 || $ad->stts==1) {
    $titleHtml .= '<div class="alert_box">';
    $titleHtml .= '<h4 class="alert_box_title"><span class="icon_chuui_pnk">このオファーは予算上限が近づいています。</span></h4>';
    $titleHtml .= '<p class="alert_box_text">予算上限到達後は成果が発生しませんのでご注意下さい</p>';
    $titleHtml .= '</div>';
}

$sys = getSystem();
$url = $sys->home;


//広告IDとユーザIDでHASHフォルダ名を決定する
$hashID = hash('fnv132', $LOGIN_ID.$id);

if (!file_exists("p/".$hashID)) {
    mkdir("p/".$hashID, 0777);

    // ファイルを書き込みモードで開く
    $file_handle = fopen("p/".$hashID."/index.php", "w");

    // ファイルへデータを書き込み
    if (substr($url, -1)=='/') {
        $url = substr($url, 0, -1);
    }
    $rhtml='<?php'.PHP_EOL;
    $rhtml.='header("location: '.$url .'/link.php?id='.$LOGIN_ID.'&'.$id_title .'='.$id.'");'.PHP_EOL;
    $rhtml.='exit();'.PHP_EOL;
    $rhtml.='?>';
    fwrite($file_handle, $rhtml);

    // ファイルを閉じる
    fclose($file_handle);
}

$sttsHtml='';
if ($ad->approvable=="0") {
    $sttsHtml='承認済';
} else {
    $ofr = getOfferStatus($id, $LOGIN_ID);
    if (is_null($ofr->status)) {
        $sttsHtml='未リクエスト';
    } elseif ($ofr->status=="0") {
        $sttsHtml='リクエスト申請中';
    } elseif ($ofr->status=="1") {
        $sttsHtml='非承認';
    } elseif ($ofr->status=="2") {
        $sttsHtml='承認済';
    }
}

$offerHtml='';
if ($ad->isFinish=="1") {
    //オファー終了
    $offerHtml.='このオファーの掲載期間は終了しています。<br>';
} elseif ($ad->approvable=="1") {
    $ofr = getOfferStatus($id, $LOGIN_ID);

    $offerHtml.='<h3 class="bar-title"><span class="bar-title-text">オファーに参加する</span></h3>';
    $offerHtml.='<div class="article__link_wrap">';

    if (is_null($ofr->status)) {
        $offerHtml.='<div class="article__link_block article__link_request-join">';
        $offerHtml.='<div class="btn"><a class="bg_grad_red" href="x10u_offer_detail.php?id='.$ad->id.'&req=0"><span class="icon_kamihikouki"></span>参加リクエスト</a></div>';
        $offerHtml.='</div>';
    } elseif ($ofr->status=="0") {
        $offerHtml.='<div class="article__link_block article__link_request-approval fukidashi-wrap">';
        $offerHtml.='<div class="fukidashi-bk fukidashi-load-fade js-fukidashi-load-fade">';
        $offerHtml.='<span class="icon_chuui"></span>リクエスト完了！';
        $offerHtml.='</div>';
        $offerHtml.='<div class="btn"><a class="bg_grad_grn" href="x10u_offer_detail.php?id='.$ad->id.'&req=1"><span class="icon_sunadokei"></span>リクエストを取り下げる</a></div>';
        $offerHtml.='</div>';
    } elseif ($ofr->status=="10") {
        $offerHtml.='<div class="article__link_block article__link_request-approval fukidashi-wrap">';
        $offerHtml.='<div class="fukidashi-bk fukidashi-load-fade js-fukidashi-load-fade">';
        $offerHtml.='<span class="icon_chuui"></span>報告完了！';
        $offerHtml.='</div>';
        $offerHtml.='<div class="btn"><a class="bg_grad_grn" href="x10u_offer_detail.php?id='.$ad->id.'&req=3"><span class="icon_sunadokei"></span>投稿報告を取り下げる</a></div>';
        $offerHtml.='</div>';
    } elseif ($ofr->status=="1" || $ofr->status=="11") {
        $offerHtml.='残念ながら承認されませんでした<br>';
    } elseif ($ofr->status=="2") {
        if ($ad->adware_type=="2") {
            $offerHtml.='<div class="article__link_block article__link_share">';
            $offerHtml.='<p class="share_text text-center">以下のURLを投稿しよう！</p>';
            if (substr($url, -1)=='/') {
                $url = substr($url, 0, -1);
            }
            $offerHtml.='<p class="js-copy_text copy_text">'.$url .'/p/'.$hashID.'</p>';
            $offerHtml.='<div class="fukidashi-wrap">';
            $offerHtml.='<div class="fukidashi-bk fukidashi-click-fade js-fukidashi-click-fade">';
            $offerHtml.='<span class="icon_chuui"></span>URLをコピーしました';
            $offerHtml.='</div>';
            $offerHtml.='</div>';
            $offerHtml.='<div class="btn js-copy_btn"><a class="bg_grad_orn" href=""><span class="icon_share"></span>URLをコピーする</a></div>';
            $offerHtml.='</div>';
            
            $offerHtml.='<div class="article__link_block article__link_share">';
            $offerHtml.='<p class="share_text text-center">以下のハッシュタグを投稿しよう！</p>';
            $offerHtml.='<p class="js-copy_text copy_text">'.$ad->hashtag.'</p>';
            $offerHtml.='<div class="fukidashi-wrap">';
            $offerHtml.='<div class="fukidashi-bk fukidashi-click-fade js-fukidashi-click-fade">';
            $offerHtml.='<span class="icon_chuui"></span>ハッシュタグをコピーしました';
            $offerHtml.='</div>';
            $offerHtml.='</div>';
            $offerHtml.='<div class="btn js-copy_btn"><a class="bg_grad_orn" href=""><span class="icon_share"></span>ハッシュタグをコピーする</a></div>';
            $offerHtml.='</div>';

            $offerHtml.='<div class="article__link_block article__link_request-join">';
            $offerHtml.='<div class="btn"><a class="bg_grad_red" href="x10u_offer_detail.php?id='.$ad->id.'&req=2"><span class="icon_kamihikouki"></span>投稿報告</a></div>';
            $offerHtml.='</div>';
        } else {
            $offerHtml.='<div class="article__link_block article__link_share">';
            $offerHtml.='<p class="share_text text-center">以下のURLを投稿しよう！</p>';
            if (substr($url, -1)=='/') {
                $url = substr($url, 0, -1);
            }
            $offerHtml.='<p class="js-copy_text copy_text">'.$url .'/p/'.$hashID.'</p>';
            $offerHtml.='<div class="fukidashi-wrap">';
            $offerHtml.='<div class="fukidashi-bk fukidashi-click-fade js-fukidashi-click-fade">';
            $offerHtml.='<span class="icon_chuui"></span>URLをコピーしました';
            $offerHtml.='</div>';
            $offerHtml.='</div>';
            $offerHtml.='<div class="btn js-copy_btn"><a class="bg_grad_orn" href=""><span class="icon_share"></span>URLをコピーする</a></div>';
            $offerHtml.='</div>';
        }
    }
    $offerHtml.='</div>';

//     $html .= '<br>';
} else {
    $offerHtml.='<h3 class="bar-title"><span class="bar-title-text">オファーに参加する</span></h3>';
    $offerHtml.='<div class="article__link_wrap">';
    $offerHtml.='<div class="article__link_block article__link_share">';
    $offerHtml.='<p class="share_text text-center">以下のURLを投稿しよう！</p>';
    if (substr($url, -1)=='/') {
        $url = substr($url, 0, -1);
    }
    $offerHtml.='<p class="js-copy_text copy_text">'.$url .'/p/'.$hashID.'</p>';
    $offerHtml.='<div class="fukidashi-wrap">';
    $offerHtml.='<div class="fukidashi-bk fukidashi-click-fade js-fukidashi-click-fade">';
    $offerHtml.='<span class="icon_chuui"></span>URLをコピーしました';
    $offerHtml.='</div>';
    $offerHtml.='</div>';
    $offerHtml.='<div class="btn js-copy_btn"><a class="bg_grad_orn" href=""><span class="icon_share"></span>URLをコピーする</a></div>';
    $offerHtml.='</div>';
    $offerHtml.='</div>';
//     $html .= '以下のURLを投稿しよう<br>';
//     if (substr($url, -1)=='/') {
//         $url = substr($url, 0, -1);
//     }
//     $html .= '<input type="text" id="url" value="'.$url .'/p/'.$hashID.'" readonly><br>';
// //    $html .= '<input type="text" id="url" value="'.$url .'/link.php?id='.$LOGIN_ID.'&'.$id_title .'='.$id.'" readonly><br>';
//     $html .= '<input type="button" onclick="document.getElementById(\'url\').select();document.execCommand(\'copy\');" value="URLをコピー"><br>';
}

// $html .= '成果条件<br>'.nl2br($ad->results).'<br>';
// $html .= '否認条件<br>'.nl2br($ad->denials).'<br>';
// $html .= 'NGキーワード<br>'.nl2br($ad->ngword).'<br>';
// $html .= '備考<br>'.nl2br($ad->note).'<br>';
// //$html .= 'キーワード<br>'.$ad->keyword.'<br>';
$keywordHtml='';
$tags = explode(' ', $ad->keyword);
foreach ($tags as $tag) {
    //$keywordHtml .= '<a class="text-link text-underline" href="x10n_adwares_search_tag.php?id='.$id.'&tag='.$tag.'">'.$tag.'</a> ';
    if (!empty($tag)) {
        $keywordHtml .= '<a class="text-link text-underline" href="x10u_offer_list_keyword.php?id='.$id.'&tag='.$tag.'">'.$tag.'</a> ';
    }
}
// $html .= '<br>';



?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title><?php echo $ad->name; ?></title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
<link rel="stylesheet" href="./x10u/assets/css/offer_detail.css">
</head>

<body>

  <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

  <main class="main">

    <div class="mainheader">
      <p class="breadcrumbs">
        <a href="./x10u_mypage.php">マイページTOP</a>
        <a href="./x10u_offer_list.php">オファー一覧</a>
        <a href="#"><?php echo $ad->name; ?></a>
      </p>
    </div>

    <section class="sec-article section">
      <div class="section__inner container">

        <?php echo $titleHtml; ?>


        <div class="article__section article__section_outline" id="url">
          <h3 class="bar-title"><span class="bar-title-text">オファー概要</span></h3>
          <p class="article__section_outline_text"><?php echo $ad->comment; ?></p>
          <?php if (mb_strlen($ad->comment)>120) { ?>
          <div class="filter-cover sp"></div>
          <p class="js-btn-filter btn-filter-off f-blu sp">続きを読む</p>
          <?php } ?>
        </div>
        <div class="article__section">
            <?php echo $offerHtml; ?>
          <!--<h3 class="bar-title"><span class="bar-title-text">オファーに参加する</span></h3>
          <div class="article__link_wrap">
            <div class="article__link_block article__link_request-join">
              <div class="btn"><a class="bg_grad_red" href=""><span class="icon_kamihikouki"></span>参加リクエスト</a></div>
            </div>
            <div class="article__link_block article__link_request-approval">
              <div class="article__link_request-complete text-center">
                <div class="fukidashi-bk">
                  <span class="icon_chuui"></span>リクエスト完了！
                </div>
              </div>
              <div class="btn"><a class="bg_grad_grn" href=""><span class="icon_sunadokei"></span>リクエスト承認待ち</a></div>
            </div>
            <div class="article__link_block article__link_share">
              <p class="share_text text-center">以下のURLを投稿しよう！</p>
              <p class="js-copy_text copy_text">https://test.com/p3ikmm,m</p>
              <div class="btn js-copy_btn"><a class="bg_grad_orn" href=""><span class="icon_share"></span>URLをコピーする</a></div>
            </div>
          </div>-->
          <div class="article__info dl-style">
            <dl>
              <dt>カテゴリ</dt>
              <dd><?php echo $ad->category_name; ?></dd>
            </dl>
            <dl>
              <dt>成果条件</dt>
              <dd><?php echo empty($ad->results) ? "なし" : nl2br($ad->results); ?></dd>
            </dl>
            <dl>
              <dt>否認条件</dt>
              <dd><?php echo empty($ad->denials) ? "なし" : nl2br($ad->denials); ?></dd>
            </dl>
            <dl>
              <dt>NGキーワード</dt>
              <dd><?php echo empty($ad->ngword) ? "なし" : nl2br($ad->ngword); ?></dd>
            </dl>
            <dl>
              <dt>備考</dt>
              <dd><?php echo empty($ad->note) ? "なし" : nl2br($ad->note); ?></dd>
            </dl>
            <dl>
              <dt>オファー承認審査</dt>
              <dd><?php echo $ad->approvable=="1" ? "あり" : "なし"; ?></dd>
            </dl>
            <dl>
              <dt>オファー承認審査状態</dt>
              <dd><?php echo $sttsHtml; ?></dd>
            </dl>
            <dl>
              <dt>キーワード</dt>
              <dd><?php echo empty($keywordHtml) ? "なし" : $keywordHtml; ?></dd>
            </dl>
            <dl>
              <dt>リンク先ページの確認</dt>
              <dd><a class="text-link text-underline" target="_blank" href="<?php echo $ad->url; ?>">リンク先ページを開く<span class="icon_gaibulink"></span></a></dd>
            </dl>
            <dl>
              <dt>オファー登録日</dt>
              <dd><?php echo date('Y/m/d', $ad->regist); ?></dd>
            </dl>
            <dl>
              <dt>オファー期間</dt>
              <dd><?php echo empty($ad->enddt) ? "なし" : date('Y/m/d', strtotime($ad->startdt)).'〜'.date('Y/m/d', strtotime($ad->enddt)); ?></dd>
            </dl>
          </div>
        </div>
      </div>
    </section>

    <div class="pagelink_block flex">
      <a href="./x10u_offer_list.php" class="text-link text-underline">オファー一覧ページへ</a>
      <a href="" class="text-link text-underline"></a>
    </div>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
