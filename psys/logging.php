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



