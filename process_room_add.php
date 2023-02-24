<?php
include_once './db_connect.php';



$RM_RoomName = $_POST['RM_RoomName'];
$FL_FloorID = $_POST['FL_FloorID'];
$RM_RoomSex = $_POST['RM_RoomSex'];
$ST_StaffID = $_POST['ST_StaffID'];

$sql = "INSERT INTO `tb_room` (`RM_RoomName`,`FL_FloorID`,`RM_RoomSex`,`ST_StaffID`) VALUES(?,?,?,?)";
if ($stmt = $mysqli_asset->prepare($sql)) {
    $stmt->bind_param('ssss',$RM_RoomName,$FL_FloorID,$RM_RoomSex,$ST_StaffID);
    $stmt->execute();
    
    
    if($stmt->affected_rows>-1){
        ?>
  <script>location.href = 'manage_room.php';</script>
<?php
    }
}