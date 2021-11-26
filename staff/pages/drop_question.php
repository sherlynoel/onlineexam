<?php
include '../../database/config.php';
$qsid = mysqli_real_escape_string($conn, $_GET['id']);
$exid = mysqli_real_escape_string($conn, $_GET['eid']);

$sql = "DELETE FROM tbl_questions WHERE question_id='$qsid'";

if ($conn->query($sql) === TRUE) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

$conn->close();
?>
