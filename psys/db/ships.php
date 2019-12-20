<?php

class cls_ships
{
    public $sp_seq ;
    public $m_seq ;
    public $up_seq ;
    public $sp_name ;
    public $sp_post ;
    public $sp_address1 ;
    public $sp_address2 ;
    public $sp_tel ;
    public $sp_text ;
    public $sp_flg ;
    public $createdt ;
}

function getShips()
{
    try {
        $results = array();
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM  `ships` ORDER BY sp_seq");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_ships();
            $result->m_seq = $row['m_seq'];
            $result->up_seq = $row['up_seq'];
            $result->sp_name = $row['sp_name'];
            $result->sp_post = $row['sp_post'];
            $result->sp_address1 = $row['sp_address1'];
            $result->sp_address2 = $row['sp_address2'];
            $result->sp_tel = $row['sp_tel'];
            $result->sp_text = $row['sp_text'];
            $result->sp_flg = $row['sp_flg'];
            $result->createdt = $row['createdt'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
    return $results;
}

function getShips($ships)
{
    try {
        $results = array();
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `ships` WHERE sp_seq=:sp_seq");
        $stmt->bindParam(':sp_seq', $ships->sp_seq, PDO::PARAM_INT);
        $stmt->execute();
        if ($row = $stmt->fetch()) {
            $result = new cls_ships();
            $result->m_seq = $row['m_seq'];
            $result->up_seq = $row['up_seq'];
            $result->sp_name = $row['sp_name'];
            $result->sp_post = $row['sp_post'];
            $result->sp_address1 = $row['sp_address1'];
            $result->sp_address2 = $row['sp_address2'];
            $result->sp_tel = $row['sp_tel'];
            $result->sp_text = $row['sp_text'];
            $result->sp_flg = $row['sp_flg'];
            $result->createdt = $row['createdt'];
            array_push($results, $result);
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
    return $results;
}

function insertShips($ships)
{
    try {
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $sql = "INSERT  INTO `ships` (  `m_seq`,  `up_seq`,  `sp_name`,  `sp_post`,  `sp_address1`,  `sp_address2`,  `sp_tel`,  `sp_text`,  `sp_flg`,  `createdt`) VALUES (:m_seq, :up_seq, :sp_name, :sp_post, :sp_address1, :sp_address2, :sp_tel, :sp_text, :sp_flg, :createdt)";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':m_seq', $ships->m_seq, PDO::PARAM_INT);
        $stmt->bindParam(':up_seq', $ships->up_seq, PDO::PARAM_INT);
        $stmt->bindParam(':sp_name', $ships->sp_name, PDO::PARAM_STR);
        $stmt->bindParam(':sp_post', $ships->sp_post, PDO::PARAM_INT);
        $stmt->bindParam(':sp_address1', $ships->sp_address1, PDO::PARAM_STR);
        $stmt->bindParam(':sp_address2', $ships->sp_address2, PDO::PARAM_STR);
        $stmt->bindParam(':sp_tel', $ships->sp_tel, PDO::PARAM_INT);
        $stmt->bindParam(':sp_text', $ships->sp_text, PDO::PARAM_STR);
        $stmt->bindParam(':sp_flg', $ships->sp_flg, PDO::PARAM_INT);
        $stmt->bindParam(':createdt', $ships->createdt, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
}

function updateShips($ships)
{
    try {
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $sql = " UPDATE `ships`  SET  `m_seq`=:m_seq,  `up_seq`=:up_seq,  `sp_name`=:sp_name,  `sp_post`=:sp_post,  `sp_address1`=:sp_address1,  `sp_address2`=:sp_address2,  `sp_tel`=:sp_tel,  `sp_text`=:sp_text,  `sp_flg`=:sp_flg,  `createdt`=:createdt WHERE sp_seq=:sp_seq";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':sp_seq', $ships->sp_seq, PDO::PARAM_INT);
        $stmt->bindParam(':m_seq', $ships->m_seq, PDO::PARAM_INT);
        $stmt->bindParam(':up_seq', $ships->up_seq, PDO::PARAM_INT);
        $stmt->bindParam(':sp_name', $ships->sp_name, PDO::PARAM_STR);
        $stmt->bindParam(':sp_post', $ships->sp_post, PDO::PARAM_INT);
        $stmt->bindParam(':sp_address1', $ships->sp_address1, PDO::PARAM_STR);
        $stmt->bindParam(':sp_address2', $ships->sp_address2, PDO::PARAM_STR);
        $stmt->bindParam(':sp_tel', $ships->sp_tel, PDO::PARAM_INT);
        $stmt->bindParam(':sp_text', $ships->sp_text, PDO::PARAM_STR);
        $stmt->bindParam(':sp_flg', $ships->sp_flg, PDO::PARAM_INT);
        $stmt->bindParam(':createdt', $ships->createdt, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
}
