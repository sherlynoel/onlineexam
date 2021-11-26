<?php
include '../../database/config.php';
include '../../includes/uniques.php';
$exid = mysqli_real_escape_string($conn, $_GET['id']);
$examid = 'EX-'.mt_rand(100000,999999).'';

echo '<script>alert("Welcome to Geeks for Geeks")</script>'; 

$sql = "SELECT * FROM tbl_examinations WHERE exam_id='$exid'";


$result = $conn->query($sql);
			while($row = $result->fetch_assoc()) {

			$category = $row['category'];
			$department = $row['department'];
			$exam_name = $row['exam_name'];
			$duration = $row['duration'];
			$passmark = $row['passmark'];
			$t_mark = $row['t_mark'];
			$t_question = $row['t_question'];
			$terms = $row['terms'];

			}
		

$sql2 = "INSERT INTO tbl_examinations (exam_id, category, department, exam_name, duration, passmark, t_mark, t_question, terms) VALUES ('$examid', '$category', '$department', '$exam_name',  '$duration', '$passmark', '$t_mark', '$t_question', '$terms')";

if ($conn->query($sql2) === TRUE) {
    header("location:../examinations.php?rp=7823");
} else {
    header("location:../examinations.php?rp=1298");
}

$conn->close();
?>
