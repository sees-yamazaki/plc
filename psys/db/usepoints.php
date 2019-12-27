<?php

class cls_usepoints
{
    public $up_seq;
    public $m_seq;
    public $up_point;
    public $createdt;
    public $up_status;
    public $g_seq;
    public $p_seq;
    public $pz_seq;
}

    function countUsepointsByPzseq($pzSeq)
    {
        try {
            $cnt = 0;
            require './db/dns.php';
            $stmt = $pdo->prepare('SELECT count(*) as cnt FROM `usepoints` WHERE pz_seq=:pz_seq');
            $stmt->bindParam(':pz_seq', $pzSeq, PDO::PARAM_INT);
            $stmt->execute();
            if ($row = $stmt->fetch()) {
                $cnt = $row['cnt'];
                array_push($results, $result);
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }

        return $cnt;
    }

    function insertUsepoints($usepoints)
    {
        $id = 0;
        try {
            require './db/dns.php';
            $sql = 'INSERT  INTO `usepoints` (  `m_seq`,  `up_point`,  `up_status`,  `g_seq`,  `p_seq`,  `pz_seq`) VALUES (:m_seq, :up_point, :up_status, :g_seq, :p_seq, :pz_seq)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':m_seq', $usepoints->m_seq, PDO::PARAM_INT);
            $stmt->bindParam(':up_point', $usepoints->up_point, PDO::PARAM_INT);
            $stmt->bindParam(':up_status', $usepoints->up_status, PDO::PARAM_INT);
            $stmt->bindParam(':g_seq', $usepoints->g_seq, PDO::PARAM_INT);
            $stmt->bindParam(':p_seq', $usepoints->p_seq, PDO::PARAM_INT);
            $stmt->bindParam(':pz_seq', $usepoints->pz_seq, PDO::PARAM_INT);
            $stmt->execute();

            $id = $pdo->lastInsertId();
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }

        return $id;
    }
