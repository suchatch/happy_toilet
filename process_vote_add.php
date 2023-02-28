<?php
include_once './db_connect.php';

$VD_VoteName = $_POST['VD_VoteName'];
$VD_VoteNameEN = $_POST['VD_VoteNameEN'];
$SB_SubjectVoteID = $_POST['SB_SubjectVoteID'];
$VD_Picture = "NoPic.png";

@mkdir("dist/img/" . AssetPicture . "/isuzu");   //ถ้าไม่มีไดเร็กทอรี้นี้ ให้สร้างใหม่
if (is_uploaded_file($_FILES['upload_file']['tmp_name'])) {
    $target = "dist/img/" . AssetPicture . "/isuzu/" . $_FILES['upload_file']['name'];
    move_uploaded_file($_FILES['upload_file']['tmp_name'], $target);
    $VD_Picture = $_FILES['upload_file']['name'];

    $sql = "INSERT INTO `tb_vote` (`VD_VoteName`,`VD_VoteNameEN`,`SB_SubjectVoteID`,`VD_Picture`) VALUES(?,?,?,?)";
    if ($stmt = $mysqli_asset->prepare($sql)) {
        $stmt->bind_param('ssis', $VD_VoteName, $VD_VoteNameEN, $SB_SubjectVoteID, $VD_Picture);
        $stmt->execute();
    }
} else {
    $sql = "INSERT INTO `tb_vote` (`VD_VoteName`,`VD_VoteNameEN`,`SB_SubjectVoteID`) VALUES(?,?,?)";
    if ($stmt = $mysqli_asset->prepare($sql)) {
        $stmt->bind_param('ssi', $VD_VoteName, $VD_VoteNameEN, $SB_SubjectVoteID);
        $stmt->execute();
    }
}


if ($stmt->affected_rows > -1) {
?>
    <script>
        location.href = 'manage_vote.php';
    </script>
<?php
}
?>