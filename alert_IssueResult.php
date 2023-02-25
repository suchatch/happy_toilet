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

    $IS_IssueID = $_POST['IS_IssueID'];
    $SB_SubjectVoteID = $_POST['SB_SubjectVoteID'];
    $VD_VoteID = $_POST['VD_VoteID'];
    $RM_RoomID = $_POST['RM_RoomID'];
    $ST_StaffID = $_POST['ST_StaffID'];
    $NF_NotifyFixName = "";
    $DM_DepartmentID = 0;
    $DM_DepartmentName = "AA";
    $RM_RoomName = "";
    $VD_VoteName = "";
    $IS_IssueName = "";
    $ST_StaffName = "";
    
    $arrIssueID = array();
    
    // Get Staff Info
    $sqlS = "select `ST_StaffName` from `tb_staff` where `ST_StaffID` = '" . $ST_StaffID . "'";
    $rsS = $mysqli_asset->query($sqlS);
    while ($rowS = $rsS->fetch_array()) {
        $ST_StaffName = $rowS['ST_StaffName'];
    }
   
    
    // Get Room Info
    $sqlR = "select `RM_RoomName`,`DM_DepartmentID` from `tb_room` where `RM_RoomID` = " . $RM_RoomID;
    $rsR = $mysqli_asset->query($sqlR);
    while ($rowR = $rsR->fetch_array()) {
        $RM_RoomName = $rowR['RM_RoomName'];
        $DM_DepartmentID = $rowR['DM_DepartmentID'];
    }
    
    // Get Department Info
    $sqlD = "select `DM_DepartmentName` from `tb_department` where `DM_DepartmentID` = " . $DM_DepartmentID;
    $rsD = $mysqli_asset->query($sqlD);
    while ($rowD = $rsD->fetch_array()) {
        $DM_DepartmentName = $rowD['DM_DepartmentName'];
    }
    
    // Get Vote Info
    $sqlV = "select `VD_VoteName` from `tb_vote` where `VD_VoteID` = " . $VD_VoteID;
    $rsV = $mysqli_asset->query($sqlV);
    while ($rowV = $rsV->fetch_array()) {
        $VD_VoteName = $rowV['VD_VoteName'];
    }
    

    $arrIssueID = explode(",", $IS_IssueID);
    foreach ($arrIssueID as $key => $val) {
        
        // Get Issue Info
        $sqlIssue = "select `IS_IssueName` from `tb_issue` where `IS_IssueID` = " . $arrIssueID[$key];
         $rsIssue = $mysqli_asset->query($sqlIssue);
        while ($rowIssue = $rsIssue->fetch_array()) {
            $IS_IssueName .= "- " . $rowIssue['IS_IssueName']. "\r\n";
        }
    }

    
    $str = "\r\nวันเวลา : " . (new \DateTime())->format('d/m/Y H:i') . "\r\n";
    $str .= "พื้นที่ : " . $DM_DepartmentName . "\r\n";
    $str .= "ห้อง : " . $RM_RoomName . "\r\n";
    $str .= "ผู้ดูแล : `" . $ST_StaffName . "`\r\n";
    $str .= "ให้คะแนน : " . $VD_VoteName . "\r\n";
    $str .= "เหตุผล \r\n" . $IS_IssueName . "\r\n";
    $res = notify_message($str, Token);
} else {
    $response['error'] = true;
    $response['message'] = "Invalid request";
}
$mysqli_asset->close();
//displaying the data in json format 
echo json_encode($response);
