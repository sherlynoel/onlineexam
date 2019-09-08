<?php
date_default_timezone_set('Africa/Dar_es_salaam');
include 'database/config.php';
include 'includes/uniques.php';
$student_id = 'S'.get_rand_numbers(3).'-'.get_rand_numbers(3).'-'.get_rand_numbers(3).'';
$fname = ucwords(mysqli_real_escape_string($conn, $_POST['fname']));
$lname = ucwords(mysqli_real_escape_string($conn, $_POST['lname']));
$sem = mysqli_real_escape_string($conn, $_POST['sem']);
$sec = strtoupper(mysqli_real_escape_string($conn, $_POST['sec']));
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$pass = mysqli_real_escape_string($conn, $_POST['pass']);
$repass = mysqli_real_escape_string($conn, $_POST['repass']);
$department = mysqli_real_escape_string($conn, $_POST['department']);


$dob = mysqli_real_escape_string($conn, $_POST['dob']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);

if ($pass != $repass)
{
echo "<script type='text/javascript'>alert('password not matched!');
window.location.href='registers.php';
</script>";
}
else
{
$sql = "SELECT * FROM tbl_users WHERE email = '$email' OR phone = '$phone'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    $sem = $row['email'];
	$sph = $row['phone'];
	if ($sem == $email) {
	 header("location:.index.php.php?rp=1189");	
	}else{
	
	if ($sph == $phone) {
	 header("location:.index.php.php?rp=2074");	
	}else{
		
	}
	
	}
	
    }
} else {

$sql = "INSERT INTO tbl_users (user_id, first_name, last_name, gender, dob, email, sem, sec, phone, department)
VALUES ('$student_id', '$fname', '$lname', '$gender', '$dob', '$email', '$sem', '$sec', '$phone', '$department')";

if ($conn->query($sql) === TRUE) {
  header("location:../students.php?rp=6310");
} else {
  header("location:../students.php?rp=9157");
}


}
$new_password = md5($_POST['pass']);

$sql = "UPDATE tbl_users SET login='$new_password' WHERE user_id='$student_id '";

if ($conn->query($sql) === TRUE) {
	header("location:index.php?rp=7823");
} else {
   header("location:.index.php?rp=1298");
}
}
$conn->close();
?>
