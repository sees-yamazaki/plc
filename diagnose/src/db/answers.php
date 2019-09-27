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
  }


  function getAnsweredNote($uSeq, $an_id){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        if(empty($an_id)){
            $stmt = $pdo->prepare("SELECT * FROM answered_note WHERE an_users_seq=? ORDER BY an_answered_time DESC");
            $stmt->execute(array($uSeq));
        }else{
            $stmt = $pdo->prepare("SELECT * FROM answered_note WHERE an_users_seq=? AND an_id<=? ORDER BY an_answered_time DESC");
            $stmt->execute(array($uSeq, $an_id));
        }

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

function insertAnsweredNote($an_id,$startTime){

    try {
    
        $uSeq = $_SESSION['SEQ'];

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $stmt = $pdo->prepare("INSERT INTO `answered_note`(`an_id`, `an_users_seq`, `an_start_time`) VALUES (?,?,?) ");
        $stmt->execute(array($an_id, $uSeq, $startTime));

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


?>