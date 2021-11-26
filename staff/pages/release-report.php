<?php
include '../../database/config.php';
$exam_id = mysqli_real_escape_string($conn, $_GET['eid']);

$sql = "UPDATE tbl_examinations SET report = 1 where exam_id = '$exam_id';";

if ($conn->query($sql) === TRUE) {
    header("location:../examinations.php");

    // header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header("location:../examinations.php");
}


$conn->close();
?>
