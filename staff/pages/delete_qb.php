<?php
include '../../database/config.php';

$qb_id = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "DELETE FROM tbl_qb WHERE qb_id= '$qb_id'";

if ($conn->query($sql) === TRUE) {
    header("location:../categories.php");

    // header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header("location:../categories.php");
}

$conn->close();
?>
