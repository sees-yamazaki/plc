<?php

  class cls_systems{
    public $sys_seq=0;
    public $sys_name;
    public $sys_que=0;
  }


function getSystems(){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM systems ORDER BY sys_que,sys_seq");
        $stmt->execute(array());

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_systems();
            $result->sys_seq = $row['sys_seq'];
            $result->sys_name = $row['sys_name'];
            $result->sys_que = $row['sys_que'];

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

function getSystem($sSeq){

    try {
    
        $result = new cls_systems();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM systems WHERE sys_seq=?");
        $stmt->execute(array($sSeq));

        if ($row = $stmt->fetch()) {
            $result->sys_seq = $row['sys_seq'];
            $result->sys_name = $row['sys_name'];
            $result->sys_que = $row['sys_que'];
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

// function getUsersWithResult(){

//     try {
    
//         $results = array();

//         require $_SESSION["MY_ROOT"].'/src/db/dns.php';
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


// function getUserByID($user){

//     try {
    
//         $result = new cls_users();

//         require $_SESSION["MY_ROOT"].'/src/db/dns.php';
//         $stmt = $pdo->prepare("SELECT * FROM users WHERE users_seq<>? AND users_id=?");
//         $stmt->execute(array($user->users_seq, $user->users_id));

//         if ($row = $stmt->fetch()) {
//             $result->users_seq = $row['users_seq'];
//             $result->users_id = $row['users_id'];
//             $result->users_pw = $row['users_pw'];
//             $result->users_name = $row['users_name'];
//             $result->users_level = $row['users_level'];
//         }

//     } catch (PDOException $e) {
//         $errorMessage = 'データベースエラー';
//         //$errorMessage = $sql;
//         if(strcmp("1",$ini['debug'])==0){
//             echo $e->getMessage();
//         }
//     }

//     return $result;
// }


function insertSystem($system){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $cnt = getSystems();

        $sql = "INSERT INTO `systems`(`sys_name`, `sys_que`)  VALUES (?,?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array( $system->sys_name , count($cnt)+1 ));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

function updateSystem($system){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "UPDATE `systems` SET `sys_name`=?,`sys_que`=? WHERE `sys_seq`=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($system->sys_name, $system->sys_que, $system->sys_seq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

function deleteSystem($system){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "DELETE FROM `systems` WHERE `sys_seq`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($system->sys_seq));

        $sql = "DELETE FROM `businesses` WHERE `sys_seq`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($system->sys_seq));

        $sql = "DELETE FROM `works` WHERE `sys_seq`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($system->sys_seq));

        $sql = "DELETE FROM `tasks` WHERE `sys_seq`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($system->sys_seq));


        //リナンバリング
        $sql = "SET @rownum=0;";
        $sql .= "UPDATE systems t1, (";
        $sql .= "SELECT @rownum:=@rownum+1 as ROWNUM, sys_seq FROM systems ORDER BY sys_que";
        $sql .= ") AS t2  SET t1.`sys_que`=t2.ROWNUM ";
        $sql .= "WHERE t1.sys_seq=t2.sys_seq;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array());


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

?>