<?php
date_default_timezone_set('Africa/Dar_es_salaam');
include 'database/config.php';
include 'includes/uniques.php';
$student_id = 'S'.mt_rand(100,999).'-'.mt_rand(100,999).'-'.mt_rand(100,999).'';
$fname = ucwords(mysqli_real_escape_string($conn, $_POST['fname']));
$lname = ucwords(mysqli_real_escape_string($conn, $_POST['lname']));
$sem = mysqli_real_escape_string($conn, $_POST['sem']);
$sec = mysqli_real_escape_string($conn, $_POST['sec']);
$usn = mysqli_real_escape_string($conn, $_POST['usn']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$dob = mysqli_real_escape_string($conn, $_POST['dob']);
$pass = mysqli_real_escape_string($conn, $_POST['pass']);
$repass = mysqli_real_escape_string($conn, $_POST['repass']);
$department = mysqli_real_escape_string($conn, $_POST['department']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$batch = mysqli_real_escape_string($conn, $_POST['batch']);
$course = mysqli_real_escape_string($conn, $_POST['course']);
// $role = mysqli_real_escape_string($conn, $_POST['role']);
$semSection=$sem."-".$sec ;
echo $student_id."<br>".$fname."<br>".$lname."<br>".$sem."<br>".$email."<br>".$phone."<br>".$pass."<br>".$repass."<br>".$department."<br>".$sec."<br>".$gender."<br>".$semSection."<br>" ;

//if ($pass != $repass)
//{
//echo "<script type='text/javascript'>alert('password not matched!');
//window.location.href='registers.php';
//</script>";
//}
//else
//{
$sql = "SELECT * FROM tbl_users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
    $sem = $row['email'];
	if ($sem == $email) {
        header("location:registers.php?rp=1189");
	 
	}
	
    }
} else {

       $new_password = md5($_POST['pass']);

        $mysql = "INSERT INTO tbl_users (user_id, first_name, last_name, gender,  email, sem_sec, usn, department, phone,dob, batch, course, login ,role)
        VALUES ('$student_id', '$fname', '$lname', '$gender', '$email', '$semSection', '$usn', '$department','$phone', '$dob','$batch', '$course','$new_password','student')";

        if ($conn->query($mysql) === TRUE) 

        { 
          
	           header("location:index.php?rp=6310");
					
        }

        else {
//             echo "<script type='text/javascript'>alert('Connection Failed, Register Again !!');
//                        window.location.href='registers.php';
//                        </script>";
					header("location:index.php?rp=9157");

        }


}



//}


$conn->close();
?>
