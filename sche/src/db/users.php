<?php

  class cls_users{
    public $users_seq=0;
    public $users_id="";
    public $users_pw="";
    public $users_name="";
    public $groups_seq=0;
    public $groups_name="";
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
        $stmt = $pdo->prepare("SELECT u.*, g.groups_name FROM users u LEFT JOIN groups g ON u.groups_seq = g.groups_seq ORDER BY u.users_level, u.users_id");
        $stmt->execute(array());

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_users();
            $result->users_seq = $row['users_seq'];
            $result->users_id = $row['users_id'];
            $result->users_pw = $row['users_pw'];
            $result->users_name = $row['users_name'];
            $result->groups_seq = $row['groups_seq'];
            $result->users_level = $row['users_level'];
            $result->groups_name = $row['groups_name'];

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

function getUser($uSeq){

    try {
    
        $result = new cls_users();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM users WHERE users_seq=?");
        $stmt->execute(array($uSeq));

        if ($row = $stmt->fetch()) {
            $result->users_seq = $row['users_seq'];
            $result->users_id = $row['users_id'];
            $result->users_pw = $row['users_pw'];
            $result->users_name = $row['users_name'];
            $result->groups_seq = $row['groups_seq'];
            $result->users_level = $row['users_level'];
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

function getUserByID($uSeq, $uID){

    try {
    
        $result = new cls_users();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM users WHERE users_seq<>? AND users_id=?");
        $stmt->execute(array($uSeq, $uID));

        if ($row = $stmt->fetch()) {
            $result->users_seq = $row['users_seq'];
            $result->users_id = $row['users_id'];
            $result->users_pw = $row['users_pw'];
            $result->users_name = $row['users_name'];
            $result->groups_seq = $row['groups_seq'];
            $result->users_level = $row['users_level'];
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


function insertUser($user){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "INSERT INTO `users`( `users_id`, `users_pw`, `users_name`, `groups_seq`, `users_level`) VALUES (?,?,?,?,?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array( $user->users_id , $user->users_pw  , $user->users_name , $user->groups_seq , $user->users_level ));


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

function updateUser($user){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "UPDATE `users` SET `users_id`=?,`users_pw`=?,`users_name`=?,`groups_seq`=?,`users_level`=? WHERE `users_seq`=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array( $user->users_id , $user->users_pw  , $user->users_name , $user->groups_seq , $user->users_level, $user->users_seq ));


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}


?>