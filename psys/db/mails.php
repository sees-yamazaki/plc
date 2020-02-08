<?php

class cls_mails
{
    public $add_member_title;
    public $add_member_text;
    public $change_pw_title;
    public $change_pw_text;
}

function getMails()
{
    try {
        $result = new cls_mails();
        require './db/dns.php';
        $stmt = $pdo->prepare('SELECT * FROM `mails`');
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        if ($row = $stmt->fetch()) {
            $result->add_member_title = $row['add_member_title'];
            $result->add_member_text = $row['add_member_text'];
            $result->change_pw_title = $row['change_pw_title'];
            $result->change_pw_text = $row['change_pw_text'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }

    return $result;
}

function updateMail($mails)
{
    try {
        require './db/dns.php';
        $sql = " UPDATE `mails` SET `add_member_title`=:add_member_title, `add_member_text`=:add_member_text,  `change_pw_title`=:change_pw_title,  `change_pw_text`=:change_pw_text,editdt=NOW() ";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':add_member_title', $mails->add_member_title, PDO::PARAM_STR);
        $stmt->bindParam(':add_member_text', $mails->add_member_text, PDO::PARAM_STR);
        $stmt->bindParam(':change_pw_title', $mails->change_pw_title, PDO::PARAM_STR);
        $stmt->bindParam(':change_pw_text', $mails->change_pw_text, PDO::PARAM_STR);
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

