<?php

class cls_users
{
    public $users_seq;
    public $users_id;
    public $users_pw;
    public $users_name;
}

function loginUsers($userid, $userpw)
{
    try {
        $result = new cls_users();
        require $_SESSION['MY_ROOT'].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `users` where users_id=:users_id and users_pw=:users_pw ");
        $stmt->bindParam(':users_id', $userid, PDO::PARAM_STR);
        $stmt->bindParam(':users_pw', $userpw, PDO::PARAM_STR);
        $stmt->execute();
        if ($row = $stmt->fetch()) {
            $result->users_seq = $row['users_seq'];
            $result->users_id = $row['users_id'];
            $result->users_pw = $row['users_pw'];
            $result->users_name = $row['users_name'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp('1', $ini['debug']) == 0) {
            echo $e->getMessage();
        }
    }

    return $result;
}

function getUserByID($user)
{
    try {
        $result = new cls_users();
        require $_SESSION['MY_ROOT'].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `users` where users_id=:users_id ");
        $stmt->bindParam(':users_id', $user->users_id, PDO::PARAM_STR);
        $stmt->execute();
        if ($row = $stmt->fetch()) {
            $result->users_seq = $row['users_seq'];
            $result->users_id = $row['users_id'];
            $result->users_pw = $row['users_pw'];
            $result->users_name = $row['users_name'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp('1', $ini['debug']) == 0) {
            echo $e->getMessage();
        }
    }

    return $result;
}

    function getUsers()
    {
        try {
            $results = array();
            require $_SESSION['MY_ROOT'].'/src/db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM `users` ORDER BY users_id");
            $stmt->execute();
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
            if (strcmp('1', $ini['debug']) == 0) {
                echo $e->getMessage();
            }
        }

        return $results;
    }

    function getUser($uSeq)
    {
        try {
            $result = new cls_users();
            require $_SESSION['MY_ROOT'].'/src/db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM `users` WHERE users_seq=:users_seq");
            $stmt->bindParam(':users_seq', $uSeq, PDO::PARAM_INT);
            $stmt->execute();
            if ($row = $stmt->fetch()) {
                $result->users_seq = $row['users_seq'];
                $result->users_id = $row['users_id'];
                $result->users_pw = $row['users_pw'];
                $result->users_name = $row['users_name'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp('1', $ini['debug']) == 0) {
                echo $e->getMessage();
            }
        }

        return $result;
    }

    function insertUser($users)
    {
        try {
            require $_SESSION['MY_ROOT'].'/src/db/dns.php';
            $sql = "INSERT INTO `users`( `users_id`, `users_pw`, `users_name`) VALUES (:users_id, :users_id, :users_name)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':users_id', $users->users_id, PDO::PARAM_STR);
            $stmt->bindParam(':users_name', $users->users_name, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp('1', $ini['debug']) == 0) {
                echo $e->getMessage();
            }
        }
    }

    function updateUser($users)
    {
        try {
            require $_SESSION['MY_ROOT'].'/src/db/dns.php';
            $sql = " UPDATE `users`  SET  `users_id`=:users_id,  `users_name`=:users_name WHERE `users_seq`=:users_seq";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':users_seq', $users->users_seq, PDO::PARAM_INT);
            $stmt->bindParam(':users_id', $users->users_id, PDO::PARAM_STR);
            $stmt->bindParam(':users_name', $users->users_name, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp('1', $ini['debug']) == 0) {
                echo $e->getMessage();
            }
        }
    }

    function updateUserPW($users)
    {
        try {
            require $_SESSION['MY_ROOT'].'/src/db/dns.php';
            $sql = "UPDATE `users` SET `users_pw`=:users_pw  WHERE `users_seq`=:users_seq";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':users_seq', $users->users_seq, PDO::PARAM_INT);
            $stmt->bindParam(':users_pw', $users->users_pw, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp('1', $ini['debug']) == 0) {
                echo $e->getMessage();
            }
        }
    }

    function deleteUser($users)
    {
        try {
            require $_SESSION['MY_ROOT'].'/src/db/dns.php';
            $sql = " DELETE FROM `users` WHERE `users_seq`=:users_seq";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':users_seq', $users->users_seq, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp('1', $ini['debug']) == 0) {
                echo $e->getMessage();
            }
        }
    }

?>



