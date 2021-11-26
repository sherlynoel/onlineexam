<?php
include '../includes/check_user.php'; 
date_default_timezone_set('Africa/Dar_es_salaam');
include '../../database/config.php';
include '../../includes/uniques.php';
$qb_id = 'QB-'.mt_rand(100000,999999).'';
$qb_name =   ucwords(mysqli_real_escape_string($conn, $_POST['qbname']));
$department_name = ucwords(mysqli_real_escape_string($conn, $_POST['department']));
$subject = ucwords(mysqli_real_escape_string($conn, $_POST['subject']));
$visibility = ucwords(mysqli_real_escape_string($conn, $_POST['visibility']));
$date_registered = date('d-m-Y');
// $myid = ucwords(mysqli_real_escape_string($conn, $_POST['user_id']));

$sql = "SELECT * FROM tbl_qb WHERE name = '$qb_name' AND department = '$department_name'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    header("location:../categories.php?rp=1185");
    }
} else {

$sql = "INSERT INTO tbl_qb (qb_id, qb_name, department, subject, visibility, user_id)
VALUES ('$qb_id', '$qb_name', '$department_name','$subject', '$visibility', '$myid')";

if ($conn->query($sql) === TRUE) {
    header("location:../categories.php?rp=1289");
} else {
    header("location:../categories.php?rp=7732");
}


}
$conn->close();
?>


