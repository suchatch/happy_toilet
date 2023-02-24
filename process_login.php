<?php
include_once './db_connect.php';
include_once './functions.php';
sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['ST_StaffID'], $_POST['password'])) {

    $ST_StaffID = $_POST['ST_StaffID'];
    $password = $_POST['password'];

    if (login($ST_StaffID, $password, $mysqli_asset) == true) {
        // Login success 
        
     
        header('Location: index.php');
        exit();
    } else {
        // Login failed 
        echo "<script>alert('รหัสผ่านผิด ถ้าหากลืมให้สอบถามเจ้าหน้าที่');location.href = 'index.php';</script>";
    }
} else {
    // The correct POST variables were not sent to this page. 
    header('Location: error.php?err=Could not process login');
    exit();
}
$mysqli->close();