<?php 
	include 'includes/check_reply.php';
?>
<!DOCTYPE html>
<html>

<head>

    <title>GATE | Register</title>


    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta charset="UTF-8">
    <meta name="description" content="Online Examination System" />
    <meta name="keywords" content="Online Examination System" />
    <meta name="author" content="Sherly Noel" />

   <!--  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'> -->
    <link href="assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <link href="assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
    <link href="assets/images/icon.png" rel="icon">
    <link href="assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
<!---->
<!---->
<!--   -->
    <link href="assets/css/snack.css" rel="stylesheet" type="text/css"/>
    <script src="assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
    <script src="assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>


</head>
<body  <?php if ($ms == "1") { print 'onload="myFunction()"'; } ?>  class="page-header-fixed">

    <main class="bg-light">
    <div class="row">
    <div class="col-lg-offset-0">
    <div class="row">
    <div class="col-md-15">

    <div class="panel panel-blue">
    <div class="panel-body">
    <div class="table-responsive">


    </div></div></div></div></div></div></div>



    <div class="row">
    <div class="col-lg-offset-4">
    <div class="row">
    <div class="col-md-6">

    <div class="panel panel-body">
    <div class="panel-body">
    <div class="table-responsive">
    <form action="add_fac.php" method="POST">
                <div class="form-group">
                <h4>First Name</h4>
                <input type="text" class="form-control" placeholder="Enter first name" name="fname" required autocomplete="off" required></div>
        
                <div class="form-group">
                <h4>Last Name</h4>
                <input type="text" class="form-control" placeholder="Enter last Name " name="lname" autocomplete="off" >
                </div>          

                <div class="form-group">
                    <h4>Gender</h4>
                    <select class="form-control" name="gender" required>
                        <option value="" selected disabled>-Select Gender-</option>
                        <option value="Male" >Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>



            <div class="form-group"><h4>Email</h4>
            <input type="email" class="form-control" placeholder="Enter email address." name="email"  
                   required autocomplete="off" required> 
                </div>

                <div class="form-group">
                <h4>Phone Number</h4>
                        <input type="number" class="form-control" placeholder="Enter phone" name="phone" pattern=".{10}" required autocomplete="off" required>
                </div>
                <div class="form-group">
                <h4>Date of Birth </h4>
                        <input type="date" class="form-control"  name="date"  required autocomplete="off" required>
                </div>
               <div class="form-group">
                    <h4>Select Department</h4>	

                    <select class="form-control" name="department" >
                    <option value="" selected disabled>-Select department-</option>
                    <?php
                    include 'database/config.php';
                    $sql = "SELECT * FROM tbl_departments WHERE status = 'Active' ORDER BY name";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    print '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                    }
                    }
                    else {
                    }
                    $conn->close();
                    ?>										
                    </select>
                </div>
             
        
        
             <!--   <div class="form-group"><h4>USN</h4>
<input type="text" class="form-control" placeholder="Enter USN ex: 1CR16CS001" name="usn" required autocomplete="off" 
         required> 
         pattern="(1CR)[0-9][0-9][A-Z][A-Z][0-9][0-9][0-9]" 
                </div>-->

          

<div class="form-group">
                    <h4>Role</h4>
                    <select class="form-control" name="role" required>
                        <option value="" selected disabled>-Select Role-</option>
                        <option value="admin" >Admin</option>
                        
			<option value="staff">Staff</option>
			
                    </select>
                </div>	
                
                </div>
                    <h4>Course</h4>
                    <select class="form-control" name="course" required>
                        <option value="" selected disabled>-Select Course-</option>
                        <option value="PG" >PG</option>
                        <option value="UG">UG</option>
                    </select>
                </div>
                						<div class="form-group">
                <h4>Password</h4>                             
                <input type="password" class="form-control" placeholder="Enter the password" name="pass" id="password" required autocomplete="off" required> 
                </div>


                <div class="form-group">
                <h4>Repeat Password</h4>  

                <input type="password" class="form-control" placeholder="Enter again the password" name="repass" id="confirm_password"  required autocomplete="off" onkeyup="check()" required>
								<span id='message'></span>
                </div>		
		 
				

                <button type="submit" id='subbut' class="btn btn-success btn-block" disabled><span>Submit </span></button>

    </form>
    </div>

    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="row">
    <div class="col-lg-offset-4">
    <div class="row">
    <div class="col-md-6">

    <div class="panel panel-blue">
    <div class="panel-body">
    <div class="table-responsive">


    </div></div></div></div></div></div></div>


    </main>   
    <?php if ($ms == "1") {
?> <div class="alert alert-success" id="snackbar"><?php echo "$description"; ?></div> <?php	
}else{
	
}
?> 
        
			<div class="cd-overlay"></div>

<script>
function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
		
}
var check = function() {
	var button = document.getElementById('subbut')
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
		button.disabled = false;
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
		button.disabled = true;
  }
}
</script>

    <script src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/plugins/pace-master/pace.min.js"></script>
    <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/switchery/switchery.min.js"></script>
    <script src="assets/plugins/uniform/jquery.uniform.min.js"></script>
    <script src="assets/plugins/offcanvasmenueffects/js/classie.js"></script>
    <script src="assets/plugins/waves/waves.min.js"></script>
	  <script src="assets/js/modern.min.js"></script>
    
	

</body>

</html>
