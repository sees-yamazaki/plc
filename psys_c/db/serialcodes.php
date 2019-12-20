<?php

class cls_serialcodes
{
    public $sc_seq ;
    public $s_seq ;
    public $sc_code ;
    public $entrydt ;
    public $sc_point ;
    public $m_seq ;
}

function getSerialCodeBySCode($sc_code)
{
    try {
        $result = new cls_serialcodes();
        require './db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM `serialcodes` WHERE sc_code=:sc_code");
        $stmt->bindParam(':sc_code', $sc_code, PDO::PARAM_INT);
        $stmt->execute();
        if ($row = $stmt->fetch()) {
            $result->sc_seq = $row['sc_seq'];
            $result->s_seq = $row['s_seq'];
            $result->sc_code = $row['sc_code'];
            $result->entrydt = $row['entrydt'];
            $result->sc_point = $row['sc_point'];
            $result->m_seq = $row['m_seq'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
    return $result;
}


function updateSerialCode($scode)
{
    try {
        require './db/dns.php';
        $sql = "UPDATE `serialcodes` SET  `entrydt`=NOW(),`sc_point`=:sc_point,`m_seq`=:m_seq WHERE sc_seq=:sc_seq";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':sc_seq', $scode->sc_seq, PDO::PARAM_INT);
        $stmt->bindParam(':sc_point', $scode->sc_point, PDO::PARAM_INT);
        $stmt->bindParam(':m_seq', $scode->m_seq, PDO::PARAM_INT);
        $stmt->execute();
        var_dump($scode);
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (strcmp("1", $ini['debug'])==0) {
            echo $e->getMessage();
        }
    }
}







?>