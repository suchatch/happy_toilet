<?php

include_once './db_connect.php';

$ST_StaffID = $_POST['ST_StaffID'];
$ST_Password = $_POST['ST_Password'];
$ST_StaffName = $_POST['ST_StaffName'];
$ST_LastName = $_POST['ST_LastName'];
$ST_Position = $_POST['ST_Position'];
$LV_Level = $_POST['LV_Level'];
$ST_Picture = "NoPic.png";

@mkdir("dist/img/" . AssetPicture . "/isuzu");   //ถ้าไม่มีไดเร็กทอรี้นี้ ให้สร้างใหม่
if (is_uploaded_file($_FILES['upload_file']['tmp_name'])) {
    $target = "dist/img/" . AssetPicture . "/isuzu/" . $_FILES['upload_file']['name'];
    move_uploaded_file($_FILES['upload_file']['tmp_name'], $target);
    $ST_Picture = $_FILES['upload_file']['name'];

    $sql = "UPDATE `tb_staff` SET `ST_Password` = ?,`ST_StaffName` = ?,`ST_LastName` = ?,`ST_Position` = ?,`LV_Level` = ?,`ST_Picture` = ?  WHERE `ST_StaffID` = ?";
    if ($stmt = $mysqli_asset->prepare($sql)) {
        $stmt->bind_param('sssssss', $ST_Password, $ST_StaffName, $ST_LastName, $ST_Position, $LV_Level, $ST_Picture, $ST_StaffID);
        $stmt->execute();
    }
} else {
    $sql = "UPDATE `tb_staff` SET `ST_Password` = ?,`ST_StaffName` = ?,`ST_LastName` = ?,`ST_Position` = ?,`LV_Level` = ? WHERE `ST_StaffID` = ?";
    if ($stmt = $mysqli_asset->prepare($sql)) {
        $stmt->bind_param('ssssss', $ST_Password, $ST_StaffName, $ST_LastName, $ST_Position, $LV_Level, $ST_StaffID);
        $stmt->execute();
    }
}
if ($stmt->affected_rows > -1) {
    ?>
    <script>location.href = 'manage_staff.php';</script>
    <?php

}


