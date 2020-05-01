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
    public $cnt_post ;
    public $stts ;
    public $isFinish ;
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
    public $cuser ;
}

function countAdwares($where)
{
    try {
        $result = 0;
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT count(*) as cnt FROM `v_adwares_status` WHERE delete_key=0  ".$where);
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
        $stmt = $pdo->prepare("SELECT * FROM `v_adwares_status` WHERE delete_key=0  ".$where." ORDER BY regist desc LIMIT :limit OFFSET :offset");
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
            $result->cnt_post = $row['cnt_post'];
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
            $result->cnt_post = $row['cnt_post'];
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
        $stmt = $pdo->prepare("SELECT * FROM `v_adwares_status` WHERE id=:id");
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
            $result->cnt_post = $row['cnt_post'];
            $result->stts = $row['stts'];
            $result->isFinish = $row['isFinish'];
        }
    } catch (PDOException $e) {
        //
    }
    return $result;
}

function getAdwareStatus($id)
{
    $stts = 0;

    $ad = getAdware($id);
    $alrt = $ad->limits * 0.7;

    $tdy = date('Y-m-d');
    $nextWeekYMD = date('Y-m-d', strtotime('next week'));

    require 'dns.php';
    $stmt = $pdo->prepare("SELECT SUM(cost) as cost FROM `v_pay_x10` WHERE adwares=:adwares and state=2 GROUP BY adwares");
    $stmt->bindParam(':adwares', $id, PDO::PARAM_STR);
    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
    $rslt = $stmt->fetch(PDO::FETCH_ASSOC);
    $pay =  $rslt['cost'];

    if (!empty($ad->enddt)) {
        if ($ad->enddt<$tdy) {
            //期間終了
            $stts = 20;
        } elseif ($ad->enddt<$$nextWeekYMD) {
            //期限注意
            $stts = 10;
        }
    }
    if (is_null($ad->limits) || $ad->limits=="0") {
        $stts += 0;
    } elseif ($ad->limits<$pay) {
        //期間終了
        $stts += 2;
    } elseif ($alrt<$pay) {
        //期限注意
        $stts += 1;
    }

    return $stts;
}

function isAdwareFinish($stts)
{
    $rtn=0;
    switch ($stts) {
        case 22:
        case 21:
        case 20:
        case 12:
        case 2:
        $rtn = 1;
    }
    return $rtn;
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
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
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

 function getOffer($adware, $where)
 {
     try {
         $results = array();
         require 'dns.php';
         $stmt = $pdo->prepare("SELECT * FROM `x10_offer` WHERE adware=:adware ".$where." ORDER BY `status`,`regist`");
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
     public $cuser ;
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
         $stmt = $pdo->prepare("SELECT * FROM `v_offer_x10` WHERE nuser=:nuser AND (`status`=0 OR `status`=10) ORDER BY regist desc");
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

 function countOfferingAdware($cuser)
 {
     try {
         $cnt = 0;
         require 'dns.php';
         $stmt = $pdo->prepare("SELECT count(*) as cnt FROM `v_offer_x10` WHERE cuser=:cuser AND `status`=0 ORDER BY regist desc");
         $stmt->bindParam(':cuser', $cuser, PDO::PARAM_STR);
         execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $cnt = $row['cnt'];
         }
     } catch (PDOException $e) {
         //
     }
     return $cnt;
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
        $sql = "INSERT  INTO `x10_offer`(`adware`, `nuser`, `status`, `regist`, `edittime`) VALUES (:adware, :nuser, :status, :regist, :edittime)";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':adware', $ofr->adware, PDO::PARAM_STR);
        $stmt->bindParam(':nuser', $ofr->nuser, PDO::PARAM_STR);
        $stmt->bindParam(':status', $ofr->status, PDO::PARAM_INT);
        $stmt->bindParam(':regist', strtotime("NOW"), PDO::PARAM_INT);
        $stmt->bindParam(':edittime', strtotime("NOW"), PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
}

function updateX10Offer($adware, $nuser, $status)
{
    try {
        require 'dns.php';
        $sql = "UPDATE `x10_offer` SET `status`=:status,edittime=:edittime WHERE `adware`=:adware AND `nuser`=:nuser ";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':adware', $adware, PDO::PARAM_STR);
        $stmt->bindParam(':nuser', $nuser, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':edittime', strtotime("NOW"), PDO::PARAM_INT);
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
    public $adware_type ;
    public $approvable ;
    public $stts ;
    public $isFinish ;
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
        $stmt = $pdo->prepare("SELECT a.*,v.stts, v.isFinish FROM `v_access_x10` as a LEFT JOIN `v_adwares_status` as v ON a.adwares=v.id WHERE a.delete_key=0 and a.owner=:owner and a.regist BETWEEN :start AND :end ORDER BY a.regist desc LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':owner', $nuser, PDO::PARAM_STR);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':end', $end, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_access();
            $result->adware = $row['adwares'];
            $result->owner = $row['owner'];
            $result->name = $row['name'];
            $result->regist = $row['regist'];
            $result->approvable = $row['approvable'];
            $result->adware_type = $row['adware_type'];
            $result->stts = $row['stts'];
            $result->isFinish = $row['isFinish'];
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

function countPay($startdt, $enddt, $nuser, $adtype)
{
    try {
        $cnt=0;
        $start = empty($startdt) ? strtotime('2000-01-01') : strtotime($startdt);
        $end = empty($enddt) ? strtotime('2038-01-01') : strtotime($enddt);

        $results = array();
        require 'dns.php';
        if ($adtype=="0") {
            $sql = "SELECT count(*) as cnt FROM `v_pay_x10` WHERE adware_type=0 AND delete_key=0 and owner=:owner and regist BETWEEN :start AND :end ORDER BY regist desc";
        } else {
            $sql = "SELECT count(*) as cnt FROM `v_pay_x10` WHERE adware_type=1 AND delete_key=0 and owner=:owner and regist BETWEEN :start AND :end ORDER BY regist desc";
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

function getPayLimit($startdt, $enddt, $nuser, $adtype, $limit, $offset)
{
    try {
        $results = array();
        $start = empty($startdt) ? strtotime('2000-01-01') : strtotime($startdt);
        $end = empty($enddt) ? strtotime('2038-01-01') : strtotime($enddt);

        $results = array();
        require 'dns.php';
        $sql = "SELECT * FROM `v_pay_x10` WHERE adware_type=:adware_type AND delete_key=0 and owner=:owner and regist BETWEEN :start AND :end ORDER BY regist desc LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':owner', $nuser, PDO::PARAM_STR);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':end', $end, PDO::PARAM_INT);
        $stmt->bindParam(':adware_type', $adtype, PDO::PARAM_INT);
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

class cls_keyword
{
    public $adware_type ;
    public $keyword ;
}

function getKeywords()
{
    try {
        $results = array();
        require 'dns.php';

        $sql = "SELECT * FROM `x10_keyword` ORDER BY `keyword`";
        $stmt = $pdo->prepare($sql);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_keyword();
            $result->adware_type = $row['adware_type'];
            $result->keyword = $row['keyword'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        //
    }
    return $results;
}

function abbrStr($str, $len)
{
    if (mb_strlen($str)>$len) {
        $str = mb_substr($str, 0, $len).'[...]';
    }
    return $str;
}



class cls_x10mail
{
    public $id ;
    public $nuser ;
    public $mail ;
    public $limittime ;
    public $stts ;
}

function getX10Mail($id)
{
    try {
        $result = new cls_x10mail();
        require 'dns.php';

        $sql = "SELECT * FROM `x10_mail` WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result->id = $row['id'];
            $result->nuser= $row['nuser'];
            $result->mail= $row['mail'];
            $result->limittime= $row['limittime'];
            $result->stts= $row['stts'];
        }
    } catch (PDOException $e) {
        //
    }
    return $result;
}

function getX10MailStts0($nuser)
{
    try {
        $result = new cls_x10mail();
        require 'dns.php';

        $sql = "SELECT * FROM `x10_mail` WHERE nuser=:nuser AND stts=0";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nuser', $nuser, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result->id = $row['id'];
            $result->nuser= $row['nuser'];
            $result->mail= $row['mail'];
            $result->limittime= $row['limittime'];
            $result->stts= $row['stts'];
        }
    } catch (PDOException $e) {
        //
    }
    return $result;
}


function countX10Mail($nuser)
{
    try {
        $cnt = 0;
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT count(*) as cnt FROM `x10_mail` WHERE nuser=:nuser");
        $stmt->bindParam(':nuser', $nuser, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $cnt = $row['cnt'];
    } catch (PDOException $e) {
        //
    }
    return $cnt;
}


function insertX10Mail($x10mail)
{
    try {
        $insertid = 0;

        require 'dns.php';
        $sql = "UPDATE `x10_mail` SET `stts`=1  WHERE  nuser=:nuser AND `stts`=0";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':nuser', $x10mail->nuser, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);


        $sql = "INSERT INTO `x10_mail`(`nuser`, `mail`, `limittime`, `stts`) VALUES (:nuser, :mail, :limittime, 0)";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':nuser', $x10mail->nuser, PDO::PARAM_STR);
        $stmt->bindParam(':mail', $x10mail->mail, PDO::PARAM_STR);
        $stmt->bindParam(':limittime', $x10mail->limittime, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        $insertid = $pdo->lastInsertId();

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
    return $insertid;
}


function activateX10Mail($x10mail)
{
    try {
        require 'dns.php';
        $sql = "UPDATE `x10_mail` SET `stts`=2  WHERE  id=:id";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':id', $x10mail->id, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        $sql = "UPDATE `nuser` SET `mail`=:mail  WHERE  id=:id";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':id', $x10mail->nuser, PDO::PARAM_STR);
        $stmt->bindParam(':mail', $x10mail->mail, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

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
    return $insertid;
}



function insertPost($adwares, $cuser, $nuser)
{
    $ad = getAdware($adwares);

    require 'dns.php';
    $stmt = $pdo->prepare("SELECT MAX(shadow_id) as shadow_id, MAX(id) as id FROM `pay`");
    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $shadow_id= is_null($row['shadow_id']) ? 0 : $row['shadow_id'];
    $id= is_null($row['id']) ? 0 : $row['id'];
    $new_id = $shadow_id>$id ? $shadow_id + 1 : $id + 1;
    $stmt=null;

    $sql = "INSERT INTO `pay`(`shadow_id`, `delete_key`, `id`, `access_id`, `ipaddress`, `cookie`, `owner`, `adwares_type`, `adwares`, `cuser`, `cost`, `sales`, `froms`, `froms_sub`, `state`, `is_notice`, `utn`, `useragent`, `continue_uid`, `report_id`, `regist`) VALUES (:shadow_id, 0, :id, '', '', '', :owner, :adwares_type, :adwares, :cuser, :cost, 0, '', '', 0, 0, '', '', '', '', :regist)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':shadow_id', $new_id, PDO::PARAM_INT);
    $stmt->bindParam(':id', $new_id, PDO::PARAM_INT);
    $stmt->bindParam(':owner', $nuser, PDO::PARAM_STR);
    $stmt->bindParam(':adwares', $adwares, PDO::PARAM_STR);
    $adType = substr($adwares, 0, 1)=="A" ? "adwares" : "secretAdwares";
    $stmt->bindParam(':adwares_type', $adType, PDO::PARAM_STR);
    $stmt->bindParam(':cuser', $cuser, PDO::PARAM_STR);
    $stmt->bindParam(':cost', $ad->money, PDO::PARAM_STR);
    $stmt->bindParam(':regist', strtotime("NOW"), PDO::PARAM_INT);

    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

    if ($stmt->rowCount()==0) {
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("INSERT ERROR : ". $sql);
        logging("ARGS : ". json_encode(func_get_args()));
    }

    $stmt=null;
}


function deletePost($adwares, $cuser, $nuser)
{
    require 'dns.php';

    $sql = "DELETE FROM `pay` WHERE `owner`=:owner AND `adwares`=:adwares";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':owner', $nuser, PDO::PARAM_STR);
    $stmt->bindParam(':adwares', $adwares, PDO::PARAM_STR);

    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

    // if ($stmt->rowCount()==0) {
    //     logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
    //     logging("DELETE ERROR : ". $sql);
    //     logging("ARGS : ". json_encode(func_get_args()));
    // }
}


function getCostAT2($adware)
{
    try {
        $result = 0;
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT SUM(money) as money FROM `v_offer_x10` WHERE (status=10 OR status=12 OR status=13) AND `adware`=:adware");
        $stmt->bindParam(':adware', $adware, PDO::PARAM_STR);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result->owner = $row['money'];
        }
    } catch (PDOException $e) {
        //
    }
    return $result;
}



class cls_post
{
    public $owner ;
    public $adwares ;
    public $cuser ;
    public $cost ;
    public $state ;
    public $regist ;
    public $name ;
}

function getPosts($where)
{
    try {
        $results = array();
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT `pay`.*, `ad`.`name` FROM `pay` LEFT JOIN `v_adwares_status` as `ad` ON `pay`.`adwares`=`ad`.`id` ".$where);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_post();
            $result->owner = $row['owner'];
            $result->adwares = $row['adwares'];
            $result->cuser = $row['cuser'];
            $result->cost = $row['cost'];
            $result->state = $row['state'];
            $result->regist = $row['regist'];
            $result->name = $row['name'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        //
    }
    return $results;
}


function adCost($adwares, $nuser, $cost)
{
    updateX10Offer($adwares, $nuser, 13);

    //nuserにコスト追加
    require 'dns.php';
    $sql = "UPDATE `nuser` SET `pay`= `pay`+:cost WHERE  id=:id";
    $stmt = $pdo -> prepare($sql);
    $stmt->bindParam(':id', $nuser, PDO::PARAM_STR);
    $stmt->bindParam(':cost', $cost, PDO::PARAM_INT);
    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

    $sql = "UPDATE `pay` SET `state`=2 , `is_notice`=1 WHERE owner=:owner AND  adwares=:adwares";
    $stmt = $pdo -> prepare($sql);
    $stmt->bindParam(':adwares', $adwares, PDO::PARAM_STR);
    $stmt->bindParam(':owner', $nuser, PDO::PARAM_STR);
    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

    if (substr($adwares, 0, 1)=="A") {
        $sql = "UPDATE `adwares` SET `money_count`= COALESCE(`money_count`,0)+:cost, `pay_count`=COALESCE(`pay_count`,0)+1 WHERE  id=:id";
    } else {
        $sql = "UPDATE `secretadwares` SET `money_count`= COALESCE(`money_count`,0)+:cost, `pay_count`=COALESCE(`pay_count`,0)+1 WHERE  id=:id";
    }
    $stmt = $pdo -> prepare($sql);
    $stmt->bindParam(':id', $adwares, PDO::PARAM_STR);
    $stmt->bindParam(':cost', $cost, PDO::PARAM_INT);
    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
}

function delCost($adwares, $nuser, $cost)
{
    updateX10Offer($adware, $nuser, 12);

    //nuserにコスト追加
    require 'dns.php';
    $sql = "UPDATE `nuser` SET `pay`= `pay`-:cost WHERE  id=:id";
    $stmt = $pdo -> prepare($sql);
    $stmt->bindParam(':id', $nuser, PDO::PARAM_STR);
    $stmt->bindParam(':cost', $cost, PDO::PARAM_INT);
    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

    $sql = "UPDATE `pay` SET `state`=0 , `is_notice`=1 WHERE owner=:owner AND  adwares=:adwares";
    $stmt = $pdo -> prepare($sql);
    $stmt->bindParam(':adwares', $adwares, PDO::PARAM_STR);
    $stmt->bindParam(':owner', $nuser, PDO::PARAM_STR);
    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

    if (substr($adwares, 0, 1)=="A") {
        $sql = "UPDATE `adwares` SET `money_count`= `money_count`-:cost, `pay_count`=`pay_count`-1 WHERE  id=:id";
    } else {
        $sql = "UPDATE `secretadwares` SET `money_count`= `money_count`-:cost, `pay_count`=`pay_count`-1 WHERE  id=:id";
    }
    $stmt = $pdo -> prepare($sql);
    $stmt->bindParam(':id', $adwares, PDO::PARAM_STR);
    $stmt->bindParam(':cost', $cost, PDO::PARAM_INT);
    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
}



function doPay($nuser, $cost)
{

    //nuserにコスト追加
    require 'dns.php';
    $sql = "UPDATE `nuser` SET `pay`= `pay`-:cost WHERE  id=:id";
    $stmt = $pdo -> prepare($sql);
    $stmt->bindParam(':id', $nuser, PDO::PARAM_STR);
    $stmt->bindParam(':cost', $cost, PDO::PARAM_INT);
    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

    $stmt = $pdo->prepare("SELECT MAX(shadow_id) as shadow_id, MAX(id) as id FROM `returnss`");
    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $shadow_id= is_null($row['shadow_id']) ? 0 : $row['shadow_id'];
    $id= is_null($row['id']) ? 0 : $row['id'];
    $new_id = $shadow_id>$id ? $shadow_id + 1 : $id + 1;
    $stmt=null;


    $sql = "INSERT INTO `returnss`(`shadow_id`, `delete_key`, `id`, `owner`, `cost`, `state`, `regist`) VALUES (:shadow_id, 0, :id, :owner, :cost, '入金待ち', :regist)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':shadow_id', $new_id, PDO::PARAM_INT);
    $stmt->bindParam(':id', $new_id, PDO::PARAM_INT);
    $stmt->bindParam(':owner', $nuser, PDO::PARAM_STR);
    $stmt->bindParam(':cost', $cost, PDO::PARAM_INT);
    $stmt->bindParam(':regist', strtotime("NOW"), PDO::PARAM_INT);
    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
}

function doUnPay($id, $nuser, $cost)
{

    //nuserにコスト追加
    require 'dns.php';
    $sql = "UPDATE `nuser` SET `pay`= `pay`+:cost WHERE  id=:id";
    $stmt = $pdo -> prepare($sql);
    $stmt->bindParam(':id', $nuser, PDO::PARAM_STR);
    $stmt->bindParam(':cost', $cost, PDO::PARAM_INT);
    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);


    $sql = "DELETE FROM `returnss` WHERE `id`=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
}

function updatePayStatus($id, $state)
{
    require 'dns.php';
    $sql = "UPDATE `returnss` SET `state`=:stare WHERE `id`=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':stare', $state, PDO::PARAM_STR);
    execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

    if ($state=="入金済み") {
        $stmt = $pdo->prepare("SELECT * FROM `returnss` WHERE id=:id ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $owner = $row['owner'];
        $cost = $row['cost'];
        $stmt=null;


        $sql = "INSERT INTO `x10_returnss`(`id`, `owner`, `cost`, `state`, `regist`) VALUES (:id, :owner, :cost, '入金済み', :regist)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':owner', $owner, PDO::PARAM_STR);
        $stmt->bindParam(':cost', $cost, PDO::PARAM_INT);
        $stmt->bindParam(':regist', strtotime("NOW"), PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
    } else {
        $sql = "DELETE FROM `x10_returnss` WHERE `id`=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
    }
}

class cls_returnss
{
    public $id ;
    public $owner ;
    public $cost ;
    public $state ;
    public $regist ;
    public $name ;
}

function getReturnsses($where)
{
    try {
        $results = array();
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT `returnss`.*, `nuser`.`name` FROM `returnss` LEFT JOIN `nuser` ON `returnss`.`owner`=`nuser`.`id` ".$where);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_post();
            $result->id = $row['id'];
            $result->owner = $row['owner'];
            $result->cost = $row['cost'];
            $result->state = $row['state'];
            $result->regist = $row['regist'];
            $result->name = $row['name'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        //
    }
    return $results;
}

function getReportPayed($y, $m)
{
    try {
        $startDt = strtotime($y.'-'.$m.'-01 00:00:00');
        $endDt   = strtotime(date('Y-m-d 23:59:59', strtotime($y.'-'.$m.' last day of this month')));

        $results = array();
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT `x10_returnss`.*, `nuser`.`name` FROM `x10_returnss` LEFT JOIN `nuser` ON `x10_returnss`.`owner`=`nuser`.`id` WHERE `x10_returnss`.`regist` BETWEEN :start AND :end");
        $stmt->bindParam(':start', $startDt, PDO::PARAM_INT);
        $stmt->bindParam(':end', $endDt, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_post();
            $result->id = $row['id'];
            $result->owner = $row['owner'];
            $result->cost = $row['cost'];
            $result->state = $row['state'];
            $result->regist = $row['regist'];
            $result->name = $row['name'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        //
    }
    return $results;
}

class cls_csv
{
    public $adwares ;
    public $owner ;
    public $cost ;
    public $adname ;
    public $adware_type ;
    public $nname ;
    public $cname ;
    public $cuser ;
}

function getReportPayC($LOGIN_TYPE, $LOGIN_ID, $y, $m)
{
    try {
        $startDt = strtotime($y.'-'.$m.'-01 00:00:00');
        $endDt   = strtotime(date('Y-m-d 23:59:59', strtotime($y.'-'.$m.' last day of this month')));

        $results = array();
        require 'dns.php';
        if ($LOGIN_TYPE=='admin') {
            $stmt = $pdo->prepare("SELECT `p`.adwares , `p`.`owner` , SUM(`p`.`cost`) as cost  ,MAX( `p`.`name`) as adname ,MAX( `p`.`adware_type`) as adware_type,MAX( `n`.`name`) as nname, MAX( `p`.`cuser`) as cuser, MAX( `c`.`name`) as cname FROM `v_pay_x10` AS p LEFT JOIN `nuser` as n ON `p`.`owner`=`n`.`id`  LEFT JOIN `cuser` as c ON `p`.`cuser`=`c`.`id` WHERE `p`.`regist` BETWEEN :start AND :end AND `p`.`state`=2 GROUP BY `p`.adwares , `p`.`owner` ORDER BY `cuser`,`adwares` ");
        } else {
            $stmt = $pdo->prepare("SELECT `p`.adwares , `p`.`owner` , SUM(`p`.`cost`) as cost  ,MAX( `p`.`name`) as adname ,MAX( `p`.`adware_type`) as adware_type,MAX( `n`.`name`) as nname, MAX( `p`.`cuser`) as cuser, MAX( `c`.`name`) as cname FROM `v_pay_x10` AS p LEFT JOIN `nuser` as n ON `p`.`owner`=`n`.`id`  LEFT JOIN `cuser` as c ON `p`.`cuser`=`c`.`id` WHERE `p`.`regist` BETWEEN :start AND :end AND `p`.`cuser`=:cuser AND `p`.`state`=2 GROUP BY `p`.adwares , `p`.`owner` ORDER BY `cuser`,`adwares` ");
            $stmt->bindParam(':cuser', $LOGIN_ID, PDO::PARAM_STR);
        }

        $stmt->bindParam(':start', $startDt, PDO::PARAM_INT);
        $stmt->bindParam(':end', $endDt, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_csv();
            $result->adwares = $row['adwares'];
            $result->owner = $row['owner'];
            $result->cost = $row['cost'];
            $result->adname = $row['adname'];
            $result->adware_type = $row['adware_type'];
            $result->nname = $row['nname'];
            $result->cname = is_null($row['cname']) ? 'その他': $row['cname'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        //
    }
    return $results;
}


function getReportPayN($y, $m)
{
    try {
        $startDt = strtotime($y.'-'.$m.'-01 00:00:00');
        $endDt   = strtotime(date('Y-m-d 23:59:59', strtotime($y.'-'.$m.' last day of this month')));

        $results = array();
        require 'dns.php';
        $stmt = $pdo->prepare("SELECT `p`.adwares , `p`.`owner` , SUM(`p`.`cost`) as cost  ,MAX( `p`.`name`) as adname ,MAX( `p`.`adware_type`) as adware_type,MAX( `n`.`name`) as nname, MAX( `p`.`cuser`) as cuser, MAX( `c`.`name`) as cname FROM `v_pay_x10` AS p LEFT JOIN `nuser` as n ON `p`.`owner`=`n`.`id`  LEFT JOIN `cuser` as c ON `p`.`cuser`=`c`.`id` WHERE `p`.`regist` BETWEEN :start AND :end AND `p`.`state`=2 GROUP BY `p`.adwares , `p`.`owner` ORDER BY `owner`,`adwares` ");

        $stmt->bindParam(':start', $startDt, PDO::PARAM_INT);
        $stmt->bindParam(':end', $endDt, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_csv();
            $result->adwares = $row['adwares'];
            $result->owner = $row['owner'];
            $result->cost = $row['cost'];
            $result->adname = $row['adname'];
            $result->adware_type = $row['adware_type'];
            $result->nname = $row['nname'];
            $result->cname = is_null($row['cname']) ? 'その他': $row['cname'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        //
    }
    return $results;
}
