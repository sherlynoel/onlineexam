<?php
date_default_timezone_set('Africa/Dar_es_salaam');
include '../../database/config.php';
include '../../includes/uniques.php';
$exam_id = 'EX-'.get_rand_numbers(6).'';
$exam = ucwords(mysqli_real_escape_string($conn, $_POST['exam']));
$duration = mysqli_real_escape_string($conn, $_POST['duration']);
$passmark = mysqli_real_escape_string($conn, $_POST['passmark']);
$t_mark = mysqli_real_escape_string($conn, $_POST['t_mark']);
$e_mark = mysqli_real_escape_string($conn, $_POST['e_mark']);
$t_question = mysqli_real_escape_string($conn, $_POST['t_question']);
$pre = mysqli_real_escape_string($conn, $_POST['pre']);
$attempts = mysqli_real_escape_string($conn, $_POST['attempts']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$depart = mysqli_real_escape_string($conn, $_POST['department']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$terms = ucfirst(mysqli_real_escape_string($conn, $_POST['instructions']));

$sql = "SELECT * FROM tbl_examinations WHERE exam_name = '$exam' AND subject = '$depart' AND category = '$category'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
header("location:../examinations.php?rp=1185");
    }
} else {

$sql = "INSERT INTO tbl_examinations (exam_id, category, department, exam_name, date, duration, passmark, t_mark, e_mark, t_question, re_exam, terms, pret)
VALUES ('$exam_id', '$category', '$depart', '$exam', '$date', '$duration', '$passmark', '$t_mark', '$e_mark', '$t_question', '$attempts', '$terms', '$pre')";

if ($conn->query($sql) === TRUE) {
header("location:../examinations.php?rp=2932");
} else {
header("location:../examinations.php?rp=7788");
}


}
$conn->close();
?>
