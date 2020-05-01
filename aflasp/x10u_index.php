<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';

// セッション再開
session_start();

//Timezone
date_default_timezone_set('Asia/Tokyo');

// エラーメッセージの初期化
$errorMessage = '';

$_SESSION[ $SESSION_NAME ] = '';

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>トップ</title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
<link rel="stylesheet" href="./x10u/assets/css/index.css">
</head>

<body>

  <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

  <main class="main">

    <section class="sec-mv">
      <div class="mv__inner container flex-center">
        <div class="mv__contents">
          <div class="mv__catch_wrap">
            <h2 class="mv__logo js-inview inview_fadeUp"><img src="./x10u/assets/img/mv_logo.png" alt=""></h2>
            <div class="mv__catch">
              <p class="mv__catch_text1 js-inview inview_fadeUp">好きなコトを</p>
              <p class="mv__catch_text2 js-inview inview_fadeUp">好きな<span class="f-grn">ジカン</span>に</p>
            </div>
          </div>
          <div class="btn mv__btn_member js-inview inview_fadeUp"><a href="./x10u_member.php" class="bg_grad_pnk">無料で会員登録</a></div>
        </div>
      </div>
    </section>

    <section id="about" class="sec-about section">
      <div class="about__inner">
        <div class="sec-logo-title js-inview inview_fadeUp">
          <h2 class="title bg_grad_pnk">スマフィーとは？</h2>
        </div>
        <div class="about__box-img about__box-img01 js-inview">
          <p class="about__box-text about__box-text01 js-inview inview_fadeRight"><img src="./x10u/assets/img/top_about_text_01.png" alt="スマートフォンに特化した報酬サービス！"></p>
        </div>
        <div class="about__box-img about__box-img02 js-inview">
          <p class="about__box-text about__box-text02 js-inview inview_fadeLeft"><img src="./x10u/assets/img/top_about_text_02.png" alt="TwitterやInstagramなどのSNSの投稿にURLを貼り付けて紹介するだけ！"></p>
        </div>
        <div class="about__box-img about__box-img03 js-inview">
          <p class="about__box-text about__box-text03 js-inview inview_fadeRight"><img src="./x10u/assets/img/top_about_text_03.png" alt="好きな時間にやりたいお仕事だけ！"></p>
        </div>
        <div class="about__info container">
          <div class="about__info-text js-inview inview_fadeUp">
            <p>あなたのSNSにおすすめの商品やサービスを紹介して、あなたのサイトを訪れたユーザーが<br class="pc">紹介した商品を購入したり、登録をしたらお小遣いが得られるのがスマフィーです。<br>スマフィーはInstagramやTwitter、facebook、YouTubeにも対応！<br>動画で紹介するのもいっぱい写真を載せて紹介するのもあなた次第！</p>
          </div>
        </div>
      </div>
    </section>

    <section class="sec-step section">
      <div class="step__inner">
        <div class="sec-logo-title js-inview inview_fadeUp">
          <h2 class="title bg_grad_pnk">簡単３ステップで報酬ゲット！</h2>
        </div>
        <div class="step__contents container">
          <div class="step__block_list">
            <div class="step__block step__bloxk01">
              <div class="step__block-img step__block-img01 js-inview"></div>
              <div class="step__block-info js-inview">
                <div class="step__block-info-inner">
                  <div class="step__block-info-title flex-wrap js-inview">
                    <div class="step-label"><span class="step">Step</span><span class="step-num">01</span></div>
                    <h3 class="title"><span>無料の会員登録</span></h3>
                  </div>
                  <div class="step__block-info-text">
                    <p>ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="step__block step__bloxk02">
              <div class="step__block-img step__block-img02 js-inview"></div>
              <div class="step__block-info js-inview">
                <div class="step__block-info-inner">
                  <div class="step__block-info-title flex-wrap js-inview">
                    <div class="step-label"><span class="step">Step</span><span class="step-num">02</span></div>
                    <h3 class="title"><span>好きなオファーを選んで投稿</span></h3>
                  </div>
                  <div class="step__block-info-text">
                    <p>ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="step__block step__bloxk03">
              <div class="step__block-img step__block-img03 js-inview"></div>
              <div class="step__block-info js-inview">
                <div class="step__block-info-inner">
                  <div class="step__block-info-title flex-wrap js-inview">
                    <div class="step-label"><span class="step">Step</span><span class="step-num">03</span></div>
                    <h3 class="title"><span>成果に応じて報酬ゲット！</span></h3>
                  </div>
                  <div class="step__block-info-text">
                    <p>ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="sec-offer section">
      <div class="offer__inner">
        <div class="sec-logo-title js-inview inview_fadeUp">
          <h2 class="title bg_grad_pnk">オファーの一例</h2>
        </div>
        <div class="offer__contents container js-inview inview_fadeUp">
          <div id="js-offer__slide" class="offer__slide">
            <div class="offer__slide-item slick-slide"><img src="./x10u/assets/img/step__block_img_01.jpg" alt=""></div>
            <div class="offer__slide-item slick-slide"><img src="./x10u/assets/img/step__block_img_02.jpg" alt=""></div>
            <div class="offer__slide-item slick-slide"><img src="./x10u/assets/img/step__block_img_03.jpg" alt=""></div>
            <div class="offer__slide-item slick-slide"><img src="./x10u/assets/img/mv.png" alt=""></div>
          </div>

          <div class="btn"><a class="bg_grad_orn" href="./x10u_member.php">いますぐ無料で会員登録</a></div>
        </div>
      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
