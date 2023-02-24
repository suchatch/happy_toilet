<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsRoom.php';

$response = array();

$sql = "SELECT RM_RoomID,RM_RoomName,FL_FloorID,DM_DepartmentID,RM_RoomSex,ST_StaffID FROM `tb_room`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($RM_RoomID,$RM_RoomName,$FL_FloorID,$DM_DepartmentID,$RM_Sex,$ST_StaffID);
}
while ($stmt->fetch()) {
    $c = new clsRoom();
    $c->RM_RoomID = $RM_RoomID;
    $c->RM_RoomName = $RM_RoomName;
    $c->FL_FloorID = $FL_FloorID;
    $c->DM_DepartmentID = $DM_DepartmentID;
    $c->RM_RoomSex = $RM_Sex;
    $c->ST_StaffID = $ST_StaffID;
   
 
    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
