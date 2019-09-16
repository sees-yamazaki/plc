<?php
session_start();

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

// 前月・次月リンクが押された場合は、GETパラメーターから年月を取得
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // 今月の年月を表示
    $ym = date('Y-m');
}

// タイムスタンプを作成し、フォーマットをチェックする
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

// 今日の日付 フォーマット　例）2018-07-3
$today = date('Y-m-j', time());

// カレンダーのタイトルを作成　例）2017年7月 2017-7
$html_title = date('Y年n月', $timestamp);
$this_month = date('Y-m', $timestamp);

// 前月・次月の年月を取得
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));


// 該当月の日数を取得
$day_count = date('t', $timestamp);

// １日が何曜日か　0:日 1:月 2:火 ... 6:土
$youbi = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));


// カレンダー作成の準備
$weeks = [];
$week = '';

// 第１週目：空のセルを追加
// 例）１日が水曜日だった場合、日曜日から火曜日の３つ分の空セルを追加する
$week .= str_repeat('<td></td>', $youbi);


// 指定月のスケジュール取得
require './db/schedules.php';
$schedules = array();
$schedules = getSchedulesYM(date('Y', $timestamp),date('m', $timestamp));

for ( $day = 1; $day <= $day_count; $day++, $youbi++) {

    // 2017-07-3
    $date = $ym . '-' . $day;
    // 2017-07-03
    $date2 = str_replace("-","", $ym) .  sprintf('%02d', $day);

    if ($today == $date) {
        // 今日の日付の場合は、class="today"をつける
        $week .= '<td class="today">';
    } else {
        $week .= '<td>';
    }

    // 日付からデイリー表示へリンクできるようにする
    $week .= "<a href='cal_day.php?ymd=".$date."'><span class='nrlDay'>&nbsp;". $day . "&nbsp;</span></a><br>";

    // 日付に該当するスケジュールがあるか確認する
    foreach ($schedules as $schedule) {

        if($schedule->sche_start_ymd==$date2){
            // 当日が開始日の場合は閲覧へのリンクとタイトル表示を設定する
            $week .= "<a href='sche_view.php?sSeq=".$schedule->sche_seq."&ymd=".$date2."&mCal=".$this_month."'>";
            $week .= "<span class='block' style='color:#".$schedule->sche_color."'>".$schedule->sche_mark;
            $week .= substr($schedule->sche_start_hm,0,2)."時 ".$schedule->sche_title_m;
            $week .= "</span></a><br>";
        }elseif(
            // 当日が開始日では無い期間中または最終日の場合は閲覧へのリンクを設定する
            ($schedule->sche_start_ymd<$date2) && ($schedule->sche_end_ymd>$date2)
            || ($schedule->sche_end_ymd==$date2)
            ){
            $week .= "<a href='sche_view.php?sSeq=".$schedule->sche_seq."&ymd=".$date2."&mCal=".$this_month."'>";
            $week .= "<span style='color:#".$schedule->sche_color."'>".$schedule->sche_mark."....";
            $week .= "</span></a><br>";
        }


    }

    $week .= '</td>';

    // 週終わり、または、月終わりの場合
    if ($youbi % 7 == 6 || $day == $day_count) {

        if ($day == $day_count) {
            // 月の最終日の場合、空セルを追加
            // 例）最終日が木曜日の場合、金・土曜日の空セルを追加
            $week .= str_repeat('<td></td>', 6 - ($youbi % 7));
        }

        // week配列にtrを追加する
        $weeks[] = '<tr>' . $week . '</tr>';

        // weekをリセット
        $week = '';
	}
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>カレンダー</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/cal_month.css" />
    <link rel="stylesheet" href="../css/calendar.css" />
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
</head>

<body>
    <?php include('./menu.php'); ?>

    <div>
        <span class="hgt"><br><br></span>
    <div class="container" id="mini-calendar">
        <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a
                href="?ym=<?php echo $next; ?>">&gt;</a></h3>
                <span class="title">日付をタップするとデイリーに切り替わります</span>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>日</th>
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th>土</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
            ?>
            </tbody>
        </table>
        </div>
    </div>
</body>

</html>