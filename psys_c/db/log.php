<?php

function log_login($m_seq){
    
        try {
            require './db/dns.php';
            $sql = "INSERT  INTO `log_login` (`m_seq`) VALUES (:m_seq)";
            $stmt = $pdo -> prepare($sql);
            $stmt->bindParam(':m_seq', $m_seq, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }

}





?>