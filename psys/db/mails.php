<?php

class cls_mails
{
    public $add_member_title;
    public $add_member_text;
    public $insert_member_title;
    public $insert_member_text;
    public $change_pw_title;
    public $change_pw_text;
    public $game_hit_title;
    public $game_hit_text;
    public $game_miss_title;
    public $game_miss_text;
    public $ship_change_title;
    public $ship_change_text;
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
            $result->insert_member_title = $row['insert_member_title'];
            $result->insert_member_text = $row['insert_member_text'];
            $result->change_pw_title = $row['change_pw_title'];
            $result->change_pw_text = $row['change_pw_text'];
            $result->game_hit_title = $row['game_hit_title'];
            $result->game_hit_text = $row['game_hit_text'];
            $result->game_miss_title = $row['game_miss_title'];
            $result->game_miss_text = $row['game_miss_text'];
            $result->ship_change_title = $row['ship_change_title'];
            $result->ship_change_text = $row['ship_change_text'];
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
        $sql = " UPDATE `mails` SET `add_member_title`=:add_member_title, `add_member_text`=:add_member_text,`insert_member_title`=:insert_member_title, `insert_member_text`=:insert_member_text,  `change_pw_title`=:change_pw_title,  `change_pw_text`=:change_pw_text,  `game_hit_title`=:game_hit_title,  `game_hit_text`=:game_hit_text,  `game_miss_title`=:game_miss_title,  `game_miss_text`=:game_miss_text,  `ship_change_title`=:ship_change_title,  `ship_change_text`=:ship_change_text, editdt=NOW() ";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':add_member_title', $mails->add_member_title, PDO::PARAM_STR);
        $stmt->bindParam(':add_member_text', $mails->add_member_text, PDO::PARAM_STR);
        $stmt->bindParam(':insert_member_title', $mails->insert_member_title, PDO::PARAM_STR);
        $stmt->bindParam(':insert_member_text', $mails->insert_member_text, PDO::PARAM_STR);
        $stmt->bindParam(':change_pw_title', $mails->change_pw_title, PDO::PARAM_STR);
        $stmt->bindParam(':change_pw_text', $mails->change_pw_text, PDO::PARAM_STR);
        $stmt->bindParam(':game_hit_title', $mails->game_hit_title, PDO::PARAM_STR);
        $stmt->bindParam(':game_hit_text', $mails->game_hit_text, PDO::PARAM_STR);
        $stmt->bindParam(':game_miss_title', $mails->game_miss_title, PDO::PARAM_STR);
        $stmt->bindParam(':game_miss_text', $mails->game_miss_text, PDO::PARAM_STR);
        $stmt->bindParam(':ship_change_title', $mails->ship_change_title, PDO::PARAM_STR);
        $stmt->bindParam(':ship_change_text', $mails->ship_change_text, PDO::PARAM_STR);
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
