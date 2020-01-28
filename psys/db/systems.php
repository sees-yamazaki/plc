<?php

class cls_systems
{
    public $path_root;
    public $path_promo;
    public $path_game;
    public $path_info;
    public $system_name;
    public $path_scode;
    public $point_game;
    public $point_entry;
    public $ship_limit;
}

function getSystems()
{
    try {
        $result = new cls_systems();
        require './db/dns.php';
        $stmt = $pdo->prepare('SELECT * FROM `systems`');
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        if ($row = $stmt->fetch()) {
            $result->path_root = $row['path_root'];
            $result->path_promo = $row['path_promo'];
            $result->path_game = $row['path_game'];
            $result->path_info = $row['path_info'];
            $result->system_name = $row['system_name'];
            $result->path_scode = $row['path_scode'];
            $result->point_game = $row['point_game'];
            $result->point_entry = $row['point_entry'];
            $result->ship_limit = $row['ship_limit'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        logging(__FILE__." : ".__METHOD__."() : ".__LINE__);
        logging("DATABASE ERROR : ".$e->getMessage());
        logging("ARGS : ". json_encode(func_get_args()));
    }

    return $result;
}

function updateSystem($systems)
{
    try {
        require './db/dns.php';
        $sql = " UPDATE `systems`  SET   `path_root`=:path_root,  `path_promo`=:path_promo,  `path_game`=:path_game,  `path_info`=:path_info,  `path_scode`=:path_scode,  `system_name`=:system_name ,  `point_game`=:point_game ,  `point_entry`=:point_entry, ship_limit=:ship_limit,editdt=NOW() ";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':path_root', $systems->path_root, PDO::PARAM_STR);
        $stmt->bindParam(':path_promo', $systems->path_promo, PDO::PARAM_STR);
        $stmt->bindParam(':path_game', $systems->path_game, PDO::PARAM_STR);
        $stmt->bindParam(':path_info', $systems->path_info, PDO::PARAM_STR);
        $stmt->bindParam(':path_scode', $systems->path_scode, PDO::PARAM_STR);
        $stmt->bindParam(':system_name', $systems->system_name, PDO::PARAM_STR);
        $stmt->bindParam(':point_game', $systems->point_game, PDO::PARAM_INT);
        $stmt->bindParam(':point_entry', $systems->point_entry, PDO::PARAM_INT);
        $stmt->bindParam(':ship_limit', $systems->ship_limit, PDO::PARAM_INT);
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
