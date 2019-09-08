<!DOCTYPE html>
<html>
    
<head>

        <title>GATE | Register</title>

        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Online Examination System" />
        <meta name="keywords" content="Online Examination System" />
        <meta name="author" content="Bwire Charles Mashauri" />

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
        <link href="assets/images/icon.png" rel="icon">
        <link href="assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/modern.css.css" rel="stylesheet" type="text/css"/>
         <link href="assets/css/snack.css" rel="stylesheet" type="text/css"/>
        <script src="assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
       
        
</head>
<body>

 
        
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
            <form action="add_std.php" method="POST">
		<div class="form-group">
                    
                    <h4>First Name</h4>
                        <input type="text" class="form-control" placeholder="Enter first name" name="fname" required autocomplete="off" required>
                        
                    </div>
										
                                            
                    <div class="form-group">
                        <h4>Last Name</h4>
                         <input type="text" class="form-control" placeholder="Enter last name" name="lname" required autocomplete="off" required>
                            

                    </div>          
		<div class="form-group">
                                    <h4>Date of Birth</h4>
                                    <input type="text" class="form-control date-picker" name="dob" required autocomplete="off" placeholder="(MM/DD/YYYY)" >
                                    </div>
            <div class="form-group">
                <h4>Gender</h4>
                    <div class="amount_list">
                        <input type="radio" name="gender" value="Male" id="gender-male" >
                        <label for="gender-male" class="gift_amount"><h4>Male</h4></label>
                        <input type="radio" name="gender" value="Female" id="gender-female"/>
                        <label for="gender-female" class="gift_amount"><h4>Female</h4></label>
                    </div>
            </div>
            

                                        
	 <div class="form-group">								<h4>Email</h4>
            
                    <input type="email" class="form-control" placeholder="Enter email address" name="email" required autocomplete="off" required> 

            </div>

 	<div class="form-group">								<h4>Semester-Section</h4>
            
                    <input type="text" class="form-control" placeholder="Enter Semester-Section" name="sem" required autocomplete="off" required> 

            </div>
<div class="form-group">								<h4>USN</h4>
            
                    <input type="text" class="form-control" placeholder="Enter USN" name="sec" required autocomplete="off" required> 

            </div>
        
        <div class="form-group">
            <h4>Phone</h4>
            
                    <input type="text" class="form-control" placeholder="Enter phone" name="phone" required autocomplete="off">

            </div> 
        
        <div class="form-group">
            <h4>Password</h4>                             
             
            <input type="password" class="form-control" placeholder="Enter the password" name="pass" required autocomplete="off"> 

                           
        </div>


        <div class="form-group">
            <h4>Repeat Password</h4>  
            
            <input type="password" class="form-control" placeholder="Enter again the password" name="repass" required autocomplete="off">

        </div>


			
        <div class="form-group">


		<h4>Select Department</h4>	
                                            
                    <select class="form-control" name="department" required>
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
	
                                    
	                
       


                                        <button type="submit" class="btn btn-success btn-block"><span>Submit </span></button>

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
        		<script>
function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
	
    </body>

</html>
