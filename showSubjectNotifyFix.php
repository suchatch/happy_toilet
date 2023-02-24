<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsSubjectNotifyFix.php';

$response = array();

$sql = "SELECT SF_SubjectNotifyFixID,SF_SubjectNotifyFixName,SF_SubjectNotifyFixNameEN FROM `tb_subject_notify_fix`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($SF_SubjectNotifyFixID,$SF_SubjectNotifyFixName,$SF_SubjectNotifyFixNameEN);
}
while ($stmt->fetch()) {
    $c = new clsSubjectNotifyFix();
    $c->SF_SubjectNotifyFixID = $SF_SubjectNotifyFixID;
    $c->SF_SubjectNotifyFixName = $SF_SubjectNotifyFixName;
    $c->SF_SubjectNotifyFixNameEN = $SF_SubjectNotifyFixNameEN;

    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
