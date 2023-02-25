<?php

//
include_once './db_connect.php';

//checking the successful connection
if ($mysqli_asset->connect_error) {
    die("Connection failed: " . $mysqli_asset->connect_error);
}

$response = array();

//if there is a post request move ahead 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
     $response = array();
    @mkdir("dist/img/".AssetPicture); 		//ถ้าไม่มีไดเร็กทอรี้นี้ ให้สร้างใหม่
    if(is_uploaded_file($_FILES['upload_file']['tmp_name'])) {
            $target = "dist/img/".AssetPicture."/" . $_FILES['upload_file']['name'];
            move_uploaded_file($_FILES['upload_file']['tmp_name'], $target);
    } 

    //getting the name from request 
    $PM_ProductMasterID = $_POST['PM_ProductMasterID'];
    $PR_Barcode = $_POST['PR_Barcode'];
    $PR_SerialNumber = $_POST['PR_SerialNumber'];
    $BR_BranchCode = $_POST['BR_BranchCode'];
    $PR_IMEI = $_POST['PR_IMEI'];
    $PR_Width = $_POST['PR_Width'];
    $PR_Long = $_POST['PR_Long'];
    $PR_High = $_POST['PR_High'];
    $BU_BuildingID = $_POST['BU_BuildingID'];
    $DM_DepartmentID = $_POST['DM_DepartmentID'];
    $FL_FloorID = $_POST['FL_FloorID'];
    $PR_RoomID = $_POST['PR_RoomID'];
    $DM_DamageID = $_POST['DM_DamageID'];
    $PR_CustodianEmpID = $_POST['PR_CustodianEmpID'];
    $PC_PurchaseID = $_POST['PC_PurchaseID'];
    $SP_SupplierID = $_POST['SP_SupplierID'];
    $PR_Qty = $_POST['PR_Qty'];
    $PR_Remark = $_POST['PR_Remark'];

    $sql = "INSERT INTO `tb_productdetail` (`PM_ProductMasterID`, `PR_Barcode`,  `PR_SerialNumber`, `BR_BranchCode`, "
            . "`PR_IMEI`,`PR_Width`,`PR_Long`,`PR_High`, `BU_BuildingID`, `DM_DepartmentID`, `FL_FloorID`, `PR_RoomID`, `DM_DamageID`, `PR_CustodianEmpID`, "
            . "`PC_PurchaseID`, `SP_SupplierID`, `PR_Qty`,`PR_Remark`) "
            . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    
    if ($stmt = $mysqli_asset->prepare($sql)) {
        $stmt->bind_param('ssssssssssssssssis', 
                $PM_ProductMasterID, 
                $PR_Barcode,
                $PR_SerialNumber, 
                $BR_BranchCode, 
                $PR_IMEI,
                $PR_Width,
                $PR_Long,
                $PR_High,
                $BU_BuildingID,
                $DM_DepartmentID,
                $FL_FloorID,
                $PR_RoomID,
                $DM_DamageID,
                $PR_CustodianEmpID,
                $PC_PurchaseID,
                $SP_SupplierID,
                $PR_Qty,
                $PR_Remark);
        //if data inserts successfully
        if ($stmt->execute()) {
            //making success response 
            $response['error'] = false;
            $response['message'] = 'Name saved successfully';
        } else {
            //if not making failure response 
            $response['error'] = true;
            $response['message'] = 'Error:'.mysqli_stmt_error($stmt);
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
