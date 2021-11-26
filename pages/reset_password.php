<!DOCTYPE html>
<!-- <?php include '../includes/check_reply.php'; ?> -->
<html>
    
<head>

        <title>GATE | Reset Password</title>
        
        <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
<!--===============================================================================================-->

        
    </head>
<body <?php //if ($ms == "1") { print 'onload="myFunction()"'; } ?>  class="page-header-fixed">        <div class="limiter">
            
               <div class="container-login100">
                  
                        <div class="wrap-login100">
                           
                           <div class="login100-pic js-tilt" data-tilt>
                               <img src="../CMRlogo2.jpg" alt="IMG">
				</div>


                               
                               
                               
        <?php
include '../database/config.php';

if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) 
&& ($_GET["action"]=="reset") && !isset($_POST["action"])){
  $key = $_GET["key"];
  $email = $_GET["email"];
  $curDate = date("Y-m-d H:i:s");

  $sql =  "SELECT * FROM `tbl_pass_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';";
  $result = $conn->query($sql);

  if ($result->num_rows < 1){
  $error .= '<h2>Invalid Link</h2>
<p>The link is invalid/expired. Either you did not copy the correct link
from the email, or you have already used the key in which case it is deactivated.</p>
<p><a href="http://localhost/CSE_Tool/forgot_pw.php">
Click here</a> to reset password.</p>';
 }
 else
 {
  $result = $result->fetch_assoc();
  $expDate = $result['expDate'];
  if ($expDate >= $curDate){
  ?>
  <br />
  <form method="post" action="" name="update">
  <input type="hidden" name="action" value="update" />
  <br /><br />
  <label><strong>Enter New Password:</strong></label><br />
  <input type="password" class = "input100" name="pass1" required />
  <br /><br />
  <label><strong>Re-Enter New Password:</strong></label><br />
  <input type="password" class = "input100" name="pass2" required/>
<span class="focus-input100"></span>
						
  <br /><br />
  <input type="hidden" name="email" value="<?php echo $email;?>"/>
  <input type="submit" class = "login100-form-btn" value="Reset Password" />
  </form>
<?php
}else{
$error .= "<h2>Link Expired</h2>
<p>The link is expired. You are trying to use the expired link which 
as valid only 24 hours (1 days after request).<br /><br /></p>";
            }
      }
if($error!=""){
  echo "<div class='error'>".$error."</div><br />";
  } 
} // isset email key validate end
 
 
if(isset($_POST["email"]) && isset($_POST["action"]) &&
 ($_POST["action"]=="update")){
$error="";
$pass1 = mysqli_real_escape_string($conn,$_POST["pass1"]);
$pass2 = mysqli_real_escape_string($conn,$_POST["pass2"]);
$email = $_POST["email"];
$curDate = date("Y-m-d H:i:s");
if ($pass1!=$pass2){
$error.= "<p>Password do not match, both password should be same.<br /><br /></p>";
  }
  if($error!=""){
echo "<div class='error'>".$error."</div><br />";
}else{

$pass1 = md5($pass1);
$sql = "UPDATE `tbl_users` SET `login`='".$pass1."' WHERE `email`='".$email."';";
$result = $conn->query($sql);

$sql = "DELETE FROM `tbl_pass_reset_temp` WHERE `email`='".$email."';";
$result = $conn->query($sql);

echo '<div class="error"><p><strong>Your password has been updated successfully.</p>
<p><a style = "color : green ; font-weight : bold; " href="http://localhost/CSE_Tool/">
Click here</a> to Login.</p></div><br />';
   } 
}
?>
                               
                            </div>
                        </div>
                    </div>
                
            
        
			

<!--===============================================================================================-->	
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="../assets/js/main_1.js"></script>
	<script>
// function myFunction() {
//     var x = document.getElementById("snackbar")
//     x.className = "show";
//     setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
// }
      
    </body>

</html>