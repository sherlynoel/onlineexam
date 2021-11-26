<?php
include '../../database/config.php';
$exam_id = mysqli_real_escape_string($conn, $_GET['e_id']);
$qb_id = mysqli_real_escape_string($conn, $_GET['qb_id']);

$sql = "DELETE FROM tbl_exam_qb WHERE exam_id='$exam_id' AND qb_id= '$qb_id'";

if ($conn->query($sql) === TRUE) {
    header("location:../manage_exam.php?eid=".$exam_id);

    // header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header("location:../manage_exam.php?eid=".$exam_id);
}

$conn->close();
?>
