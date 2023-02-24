<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsProductLookupTable.php';

$response = array();

$sql = "SELECT PL_Barcode,PL_Description,PL_Department FROM `tb_product_lookup_table`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($PL_Barcode,$PL_Description,$PL_Department);
}
while ($stmt->fetch()) {
    $c = new clsProductLookupTable();
    $c->PL_Barcode = $PL_Barcode;
    $c->PL_Description = $PL_Description;
    $c->PL_Department = $PL_Department;
 
    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
