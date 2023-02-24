<?php

include_once './db_connect.php';
include_once './functions.php';
header("Content-Type: application/json; charset=UTF-8");
$sql = "SELECT `RM_RoomName` FROM `tb_room` where RM_RoomName <> '-' AND DM_DepartmentID = 2";
if ($stmt = $mysqli_asset->prepare($sql)) {
//    $stmt->bind_param('s', $ReferenceQID);
    $stmt->execute();
    $stmt->bind_result($RM_RoomName);
    $stmt->execute();
    $result = $stmt->get_result();
  
    $outp = $result->fetch_all(PDO::FETCH_ASSOC);

    echo json_encode($outp);
  
}



