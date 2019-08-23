<?php

function getWorkTime($sTime,$eTime){

    $diff_min = (strtotime($eTime) - strtotime($sTime)) / 60;
    $work_hour = ($diff_min) / 60;
    $work_min = ($diff_min) % 60;

    $wH = sprintf('%02d', intval($work_hour));
    $wM = sprintf('%02d', intval($work_min));

    //echo $wH.":".$wM."}";
    return $wH.":".$wM;
}

function getWorkPay($cost,$wTime){

    $workH = intval(substr($wTime,0,2));
    $workM = intval(substr($wTime,-2)) / 60;

    return ($cost * $workH) + ($cost * $workM) ;
}


?>
