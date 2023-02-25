<?php
include_once './db_connect.php';
include_once './functions.php';
header("Content-Type: application/json; charset=UTF-8");
$dtStart = date('Y-m-d', strtotime($_GET['dtStart']));
$dtEnd = date('Y-m-d', strtotime($_GET['dtEnd']));
$sql = "SELECT tb_room.RM_RoomID, (select count(*) from tb_vote_result Where tb_vote_result.RM_RoomID = tb_room.RM_RoomID and `tb_vote_result`.`VD_VoteID` = 4 and `tb_vote_result`.`VR_CreateDate` BETWEEN '$dtStart 00:00:00' AND '$dtEnd 23:59:59') as Vote FROM tb_room";
//$sql = "SELECT count(*) as Vote FROM `tb_vote_result` LEFT JOIN `tb_vote` ON `tb_vote_result`.`VD_VoteID` = `tb_vote`.`VD_VoteID` where `tb_vote`.`VD_VoteID` = 1  Group By `tb_vote`.`VD_VoteID` ,`tb_vote_result`.`RM_RoomID`";
if ($stmt = $mysqli_asset->prepare($sql)) {
//    $stmt->bind_param('s', $ReferenceQID);
    $stmt->execute();
    $stmt->bind_result($RM_RoomID,$Vote);
    $stmt->execute();
    $result = $stmt->get_result();
  
    $outp = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($outp);
  
}

