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
<title>スマフィーのはじめかた</title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
</head>

<body>

  <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

  <main class="main">

    <div class="mainheader">
      <p class="breadcrumbs">
        <a href="/">トップ</a>
        <a href="./">スマフィーのはじめかた</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">スマフィーのはじめかた</h1>
      </div>
    </div>

    <div class="page__howto section">
      <div class="howto__inner">

        <div class="howto__about container">
          <h2 class="howto__page-title bg_grad_blu"><img src="./x10u/assets/img/title_howto.png"></h2>
          <p class="howto__page-desc">あなたのSNSにおすすめの商品やサービスを紹介して、あなたのサイトを訪れたユーザーが紹介した商品を購入したり、登録をしたらお小遣いが得られるのがスマフィーです。<br>スマフィーはInstagramやTwitter、facebook、YouTubeにも対応！<br>動画で紹介するのもいっぱい写真を載せて紹介するのもあなた次第！</p>
        </div>

        <div class="faq__contents">

          <div class="cmn_page__link_nav">
            <ul class="flex-wrap container">
              <li class="item"><a href="#screen">画面機能説明</a></li>
              <li class="item"><a href="#click">クリック報酬型に参加</a></li>
              <li class="item"><a href="#result">成果報酬型に参加</a></li>
              <li class="item"><a href="#post">投稿報酬型に参加</a></li>
            </ul>
          </div>

          <section id="screen" class="sec-howto-screen section">
            <div class="sec__inner">
              <div class="sec-logo-title js-inview inview_fadeUp js-inview_view">
                <h2 class="title bg_grad_pnk">画面機能説明</h2>
              </div>
              <div class="howto__sec-contents container">
                <p class="howto__sec-contents-desc">スマフィーの画面説明がここにはいります。スマフィーの画面説明がここに入ります。スマフィーの画面説明がここにはいります。スマフィーの画面説明がここに入ります。</p>

                <br>
                <ul class="cmn_sec_link flex-wrap">
                  <li><a href="#screen01">トップページ</a></li>
                  <li><a href="#screen02">承認制オファー概要</a></li>
                  <li><a href="#screen03">オファー一覧</a></li>
                  <li><a href="#screen04">成果情報</a></li>
                  <li><a href="#screen05">設定変更</a></li>
                </ul>

                <div id="screen01" class="howto__sec-cont-group">
                  <h3 class="bar-title"><span class="bar-title-text">トップページ</span></h3>
                  <div class="howto__sec-cont-group-block">
                    <div class="howto__sec-cont-group-block-img">
                      <img src="./x10u/assets/img/howto_screen_01_01.png" alt="">
                    </div>
                    <div class="howto__sec-cont-group-block-info">
                      <h4 class="howto__sec-cont-group-block-info-title">無料の会員登録</h4>
                      <p class="howto__sec-cont-group-block-info-text">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</p>
                    </div>
                  </div>
                  <div class="howto__sec-cont-group-block">
                    <div class="howto__sec-cont-group-block-img">
                      <img class="sp" src="./x10u/assets/img/howto_screen_01_01.png" alt="">
                      <img class="pc" src="./x10u/assets/img/howto_screen_01_01.png" alt="">
                    </div>
                    <div class="howto__sec-cont-group-block-info">
                      <h4 class="howto__sec-cont-group-block-info-title">無料の会員登録</h4>
                      <p class="howto__sec-cont-group-block-info-text">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </section>
          <section id="click" class="sec-howto-click section">
            <div class="sec__inner">
              <div class="sec-logo-title js-inview inview_fadeUp js-inview_view">
                <h2 class="title bg_grad_pnk">クリック報酬型に参加</h2>
              </div>
              <div class="howto__sec-contents container">
                <p class="howto__sec-contents-desc">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</p>

                <br>
                <ul class="cmn_sec_link flex-wrap">
                  <li><a href="#click01">トップページ</a></li>
                  <li><a href="#click02">承認制オファー概要</a></li>
                  <li><a href="#click03">オファー一覧</a></li>
                  <li><a href="#click04">成果情報</a></li>
                  <li><a href="#click05">設定変更</a></li>
                </ul>

                <div id="click01" class="howto__sec-cont-group">
                  <h3 class="bar-title"><span class="bar-title-text">トップページ</span></h3>
                  <div class="howto__sec-cont-group-block">
                    <div class="howto__sec-cont-group-block-img">
                      <img src="./x10u/assets/img/howto_click_01_01.png" alt="">
                    </div>
                    <div class="howto__sec-cont-group-block-info">
                      <h4 class="howto__sec-cont-group-block-info-title">オファー一覧を開く</h4>
                      <p class="howto__sec-cont-group-block-info-text">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</p>
                      <br>
                      <div class="howto__sec-cont-group-block-info-box">
                        <p>ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに<a class="text-link text-underline" href="">説明が入ります。<span class="icon_gaibulink"></span></a>文章お願い致します。</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <section id="result" class="sec-howto-result section">
            <div class="sec__inner">
              <div class="sec-logo-title js-inview inview_fadeUp js-inview_view">
                <h2 class="title bg_grad_pnk">成果報酬型に参加</h2>
              </div>
              <div class="howto__sec-contents container">
                <p class="howto__sec-contents-desc">スマフィーの成果報酬型に参加がここにはいります。</p>

                <br>
                <ul class="cmn_sec_link flex-wrap">
                  <li><a href="#result01">トップページ</a></li>
                  <li><a href="#result02">承認制オファー概要</a></li>
                  <li><a href="#result03">オファー一覧</a></li>
                  <li><a href="#result04">成果情報</a></li>
                  <li><a href="#result05">設定変更</a></li>
                </ul>

                <div id="result01" class="howto__sec-cont-group">
                  <h3 class="bar-title"><span class="bar-title-text">トップページ</span></h3>
                  <div class="howto__sec-cont-group-block">
                    <div class="howto__sec-cont-group-block-img">
                      <iframe width="560" height="315" src="https://www.youtube.com/embed/N6AqaXFv1Bk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="howto__sec-cont-group-block-info">
                      <h4 class="howto__sec-cont-group-block-info-title">無料の会員登録</h4>
                      <p class="howto__sec-cont-group-block-info-text">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</p>
                    </div>
                  </div>
                  <div class="howto__sec-cont-group-block">
                    <div class="howto__sec-cont-group-block-img">
                      <img class="sp" src="./x10u/assets/img/howto_screen_01_01.png" alt="">
                      <img class="pc" src="./x10u/assets/img/howto_screen_01_01.png" alt="">
                    </div>
                    <div class="howto__sec-cont-group-block-info">
                      <h4 class="howto__sec-cont-group-block-info-title">無料の会員登録</h4>
                      <p class="howto__sec-cont-group-block-info-text">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <section id="post" class="sec-howto-post section">
            <div class="sec__inner">
              <div class="sec-logo-title js-inview inview_fadeUp js-inview_view">
                <h2 class="title bg_grad_pnk">投稿報酬型に参加</h2>
              </div>
              <div class="howto__sec-contents container">

              </div>
            </div>
          </section>

        </div>
      </div>
    </div>


  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
