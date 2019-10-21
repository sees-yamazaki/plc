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
$uSeq = $_GET['uSeq'];

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
 
// 指定日のスケジュール取得
require_once './db/schedules.php';
$schedules = array();
$schedules = getSchedulesYMD(date('Y', $timestamp),date('m', $timestamp),date('d', $timestamp));
$mySchedules = array();
$mySchedules = getMySchedulesYM(date('Y', $timestamp),date('m', $timestamp));
$roomSchedules = array();
$roomSchedules = getSchedulesYMDwithRoom(date('Y', $timestamp),date('m', $timestamp),date('d', $timestamp));



$uList = array("[<a href='?ymd=".$tYMD."'>All</a>]　");

$sche_day = "";
for($i = 0; $i <= 23.5; $i = $i + 0.5 ){
    $sche_day .= "<tr>";
    if( fmod($i,1)==0){
        $sche_day .= "<td class='hm'id='hm".$i."'><span class='hm'>".$i.":00</span></td>";
    }else{
        $sche_day .= "<td class='hm2'>&nbsp;</td>";
    }
    $sche_day .= "<td class='sche'>";

    //当時間帯
    if(fmod($i,1)==0){
        $sTime = sprintf('%04d', $i * 100);  ;
        $eTime = sprintf('%04d', ($i * 100)+30);
    }else{
        $sTime = sprintf('%04d', (floor($i) * 100) + 30)  ;
        $eTime = sprintf('%04d', ((floor($i)+1) * 100));
    }

    foreach ($schedules as $schedule) {

        array_push($uList,"[<a href='?ymd=".$tYMD."&uSeq=".$schedule->users_seq."'>".$schedule->users_name_short."</a>]　");

        if(!isset($uSeq) || $schedule->users_seq==$uSeq){    
            
            //$sTime = sprintf('%04d', $i * 100);
            //$eTime = sprintf('%04d', ($i * 100)+30);
            if(
                ($schedule->sche_start_ymd == $tYMD)
                && ($schedule->sche_start_hm >= $sTime)
                && ($schedule->sche_start_hm < $eTime)
                ){
                //開始時間が当時間帯の場合
                $sche_day .= "<a href='sche_view.php?sSeq=".$schedule->sche_seq."&ymd=".$tYMD."'>";
    //            $sche_day .= "<img src='../img/sche_icon".$schedule->sche_type.".svg'>";
    //            $sche_day .= "<span style='color:#".$schedule->sche_color."'>".$schedule->sche_mark."<span>";
                $sche_day .= "<span style='color:#393e4f'>".$schedule->users_name_short." ";
                $sche_day .= $schedule->sche_title;
                $sche_day .= "</span></a>&nbsp;&nbsp;";
            }elseif(
                (
                    ($schedule->sche_start_ymd == $tYMD)
                && ($schedule->sche_start_hm < $eTime)
                && ($schedule->sche_end_ymd == $tYMD)
                && ($schedule->sche_end_hm > $eTime)
                ) ||
                (
                    ($schedule->sche_start_ymd == $tYMD)
                && ($schedule->sche_end_ymd == $tYMD)
                && ($schedule->sche_end_hm > $sTime)
                && ($schedule->sche_end_hm < $eTime)
                ) ||
                (
                    ($schedule->sche_start_ymd == $tYMD)
                && ($schedule->sche_start_hm < $eTime)
                && ($schedule->sche_end_ymd > $tYMD)
                ) ||
                (
                    ($schedule->sche_start_ymd < $tYMD)
                && ($schedule->sche_end_ymd == $tYMD)
                && ($schedule->sche_end_hm > $eTime)
                )  ||
                (
                    ($schedule->sche_start_ymd < $tYMD)
                && ($schedule->sche_end_ymd > $tYMD)
                ) 
                ){
                    //開始時間が過去の場合
                $sche_day .= "<a href='sche_view.php?sSeq=".$schedule->sche_seq."&ymd=".$tYMD."'>";
    //            $sche_day .= "<span style='color:#".$schedule->sche_color."'>".$schedule->sche_mark."<span>";
                $sche_day .= "<span class='titleS'>".$schedule->users_name_short." ".$schedule->sche_title."<span>";
                $sche_day .= "</a>&nbsp;&nbsp;";
            }

        }
    }

    foreach ($roomSchedules as $roomSchedule) {
        if(
            ($roomSchedule->sche_start_ymd == $tYMD)
            && ($roomSchedule->sche_start_hm >= $sTime)
            && ($roomSchedule->sche_start_hm < $eTime)
            ){
            //開始時間が当時間帯の場合
            $sche_day .= "<a href='room_view.php?sSeq=".$roomSchedule->sche_seq."&ymd=".$tYMD."'>";
            $sche_day .= "<span style='color:red'> [".$roomSchedule->rooms_name."]";
            $sche_day .= "</span></a>&nbsp;&nbsp;";
        }elseif(
            (
                ($roomSchedule->sche_start_ymd == $tYMD)
            && ($roomSchedule->sche_start_hm < $eTime)
            && ($roomSchedule->sche_end_ymd == $tYMD)
            && ($roomSchedule->sche_end_hm > $eTime)
            ) ||
            (
                ($roomSchedule->sche_start_ymd == $tYMD)
            && ($roomSchedule->sche_end_ymd == $tYMD)
            && ($roomSchedule->sche_end_hm > $sTime)
            && ($roomSchedule->sche_end_hm < $eTime)
            ) ||
            (
                ($roomSchedule->sche_start_ymd == $tYMD)
            && ($roomSchedule->sche_start_hm < $eTime)
            && ($roomSchedule->sche_end_ymd > $tYMD)
            ) ||
            (
                ($roomSchedule->sche_start_ymd < $tYMD)
            && ($roomSchedule->sche_end_ymd == $tYMD)
            && ($roomSchedule->sche_end_hm > $eTime)
            )  ||
            (
                ($roomSchedule->sche_start_ymd < $tYMD)
            && ($roomSchedule->sche_end_ymd > $tYMD)
            ) 
            ){
                //開始時間が過去の場合
            $sche_day .= "<a href='room_view.php?sSeq=".$roomSchedule->sche_seq."&ymd=".$tYMD."'>";
            $sche_day .= "<span class='titleS'>".$roomSchedule->rooms_name."<span>";
            $sche_day .= "</a>&nbsp;&nbsp;";
        }


    }
    $sche_day .= "</td>";
    $sche_day .= "</tr>";

}

$unqList = array_unique($uList);

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>カレンダー</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/calendar.css" />
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <script src="../js/main.js"></script>
</head>

<body>

    <?php include('./menu.php'); ?>

    <div class="ly">

        <div id="l-cnt" class="l-cnt">

            <div class="l-cnt-cal">
                <table class="miniCal">
                    <tr>
                        <td><a href="?ymd=<?php echo $prev; ?>">&lt;</a></td>
                        <td colspan=3><?php echo $html_title; ?></td>
                        <td><a href="?ymd=<?php echo $next; ?>">&gt;</a></td>
                        <td colspan=2><a href="?ymd=<?php echo $today; ?>">TODAY</a></td>
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
                        <?php
                            $hasShedule="";
                            foreach ($mySchedules as $schedule) {
                                $tDay = intval(substr($schedule->sche_start_ymd,-2));
                                if($value['day']==$tDay){
                                    $hasShedule=" hasSchedule";
                                }
                            }
                        ?>

                        <?php if($value['day']==$day){ ?>
                        <td class="tgtDay">
                            <span class="<?php echo $hasShedule; ?>"><?php echo $value['day']; ?></span>
                        </td>
                        <?php }else{ ?>
                        <td>
                            <a class="day" href="?ymd=<?php echo $ym.$value['day']; ?>"><span class="<?php echo $hasShedule; ?>"><?php echo $value['day']; ?></span></a>
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
            </div>
            <!--
            <div class="l-cnt-txt">
                <span class="title">
                    ●・・自分のスケジュール<br>
                    ◆・・他者のスケジュール<br><br>
                </span>
            </div>
            -->
            <div class="l-cnt-btn1">
                <a href='cal_day_list.php?ymd=<?php echo date('Y-m-d', $timestamp); ?>'><img width=50px
                        src="../img/clock.svg" onmouseover="this.src='../img/list.svg'"
                        onmouseout="this.src='../img/clock.svg'"></a>
                <br><br>
            </div>
            <div class="l-cnt-btn2">
                <form action="sche_edit.php" method="POST">
                    <input type="hidden" name="ymd" value="<?php echo date('Y-m-d', $timestamp); ?>">
                    <input type="image" name="btn_submit" width=50px src="../img/pen.svg"
                        onmouseover="this.src='../img/wheniwork.svg'" onmouseout="this.src='../img/pen.svg'" />
                </form>
            </div>
            <div class="l-cnt-user">
                <span class="title">表示ユーザ　→　</span>
                <?php foreach ($unqList as $u) { ?>
                <?php echo $u; ?>
                <?php } ?>
            </div>
        </div>
        <div class="r-cnt">
            <!--
            <div class="r-cnt-top">上部固定</div>
                -->
            <table class="hm">
                <?php echo $sche_day; ?>
            </table>
        </div>
    </div>
</body>

</html>