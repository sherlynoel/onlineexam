<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';

if (isset($_GET['eid'])) {
    include '../database/config.php';
    $exam_id = mysqli_real_escape_string($conn, $_GET['eid']);	
    $topic = 1;

    $sql = "SELECT * FROM tbl_examinations WHERE exam_id = '$exam_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $exam_name =$row['exam_name'];
            $duration =$row['duration'];
            $passmark =$row['passmark'];
            $t_mark =$row['t_mark'];
            $t_question =$row['t_question'];
            $t_easy =$row['t_easy'];
            $t_medium =$row['t_medium'];
            $t_hard =$row['t_hard'];
            $subject = $row['category'];
        }
        if(isset($_GET['submit'])){
            $topic = $_GET['topics'];
        }

    } else {
        header("location:./");	
    }

}

else {
header("location:./");	
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>GATE | View Exam</title>

    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta charset="UTF-8">
    <meta name="description" content="Online Examination System" />
    <meta name="keywords" content="Online Examination System" />
    <meta name="author" content="Bwire Charles Mashauri" />

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

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
                <span><?php echo "$myfname"; ?> <?php echo "$mylname"; ?></span></div>
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
                                <span><?php echo "$myfname"; ?> <?php echo "$mylname"; ?><br></span>
                            </div>
                        </a>
                    </div>
                </div>
                <ul class="menu accordion-menu">
                <li class="active"><a href="./" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
                        <!-- <li><a href="departments.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-folder-open"></span><p>Departments</p></a></li> -->
                        

                        <li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
                        <li><a href="categories.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-tags"></span><p>Subject</p></a></li>
                        <li><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
                        <!-- <li><a href="questions.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-question-sign"></span><p>Questions</p></a></li> -->
                        <!-- <li><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>Notice</p></a></li> -->
                        <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>


                </ul>
            </div>
        </div>
        <div class="page-inner">
            <div class="page-title">
                <h3>Send Exam Invites</h3>
                <div class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li><a href="./">Home</a></li>
                        <li><a href="examinations.php">Examinations</a></li>
                        <li class="active"><?php echo "$exam_name"; ?></li>
                    </ol>
                </div>
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

                                                <li role="presentation" class="active"><a href="#tab6" role="tab"
                                                        data-toggle="tab">Manage Question Banks</a></li>
                                                <li role="presentation" ><a href="#tab5" role="tab"
                                                        data-toggle="tab">Send Invitations</a></li>
                                                <li role="presentation"><a href="#editexam" role="tab"
                                                        data-toggle="tab">Edit Exam Details</a></li>

                                            </ul>

                                            <div class="tab-content">

                                                <div role="tabpanel" class="tab-pane fade in" id="tab5">
                                                    <div class="table-responsive">
                                                        <?php
                                                    include '../database/config.php';
                                                    $sql = "SELECT * FROM tbl_users WHERE role = 'student'";
                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                    print '
                                                    <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Name</th>
                                                                <th>Semester-section</th>
                                                                <th>Gender</th>
                                                                <th>Status</th>
                                                                <th>Course</th>
                                                                <th>Department</th>
                                                                
                                                            </tr>
                                                        </thead>
                                                    <tbody>';
                                                    $counter = 0;
                                                    while($row = $result->fetch_assoc()) {
                                                        $counter+=1;
                                                    $status = $row['acc_stat'];
                                                    if ($status == "1") {
                                                    $st = '<p class="text-success">ACTIVE</p>';
                                                    $stl = '<a href="pages/make_sd_in.php?id='.$row['user_id'].'">Make Inactive</a>';
                                                    }else{
                                                    $st = '<p class="text-danger">INACTIVE</p>'; 
                                                    $stl = '<a href="pages/make_sd_ac.php?id='.$row['user_id'].'">Make Active</a>';											   
                                                    }
                                                    print '
                                                    <tr>
                                                    <td>
                                                    <input type="checkbox" name="sno_'.$counter.'" value="'.$row['email'].'"></td>
                                                    <td>'.$row['first_name'].' '.$row['last_name'].'</td>
                                                    <td>'.$row['sem_sec'].'</td>
                                                    <td>'.$row['gender'].'</td>
                                                    <td>'.$st.'</td>
                                                    <td>'.$row['course'].'</td>
                                                    <td>'.$row['department'].'</td>
                                                    
                                                   
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
                                                    <hr>
                                                    <textarea rows="4" cols="75" id="em_msg" placeholder="Enter Email content"></textarea>
                                                    <hr>
                                                    <button type="submit" onclick="getEmail();" class="btn btn-primary">Send Invites</button>


                                                </div>
                                                

                                                <script type="text/javascript">
                                                    function getEmail() {
                                                        var emails = []
                                                        var checkboxes = document.querySelectorAll(
                                                            'input[type=checkbox]:checked')

                                                        for (var i = 0; i < checkboxes.length; i++) {
                                                            emails.push(checkboxes[i].value)
                                                        }
                                                        var content = document.getElementById("em_msg").value;
                                                        
                                                        if(emails.length == 0){
                                                            alert("No checkbox is selected");
                                                        }
                                                        else if(content.length == 0){
                                                            alert("Email content message is left empty");
                                                        }
                                                        else{
                                                        
                                                        $(document).ready(function () {
                                                            $('<form action="./exam_invite_mailer.php" method="post"><input name="exam_id" value ="<?php echo "$exam_id"?>"><input name="content" value ="'+content.toString()+'"><input name="emails" value ="' +emails.toString() + '"></form>').appendTo(
                                                                'body').submit();
                                                        });
                                                        }
                                                    }

                                                    function checkAll(ele) {
                                                        var checkboxes = document.getElementsByTagName('input');

                                                        if (ele.checked) {

                                                            for (var i = 0; i < checkboxes.length; i++) {
                                                                if (checkboxes[i].type == 'checkbox') {

                                                                    checkboxes[i].checked = ele.checked;
                                                                    $('.checker').find('span').addClass('checked');
                                                                    $('.checkbox').prop('checked', true);
                                                                }
                                                            }
                                                        } else {
                                                            for (var i = 0; i < checkboxes.length; i++) {

                                                                if (checkboxes[i].type == 'checkbox') {
                                                                    checkboxes[i].checked = false;
                                                                    $('.checker').find('span').removeClass('checked');
                                                                    $('.checkbox').prop('checked', false);
                                                                }
                                                            }
                                                        }
                                                    }
                                                </script>

                                                <script type="text/javascript">
                                                    $(document).ready(function () {

                                                        $('#example thead tr').clone(true).appendTo(
                                                            '#example thead');
                                                        $('#example thead tr:eq(1) th').each(function (i) {
                                                            var title = $(this).text();
                                                            if (title != '' && title != 'Gender' &&
                                                                title != 'Status') {
                                                                $(this).html(
                                                                    '<input type="text" placeholder="Search ' +
                                                                    title + '" />');

                                                                $('input', this).on('keyup change',
                                                                    function () {
                                                                        if (table.column(i)
                                                                        .search() !== this.value) {
                                                                            table
                                                                                .column(i)
                                                                                .search(this.value)
                                                                                .draw();
                                                                        }
                                                                    });
                                                            } else {
                                                                $(this).html(' ');

                                                            }
                                                            if (title == '') {
                                                                $(this).html(
                                                                    '<input type="checkbox" onchange="checkAll(this);" name="chkbox"  >'
                                                                    );
                                                            }
                                                        });


                                                        var table = $('#example').DataTable({
                                                            orderCellsTop: true,
                                                            fixedHeader: true,
                                                            "paging": false,

                                                            "bDestroy": true,
                                                            "destroy": true,
                                                        });
                                                    });
                                                </script>

                                                <div role="tabpanel" class="tab-pane active fade in" id="tab6">
                                                    <div class="table-responsive">
                                                        <?php
                                                        include 'includes/get_user_cred.php';
                                                        include '../database/config.php';

                                                        // $mydepartment = "SELECT * FROM tbl_users WHERE user_id ='$myid'";
                                                        // $mydepartment= $conn->query($mydepartment);
                                                        // $list = $result->fetch_assoc();
                                                        // $mydepartment = $list['department'];
                                                        $myq = "SELECT * FROM tbl_users WHERE user_id ='$myid'";
                                                        $sql = "SELECT * 
                                                        FROM tbl_qb 
                                                        WHERE visibility='All'
                                                        UNION
                                                        SELECT * 
                                                        FROM tbl_qb 
                                                        WHERE visibility='Department' AND department='$mydepartment'
                                                        UNION
                                                        SELECT * 
                                                        FROM tbl_qb 
                                                        WHERE visibility='Me' AND user_id ='".$myid."'";

                                                        $result = $conn->query($sql);

                                                        // <tr><td>'.$sql.'</td></tr>
                                                        if ($result->num_rows > 0) {
                                                        print '
                                                        <table id="example1" class="display table" style="width: 100%; cellspacing: 0;">
                                                        <thead>

                                                        <tr>
                                                        <th>QB Name</th>
                                                        <th>Department</th>
                                                        <th>Subject</th>
                                                        <th>Number of Questions</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tfoot>
                                                        <tr>
                                                        <th>QB Name</th>
                                                        <th>Department</th>
                                                        <th>Subject</th>
                                                        <th>No of Questions</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                        </tr>
                                                        </tfoot>
                                                        <tbody>';



                                                        while($row = $result->fetch_assoc()) {

                                                            $sub_sql = "SELECT * from tbl_questions WHERE qb_id ='".$row['qb_id']."'";
                                                            $no_of_questions=$conn->query($sub_sql)->num_rows;

                                                            $stat = "";

                                                            $existing_questions = "SELECT * from tbl_exam_qb WHERE qb_id ='".$row['qb_id']."' AND exam_id = '".$exam_id."'";
                                                            if($conn->query($existing_questions)->num_rows>0)
                                                            {
                                                                $stat = '<p class="text-success">ADDED</p>';
                                                            }
                                                            else{
                                                                $stat = '<p class="text-danger">NOT ADDED</p>';
                                                            }

                                                            

                                                            
                                                            print '
                                                            <tr>
                                                            <td>'.$row['qb_name'].'</td>
                                                            <td>'.$row['department'].'</td>
                                                            <td>'.$row['subject'].'</td>
                                                            <td>'.$no_of_questions.'</td>
                                                            <td>'.$stat.'</td>
                                                            <td><div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            Select Action
                                                            <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                            <li><a href="pages/add_qb.php?e_id='.$exam_id.'&qb_id='.$row['qb_id'].'">Add Exam</a></li>
                                                            <li><a href="pages/drop_qb.php?e_id='.$exam_id.'&qb_id='.$row['qb_id'].'">Drop Exam</a></li>
                                                            </ul>
                                                            </div></td>
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

                                                <div role="tabpanel" class="tab-pane fade" id="editexam">
                                                
                                                    <form action="pages/update_exam.php" method="POST">
                                                    <div class="form-group">
                                                            <label for="exampleInputEmail1">Exam Name</label>
                                                            <input type="text" class="form-control" value="<?php echo"$exam_name"; ?>" placeholder="Enter exam name" name="exam" required autocomplete="off">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Exam Duration (Minutes)</label>
                                                            <input type="number" class="form-control" value="<?php echo"$duration"; ?>" placeholder="Enter exam duration" name="duration" required autocomplete="off">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Pass Percentage </label>
                                                            <input type="number" class="form-control" value="<?php echo"$passmark"; ?>" placeholder="Enter passmark" name="passmark" required autocomplete="off">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Total marks </label>
                                                            <input type="number" class="form-control" value="<?php echo"$t_mark"; ?>" placeholder="Enter passmark" name="t_mark" required autocomplete="off">
                                                        </div>
                                                        <div class="form-group" style = "display : table;">
                                                            <div style = "display : table-cell; margin-left : 5px; padding-left : 5px;">
                                                                <label for="exampleInputEmail1">Total question </label>
                                                                <input type="number" class="form-control" value="<?php echo"$t_question"; ?>"
                                                                    placeholder="Enter no of question" name="t_question" style = "  width : 100%;"
                                                                    required autocomplete="off">
                                                                    </div>
                                                                    <div style = "display : table-cell; margin-left : 5px; padding-left : 5px;">
                                                                    <label for="exampleInputEmail1">Easy </label>
                                                                <input type="number" class="form-control" style = " width : 100%;" value="<?php echo"$t_easy"; ?>"
                                                                    placeholder="Enter no of question" name="t_easy"
                                                                    required autocomplete="off">
                                                                    </div>
                                                                    <div style = "display : table-cell; margin-left : 5px; padding-left : 5px;">
                                                                    <label for="exampleInputEmail1">Medium </label>

                                                                <input type="number" class="form-control" style = "width : 100%;" value="<?php echo"$t_medium"; ?>"
                                                                    placeholder="Enter no of question" name="t_medium"
                                                                    required autocomplete="off">
                                                                    </div>
                                                                    <div style = "display : table-cell; margin-left : 5px; padding-left : 5px;">
                                                                    <label for="exampleInputEmail1">Hard </label>
                                                                <input type="number" class="form-control" style = "width : 100%;" value="<?php echo"$t_hard"; ?>"
                                                                    placeholder="Enter no of question" name="t_hard"
                                                                    required autocomplete="off">
                                                                    </div>
                                                            </div>
                <!--
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">percentage(%)</label>
                                                            <input type="number" class="form-control" value="" placeholder="Enter percentage" name="pre" required autocomplete="off">
                                                        </div>
                -->
                                                        
                                                        
                                                        
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Select Subjects</label>
                                                            <select class="form-control" name="category" required>
                                                            <option value=""  disabled>-Select Subjects-</option>
                                                            <?php
                                                            include '../database/config.php';
                                                            $sql = "SELECT * FROM tbl_categories WHERE status = 'Active' ORDER BY name";
                                                            $result = $conn->query($sql);

                                                            if ($result->num_rows > 0) {
                    
                                                            while($row = $result->fetch_assoc()) {
                                                            if ($subject == $row['name']) {
                                                            print '<option  value="'.$row['name'].'" selected >'.$row['name'].'</option>';	
                                                            }else{
                                                            print '<option value="'.$row['name'].'">'.$row['name'].'</option>';	
                                                            }
                                                            }
                                                        } else {
                                        
                                                            }
                                                            $conn->close();
                                                            ?>
                                                            
                                                            </select>
                                                        </div>
                                                    
                                                    
                                                    <div class="form-group">
                                                            <label for="exampleInputEmail1">Terms and conditions</label>
                                                            <textarea style="resize: none;" rows="6" class="form-control" placeholder="Enter Terms and conditions" name="instructions" required autocomplete="off"><?php echo"$exterms"; ?></textarea>
                                                    </div>
                                                    <input type="hidden" name="examid" value="<?php echo "$exam_id"; ?>">


                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
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
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);
        }
    </script>
</body>

</html>