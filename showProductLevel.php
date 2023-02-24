<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsProductLevel.php';

$response = array();

$sql = "SELECT PL_ProductLevel FROM `tb_productlevel`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($PL_ProductLevel);
}
while ($stmt->fetch()) {
    $pl = new clsProductLevel();
    $pl->PL_ProductLevel = $PL_ProductLevel;

  
    array_push($response, $pl);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
