<?php

$LOG_LV=1;

function logging($msg)
{
    $logRoot = app_root( 'log');
    $fn = $logRoot.'/'.date('Ymd', strtotime('now')).".log";

    $now = date('Y-m-d H:i:s', strtotime('now'));
    file_put_contents($fn, $now." [S] ".$msg.PHP_EOL, FILE_APPEND);
}


function devLog($msg)
{
    $logRoot = app_root( 'log');
    $fn = $logRoot.'/'.date('Ymd', strtotime('now')).".log";

    $now = date('Y-m-d H:i:s', strtotime('now'));
    file_put_contents($fn, $now." [D] ".$msg.PHP_EOL, FILE_APPEND);
}



function callback($buffer)
{

    global $LOG_LV;
    $lns = explode(PHP_EOL, $buffer);
    //if (getSsnDebugLv()==2) {
    if ($LOG_LV==2) {
            foreach ($lns as $ln) {
            devLog($ln);
        }
    //} elseif (getSsnDebugLv()==1) {
    } elseif ($LOG_LV==1) {
        devLog($lns[0]);
        devLog($lns[1]);
    }
    return '';
}

function execSql($stmt, $location)
{
    global $LOG_LV;
    $stmt->execute();
    if ($LOG_LV>0) {
    //if (getSsnDebugLv()>0) {
        devLog('');
        devLog($location);
    }
    if(ob_start('callback')){
        $stmt->debugDumpParams();
        ob_end_flush();
    }
}

?>

