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
    $SB_SubjectVoltID = $_POST['SB_SubjectVoltID'];
    $VD_VoltID = $_POST['VD_VoltID'];
    $RM_RoomID = $_POST['RM_RoomID'];
    $ST_StaffID = $_POST['ST_StaffID'];

    $RM_RoomName = "";
    $VD_VoltName = "";
    $sql = "INSERT INTO `tb_issue_result` (`IS_IssueID`,`SB_SubjectVoltID`, `VD_VoltID`,  `RM_RoomID`, `ST_StaffID`) "
            . "VALUES (?, ?, ?, ?, ?);";

    if ($stmt = $mysqli_asset->prepare($sql)) {
        $stmt->bind_param('iiiis', $IS_IssueID, $SB_SubjectVoltID, $VD_VoltID, $RM_RoomID, $ST_StaffID);
        //if data inserts successfully
        if ($stmt->execute()) {
            //making success response 
            $response['error'] = false;
            $response['message'] = 'Name saved successfully';

            

            // Get Room Info
            $sqlR = "select `RM_RoomName` from `tb_room` where `RM_RoomID` = " .$RM_RoomID;
            $rsR = $mysqli_asset->query($sqlR);
            while ($rowR = $rsR->fetch_array()) {
                $RM_RoomName = $rowR['RM_RoomName'];
            }
            // Get Room Info
            $sqlV = "select `VD_VoltName` from `tb_volt` where `VD_VoltID` = " .$VD_VoltID;
            $rsV = $mysqli_asset->query($sqlV);
            while ($rowV = $rsV->fetch_array()) {
                $VD_VoltName = $rowV['VD_VoltName'];
            }
            
            // Get Issue Info
            $sqlS = "select `IS_IssueName` from `tb_issue` where `IS_IssueID` = " .$IS_IssueID;
            $rsS = $mysqli_asset->query($sqlS);
            while ($rowS = $rsS->fetch_array()) {
                $IS_IssueName = $rowS['IS_IssueName'];
            }
            
//            $str = "วันเวลา:" .(new \DateTime())->format('d/m/Y H:i')."\r\n";
//            $str .= "พื้นที่:" . $RM_RoomName ."\r\n";
//            $str .= "ให้คะแนน:" . $VD_VoltName."\r\n";
//            $str .= "เหตุผล:". $IS_IssueName."\r\n";
//            $res = notify_message($str, Token);
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
