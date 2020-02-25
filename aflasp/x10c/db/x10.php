<?php
class cls_secretadwares
{
    public $kind ;
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
    public $category_name ;
    public $adware_type ;
    public $approvable ;
    public $keyword ;
    public $results ;
    public $hashtag ;
    public $denials ;
    public $ngword ;
    public $note ;
    public $startdt ;
    public $enddt ;
    public $cnt_offer ;
}

class cls_x10adwares
{
    public $shadow_id ;
    public $id ;
    public $adware_type ;
    public $approvable ;
    public $keyword ;
    public $results ;
    public $hashtag ;
    public $denials ;
    public $ngword ;
    public $note ;
    public $startdt ;
    public $enddt ;
}

function countAdwares($where)
{
    try {
        $result = 0;
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT count(*) as cnt FROM `v_adwares_x10` WHERE delete_key=0 AND `open`=1 ".$where);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = $row['cnt'];
        }
    } catch (PDOException $e) {
        //
    }
    return $result;
}



function getAdwaresLimit($where, $limit, $offset)
{
    try {
        $results = array();
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `v_adwares_x10` WHERE delete_key=0 AND `open`=1 ".$where." ORDER BY regist desc LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_secretadwares();
            $result->kind = $row['kind'];
            $result->shadow_id = $row['shadow_id'];
            $result->delete_key = $row['delete_key'];
            $result->id = $row['id'];
            $result->cuser = $row['cuser'];
            $result->comment = $row['comment'];
            $result->ad_text = $row['ad_text'];
            $result->category = $row['category'];
            $result->banner = $row['banner'];
            $result->banner2 = $row['banner2'];
            $result->banner3 = $row['banner3'];
            $result->banner_m = $row['banner_m'];
            $result->banner_m2 = $row['banner_m2'];
            $result->banner_m3 = $row['banner_m3'];
            $result->url = $row['url'];
            $result->url_m = $row['url_m'];
            $result->url_over = $row['url_over'];
            $result->url_users = $row['url_users'];
            $result->name = $row['name'];
            $result->money = $row['money'];
            $result->ad_type = $row['ad_type'];
            $result->click_money = $row['click_money'];
            $result->continue_money = $row['continue_money'];
            $result->continue_type = $row['continue_type'];
            $result->limits = $row['limits'];
            $result->limit_type = $row['limit_type'];
            $result->money_count = $row['money_count'];
            $result->pay_count = $row['pay_count'];
            $result->click_money_count = $row['click_money_count'];
            $result->continue_money_count = $row['continue_money_count'];
            $result->span = $row['span'];
            $result->span_type = $row['span_type'];
            $result->use_cookie_interval = $row['use_cookie_interval'];
            $result->pay_span = $row['pay_span'];
            $result->pay_span_type = $row['pay_span_type'];
            $result->auto = $row['auto'];
            $result->click_auto = $row['click_auto'];
            $result->continue_auto = $row['continue_auto'];
            $result->check_type = $row['check_type'];
            $result->open = $row['open'];
            $result->open_user = $row['open_user'];
            $result->regist = $row['regist'];
            $result->category_name = $row['category_name'];
            $result->adware_type = $row['adware_type'];
            $result->approvable = $row['approvable'];
            $result->keyword = $row['keyword'];
            $result->results = $row['results'];
            $result->hashtag = $row['hashtag'];
            $result->denials = $row['denials'];
            $result->ngword = $row['ngword'];
            $result->note = $row['note'];
            $result->startdt = $row['startdt'];
            $result->enddt = $row['enddt'];
            $result->cnt_offer = $row['cnt_offer'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        //
    }
    return $results;
}



function getAdwaresRecentry($days)
{
    try {
        $minusDt = strtotime('-'.$days.'day');
        $tdy = date('Y-m-d');
        $results = array();
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `v_adwares_x10` WHERE delete_key=0 AND regist>:regist AND open=1 AND (enddt IS NULL OR enddt >= :enddt)  ORDER BY regist desc");
        $stmt->bindParam(':regist', $minusDt, PDO::PARAM_INT);
        $stmt->bindParam(':enddt', $tdy, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_secretadwares();
            $result->kind = $row['kind'];
            $result->shadow_id = $row['shadow_id'];
            $result->delete_key = $row['delete_key'];
            $result->id = $row['id'];
            $result->cuser = $row['cuser'];
            $result->comment = $row['comment'];
            $result->ad_text = $row['ad_text'];
            $result->category = $row['category'];
            $result->banner = $row['banner'];
            $result->banner2 = $row['banner2'];
            $result->banner3 = $row['banner3'];
            $result->banner_m = $row['banner_m'];
            $result->banner_m2 = $row['banner_m2'];
            $result->banner_m3 = $row['banner_m3'];
            $result->url = $row['url'];
            $result->url_m = $row['url_m'];
            $result->url_over = $row['url_over'];
            $result->url_users = $row['url_users'];
            $result->name = $row['name'];
            $result->money = $row['money'];
            $result->ad_type = $row['ad_type'];
            $result->click_money = $row['click_money'];
            $result->continue_money = $row['continue_money'];
            $result->continue_type = $row['continue_type'];
            $result->limits = $row['limits'];
            $result->limit_type = $row['limit_type'];
            $result->money_count = $row['money_count'];
            $result->pay_count = $row['pay_count'];
            $result->click_money_count = $row['click_money_count'];
            $result->continue_money_count = $row['continue_money_count'];
            $result->span = $row['span'];
            $result->span_type = $row['span_type'];
            $result->use_cookie_interval = $row['use_cookie_interval'];
            $result->pay_span = $row['pay_span'];
            $result->pay_span_type = $row['pay_span_type'];
            $result->auto = $row['auto'];
            $result->click_auto = $row['click_auto'];
            $result->continue_auto = $row['continue_auto'];
            $result->check_type = $row['check_type'];
            $result->open = $row['open'];
            $result->open_user = $row['open_user'];
            $result->regist = $row['regist'];
            $result->category_name = $row['category_name'];
            $result->adware_type = $row['adware_type'];
            $result->approvable = $row['approvable'];
            $result->keyword = $row['keyword'];
            $result->results = $row['results'];
            $result->hashtag = $row['hashtag'];
            $result->denials = $row['denials'];
            $result->ngword = $row['ngword'];
            $result->note = $row['note'];
            $result->startdt = $row['startdt'];
            $result->enddt = $row['enddt'];
            $result->cnt_offer = $row['cnt_offer'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        //
    }
    return $results;
}



function getAdware($id)
{
    try {
        $result = new cls_secretadwares();
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `v_adwares_x10` WHERE id=:id");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result->kind = $row['kind'];
            $result->shadow_id = $row['shadow_id'];
            $result->delete_key = $row['delete_key'];
            $result->id = $row['id'];
            $result->cuser = $row['cuser'];
            $result->comment = $row['comment'];
            $result->ad_text = $row['ad_text'];
            $result->category = $row['category'];
            $result->banner = $row['banner'];
            $result->banner2 = $row['banner2'];
            $result->banner3 = $row['banner3'];
            $result->banner_m = $row['banner_m'];
            $result->banner_m2 = $row['banner_m2'];
            $result->banner_m3 = $row['banner_m3'];
            $result->url = $row['url'];
            $result->url_m = $row['url_m'];
            $result->url_over = $row['url_over'];
            $result->url_users = $row['url_users'];
            $result->name = $row['name'];
            $result->money = $row['money'];
            $result->ad_type = $row['ad_type'];
            $result->click_money = $row['click_money'];
            $result->continue_money = $row['continue_money'];
            $result->continue_type = $row['continue_type'];
            $result->limits = $row['limits'];
            $result->limit_type = $row['limit_type'];
            $result->money_count = $row['money_count'];
            $result->pay_count = $row['pay_count'];
            $result->click_money_count = $row['click_money_count'];
            $result->continue_money_count = $row['continue_money_count'];
            $result->span = $row['span'];
            $result->span_type = $row['span_type'];
            $result->use_cookie_interval = $row['use_cookie_interval'];
            $result->pay_span = $row['pay_span'];
            $result->pay_span_type = $row['pay_span_type'];
            $result->auto = $row['auto'];
            $result->click_auto = $row['click_auto'];
            $result->continue_auto = $row['continue_auto'];
            $result->check_type = $row['check_type'];
            $result->open = $row['open'];
            $result->open_user = $row['open_user'];
            $result->regist = $row['regist'];
            $result->category_name = $row['category_name'];
            $result->adware_type = $row['adware_type'];
            $result->approvable = $row['approvable'];
            $result->keyword = $row['keyword'];
            $result->results = $row['results'];
            $result->hashtag = $row['hashtag'];
            $result->denials = $row['denials'];
            $result->ngword = $row['ngword'];
            $result->note = $row['note'];
            $result->startdt = $row['startdt'];
            $result->enddt = $row['enddt'];
            $result->cnt_offer = $row['cnt_offer'];
        }
    } catch (PDOException $e) {
        //
    }
    return $result;
}

function insertX10Adware($secretadwares)
{
    try {
        require 'dns.php';
        $sql = "INSERT  INTO `x10_adwares`(`shadow_id`, `id`, `adware_type`, `approvable`, `keyword`, `results`, `hashtag`, `denials`, `ngword`, `note`, `startdt`, `enddt`) VALUES (:shadow_id, :id, :adware_type, :approvable, :keyword, :results, :hashtag, :denials, :ngword, :note, :startdt, :enddt)";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':shadow_id', $secretadwares->shadow_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $secretadwares->id, PDO::PARAM_STR);
        $stmt->bindParam(':adware_type', $secretadwares->adware_type, PDO::PARAM_INT);
        $stmt->bindParam(':approvable', $secretadwares->approvable, PDO::PARAM_INT);
        $stmt->bindParam(':keyword', $secretadwares->keyword, PDO::PARAM_STR);
        $stmt->bindParam(':results', $secretadwares->results, PDO::PARAM_STR);
        $stmt->bindParam(':hashtag', $secretadwares->hashtag, PDO::PARAM_STR);
        $stmt->bindParam(':denials', $secretadwares->denials, PDO::PARAM_STR);
        $stmt->bindParam(':ngword', $secretadwares->ngword, PDO::PARAM_STR);
        $stmt->bindParam(':note', $secretadwares->note, PDO::PARAM_STR);
        if ($secretadwares->startdt=='') {
            $stmt->bindValue(':startdt', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindParam(':startdt', $secretadwares->startdt, PDO::PARAM_STR);
        }
        if ($secretadwares->enddt=='') {
            $stmt->bindValue(':enddt', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindParam(':enddt', $secretadwares->enddt, PDO::PARAM_STR);
        }
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}


function updateX10Adware($secretadwares)
{
    try {
        require 'dns.php';
        $sql = "UPDATE  `x10_adwares` SET `adware_type`=:adware_type,`approvable`=:approvable, `keyword`=:keyword, `results`=:results, `hashtag`=:hashtag, `denials`=:denials, `ngword`=:ngword, `note`=:note, `startdt`=:startdt, `enddt`=:enddt WHERE `id`=:id";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':id', $secretadwares->id, PDO::PARAM_STR);
        $stmt->bindParam(':adware_type', $secretadwares->adware_type, PDO::PARAM_INT);
        $stmt->bindParam(':approvable', $secretadwares->approvable, PDO::PARAM_INT);
        $stmt->bindParam(':keyword', $secretadwares->keyword, PDO::PARAM_STR);
        $stmt->bindParam(':results', $secretadwares->results, PDO::PARAM_STR);
        $stmt->bindParam(':hashtag', $secretadwares->hashtag, PDO::PARAM_STR);
        $stmt->bindParam(':denials', $secretadwares->denials, PDO::PARAM_STR);
        $stmt->bindParam(':ngword', $secretadwares->ngword, PDO::PARAM_STR);
        $stmt->bindParam(':note', $secretadwares->note, PDO::PARAM_STR);
        $stmt->bindParam(':startdt', $secretadwares->startdt, PDO::PARAM_STR);
        $stmt->bindParam(':enddt', $secretadwares->enddt, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
    } catch (PDOException $e) {
        $errorMessage = 'DATABASE ERROR';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}


class cls_categories
{
    public $shadow_id ;
    public $id ;
    public $name ;
}
 function getCategories()
 {
     try {
         $results = array();
         require 'dns.php';
         $stmt = $pdo->prepare("SELECT * FROM `category` WHERE delete_key=0 ORDER BY shadow_id");
         execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $result = new cls_secretadwares();
             $result->shadow_id = $row['shadow_id'];
             $result->id = $row['id'];
             $result->name = $row['name'];
             array_push($results, $result);
         }
     } catch (PDOException $e) {
         //
     }
     return $results;
 }

function getCategory($id)
{
    $result = new cls_secretadwares();
    try {
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `category` WHERE id=:id");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result->shadow_id = $row['shadow_id'];
            $result->id = $row['id'];
            $result->name = $row['name'];
        }
    } catch (PDOException $e) {
        //
    }
    return $result;
}

function doLogin($m_mail, $m_pw)
{
    $result = '';
    try {
        $pw1 = preg_replace('/^\w+:/', '', $m_pw);
        $pw2 = 'AES_OK:'.openssl_encrypt($pw1, 'aes-256-ecb', base64_encode('AES'));

        require 'dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `nuser` WHERE mail=:m_mail and pass=:m_pw and delete_key=0");
        $stmt->bindParam(':m_mail', $m_mail, PDO::PARAM_STR);
        $stmt->bindParam(':m_pw', $pw2, PDO::PARAM_STR);
        $stmt->execute();
        if ($row = $stmt->fetch()) {
            $result = $row['id'];
        }
    } catch (PDOException $e) {
        //
    }
    return $result;
}



class cls_offer
{
    public $adware ;
    public $nuser ;
    public $status ;
    public $regist ;
}
 function getOfferStatus($adware, $nuser)
 {
     $result = new cls_offer();
     try {
         require 'dns.php';
         $stmt = $pdo->prepare("SELECT * FROM `x10_offer` WHERE adware=:adware AND nuser=:nuser");
         $stmt->bindParam(':adware', $adware, PDO::PARAM_STR);
         $stmt->bindParam(':nuser', $nuser, PDO::PARAM_STR);
         execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $result->adware = $row['adware'];
             $result->nuser = $row['nuser'];
             $result->status = $row['status'];
             $result->regist = $row['regist'];
         }
     } catch (PDOException $e) {
         //
     }
     return $result;
 }

 function getOffer($adware)
 {
     try {
        $results = array();
         require 'dns.php';
         $stmt = $pdo->prepare("SELECT * FROM `x10_offer` WHERE adware=:adware ORDER BY `status`,`regist`");
         $stmt->bindParam(':adware', $adware, PDO::PARAM_STR);
         execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_offer();
            $result->adware = $row['adware'];
            $result->nuser = $row['nuser'];
            $result->status = $row['status'];
            $result->regist = $row['regist'];
            array_push($results, $result);
         }
     } catch (PDOException $e) {
         //
     }
     return $results;
 }

 class cls_offering
 {
     public $adware ;
     public $nuser ;
     public $status ;
     public $regist ;
     public $adware_type ;
     public $approvable ;
 }
 function getOfferingAdware($nuser)
 {
     try {
        $results = array();
         require 'dns.php';
         $stmt = $pdo->prepare("SELECT * FROM `v_offer_x10` WHERE nuser=:nuser AND `status`=0 ORDER BY regist desc");
         $stmt->bindParam(':nuser', $nuser, PDO::PARAM_STR);
         execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_offering();
            $result->adware = $row['adware'];
            $result->nuser = $row['nuser'];
            $result->status = $row['status'];
            $result->regist = $row['regist'];
            $result->name = $row['name'];
            $result->adware_type = $row['adware_type'];
            $result->approvable = $row['approvable'];
            array_push($results, $result);
         }
     } catch (PDOException $e) {
         //
     }
     return $results;
 }
 function getApprovedAdwareLimit($nuser, $limit)
 {
     try {
        $results = array();
         require 'dns.php';
         $stmt = $pdo->prepare("SELECT * FROM `v_offer_x10` WHERE nuser=:nuser AND `status`=2 ORDER BY regist desc LIMIT :limit");
         $stmt->bindParam(':nuser', $nuser, PDO::PARAM_STR);
         $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
         execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_offering();
            $result->adware = $row['adware'];
            $result->nuser = $row['nuser'];
            $result->status = $row['status'];
            $result->regist = $row['regist'];
            $result->name = $row['name'];
            $result->adware_type = $row['adware_type'];
            $result->approvable = $row['approvable'];
            array_push($results, $result);
         }
     } catch (PDOException $e) {
         //
     }
     return $results;
 }


function insertX10Offer($ofr)
{
    try {
        require 'dns.php';
        $sql = "INSERT  INTO `x10_offer`(`adware`, `nuser`, `status`, `regist`) VALUES (:adware, :nuser, :status, :regist)";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':adware', $ofr->adware, PDO::PARAM_STR);
        $stmt->bindParam(':nuser', $ofr->nuser, PDO::PARAM_STR);
        $stmt->bindParam(':status', $ofr->status, PDO::PARAM_INT);
        $stmt->bindParam(':regist', strtotime("NOW"), PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
}

function updateX10Offer($adware,$nuser,$status)
{
    try {
        require 'dns.php';
        $sql = "UPDATE `x10_offer` SET `status`=:status WHERE `adware`=:adware AND `nuser`=:nuser ";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':adware', $adware, PDO::PARAM_STR);
        $stmt->bindParam(':nuser', $nuser, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
}

function deleteX10Offer($ofr)
{
    try {
        require 'dns.php';
        $sql = "DELETE FROM `x10_offer` WHERE `adware`=:adware AND `nuser`=:nuser";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':adware', $ofr->adware, PDO::PARAM_STR);
        $stmt->bindParam(':nuser', $ofr->nuser, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
}


class cls_access
{
    public $adware ;
    public $owner ;
    public $name ;
    public $regist ;
}

function countAccess($startdt, $enddt, $nuser)
{
    try {
        $cnt=0;
        $start = empty($startdt) ? strtotime('2000-01-01') : strtotime($startdt);
        $end = empty($enddt) ? strtotime('2038-01-01') : strtotime($enddt);


        $results = array();
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT count(*) as cnt FROM `v_access_x10` WHERE delete_key=0 and owner=:owner and regist BETWEEN :start AND :end ORDER BY regist desc");
        $stmt->bindParam(':owner', $nuser, PDO::PARAM_STR);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':end', $end, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cnt = $row['cnt'];
        }
    } catch (PDOException $e) {
        //
    }
    return $cnt;
}

function getAccessLimit($startdt, $enddt, $nuser, $limit, $offset)
{
    try {
        $start = empty($startdt) ? strtotime('2000-01-01') : strtotime($startdt);
        $end = empty($enddt) ? strtotime('2038-01-01') : strtotime($enddt);


        $results = array();
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `v_access_x10` WHERE delete_key=0 and owner=:owner and regist BETWEEN :start AND :end ORDER BY regist desc LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':owner', $nuser, PDO::PARAM_STR);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':end', $end, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_access();
            $result->adware = $row['adware'];
            $result->owner = $row['owner'];
            $result->name = $row['name'];
            $result->regist = $row['regist'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        //
    }
    return $results;
}


class cls_pay
{
    public $id ;
    public $name ;
    public $state ;
    public $cost ;
    public $regist ;
}

function countPay($startdt, $enddt, $nuser,$adtype)
{
    try {
        $cnt=0;
        $start = empty($startdt) ? strtotime('2000-01-01') : strtotime($startdt);
        $end = empty($enddt) ? strtotime('2038-01-01') : strtotime($enddt);

        $results = array();
        require 'dns.php';
        if($adtype=="0"){
            $sql = "SELECT count(*) as cnt FROM `v_pay_x10_2in1` WHERE adware_type=0 AND delete_key=0 and owner=:owner and regist BETWEEN :start AND :end ORDER BY regist desc";
        }else{
            $sql = "SELECT count(*) as cnt FROM `v_pay_x10_2in1` WHERE adware_type=1 AND delete_key=0 and owner=:owner and regist BETWEEN :start AND :end ORDER BY regist desc";
        }
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':owner', $nuser, PDO::PARAM_STR);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':end', $end, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cnt = $row['cnt'];
        }
    } catch (PDOException $e) {
        //
    }
    return $cnt;
}

function getPayLimit($startdt, $enddt, $nuser,$adtype, $limit, $offset)
{
    try {
        $results = array();
        $start = empty($startdt) ? strtotime('2000-01-01') : strtotime($startdt);
        $end = empty($enddt) ? strtotime('2038-01-01') : strtotime($enddt);

        $results = array();
        require 'dns.php';
        if($adtype=="0"){
            $sql = "SELECT * FROM `v_pay_x10_2in1` WHERE adware_type=0 AND delete_key=0 and owner=:owner and regist BETWEEN :start AND :end ORDER BY regist desc LIMIT :limit OFFSET :offset";
        }else{
            $sql = "SELECT * FROM `v_pay_x10_2in1` WHERE adware_type=1 AND delete_key=0 and owner=:owner and regist BETWEEN :start AND :end ORDER BY regist desc LIMIT :limit OFFSET :offset";
        }
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':owner', $nuser, PDO::PARAM_STR);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':end', $end, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_pay();
            $result->id = $row['id'];
            $result->name = $row['name'];
            $result->state = $row['state'];
            $result->cost = $row['cost'];
            $result->regist = $row['regist'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        //
    }
    return $results;
}
