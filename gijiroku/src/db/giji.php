<?php

class cls_gijis{
    public $giji_seq=0;
    public $giji_id;
    public $giji_date;
    public $giji_title;
    public $giji_note;
    public $giji_file1;
    public $giji_file2;
  }



function getGijis(){

    try {
    
        $results = array();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM giji ORDER BY giji_id");
        $stmt->execute(array());

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result = new cls_gijis();
            $result->giji_seq = $row['giji_seq'];
            $result->giji_id = $row['giji_id'];
            $result->giji_date = $row['giji_date'];
            $result->giji_title = $row['giji_title'];
            $result->giji_note = $row['giji_note'];
            $result->giji_file1 = $row['giji_file1'];
            $result->giji_file2 = $row['giji_file2'];

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

function getGiji($gSeq){

    try {
    
        $result = new cls_gijis();

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';
        $stmt = $pdo->prepare("SELECT * FROM giji WHERE giji_seq=?");
        $stmt->execute(array($gSeq));

        if ($row = $stmt->fetch()) {
            $result->giji_seq = $row['giji_seq'];
            $result->giji_id = $row['giji_id'];
            $result->giji_date = $row['giji_date'];
            $result->giji_title = $row['giji_title'];
            $result->giji_note = $row['giji_note'];
            $result->giji_file1 = $row['giji_file1'];
            $result->giji_file2 = $row['giji_file2'];
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


function insertGiji($giji){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "INSERT INTO `giji`(`giji_id`, `giji_date`, `giji_title`, `giji_note`, `giji_file1`, `giji_file2`) VALUES (?,?,?,?,?,?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array( $giji->giji_id , $giji->giji_date  , $giji->giji_title  , $giji->giji_note, $giji->giji_file1,'' ));

        $sql = "SELECT auto_increment FROM information_schema.tables WHERE table_name = 'giji'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array());
        if ($row = $stmt->fetch()) {
            $seq= $row['auto_increment'];
            $seq--;
        }

        //存在を確認したいディレクトリ（ファイルでもOK）
        $directory_path = $_SESSION["MY_ROOT"]."/files/".$seq;
        
        if(file_exists($directory_path)){
            echo "作成しようとしたディレクトリは既に存在します";
        }else{
            if(mkdir($directory_path, 0777)){
                chmod($directory_path, 0777);
            }
        }

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

    return $seq;
}

function updateGiji($giji){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        $sql = "UPDATE `giji` SET `giji_id`=?,`giji_date`=?,`giji_title`=?,`giji_note`=?,`giji_file1`=?  WHERE `giji_seq`=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($giji->giji_id, $giji->giji_date, $giji->giji_title, $giji->giji_note, $giji->giji_file1, $giji->giji_seq));

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}


function deleteGiji($giji){

    try {

        require $_SESSION["MY_ROOT"].'/src/db/dns.php';

        // ユーザを削除する
        $sql = "DELETE FROM `giji` WHERE `giji_seq`=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($giji->giji_seq));

        $directory_path = $_SESSION["MY_ROOT"]."/files/".$giji->giji_seq;
        remove_directory($directory_path);

    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        if(strcmp("1",$ini['debug'])==0){
            echo $e->getMessage();
        }
    }

}

function remove_directory($dir) {
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
        // ファイルかディレクトリによって処理を分ける
        if (is_dir("$dir/$file")) {
            // ディレクトリなら再度同じ関数を呼び出す
            remove_directory("$dir/$file");
        } else {
            // ファイルなら削除
            unlink("$dir/$file");
            echo "ファイル:" . $dir . "/" . $file . "を削除\n";
        }
    }
    // 指定したディレクトリを削除
    echo "ディレクトリ:" . $dir . "を削除\n";
    return rmdir($dir);
}

?>