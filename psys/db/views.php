<?php

class cls_v_usepoints
{
    public $up_seq ;
    public $m_seq ;
    public $up_point ;
    public $createdt ;
    public $up_status ;
    public $g_seq ;
    public $p_seq ;
    public $pz_seq ;
    public $m_name ;
    public $p_title ;
    public $pz_title ;
}
    
function getVUsepointRows($where)
{
    try {
        $cnt = 0;
        require './db/dns.php';
        $stmt = $pdo->prepare("SELECT count(*) as cnt FROM  `v_usepoints` ".$where);
        $stmt->execute();
        if ($row = $stmt->fetch()) {
            $cnt= $row['cnt'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (getSsnIsDebug()) {
            echo $e->getMessage();
        }
    }
    return $cnt;
}
    function getVUsepointsLimit($limit, $offset, $where)
    {
        try {
            $results = array();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM  `v_usepoints` ".$where." ORDER BY createdt desc  LIMIT :lmt OFFSET :ofst");
            $stmt->bindParam(':lmt', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':ofst', $offset, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_v_usepoints();
                $result->up_seq = $row['up_seq'];
                $result->m_seq = $row['m_seq'];
                $result->up_point = $row['up_point'];
                $result->createdt = $row['createdt'];
                $result->up_status = $row['up_status'];
                $result->g_seq = $row['g_seq'];
                $result->p_seq = $row['p_seq'];
                $result->pz_seq = $row['pz_seq'];
                $result->m_name = $row['m_name'];
                $result->p_title = $row['p_title'];
                $result->pz_title = $row['pz_title'];
                array_push($results, $result);
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }
        return $results;
    }


    function getVUsepoints($mSeq)
    {
        try {
            $results = array();
            require './db/dns.php';
            $stmt = $pdo->prepare("SELECT * FROM  `v_usepoints` WHERE m_seq=:m_seq ORDER BY createdt desc");
            $stmt->bindParam(':m_seq', $mSeq, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_v_usepoints();
                $result->up_seq = $row['up_seq'];
                $result->m_seq = $row['m_seq'];
                $result->up_point = $row['up_point'];
                $result->createdt = $row['createdt'];
                $result->up_status = $row['up_status'];
                $result->g_seq = $row['g_seq'];
                $result->p_seq = $row['p_seq'];
                $result->pz_seq = $row['pz_seq'];
                $result->m_name = $row['m_name'];
                $result->p_title = $row['p_title'];
                $result->pz_title = $row['pz_title'];
                array_push($results, $result);
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }
        return $results;
    }


    class cls_v_ships
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
        public $p_title ;
        public $pz_title ;
        public $m_name ;
        public $m_mail ;
        public $m_post ;
        public $m_address1 ;
        public $m_address2 ;
        public $m_tel ;
    }
        
        function getVShipsRows($where)
        {
            try {
                $cnt = 0;
                require './db/dns.php';
                $stmt = $pdo->prepare("SELECT count(*) cnt FROM  `v_ships` ".$where);
                $stmt->execute();
                if ($row = $stmt->fetch()) {
                    $cnt= $row['cnt'];
                }
            } catch (PDOException $e) {
                $errorMessage = 'データベースエラー';
                if (getSsnIsDebug()) {
                    echo $e->getMessage();
                }
            }
            return $cnt;
        }


        function getVShipsLimit($limit, $offset, $where)
        {
            try {
                $results = array();
                require './db/dns.php';
                $stmt = $pdo->prepare("SELECT * FROM  `v_ships` ".$where." ORDER BY createdt desc LIMIT :lmt OFFSET :ofst");
                $stmt->bindParam(':lmt', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':ofst', $offset, PDO::PARAM_INT);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result = new cls_v_ships();
                    $result->sp_seq = $row['sp_seq'];
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
                    $result->p_title = $row['p_title'];
                    $result->pz_title = $row['pz_title'];
                    $result->m_name = $row['m_name'];
                    $result->m_mail = $row['m_mail'];
                    $result->m_post = $row['m_post'];
                    $result->m_address1 = $row['m_address1'];
                    $result->m_address2 = $row['m_address2'];
                    $result->m_tel = $row['m_tel'];
                    array_push($results, $result);
                }
            } catch (PDOException $e) {
                $errorMessage = 'データベースエラー';
                if (getSsnIsDebug()) {
                    echo $e->getMessage();
                }
            }
            return $results;
        }

        function getVShip($sSeq)
        {
            try {
                $result = new cls_v_ships();
                require './db/dns.php';
                $stmt = $pdo->prepare("SELECT * FROM  `v_ships` WHERE sp_seq=:sp_seq");
                $stmt->bindParam(':sp_seq', $sSeq, PDO::PARAM_INT);
                $stmt->execute();
                if ($row = $stmt->fetch()) {
                    $result->sp_seq = $row['sp_seq'];
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
                    $result->p_title = $row['p_title'];
                    $result->pz_title = $row['pz_title'];
                    $result->m_name = $row['m_name'];
                    $result->m_mail = $row['m_mail'];
                    $result->m_post = $row['m_post'];
                    $result->m_address1 = $row['m_address1'];
                    $result->m_address2 = $row['m_address2'];
                    $result->m_tel = $row['m_tel'];
                }
            } catch (PDOException $e) {
                $errorMessage = 'データベースエラー';
                if (getSsnIsDebug()) {
                    echo $e->getMessage();
                }
            }
            return $result;
        }
