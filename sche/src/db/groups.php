<?php

  class cls_groups{
    public $groups_seq=0;
    public $groups_id;
    public $groups_name;
    public $parent_groups_seq=0;
    public $create_date;
    public $create_users_seq=0;
    public $create_users_name;
  }

/**
 * 全てのグループを取得する
 */
function getGroups(){

    $results = array();

    try {
    
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        // グループを全て取得する
        // グループID順に並べることで関連するグループが近くに表示される
        $stmt = $pdo->prepare("SELECT * FROM groups ORDER BY groups_id");
        $stmt->execute(array());

        // 全件 クラス化してarrayに詰める
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_groups();
            $result->groups_seq = $row['groups_seq'];
            $result->groups_id = $row['groups_id'];
            $result->groups_name = $row['groups_name'];
            $result->parent_groups_seq = $row['parent_groups_seq'];
            $result->create_date = $row['create_date'];
            $result->create_users_seq = $row['create_users_seq'];
            $result->create_users_name = $row['create_users_name'];

            array_push($results,$result);
        }

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    return $results;
}


/**
 * 配下のグループを全て取得する
 */
function getUnderGroups($groupsSeq){

    $results = array();

    try {

        // グループIDを取得するため、自分のグループ情報を取得する
        $tmpGroup = getGroup($groupsSeq);

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        // 配下のグループを全て取得する
        // 自分を除いて、グループIDをLIKE検索することで配下のグループを取得する
        $stmt = $pdo->prepare("SELECT * FROM groups WHERE groups_seq <> ".$groupsSeq." AND  groups_id LIKE '".$tmpGroup->groups_id."%' ORDER BY groups_id");
        $stmt->execute(array());

        // 全件 クラス化してarrayに詰める
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_groups();
            $result->groups_seq = $row['groups_seq'];
            $result->groups_id = $row['groups_id'];
            $result->groups_name = $row['groups_name'];
            $result->parent_groups_seq = $row['parent_groups_seq'];
            $result->create_date = $row['create_date'];
            $result->create_users_seq = $row['create_users_seq'];
            $result->create_users_name = $row['create_users_name'];

            array_push($results,$result);
        }

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    return $results;
}

/**
 * 指定されたsequenceのグループ情報を取得する
 * 存在しない場合は空のクラスを返却する
 */
function getGroup($groupsSeq){

    $result = new cls_groups();

    try {
    
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        // グループ情報を取得する
        $stmt = $pdo->prepare("SELECT * FROM groups WHERE groups_seq=?");
        $stmt->execute(array($groupsSeq));

        // 取得できた場合にクラスに情報を詰める
        if($row = $stmt->fetch()){
            $result->groups_seq = $row['groups_seq'];
            $result->groups_id = $row['groups_id'];
            $result->groups_name = $row['groups_name'];
            $result->parent_groups_seq = $row['parent_groups_seq'];
            $result->create_date = $row['create_date'];
            $result->create_users_seq = $row['create_users_seq'];
            $result->create_users_name = $row['create_users_name'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    return $result;
}

/**
 * グループ名でグループ情報を取得する
 * グループ名はユニークなため０か１のクラスを返却する
 */
function getGroupByName($gName){

    $result = new cls_groups();
    
    try {
        
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        // グループ情報を取得する
        $stmt = $pdo->prepare("SELECT * FROM groups WHERE groups_name=?");
        $stmt->execute(array($gName));

        // 取得できた場合にクラスに情報を詰める
        if($row = $stmt->fetch()){
            $result->groups_seq = $row['groups_seq'];
            $result->groups_id = $row['groups_id'];
            $result->groups_name = $row['groups_name'];
            $result->parent_groups_seq = $row['parent_groups_seq'];
            $result->create_date = $row['create_date'];
            $result->create_users_seq = $row['create_users_seq'];
            $result->create_users_name = $row['create_users_name'];
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    return $result;
}

/**
 * グループ情報を登録する
 */
function insertGroup($group){

    $result = new cls_groups();

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        // INSERT文を実行する
        $sql = "INSERT INTO `groups`(`groups_id`, `groups_name`, `parent_groups_seq`, `create_users_seq`, `create_users_name`)  VALUES(?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array("", $group->groups_name , $group->parent_groups_seq  , $group->create_users_seq , $group->create_users_name ));
        
        var_dump($stmt->lastInsertId('groups_seq'));
        // 画面で指定した親グループSEQからグループ情報を取得する
        $parentGroup = getGroup($group->parent_groups_seq);

        // 登録した自分のグループ情報をグループ名を用いて取得する
        $result = getGroupByName($group->groups_name);

        // 親ぐるーぷIDに、自分のSEQを付与することで自分のグループIDを決定する
        $result->groups_id = $parentGroup->groups_id.$result->groups_seq."-";

        // グループIDをSEQを用いて更新する
        $stmt = $pdo->prepare("UPDATE `groups` SET `groups_id`=? WHERE `groups_seq`=?");
        $stmt->execute(array( $result->groups_id ,  $result->groups_seq));


    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    return $result;
}

/**
 * グループ情報を更新する
 */
function updateGroup($group){

    try {

        //修正前の自分のグループ情報を取得する
        $oldGroup = getGroup($group->groups_seq);

        
        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        //親グループ情報を取得し、自身の親IDを作成する
        $parentGroup = getGroup($group->parent_groups_seq);

        // 親グループIDに、自分のSEQを付与することで自分のグループIDを決定する
        $group->groups_id = $parentGroup->groups_id."".$group->groups_seq."-";

        $sql = "UPDATE `groups` SET `groups_id`=?,`groups_name`=?,`parent_groups_seq`=? WHERE `groups_seq`=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array( $group->groups_id , $group->groups_name , $group->parent_groups_seq , $group->groups_seq ));

        //親グループが変更された場合
        if($oldGroup->parent_groups_seq <> $group->parent_groups_seq){

            //自分が指定されている場合の親IDを退避
            $ownParentID = $oldGroup->groups_id;

            //自分の子グループを取得
            $stmt = $pdo->prepare("SELECT * FROM groups WHERE groups_id LIKE '".$oldGroup->groups_id ."%'");
            $stmt->execute(array());

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                //旧グループIDと親グループIDを文字列置換で最新化する
                $newGroupID = str_replace($oldGroup->groups_id,$group->groups_id,$row['groups_id']);

                //更新する
                $sql2 = "UPDATE `groups` SET `groups_id`=? WHERE `groups_seq`=?";
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->execute(array( $newGroupID , $row['groups_seq'] ));
    
            }
        }



    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    return $result;
}


/**
 * グループ情報を削除する
 */
function deleteGroup($group){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        // ユーザを削除する
        $sql = "DELETE FROM `groups` WHERE `groups_seq`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($group->groups_seq));

        // グループとユーザの紐付きを削除する
        // 基本的には存在しないが念の為
        $sql = "DELETE FROM `user_group` WHERE `groups_seq`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($group->groups_seq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}
    
?>