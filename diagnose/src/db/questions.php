<?php

  class cls_questions{
    public $q_seq=0;
    public $q_id;
    public $q_text;
    public $types_seq=0;
    public $types_name;
  }


  function getQuestions($queSeq){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT q.*,t.types_name FROM questions q LEFT JOIN types t ON t.types_seq=q.types_seq WHERE q.que_seq=? ORDER BY q_id");
        $stmt->execute(array($queSeq));

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_questions();
            $result->q_seq = $row['q_seq'];
            $result->q_id = $row['q_id'];
            $result->q_text = $row['q_text'];
            $result->types_seq = $row['types_seq'];
            $result->types_name = $row['types_name'];

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

function countQuestions($queSeq){

    try {
    
        $result = 0;

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT COUNT(*) as cnt FROM questions WHERE que_seq=?");
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

function getQuestionsRand($que_seq){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT q.*,t.types_name FROM questions q LEFT JOIN types t ON t.types_seq=q.types_seq WHERE q.que_seq=? ORDER BY RAND()");
        $stmt->execute(array($que_seq));

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_questions();
            $result->q_seq = $row['q_seq'];
            $result->q_id = $row['q_id'];
            $result->q_text = $row['q_text'];
            $result->types_seq = $row['types_seq'];
            $result->types_name = $row['types_name'];

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

function getQuestion($qSeq){
    try {
    
        $result = new cls_questions();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT q.*,t.types_name FROM questions q LEFT JOIN types t ON t.types_seq=q.types_seq WHERE q.q_seq=?");
        $stmt->execute(array($qSeq));

        if ($row = $stmt->fetch()) {
            $result->q_seq = $row['q_seq'];
            $result->q_id = $row['q_id'];
            $result->q_text = $row['q_text'];
            $result->types_seq = $row['types_seq'];
            $result->types_name = $row['types_name'];
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

function insertQuestion($question){
    try {
    
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';


        $stmt = $pdo->prepare("SELECT MAX(q_id) as mx FROM questions WHERE que_seq=? ");
        $stmt->execute(array($question->que_seq));
        if ($row = $stmt->fetch()) {
            $cnt = $row['mx'] + 1;
        }else{
            $cnt = 1;
        }

        $stmt = $pdo->prepare("INSERT INTO `questions`(`q_id`, `q_text`, `types_seq`, `que_seq`) VALUES (?,?,?,?) ");
        $stmt->execute(array($cnt, $question->q_text, $question->types_seq, $question->que_seq ));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
}

function updateQuestion($question){
    try {
    
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("UPDATE `questions` SET `q_id`=?,`q_text`=?,`types_seq`=?,`que_seq`=? WHERE `q_seq`=? ");
        $stmt->execute(array($question->q_id, $question->q_text, $question->types_seq, $question->que_seq, $question->q_seq  ));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
}

function deleteQuestion($question){
    try {
    
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("DELETE FROM `questions` WHERE `q_seq`=? ");
        $stmt->execute(array($question->q_seq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }
}

function deleteQuestionWithQueSeq($queSeq){
    try {
    
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("DELETE FROM `questions` WHERE `que_seq`=? ");
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