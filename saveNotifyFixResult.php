<?php

include_once './db_connect.php';
include_once './functions.php';

//checking the successful connection
if ($mysqli_asset->connect_error) {
    die("Connection failed: " . $mysqli_asset->connect_error);
}

$response = array();

//if there is a post request move ahead 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $response = array();
//    @mkdir("dist/img/".AssetPicture); 		//ถ้าไม่มีไดเร็กทอรี้นี้ ให้สร้างใหม่
//    if(is_uploaded_file($_FILES['upload_file']['tmp_name'])) {
//            $target = "dist/img/".AssetPicture."/" . $_FILES['upload_file']['name'];
//            move_uploaded_file($_FILES['upload_file']['tmp_name'], $target);
//    } 
    //getting the name from request 
    $NF_NotifyFixID = $_POST['NF_NotifyFixID'];
    $IS_IssueID = $_POST['IS_IssueID'];
    $SB_SubjectVoteID = $_POST['SB_SubjectVoteID'];
    $VD_VoteID = $_POST['VD_VoteID'];
    $RM_RoomID = $_POST['RM_RoomID'];
    $ST_StaffID = $_POST['ST_StaffID'];

    $sql = "INSERT INTO `tb_notify_fix_result` (`NF_NotifyFixID`,`IS_IssueID`,`SB_SubjectVoteID`, `VD_VoteID`,  `RM_RoomID`, `ST_StaffID`) "
            . "VALUES (?, ?, ?, ?, ?, ?);";

    if ($stmt = $mysqli_asset->prepare($sql)) {
        $stmt->bind_param('iiiiis', $NF_NotifyFixID, $IS_IssueID, $SB_SubjectVoteID, $VD_VoteID, $RM_RoomID, $ST_StaffID);
        //if data inserts successfully
        if ($stmt->execute()) {
            //making success response 
            $response['error'] = false;
            $response['message'] = 'Name saved successfully';
        } else {
            //if not making failure response 
            $response['error'] = true;
            $response['message'] = 'Error:' . mysqli_stmt_error($stmt);
        }
        $stmt->close();
    }
} else {
    $response['error'] = true;
    $response['message'] = "Invalid request";
}
$mysqli_asset->close();
//displaying the data in json format 
echo json_encode($response);
