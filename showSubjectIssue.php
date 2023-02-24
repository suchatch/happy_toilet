<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsSubjectIssue.php';

$response = array();

$sql = "SELECT SS_SubjectIssueID,SS_SubjectIssueName,SS_SubjectIssueNameEN FROM `tb_subjectissue`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($SS_SubjectIssueID,$SS_SubjectIssueName,$SS_SubjectIssueNameEN);
}
while ($stmt->fetch()) {
    $c = new clsSubjectIssue();
    $c->SS_SubjectIssueID= $SS_SubjectIssueID;
    $c->SS_SubjectIssueName = $SS_SubjectIssueName;
    $c->SS_SubjectIssueNameEN = $SS_SubjectIssueNameEN;

    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
