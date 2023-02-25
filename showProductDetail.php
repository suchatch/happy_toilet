<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsProductDetail.php';

$response = array();

$sql = "SELECT `PR_ID`, `PM_ProductMasterID`, `PR_Barcode`, `PR_SerialNumber`, "
        . "`BR_BranchCode`, `PR_IMEI`, `BU_BuildingID`, `DM_DepartmentID`, `FL_FloorID`, "
        . "`PR_RoomID`, `DM_DamageID`, `PR_CustodianEmpID`, `PC_PurchaseID`, `SP_SupplierID`, `PR_Qty`, "
        . "`PR_SeqStart`, `PR_SeqEnd`, `PR_StaffCreate`, `PR_CreateDate`, `PR_StaffEdit`, `PR_EditDate`, `PR_Remark`"
        . " FROM `tb_productdetail`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result(
            $PR_ID,
            $PM_ProductMasterID,
            $PR_Barcode,
            $PR_SerialNumber,
            $BR_BranchCode,
            $PR_IMEI,
            $BU_BuildingID,
            $DM_DepartmentID,
            $FL_FloorID,
            $PR_RoomID,
            $DM_DamageID,
            $PR_CustodianEmpID,
            $PC_PurchaseID,
            $SP_SupplierID,
            $PR_Qty,
            $PR_SeqStart,
            $PR_SeqEnd,
            $PR_StaffCreate,
            $PR_CreateDate,
            $PR_StaffEdit,
            $PR_EditDate,
            $PR_Remark);
}
while ($stmt->fetch()) {
    $pd = new clsProductDetail();
    $pd->PR_ID = $PR_ID;
    $pd->PM_ProductMasterID = $PM_ProductMasterID;
    $pd->PR_Barcode = $PR_Barcode;
    $pd->PR_SerialNumber = $PR_SerialNumber;
    $pd->BR_BranchCode = $BR_BranchCode;
    $pd->PR_IMEI = $PR_IMEI;
    $pd->BU_BuildingID = $BU_BuildingID;
    $pd->DM_DepartmentID = $DM_DepartmentID;
    $pd->FL_FloorID = $FL_FloorID;
    $pd->PR_RoomID = $PR_RoomID;
    $pd->DM_DamageID = $DM_DamageID;
    $pd->PR_CustodianEmpID = $PR_CustodianEmpID;
    $pd->PC_PurchaseID = $PC_PurchaseID;
    $pd->SP_SupplierID = $SP_SupplierID;
    $pd->PR_Qty = $PR_Qty;
    $pd->PR_SeqStart = $PR_SeqStart;
    $pd->PR_SeqEnd = $PR_SeqEnd;
    $pd->PR_StaffCreate = $PR_StaffCreate;
    $pd->PR_CreateDate = $PR_CreateDate;
    $pd->PR_StaffEdit = $PR_StaffEdit;
    $pd->PR_EditDate = $PR_EditDate;
    $pd->PR_Remark = $PR_Remark;
  
    array_push($response, $pd);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
