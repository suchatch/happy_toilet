<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsStaff.php';

$response = array();

$sql = "SELECT ST_StaffID,ST_Password,ST_StaffName,ST_LastName,ST_Position,ST_Picture,LV_Level FROM `tb_staff`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($ST_StaffID,$ST_Password,$ST_StaffName,$ST_LastName,$ST_Position,$ST_Picture,$LV_Level);
}
while ($stmt->fetch()) {
    $c = new clsStaff();
    $c->ST_StaffID = $ST_StaffID;
    $c->ST_Password = $ST_Password;
    $c->ST_StaffName = $ST_StaffName;
    $c->ST_LastName = $ST_LastName;
    $c->ST_Position = $ST_Position;
    $c->ST_Picture = $ST_Picture;
    $c->LV_Level = $LV_Level;
    

  
    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
