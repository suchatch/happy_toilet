<?php

//
include_once './db_connect.php';

//checking the successful connection
if ($mysqli_asset->connect_error) {
    die("Connection failed: " . $mysqli_asset->connect_error);
}

//if there is a post request move ahead 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $response = array();
@mkdir("dist/img/".AssetPicture); 		//ถ้าไม่มีไดเร็กทอรี้นี้ ให้สร้างใหม่
if(is_uploaded_file($_FILES['upload_file']['tmp_name'])) {
	$target = "dist/img/".AssetPicture."/" . $_FILES['upload_file']['name'];
 	move_uploaded_file($_FILES['upload_file']['tmp_name'], $target);
} 
//    $pm = new clsProductMaster();
    //getting the name from request 
    $PM_Description = $_POST['PM_Description'];
    $PM_PictureID = $_POST['PM_PictureID'];
    $PM_Width = $_POST['PM_Width'];
    $PM_Long = $_POST['PM_Long'];
    $PM_High = $_POST['PM_High'];
    $PM_Weight = $_POST['PM_Weight'];
    $PM_Circumference = $_POST['PM_Circumference'];
    $PM_Brand = $_POST['PM_Brand'];
    $PM_Model = $_POST['PM_Model'];
    $CT_CategoryID = $_POST['CT_CategoryID'];
    $UN_UnitID = $_POST['UN_UnitID'];
    $PM_Product_Level = $_POST['PM_Product_Level'];
    $PM_Price = $_POST['PM_Price'];
    $CR_ColorID = $_POST['CR_ColorID'];
    $PM_Remark = $_POST['PM_Remark'];
    $sql = "INSERT INTO `tb_productmaster` (`PM_Description`, `PM_PictureID`,`PM_Width`, `PM_Long`, `PM_High`,`PM_Weight`,"
            . "`PM_Circumference`,`PM_Brand`,`PM_Model`,`CT_CategoryID`,`UN_UnitID`,`PM_Product_Level`,`PM_Price`,`CR_ColorID`,`PM_Remark`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    if ($stmt = $mysqli_asset->prepare($sql)) {
        $stmt->bind_param('sssssssssssssss', 
                $PM_Description, 
                $PM_PictureID,
                $PM_Width, 
                $PM_Long, 
                $PM_High,
                $PM_Weight,
                $PM_Circumference,
                $PM_Brand,
                $PM_Model,
                $CT_CategoryID,
                $UN_UnitID,
                $PM_Product_Level,
                $PM_Price,
                $CR_ColorID,
                $PM_Remark);
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
