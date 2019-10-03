<?php

  class cls_accepting{
    public $aq_seq;
    public $aq_title;
    public $aq_start_time;
    public $aq_end_time;
    public $aq_text;
    public $que_seq;
    public $an_seq;
  }



  function getAcceptingQues(){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM accepting_que ORDER BY aq_start_time");
        $stmt->execute(array());

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_accepting();
            $result->aq_seq = $row['aq_seq'];
            $result->aq_title = $row['aq_title'];
            $result->aq_start_time = $row['aq_start_time'];
            $result->aq_end_time = $row['aq_end_time'];
            $result->aq_text = $row['aq_text'];
            $result->que_seq = $row['que_seq'];

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


function countAcceptingQues($queSeq){

    try {
    
        $result = 0;

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT COUNT(*) as cnt FROM accepting_que WHERE que_seq=?");
        $stmt->execute(array($queSeq));

        if ($row = $stmt->fetch()) {
            $result = $row['cnt'];
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

function getAcceptingQuesToday($uSeq){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT aq.*, an.an_seq FROM accepting_que aq LEFT JOIN (SELECT * FROM answered_note WHERE an_users_seq=?) an  ON aq.aq_seq=an.aq_seq WHERE aq.aq_start_time <= CURDATE() AND aq.aq_end_time >= CURDATE()  ORDER BY aq.aq_start_time");
        $stmt->execute(array($uSeq));

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_accepting();
            $result->aq_seq = $row['aq_seq'];
            $result->aq_title = $row['aq_title'];
            $result->aq_start_time = $row['aq_start_time'];
            $result->aq_end_time = $row['aq_end_time'];
            $result->aq_text = $row['aq_text'];
            $result->que_seq = $row['que_seq'];
            $result->an_seq = $row['an_seq'];

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

function getAcceptingQue($aqSeq){

    try {
    
        $result = new cls_accepting();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM accepting_que WHERE aq_seq=?");
        $stmt->execute(array($aqSeq));

        if ($row = $stmt->fetch()) {
            $result->aq_seq = $row['aq_seq'];
            $result->aq_title = $row['aq_title'];
            $result->aq_start_time = $row['aq_start_time'];
            $result->aq_end_time = $row['aq_end_time'];
            $result->aq_text = $row['aq_text'];
            $result->que_seq = $row['que_seq'];

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



function insertAcceptingQue($accepting){

    try {
    var_dump($accepting);
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $stmt = $pdo->prepare("INSERT INTO `accepting_que`( `aq_title`, `aq_start_time`, `aq_end_time`, `aq_text`, `que_seq`) VALUES (?,?,?,?,?) ");
        $stmt->execute(array($accepting->aq_title, $accepting->aq_start_time, $accepting->aq_end_time,$accepting->aq_text,$accepting->que_seq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
}

function updateAcceptingQue($accepting){

    try {
    
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $stmt = $pdo->prepare("UPDATE `accepting_que` SET `aq_title`=?,`aq_start_time`=?,`aq_end_time`=?,`aq_text`=?,`que_seq`=? WHERE `aq_seq`=?");
        $stmt->execute(array($accepting->aq_title, $accepting->aq_start_time, $accepting->aq_end_time,$accepting->aq_text,$accepting->que_seq,$accepting->aq_seq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
}

function deleteAcceptingQueWithQueSeq($queSeq){

    try {
    
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $stmt = $pdo->prepare("DELETE FROM `accepting_que` WHERE `que_seq`=?");
        $stmt->execute(array($queSeq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
}

?>