<?php
include_once './db_connect.php';

$ST_StaffID = $_GET['ST_StaffID'];

$sql = "DELETE FROM `tb_staff`  WHERE `ST_StaffID` = ?";
if ($stmt = $mysqli_asset->prepare($sql)) {
    $stmt->bind_param('s',$ST_StaffID);
    $stmt->execute();
    
    
    if($stmt->affected_rows>-1){
        ?>
  <script>location.href = 'manage_staff.php';</script>
<?php
    }
}

