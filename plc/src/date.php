<?php

function getTimestamp($argY,$argM){
    try{        
        $y = intval($argY);
        $m = intval($argM);
        if($y>2000 && $y<2100 && $m>0 && $m<13 ){
            return strtotime($y . '-' . $m . '-01 00:00:00');
        }else{
            return strtotime(date("Y-m-01", time()));
        }
    } catch (Exception $e) {
    }
    return strtotime(date("Y-m-01", time()));
}
  
function getTimestamp_LastDate($argY,$argM){

    $defDate = new DateTime('now');

    try{
        $y = intval($argY);
        $m = intval($argM);
        if($y>2000 && $y<2100 && $m>0 && $m<13 ){
            return strtotime('last day of ' . $y . '-' . $m);
        }else{
            return strtotime('last day of ' . $defDate->format('Y-m'));
        }
    } catch (Exception $e) {
    }    
    return strtotime('last day of ' . $defDate->format('Y-m'));
} 

function getTimestamp_NextMonth($argTime){
    $ymd = date('Y-m-d',  $argTime);
    return strtotime($ymd.' +1 month');
}

function getTimestamp_RealNextMonth(){
    $ymd = date('Y-m-d');
    return strtotime($ymd.' +1 month');
}
function getTimestamp_LastMonth($argTime){
    $ymd = date('Y-m-d',  $argTime);
    return strtotime($ymd.' -1 month');
}

function getTimestamp_ymd($argY,$argM,$argD){
    try{        
        $y = intval($argY);
        $m = intval($argM);
        $d = intval($argD);
//        echo $y."y ";
//        echo $m."m ";
//        echo $d."d ";

        if($y>2000 && $y<2100 && $m>0 && $m<13 && $d>0 && $d<32  ){
            return strtotime($y . '-' . $m . '-' . $d . ' 00:00:00');
        }else{
            return strtotime(date());
        }
    } catch (Exception $e) {
    }
    return strtotime(date());
}


function getTimestamp_ymdhi($argY,$argM,$argD,$argH,$argI){
    try{        
        $y = intval($argY);
        $m = intval($argM);
        $d = intval($argD);
        $h = intval($argH);
        $i = intval($argI);
/*
        echo $y."y ";
        echo $m."m ";
        echo $d."d ";
        echo $h."h ";
        echo $i."i ";
*/
        if($y>2000 && $y<2100 && $m>0 && $m<13 && $d>0 && $d<32 && $h>-1 && $h<24 && $i>-1 && $i<60  ){
            return strtotime($y . '-' . $m . '-' . $d . ' ' . $h . ':' . $i . ':00');
        }else{
            return strtotime(date());
        }
    } catch (Exception $e) {
    }
    return strtotime(date());
}
?>
