<?php
$RM_RoomSex = $_GET['RM_RoomSex'];
include_once './db_connect.php';
include_once './functions.php';
sec_session_start();

if ($stmt = $mysqli_asset->prepare("SELECT `RM_RoomID`,`RM_RoomName` FROM tb_room Where `RM_RoomSex` = ?")) {
    $stmt->bind_param('s', $RM_RoomSex);
    $stmt->execute();
    $stmt->bind_result($RM_RoomID,$RM_RoomName);
    ?>

   <select name="RM_RoomID" class="form-control select2" style="width: 100%;">
        <?php
        while ($stmt->fetch()) {
            ?>
            <option value="<?= $RM_RoomID; ?>"><?= $RM_RoomName; ?></option>
            <?php
        }
      
        ?>
    </select>
    <?php
    $stmt->close();
}




