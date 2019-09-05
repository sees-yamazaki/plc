<?php

  class cls_users{
    public $users_seq=0;
    public $users_id="";
    public $users_pw="";
    public $users_name="";
    public $groups_seq=0;
    public $users_level=0;



  }

function loginUsers($uID,$uPW){

    try {
        $users = new cls_users();
        require_once $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM users WHERE users_id=? AND users_pw=?");
        $stmt->execute(array($uID,$uPW));
        if ($row = $stmt->fetch()) {
            $users->users_seq = $row['users_seq'];
            $users->users_id = $row['users_id'];
            $users->users_pw = $row['users_pw'];
            $users->users_name = $row['users_name'];
        }

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    return $users;
}

function getUsers(){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM users ORDER BY users_level, users_id");
        $stmt->execute(array());

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_users();
            $result->users_seq = $row['users_seq'];
            $result->users_id = $row['users_id'];
            $result->users_pw = $row['users_pw'];
            $result->users_name = $row['users_name'];
            $result->groups_seq = $row['groups_seq'];
            $result->users_level = $row['users_level'];

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

?>