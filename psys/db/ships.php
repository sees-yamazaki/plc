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
    public $pz_seq ;
    public $edit_flg ;
    public $createdt ;
}

    
function insertShip($ships)
{
    $insertid =0;
    try {
        require './db/dns.php';
        $sql = "INSERT  INTO `ships` (  `m_seq`,  `up_seq`,  `sp_name`, `sp_kana`,  `sp_post`, `sp_address1`,  `sp_address2`,  `sp_tel`,  `sp_text`,  `pz_seq`) VALUES (:m_seq, :up_seq,:sp_name,  :sp_kana, :sp_post, :sp_address1, :sp_address2, :sp_tel, :sp_text, :pz_seq)";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':m_seq', $ships->m_seq, PDO::PARAM_INT);
        $stmt->bindParam(':up_seq', $ships->up_seq, PDO::PARAM_INT);
        $stmt->bindParam(':sp_name', $ships->sp_name, PDO::PARAM_STR);
        $stmt->bindParam(':sp_kana', $ships->sp_kana, PDO::PARAM_STR);
        $stmt->bindParam(':sp_post', $ships->sp_post, PDO::PARAM_INT);
        $stmt->bindParam(':sp_address1', $ships->sp_address1, PDO::PARAM_STR);
        $stmt->bindParam(':sp_address2', $ships->sp_address2, PDO::PARAM_STR);
        $stmt->bindParam(':sp_tel', $ships->sp_tel, PDO::PARAM_INT);
        $stmt->bindParam(':sp_text', $ships->sp_text, PDO::PARAM_STR);
        $stmt->bindParam(':pz_seq', $ships->pz_seq, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

        $insertid = $pdo->lastInsertId();

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
    return $insertid;
}

function updateShip($ship)
{
    try {
        require './db/dns.php';
        $sql = " UPDATE `ships` SET `sp_name`=:sp_name,`sp_kana`=:sp_kana,`sp_post`=:sp_post,`sp_address1`=:sp_address1,`sp_address2`=:sp_address2,`sp_tel`=:sp_tel,`sp_text`=:sp_text,`edit_flg`=1, editdt=NOW()  WHERE sp_seq=:sp_seq";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':sp_name', $ship->sp_name, PDO::PARAM_STR);
        $stmt->bindParam(':sp_kana', $ship->sp_kana, PDO::PARAM_STR);
        $stmt->bindParam(':sp_post', $ship->sp_post, PDO::PARAM_STR);
        $stmt->bindParam(':sp_address1', $ship->sp_address1, PDO::PARAM_STR);
        $stmt->bindParam(':sp_address2', $ship->sp_address2, PDO::PARAM_STR);
        $stmt->bindParam(':sp_tel', $ship->sp_tel, PDO::PARAM_STR);
        $stmt->bindParam(':sp_text', $ship->sp_text, PDO::PARAM_STR);
        $stmt->bindParam(':sp_seq', $ship->sp_seq, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

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

function updateShipFlg($sSeq, $flg)
{
    try {
        require './db/dns.php';
        $sql = " UPDATE `ships` SET `sp_flg`=:sp_flg,editdt=NOW()  WHERE sp_seq=:sp_seq";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':sp_seq', $sSeq, PDO::PARAM_INT);
        $stmt->bindParam(':sp_flg', $flg, PDO::PARAM_INT);
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

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
