<?php

include_once './db_connect.php';
include_once './functions.php';
include_once './clsProductDetail.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $PR_Barcode = $_POST['PR_Barcode'];

    $sql = "SELECT `PM_ProductMasterID`,`PR_SerialNumber`,`PR_IMEI`,`PR_Width`,`PR_Long`,`PR_High`,`BR_BranchCode`,`BU_BuildingID`,`DM_DepartmantID`,`FL_FloorID`,`PR_RoomID`, "
            . " `DM_DamageID`,`PR_CustodianEmpID`,`PC_PurchaseID`,`SP_SupplierID`,`PR_Remark`"
            . " FROM `tb_productdetail` "
            . " WHERE PR_Barcode = ?";

    if ($stmt = $mysqli_asset->prepare($sql)) {
        $stmt->bind_param('s', $PR_Barcode);
        $stmt->execute();
        $stmt->bind_result($PM_ProductMasterID,$PR_SerialNumber,$PR_IMEI,$PR_Width,$PR_Long,$PR_High,$BR_BranchCode,
                $BU_BuildingID,$DM_DepartmantID,$FL_FloorID,$PR_RoomID,
                $DM_DamageID,$PR_CustodianEmpID,$PC_PurchaseID,$SP_SupplierID,$PR_Remark);
    }
    while ($stmt->fetch()) {
        $pd = new clsProductDetail();

        $pd->PM_ProductMasterID = $PM_ProductMasterID;
        $pd->PR_SerialNumber = $PR_SerialNumber;
        $pd->PR_IMEI = $PR_IMEI;
        $pd->PR_Width = $PR_Width;
        $pd->PR_Long = $PR_Long;
        $pd->PR_High = $PR_High;
        $pd->BR_BranchCode = $BR_BranchCode;
        $pd->BU_BuildingID = $BU_BuildingID;
        $pd->DM_DepartmantID = $DM_DepartmantID;
        $pd->FL_FloorID = $FL_FloorID;
        $pd->PR_RoomID = $PR_RoomID;
        $pd->DM_DamageID = $DM_DamageID;
        $pd->PR_CustodianEmpID = $PR_CustodianEmpID;
        $pd->PC_PurchaseID = $PC_PurchaseID;
        $pd->SP_SupplierID = $SP_SupplierID;
        $pd->PR_Remark = $PR_Remark;

        array_push($response, $pd);
    }

    $stmt->close();
}



echo json_encode($response, JSON_UNESCAPED_UNICODE);
