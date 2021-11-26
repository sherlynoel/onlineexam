<!DOCTYPE html>
<?php include 'includes/check_reply.php'; ?>
<html>
    
<head>

        <title>GATE | Reset Password</title>
        
        <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<!--===============================================================================================-->

        
    </head>
<body <?php if ($ms == "1") { print 'onload="myFunction()"'; } ?>  class="page-header-fixed">        <div class="limiter">
            
               <div class="container-login100">
                  
                        <div class="wrap-login100">
                           
                           <div class="login100-pic js-tilt" data-tilt>
                               <img src="CMRlogo2.jpg" alt="IMG">
				</div>


                               
                               
                               
                                <form class="login100-form validate-form" action="pages/reset_account.php" method="POST">
                                	<b style="color:green" class="login100-form-title">RESET PASSWORD</b>
                                     <span class="login100-form-title">
                                     Please enter your registered CMRIT email ID.</span>
                                   
                                     <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                                        <input type="text" class="input100" placeholder="CMRIT Email ID"  autocomplete="off" name="user" required>
                                    <span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
                                     <div class="container-login100-form-btn">
                                         <button type="submit" class="login100-form-btn">Set new password</button><br>
                                         <br><a href="./" class="txt2">Access my account</a>
                                     </div>
                                </form>
                               
                            </div>
                        </div>
                    </div>
                
            
        
			

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="assets/js/main_1.js"></script>
	<script>
function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
      
    </body>

</html>