<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsDepartment.php';

$response = array();

$sql = "SELECT `DM_DepartmentID`,`DM_DepartmentName`,`BU_BuildingID` FROM `tb_department`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($DM_DepartmentID,$DM_DepartmentName,$BU_BuildingID);
}
while ($stmt->fetch()) {
    $c = new clsDepartment();
    $c->DM_DepartmentID = $DM_DepartmentID;
    $c->DM_DepartmentName = $DM_DepartmentName;
    $c->BU_BuildingID = $BU_BuildingID;
   
 
    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
