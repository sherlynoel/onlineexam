<?php
$student_id = $_POST['student_id'];
include '../../database/config.php';
$fname = ucwords(mysqli_real_escape_string($conn, $_POST['fname']));
$lname = ucwords(mysqli_real_escape_string($conn, $_POST['lname']));
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$sem = mysqli_real_escape_string($conn, $_POST['sem']);
$sec = strtoupper(mysqli_real_escape_string($conn, $_POST['sec']));
$department = mysqli_real_escape_string($conn, $_POST['department']);
$category = mysqli_real_escape_string($conn, $_POST['category']);

$dob = mysqli_real_escape_string($conn, $_POST['dob']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);

$sql = "SELECT * FROM tbl_users WHERE email = '$email' AND user_id !='$student_id' OR phone = '$phone' AND user_id !='$student_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    $sem = $row['email'];
	$sph = $row['phone'];
	if ($sem == $email) {
	 header("location:../edit-student.php?rp=1189&sid=$student_id");	
	}else{
	
	if ($sph == $phone) {
	 header("location:../edit-student.php?rp=2074&sid=$student_id");	
	}else{
		
	}
	
	}
	
    }
} else {

$sql = "UPDATE tbl_users SET first_name = '$fname', last_name = '$lname', gender = '$gender', dob = '$dob', email = '$email', sem = '$sem', sec = '$sec', phone = '$phone', department = '$department', category = '$category' WHERE user_id='$student_id'";

if ($conn->query($sql) === TRUE) {
  header("location:../students.php?rp=7823&sid=$student_id");
 
  
} else {
  header("location:../student.php?rp=1298&sid=$student_id");
}


}

$conn->close();
?>
