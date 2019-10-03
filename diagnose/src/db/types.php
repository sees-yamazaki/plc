<?php

  class cls_types{
    public $types_seq=0;
    public $types_id;
    public $types_name;
    public $types_note;
    public $que_seq;
  }


function getTypes($queSeq){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM types WHERE que_seq=? ORDER BY types_id");
        $stmt->execute(array($queSeq));

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_types();
            $result->types_seq = $row['types_seq'];
            $result->types_id = $row['types_id'];
            $result->types_name = $row['types_name'];
            $result->types_note = $row['types_note'];
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

function countTypes($queSeq){

    try {
    
        $result = 0;

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT COUNT(*) as cnt FROM types WHERE que_seq=?");
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


    function getAType($gSeq){
        try {
        
            $result = new cls_types();

            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM types WHERE types_seq=?");
            $stmt->execute(array($gSeq));

            if ($row = $stmt->fetch()) {
                $result->types_seq = $row['types_seq'];
                $result->types_id = $row['types_id'];
                $result->types_name = $row['types_name'];
                $result->types_note = $row['types_note'];
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

    function getATypeByName($tName){
        try {
        
            $result = new cls_types();

            require $_SESSION["MY_ROOT"].'/src/db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM types WHERE types_name=?");
            $stmt->execute(array($tName));

            if ($row = $stmt->fetch()) {
                $result->types_seq = $row['types_seq'];
                $result->types_id = $row['types_id'];
                $result->types_name = $row['types_name'];
                $result->types_note = $row['types_note'];
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


    function insertType($type){

        $result = new cls_types();
    
        try {
    
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';

            $stmt = $pdo->prepare("SELECT MAX(types_id) as mx FROM types WHERE que_seq=? GROUP BY types_id");
            $stmt->execute(array($type->que_seq));
            if ($row = $stmt->fetch()) {
                $cnt = $row['mx'] + 1;
            }else{
                $cnt = 1;
            }

            // INSERT文を実行する
            $stmt = $pdo -> prepare("INSERT INTO `types`(`types_id`, `types_name`, `types_note`, `que_seq`) VALUES (:types_id, :types_name, :types_note, :que_seq)");
            $stmt->bindValue(':types_id', $cnt, PDO::PARAM_INT);
            $stmt->bindParam(':types_name', $type->types_name, PDO::PARAM_STR);
            $stmt->bindParam(':types_note', $type->types_note, PDO::PARAM_STR);
            $stmt->bindParam(':que_seq', $type->que_seq, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            if(strcmp("1",$ini['debug'])==0){
                echo $e->getMessage();
            }
        }
    
        return $result;
    }

    function updateType($type){

        $result = new cls_types();
    
        try {
    
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';

            // INSERT文を実行する
            $stmt = $pdo -> prepare("UPDATE `types` SET `types_id`=:types_id,`types_name`=:types_name,`types_note`=:types_note,`que_seq`=:que_seq WHERE `types_seq`=:types_seq");
            $stmt->bindValue(':types_seq', $type->types_seq, PDO::PARAM_INT);
            $stmt->bindValue(':types_id', $type->types_id, PDO::PARAM_INT);
            $stmt->bindParam(':types_name', $type->types_name, PDO::PARAM_STR);
            $stmt->bindParam(':types_note', $type->types_note, PDO::PARAM_STR);
            $stmt->bindParam(':que_seq', $type->que_seq, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            if(strcmp("1",$ini['debug'])==0){
                echo $e->getMessage();
            }
        }
    
        return $result;
    }

    function deleteType($type){
    
        try {
    
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';

            // INSERT文を実行する
            $stmt = $pdo -> prepare("DELETE FROM `types` WHERE `types_seq`=:types_seq");
            $stmt->bindValue(':types_seq', $type->types_seq, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            if(strcmp("1",$ini['debug'])==0){
                echo $e->getMessage();
            }
        }
    }

    function deleteTypeWithQueSeq($queSeq){
    
        try {
    
            require $_SESSION["MY_ROOT"].'/src/db/dns.php';

            $stmt = $pdo -> prepare("DELETE FROM `types` WHERE `que_seq`=?");
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