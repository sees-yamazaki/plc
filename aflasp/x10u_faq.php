<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';

// セッション再開
session_start();

//Timezone
date_default_timezone_set('Asia/Tokyo');


?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>よくある質問</title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
</head>

<body>

  <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

  <main class="main">

    <div class="mainheader">
      <p class="breadcrumbs">
        <a href="/">トップ</a>
        <a href="./">よくある質問</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">よくある質問</h1>
      </div>
    </div>

    <section class="sec-faq section">
      <div class="sec__inner">
        <div class="faq__contents">
          <div class="cmn_page__link_nav">
            <ul class="flex-wrap container">
              <li class="item"><a href="#group01">スマフィーについて</a></li>
              <li class="item"><a href="#group02">成果について</a></li>
              <li class="item"><a href="#group03">オファーについて</a></li>
              <li class="item"><a href="#group04">そのほか</a></li>
            </ul>
          </div>
        </div>
        <div id="group01" class="faq__group section">
          <div class="sec-logo-title js-inview inview_fadeUp">
            <h2 class="title bg_grad_pnk">スマフィーについて</h2>
          </div>
          <div class="faq__group-list container js-inview inview_fadeUp">
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">スマフィーとは何ですか？</div>
              <div class="faq__group-row-a">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</div>
            </div>
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</div>
              <div class="faq__group-row-a">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</div>
            </div>
          </div>
        </div>
        <div id="group02" class="faq__group section">
          <div class="sec-logo-title js-inview inview_fadeUp">
            <h2 class="title bg_grad_pnk">成果について</h2>
          </div>
          <div class="faq__group-list container js-inview inview_fadeUp">
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">スマフィーとは何ですか？</div>
              <div class="faq__group-row-a">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</div>
            </div>
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</div>
              <div class="faq__group-row-a">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</div>
            </div>
          </div>
        </div>
        <div id="group03" class="faq__group">
          <div class="sec-logo-title js-inview inview_fadeUp">
            <h2 class="title bg_grad_pnk">オファーについて</h2>
          </div>
          <div class="faq__group-list container js-inview inview_fadeUp">
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">スマフィーとは何ですか？</div>
              <div class="faq__group-row-a">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</div>
            </div>
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</div>
              <div class="faq__group-row-a">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</div>
            </div>
          </div>
        </div>
        <div id="group04" class="faq__group">
          <div class="sec-logo-title js-inview inview_fadeUp">
            <h2 class="title bg_grad_pnk">そのほか</h2>
          </div>
          <div class="faq__group-list container js-inview inview_fadeUp">
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">スマフィーとは何ですか？</div>
              <div class="faq__group-row-a">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</div>
            </div>
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</div>
              <div class="faq__group-row-a">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
