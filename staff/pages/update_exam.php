<?php
date_default_timezone_set('Africa/Dar_es_salaam');
include '../../database/config.php';
include '../../includes/uniques.php';
$exam_id = $_POST['examid'];
$exam = ucwords(mysqli_real_escape_string($conn, $_POST['exam']));
$duration = mysqli_real_escape_string($conn, $_POST['duration']);
$passmark = mysqli_real_escape_string($conn, $_POST['passmark']);
$t_mark = mysqli_real_escape_string($conn, $_POST['t_mark']);
$t_question = mysqli_real_escape_string($conn, $_POST['t_question']);
$t_easy = mysqli_real_escape_string($conn, $_POST['t_easy']);
$t_medium = mysqli_real_escape_string($conn, $_POST['t_medium']);
$t_hard = mysqli_real_escape_string($conn, $_POST['t_hard']);
$pre = mysqli_real_escape_string($conn, $_POST['pre']);

$category = mysqli_real_escape_string($conn, $_POST['category']);
$terms = ucfirst(mysqli_real_escape_string($conn, $_POST['instructions']));



$sql = "UPDATE tbl_examinations SET category = '$category', exam_name = '$exam', duration = '$duration', passmark = '$passmark', t_mark = '$t_mark', t_question = '$t_question',t_easy = '$t_easy',t_medium = '$t_medium',t_hard = '$t_hard', terms = '$terms' WHERE exam_id='$exam_id'";

if ($conn->query($sql) === TRUE) {
header("location:../examinations.php?rp=7823&eid=$exam_id");
} else {
header("location:../examinations.php?rp=1298&eid=$exam_id");
}



$conn->close();
?>
