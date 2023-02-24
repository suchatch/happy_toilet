<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsLocationStockOnHand.php';

$response = array();

$sql = "SELECT tb_product_lookup_table.PL_Department, Count(tb_product_lookup_table.PL_Department) AS NotCount
FROM tb_productdetail RIGHT JOIN tb_product_lookup_table ON tb_productdetail.PR_Barcode = tb_product_lookup_table.PL_Barcode
GROUP BY tb_productdetail.PR_Barcode, tb_product_lookup_table.PL_Department
HAVING (((tb_productdetail.PR_Barcode) Is Null));";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($PL_Department,$NotCount);
}
while ($stmt->fetch()) {
    $c = new clsLocationStockOnHand();
    $c->LM_Description = $PL_Department;
    $c->LM_NotCount = $NotCount;
 
    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
