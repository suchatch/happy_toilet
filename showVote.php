<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsVote.php';

$response = array();

$sql = "SELECT VD_VoteID,VD_VoteName,VD_VoteNameEN,SB_SubjectVoteID,VD_Picture FROM `tb_vote`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($VD_VoteID,$VD_VoteName,$VD_VoteNameEN,$SB_SubjectVoteID,$VD_Picture);
}
while ($stmt->fetch()) {
    $c = new clsVote();
    $c->VD_VoteID = $VD_VoteID;
    $c->VD_VoteName = $VD_VoteName;
    $c->VD_VoteNameEN = $VD_VoteNameEN;
    $c->SB_SubjectVoteID = $SB_SubjectVoteID;
    $c->VD_Picture = $VD_Picture;
   
 
    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
