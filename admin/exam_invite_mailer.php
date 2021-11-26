<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include '../database/config.php';

$emails =  $_POST["emails"];
$exam_id = $_POST["exam_id"];
$content = $_POST["content"];
$email_arr = explode(",",$emails);


foreach ($email_arr as $stu_mail) {

    $sql = "INSERT INTO tbl_exam_invites ( user_mail, exam_id) VALUES('$stu_mail', '$exam_id')";

    echo '<script>alert('.$sql.')</script>';
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
    $mail->AddAddress($stu_mail);
    $mail->SetFrom("cmrit.cseexamtool@gmail.com", "Admin");
    $mail->AddReplyTo('cmrit.cseexamtool@gmail.com', 'Admin');
    $mail->Subject = "Test Invite";

    $mail->MsgHTML($content);
    
    if(!$mail->Send()) {
    echo "Error while sending Email.";
    var_dump($mail);
    } else {
        echo "Email sent successfully";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
?>