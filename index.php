<!DOCTYPE html>

<html lang="en">
    
<head>


        <title>Login</title>
       
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
     <body background-color="blue">
        <div class="limiter">
            
               <div class="container-login100">
                  
                        <div class="wrap-login100">
                           
                           <div class="login100-pic js-tilt" data-tilt>
                               <img src="CMRlogo2.jpg" alt="IMG">
				</div>


                               
                                <form class="login100-form validate-form" action="pages/authentication.php" method="POST">
                                    
                                    
                                    <span class="login100-form-title">
						Online Exam Login
					</span>
				<span style="font-weight: bolder;font-size:35px;font-color:teal">
							<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--> <a class="login100-form-title" href="registers.php">New User <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true">&nbsp;&nbsp;&nbsp; Register</i> 
						</a>
					</span>
					        <!-- <br><br>                       -->
                           
                                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                                        <input class="input100" type="email"  placeholder="CMRIT Email ID"  autocomplete="off" name="user" required>
                                    <span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

                                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                                        <input class="input100" type="password"  placeholder="Enter password" name="login" required>
                                    <span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
                                    	<div class="container-login100-form-btn">

                                    <button  class="login100-form-btn">Login</button>
                                    </div>

                                    <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>

                                    <a class="txt2" href="forgot_pw.php" >Username / Password?</a></div>
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
       
</body>
</html>

    </body>

</html>
