<?php
$cnst_app_name="psys_c";
$cnst_ini_name="INI";
$cnst_sys_name="SYS";
$tmpData=array();

function setSsnIni($data){
    global $cnst_app_name;
    global $cnst_ini_name;

    if (is_array($$_SESSION[$cnst_app_name])) {
        $_SESSION[$cnst_app_name][$cnst_ini_name] = $data;
    }else{
        $_SESSION[$cnst_app_name] = array($cnst_ini_name=>$data);
    }
}
function getSsnIni($key){
    global $cnst_app_name;
    global $cnst_ini_name;
    return $_SESSION[$cnst_app_name][$cnst_ini_name][$key];
}

function getSsnMyname(){
    global $cnst_app_name;
    global $cnst_ini_name;
    return $_SESSION[$cnst_app_name][$cnst_ini_name]['sysname'];
}

function getSsnIsDebug(){
    global $cnst_app_name;
    global $cnst_ini_name;
    if ($_SESSION[$cnst_app_name][$cnst_ini_name]['debug']=="1") {
        return true;
    }else{
        return false;
    }
}

function getSsnIsLogin(){
    global $cnst_app_name;
    if (isset($_SESSION[$cnst_app_name]['SEQ'])) {
        return true;
    }else{
        return false;
    }
}




function setSsnSys($data){
    global $cnst_app_name;
    global $cnst_sys_name;

    if (is_array($$_SESSION[$cnst_app_name][$cnst_sys_name])) {
        $_SESSION[$cnst_app_name][$cnst_sys_name] = $data;
    }else{
        $_SESSION[$cnst_app_name] = array($cnst_sys_name=>$data);
    }
}

function setSsnKV($key,$vlu){
    global $cnst_app_name;
    $_SESSION[$cnst_app_name][$key] = $vlu;
}

function getSsn($key){
    global $cnst_app_name;
    return $_SESSION[$cnst_app_name][$key];
}

function unsetSsn(){
    global $cnst_app_name;
    unset($_SESSION[$cnst_app_name]);
}



?>