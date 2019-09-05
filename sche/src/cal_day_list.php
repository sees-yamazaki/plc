<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');
 

// 前月・次月リンクが押された場合は、GETパラメーターから年月を取得
if (isset($_GET['ymd'])) {
    $ymd = $_GET['ymd'];
} else {
    // 今月の年月を表示
    $ymd = date('Y-m-d');
}

// タイムスタンプを作成し、フォーマットをチェックする
$timestamp = strtotime($ymd);
if ($timestamp === false) {
    $ymd = date('Y-m-d');
    $timestamp = strtotime($ymd);
}


// 今日の日付 フォーマット　例）2018-07-03
$today = date('Y-m-d', time());

// 今日の年月
$ym = date('Y-m-', $timestamp);

// 対象のYMD
$tYMD = date('Ymd', $timestamp);

// 今日の日 先頭ゼロ無し
$day = date('j', $timestamp);

// カレンダーのタイトルを作成　例）2017年7月
$html_title = date('Y年n月', $timestamp);


// 前月・次月の年月を取得
// 方法１：mktimeを使う mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)))."-01";
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)))."-01";


// 該当月の日数を取得
$day_count = date('t', $timestamp);

 
$calendar = array();
$j = 0;
 
// 月末日までループ
for ($i = 1; $i < $day_count + 1; $i++) {
 
    // 曜日を取得
    $youbi = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
 
    // 1日の場合
    if ($i == 1) {
 
        // 1日目の曜日までをループ
        for ($s = 1; $s <= $youbi; $s++) {
 
            // 前半に空文字をセット
            $calendar[$j]['day'] = '';
            $j++;
 
        }
 
    }
 
    // 配列に日付をセット
    $calendar[$j]['day'] = $i;
    $j++;
 
    // 月末日の場合
    if ($i == $day_count) {
 
        // 月末日から残りをループ
        for ($e = 1; $e <= 6 - $youbi; $e++) {
 
            // 後半に空文字をセット
            $calendar[$j]['day'] = '';
            $j++;
 
        }
 
    }
 
}
 
// 指定日のスケジュールn取得
require_once './db/schedules.php';
$schedules = array();
$schedules = getSchedulesYMD(date('Y', $timestamp),date('m', $timestamp),date('d', $timestamp));

$sche_day = "";
foreach ($schedules as $schedule) {
    $sche_day .= "<div class='boxSche'><p>";
    $sche_day .= "".$schedule->sche_start_dt." - ";
    $sche_day .= "".$schedule->sche_end_dt."<br>";
    $sche_day .= "[".$schedule->users_name."]<br>";
    $sche_day .= "<u>".$schedule->sche_title."</u><br>";
    $sche_day .= "".nl2br($schedule->sche_note)."<br>";
    $sche_day .= "</></div>";
}



?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>カレンダー</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/calendar.css" />
    <style type="text/css">
    table.miniCal {
        width: 100%;
    }

    table.miniCal th {
        background: #EEEEEE;
    }

    table.miniCal th,
    table.miniCal td {
        border: 0px solid #CCCCCC;
        text-align: center;
        padding: 5px;
        font-size: 0.5rem;
    }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
</head>

<body>

    <?php include('./menu.php'); ?>

    <div class="ly">
    <div class="l-cnt">


        <table class="miniCal">
            <tr>
                <td colspan=3><?php echo $html_title; ?></td>
                <td><a href="?ymd=<?php echo $prev; ?>">&lt;</a></td>
                <td colspan=2><a href="?ymd=<?php echo $today; ?>">TODAY</a></td>
                <td><a href="?ymd=<?php echo $next; ?>">&gt;</a></td>
            </tr>
            <tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>

            <tr>
                <?php $cnt = 0; ?>
                <?php foreach ($calendar as $key => $value): ?>
                <?php $cnt++; ?>

                <?php if($value['day']==$day){ ?>
                    <td class="tgtDay">
                    <?php echo $value['day']; ?>
                    </td>
                <?php }else{ ?>
                    <td>
                    <a class="day" href="?ymd=<?php echo $ym.$value['day']; ?>"><?php echo $value['day']; ?></a>
                    </td>
                <?php } ?>


                <?php if ($cnt == 7): ?>
            </tr>
            <tr>
                <?php $cnt = 0; ?>
                <?php endif; ?>

                <?php endforeach; ?>
            </tr>
        </table>
        <a href='cal_day.php?ymd=<?php echo date('Y-m-d', $timestamp); ?>'><img width=40px src="../img/eventstore.svg"></a>
        <a href='cal_day_list.php?ymd=<?php echo date('Y-m-d', $timestamp); ?>'><img width=40px src="../img/wheniwork.svg"></a>
        <img width=40px src="../img/pen.svg">
    </div>
    <div class="r-cnt">
            <?php echo $sche_day; ?>
    </div>
    </div>
</body>

</html>