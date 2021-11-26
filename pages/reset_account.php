<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include '../includes/uniques.php';
include '../database/config.php';

$myid = mysqli_real_escape_string($conn, $_POST['user']);
$sql = "SELECT * FROM tbl_users WHERE user_id = '$myid' OR email = '$myid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
    while($row = $result->fetch_assoc()) {

	$myuserid = $row['user_id'];
	$myemail = $row['email'];
	$myfname = $row['first_name'];
	$mylname = $row['last_name'];
	$myfullname = "$myfname $mylname";

	$new_password = get_rand_alphanumeric(10);
	$key = md5($new_password);
	
		$expFormat = mktime(
		date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
		);
	$expDate = date("Y-m-d H:i:s",$expFormat);
	

	$sql = "INSERT INTO tbl_pass_reset_temp(`email`, `key`, `expDate`) VALUES ('".$myemail."', '".$key."', '".$expDate."');";
	$result = $conn->query($sql);

    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->SMTPDebug  = 1;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = 'cmrit.cseexamtool@gmail.com';
    $mail->Password   = 'dinanoel$1';
    $mail->IsHTML(true);
    $mail->AddAddress($myemail , $myfullname);
    $mail->SetFrom("cmrit.cseexamtool@gmail.com", "Admin");
    $mail->AddReplyTo('cmrit.cseexamtool@gmail.com', 'Admin');
	$mail->Subject = 'Online Exam Password Reset';
	$content = 'Hello '.$myfullname.', we received a request to reset your password for your <b>Online Examination System</b> account, <p><a href="http://localhost/CSE_Tool/pages/reset_password.php?key='.$key.'&email='.$myemail.'&action=reset" target="_blank">
		http://localhost/CSE_Tool/pages/reset_password.php?key='.$key.'&email='.$myemail.'&action=reset</a></p>';   
                              
	$mail->Body    = $content;
	$mail->AltBody = $content;

    $mail->MsgHTML($content);
	
    if(!$mail->Send()) {
	echo "<body><script>alert('Error while sending Email. Please try again');</script></body>";
	header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
		echo "<body><script>alert('Email sent successfully. Please check your inbox');window.location.href='http://localhost/CSE_Tool/';</script></body>";
		// header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
}
?>
