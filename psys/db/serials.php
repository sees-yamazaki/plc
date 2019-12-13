<?php

class cls_serials
{
    public $s_seq ;
    public $s_title ;
    public $s_qty ;
    public $createdt ;
    public $users_seq ;
}

class cls_serialcodes
{
    public $sc_seq ;
    public $entrydt ;
    public $sc_point ;
    public $c_seq ;
}

function getSerials()
{
    try {
        $results = array();
        require './db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM  `serials` ORDER BY s_seq");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new cls_serials();
            $result->s_title = $row['s_title'];
            $result->s_qty = $row['s_qty'];
            $result->createdt = $row['createdt'];
            $result->users_seq = $row['users_seq'];
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

function getSerial($sSeq)
{
    try {
        $result = new cls_serials();
        require './db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `serials` WHERE s_seq=:s_seq");
        $stmt->bindParam(':s_seq', $sSeq, PDO::PARAM_INT);
        $stmt->execute();
        if ($row = $stmt->fetch()) {
            $result->s_title = $row['s_title'];
            $result->s_qty = $row['s_qty'];
            $result->createdt = $row['createdt'];
            $result->users_seq = $row['users_seq'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
    return $result;
}

function insertSerials($serials)
{
    try {
        require './db/dns.php';
        $sql = "INSERT  INTO `serials` (  `s_title`,  `s_qty`,  `users_seq`) VALUES (:s_title, :s_qty, :users_seq)";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':s_title', $serials->s_title, PDO::PARAM_STR);
        $stmt->bindParam(':s_qty', $serials->s_qty, PDO::PARAM_INT);
        $stmt->bindParam(':users_seq', $serials->users_seq, PDO::PARAM_INT);
        $stmt->execute();

        //シリアルコード生成
        echo date("Ymd") ;



    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
}

function updateSerials($serials)
{
    try {
        require './db/dns.php';
        $sql = " UPDATE `serials`  SET  `s_title`=:s_title,  `s_qty`=:s_qty, `users_seq`=:users_seq WHERE s_seq=:s_seq";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':s_seq', $serials->s_seq, PDO::PARAM_INT);
        $stmt->bindParam(':s_title', $serials->s_title, PDO::PARAM_STR);
        $stmt->bindParam(':s_qty', $serials->s_qty, PDO::PARAM_INT);
        $stmt->bindParam(':users_seq', $serials->users_seq, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
}

?>
