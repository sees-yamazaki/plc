<?php

class cls_systems
{
    public $url_parent;
    public $url_child;
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
        echo "0";
        require './db/dns.php';
        echo "1";
        $stmt = $pdo->prepare('SELECT * FROM `systems`');
        echo "2";
        execSql($stmt, __FILE__." : ".__METHOD__."() : ".__LINE__);
        echo "3";
        if ($row = $stmt->fetch()) {
            $result->url_parent = $row['url_parent'];
            $result->url_child = $row['url_child'];
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
        $sql = " UPDATE `systems`  SET  `url_child`=:url_child,  `path_root`=:path_root,  `path_promo`=:path_promo,  `path_game`=:path_game,  `path_info`=:path_info,  `path_scode`=:path_scode,  `system_name`=:system_name ,  `point_game`=:point_game ,  `point_entry`=:point_entry, url_parent=:url_parent, ship_limit=:ship_limit,editdt=NOW() ";
        $stmt = $pdo -> prepare($sql);
        $stmt->bindParam(':url_parent', $systems->url_parent, PDO::PARAM_STR);
        $stmt->bindParam(':url_child', $systems->url_child, PDO::PARAM_STR);
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
