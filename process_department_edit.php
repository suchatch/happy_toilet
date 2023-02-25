<?php
include_once './db_connect.php';


$DM_DepartmentID = $_POST['DM_DepartmentID'];
$DM_DepartmentName = $_POST['DM_DepartmentName'];


$sql = "UPDATE `tb_department` SET DM_DepartmentName = ?  WHERE DM_DepartmentID = ?";
if ($stmt = $mysqli_asset->prepare($sql)) {
    $stmt->bind_param('si',$DM_DepartmentName,$DM_DepartmentID);
    $stmt->execute();
    
    
    if($stmt->affected_rows>-1){
        ?>
  <script>location.href = 'manage_department.php';</script>
<?php
    }
}

