<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsVolt.php';

$response = array();

$sql = "SELECT VD_VoltID,VD_VoltName,VD_VoteNameEN,SB_SubjectVoltID,VD_Picture FROM `tb_volt`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($VD_VoltID,$VD_VoltName,$VD_VoteNameEN,$SB_SubjectVoltID,$VD_Picture);
}
while ($stmt->fetch()) {
    $c = new clsVolt();
    $c->VD_VoltID = $VD_VoltID;
    $c->VD_VoltName = $VD_VoltName;
    $c->VD_VoteNameEN = $VD_VoteNameEN;
    $c->SB_SubjectVoltID = $SB_SubjectVoltID;
    $c->VD_Picture = $VD_Picture;
   
 
    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
