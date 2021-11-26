<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
?>
<!DOCTYPE html>
<html>
   
<head>
        
        <title>CSE EXAM TOOL | My Results</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Online Examination System" />
        <meta name="keywords" content="Online Examination System" />
        <meta name="author" content="Bwire Charles Mashauri" />

        <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'> -->
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
        <link href="../assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>  
        <link href="../assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>  
        <link href="../assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
        <link href="../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/images/icon.png" rel="icon">
        <link href="../assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/snack.css" rel="stylesheet" type="text/css"/>
        <script src="../assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
        

        
    </head>
    <body <?php if ($ms == "1") { print 'onload="myFunction()"'; } ?>  class="page-header-fixed">
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
                         <li class="active"><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>
<li><a href="helps.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-modal-window"></span><p>Help</p></a></li>
                    </ul>
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>My Results</h3>

                    <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
						<div class="row">
                            <div class="col-md-12">

                                <div class="panel panel-white">
                                    <div class="panel-body">
                                           <div class="table-responsive">
										   <?php
                                           include '../database/config.php';
                                           $sql = "SELECT distinct A.exam_name FROM tbl_assessment_records A , tbl_examinations B WHERE A.exam_id = b.exam_id AND student_id = '$myid'";
                                           
                                           $result = $conn->query($sql);
                                           if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                               $exna = $row['exam_name'];
                                               
                                               print '<h4><b>'.$exna.'</b></h4>';

										   $sql = "SELECT * FROM tbl_assessment_records A , tbl_examinations B WHERE A.exam_id = b.exam_id AND student_id = '$myid' and A.exam_name = '$exna'";
                                           
                                           $result = $conn->query($sql);

                                           if ($result->num_rows > 0) {
										print '
										<table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
												
												<th>Score</th>
                                                <th>Status</th>
                                                <th></th>
                                                
                                   
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Date</th>
												
												<th>Score</th>
                                                <th>Status</th>
                                                <th></th>
                                               
                                           
                                            </tr>
                                        </tfoot>
                                        <tbody>';
     
                                           while($row = $result->fetch_assoc()) {
                                            $timestamp =  $row['date'];
                                            $datetime = explode(" ",$timestamp);
                                            $date = $datetime[0];
                                            $time = $datetime[1];
											   
                                          print '
                                               <tr>
                                               
                                                <td>'.$date.'</td>
												
                                                <td>'.$row['score'].'</td>
                                                <td>'.$row['exam_status'].'</td>
                                                ';
                                                if($row['report'] == 1){
                                                    print '
                                                <td><a href="view_report.php?exid='.$row['exam_id'].'"><button type="button" class = "btn btn-primary ">View Report</button></a></td>';
                                                }
                                                print '
          
                                            </tr>';
                                           }
										   
										   print '
									   </tbody>
                                       </table>  ';
                                            }}} else {
											print '
												<div class="alert alert-info" role="alert">
                                        Nothing was found in database.
                                    </div>';
    
                                           }
                                           $conn->close();
										   
										   ?>


                 

                                    </div>
                                    </div>
                                </div>  
  
                            </div>
                        </div>


                        </div>
                    </div>
                </div>

                </div>
           
    </body>

</html>