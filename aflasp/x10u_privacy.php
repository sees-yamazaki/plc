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
<title>プライバシーポリシー</title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
</head>

<body>

  <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

  <main class="main">

    <div class="mainheader">
      <p class="breadcrumbs">
        <a href="/">トップ</a>
        <a href="./">プライバシーポリシー</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">プライバシーポリシー</h1>
      </div>
    </div>

    <section class="sec-privacy section">
      <div class="sec__inner container">
        <p>ForFuture株式会社（以下当社と略す）は、当社業務（アフィリエイトサービスの運営、各種自社媒体の運営、その他広告関連事業）において当社が取り扱う全ての個人情報（個人番号及び特定個人情報を含む。以下、総称して「個人情報等」という。）の保護について、社会的使命を十分に認識し、本人の権利の保護、個人情報に関する法規制等を遵守します。</p>
        <br>
        <div class="dl-style">
          <dl>
            <dt>1.法令などの遵守について</dt>
            <dd>当社は、個人情報保護の実現のため、個人情報保護法、各省庁ガイドラインその他関連する法令等を遵守いたします。</dd>
          </dl>
          <dl>
            <dt>2.個人情報の収集方法とその目的について</dt>
            <dd>
              <p>本規約において、次の各号に掲げる用語の意味は、当該各号に定めるとおりとします。</p>
              <br>
              <div class="dd_indent">
                <p>・個人又は特定の利用者を識別できない形式に加工した、本サービスの利用状況に関する統計データを作成するため</p>
                <p>・本サービスの案内のため</p>
              </div>
              <br>
              <p>また当社が個人情報を第三者から間接的に取得する場合は、当該第三者が本人から適正に取得したものであるかどうかを確認した上で、上記目的の範囲内で利用します。</p>
            </dd>
          </dl>
        </div>
      </div>
    </section>
  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
