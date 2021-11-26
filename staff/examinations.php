<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
?>
<!DOCTYPE html>
<html>

<head>

    <title>GATE | Manage Examinations</title>

    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta charset="UTF-8">
    <meta name="description" content="Online Examination System" />
    <meta name="keywords" content="Online Examination System" />
    <meta name="author" content="Bwire Charles Mashauri" />

    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'> -->
    <link href="../assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet" />
    <link href="../assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet" />
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"
        type="text/css">
    <link href="../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/images/icon.png" rel="icon">
    <link href="../assets/css/modern.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css" />
    <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/snack.css" rel="stylesheet" type="text/css" />
    <script src="../assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
    <script src="../assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>


    <link href="../assets/plugins/summernote-master/summernote.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/bootstrap-colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"
        type="text/css" />




</head>

<body <?php if ($ms == "1") { print 'onload="myFunction()"'; } ?> class="page-header-fixed">
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
                <span><?php echo "$myfname"; ?> <?php echo "$mylname"; ?></span>
            </div>
            <div class="profile-menu-list">
                <a href="profile.php"><i class="fa fa-user"></i><span>Profile</span></a>
                <a href="logout.php"><i class="fa fa-sign-out"></i><span>Logout</span></a>
            </div>
        </nav>
        <button class="close-button" id="close-button">Close Menu</button>
    </div>
    <form class="search-form" action="search.php" method="GET">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control search-input" placeholder="Search student..."
                required>
            <span class="input-group-btn">
                <button class="btn btn-default close-search waves-effect waves-button waves-classic" type="button"><i
                        class="fa fa-times"></i></button>
            </span>
        </div>
    </form>
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
                <div class="search-button">
                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i
                            class="fa fa-search"></i></a>
                </div>
                <div class="topmenu-outer">
                    <div class="top-menu">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="javascript:void(0);"
                                    class="waves-effect waves-button waves-classic show-search"><i
                                        class="fa fa-search"></i></a>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic"
                                    data-toggle="dropdown">
                                    <span class="user-name"><?php echo "$myfname"; ?> <?php echo "$mylname"; ?><i
                                            class="fa fa-angle-down"></i></span>
                                    <?php 
						                if ($myavatar == NULL) {
						                print' <img class="img-circle avatar"  width="40" height="40" src="../assets/images/'.$mygender.'.png" alt="'.$myfname.'">';
						                }else{
						                echo '<img width="40" height="40" src="data:image/jpeg;base64,'.base64_encode($myavatar).'" class="img-circle avatar"  alt="'.$myfname.'"/>';	
						                }
						
						                ?>
                                </a>
                                <ul class="dropdown-menu dropdown-list" role="menu">
                                    <li role="presentation"><a href="profile.php"><i class="fa fa-user"></i>Profile</a>
                                    </li>
                                    <li role="presentation"><a href="logout.php"><i
                                                class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
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
                                <span><?php echo "$myfname"; ?> <?php echo "$mylname"; ?><br><small>GATE
                                        Staff</small></span>
                            </div>
                        </a>
                    </div>
                </div>
                <ul class="menu accordion-menu">
                <li ><a href="./" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
                        <!-- <li><a href="departments.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-folder-open"></span><p>Departments</p></a></li> -->
                        

                        <li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
                        <li><a href="categories.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-tags"></span><p>Subject</p></a></li>
                        <li class="active"><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
                        <!-- <li><a href="questions.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-question-sign"></span><p>Questions</p></a></li> -->
                        <!-- <li><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Notice</p></a></li> -->
                        <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>

                </ul>
            </div>
        </div>
        <div class="page-inner">
            <div class="page-title">
                <h3>Manage Examinations</h3>



            </div>
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="panel panel-white">
                                    <div class="panel-body">
                                        <div role="tabpanel">

                                            <ul class="nav nav-tabs" role="tablist">

                                                <li role="presentation" class="active"><a href="#tab5" role="tab"
                                                        data-toggle="tab">Examinations</a></li>
                                                <li role="presentation"><a href="#tab6" role="tab" data-toggle="tab">Add
                                                        Exam</a></li>

                                            </ul>

                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active fade in" id="tab5">
                                                    <div class="table-responsive">
                                                        <?php
                                                    include '../database/config.php';
                                                    $sql = "SELECT * FROM tbl_examinations";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                    print '
                                                    <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                                    <thead>
                                                    <tr>
                                                    <th>Name</th>
                                                    <th>Subject</th>
                                                    <th>department</th>

                                                    <th>ID</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                    <th>Name</th>
                                                    <th>Subject</th>
                                                    <th>department</th>

                                                    <th>ID</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    <th></th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>';

                                                    while($row = $result->fetch_assoc()) {
                                                    $status = $row['status'];
                                                    if ($status == "Active") {
                                                    $st = '<p class="text-success">ACTIVE</p>';
                                                    $stl = '<a href="pages/make_ex_in.php?id='.$row['exam_id'].'">Make Inactive</a>';
                                                    }else{
                                                    $st = '<p class="text-danger">INACTIVE</p>'; 
                                                    $stl = '<a href="pages/make_ex_ac.php?id='.$row['exam_id'].'">Make Active</a>';											   
                                                    }
                                                    // <li><a href="add-questions.php?eid='.$row['exam_id'].'">Add Question Bank </a></li>
                                                    // <li><a href="edit-topic.php?eid='.$row['exam_id'].'">Edit Topic</a></li>
                                                    // <li><a href="view-questions.php?eid='.$row['exam_id'].'">Select Question Bank</a></li>
                                                    print '
                                                    <tr>
                                                    <td>'.$row['exam_name'].'</td>
                                                    <td>'.$row['category'].'</td>
                                                    <td>'.$row['department'].'</td>

                                                    <td>'.$row['exam_id'].'</td>
                                                    <td>'.$st.'</td>
                                                    <td><div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    Select Action
                                                    <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                    <li>'.$stl.'</li>
                                                    <li><a href="pages/retake_exam.php?id='.$row['exam_id'].'">Re-Exam</a></li>
                                                    <li><a href="pages/release-report.php?eid='.$row['exam_id'].'">Release Report</a> </li>
                                                    
                                                    <li><a'; ?> onclick = "return confirm('Drop <?php echo $row['exam_name']; ?> ?')" <?php print ' href="pages/drop_ex.php?id='.$row['exam_id'].'">Drop Exam</a></li>
                                                    </ul>
                                                    </div></td>
                                                    <td> <a class="btn btn-primary" href="manage_exam.php?eid='.$row['exam_id'].'">Add Questions and Launch Exam</a> </td>

                                                    </tr>';
                                                    }

                                                    print '
                                                    </tbody>
                                                    </table>  ';
                                                    } else {
                                                    print '
                                                    <div class="alert alert-info" role="alert">
                                                    Nothing was found in database.
                                                    </div>';

                                                    }
                                                    $conn->close();

                                                    ?>




                                                    </div>

                                                </div>

                                                <div role="tabpanel" class="tab-pane fade" id="tab6">

                                                    <div>

                                                        <form action="pages/add_exam.php" method="POST">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Exam Name</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Enter exam name" name="exam" required
                                                                    autocomplete="off">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Exam Duration
                                                                    (Minutes)</label>
                                                                <input type="number" class="form-control"
                                                                    placeholder="Enter exam duration" name="duration"
                                                                    required autocomplete="off">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Total mark </label>
                                                                <input type="number" class="form-control"
                                                                    placeholder="Enter total mark" name="t_mark"
                                                                    required autocomplete="off">
                                                            </div>

                                                            <div class="form-group" style = "display : table;">
                                                            <div style = "display : table-cell; margin-left : 5px; padding-left : 5px;">
                                                                <label for="exampleInputEmail1">Total question </label>
                                                                <input type="number" class="form-control"
                                                                    placeholder="Enter no of question" name="t_question" style = "  width : 100%;"
                                                                    required autocomplete="off">
                                                                    </div>
                                                                    <div style = "display : table-cell; margin-left : 5px; padding-left : 5px;">
                                                                    <label for="exampleInputEmail1">Easy </label>
                                                                <input type="number" class="form-control" style = " width : 100%;"
                                                                    placeholder="Enter no of question" name="t_easy"
                                                                    required autocomplete="off">
                                                                    </div>
                                                                    <div style = "display : table-cell; margin-left : 5px; padding-left : 5px;">
                                                                    <label for="exampleInputEmail1">Medium </label>

                                                                <input type="number" class="form-control" style = "width : 100%;"
                                                                    placeholder="Enter no of question" name="t_medium"
                                                                    required autocomplete="off">
                                                                    </div>
                                                                    <div style = "display : table-cell; margin-left : 5px; padding-left : 5px;">
                                                                    <label for="exampleInputEmail1">Hard </label>
                                                                <input type="number" class="form-control" style = "width : 100%;"
                                                                    placeholder="Enter no of question" name="t_hard"
                                                                    required autocomplete="off">
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Pass Percentage(%)
                                                                </label>
                                                                <input type="number" class="form-control"
                                                                    placeholder="Enter the percentage" name="passmark"
                                                                    required autocomplete="off">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Select
                                                                    department</label>
                                                                <select class="form-control" name="department" required>
                                                                    <option value="" selected disabled>-Select
                                                                        department-</option>
                                                                    <?php
                                                                    include '../database/config.php';
                                                                    $sql = "SELECT * FROM tbl_departments WHERE status = 'Active' ORDER BY name";
                                                                    $result = $conn->query($sql);
                                                                    if ($result->num_rows > 0) {
                                                                        while($row = $result->fetch_assoc()) {
                                                                            print '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                                                        }
                                                                    } else {
                                                        
                                                                    }
                                                                    $conn->close();
                                                                    ?>

                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Select Subject</label>
                                                                <select class="form-control" name="category" required>
                                                                    <option value="" selected disabled>-Select subject-
                                                                    </option>
                                                                    <?php
                                                                    include '../database/config.php';
                                                                    $sql = "SELECT * FROM tbl_categories WHERE status = 'Active' ORDER BY name";
                                                                    $result = $conn->query($sql);
                                                                    if ($result->num_rows > 0) {
                                                                        while($row = $result->fetch_assoc()) {
                                                                            print '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                                                        }
                                                                    } else {
                                                        
                                                                    }
                                                                    $conn->close();
                                                                ?>

                                                                </select>
                                                            </div>
                                                            <!-- <div class="form-group"><label>Select Layout </label><br>
                                                                <label for="ran">Random Questions</label>
                                                                <input type="checkbox" class="form-control" name="ran" autocomplete="off">
                                                                <label for="shufq">Shuffle Questions</label>
                                                                <input type="checkbox" class="form-control" name="shufq" autocomplete="off">
                                                                <label for="shufa">Shuffle Answers</label>
                                                                <input type="checkbox" class="form-control" name="shufa" autocomplete="off">
                                                            </div> -->

                                                            <button id="add_QB" type="submit" class="btn btn-primary">Submit</button>
                                                        </form>

                                                            <!-- <form action="pages/add_exam.php" method="POST">
                       		<div class="form-group">
                                    <label for="exampleInputEmail1">Exam Name</label>
                                    <input type="text" class="form-control" placeholder="Enter exam name" name="exam" required autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Exam Duration (Minutes)</label>
                                    <input type="number" class="form-control" placeholder="Enter exam duration" name="duration" required autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Total mark </label>
                                    <input type="number" class="form-control" placeholder="Enter total mark" name="t_mark" required autocomplete="off">
                                </div>
                                 
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Total question </label>
                                    <input type="number" class="form-control" placeholder="Enter no of question" name="t_question" required autocomplete="off">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Pass Percentage(%) </label>
                                    <input type="number" class="form-control" placeholder="Enter the percentage" name="passmark" required autocomplete="off">
                                </div>
                               
				<div class="form-group">
                                    <label for="exampleInputEmail1">Select department</label>
                                    <select class="form-control" name="department" required>
                                    <option value="" selected disabled>-Select department-</option>
                                    <?php
                                    include '../database/config.php';
                                    $sql = "SELECT * FROM tbl_departments WHERE status = 'Active' ORDER BY name";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            print '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                        }
                                    } else {
                          
                                    }
                                    $conn->close();
                                    ?>
											
				    												</select>
                                </div>
										
				<div class="form-group">
                                    <label for="exampleInputEmail1">Select Subject</label>
                                    <select class="form-control" name="category" required>
                            	    <option value="" selected disabled>-Select subject-</option>
                                    <?php
                                    include '../database/config.php';
                                    $sql = "SELECT * FROM tbl_categories WHERE status = 'Active' ORDER BY name";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            print '<option value="'.$row['name'].'">'.$row['name'].'</option>';
                                        }
                                    } else {
                          
                                    }
                                    $conn->close();
				    ?>
											
                                    </select>
                                </div>
									
									
				<div class="form-group">
                                    <label for="exampleInputEmail1">Terms and conditions</label>
                                    <textarea style="resize: none;" rows="6" class="form-control" placeholder="Enter Terms and conditions" name="instructions" required autocomplete="off"></textarea>
                                    </div>


                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                                </div> -->

                                                            <!--                              Adding topic/subject  -->
                                                            <!-- <div role="tabpanel" class="tab-pane fade" id="tab7">
                            	<form action="pages/add_topic.php" method="POST">   
                            	<label for="exampleInputEmail1">Select Examination(SHOULD BE ADDED BY TEST COORDINATORS)</label>
                                    <select class="form-control" name="exam" required>
                                    <option value="" selected disabled>Select examination(SHOULD BE ADDED BY TEST COORDINATORS)</option>
                                    <?php
                                    include '../database/config.php';
                                    $sql = "SELECT * FROM tbl_examinations WHERE status = 'Active' ORDER BY exam_name";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            print '<option value="'.$row['exam_id'].'">'.$row['exam_name'].'</option>';
                                        }
                                    } else {
                          
                                    }
                                    $conn->close();
                                    ?>
											
				    												</select>
                           					<div class="form-group">
                                    <label for="exampleInputEmail1">Enter the topic/subject</label>
                                    <input type="text" class="form-control" placeholder="Enter topic/subject" name="t_name" required autocomplete="off">
                                	</div>
                                	<div class="form-group">
                                    <label for="exampleInputEmail1">Enter Number of Questions(ALLOTTED)</label>
                                    <input type="number" class="form-control" placeholder="Enter num Questions" name="num_q" required autocomplete="off" min="0">
                                	</div>
                                	<button type="submit" class="btn btn-primary" name="topic">Submit</button>
                                	</form>
                            </div> -->


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- <div class="jumbotron">
                                    <a href="addexams.php"><button class="" type="button">Add New Exam</button></a>
                                </div> -->
                            </div>
                        </div>
                    </div>

                </div>
    </main>
    <?php if ($ms == "1") {
?> <div class="alert alert-success" id="snackbar"><?php echo "$description"; ?></div> <?php	
}else{
	
}
?>

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
    <script src="../assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
    <script src="../assets/plugins/moment/moment.js"></script>
    <script src="../assets/plugins/datatables/js/jquery.datatables.min.js"></script>
    <script src="../assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
    <script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="../assets/js/modern.min.js"></script>
    <script src="../assets/js/pages/table-data.js"></script>
    <script src="../assets/plugins/select2/js/select2.min.js"></script>
    <script src="../assets/plugins/summernote-master/summernote.min.js"></script>
    <script src="../assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script src="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="../assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="../assets/js/pages/form-elements.js"></script>


    <script>
    function myFunction() {
        var x = document.getElementById("snackbar")
        x.className = "show";
        setTimeout(function() {
            x.className = x.className.replace("show", "");
        }, 3000);
    }
    </script>
</body>

</html>