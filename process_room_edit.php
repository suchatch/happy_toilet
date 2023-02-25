<?php
include_once './db_connect.php';


$RM_RoomID = $_POST['RM_RoomID'];
$RM_RoomName = $_POST['RM_RoomName'];
$DM_DepartmentID = $_POST['DM_DepartmentID'];
$RM_RoomSex = $_POST['RM_RoomSex'];
$ST_StaffID = $_POST['ST_StaffID'];

$sql = "UPDATE `tb_room` SET `RM_RoomName` = ? ,`DM_DepartmentID` =?,`ST_StaffID` = ?,`RM_RoomSex` = ?  WHERE RM_RoomID = ?";
if ($stmt = $mysqli_asset->prepare($sql)) {
    $stmt->bind_param('sissi', $RM_RoomName, $DM_DepartmentID, $ST_StaffID, $RM_RoomSex, $RM_RoomID);
    $stmt->execute();


    if ($stmt->affected_rows > -1) {
?>
        <script>
            location.href = 'manage_room.php';
        </script>
<?php
    }
}
