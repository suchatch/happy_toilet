<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsClientEmployee.php';

$response = array();

$sql = "SELECT EM_ClientEmpID FROM `tb_clientemployee`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($EM_ClientEmpID);
}
while ($stmt->fetch()) {
    $c = new clsClientEmployee();
    $c->EM_ClientEmpID = $EM_ClientEmpID;

  
    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
