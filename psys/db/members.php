<?php

class cls_members
{
    public $m_seq;
    public $m_id;
    public $m_pw;
    public $m_name;
    public $m_mail;
    public $m_post;
    public $m_address1;
    public $m_address2;
    public $m_tel;
    public $createdt;
    public $point;
    public $crnt_point;
    public $logindt;
    public $sc_cnt;
    public $sc_point;
    public $cnt_0;
    public $up_point_0;
    public $cnt_1;
    public $up_point_1;
    public $cnt_99;
    public $up_point_99;
}

    function getMembers()
    {
        try {
            $results = array();
            require './db/dns.php';
            $stmt = $pdo->prepare('SELECT m.*,v.point FROM  `members` m LEFT JOIN v_point v ON m.m_seq=v.m_seq ORDER BY m_seq');
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_members();
                $result->m_seq = $row['m_seq'];
                $result->m_id = $row['m_id'];
                $result->m_pw = $row['m_pw'];
                $result->m_name = $row['m_name'];
                $result->m_mail = $row['m_mail'];
                $result->m_post = $row['m_post'];
                $result->m_address1 = $row['m_address1'];
                $result->m_address2 = $row['m_address2'];
                $result->m_tel = $row['m_tel'];
                $result->createdt = $row['createdt'];
                $result->point = $row['point'];
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

    function getMember($mSeq)
    {
        try {
            $result = new cls_members();
            require './db/dns.php';
            $stmt = $pdo->prepare('SELECT m.*,v.point,L.logindt FROM  `members` m LEFT JOIN v_point v ON m.m_seq=v.m_seq LEFT JOIN v_lastlogin L ON L.m_seq=m.m_seq  WHERE m.m_seq=:m_seq');
            $stmt->bindParam(':m_seq', $mSeq, PDO::PARAM_INT);
            $stmt->execute();
            if ($row = $stmt->fetch()) {
                $result->m_seq = $row['m_seq'];
                $result->m_id = $row['m_id'];
                $result->m_pw = $row['m_pw'];
                $result->m_name = $row['m_name'];
                $result->m_mail = $row['m_mail'];
                $result->m_post = $row['m_post'];
                $result->m_address1 = $row['m_address1'];
                $result->m_address2 = $row['m_address2'];
                $result->m_tel = $row['m_tel'];
                $result->createdt = $row['createdt'];
                $result->point = $row['point'];
                $result->logindt = $row['logindt'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }

        return $result;
    }

    function getMemberRows($where)
    {
        try {
            $cnt = 0;
            require './db/dns.php';
            $stmt = $pdo->prepare('SELECT count(*) as cnt FROM ( SELECT m.*,CASE v.point IS NULL WHEN 1 THEN 0 ELSE v.point END as point,L.logindt FROM `members` m LEFT JOIN v_point v ON m.m_seq=v.m_seq LEFT JOIN v_lastlogin L ON L.m_seq=m.m_seq ) x '.$where);

            $stmt->execute();
            if ($row = $stmt->fetch()) {
                $cnt = $row['cnt'];
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            if (getSsnIsDebug()) {
                echo $e->getMessage();
            }
        }

        return $cnt;
    }

    function getMembersLimit($limit, $offset,$where)
    {
        try {
            $results = array();
            require './db/dns.php';
            $stmt = $pdo->prepare('SELECT * FROM v_members '.$where.' ORDER BY m_seq LIMIT :lmt OFFSET :ofst');

            $stmt->bindParam(':lmt', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':ofst', $offset, PDO::PARAM_INT);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result = new cls_members();
                $result->m_seq = $row['m_seq'];
                $result->m_id = $row['m_id'];
                $result->m_pw = $row['m_pw'];
                $result->m_name = $row['m_name'];
                $result->m_mail = $row['m_mail'];
                $result->m_post = $row['m_post'];
                $result->m_address1 = $row['m_address1'];
                $result->m_address2 = $row['m_address2'];
                $result->m_tel = $row['m_tel'];
                $result->createdt = $row['createdt'];
                //$result->crnt_point = $row['crnt_point'];
                $result->sc_cnt = $row['sc_cnt'];
                $result->sc_point = $row['sc_point'];
                $result->cnt_0 = $row['cnt_0'];
                $result->up_point_0 = $row['up_point_0'];
                $result->cnt_1 = $row['cnt_1'];
                $result->up_point_1 = $row['up_point_1'];
                $result->cnt_99 = $row['cnt_99'];
                $result->up_point_99 = $row['up_point_99'];
                $result->logindt = $row['logindt'];
                $result->crnt_point = $row['sc_point'] - $row['up_point_0'] - $row['up_point_1'] - $row['up_point_99'];
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
