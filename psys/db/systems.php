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
}

function getSystems()
{
    try {
        $result = new cls_systems();
        require './db/dns.php';
        $stmt = $pdo->prepare('SELECT * FROM `systems`');
        $stmt->execute();
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
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (getSsnIsDebug()) {
            echo $e->getMessage();
        }
    }

    return $result;
}

function updateSystem($systems)
{
    try {
        require './db/dns.php';
        $sql = " UPDATE `systems`  SET  `url_child`=:url_child,  `path_root`=:path_root,  `path_promo`=:path_promo,  `path_game`=:path_game,  `path_info`=:path_info,  `path_scode`=:path_scode,  `system_name`=:system_name ,  `point_game`=:point_game ,  `point_entry`=:point_entry, url_parent=:url_parent";
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
        $stmt->execute();
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        if (getSsnIsDebug()) {
            echo $e->getMessage();
        }
    }
}
