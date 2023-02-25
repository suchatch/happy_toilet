<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsSubjectVote.php';

$response = array();

$sql = "SELECT SB_SubjectVoteID,SB_SubjectVoteName,SB_SubjectVoteNameEN FROM `tb_subjectvote`";

if ($stmt = $mysqli_asset->prepare($sql)) {
    //  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($SB_SubjectVoteID, $SB_SubjectVoteName, $SB_SubjectVoteNameEN);
}
while ($stmt->fetch()) {
    $c = new clsSubjectVote();
    $c->SB_SubjectVoteID = $SB_SubjectVoteID;
    $c->SB_SubjectVoteName = $SB_SubjectVoteName;
    $c->SB_SubjectVoteNameEN = $SB_SubjectVoteNameEN;

    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
