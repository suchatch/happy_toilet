<?php

include_once './db_connect.php';
include_once './functions.php';
include_once './clsProductLookupTable.php';
    $response = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    
    $PL_Department = $_POST['PL_Department'];

    $sql = "SELECT tb_product_lookup_table.PL_Barcode, tb_product_lookup_table.PL_Description
FROM tb_productdetail RIGHT JOIN tb_product_lookup_table ON tb_productdetail.PR_Barcode = tb_product_lookup_table.PL_Barcode
WHERE (((tb_productdetail.PR_Barcode) Is Null)) AND tb_product_lookup_table.PL_Department = ? ";

    if ($stmt = $mysqli_asset->prepare($sql)) {
        $stmt->bind_param('s', $PL_Department);
        $stmt->execute();
        $stmt->bind_result($PL_Barcode, $PL_Description);
    }
    while ($stmt->fetch()) {
        $c = new clsProductLookupTable();
        $c->PL_Barcode = $PL_Barcode;
        $c->PL_Description = $PL_Description;

        array_push($response, $c);
    }

    $stmt->close();
} 
echo json_encode($response, JSON_UNESCAPED_UNICODE);
