<?php

  class cls_answers{
    public $an_id;
    public $q_seq;
    public $value;
  }

  class cls_answered_note{
    public $an_seq;
    public $an_id;
    public $an_users_seq;
    public $an_start_time;
    public $an_answered_time;
    public $aq_title;
    public $que_title;
  }


  function getAnsweredNote($uSeq){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM answered_note WHERE an_users_seq=? ORDER BY an_answered_time DESC");
        $stmt->execute(array($uSeq));

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_answered_note();
            $result->an_seq = $row['an_seq'];
            $result->an_id = $row['an_id'];
            $result->an_users_seq = $row['an_users_seq'];
            $result->an_answered_time = $row['an_answered_time'];

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


function countAnsweredNote($queSeq){

    try {
    
        $result = 0;

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT COUNT(*) as cnt FROM answered_note WHERE aq_seq=?");
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

function getAnsweredNoteResult($uSeq, $an_id){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        //タイプを取得する
        $stmt = $pdo->prepare("SELECT * FROM answered_note WHERE an_users_seq=? AND an_id=?");
        $stmt->execute(array($uSeq, $an_id));
        if ($row = $stmt->fetch()){
            $queSeq = $row['que_seq'];
        }


        $stmt = $pdo->prepare("SELECT * FROM answered_note WHERE an_users_seq=? AND an_id<=? AND que_seq=? ORDER BY an_answered_time DESC");
        $stmt->execute(array($uSeq, $an_id, $queSeq));

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_answered_note();
            $result->an_seq = $row['an_seq'];
            $result->an_id = $row['an_id'];
            $result->an_users_seq = $row['an_users_seq'];
            $result->an_answered_time = $row['an_answered_time'];

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


function getAnsweredNoteInfo($uSeq){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM v_answered_note WHERE an_users_seq=? ORDER BY an_answered_time DESC");
        $stmt->execute(array($uSeq));

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_answered_note();
            $result->an_seq = $row['an_seq'];
            $result->an_id = $row['an_id'];
            $result->an_users_seq = $row['an_users_seq'];
            $result->an_answered_time = $row['an_answered_time'];
            $result->aq_title = $row['aq_title'];
            $result->que_title = $row['que_title'];

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

function insertAnsweredNote($an_id,$startTime,$aqSeq,$queSeq){

    try {
    
        $uSeq = $_SESSION['SEQ'];

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $stmt = $pdo->prepare("INSERT INTO `answered_note`(`an_id`, `an_users_seq`, `an_start_time`,`aq_seq`, `que_seq`, `an_answered_time`) VALUES (?,?,?,?,?, NOW()) ");
        $stmt->execute(array($an_id, $uSeq, $startTime,$aqSeq,$queSeq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
}

function insertAnswers($answers){

    try {
    
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $stmt = $pdo->prepare("INSERT INTO `answers`(`an_id`, `q_seq`, `value`) VALUES (?,?,?) ");
        $stmt->execute(array($answers->an_id, $answers->q_seq, $answers->value ));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
}

function deleteAnswersNoteWithQueSeq($queSeq){

    try {
    
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM answered_note WHERE que_seq=?");
        $stmt->execute(array($queSeq));

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $stmt2 = $pdo->prepare("DELETE FROM answers WHERE an_id=?");
            $stmt2->execute(array($row['an_id']));

        }

        $stmt = $pdo->prepare("DELETE FROM `answered_note` WHERE que_seq=?");
        $stmt->execute(array($queSeq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
}

function deleteAnswersNoteWithAnsQueSeq($aqSeq){

    try {
    
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM answered_note WHERE aq_seq=?");
        $stmt->execute(array($aqSeq));

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $stmt2 = $pdo->prepare("DELETE FROM answers WHERE an_id=?");
            $stmt2->execute(array($row['an_id']));

        }

        $stmt = $pdo->prepare("DELETE FROM `answered_note` WHERE aq_seq=?");
        $stmt->execute(array($aqSeq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
}


function deleteAnswersNoteWithANID($an_id){

    try {
    
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("DELETE FROM `answered_note` WHERE an_id=?");
        $stmt->execute(array($an_id));

        $stmt = $pdo->prepare("DELETE FROM answers WHERE an_id=?");
        $stmt->execute(array($an_id));



    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
}

?>