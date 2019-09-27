<?php

  class cls_questionnaires{
    public $que_seq=0;
    public $que_title;
    public $que_text;
    public $que_create_time;
    public $que_editable;
  }


  function getQuestionnaires(){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM questionnaires ORDER BY que_create_time DESC ");
        $stmt->execute(array());

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_questionnaires();
            $result->que_seq = $row['que_seq'];
            $result->que_title = $row['que_title'];
            $result->que_text = $row['que_text'];
            $result->que_create_time = $row['que_create_time'];
            $result->que_editable = $row['que_editable'];

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


function getQuestionnaire($queSeq){

    try {
    
        $result = new cls_questionnaires();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM questionnaires WHERE que_seq=? ");
        $stmt->execute(array($queSeq));

        if ($row = $stmt->fetch()) {
            $result->que_seq = $row['que_seq'];
            $result->que_title = $row['que_title'];
            $result->que_text = $row['que_text'];
            $result->que_create_time = $row['que_create_time'];
            $result->que_editable = $row['que_editable'];
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

function insertQuestionnaire($questionnaires){
    try {
    
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("INSERT INTO `questionnaires`(`que_title`, `que_text`) VALUES (?,?) ");
        $stmt->execute(array($questionnaires->que_title, $questionnaires->que_text ));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
}

function updateQuestionnaire($questionnaires){
    try {
    
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("UPDATE `questionnaires` SET `que_title`=?,`que_text`=? WHERE `que_seq`=? ");
        $stmt->execute(array($questionnaires->que_title, $questionnaires->que_text, $questionnaires->que_seq ));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
}

function deleteQuestionnaire($question){
    try {
    
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("DELETE FROM `questionnaires` WHERE `que_seq`=? ");
        $stmt->execute(array($question->q_seq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
}

?>