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

function updateShipFlg($sSeq,$flg)
{
    try {
        require './db/dns.php';
        $sql = " UPDATE `ships` SET `sp_flg`=:sp_flg  WHERE sp_seq=:sp_seq";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':sp_seq', $sSeq, PDO::PARAM_INT);
        $stmt->bindParam(':sp_flg', $flg, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (getSsnIsDebug()) {
            echo $e->getMessage();
        }
    }
}
