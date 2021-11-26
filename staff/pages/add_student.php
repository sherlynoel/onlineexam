<?php
date_default_timezone_set('Africa/Dar_es_salaam');
include '../../database/config.php';
include '../../includes/uniques.php';
$role = mysqli_real_escape_string($conn, $_POST['role']);
if ($role == "staff"){$student_id = 'F'.mt_rand(100,999).'-'.mt_rand(100,999).'-'.mt_rand(100,999).'';}
else{$student_id = 'S'.mt_rand(100,999).'-'.mt_rand(100,999).'-'.mt_rand(100,999).'';}

$fname = ucwords(mysqli_real_escape_string($conn, $_POST['fname']));
$lname = ucwords(mysqli_real_escape_string($conn, $_POST['lname']));
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$sem = mysqli_real_escape_string($conn, $_POST['sem']);
$sec = strtoupper(mysqli_real_escape_string($conn, $_POST['sec']));
$usn = strtoupper(mysqli_real_escape_string($conn, $_POST['usn']));
$department = mysqli_real_escape_string($conn, $_POST['department']);
$batch = mysqli_real_escape_string($conn, $_POST['batch']);
$course = mysqli_real_escape_string($conn, $_POST['course']);

$pass = mysqli_real_escape_string($conn, $_POST['pass']);
$repass = mysqli_real_escape_string($conn, $_POST['repass']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$dob = mysqli_real_escape_string($conn, $_POST['dob']);
$myfile = fopen("pass.txt", "w") or die("Unable to open file!");


$semSection=$sem."-".$sec ;
echo $student_id."<br>".$fname."<br>".$lname."<br>".$sem."<br>".$email."<br>".$phone."<br>".$pass."<br>".$repass."<br>".$department."<br>".$sec."<br>".$gender."<br>".$semSection."<br>" ;
$sql = "INSERT into tbl_org (email) VALUES ('$email')";
$result = $conn->query($sql);
$sql = "SELECT * FROM tbl_users WHERE email = '$email' OR phone = '$phone'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    $sem = $row['email'];
	$sph = $row['phone'];
	if ($sem == $email) {
	 header("location:../students.php?rp=1189");	
	}else{
	
	if ($sph == $phone) {
	 header("location:../students.php?rp=2074");	
	}
	
	}
	
    }
} else {
$new_password = md5($_POST['pass']);
fwrite($myfile, $new_password);

fclose($myfile);
$sql = "INSERT INTO tbl_users (user_id, first_name, last_name, gender,  email, sem_sec, usn, department, phone, dob, batch, course, login ,role)
        VALUES ('$student_id', '$fname', '$lname', '$gender', '$email', '$semSection', '$usn', '$department','$phone', '$dob', '$batch', '$course','$new_password','$role')";

if ($conn->query($sql) === TRUE) {
  header("location:../students.php?rp=6310");
} else {
  header("location:../students.php?rp=9157");
}


}

$conn->close();
?>
