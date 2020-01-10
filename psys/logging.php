<?php

function logging($msg)
{
    $logRoot = "../psys/log/";
    $fn = $logRoot.date('Ymd', strtotime('now')).".log";

    $now = date('Y-m-d H:i:s', strtotime('now'));
    file_put_contents($fn, $now." [S] ".$msg.PHP_EOL, FILE_APPEND);
}


function devLog($msg)
{
    $logRoot = "../psys/log/";
    $fn = $logRoot.date('Ymd', strtotime('now')).".log";

    $now = date('Y-m-d H:i:s', strtotime('now'));
    file_put_contents($fn, $now." [D] ".$msg.PHP_EOL, FILE_APPEND);
}



function callback($buffer)
{
    $lns = explode(PHP_EOL, $buffer);
    if (getSsnDebugLv()==2) {
        foreach ($lns as $ln) {
            devLog($ln);
        }
    } elseif (getSsnDebugLv()==1) {
        devLog($lns[0]);
        devLog($lns[1]);
    }
    return '';
}

function execSql($stmt, $location)
{
    $stmt->execute();
    if (getSsnDebugLv()>0) {
        devLog('');
        devLog($location);
    }
    if (ob_start('callback')) {
        try {
            $stmt->debugDumpParams();
        } finally {
            ob_end_flush();
        }
    }
}

?>

