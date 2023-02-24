<?php
include_once './db_connect.php';
include_once './functions.php';
include_once './clsCategory.php';

$response = array();

$sql = "SELECT CT_CategoryName FROM `tb_category`";

if ($stmt = $mysqli_asset->prepare($sql)) {
//  $stmt->bind_param('s', $StaffID);
    $stmt->execute();
    $stmt->bind_result($CT_CategoryName);
}
while ($stmt->fetch()) {
    $c = new clsCategory();
    $c->CT_CategoryName = $CT_CategoryName;
   
 
    array_push($response, $c);
}

$stmt->close();

echo json_encode($response, JSON_UNESCAPED_UNICODE);
