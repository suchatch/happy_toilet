<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsNotifyFix.php';

$response = array();

$sql = "SELECT NF_NotifyFixID,NF_NotifyFixName,NF_NotifyFixNameEN,NF_Picture FROM `tb_notify_fix`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($NF_NotifyFixID,$NF_NotifyFixName,$NF_NotifyFixNameEN,$NF_Picture);
}
while ($stmt->fetch()) {
    $c = new clsNotifyFix();
    $c->NF_NotifyFixID = $NF_NotifyFixID;
    $c->NF_NotifyFixName = $NF_NotifyFixName;
    $c->NF_NotifyFixNameEN = $NF_NotifyFixNameEN;
    $c->NF_Picture = $NF_Picture;
   
 
    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
