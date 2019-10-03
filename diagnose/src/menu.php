<?php

$url = basename($_SERVER['REQUEST_URI']);

if($url=="answering0.php" || $url=="answering1.php"){
    $A = " class='active' ";
}elseif($url=="questionnaires_edit.php" || $url=="questionnaires_list.php" || 
        $url=="questions_edit.php" || $url=="questions_list.php" ||
        $url=="types_edit.php" || $url=="types_list.php" ){
    $QU = " class='active' ";
}elseif($url=="users_edit.php" || $url=="users_list.php"){
    $U = " class='active' ";
}elseif($url=="result_edit.php" || $url=="result_list.php" || $url=="result_user.php"){
    $R = " class='active' ";
}elseif($url=="accepting_edit.php" || $url=="accepting_list.php"){
    $AC = " class='active' ";
}else{
    $H = " class='active' ";   
}


echo "<div class='menu'>";
echo "    <ul class='topnav'>";
echo "        <li><a ".$H." href='home.php'>Home</a></li>";
echo "        <li><a ".$A." href='answering0.php'>Answer</a></li>";
if($_SESSION['LEVEL']==1){
    echo "        <li><a ".$AC." href='accepting_list.php'>Accepting</a></li>";
    echo "        <li><a ".$R." href='result_list.php'>Result</a></li>";
    echo "        <li><a ".$U." href='users_list.php'>User</a></li>";
    echo "        <li><a ".$QU." href='questionnaires_list.php'>Questionnaire</a></li>";
}
echo "        <li class='user'>".$_SESSION['NAME']."</li>";
echo "        <li class='right'><a href='logoff.php'>LogOff</a></li>";
echo "    </ul>";
echo "</div>";

?>