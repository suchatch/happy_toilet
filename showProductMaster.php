<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsProductMaster.php';

$response = array();

$sql = "SELECT `PM_Description`,`PM_PictureID`,`PM_Width`,`PM_Long`,`PM_High`,`PM_Weight`,`PM_Circumference`,`PM_Brand`,`PM_Model`,`CT_CategoryID`,`UN_UnitID`,`PM_Product_Level`,`PM_Price`,`CR_ColorID`,`PM_Remark` FROM `tb_productmaster`";
if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($PM_Description,$PM_PictureID,$PM_Width,$PM_Long,$PM_High,$PM_Weight,$PM_Circumference,$PM_Brand,$PM_Model,$CT_CategoryID,$UN_UnitID,$PM_Product_Level,$PM_Price,$CR_ColorID,$PM_Remark);
}
while ($stmt->fetch()) {
    $pm = new clsProductMaster();
    $pm->PM_Description = $PM_Description;
    $pm->PM_PictureID = $PM_PictureID;
    $pm->PM_Width = $PM_Width;
    $pm->PM_Long = $PM_Long;
    $pm->PM_High = $PM_High;
    $pm->PM_Weight = $PM_Weight;
    $pm->PM_Circumference = $PM_Circumference;
    $pm->PM_Brand = $PM_Brand;
    $pm->PM_Model = $PM_Model;
    $pm->CT_CategoryID = $CT_CategoryID;
    $pm->UN_UnitID = $UN_UnitID;
    $pm->PM_Product_Level = $PM_Product_Level;
    $pm->PM_Price = $PM_Price;
    $pm->CR_ColorID = $CR_ColorID;
    $pm->PM_Remark = $PM_Remark;
    array_push($response, $pm);
}


$mysqli_asset->close();
echo json_encode($response, JSON_UNESCAPED_UNICODE);
