<?php

class cls_groups{
    public $groups_seq=0;
    public $groups_name;
    public $groups_que;
    public $users_seq;
    public $users_name;
  }


function getGroups(){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT g.*,u.users_name FROM groups g LEFT JOIN users u ON g.users_seq = u.users_seq ORDER BY groups_que");
        $stmt->execute(array());

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_groups();
            $result->groups_seq = $row['groups_seq'];
            $result->groups_name = $row['groups_name'];
            $result->groups_que = $row['groups_que'];
            $result->users_seq = $row['users_seq'];
            $result->users_name = $row['users_name'];

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

function getGroup($gSeq){

    try {
    
        $result = new cls_groups();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT g.*,u.users_name FROM groups g LEFT JOIN users u ON g.users_seq = u.users_seq  WHERE g.groups_seq=?");
        $stmt->execute(array($gSeq));

        if ($row = $stmt->fetch()) {
            $result->groups_seq = $row['groups_seq'];
            $result->groups_name = $row['groups_name'];
            $result->groups_que = $row['groups_que'];
            $result->users_seq = $row['users_seq'];
            $result->users_name = $row['users_name'];
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



// function insertUser($user){

//     try {

//         require $_SESSION["MY_ROOT"].'/src/db/dns.php';

//         $sql = "INSERT INTO `users`( `users_id`, `users_pw`, `users_name`, `users_level`) VALUES (?,?,?,?)";

//         $stmt = $pdo->prepare($sql);
//         $stmt->execute(array( $user->users_id , $user->users_id  , $user->users_name  , $user->users_level ));

//     } catch (PDOException $e) {
//         $errorMessage = 'データベースエラー';
//         //$errorMessage = $sql;
//         if(strcmp("1",$ini['debug'])==0){
//             echo $e->getMessage();
//         }
//     }

// }

function updateGroup($group){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "UPDATE `groups` SET `groups_name`=?,`groups_que`=?,`users_seq`=? WHERE `groups_seq`=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($group->groups_name, $group->groups_que, $group->users_seq, $group->groups_seq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

// function pwUser($user){

//     try {

//         require $_SESSION["MY_ROOT"].'/src/db/dns.php';

//         $sql = "UPDATE `users` SET `users_pw`=`users_id` WHERE `users_seq`=?";

//         $stmt = $pdo->prepare($sql);
//         $stmt->execute(array($user->users_seq));

//     } catch (PDOException $e) {
//         $errorMessage = 'データベースエラー';
//         //$errorMessage = $sql;
//         if(strcmp("1",$ini['debug'])==0){
//             echo $e->getMessage();
//         }
//     }

// }


// function deleteUser($user){

//     try {

//         require $_SESSION["MY_ROOT"].'/src/db/dns.php';

//         // ユーザを削除する
//         $sql = "DELETE FROM `users` WHERE `users_seq`=?";
//         $stmt = $pdo->prepare($sql);
//         $stmt->execute(array($user->users_seq));


//     } catch (PDOException $e) {
//         $errorMessage = 'データベースエラー';
//         //$errorMessage = $sql;
//         if(strcmp("1",$ini['debug'])==0){
//             echo $e->getMessage();
//         }
//     }

// }

?>