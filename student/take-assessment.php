<?php include 'includes/check_user.php';

if (isset($_GET['id'])) {
include '../database/config.php';	
$exam_id = mysqli_real_escape_string($conn, $_GET['id']);
$record_found = 0;
$sql = "SELECT * FROM tbl_examinations WHERE exam_id = '$exam_id' AND department = '$mydepartment'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
		$category = $row['category'];
		$exam_name = $row['exam_name'];
		$deadline = $row['date'];
		$duration = $row['duration'];
		$passmark = $row['passmark'];
		$reexam = $row['re_exam'];
		$terms = $row['terms'];
		$status = $row['status'];
		$today_date = date('Y/m/d');
		$next_retake = date('m/d/Y', strtotime($today_date. ' + '.$reexam.' days'));
		$dcv = date_format(date_create_from_format('m/d/Y', $deadline), 'Y/m/d');


		if ($status == "Inactive") {
			header("location:./");	
		}
  }
}else{
	header("location:./");	
}
$quest = 0;
$mark = 0;	
$sql = "SELECT t_mark,t_question FROM tbl_examinations WHERE exam_id = '$exam_id'";
$result = $conn->query($sql);

if ($result) {

    $row = $result->fetch_assoc();
    $quest = $row['t_question'];
		$mark = $row['t_mark'];
    
} else {

}


$sql = "SELECT * FROM tbl_assessment_records WHERE student_id = '$myid' AND exam_id = '$exam_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
		$record_found = 1;
		$score = $row['score'];
		$status = $row['status'];
		$take_date = $row['date'];
		$retake_date = $row['next_retake'];
		$today_date = date('Y/m/d');
		$retakeconv = date_format(date_create_from_format('m/d/Y', $retake_date), 'Y/m/d');
		$tc = strtotime($today_date);
		$rc = strtotime($retakeconv);
		$dc = strtotime($dcv);
		$td = ($tc - $rc)/86400;
		$dcc = ($tc - $dc)/86400;

  }
} else {
    
}


$conn->close();
}else{

header("location:./");	
}

 ?>
<!DOCTYPE html>
<html>
    
<head>
        
        <title>GATE | Take Assessment</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Online Examination System" />
        <meta name="keywords" content="Online Examination System" />
        <meta name="author" content="Bwire Charles Mashauri" />
        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="../assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="../assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/images/icon.png" rel="icon">
        <link href="../assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
        <script src="../assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
        
    </head>
    <body class="page-header-fixed">
        <div class="overlay"></div>
        <div class="menu-wrap">
            <nav class="profile-menu">
                <div class="profile">
				<?php 
				if ($myavatar == NULL) {
				print' <img width="60" src="../assets/images/'.$mygender.'.png" alt="'.$myfname.'">';
				}else{
				echo '<img src="data:image/jpeg;base64,'.base64_encode($myavatar).'" width="60" alt="'.$myfname.'"/>';	
				}
						
				?>
				<span><?php echo "$myfname"; ?> <?php echo "$mylname"; ?></span></div>
                <div class="profile-menu-list">
                    <a href="profile.php"><i class="fa fa-user"></i><span>Profile</span></a>
                    <a href="logout.php"><i class="fa fa-sign-out"></i><span>Logout</span></a>
                </div>
            </nav>
            <button class="close-button" id="close-button">Close Menu</button>
        </div>

        <main class="page-content content-wrap">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="sidebar-pusher">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="logo-box">
                        <a href="./" class="logo-text"><span><img src="gate.png" alt="" height="55" width="130"></span></a>
                    </div>

                    <div class="topmenu-outer">
                        <div class="top-menu">
                            <ul class="nav navbar-nav navbar-right">


                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                        <span class="user-name"><?php echo "$myfname"; ?> <?php echo "$mylname"; ?><i class="fa fa-angle-down"></i></span>
										<?php 
						                if ($myavatar == NULL) {
						                print' <img class="img-circle avatar"  width="40" height="40" src="../assets/images/'.$mygender.'.png" alt="'.$myfname.'">';
						                }else{
						                echo '<img width="40" height="40" src="data:image/jpeg;base64,'.base64_encode($myavatar).'" class="img-circle avatar"  alt="'.$myfname.'"/>';	
						                }
						
						                ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-list" role="menu">
                                        <li role="presentation"><a href="profile.php"><i class="fa fa-user"></i>Profile</a></li>
                                        <li role="presentation"><a href="logout.php"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="logout.php" class="log-out waves-effect waves-button waves-classic">
                                        <span><i class="fa fa-sign-out m-r-xs"></i>Log out</span>
                                    </a>
                                </li>
                                <li>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-sidebar sidebar">
                <div class="page-sidebar-inner slimscroll">
                    <div class="sidebar-header">
                        <div class="sidebar-profile">
                            <a href="javascript:void(0);" id="profile-menu-link">
                                <div class="sidebar-profile-image">
								<?php 
						        if ($myavatar == NULL) {
						        print' <img class="img-circle img-responsive" src="../assets/images/'.$mygender.'.png" alt="'.$myfname.'">';
						        }else{
						        echo '<img src="data:image/jpeg;base64,'.base64_encode($myavatar).'" class="img-circle img-responsive"  alt="'.$myfname.'"/>';	
						        }
						
						        ?>
                       
                                </div>
                                <div class="sidebar-profile-details">
                                    <span><?php echo "$myfname"; ?> <?php echo "$mylname"; ?><br><small>GATE Student</small></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <ul class="menu accordion-menu">
                        <li><a href="./" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
                        <li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subject</p></a></li>
                        <li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
                        <li><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
                         <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>
                     <li><a href="helps.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-modal-window"></span><p>Help</p></a></li>
                    </ul>
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>Take Assessment</h3>
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="examinations.php">Assessments</a></li>
                            <li class="active"><?php echo "$exam_name"; ?></li>
                        </ol>
                    </div>
                </div>
                <div id="main-wrapper">
                    <div class="row col-md-12">
                        <div class="col-md-6">
                          
                                <div class="row">
                           <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Examination Properties</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive project-stats">  
                                       <table class="table">
                                          
                                           <tbody>
                                               <tr>
                                                   <th scope="row">1</th>
                                                   <td>Exam Name</td>
                                                   <td><?php echo "$exam_name"; ?></td>
                                               </tr>
											     <tr>
                                                   <th scope="row">2</th>
                                                   <td>Subject</td>
                                                   <td><?php echo "$category"; ?></td>
                                               </tr>
											   
											   
											 
											   
											 		   
											   											<tr>
                                                   <th scope="row">3</th>
                                                   <td>Questions</td>
                                                   <td><b><?php echo "$quest"; ?></b></td>
                                               </tr>
                                               <tr>
                                                   <th scope="row">4</th>
                                                   <td>Total Marks</td>
                                                   <td><b><?php echo "$mark"; ?></b></td>
                                               </tr>
                                               
                                               <tr>
                                                   <th scope="row">5</th>
                                                   <td>Pass Percentage</td>
                                                   <td><b><?php echo "$passmark"; ?>%</b></td>
                                               </tr>
                                              
                                           </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
   
                                </div>
                           
                        </div>
						
												 <div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Terms and conditions</h3>
                                </div>
                                <div class="panel-body">
                                    <?php echo "$terms"; ?>
                                </div>
                            </div>
                        </div>
						
												<div class="col-md-6">
                            <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Take Assessment</h3>
                                </div>
                                <div class="panel-body">
								<?php
								if ($record_found == "0") {
									
								
								$_SESSION['current_examid'] = $exam_id;
								$_SESSION['student_retake'] = 0;
								print '
                                 <div class="alert alert-success" role="alert">
                                  You are good to go.
                                    </div>

									'; ?>
									<a onclick="return confirm('Are you sure you want to begin ?')" class="btn btn-success" href="assessment.php">Begin Assessment</a>
									
									<?php
                  									
									
								}else{
								    print '
                                 <div class="alert alert-success" role="alert">
                                  You Have Already Sumited the Test.
                                    </div> ';
								}
								
								?>

									
                                </div>
                            </div>
                        </div>
						
			

                
                		</div>
                		
                		<div class="row col-md-12">
                			
                            <div class="panel panel-white">
                                <div class="panel-heading" style="text-align:center">
                                   <div class="col-md-4">
																	</div>
                                    <div class="col-md-4">
                                    	<p class="text-center "><b>Please Note</b></p>
                                    </div>
                                    <div class="col-md-4">
																	</div>
                                </div>
                                <div class="panel-body">
																		<div><p class="alert alert-success" style="text-align:center; margin:0!important"><b>The test auto submits so don't worry when time expires</b></p></div>
                                </div>
                            </div>
                        
                		</div>
                
            </div>
					</div>
        </main>

        <div class="cd-overlay"></div>
	
        <script src="../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="../assets/plugins/pace-master/pace.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../assets/plugins/switchery/switchery.min.js"></script>
        <script src="../assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/main.js"></script>
        <script src="../assets/plugins/waves/waves.min.js"></script>
        <script src="../assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="../assets/plugins/waypoints/jquery.waypoints.min.js"></script>
        <script src="../assets/plugins/jquery-counterup/jquery.counterup.min.js"></script>
        <script src="../assets/plugins/toastr/toastr.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="../assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../assets/plugins/curvedlines/curvedLines.js"></script>
        <script src="../assets/plugins/metrojs/MetroJs.min.js"></script>
        <script src="../assets/js/modern.js"></script>

		<script src="../assets/js/canvasjs.min.js"></script>
		 

        
    </body>


</html>
