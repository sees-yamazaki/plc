<?php

class cls_users
{
    public $users_seq=0;
    public $users_id;
    public $users_pw;
    public $users_name;
}


function loginUsers($uID, $uPW)
{
    try {
        $users = new cls_users();
        require './db/dns.php';
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
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }

    return $users;
}

function getUsers($where)
{
    try {
        $results = array();

        require './db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `users` ".$where." ORDER BY users_id");
        $stmt->execute(array());

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_users();
            $result->users_seq = $row['users_seq'];
            $result->users_id = $row['users_id'];
            $result->users_pw = $row['users_pw'];
            $result->users_name = $row['users_name'];

            array_push($results, $result);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }

    return $results;
}

function getUser($uSeq)
{
    try {
        $result = new cls_users();

        require './db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM users WHERE users_seq=?");
        $stmt->execute(array($uSeq));

        if ($row = $stmt->fetch()) {
            $result->users_seq = $row['users_seq'];
            $result->users_id = $row['users_id'];
            $result->users_pw = $row['users_pw'];
            $result->users_name = $row['users_name'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }

    return $result;
}

// function getUsersWithResult(){

//     try {
    
//         $results = array();

//         require './db/dns.php';
//         $stmt = $pdo->prepare("SELECT * FROM v_result_list");
//         $stmt->execute(array());

//         while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//             $result = new cls_users();
//             $result->users_seq = $row['users_seq'];
//             $result->users_id = $row['users_id'];
//             $result->users_pw = $row['users_pw'];
//             $result->users_name = $row['users_name'];
//             $result->users_level = $row['users_level'];
//             $result->answered_time = $row['an_answered_time'];
//             $result->aq_seq = $row['aq_seq'];
//             $result->aq_title = $row['aq_title'];
//             $result->que_seq = $row['que_seq'];
//             $result->que_title = $row['que_title'];


//             array_push($results,$result);
//         }

//     } catch (PDOException $e) {
//         $errorMessage = 'データベースエラー';
//         //$errorMessage = $sql;
//         if(strcmp("1",$ini['debug'])==0){
//             echo $e->getMessage();
//         }
//     }

//     return $results;
// }


function getUserByID($user)
{
    try {
        $result = new cls_users();

        require './db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM users WHERE users_seq<>? AND users_id=?");
        $stmt->execute(array($user->users_seq, $user->users_id));

        if ($row = $stmt->fetch()) {
            $result->users_seq = $row['users_seq'];
            $result->users_id = $row['users_id'];
            $result->users_pw = $row['users_pw'];
            $result->users_name = $row['users_name'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }

    return $result;
}


function insertUser($user)
{
    try {
        require './db/dns.php';

        $sql = "INSERT INTO `users`( `users_id`, `users_pw`, `users_name`) VALUES (?,?,?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array( $user->users_id , $user->users_pw  , $user->users_name   ));

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("INSERT ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}

function updateUser($user)
{
    try {
        require './db/dns.php';

        $sql = "UPDATE `users` SET `users_id`=?, `users_pw`=?,`users_name`=?,editdt=NOW() WHERE `users_seq`=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($user->users_id, $user->users_pw,  $user->users_name,$user->users_seq));

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("UPDATE ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}

function pwUser($user)
{
    try {
        require './db/dns.php';

        $sql = "UPDATE `users` SET `users_pw`=`users_id`,editdt=NOW() WHERE `users_seq`=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($user->users_seq));

        if ($stmt->rowCount()==0) {
            logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
            logging("UPDATE ERROR : ". $sql);
            logging("ARGS : ". json_encode(func_get_args()));
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}


function deleteUser($user)
{
    try {
        require './db/dns.php';

        // ユーザを削除する
        $sql = "DELETE FROM `users` WHERE `users_seq`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($user->users_seq));
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }
}
