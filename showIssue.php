<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsIssue.php';

$response = array();

$sql = "SELECT IS_IssueID,IS_IssueName,IS_IssueNameEN,SB_SubjectVoteID,IS_Picture FROM `tb_issue`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($IS_IssueID,$IS_IssueName,$IS_IssueNameEN,$SB_SubjectVoteID,$IS_Picture);
}
while ($stmt->fetch()) {
    $c = new clsIssue();
    $c->IS_IssueID = $IS_IssueID;
    $c->IS_IssueName = $IS_IssueName;
    $c->IS_IssueNameEN = $IS_IssueNameEN;
    $c->SB_SubjectVoteID = $SB_SubjectVoteID;
    $c->IS_Picture = $IS_Picture;
   
 
    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
