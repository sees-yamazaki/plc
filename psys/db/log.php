<?php

function log_login($m_seq){
    
        try {
            require './db/dns.php';
            $sql = "INSERT  INTO `log_login` (`m_seq`) VALUES (:m_seq)";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':m_seq', $m_seq, PDO::PARAM_INT);
            execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);

            if ($stmt->rowCount()==0) {
                logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
                logging("INSERT ERROR : ". $sql);
                logging("ARGS : ". json_encode(func_get_args()));
            }
            
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }

}





?>