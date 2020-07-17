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
    public $meyasu ;
    public $results_00 ;
    public $results_10 ;
    public $results_20 ;
    public $results_21 ;
    public $results_22 ;
    public $results_30 ;
    public $results_31 ;

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

function countMonthlyClicks($y, $m, $nUserId, $adType)
{
    $cnt=0;
    try {
        $startDt = strtotime($y.'-'.$m.'-01 00:00:00');
        $endDt   = strtotime(date('Y-m-d 23:59:59', strtotime($y.'-'.$m.' last day of this month')));

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


function countMonthlyClicksAdwares($y, $m, $nUserId, $adwares)
{
    $cnt=0;
    try {
        $startDt = strtotime($y.'-'.$m.'-01 00:00:00');
        $endDt   = strtotime(date('Y-m-d 23:59:59', strtotime($y.'-'.$m.' last day of this month')));

        require 'dns.php';
        $sql = "select count(*) as cnt from `v_access_x10` WHERE owner=:owner AND regist BETWEEN :startDt AND :endDt AND adwares=:adwares";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':owner', $nUserId, PDO::PARAM_STR);
        $stmt->bindParam(':startDt', $startDt, PDO::PARAM_INT);
        $stmt->bindParam(':endDt', $endDt, PDO::PARAM_INT);
        $stmt->bindParam(':adwares', $adwares, PDO::PARAM_STR);
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

function countClicksAdwares($nUserId, $adwares)
{
    $cnt=0;
    try {
        require 'dns.php';
        $sql = "select count(*) as cnt from `v_access_x10` WHERE owner=:owner AND adwares=:adwares";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':owner', $nUserId, PDO::PARAM_STR);
        $stmt->bindParam(':adwares', $adwares, PDO::PARAM_STR);
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
        //$startDt = strtotime($y.'-'.$m.'-01 00:00:00');
        $startDt = strtotime("now");

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
    public $cnt3 ;
    public $cst ;
    public $cst0 ;
    public $cst1 ;
    public $cst2 ;
    public $cst3 ;
    public $startdt ;
    public $enddt ;
    public $limits ;
    public $adware_type ;
    public $approvable ;
    public $stts ;
    public $isFinish ;
}


function getPaysX10Monthly($y, $m, $nUserId)
{
    try {
        $results = array();
        $startDt = strtotime($y.'-'.$m.'-01 00:00:00');
        $endDt   = strtotime(date('Y-m-d 23:59:59', strtotime($y.'-'.$m.' last day of this month')));

        require 'dns.php';

        $sql = "select adwares,max(name) as name, SUM(CASE WHEN state <> 9 THEN 1 ELSE 0 END) AS cnt,SUM(CASE WHEN state = 0 THEN 1 ELSE 0 END) AS cnt0,SUM(CASE WHEN state = 1 THEN 1 ELSE 0 END) AS cnt1,SUM(CASE WHEN state = 2 THEN 1 ELSE 0 END) AS cnt2,SUM(CASE WHEN state <> 9 THEN cost ELSE 0 END) AS cst,SUM(CASE WHEN state = 0 THEN cost ELSE 0 END) AS cst0,SUM(CASE WHEN state = 1 THEN cost ELSE 0 END) AS cst1,SUM(CASE WHEN state = 2 THEN cost ELSE 0 END) AS cst2, max(startdt) as startdt, max(enddt) as enddt, max(adware_type) as adware_type, max(approvable) as approvable  from `v_pay_x10` WHERE owner=:owner AND regist BETWEEN :startDt AND :endDt group by adwares";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':owner', $nUserId, PDO::PARAM_STR);
        $stmt->bindParam(':startDt', $startDt, PDO::PARAM_INT);
        $stmt->bindParam(':endDt', $endDt, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_pays();
            $result->id = $row['adwares'];
            $result->name = $row['name'];
            $result->startdt = $row['startdt'];
            $result->enddt = $row['enddt'];
            $result->adware_type = $row['adware_type'];
            $result->approvable = $row['approvable'];
            $result->cnt = $row['cnt'];
            $result->cnt0 = $row['cnt0'];
            $result->cnt1 = $row['cnt1'];
            $result->cnt2 = $row['cnt2'];
            $result->cst = $row['cst'];
            $result->cst0 = $row['cst0'];
            $result->cst1 = $row['cst1'];
            $result->cst2 = $row['cst2'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $results;
}


function getPaysX10MonthlyAT2($y, $m, $nUserId)
{
    $results = array();
    try {
        $startDt = strtotime($y.'-'.$m.'-01 00:00:00');
        $endDt   = strtotime(date('Y-m-d 23:59:59', strtotime($y.'-'.$m.' last day of this month')));

        require 'dns.php';
        
        $sql = "select adware,max(name) as name,  SUM(CASE WHEN status <> 9 THEN 1 ELSE 0 END) AS cnt,SUM(CASE WHEN status = 10 THEN 1 ELSE 0 END) AS cnt0,SUM(CASE WHEN status = 11 THEN 1  WHEN status = 14 THEN 1 ELSE 0 END) AS cnt1,SUM(CASE WHEN status = 12 THEN 1 ELSE 0 END) AS cnt2,SUM(CASE WHEN status = 13 THEN 1 ELSE 0 END) AS cnt3,SUM(CASE WHEN status <> 9 THEN money ELSE 0 END) AS cst,SUM(CASE WHEN status = 10 THEN money ELSE 0 END) AS cst0,SUM(CASE WHEN status = 11 THEN money  WHEN status = 14 THEN money ELSE 0 END) AS cst1,SUM(CASE WHEN status = 12 THEN money ELSE 0 END) AS cst2,SUM(CASE WHEN status = 13 THEN money ELSE 0 END) AS cst3, max(adware_type) as adware_type, max(isFinish) as isFinish from `v_offer_x10` WHERE adware_type=2 AND nuser=:nuser AND edittime BETWEEN :startDt AND :endDt group by adware";

        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':nuser', $nUserId, PDO::PARAM_STR);
        $stmt->bindParam(':startDt', $startDt, PDO::PARAM_INT);
        $stmt->bindParam(':endDt', $endDt, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_pays();
            $result->id = $row['adware'];
            $result->name = $row['name'];
            $result->cnt = $row['cnt'];
            $result->cnt0 = $row['cnt0'];
            $result->cnt1 = $row['cnt1'];
            $result->cnt2 = $row['cnt2'];
            $result->cnt3 = $row['cnt3'];
            $result->cst = $row['cst'];
            $result->cst0 = $row['cst0'];
            $result->cst1 = $row['cst1'];
            $result->cst2 = $row['cst2'];
            $result->cst3 = $row['cst3'];
            $result->adware_type = $row['adware_type'];
            $result->isFinish = $row['isFinish'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $results;
}


function getPaysX10AT2($nUserId)
{
    $results = array();
    try {
        // $startDt = strtotime($y.'-'.$m.'-01 00:00:00');
        // $endDt   = strtotime(date('Y-m-d 23:59:59', strtotime($y.'-'.$m.' last day of this month')));

        require 'dns.php';
        
        $sql = "select adware,max(name) as name,  SUM(CASE WHEN status <> 9 THEN 1 ELSE 0 END) AS cnt,SUM(CASE WHEN status = 10 THEN 1 ELSE 0 END) AS cnt0,SUM(CASE WHEN status = 11 THEN 1 ELSE 0 END) AS cnt1,SUM(CASE WHEN status = 12 THEN 1 ELSE 0 END) AS cnt2,SUM(CASE WHEN status = 13 THEN 1 ELSE 0 END) AS cnt3,SUM(CASE WHEN status <> 9 THEN money ELSE 0 END) AS cst,SUM(CASE WHEN status = 10 THEN money ELSE 0 END) AS cst0,SUM(CASE WHEN status = 11 THEN money ELSE 0 END) AS cst1,SUM(CASE WHEN status = 12 THEN money ELSE 0 END) AS cst2,SUM(CASE WHEN status = 13 THEN money ELSE 0 END) AS cst3, max(adware_type) as adware_type, max(isFinish) as isFinish from `v_offer_x10` WHERE adware_type=2 AND nuser=:nuser group by adware";

        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':nuser', $nUserId, PDO::PARAM_STR);
        // $stmt->bindParam(':startDt', $startDt, PDO::PARAM_INT);
        // $stmt->bindParam(':endDt', $endDt, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_pays();
            $result->id = $row['adware'];
            $result->name = $row['name'];
            $result->cnt = $row['cnt'];
            $result->cnt0 = $row['cnt0'];
            $result->cnt1 = $row['cnt1'];
            $result->cnt2 = $row['cnt2'];
            $result->cnt3 = $row['cnt3'];
            $result->cst = $row['cst'];
            $result->cst0 = $row['cst0'];
            $result->cst1 = $row['cst1'];
            $result->cst2 = $row['cst2'];
            $result->cst3 = $row['cst3'];
            $result->adware_type = $row['adware_type'];
            $result->isFinish = $row['isFinish'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $results;
}


function getPaysX10($nUserId)
{
    try {
        $results = array();

        require 'dns.php';
        // $sql = "select adwares,max(name) as name, max(limits) as limits, SUM(CASE WHEN state <> 9 THEN 1 ELSE 0 END) AS cnt,SUM(CASE WHEN state = 0 THEN 1 ELSE 0 END) AS cnt0,SUM(CASE WHEN state = 1 THEN 1 ELSE 0 END) AS cnt1,SUM(CASE WHEN state = 2 THEN 1 ELSE 0 END) AS cnt2,SUM(CASE WHEN state <> 9 THEN cost ELSE 0 END) AS cst,SUM(CASE WHEN state = 0 THEN cost ELSE 0 END) AS cst0,SUM(CASE WHEN state = 1 THEN cost ELSE 0 END) AS cst1,SUM(CASE WHEN state = 2 THEN cost ELSE 0 END) AS cst2, max(startdt) as startdt, max(enddt) as enddt, max(adware_type) as adware_type, max(approvable) as approvable from `v_pay_x10` WHERE owner=:owner group by adwares";
        $sql = "select x.id,x.name as xname,x.startdt as xstartdt,x.enddt as xenddt,x.limits as xlimits,x.adware_type as xadware_type,x.approvable as xapprovable, x.stts as xstts,x.isFinish as xisFinish, p.* from `x10_all_adwares` x LEFT JOIN `v_pay_x10_by_owner` p ON p.owner=:owner AND p.adwares=x.id  where (x.nuser='OPN' OR x.nuser=:owner) AND (x.status=2 OR x.status>=12)";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':owner', $nUserId, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_pays();
            $result->id = $row['id'];
            $result->name = $row['xname'];
            $result->startdt = $row['xstartdt'];
            $result->enddt = $row['xenddt'];
            $result->limits = is_null($row['xlimits']) ? 0 : $row['xlimits'];
            $result->adware_type = $row['xadware_type'];
            $result->approvable = $row['xapprovable'];
            $result->cnt = is_null($row['cnt']) ? 0 : $row['cnt'];
            $result->cnt0 = is_null($row['cnt0']) ? 0 : $row['cnt0'];
            $result->cnt1 = is_null($row['cnt1']) ? 0 : $row['cnt1'];
            $result->cnt2 = is_null($row['cnt2']) ? 0 : $row['cnt2'];
            $result->cst = is_null($row['cst']) ? 0 : $row['cst'];
            $result->cst0 = is_null($row['cst0']) ? 0 : $row['cst0'];
            $result->cst1 = is_null($row['cst1']) ? 0 : $row['cst1'];
            $result->cst2 = is_null($row['cst2']) ? 0 : $row['cst2'];
            $result->stts = $row['xstts'];
            $result->isFinish = $row['xisFinish'];
            logging($result->id);
            logging($result->isFinish);
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $results;
}


function countMonthlyPays($y, $m, $nUserId, $adType)
{
    $result = new cls_pays();
    try {
        $startDt = strtotime($y.'-'.$m.'-01 00:00:00');
        $endDt   = strtotime(date('Y-m-d 23:59:59', strtotime($y.'-'.$m.' last day of this month')));

        require 'dns.php';
        
        $sql = "select SUM(CASE WHEN state <> 9 THEN 1 ELSE 0 END) AS cnt,SUM(CASE WHEN state = 0 THEN 1 ELSE 0 END) AS cnt0,SUM(CASE WHEN state = 1 THEN 1 ELSE 0 END) AS cnt1,SUM(CASE WHEN state = 2 THEN 1 ELSE 0 END) AS cnt2,SUM(CASE WHEN state <> 9 THEN cost ELSE 0 END) AS cst,SUM(CASE WHEN state = 0 THEN cost ELSE 0 END) AS cst0,SUM(CASE WHEN state = 1 THEN cost ELSE 0 END) AS cst1,SUM(CASE WHEN state = 2 THEN cost ELSE 0 END) AS cst2 from `v_pay_x10` WHERE adware_type=:adware_type AND owner=:owner AND regist BETWEEN :startDt AND :endDt";

        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':owner', $nUserId, PDO::PARAM_STR);
        $stmt->bindParam(':startDt', $startDt, PDO::PARAM_INT);
        $stmt->bindParam(':endDt', $endDt, PDO::PARAM_INT);
        $stmt->bindParam(':adware_type', $adType, PDO::PARAM_INT);
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

function countMonthlyPaysAT2($y, $m, $nUserId)
{
    $result = new cls_pays();
    try {
        $startDt = strtotime($y.'-'.$m.'-01 00:00:00');
        $endDt   = strtotime(date('Y-m-d 23:59:59', strtotime($y.'-'.$m.' last day of this month')));

        require 'dns.php';
        
        $sql = "select SUM(CASE WHEN status <> 9 THEN 1 ELSE 0 END) AS cnt,SUM(CASE WHEN status = 10 THEN 1 ELSE 0 END) AS cnt0,SUM(CASE WHEN status = 11 THEN 1 WHEN status = 14 THEN 1 ELSE 0 END) AS cnt1,SUM(CASE WHEN status = 12 THEN 1 ELSE 0 END) AS cnt2,SUM(CASE WHEN status = 13 THEN 1 ELSE 0 END) AS cnt3,SUM(CASE WHEN status <> 9 THEN money ELSE 0 END) AS cst,SUM(CASE WHEN status = 10 THEN money ELSE 0 END) AS cst0,SUM(CASE WHEN status = 11 THEN money  WHEN status = 14 THEN money ELSE 0 END) AS cst1,SUM(CASE WHEN status = 12 THEN money ELSE 0 END) AS cst2,SUM(CASE WHEN status = 13 THEN money ELSE 0 END) AS cst3 from `v_offer_x10` WHERE adware_type=2 AND nuser=:nuser AND edittime BETWEEN :startDt AND :endDt";

        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':nuser', $nUserId, PDO::PARAM_STR);
        $stmt->bindParam(':startDt', $startDt, PDO::PARAM_INT);
        $stmt->bindParam(':endDt', $endDt, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result->cnt = $row['cnt'];
            $result->cnt0 = $row['cnt0'];
            $result->cnt1 = $row['cnt1'];
            $result->cnt2 = $row['cnt2'];
            $result->cnt3 = $row['cnt3'];
            $result->cst = $row['cst'];
            $result->cst0 = $row['cst0'];
            $result->cst1 = $row['cst1'];
            $result->cst2 = $row['cst2'];
            $result->cst3 = $row['cst3'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
    return $result;
}

function countPastPays($y, $m, $nUserId, $adType)
{
    $result = new cls_pays();
    try {
        require 'dns.php';
        $sql = "select SUM(CASE WHEN state <> 9 THEN 1 ELSE 0 END) AS cnt,SUM(CASE WHEN state = 0 THEN 1 ELSE 0 END) AS cnt0,SUM(CASE WHEN state = 1 THEN 1 ELSE 0 END) AS cnt1,SUM(CASE WHEN state = 2 THEN 1 ELSE 0 END) AS cnt2,SUM(CASE WHEN state <> 9 THEN cost ELSE 0 END) AS cst,SUM(CASE WHEN state = 0 THEN cost ELSE 0 END) AS cst0,SUM(CASE WHEN state = 1 THEN cost ELSE 0 END) AS cst1,SUM(CASE WHEN state = 2 THEN cost ELSE 0 END) AS cst2 from `v_pay_x10` WHERE adware_type=:adware_type AND owner=:owner";

        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':owner', $nUserId, PDO::PARAM_STR);
        $stmt->bindParam(':adware_type', $adType, PDO::PARAM_INT);
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


function countPastPaysAT2($y, $m, $nUserId)
{
    $result = new cls_pays();
    try {
        require 'dns.php';
        
        $sql = "select SUM(CASE WHEN status <> 9 THEN 1 ELSE 0 END) AS cnt,SUM(CASE WHEN status = 10 THEN 1 ELSE 0 END) AS cnt0,SUM(CASE WHEN status = 11 THEN 1 ELSE 0 END) AS cnt1,SUM(CASE WHEN status = 12 THEN 1 ELSE 0 END) AS cnt2,SUM(CASE WHEN status = 13 THEN 1 ELSE 0 END) AS cnt3,SUM(CASE WHEN status <> 9 THEN money ELSE 0 END) AS cst,SUM(CASE WHEN status = 10 THEN money ELSE 0 END) AS cst0,SUM(CASE WHEN status = 11 THEN money ELSE 0 END) AS cst1,SUM(CASE WHEN status = 12 THEN money ELSE 0 END) AS cst2,SUM(CASE WHEN status = 13 THEN money ELSE 0 END) AS cst3 from `v_offer_x10` WHERE adware_type=2 AND nuser=:nuser";

        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':nuser', $nUserId, PDO::PARAM_STR);
        $stmt->bindParam(':endDt', $endDt, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result->cnt = $row['cnt'];
            $result->cnt0 = $row['cnt0'];
            $result->cnt1 = $row['cnt1'];
            $result->cnt2 = $row['cnt2'];
            $result->cnt3 = $row['cnt3'];
            $result->cst = $row['cst'];
            $result->cst0 = $row['cst0'];
            $result->cst1 = $row['cst1'];
            $result->cst2 = $row['cst2'];
            $result->cst3 = $row['cst3'];
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
        $x10->meyasu = $adwares->meyasu;
        $x10->startdt = $adwares->startdt;
        $x10->enddt = $adwares->enddt;
        $x10->cuser = $adwares->cuser;
        $x10->results_00 = $adwares->results_00;
        $x10->results_10 = $adwares->results_10;
        $x10->results_20 = $adwares->results_20;
        $x10->results_21 = $adwares->results_21;
        $x10->results_22 = $adwares->results_22;
        $x10->results_30 = $adwares->results_30;
        $x10->results_31 = $adwares->results_31;
        insertX10Adware($x10);

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("INSERT ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }


        $kword = explode(' ', $adwares->keyword);
        foreach ($kword as $word) {
            if (!empty($word)) {
                $stmt = $pdo -> prepare("SELECT count(*) as cnt FROM `x10_keyword` WHERE `keyword`=:keyword");
                $stmt->bindParam(':keyword', $word, PDO::PARAM_STR);
                execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $cnt = $row['cnt'];
                $stmt=null;

                if ($cnt=="0") {
                    $sql = "INSERT INTO `x10_keyword` (`adware_type`,  `keyword`) VALUES (:adware_type, :keyword)";
                    $stmt = $pdo -> prepare($sql);
                    $stmt->bindParam(':adware_type', $adwares->adware_type, PDO::PARAM_STR);
                    $stmt->bindParam(':keyword', $word, PDO::PARAM_STR);
                    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
                }
            }
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
        $x10->meyasu = $adwares->meyasu;
        $x10->startdt = $adwares->startdt;
        $x10->enddt = $adwares->enddt;
        $x10->cuser = $adwares->cuser;
        $x10->results_00 = $adwares->results_00;
        $x10->results_10 = $adwares->results_10;
        $x10->results_20 = $adwares->results_20;
        $x10->results_21 = $adwares->results_21;
        $x10->results_22 = $adwares->results_22;
        $x10->results_30 = $adwares->results_30;
        $x10->results_31 = $adwares->results_31;
        updateX10Adware($x10);


        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("UPDATE ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
        $stmt=null;

        $kword = explode(' ', $adwares->keyword);
        foreach ($kword as $word) {
            if (!empty($word)) {
                $stmt = $pdo -> prepare("SELECT count(*) as cnt FROM `x10_keyword` WHERE `keyword`=:keyword");
                $stmt->bindParam(':keyword', $word, PDO::PARAM_STR);
                execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $cnt = $row['cnt'];
                $stmt=null;

                if ($cnt=="0") {
                    $sql = "INSERT INTO `x10_keyword` (`adware_type`,  `keyword`) VALUES (:adware_type, :keyword)";
                    $stmt = $pdo -> prepare($sql);
                    $stmt->bindParam(':adware_type', $adwares->adware_type, PDO::PARAM_STR);
                    $stmt->bindParam(':keyword', $word, PDO::PARAM_STR);
                    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
                }
            }
        }
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}



function updateAdwareOpenUser($adId, $nusers)
{
    try {
        require 'dns.php';
        if (substr($adId, 0, 1)=='A') {
            $sql = " UPDATE `adwares` SET `open_user`=:open_user WHERE id=:id";
        } else {
            $sql = " UPDATE `secretadwares` SET `open_user`=:open_user WHERE id=:id";
        }

        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':id', $adId, PDO::PARAM_STR);
        $stmt->bindParam(':open_user', $nusers, PDO::PARAM_STR);
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

function stopAdwares($adwares)
{
    try {
        require 'dns.php';

        $ad = getAdware($adwares->id);

        $startdt = date('Y-m-d', $ad->regist);
        $enddt = date('Y-m-d', strtotime('tomorrow'));


        $sql = " UPDATE `x10_adwares` SET `startdt`=:startdt, `enddt`=:enddt WHERE id=:id";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':id', $ad->id, PDO::PARAM_STR);
        $stmt->bindParam(':startdt', $startdt, PDO::PARAM_STR);
        $stmt->bindParam(':enddt', $enddt, PDO::PARAM_STR);
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
