<?php
include_once './db_connect.php';
$ST_StaffID = $_POST['ST_StaffID'];
$password = $_POST['password'];
$remember = $_POST['remember'];
if($remember==true){
    setcookie("StaffID_login", $ST_StaffID, time() + ( 365 * 24 * 60 * 60), "/");
    setcookie("password_login", $password, time() + ( 365 * 24 * 60 * 60), "/");
}else{
    setcookie("StaffID_login", null, time() + ( 365 * 24 * 60 * 60), "/");
    setcookie("password_login", null, time() + ( 365 * 24 * 60 * 60), "/");
}

