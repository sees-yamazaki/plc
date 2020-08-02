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
!DOCTYPE html>
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

  <header class="header">
  <div class="header__inner flex">
        <h1 class="header__logo"><a href="x10u_mypage.php"><img src="./x10u/assets/img/logo.png" alt="smafee スマフィー"></a></h1>
<div class="header__btn_mypage"><a href="./x10u_mypage.php"><span class="mypage_text">MY<br class="sp">PAGE</span></a></div>
<div class="header__menu">
  <nav class="header__gnavi">
    <div class="header__gnavi_group">
      <p class="header__gnavi_group_title">Offer</p>
      <ul class="header__gnavi_list flex-wrap">
        <li><a href="./x10u_offer_list.php">オファー一覧</a></li>
        <!--<li><a href="./x10n_adwares_search.php">新着オファー一覧</a></li>-->
        <li><a href="./x10u_adwares_list_secret.php">承認制オファー概要</a></li>
      </ul>
    </div>
    <div class="header__gnavi_group">
      <p class="header__gnavi_group_title">Data</p>
      <ul class="header__gnavi_list flex-wrap">
        <li><a href="./x10u_result_list.php">成果情報</a></li>
      </ul>
    </div>
    <div class="header__gnavi_group">
      <p class="header__gnavi_group_title">Conf</p>
      <ul class="header__gnavi_list flex-wrap">
        <li><a href="./x10u_user.php">設定変更</a></li>
      </ul>
    </div>
    <div class="header__gnavi_group">
      <p class="header__gnavi_group_title">Info.</p>
      <ul class="header__gnavi_list flex-wrap">
        <li><a href="./x10u_howto.php">スマフィーのはじめかた</a></li>
        <li><a href="./x10u_faq.php">よくある質問</a></li>
        <li><a href="./x10u_company.php">運営会社</a></li>
        <li><a href="./x10u_terms.php">利用規約</a></li>
        <li><a href="./x10u_privacy.php">プライバシーポリシー</a></li>
      </ul>
    </div>
    <div class="header__gnavi_btn"><a class="bg_blu" href="./x10u_logoff.php">ログオフ</a></div>
    <div class="header__gnavi_contact"><a href="./x10u_contact.php"><span class="icon_mail">お問い合わせ</span></a></div>
  </nav>
</div>
      </div>
  <div class="js-btn_gnaviMenu btn_gnaviMenu sp"><i></i></div>
</header>

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
        <div class="dl-style">
          <dl>
            <dt>来月振込予定</dt>
            <dd>あり/なし</dd>
          </dl>
          <dl>
            <dt>繰越金額合計</dt>
            <dd>0000円</dd>
          </dl>
        </div>
      </div>
    </section>
    <section class="sec-fee-report section">
      <div class="section__inner container">
        <h3 class="bar-title"><span class="bar-title-text">2020年のレポート</span></h3>
        <div class="search__contents_wrap">
          <div class="custom__btn_drop sp"><a class="js-drop_btn" href="">表示期間を選択</a></div>
          <div class="search__contents drop_contents">
            <form class="search__form" action="" method="post">
              <div class="search__form_row_wrap">
                <div class="search__select_wrap">
                  <select class="" name="thisY">
                    <option value="">西暦を選択</option>
                    <option value='2020'  selected>2020</option>                  </select>　
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
レポート最終更新日：2020年X月X日 13時28分<br>
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
    
        
        <tr class="odd">
        
        <td>
        
        2020年07月
        </td>
        <td class="sitename">
        
        
        2020年05月
        </td>
        <td>
        
        1
        </td>
        <td>
        
        
        
        1
        
        </td>
        <td>
          
          
          
          0
          
        </td>

        <td>
          
          23
        </td>
        <td>
        
        24
        </td>
        <td>
        
        0
        </td>
        <td class="bold bgcheck">
          
          0
        </td>
        <td>
          
          24
        </td>
        </tr>
    
        
        <tr class="even">
        
        <td>
        
        2020年06月
        </td>
        <td class="sitename">
        
        
        2020年04月
        </td>
        <td>
        
        0
        </td>
        <td>
        
        
        
        0
        
        </td>
        <td>
          
          
          
          0
          
        </td>

        <td>
          
          23
        </td>
        <td>
        
        23
        </td>
        <td>
        
        0
        </td>
        <td class="bold bgcheck">
          
          0
        </td>
        <td>
          
          23
        </td>
        </tr>
    
        
        <tr class="odd">
        
        <td>
        
        2020年05月
        </td>
        <td class="sitename">
        
        
        2020年03月
        </td>
        <td>
        
        0
        </td>
        <td>
        
        
        
        0
        
        </td>
        <td>
          
          
          
          0
          
        </td>

        <td>
          
          23
        </td>
        <td>
        
        23
        </td>
        <td>
        
        0
        </td>
        <td class="bold bgcheck">
          
          0
        </td>
        <td>
          
          23
        </td>
        </tr>
    
        
        <tr class="even">
        
        <td>
        
        2020年04月
        </td>
        <td class="sitename">
        
        
        2020年02月
        </td>
        <td>
        
        0
        </td>
        <td>
        
        
        
        0
        
        </td>
        <td>
          
          
          
          0
          
        </td>

        <td>
          
          23
        </td>
        <td>
        
        23
        </td>
        <td>
        
        0
        </td>
        <td class="bold bgcheck">
          
          0
        </td>
        <td>
          
          23
        </td>
        </tr>
    
        
        <tr class="odd">
        
        <td>
        
        2020年03月
        </td>
        <td class="sitename">
        
        
        2020年01月
        </td>
        <td>
        
        1
        </td>
        <td>
        
        
        
        1
        
        </td>
        <td>
          
          
          
          0
          
        </td>

        <td>
          
          22
        </td>
        <td>
        
        23
        </td>
        <td>
        
        0
        </td>
        <td class="bold bgcheck">
          
          0
        </td>
        <td>
          
          23
        </td>
        </tr>
    
        
        <tr class="even">
        
        <td>
        
        2020年02月
        </td>
        <td class="sitename">
        
        
        2019年12月
        </td>
        <td>
        
        2
        </td>
        <td>
        
        
        
        2
        
        </td>
        <td>
          
          
          
          0
          
        </td>

        <td>
          
          20
        </td>
        <td>
        
        22
        </td>
        <td>
        
        0
        </td>
        <td class="bold bgcheck">
          
          0
        </td>
        <td>
          
          22
        </td>
        </tr>
    
        
        <tr class="odd">
        
        <td>
        
        2020年01月
        </td>
        <td class="sitename">
        
        
        2019年11月
        </td>
        <td>
        
        2
        </td>
        <td>
        
        
        
        2
        
        </td>
        <td>
          
          
          
          0
          
        </td>

        <td>
          
          18
        </td>
        <td>
        
        20
        </td>
        <td>
        
        0
        </td>
        <td class="bold bgcheck">
          
          0
        </td>
        <td>
          
          20
        </td>
        </tr>
    
    </tbody>
</table>

          </div>
        </div>


        <div class="result__link_btn_list">
        	表示データをダウンロード: CSV | Excel
        </div>

      </div>
    </section>

  </main>

  <footer class="footer">
      <a class="pagetop" href="#"><img src="./x10u/assets/img/icon_arw_blu_t.png" alt=""></a>
  <div class="footer__inner">
          <h3 class="footer__logo"><a href="x10u_mypage.php"><img src="./x10u/assets/img/logo_wh.png" alt=""></a></h3>
        <p class="copyright">COPYRIGHT (C) smafee ALL RIGHTS RESERVED.</p>
  </div>
</footer>

</body>
</html>
