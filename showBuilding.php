<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsBuilding.php';

$response = array();

$sql = "SELECT BU_BuildingID,BU_BuildingName,BR_BranchCode,BU_Picture FROM `tb_building`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($BU_BuildingID,$BU_BuildingName,$BR_BranchCode,$BU_Picture);
}
while ($stmt->fetch()) {
    $c = new clsBuilding();
    $c->BU_BuildingID = $BU_BuildingID;
    $c->BU_BuildingName = $BU_BuildingName;
    $c->BR_BranchCode = $BR_BranchCode;
    $c->BU_Picture = $BU_Picture;
   
 
    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
