<?php

  class cls_businesses{
    public $bus_seq=0;
    public $sys_seq=0;
    public $bus_name;
    public $bus_que=0;
  }


function getBusinesses($sSeq){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM businesses WHERE sys_seq=? ORDER BY bus_que,bus_seq");
        $stmt->execute(array($sSeq));

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_businesses();
            $result->bus_seq = $row['bus_seq'];
            $result->sys_seq = $row['sys_seq'];
            $result->bus_name = $row['bus_name'];
            $result->bus_que = $row['bus_que'];

            array_push($results,$result);
        }

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    return $results;
}

function getBusiness($sSeq){

    try {
    
        $result = new cls_businesses();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM businesses WHERE bus_seq=?");
        $stmt->execute(array($sSeq));

        if ($row = $stmt->fetch()) {
            $result->bus_seq = $row['bus_seq'];
            $result->sys_seq = $row['sys_seq'];
            $result->bus_name = $row['bus_name'];
            $result->bus_que = $row['bus_que'];
        }

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    return $result;
}


function insertBusiness($business){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $cnt = getBusinesses($business->sys_seq);

        $sql = "INSERT INTO `businesses`(`sys_seq`, `bus_name`, `bus_que`) VALUES (?,?,?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array( $business->sys_seq , $business->bus_name , count($cnt)+1 ));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

function updateBusiness($business){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "UPDATE `businesses` SET `sys_seq`=?, `bus_name`=?,`bus_que`=? WHERE `bus_seq`=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($business->sys_seq, $business->bus_name, $business->bus_que, $business->bus_seq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

function deleteBusiness($business){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "DELETE FROM `businesses` WHERE `bus_seq`=?;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($business->bus_seq));

        $sql = "DELETE FROM `works` WHERE `bus_seq`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($business->bus_seq));

        $sql = "DELETE FROM `tasks` WHERE `bus_seq`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($business->bus_seq));

        //リナンバリング
        $sql = "SET @rownum=0;";
        $sql .= "UPDATE businesses t1, (";
        $sql .= "SELECT @rownum:=@rownum+1 as ROWNUM, bus_seq FROM businesses WHERE `sys_seq`=? ORDER BY bus_que";
        $sql .= ") AS t2  SET t1.`bus_que`=t2.ROWNUM ";
        $sql .= "WHERE t1.bus_seq=t2.bus_seq;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($business->sys_seq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

?>