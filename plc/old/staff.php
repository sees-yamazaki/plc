<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}

$ini = parse_ini_file('./common.ini', FALSE);

$w = date("w");
$week_name = array("日", "月", "火", "水", "木", "金", "土");

$printDate = date("Y/m/d") ."(" . ($week_name[$w]) . ")"; 

if (isset($_POST["info"])) {
            try {

                require_once 'dns.php';

            $stmt = $pdo->prepare('update information set info = ? where user_level =  ?');

            $stmt->execute(array($_POST["infoTxt"],$_POST["infoLvl"]));
                    header("Location: home.php");  // メイン画面へ遷移
                    exit();  // 処理終了
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            // echo $e->getMessage();
        }

}
    


    if (!empty($_SESSION["LEVEL"])) {

        // SESSIONのユーザLEVELを格納
        $userlvl = $_SESSION["LEVEL"];
        
        // 編集権限の確認
        $isEdit = false;
        if($userlvl=="1"){
            $isEdit = true;
        }else if($userlvl=="2"){
            if($_GET['infoLvl']=="3"){
                $isEdit = true;
            }
        }
        
        // 3. エラー処理
        try {

            require_once 'dns.php';
            
            $stmt = $pdo->prepare('SELECT * FROM information WHERE user_level = ?');
            $stmt->execute(array($userlvl));

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $info = $row['info'];

            } else {
                // 4. 認証成功なら、セッションIDを新規に発行する
                // 該当データなし
                $errorMessage = '情報の取得に失敗しました。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            if(strcmp("1",$ini['debug'])==0){
                echo $e->getMessage();
            }
        }
    }

?>
<!DOCTYPE html>
<html>

<head class="wf-sawarabigothic">
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/staff.css">
    <link rel="stylesheet" type="text/css" href="css/hiraku.css">
    <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="js/hiraku.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
</head>

<body>

    <header id="header">
        <button class="hiraku-open-btn" id="offcanvas-btn-left" data-toggle-offcanvas="#js-hiraku-offcanvas-1">
            <span class="hiraku-open-btn-line"></span>
        </button>
        <div class="headTitle">PLC 勤怠管理システム　　[<?php echo $_SESSION['NAME'] ?>]</div>
    </header>
    <div class="offcanvas-left">
        <ul>
            <li>TOP</li>
            <li>シフト確認</li>
            <li class="work">シフト登録</li>
            <li class="work">ログアウト</li>
        </ul>
        <table style="width:90%; background-color: #999;"><tr><td style="font-size:3em;">PLC</td></tr></table>
    </div>

    <script>
        $(".offcanvas-left").hiraku({
            btn: "#offcanvas-btn-left",
            direction: "left"
        });

    </script>




    <table class="work">
        <tbody>
            <tr>
                <th class="arrow_box">日付</th>
                <td colspan="2"><?php echo $printDate; ?></td>
            </tr>
            <tr>
                <th class="arrow_box">出発時間</th>
                <td class="time">株式会社LIG</td>
                <td class="btn"><a href="#" class="btn-sticky">登録</a></td>
            </tr>
            <tr>
                <th class="arrow_box">入店時間</th>
                <td>株式会社LIG</td>
            </tr>
            <tr>
                <th class="arrow_box">退店時間</th>
                <td>株式会社LIG</td>
            </tr>
        </tbody>
    </table>


</body>

</html>
