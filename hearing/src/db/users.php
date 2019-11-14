<?php

class cls_users
{
    public $users_seq;
    public $users_id;
    public $users_pw;
    public $users_name;
}

    function getUsers()
    {
        try {
            $results = array();
            require $_SESSION['MY_ROOT'].'/src/db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM 'users' ORDER BY users_seq");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_users();
                $result->users_id = $row['users_id'];
                $result->users_pw = $row['users_pw'];
                $result->users_name = $row['users_name'];
                array_push($results, $result);
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp('1', $ini['debug']) == 0) {
                echo $e->getMessage();
            }
        }

        return $results;
    }

    function getUser($users)
    {
        try {
            $results = array();
            require $_SESSION['MY_ROOT'].'/src/db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM 'users' WHERE users_seq=:users_seq");
            $stmt->bindParam(':users_seq', $users->users_seq, PDO::PARAM_INT);
            if ($row = $stmt->fetch()) {
                $result = new cls_users();
                $result->users_id = $row['users_id'];
                $result->users_pw = $row['users_pw'];
                $result->users_name = $row['users_name'];
                array_push($results, $result);
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp('1', $ini['debug']) == 0) {
                echo $e->getMessage();
            }
        }

        return $results;
    }

    function insertUsers($users)
    {
        try {
            require $_SESSION['MY_ROOT'].'/src/db/dns.php';
            $sql = "INSERT  INTO 'users' (  'users_id',  'users_pw',  'users_name') VALUES (:users_id, :users_pw, :users_name)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':users_id', $users->users_id, PDO::PARAM_STR);
            $stmt->bindParam(':users_pw', $users->users_pw, PDO::PARAM_STR);
            $stmt->bindParam(':users_name', $users->users_name, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp('1', $ini['debug']) == 0) {
                echo $e->getMessage();
            }
        }
    }

    function updateUsers($users)
    {
        try {
            $sql = " UPDATE 'users'  SET  'users_id'=:users_id,  'users_pw'=:users_pw,  'users_name'=:users_name WHERE users_seq=:users_seq";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':users_seq', $users->users_seq, PDO::PARAM_INT);
            $stmt->bindParam(':users_id', $users->users_id, PDO::PARAM_STR);
            $stmt->bindParam(':users_pw', $users->users_pw, PDO::PARAM_STR);
            $stmt->bindParam(':users_name', $users->users_name, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp('1', $ini['debug']) == 0) {
                echo $e->getMessage();
            }
        }
    }

?>



