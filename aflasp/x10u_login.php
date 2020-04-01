<?php
include 'custom/conf.php';
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/x10.php';
include 'x10c/db/nuser.php';

// セッション再開
session_start();


// エラーメッセージの初期化
$errorMessage = '';


// ログインボタンが押された場合
if (isset($_POST['login'])) {

    // 1. ユーザIDの入力チェック
    if (empty($_POST['m_mail'])) {
        $err_mail_div = ' is-error';
        $err_mail_msg = '<p class="form-row-error-text">メールアドレスが未入力です。</p>';
    }
    if (empty($_POST['m_pw'])) {
        $err_pass_div = ' is-error';
        $err_pass_msg = '<p class="form-row-error-text">パスワードが未入力です。</p>';
    } 

    if (!empty($_POST['m_mail']) && !empty($_POST['m_pw'])) {

        // 入力したユーザIDを格納
        $m_mail = $_POST['m_mail'];
        $m_pw = $_POST['m_pw'];
        $nId = doLogin($m_mail, $m_pw);
        if (is_null($nId)) {
            $err_mail_div = ' is-error';
            $err_mail_msg = '<p class="form-row-error-text">ログインできませんでした。</p>';
        }else{
            $nUser = getNuser($nId);
            if ($nUser->activate=="1") {
                $err_mail_div = ' is-error';
                $err_mail_msg = '<p class="form-row-error-text">メール認証が完了しておりません。メール認証を完了の上ログイン下さい。</p>';
            } elseif ($nUser->activate=="2") {
                $err_mail_div = ' is-error';
                $err_mail_msg = '<p class="form-row-error-text">管理者の承認が完了しておりません。</p>';
            } elseif ($nUser->activate=="4") {
                $_SESSION[ $SESSION_NAME ] = $nId;
                header('Location: x10u_mypage.php');
            } else {
                $err_mail_div = ' is-error';
                $err_mail_msg = '<p class="form-row-error-text">ログインできませんでした。</p>';
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログイン・新規会員登録</title>
<meta name="description" content="アフィリエイト管理画面">
<?php include(__DIR__ . '/x10u/inc/meta.php'); ?>
<link rel="stylesheet" href="./x10u/assets/css/member.css">
</head>

<body>

  <?php include(__DIR__ . '/x10u/inc/header.php'); ?>

  <main class="main">

    <div class="mainheader">
      <p class="breadcrumbs">
        <a href="./x10u_index.php">トップ</a>
        <a href="#">ログイン・新規会員登録</a>
      </p>
    </div>

    <div class="pageheader">
      <div class="pageheader__inner container">
        <h1 class="pageheader_title">ログイン・新規会員登録</h1>
      </div>
    </div>

    <section class="sec-login section">
      <div class="sec__inner container">
        <form action="" class="form__login" method="post" name="frm1">
          <div class="form-row <?php echo $err_mail_div; ?>">
              <?php echo $err_mail_msg; ?>
            <input type="text" name="m_mail" value="<?php echo $_POST['m_mail'] ?>" placeholder="メールアドレスを入力" required>
          </div>
          <div class="form-row <?php echo $err_pass_div; ?>">
              <?php echo $err_pass_msg; ?>
            <input type="password" name="m_pw" placeholder="パスワードを入力" required>
          </div>
          <div class="btn"><a href="javascript:document.frm1.submit()" class="bg_blu">ログイン</a></div>
          <p class="login__forget_text">ID・パスワードをお忘れの方は<a href="x10u_reminder.php" class="text-link text-underline">こちら</a></p>
          <input type="hidden" name="login" value="1" />
        </form>
      </div>
    </section>

    <section class="sec-newmember section">
      <div class="sec__inner container">
        <div class="newmember＿＿box">
          <h2 class="newmember＿＿box_title">はじめての方は新規会員登録</h2>
          <p class="newmember＿＿box_text">スマフィーのサービスをのご利用は無料の新規登録を尾根が致します。</p>
          <div class="btn"><a href="./x10u_member.php" class="bg_blu">無料で会員登録</a></div>
        </div>
      </div>
    </section>

  </main>

  <?php include(__DIR__ . '/x10u/inc/footer.php'); ?>

</body>
</html>
