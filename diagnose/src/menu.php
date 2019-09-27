<?php

$url = basename($_SERVER['REQUEST_URI']);

if($url=="answering0.php" || $url=="answering1.php"){
    $A = " class='active' ";
}elseif($url=="questionnaires_edit.php" || $url=="questionnaires_list.php"){
    $QU = " class='active' ";
}elseif($url=="questions_edit.php" || $url=="questions_list.php"){
    $Q = " class='active' ";
}elseif($url=="types_edit.php" || $url=="types_list.php"){
    $T = " class='active' ";
}elseif($url=="users_edit.php" || $url=="users_list.php"){
    $U = " class='active' ";
}elseif($url=="result_edit.php" || $url=="result_list.php"){
    $R = " class='active' ";
}else{
    $H = " class='active' ";   
}


echo "<div class='menu'>";
echo "    <ul class='topnav'>";
echo "        <li><a ".$H." href='home.php'>Home</a></li>";
echo "        <li><a ".$A." href='answering0.php'>Answer</a></li>";
if($_SESSION['LEVEL']==1){
echo "        <li><a ".$T." href='types_list.php'>Group</a></li>";
echo "        <li><a ".$U." href='users_list.php'>User</a></li>";
echo "        <li><a ".$Q." href='questions_list.php'>Question</a></li>";
echo "        <li><a ".$QU." href='questionnaires_list.php'>Questionnaire</a></li>";
echo "        <li><a ".$R." href='result_list.php'>Result</a></li>";
}
echo "        <li class='right'><a href='logoff.php'>LogOff</a></li>";
echo "    </ul>";
echo "</div>";

?>