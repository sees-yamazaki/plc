<?php
include 'x10c_logging.php';
include 'x10c_helper.php';
include 'x10c/db/x10.php';
include 'x10c/db/nuser.php';
include 'x10c/db/adwares.php';

$pDay =  strtotime("-30 day");
$where = " WHERE `pay`.`state`=0 AND `pay`.regist<".$pDay;

$posts = getPosts($where);
foreach ($posts as $post) {
    adCost($post->adwares, $post->owner, $post->cost);
}
