<?php

  class cls_users{
    public $users_seq=0;
    public $users_id;
    public $users_pw;
    public $users_name;
    public $groups_seq;
    public $groups_name;
    public $users_level=0;
    public $user_group;
  }

  class cls_user_group{
    public $users_seq=0;
    public $groups_seq=0;
    public $groups_name="";
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
            $users->users_level = $row['users_level'];
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
            $result->users_level = $row['users_level'];

            $stmt2 = $pdo->prepare("SELECT * FROM v_user_group WHERE users_seq=?");
            $stmt2->execute(array($result->users_seq));
            $tmp = array();
            while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                $cUG = new cls_user_group();
                $cUG->users_seq = $row2['users_seq'];
                $cUG->groups_seq = $row2['groups_seq'];
                $cUG->groups_name = $row2['groups_name'];

                //array_push($result->user_group,$cUG);
                array_push($tmp,$cUG);
            }
            $result->user_group = $tmp;

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
            $result->users_level = $row['users_level'];

            $stmt2 = $pdo->prepare("SELECT * FROM v_user_group WHERE users_seq=?");
            $stmt2->execute(array($result->users_seq));
            $tmp = array();
            while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                $cUG = new cls_user_group();
                $cUG->users_seq = $row2['users_seq'];
                $cUG->groups_seq = $row2['groups_seq'];
                $cUG->groups_name = $row2['groups_name'];

                //array_push($result->user_group,$cUG);
                array_push($tmp,$cUG);
            }
            $result->user_group = $tmp;
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

        $sql = "INSERT INTO `users`( `users_id`, `users_pw`, `users_name`, `users_level`) VALUES (?,?,?,?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array( $user->users_id , $user->users_pw  , $user->users_name  , $user->users_level ));

        // 登録したユーザの情報（SEQ)を取得する
        $tmpUser = getUserByID(0, $user->users_id);

        // グループとユーザの紐付けを行う
        $sql = "INSERT INTO `user_group`( `users_seq`, `groups_seq`) VALUES (?,?)";
        $stmt = $pdo->prepare($sql);
        foreach( $user->groups_seq as $gSeq ){
            $stmt->execute(array( $tmpUser->users_seq , $gSeq));
        }


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

        $sql = "UPDATE `users` SET `users_id`=?,`users_pw`=?,`users_name`=?,`users_level`=? WHERE `users_seq`=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array( $user->users_id , $user->users_pw  , $user->users_name , $user->users_level, $user->users_seq ));


        // 現在のグループとユーザの紐付きを削除する
        $sql = "DELETE FROM `user_group` WHERE `users_seq`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($user->users_seq));

        // グループとユーザの紐付けを行う
        $sql = "INSERT INTO `user_group`( `users_seq`, `groups_seq`) VALUES (?,?)";
        $stmt = $pdo->prepare($sql);
        foreach( $user->groups_seq as $gSeq ){
            $stmt->execute(array( $user->users_seq , $gSeq));
        }

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}


function deleteUser($user){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        // ユーザを削除する
        $sql = "DELETE FROM `users` WHERE `users_seq`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($user->users_seq));

        // グループとユーザの紐付きを削除する
        $sql = "DELETE FROM `user_group` WHERE `users_seq`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($user->users_seq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

?>