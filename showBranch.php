<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsBranch.php';

$response = array();

$sql = "SELECT BR_BranchCode,BR_BranchName,EM_ClientEmpID FROM `tb_branch`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($BR_BranchCode,$BR_BranchName,$EM_ClientEmpID);
}
while ($stmt->fetch()) {
    $c = new clsBranch();
    $c->BR_BranchCode = $BR_BranchCode;
    $c->BR_BranchName = $BR_BranchName;
    $c->EM_ClientEmpID = $EM_ClientEmpID;
   
 
    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
