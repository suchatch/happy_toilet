<?php

//
include_once './db_connect.php';

//checking the successful connection
if ($mysqli_asset->connect_error) {
    die("Connection failed: " . $mysqli_asset->connect_error);
}

$response = array();

//if there is a post request move ahead 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //getting the name from request 
    $BR_BranchCode = $_POST['BR_BranchCode'];
//    $BR_BranchName = $_POST['BR_BranchName'];
//    $EM_ClientEmpID = $_POST['EM_ClientEmpID'];
//    $sql = "INSERT INTO `tb_branch` (BR_BranchCode,BR_BranchName,EM_ClientEmpID) VALUES (?,?,?)";
    $sql = "INSERT INTO `tb_branch` (BR_BranchCode) VALUES (?)";
    
    if ($stmt = $mysqli_asset->prepare($sql)) {
        $stmt->bind_param('s', $BR_BranchCode);
        //if data inserts successfully
        if ($stmt->execute()) {
            //making success response 
            $response['error'] = false;
            $response['message'] = 'Name saved successfully';
        } else {
            //if not making failure response 
            $response['error'] = true;
            $response['message'] = 'Error:'.mysqli_stmt_error($stmt);
        }
        $stmt->close();
    }
} else {
    $response['error'] = true;
    $response['message'] = "Invalid request";
}

//displaying the data in json format 
echo json_encode($response);
