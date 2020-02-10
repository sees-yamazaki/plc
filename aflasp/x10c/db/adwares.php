<?php

class cls_adwares
{
    public $shadow_id ;
    public $delete_key ;
    public $id ;
    public $cuser ;
    public $comment ;
    public $ad_text ;
    public $category ;
    public $banner ;
    public $banner2 ;
    public $banner3 ;
    public $tmp_banner ;
    public $tmp_banner2 ;
    public $tmp_banner3 ;
    public $banner_m ;
    public $banner_m2 ;
    public $banner_m3 ;
    public $url ;
    public $url_m ;
    public $url_over ;
    public $url_users ;
    public $name ;
    public $money ;
    public $ad_type ;
    public $click_money ;
    public $continue_money ;
    public $continue_type ;
    public $limits ;
    public $limit_type ;
    public $money_count ;
    public $pay_count ;
    public $click_money_count ;
    public $continue_money_count ;
    public $span ;
    public $span_type ;
    public $use_cookie_interval ;
    public $pay_span ;
    public $pay_span_type ;
    public $auto ;
    public $click_auto ;
    public $continue_auto ;
    public $check_type ;
    public $open ;
    public $open_user ;
    public $regist ;

    public $adware_type ;
    public $approvable ;
}



function getAdwaresNextId($approvable)
{
    $id=0;
    try {
        require 'dns.php';
        if ($approvable=="0") {
            $sql = "select IFNULL(MAX(shadow_id),0)+1 as nxtid from `adwares`";
        } else {
            $sql = "select IFNULL(MAX(shadow_id),0)+1 as nxtid from `secretadwares`";
        }
        $stmt = $pdo->prepare($sql);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        if ($row = $stmt->fetch()) {
            $id = $row['nxtid'];
        }
    } catch (PDOException $e) {
        //
    }
    return $id;
}

function countMonthlyClicks($y, $m, $nUserId,$adType)
{
    $cnt=0;
    try {
        $startDt = strtotime($y.'-'.$m.'-01 00:00:00');
        $endDt   = strtotime(date('Y-m-d 23:59:59',strtotime($y.'-'.$m.' last day of this month')));

        require 'dns.php';
        $sql = "select count(*) as cnt from `v_access_x10` WHERE owner=:owner AND regist BETWEEN :startDt AND :endDt AND adware_type=:adware_type";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':owner', $nUserId, PDO::PARAM_STR);
        $stmt->bindParam(':startDt', $startDt, PDO::PARAM_INT);
        $stmt->bindParam(':endDt', $endDt, PDO::PARAM_INT);
        $stmt->bindParam(':adware_type', $adType, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cnt = $row['cnt'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $cnt;
}

function countPastClicks($y, $m, $nUserId)
{
    $cnt=0;
    try {
        $startDt = strtotime($y.'-'.$m.'-01 00:00:00');

        require 'dns.php';
        $sql = "select count(*) as cnt from `v_access_x10` WHERE owner=:owner AND regist < :startDt";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':owner', $nUserId, PDO::PARAM_STR);
        $stmt->bindParam(':startDt', $startDt, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cnt = $row['cnt'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $cnt;
}


class cls_pays
{
    public $id ;
    public $name ;
    public $cnt ;
    public $cnt0 ;
    public $cnt1 ;
    public $cnt2 ;
    public $cst ;
    public $cst0 ;
    public $cst1 ;
    public $cst2 ;
}

function countMonthlyPaysGroups($y, $m, $nUserId,$adType)
{
    $result = new cls_pays();
    try {
        $startDt = strtotime($y.'-'.$m.'-01 00:00:00');
        $endDt   = strtotime(date('Y-m-d 23:59:59',strtotime($y.'-'.$m.' last day of this month')));

        require 'dns.php';
        if ($adType=="0") {
            $sql = "select adwares,max(name) as name, SUM(CASE WHEN state <> 9 THEN 1 ELSE 0 END) AS cnt,SUM(CASE WHEN state = 0 THEN 1 ELSE 0 END) AS cnt0,SUM(CASE WHEN state = 1 THEN 1 ELSE 0 END) AS cnt1,SUM(CASE WHEN state = 2 THEN 1 ELSE 0 END) AS cnt2,SUM(CASE WHEN state <> 9 THEN cost ELSE 0 END) AS cst,SUM(CASE WHEN state = 0 THEN cost ELSE 0 END) AS cst0,SUM(CASE WHEN state = 1 THEN cost ELSE 0 END) AS cst1,SUM(CASE WHEN state = 2 THEN cost ELSE 0 END) AS cst2 from `v_pay_x10` WHERE owner=:owner AND regist BETWEEN :startDt AND :endDt group by adwares";
        }else{
            $sql = "select adwares,max(name) as name, SUM(CASE WHEN state <> 9 THEN 1 ELSE 0 END) AS cnt,SUM(CASE WHEN state = 0 THEN 1 ELSE 0 END) AS cnt0,SUM(CASE WHEN state = 1 THEN 1 ELSE 0 END) AS cnt1,SUM(CASE WHEN state = 2 THEN 1 ELSE 0 END) AS cnt2,SUM(CASE WHEN state <> 9 THEN cost ELSE 0 END) AS cst,SUM(CASE WHEN state = 0 THEN cost ELSE 0 END) AS cst0,SUM(CASE WHEN state = 1 THEN cost ELSE 0 END) AS cst1,SUM(CASE WHEN state = 2 THEN cost ELSE 0 END) AS cst2 from `v_click_pay_x10` WHERE owner=:owner AND regist BETWEEN :startDt AND :endDt group by adwares";
        }
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':owner', $nUserId, PDO::PARAM_STR);
        $stmt->bindParam(':startDt', $startDt, PDO::PARAM_INT);
        $stmt->bindParam(':endDt', $endDt, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result->id = $row['adwares'];
            $result->name = $row['name'];
            $result->cnt = $row['cnt'];
            $result->cnt0 = $row['cnt0'];
            $result->cnt1 = $row['cnt1'];
            $result->cnt2 = $row['cnt2'];
            $result->cst = $row['cst'];
            $result->cst0 = $row['cst0'];
            $result->cst1 = $row['cst1'];
            $result->cst2 = $row['cst2'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $result;
}

function countMonthlyPays($y, $m, $nUserId,$adType)
{
    $result = new cls_pays();
    try {
        $startDt = strtotime($y.'-'.$m.'-01 00:00:00');
        $endDt   = strtotime(date('Y-m-d 23:59:59',strtotime($y.'-'.$m.' last day of this month')));

        require 'dns.php';
        if ($adType=="0") {
            $sql = "select SUM(CASE WHEN state <> 9 THEN 1 ELSE 0 END) AS cnt,SUM(CASE WHEN state = 0 THEN 1 ELSE 0 END) AS cnt0,SUM(CASE WHEN state = 1 THEN 1 ELSE 0 END) AS cnt1,SUM(CASE WHEN state = 2 THEN 1 ELSE 0 END) AS cnt2,SUM(CASE WHEN state <> 9 THEN cost ELSE 0 END) AS cst,SUM(CASE WHEN state = 0 THEN cost ELSE 0 END) AS cst0,SUM(CASE WHEN state = 1 THEN cost ELSE 0 END) AS cst1,SUM(CASE WHEN state = 2 THEN cost ELSE 0 END) AS cst2 from `v_pay_x10` WHERE owner=:owner AND regist BETWEEN :startDt AND :endDt";
        }else{
            $sql = "select SUM(CASE WHEN state <> 9 THEN 1 ELSE 0 END) AS cnt,SUM(CASE WHEN state = 0 THEN 1 ELSE 0 END) AS cnt0,SUM(CASE WHEN state = 1 THEN 1 ELSE 0 END) AS cnt1,SUM(CASE WHEN state = 2 THEN 1 ELSE 0 END) AS cnt2,SUM(CASE WHEN state <> 9 THEN cost ELSE 0 END) AS cst,SUM(CASE WHEN state = 0 THEN cost ELSE 0 END) AS cst0,SUM(CASE WHEN state = 1 THEN cost ELSE 0 END) AS cst1,SUM(CASE WHEN state = 2 THEN cost ELSE 0 END) AS cst2 from `v_click_pay_x10` WHERE owner=:owner AND regist BETWEEN :startDt AND :endDt";
        }
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':owner', $nUserId, PDO::PARAM_STR);
        $stmt->bindParam(':startDt', $startDt, PDO::PARAM_INT);
        $stmt->bindParam(':endDt', $endDt, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result->cnt = $row['cnt'];
            $result->cnt0 = $row['cnt0'];
            $result->cnt1 = $row['cnt1'];
            $result->cnt2 = $row['cnt2'];
            $result->cst = $row['cst'];
            $result->cst0 = $row['cst0'];
            $result->cst1 = $row['cst1'];
            $result->cst2 = $row['cst2'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $result;
}

function countPastPays($y, $m, $nUserId,$adType)
{
    $result = new cls_pays();
    try {
        $startDt = strtotime($y.'-'.$m.'-01 00:00:00');

        require 'dns.php';
        if ($adType=="0") {
            $sql = "select SUM(CASE WHEN state <> 9 THEN 1 ELSE 0 END) AS cnt,SUM(CASE WHEN state = 0 THEN 1 ELSE 0 END) AS cnt0,SUM(CASE WHEN state = 1 THEN 1 ELSE 0 END) AS cnt1,SUM(CASE WHEN state = 2 THEN 1 ELSE 0 END) AS cnt2,SUM(CASE WHEN state <> 9 THEN cost ELSE 0 END) AS cst,SUM(CASE WHEN state = 0 THEN cost ELSE 0 END) AS cst0,SUM(CASE WHEN state = 1 THEN cost ELSE 0 END) AS cst1,SUM(CASE WHEN state = 2 THEN cost ELSE 0 END) AS cst2 from `v_pay_x10` WHERE owner=:owner AND regist < :startDt";
        }else{
            $sql = "select SUM(CASE WHEN state <> 9 THEN 1 ELSE 0 END) AS cnt,SUM(CASE WHEN state = 0 THEN 1 ELSE 0 END) AS cnt0,SUM(CASE WHEN state = 1 THEN 1 ELSE 0 END) AS cnt1,SUM(CASE WHEN state = 2 THEN 1 ELSE 0 END) AS cnt2,SUM(CASE WHEN state <> 9 THEN cost ELSE 0 END) AS cst,SUM(CASE WHEN state = 0 THEN cost ELSE 0 END) AS cst0,SUM(CASE WHEN state = 1 THEN cost ELSE 0 END) AS cst1,SUM(CASE WHEN state = 2 THEN cost ELSE 0 END) AS cst2 from `v_click_pay_x10` WHERE owner=:owner AND regist < :startDt";
        }
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':owner', $nUserId, PDO::PARAM_STR);
        $stmt->bindParam(':startDt', $startDt, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result->cnt = $row['cnt'];
            $result->cnt0 = $row['cnt0'];
            $result->cnt1 = $row['cnt1'];
            $result->cnt2 = $row['cnt2'];
            $result->cst = $row['cst'];
            $result->cst0 = $row['cst0'];
            $result->cst1 = $row['cst1'];
            $result->cst2 = $row['cst2'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $result;
}

function insertAdwares($adwares)
{
    try {
        $adwares->shadow_id = getAdwaresNextId($adwares->approvable);
        if ($adwares->approvable=="0") {
            $adwares->id =  "A".sprintf('%07d', $adwares->shadow_id);
        } else {
            $adwares->id =  "SA".sprintf('%06d', $adwares->shadow_id);
        }
        $dt = strtotime("now");
        require 'dns.php';
        if ($adwares->approvable=="0") {
            $sql = "INSERT  INTO `adwares` (  `shadow_id`,  `delete_key`,  `id`,  `cuser`,  `comment`,  `ad_text`,  `category`,  `banner`,  `banner2`,  `banner3`,  `banner_m`,  `banner_m2`,  `banner_m3`,  `url`,  `url_m`,  `url_over`,  `url_users`,  `name`,  `money`,  `ad_type`,  `click_money`,  `continue_money`,  `continue_type`,  `limits`,  `limit_type`,  `money_count`,  `pay_count`,  `click_money_count`,  `continue_money_count`,  `span`,  `span_type`,  `use_cookie_interval`,  `pay_span`,  `pay_span_type`,  `auto`,  `click_auto`,  `continue_auto`,  `check_type`,  `open`,  `regist`) VALUES (:shadow_id, :delete_key, :id, :cuser, :comment, :ad_text, :category, :banner, :banner2, :banner3, :banner_m, :banner_m2, :banner_m3, :url, :url_m, :url_over, :url_users, :name, :money, :ad_type, :click_money, :continue_money, :continue_type, :limits, :limit_type, :money_count, :pay_count, :click_money_count, :continue_money_count, :span, :span_type, :use_cookie_interval, :pay_span, :pay_span_type, :auto, :click_auto, :continue_auto, :check_type, :open, :regist)";
        } else {
            $sql = "INSERT  INTO `secretadwares`  (  `shadow_id`,  `delete_key`,  `id`,  `cuser`,  `comment`,  `ad_text`,  `category`,  `banner`,  `banner2`,  `banner3`,  `banner_m`,  `banner_m2`,  `banner_m3`,  `url`,  `url_m`,  `url_over`,  `url_users`,  `name`,  `money`,  `ad_type`,  `click_money`,  `continue_money`,  `continue_type`,  `limits`,  `limit_type`,  `money_count`,  `pay_count`,  `click_money_count`,  `continue_money_count`,  `span`,  `span_type`,  `use_cookie_interval`,  `pay_span`,  `pay_span_type`,  `auto`,  `click_auto`,  `continue_auto`,  `check_type`,  `open`, `open_user`,  `regist`) VALUES (:shadow_id, :delete_key, :id, :cuser, :comment, :ad_text, :category, :banner, :banner2, :banner3, :banner_m, :banner_m2, :banner_m3, :url, :url_m, :url_over, :url_users, :name, :money, :ad_type, :click_money, :continue_money, :continue_type, :limits, :limit_type, :money_count, :pay_count, :click_money_count, :continue_money_count, :span, :span_type, :use_cookie_interval, :pay_span, :pay_span_type, :auto, :click_auto, :continue_auto, :check_type, :open, '', :regist)";
        }
        
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':shadow_id', $adwares->shadow_id, PDO::PARAM_INT);
        $stmt->bindParam(':delete_key', $adwares->delete_key, PDO::PARAM_INT);
        $stmt->bindParam(':id', $adwares->id, PDO::PARAM_STR);
        $stmt->bindParam(':cuser', $adwares->cuser, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $adwares->comment, PDO::PARAM_STR);
        $stmt->bindParam(':ad_text', $adwares->ad_text, PDO::PARAM_STR);
        $stmt->bindParam(':category', $adwares->category, PDO::PARAM_STR);
        $stmt->bindParam(':banner', $adwares->banner, PDO::PARAM_STR);
        $stmt->bindParam(':banner2', $adwares->banner2, PDO::PARAM_STR);
        $stmt->bindParam(':banner3', $adwares->banner3, PDO::PARAM_STR);
        $stmt->bindParam(':banner_m', $adwares->banner_m, PDO::PARAM_STR);
        $stmt->bindParam(':banner_m2', $adwares->banner_m2, PDO::PARAM_STR);
        $stmt->bindParam(':banner_m3', $adwares->banner_m3, PDO::PARAM_STR);
        $stmt->bindParam(':url', $adwares->url, PDO::PARAM_STR);
        $stmt->bindParam(':url_m', $adwares->url_m, PDO::PARAM_STR);
        $stmt->bindParam(':url_over', $adwares->url_over, PDO::PARAM_STR);
        $stmt->bindParam(':url_users', $adwares->url_users, PDO::PARAM_INT);
        $stmt->bindParam(':name', $adwares->name, PDO::PARAM_STR);
        $stmt->bindParam(':money', $adwares->money, PDO::PARAM_STR);
        $stmt->bindParam(':ad_type', $adwares->ad_type, PDO::PARAM_STR);
        $stmt->bindParam(':click_money', $adwares->click_money, PDO::PARAM_STR);
        $stmt->bindParam(':continue_money', $adwares->continue_money, PDO::PARAM_STR);
        $stmt->bindParam(':continue_type', $adwares->continue_type, PDO::PARAM_STR);
        $stmt->bindParam(':limits', $adwares->limits, PDO::PARAM_INT);
        $stmt->bindParam(':limit_type', $adwares->limit_type, PDO::PARAM_STR);
        $ZERO = 0;
        $stmt->bindParam(':money_count', $ZERO, PDO::PARAM_INT);
        $stmt->bindParam(':pay_count', $ZERO, PDO::PARAM_INT);
        $stmt->bindParam(':click_money_count', $ZERO, PDO::PARAM_INT);
        $stmt->bindParam(':continue_money_count', $ZERO, PDO::PARAM_INT);
        $stmt->bindParam(':span', $adwares->span, PDO::PARAM_INT);
        $stmt->bindParam(':span_type', $adwares->span_type, PDO::PARAM_STR);
        $stmt->bindParam(':use_cookie_interval', $adwares->use_cookie_interval, PDO::PARAM_INT);
        $stmt->bindParam(':pay_span', $adwares->pay_span, PDO::PARAM_INT);
        $stmt->bindParam(':pay_span_type', $adwares->pay_span_type, PDO::PARAM_STR);
        $stmt->bindParam(':auto', $adwares->auto, PDO::PARAM_STR);
        $stmt->bindParam(':click_auto', $adwares->click_auto, PDO::PARAM_STR);
        $stmt->bindParam(':continue_auto', $adwares->continue_auto, PDO::PARAM_STR);
        $stmt->bindParam(':check_type', $adwares->check_type, PDO::PARAM_STR);
        $stmt->bindParam(':open', $adwares->open, PDO::PARAM_INT);
        $stmt->bindParam(':regist', $dt, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        $insertid = $pdo->lastInsertId();

        $x10 = new cls_x10adwares();
        $x10->shadow_id = $adwares->shadow_id;
        $x10->id = $adwares->id;
        $x10->adware_type = $adwares->adware_type;
        $x10->approvable = $adwares->approvable;
        $x10->keyword = $adwares->keyword;
        $x10->results = $adwares->results;
        $x10->hashtag = $adwares->hashtag;
        $x10->denials = $adwares->denials;
        $x10->ngword = $adwares->ngword;
        $x10->note = $adwares->note;
        $x10->startdt = $adwares->startdt;
        $x10->enddt = $adwares->enddt;
        insertX10Adware($x10);


        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("INSERT ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}



function updateAdwares($adwares)
{
    try {
        require 'dns.php';
        if (substr($adwares->id, 0, 1)=='A') {
            $sql = " UPDATE `adwares`  SET `comment`=:comment,  `ad_text`=:ad_text,  `category`=:category,  `banner`=:banner,  `banner2`=:banner2,  `banner3`=:banner3,  `banner_m`=:banner_m,  `banner_m2`=:banner_m2,  `banner_m3`=:banner_m3,  `url`=:url,  `url_m`=:url_m,  `url_over`=:url_over,  `url_users`=:url_users,  `name`=:name,  `money`=:money,  `ad_type`=:ad_type,  `click_money`=:click_money,  `continue_money`=:continue_money,  `continue_type`=:continue_type,  `limits`=:limits,  `limit_type`=:limit_type,  `money_count`=:money_count,  `pay_count`=:pay_count,  `click_money_count`=:click_money_count,  `continue_money_count`=:continue_money_count,  `span`=:span,  `span_type`=:span_type,  `use_cookie_interval`=:use_cookie_interval,  `pay_span`=:pay_span,  `pay_span_type`=:pay_span_type,  `auto`=:auto,  `click_auto`=:click_auto,  `continue_auto`=:continue_auto,  `check_type`=:check_type,  `open`=:open WHERE shadow_id=:shadow_id";
        } else {
            $sql = " UPDATE `secretadwares`  SET `comment`=:comment,  `ad_text`=:ad_text,  `category`=:category,  `banner`=:banner,  `banner2`=:banner2,  `banner3`=:banner3,  `banner_m`=:banner_m,  `banner_m2`=:banner_m2,  `banner_m3`=:banner_m3,  `url`=:url,  `url_m`=:url_m,  `url_over`=:url_over,  `url_users`=:url_users,  `name`=:name,  `money`=:money,  `ad_type`=:ad_type,  `click_money`=:click_money,  `continue_money`=:continue_money,  `continue_type`=:continue_type,  `limits`=:limits,  `limit_type`=:limit_type,  `money_count`=:money_count,  `pay_count`=:pay_count,  `click_money_count`=:click_money_count,  `continue_money_count`=:continue_money_count,  `span`=:span,  `span_type`=:span_type,  `use_cookie_interval`=:use_cookie_interval,  `pay_span`=:pay_span,  `pay_span_type`=:pay_span_type,  `auto`=:auto,  `click_auto`=:click_auto,  `continue_auto`=:continue_auto,  `check_type`=:check_type,  `open`=:open WHERE shadow_id=:shadow_id";
        }



        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':shadow_id', $adwares->shadow_id, PDO::PARAM_INT);
        $stmt->bindParam(':comment', $adwares->comment, PDO::PARAM_STR);
        $stmt->bindParam(':ad_text', $adwares->ad_text, PDO::PARAM_STR);
        $stmt->bindParam(':category', $adwares->category, PDO::PARAM_STR);
        $stmt->bindParam(':banner', $adwares->banner, PDO::PARAM_STR);
        $stmt->bindParam(':banner2', $adwares->banner2, PDO::PARAM_STR);
        $stmt->bindParam(':banner3', $adwares->banner3, PDO::PARAM_STR);
        $stmt->bindParam(':banner_m', $adwares->banner_m, PDO::PARAM_STR);
        $stmt->bindParam(':banner_m2', $adwares->banner_m2, PDO::PARAM_STR);
        $stmt->bindParam(':banner_m3', $adwares->banner_m3, PDO::PARAM_STR);
        $stmt->bindParam(':url', $adwares->url, PDO::PARAM_STR);
        $stmt->bindParam(':url_m', $adwares->url_m, PDO::PARAM_STR);
        $stmt->bindParam(':url_over', $adwares->url_over, PDO::PARAM_STR);
        $stmt->bindParam(':url_users', $adwares->url_users, PDO::PARAM_STR);
        $stmt->bindParam(':name', $adwares->name, PDO::PARAM_STR);
        $stmt->bindParam(':money', $adwares->money, PDO::PARAM_STR);
        $stmt->bindParam(':ad_type', $adwares->ad_type, PDO::PARAM_STR);
        $stmt->bindParam(':click_money', $adwares->click_money, PDO::PARAM_STR);
        $stmt->bindParam(':continue_money', $adwares->continue_money, PDO::PARAM_STR);
        $stmt->bindParam(':continue_type', $adwares->continue_type, PDO::PARAM_STR);
        $stmt->bindParam(':limits', $adwares->limits, PDO::PARAM_STR);
        $stmt->bindParam(':limit_type', $adwares->limit_type, PDO::PARAM_STR);
        $stmt->bindParam(':money_count', $adwares->money_count, PDO::PARAM_STR);
        $stmt->bindParam(':pay_count', $adwares->pay_count, PDO::PARAM_STR);
        $stmt->bindParam(':click_money_count', $adwares->click_money_count, PDO::PARAM_STR);
        $stmt->bindParam(':continue_money_count', $adwares->continue_money_count, PDO::PARAM_STR);
        $stmt->bindParam(':span', $adwares->span, PDO::PARAM_STR);
        $stmt->bindParam(':span_type', $adwares->span_type, PDO::PARAM_STR);
        $stmt->bindParam(':use_cookie_interval', $adwares->use_cookie_interval, PDO::PARAM_STR);
        $stmt->bindParam(':pay_span', $adwares->pay_span, PDO::PARAM_STR);
        $stmt->bindParam(':pay_span_type', $adwares->pay_span_type, PDO::PARAM_STR);
        $stmt->bindParam(':auto', $adwares->auto, PDO::PARAM_STR);
        $stmt->bindParam(':click_auto', $adwares->click_auto, PDO::PARAM_STR);
        $stmt->bindParam(':continue_auto', $adwares->continue_auto, PDO::PARAM_STR);
        $stmt->bindParam(':check_type', $adwares->check_type, PDO::PARAM_STR);
        $stmt->bindParam(':open', $adwares->open, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        $x10 = new cls_x10adwares();
        $x10->shadow_id = $adwares->shadow_id;
        $x10->id = $adwares->id;
        $x10->adware_type = $adwares->adware_type;
        $x10->approvable = $adwares->approvable;
        $x10->keyword = $adwares->keyword;
        $x10->results = $adwares->results;
        $x10->hashtag = $adwares->hashtag;
        $x10->denials = $adwares->denials;
        $x10->ngword = $adwares->ngword;
        $x10->note = $adwares->note;
        $x10->startdt = $adwares->startdt;
        $x10->enddt = $adwares->enddt;
        updateX10Adware($x10);


        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("UPDATE ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}

function deleteAdwares($adwares)
{
    try {
        require 'dns.php';
        if (substr($adwares->id, 0, 1)=='A') {
            $sql = " UPDATE `adwares` SET `delete_key`=1 WHERE shadow_id=:shadow_id";
        } else {
            $sql = " UPDATE `secretadwares` SET `delete_key`=1 WHERE shadow_id=:shadow_id";
        }

        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':shadow_id', $adwares->shadow_id, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("UPDATE ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}
