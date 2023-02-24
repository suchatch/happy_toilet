<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsSubjectVolt.php';

$response = array();

$sql = "SELECT SB_SubjectVoltID,SB_SubjectVoltName,SB_SubjectVoltNameEN FROM `tb_subjectvolt`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($SB_SubjectVoltID,$SB_SubjectVoltName,$SB_SubjectVoltNameEN);
}
while ($stmt->fetch()) {
    $c = new clsSubjectVolt();
    $c->SB_SubjectVoltID= $SB_SubjectVoltID;
    $c->SB_SubjectVoltName = $SB_SubjectVoltName;
    $c->SB_SubjectVoltNameEN = $SB_SubjectVoltNameEN;

    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
