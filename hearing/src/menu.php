<?php

$url = basename($_SERVER['REQUEST_URI']);
$url3 = substr($url, 0, 3);

if ($url3 == 'pro' || $url3 == 'sys' || $url3 == 'bus' || $url3 == 'wor') {
    $P = " class='active' ";
} elseif ($url3 == 'gro') {
    $G = " class='active' ";
} elseif ($url3 == 'use') {
    $U = " class='active' ";
} elseif ($url3 == 'mee') {
    $M = " class='active' ";
} else {
    $H = " class='active' ";
}

echo "<div class='menu'>";
echo "    <ul class='topnav'>";
echo '        <li><a '.$H." href='home.php'>入力シート</a></li>";
//echo '        <li><a '.$P." href='progress.php'>Progress</a></li>";
if($test==1){
    echo '<li><input type="button" onclick="demo()" value="input">';
    echo '<li><input type="button" onclick="demo2()" value="inAndRun">';
}     
echo '<li><input type="button" onclick="sakubun()" value="sakubun">';
if ($_SESSION['LEVEL'] == 1) {
//    echo "        <li><a ".$AC." href='accepting_list.php'>Accepting</a></li>";
//    echo "        <li><a ".$R." href='result_list.php'>Result</a></li>";
    // echo '        <li><a '.$G." href='groups_list.php'>Grp</a></li>";
    // echo '        <li><a '.$U." href='users_list.php'>User</a></li>";
    // echo '        <li><a '.$M." href='meetings_list.php'>Mtng</a></li>";
//    echo "        <li><a ".$QU." href='questionnaires_list.php'>Questionnaire</a></li>";
}
echo "        <li class='user'>".$_SESSION['NAME'].'</li>';
echo "        <li class='right'><a href='logoff.php'>LogOff</a></li>";
echo '    </ul>';
echo '</div>';
