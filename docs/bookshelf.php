<?php

// セッション開始
session_start();
require('session.php');
require('logging.php');


// ログイン状態チェック
// if (getSsnIsLogin()==false) {
//     header("Location: a_logoff.php");
//     exit;
// }

// エラーメッセージの初期化
$errorMessage = "";

$bSeq = $_POST['bSeq'];
$stts = $_POST['stts'];
$bPw = $_POST['bPw'];

$shelf = $_POST['shelf'];
if (empty($shelf)) {
    $shelf=$_GET['shelf'];
}


     require_once './db/books.php';
     $books = new cls_books();

 try {

     if ($stts=="dl") {

        $readbook = getBook($bSeq);

        // if($readbook->bks_pw==$bPw){
            $fileNm = "./files/".$readbook->bks_seq."_".$readbook->bks_file;
            header('Content-Type: application/octet-stream');
            header('Content-Length: '.filesize($fileNm));
            header('Content-Disposition: attachment; filename='.$readbook->bks_file);
            readfile($fileNm);
        // }else{
        //     $errorMessage = "<h3>ダウンロードパスワードが一致しません。</h3>";
        // }

     }




     $books = getBooks($shelf);

     $html="";
     foreach ($books as $book) {
         $html .= '<tr>';
         $html .= "<td>";
         $html .= "&nbsp;<button type='button' name='edit' class='btn btn-inverse-secondary' onclick='scDL(".$book->bks_seq.")'>DL</button>";
         $html .= "</td>";
         $html .= "<td>".$book->bks_title."</td>";
         $html .= "<td>".$book->bks_opendt."まで</td>";
         $html .= "<td>".$book->bks_text."</td>";
         //$html .= "<td><input type='text' class='form-control w50p' id='pw".$book->bks_seq."' autocomplete='off'></td>";
         $html .= "</tr>";
     }
 } catch (PDOException $e) {
     $errorMessage = 'データベースエラー:'.$e->getMessage();
 }


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo getSsnMyname(); ?></title>
    <link rel="stylesheet" href="./assets/vendors/iconfonts/mdi/css/materialdesignicons.css">
    <link rel="stylesheet" href="./assets/css/shared/style.css">
    <link rel="stylesheet" href="./assets/css/demo_1/style.css">
    <link rel="shortcut icon" href="../asssets/images/favicon.ico" />
    <link rel="stylesheet" href="./asset/css/main.css">
    <script>
    function scDL(vlu) {
        document.getElementById('errSpan').innerHTML="";
        document.frm2.bSeq.value = vlu;
        //document.frm2.bPw.value = document.getElementById('pw'+vlu).value;
        document.frm2.submit();
    }
    </script>
</head>

<body class="header-fixed">
    <form action='' method='POST' name="frm2">
        <input type='hidden' name='bSeq' value=''>
        <input type='hidden' name='bPw' value=''>
        <input type='hidden' name='stts' value='dl'>
        <input type='hidden' name='shelf' value='<?php echo $shelf; ?>'>
    </form>

    <?php include('./menu.php'); ?>

    <div class="page-content-wrapper">
        <div class="page-content-wrapper-inner">
            <div class="content-viewport">
                <span class="clrRed" id="errSpan"><?php echo $errorMessage; ?></span>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>タイトル</th>
                            <th>開示期間</th>
                            <th>説明</th>
                            <th>パスワード</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $html; ?>
                    </tbody>
                </table>
                <br>
            </div>
        </div>
    </div>

    <?php include('./a_footer.php'); ?>

    </div>
    </div>
    <script src="./assets/vendors/js/core.js"></script>
    <script src="./assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="./assets/vendors/chartjs/Chart.min.js"></script>
    <script src="./assets/js/charts/chartjs.addon.js"></script>
    <script src="./assets/js/template.js"></script>
    <script src="./assets/js/dashboard.js"></script>
</body>

</html>