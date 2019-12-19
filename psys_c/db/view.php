<?php

    function getPoint($mSeq)
    {
        $point=0;
        try {
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM `v_point` WHERE m_seq=:m_seq");
            $stmt->bindParam(':m_seq', $mSeq, PDO::PARAM_INT);
            $stmt->execute();
            if ($row = $stmt->fetch()) {
                $point = $row['point'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (strcmp("1", $ini['debug'])==0) {
                echo $e->getMessage();
            }
        }
        return $point;
    }
    
    


    ?>
