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
              <li class="item"><a href="#group02">オファーについて</a></li>
              <li class="item"><a href="#group03">成果について</a></li>
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
              <div class="faq__group-row-a">
あなたの好きな時間を使って、広告主のサービスをSNSに投稿ください。<br>
広告主からの依頼内容に応じて、あなたに報酬が入る仕組みになります。<br>
あなたのスマホから簡単にお小遣いが稼げる仕組みです。<br>
毎月幾つでも投稿可能ですので、空いた時間を有効に使えます。<br>
フォロワー数などに関係なく、誰でも参加出来る簡単なお小遣い稼ぎと考えてください。<br>
<br>
投稿例<br>
Twitter<br>
facebook<br>
YouTube<br>
Instagramなど
	</div>
            </div><!--
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</div>
              <div class="faq__group-row-a">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</div>
            </div>-->
          </div>
        </div>
        <div id="group02" class="faq__group section">
          <div class="sec-logo-title js-inview inview_fadeUp">
            <h2 class="title bg_grad_pnk">オファーについて</h2>
          </div>
          <div class="faq__group-list container js-inview inview_fadeUp">
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">オファーとは？</div>
              <div class="faq__group-row-a">
広告主がそのサービス内容によってあなたに支払う対価になります。<br>
1.投稿型<br>
1回の投稿に支払う金額が記載されています。<br>
※広告主によっては、あなたからの投稿希望を承認するか判断する場合があります。<br>
<br>
2.成果型<br>
広告主のサービスが、あなたの投稿によってどのくらいの数の反響があるかによって決まります。沢山の反響があれば多くの報酬を受けとる事が可能です。<br>
<br>
3.クリック型<br>
広告主のサイト内あなたの投稿から何人訪れたかによって報酬が決まります。</div>
            </div>
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">投稿報酬タイプについての詳細</div>
              <div class="faq__group-row-a">指定されたSNS（<a href="/a/x10u_user.php" style="color:#60b8cf;">SNSアカウント設定</a>）から投稿を行うことで報酬を得られるタイプです。<br>
広告主から承認される必要がありますが最も簡単で報酬単価が高いタイプになります。<br>
<br>
成果条件によっては投稿するだけのもの、決められたURLをはりつけるもの、指定のハッシュタグをつけるもの、などがありますので投稿前に十分ご確認下さい。<br>
また、この報酬タイプは広告主からの承認が必要な広告タイプになります。<br>
かならず<a href="/a/x10u_user.php" style="color:#60b8cf;">SNSアカウント設定</a>を行ってから承認リクエストを行って下さい。</div>
            </div>
            <!-- block -->
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">成果報酬タイプについての詳細</div>
              <div class="faq__group-row-a">あなたの投稿から指定されたURLにジャンプし、訪れたユーザーが商品の購入や会員登録をすると報酬を得られるタイプです。<br>
クリック報酬タイプより簡単ではないものの、1件あたりの報酬額は高めの設定になっており
いかに上手に商品などを紹介するかが腕の見せ所になります。<br>
YoutubeやInstagram以外にもURLを貼り付けられる場所であれば参加かのうなオファータイプになります。<br>
<br>
成果報酬タイプは広告主の成果の確認が必要なため（実際に購入されてお届けまで完了したかなど）
成果発生時は一旦未確定成果として計上され、30日以内に広告主が成果の最終確認をする事で成果確定（報酬の確定）となります。</div></div><!--/block-->
            <!-- block -->
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">クリック報酬タイプについての詳細</div>
              <div class="faq__group-row-a">あなたの投稿から指定されたURLに何人訪れたかによって報酬を得られるタイプです。<br>
報酬額は他のタイプに比べると少ないですが一番手軽で簡単に報酬を得られるタイプです。</div></div><!--/block-->
			
          </div>
        </div>
        <div id="group03" class="faq__group">
          <div class="sec-logo-title js-inview inview_fadeUp">
            <h2 class="title bg_grad_pnk">成果について</h2>
          </div>
          <div class="faq__group-list container js-inview inview_fadeUp">
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">３つの報酬タイプ</div>
              <div class="faq__group-row-a">
成果は、3つあります。<br>
ます、1つ目は広告主から1投稿につき決められた報酬がもらえるもの。<br>
2つ目は、広告主から例えはあなたの投稿から売れた商品の数によって決まるもの。<br>
3つ目は、広告主のサイトにあなたの投稿から何人来たかで決まるもの。<br>
1投稿からいずれかの報酬体系の報酬があなたのものになります</div>
            </div><!--
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</div>
              <div class="faq__group-row-a">ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。ここに説明が入ります。文章お願い致します。</div>
            </div>-->
          </div>
        </div>
        <div id="group04" class="faq__group">
          <div class="sec-logo-title js-inview inview_fadeUp">
            <h2 class="title bg_grad_pnk">そのほか</h2>
          </div>
          <div class="faq__group-list container js-inview inview_fadeUp">
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">投稿する数に制限はありますか？</div>
              <div class="faq__group-row-a">数に制限はございません。<br>
毎日何件でも投稿可能です。</div>
            </div>
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">いくら報酬が貰えるかどうしたら分かりますか？</div>
              <div class="faq__group-row-a">広告主のオファーを見れば分かります。また、あなたが手にする報酬額はあなたの管理画面からご確認下さい。</div>
            </div>
            <div class="faq__group-row">
              <div class="faq__group-row-q js-faq__drop">いつどういう形で報酬を受けとるのですか？</div>
              <div class="faq__group-row-a">登録頂いたあなたの銀行口座に毎月10日にお振込致します。<br>広告主はあなたの投稿を確認したり、あなたの投稿から得られる成果を確認する作業が発生しますので、確認後翌々月10日のお支払いになります</div>
            </div>
          </div>
        </div>
    </section>
  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
