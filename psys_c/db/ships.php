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
    
    
    function insertShip($ships)
    {
        try {
            require './db/dns.php';
            $sql = "INSERT  INTO `ships` (  `m_seq`,  `up_seq`,  `sp_name`,  `sp_post`, `sp_address1`,  `sp_address2`,  `sp_tel`,  `sp_text`) VALUES (:m_seq, :up_seq, :sp_name, :sp_post, :sp_address1, :sp_address2, :sp_tel, :sp_text)";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':m_seq', $ships->m_seq, PDO::PARAM_INT);
            $stmt->bindParam(':up_seq', $ships->up_seq, PDO::PARAM_INT);
            $stmt->bindParam(':sp_name', $ships->sp_name, PDO::PARAM_STR);
            $stmt->bindParam(':sp_post', $ships->sp_post, PDO::PARAM_INT);
            $stmt->bindParam(':sp_address1', $ships->sp_address1, PDO::PARAM_STR);
            $stmt->bindParam(':sp_address2', $ships->sp_address2, PDO::PARAM_STR);
            $stmt->bindParam(':sp_tel', $ships->sp_tel, PDO::PARAM_INT);
            $stmt->bindParam(':sp_text', $ships->sp_text, PDO::PARAM_STR);
            $stmt->execute();
            
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }
    }
    
    ?>
