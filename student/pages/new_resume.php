
<?php

include '../includes/check_user.php';
include '../../database/config.php';

$resume = mysqli_real_escape_string($conn, $_POST['resume']);
$sql = "UPDATE tbl_users SET resume='$resume' WHERE user_id='$myid'";
$conn->query($sql);
header("location:../profile.php?rp=7823");
/*
$allowedExts = array("pdf");
$temp = explode(".", $_FILES["pdf_file"]["name"]);
$extension = end($temp);
$upload_pdf=$_FILES["pdf_file"]["name"];
move_uploaded_file($_FILES["pdf_file"]["tmp_name"],"uploads/" . $_FILES["pdf_file"]["name"]);

$sql = "UPDATE tbl_users SET resume='$upload_pdf' WHERE user_id='$myid'";

if ($conn->query($sql) === TRUE) {

$sql = "SELECT * FROM tbl_users WHERE user_id = '$myid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
     
	 header("location:../profile.php?rp=7823");
    }
} else {
header("location:../logout.php");
}




} else {
   header("location:../profile.php?rp=1298");
}

$conn->close();
*/
?>