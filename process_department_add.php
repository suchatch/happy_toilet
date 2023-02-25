<?php
include_once './db_connect.php';



$DM_DepartmentName = $_POST['DM_DepartmentName'];

$sql = "INSERT INTO `tb_department` (`DM_DepartmentName`) VALUES(?)";
if ($stmt = $mysqli_asset->prepare($sql)) {
    $stmt->bind_param('s',$DM_DepartmentName);
    $stmt->execute();
    
    
    if($stmt->affected_rows>-1){
        ?>
  <script>location.href = 'manage_department.php';</script>
<?php
    }
}