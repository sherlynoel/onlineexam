<?php
//extracting necessary documents
				date_default_timezone_set('Africa/Dar_es_salaam');
				include 'includes/check_user.php';
				include 'includes/check_reply.php';
				include 'includes/fetch_records';
				include '../includes/uniques.php';
				

			//getting details of exam
				if (isset($_SESSION['current_examid'])) {
					include '../database/config.php';
					$exam_id = $_SESSION['current_examid'];
					$retake_status = $_SESSION['student_retake'];

					$sql = "SELECT * FROM tbl_examinations WHERE exam_id = '$exam_id'  AND status = 'Active'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {

						while($row = $result->fetch_assoc()) {
							$exam_name =$row['exam_name'];
							$subject = $row['subject'];
							//$deadline = $row['date'];
							$duration = $row['duration'];
							$passmark = $row['passmark'];
							$t_mark = $row['t_mark'];
							$pre = $row['pret'];
							$t_question = $row['t_question'];
							$t_easy = $row['t_easy'];
							$t_medium = $row['t_medium'];
							
							$t_hard = $row['t_hard'];
							$reexam = $row['re_exam'];
							$terms = $row['terms'];
							$status = $row['status'];
						//$today_date = date('Y/m/d');
						//$next_retake = date('m/d/Y', strtotime($today_date. ' + '.$reexam.' days'));

						//$today_date = date('m/d/Y');
						}
					} else {
					header("location:./");
					}
				}else{
				header("location:./");
				}

				$sql = "SELECT * FROM tbl_users WHERE user_id = '$myid'";
				$result = $conn->query($sql);

			if ($result->num_rows > 0) {

			while($row = $result->fetch_assoc()) {

			$mysem = $row['sem_sec'];
			$usn = $row['usn'];
			$batch = $row['batch'];
			$course = $row['course'];
			$department = $row['department'];
			$email = $row['email'];

			}
			}else {
			header("location:./");
			}

			$sql = "SELECT * FROM tbl_assessment_records WHERE student_id = '$myid'";
			$result = $conn->query($sql);
			
			

//			if ($result->num_rows > 0 ) {
//
//			    
//			       header("location:./take-assessment.php?id=$exam_id");
//			} else {
			$myname = "$myfname $mylname";
			$recid = 'RS-'.mt_rand(100000,999999).'';
			// record_id 	student_id 	student_name 	sem_sec 	usn 	exam_name 	exam_id 	score 	status 	c_ans 	f_ans 	skipped
			//echo "<br>".$recid."<br>".$myid."<br>".$myname."<br>".$mysem."<br>".$usn."<br>".$exam_name."<br>".$exam_id;
			//$sql = "INSERT INTO tbl_assessment_records (record_id, student_id, student_name, sem_sec, usn, exam_name, exam_id)
			//VALUES ('$recid', '$myid', '$myname', '$mysem', '$usn', '$exam_name', '$exam_id')";

			// $sql = "INSERT INTO tbl_assessment_records (record_id, student_id, student_name,sem_sec, usn, exam_name, exam_id, score, status, c_ans, f_ans, skipped, total_question) VALUES ('$recid', '$myid', '$myname', '$mysem', '$usn', '$exam_name', '$exam_id', '0', 'FAIL', '0', '0', '0', '$t_question')";
			$sql = "INSERT INTO tbl_assessment_records (record_id, student_id, student_name,sem_sec, batch, course, department, usn, email, exam_name, exam_id, score, exam_status, c_ans, f_ans, skipped, total_question) VALUES ('$recid', '$myid', '$myname', '$mysem', '$batch', '$course', '$department', '$usn', '$email', '$exam_name', '$exam_id', '0', 'FAIL', '0', '0', '0', '$t_question')";
			if ($conn->query($sql) === TRUE) {?>

			
<!DOCTYPE html>
<html>

<head>


<title>OES | Examination</title>

<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta charset="UTF-8">
<meta name="description" content="Online Examination System" />
<meta name="keywords" content="Online Examination System" />
<meta name="author" content="Bwire Charles Mashauri" />
<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'> -->
<link href="../assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
<!-- <link href="../assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/> -->
<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
<link href="../assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
<link href="../assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
<link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
<link href="../assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
<link href="../assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>
<link href="../assets/images/icon.png" rel="icon">
<!--<link href="../assets/css/modern.min.css" rel="stylesheet" type="text/css"/>-->
<link href="../assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
<link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/modern.css" rel="stylesheet" type="text/css"/>
<link href="../assets/css/snack.css" rel="stylesheet" type="text/css"/>
<script src="../assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
<script src="../assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>


<style>
table {
border-collapse: separate;
border-spacing: 1em; 
background-color: #ccc ;
border-radius: 5px ;
}
td{
background-color: white ;
border-radius: 3px  ;
}

input[type="radio"]{
margin-left: -5px !important;
width: 1.1em;
height: 1.1em;
margin-right: 5px!important;
}
.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th, .table td {
    padding: 0px!important;
}
	button{
		
	}



</style>

</head>
<body <?php if ($ms == "1") { print 'onload="myFunction()"'; } ?>   class="page-header-fixed page-horizontal-bar" >
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

<main class="page-content content-wrap container">
	<div class="navbar">
		<div class="navbar-inner">
			<div class="sidebar-pusher">
				<a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
				<i class="fa fa-bars"></i>
			</a>

			</div>
			<div class="logo-box">
				<a class="logo-text"><span><div id="quiz-time-left"></div></span></a>
			</div>

			<div class="topmenu-outer">
				<div class="top-menu">
				<ul class="nav navbar-nav navbar-left">
				</ul>
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
	<div class="horizontal-bar sidebar">
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
<span><?php echo "$myfname"; ?> <?php echo "$mylname"; ?><br><small>OES Student</small></span>
</div>
</a>
</div>
</div>

</div>

	</div>
  <div class="page-inner" >
<div class="page-title " style = "height : 110px;" >
<aside class="alert alert-danger" style = " border-width : 2px; width : 30%; height : 80px;float:right; margin-right : 2%;"><p   >DO NOT REFRESH THIS PAGE,Clicking on Back and Forward button is strictly prohibited. If you do so,you exam gets auto submitted.</p></aside>
<aside class="alert alert-success" style = " border-width : 2px; width : 30%; height : 80px; float:right; margin-right : 2%;"><p   >The test auto submits so don't worry when time expires</p></aside>
<h3>Examination</h3>
<div class="page-breadcrumb">
<ol class="breadcrumb">
<li><a href="./">Home</a></li>
<li><a href="examinations.php">Examinations</a></li>
<li class="active"><?php echo "$exam_name"; ?></li> 
</ol>
<h3> </h3>

</div>
</div>

<div id="main-wrapper" style="margin-top:0!important">
<div class="row">
<div class="panel panel-white">
<div class="panel-body">
<div class="tabs-below" role="tabpanel" style=" width:75% ;float:left ;">
<form action="pages/submit_assessment.php" method="POST" name="quiz" id="quiz_form" >
<div class="tab-content">
<?php 
include '../database/config.php';


$sq = "SELECT t_question from tbl_examinations where exam_id = '$exam_id'";
$res = $conn->query($sq);
// $numTopic = 0;
if($res){
$val = $res->fetch_assoc();
$num = $val['t_question'];
}

// $sql = "SELECT * FROM tbl_topic WHERE exam_id = '$exam_id'";

// $result = $conn->query($sql);

// if($result){
// 	$numTopic = mysqli_num_rows($result);
// 	$topics = array();
// 	$top_que = array();
// 	$i = 0;
// 	while($row = mysqli_fetch_assoc($result)){
// 		$topics[$i] =  $row['topic'];
// 		$top_que[$i] = $row['num_q'];
// 		$i++;
// 	}
// }


$sql = "SELECT * FROM  tbl_exam_qb A, tbl_questions B WHERE A.qb_id  = B.qb_id AND A.exam_id = '$exam_id'  ORDER BY RAND() ";

// $sq = "SELECT * FROM (SELECT * FROM  tbl_exam_qb A, tbl_questions B WHERE A.qb_id  = B.qb_id AND A.exam_id = '$exam_id') $char ";


//$sql = "SELECT * FROM (SELECT * FROM  (SELECT * FROM ($sq) $char WHERE positive_mark = 1 ORDER BY RAND() LIMIT 15) z UNION SELECT * FROM (SELECT * FROM ($sq) $char WHERE positive_mark = 2 ORDER BY RAND() LIMIT 10) x UNION SELECT * FROM (SELECT * FROM ($sq) $char WHERE positive_mark = 5 ORDER BY RAND() LIMIT 3) y) z ORDER BY RAND()";																			
																				
//$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id' ORDER BY RAND() LIMIT $num";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
$qno = 1;
while($row = $result->fetch_assoc()) {
	if($qno <= $t_question){
		
$qsid = $row['question_id'];
$qs = $row['question'];

$type = $row['type'];
$difficulty = $row['difficulty'];
// $topic = $row['topic'];
$op1 = $row['option1'];
$op2 = $row['option2'];
$op3 = $row['option3'];
$op4 = $row['option4'];
$imgs = $row['img'];
$posmarks = $row['positive_mark'];
$neg = $row['negative_mark'];
$ans = $row['answer'];
$enan = $row[$ans];
$cc = $row[0];
if($difficulty == "easy" && $t_easy >0){
if ($type == "FB") {
if ($qno == "1") {
	
print '
<div role="tabpanel" class="tab-pane active fade in" id="tab'.$qno.'">
			<p><span style="font-size: 10pt;white-space:pre">Marks: '.(htmlentities($posmarks)).'<span></p>
			
			<p style="overflow: auto"><span style="font-size: 15pt;white-space:pre"><b>Question No: '.$qno.'<br><br></b> '.(htmlentities($qs)).'<span></p>
            ';
              if( $imgs == NULL){ }else{
              print '<center><img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" style="top:0px;width:300px;height:300px"/></center>';
            }

print '
<p><input type="text" name="an'.$qno.'" onkeypress="mycolorss(demo'.$qno.')" class="form-control" placeholder="Enter your answer" autocomplete="off"></p>
<p><a role="tab"  href="#tab'.($qno-1).'"  onclick="check(demo'.($qno-1).')" data-toggle="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;"><i class="fa fa-long-arrow-left m-r-5" aria-hidden="true"></i>  Prev</a>
<a role="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;" href="#tab'.($qno+1).'"  onclick="check(demo'.($qno+1).')" data-toggle="tab"> Next  <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></a></p>

<input type="hidden" name="pos'.$qno.'" value="'.base64_encode($posmarks).'">
<input type="hidden" name="neg'.$qno.'" value="'.base64_encode($neg).'">
<input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
<input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
<input type="hidden" name="qqid'.$qno.'" value="'.base64_encode($qsid).'">
</div>
';	
}else{
print '
<div role="tabpanel" class="tab-pane fade in" id="tab'.$qno.'">

<p><span style="font-size: 10pt;white-space:pre">Marks: '.(htmlentities($posmarks)).'<span></p>

<p style="overflow :auto"><span style="font-size: 15pt;overflow :auto;white-space:pre"><b>Question No: '.$qno.'<br><br></b> '.(htmlentities($qs)).'</span></p>
             ';
              if( $imgs == NULL){ }else{
              print '<center><img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" style="top:0px;width:300px;height:300px"/></center>';
              
            }
print '
<p><input type="text" name="an'.$qno.'" onkeypress="mycolorss(demo'.$qno.')"  class="form-control" placeholder="Enter your answer" autocomplete="off"></p>
<p><a role="tab"  href="#tab'.($qno-1).'"  onclick="check(demo'.($qno-1).')" data-toggle="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;"><i class="fa fa-long-arrow-left m-r-5" aria-hidden="true"></i>  Prev</a>
<a role="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;" href="#tab'.($qno+1).'"  onclick="check(demo'.($qno+1).')" data-toggle="tab"> Next  <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></a></p>

<input type="hidden" name="pos'.$qno.'" value="'.base64_encode($posmarks).'">
<input type="hidden" name="neg'.$qno.'" value="'.base64_encode($neg).'">
<input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
<input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
<input type="hidden" name="qqid'.$qno.'" value="'.base64_encode($qsid).'">
</div>
';		
}

$qno = $qno + 1;
$t_easy = $t_easy -1;

$sql = "INSERT INTO tbl_report (user_id, exam_id, q_id,type, question, img, difficulty, option1, option2, option3, option4, positive_mark, negative_mark, answer, response, status, marks) VALUES ('$myid ', '$exam_id', '$qsid', '$type', '$qs', '$imgs', '$difficulty', '$op1','$op2','$op3','$op4', '$posmarks', '$neg', '$ans', '-', '-','-')";
$conn->query($sql);
}else{

if ($qno == "1") {
$van = "tab'.$qno.'";
print '

<div role="tabpanel" class="amount_list active fade in" id="tab'.$qno.'">

<p><span style="font-size: 10pt;white-space:pre">Marks: '.(htmlentities($posmarks)).'<span></p>

<p style="overflow :auto"><span style="font-size:15pt;overflow :auto; white-space:pre"><b>Question No: '.$qno.'<br><br></b> '.(htmlentities($qs)).'</span></p>
<br>
';
if( $imgs == NULL){ }else{
print '<center><img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" style="top:0px;"/></center>';

}

if(htmlentities($op1)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op1.'" class="form-control" value="'.$op1.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op1.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op1).'</span></label></p>
';
if(htmlentities($op2)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op2.'" class="form-control" value="'.$op2.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op2.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op2).'</span></label></p>
';

if(htmlentities($op3)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op3.'" class="form-control" value="'.$op3.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op3.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op3).'</span></label></p>
';

if(htmlentities($op4)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op4.'" class="form-control" value="'.$op4.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op4.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op4).'</span></label></p>
';

print '
<p><a role="tab"  href="#tab'.($qno-1).'"  onclick="check(demo'.($qno-1).')" data-toggle="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;"><i class="fa fa-long-arrow-left m-r-5" aria-hidden="true"></i>  Prev</a>
<input type="button" style = "margin-left : 20px;" class = "btn btn-danger" value="Clear" onclick="Clear('.$qno.')">
<a role="tab" style="margin-left : 20px; padding:10px;color:white;background-color:#22baa0; text-decoration:none ;" href="#tab'.($qno+1).'"  onclick="check(demo'.($qno+1).')" data-toggle="tab"> Next  <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></a></p>



<input type="hidden" name="pos'.$qno.'" value="'.base64_encode($posmarks).'">
<input type="hidden" name="neg'.$qno.'" value="'.base64_encode($neg).'">
<input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
<input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
<input type="hidden" name="qqid'.$qno.'" value="'.base64_encode($qsid).'">
</div>
';	
}else{
$van = "tab'.$qno.'";



print '
<div role="tabpanel" class="amount_list fade in" id="tab'.$qno.'">

<p><span style="font-size: 10pt;white-space:pre">Marks: '.(htmlentities($posmarks)).'<span></p>

<p style="overflow: auto"><span style="font-size: 15pt;overflow: auto;white-space:pre"><b>Question No: '.$qno.'<br><br></b> '.(htmlentities($qs)).'<span></p><br>
';
if( $imgs == NULL){ }else{
	
print '<center><img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" style="top:0px;"/></center>';

}



if(htmlentities($op1)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op1.'" class="form-control" value="'.$op1.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op1.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op1).'</span></label></p>
';
if(htmlentities($op2)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op2.'" class="form-control" value="'.$op2.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op2.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op2).'</span></label></p>
';

if(htmlentities($op3)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op3.'" class="form-control" value="'.$op3.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op3.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op3).'</span></label></p>
';

if(htmlentities($op4)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op4.'" class="form-control" value="'.$op4.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op4.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op4).'</span></label></p>
';

print '


<p><a role="tab"  href="#tab'.($qno-1).'"  onclick="check(demo'.($qno-1).')" data-toggle="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;"><i class="fa fa-long-arrow-left m-r-5" aria-hidden="true"></i>  Prev</a>
<input type="button" style = "margin-left : 20px;" class = "btn btn-danger" value="Clear" onclick="Clear('.$qno.')">
<a role="tab" style="margin-left : 20px; padding:10px;color:white;background-color:#22baa0; text-decoration:none ;" href="#tab'.($qno+1).'"  onclick="check(demo'.($qno+1).')" data-toggle="tab"> Next  <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></a></p>

<p></p>

<input type="hidden" name="pos'.$qno.'" value="'.base64_encode($posmarks).'">
<input type="hidden" name="neg'.$qno.'" value="'.base64_encode($neg).'">
<input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
<input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
<input type="hidden" name="qqid'.$qno.'" value="'.base64_encode($qsid).'">
</div>
';		
}

$qno = $qno + 1;
$t_easy = $t_easy -1;	

$sql = "INSERT INTO tbl_report (user_id, exam_id, q_id,type, question, img, difficulty, option1, option2, option3, option4, positive_mark, negative_mark, answer, response, status, marks) VALUES ('$myid ', '$exam_id', '$qsid', '$type', '$qs', '$imgs', '$difficulty', '$op1','$op2','$op3','$op4', '$posmarks', '$neg', '$ans', '-', '-','-')";
$conn->query($sql);
}

}
if($difficulty == "medium" && $t_medium >0){
	if ($type == "FB") {
	if ($qno == "1") {
	print '
	<div role="tabpanel" class="tab-pane active fade in" id="tab'.$qno.'">
				<p><span style="font-size: 10pt;white-space:pre">Marks: '.(htmlentities($posmarks)).'<span></p>
				
				<p style="overflow: auto"><span style="font-size: 15pt;white-space:pre"><b>Question No: '.$qno.'<br><br></b> '.(htmlentities($qs)).'<span></p>
				';
				  if( $imgs == NULL){ }else{
				  print '<center><img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" style="top:0px;width:300px;height:300px"/></center>';
				}
	
	print '
	<p><input type="text" name="an'.$qno.'" onkeypress="mycolorss(demo'.$qno.')" class="form-control" placeholder="Enter your answer" autocomplete="off"></p>
	<p><a role="tab"  href="#tab'.($qno-1).'"  onclick="check(demo'.($qno-1).')" data-toggle="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;"><i class="fa fa-long-arrow-left m-r-5" aria-hidden="true"></i>  Prev</a>
	<a role="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;" href="#tab'.($qno+1).'"  onclick="check(demo'.($qno+1).')" data-toggle="tab"> Next  <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></a></p>
	
	<input type="hidden" name="pos'.$qno.'" value="'.base64_encode($posmarks).'">
	<input type="hidden" name="neg'.$qno.'" value="'.base64_encode($neg).'">
	<input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
	<input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
	<input type="hidden" name="qqid'.$qno.'" value="'.base64_encode($qsid).'">
	</div>
	';	
	}else{
	print '
	<div role="tabpanel" class="tab-pane fade in" id="tab'.$qno.'">
	
	<p><span style="font-size: 10pt;white-space:pre">Marks: '.(htmlentities($posmarks)).'<span></p>
	
	<p style="overflow :auto"><span style="font-size: 15pt;overflow :auto;white-space:pre"><b>Question No: '.$qno.'<br><br></b> '.(htmlentities($qs)).'</span></p>
				 ';
				  if( $imgs == NULL){ }else{
				  print '<center><img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" style="top:0px;width:300px;height:300px"/></center>';
				  
				}
	print '
	<p><input type="text" name="an'.$qno.'" onkeypress="mycolorss(demo'.$qno.')"  class="form-control" placeholder="Enter your answer" autocomplete="off"></p>
	<p><a role="tab"  href="#tab'.($qno-1).'"  onclick="check(demo'.($qno-1).')" data-toggle="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;"><i class="fa fa-long-arrow-left m-r-5" aria-hidden="true"></i>  Prev</a>
	<a role="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;" href="#tab'.($qno+1).'"  onclick="check(demo'.($qno+1).')" data-toggle="tab"> Next  <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></a></p>
	
	<input type="hidden" name="pos'.$qno.'" value="'.base64_encode($posmarks).'">
	<input type="hidden" name="neg'.$qno.'" value="'.base64_encode($neg).'">
	<input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
	<input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
	<input type="hidden" name="qqid'.$qno.'" value="'.base64_encode($qsid).'">
	</div>
	';		
	}
	
	$qno = $qno + 1;
	$t_medium = $t_medium -1;
	
	$sql = "INSERT INTO tbl_report (user_id, exam_id, q_id,type, question, img, difficulty, option1, option2, option3, option4, positive_mark, negative_mark, answer, response, status, marks) VALUES ('$myid ', '$exam_id', '$qsid', '$type', '$qs', '$imgs', '$difficulty', '$op1','$op2','$op3','$op4', '$posmarks', '$neg', '$ans', '-', '-','-')";
	$conn->query($sql);
	}else{
	
	if ($qno == "1") {
	$van = "tab'.$qno.'";
	print '
	
	<div role="tabpanel" class="amount_list active fade in" id="tab'.$qno.'">
	
	<p><span style="font-size: 10pt;white-space:pre">Marks: '.(htmlentities($posmarks)).'<span></p>
	
	<p style="overflow :auto"><span style="font-size:15pt;overflow :auto; white-space:pre"><b>Question No: '.$qno.'<br><br></b> '.(htmlentities($qs)).'</span></p>
	<br>
	';
	if( $imgs == NULL){ }else{
	print '<center><img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" style="top:0px;"/></center>';
	
	}
	
	
	if(htmlentities($op1)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op1.'" class="form-control" value="'.$op1.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op1.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op1).'</span></label></p>
';
if(htmlentities($op2)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op2.'" class="form-control" value="'.$op2.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op2.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op2).'</span></label></p>
';

if(htmlentities($op3)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op3.'" class="form-control" value="'.$op3.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op3.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op3).'</span></label></p>
';

if(htmlentities($op4)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op4.'" class="form-control" value="'.$op4.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op4.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op4).'</span></label></p>
';

print '
	
	<p><a role="tab"  href="#tab'.($qno-1).'"  onclick="check(demo'.($qno-1).')" data-toggle="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;"><i class="fa fa-long-arrow-left m-r-5" aria-hidden="true"></i>  Prev</a>
	<input type="button" style = "margin-left : 20px;" class = "btn btn-danger" value="Clear" onclick="Clear('.$qno.')">
	<a role="tab" style="margin-left : 20px; padding:10px;color:white;background-color:#22baa0; text-decoration:none ;" href="#tab'.($qno+1).'"  onclick="check(demo'.($qno+1).')" data-toggle="tab"> Next  <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></a></p>
	
	
	
	<input type="hidden" name="pos'.$qno.'" value="'.base64_encode($posmarks).'">
	<input type="hidden" name="neg'.$qno.'" value="'.base64_encode($neg).'">
	<input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
	<input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
	<input type="hidden" name="qqid'.$qno.'" value="'.base64_encode($qsid).'">
	</div>
	';	
	}else{
	$van = "tab'.$qno.'";
	
	
	
	print '
	<div role="tabpanel" class="amount_list fade in" id="tab'.$qno.'">
	
	<p><span style="font-size: 10pt;white-space:pre">Marks: '.(htmlentities($posmarks)).'<span></p>
	
	<p style="overflow: auto"><span style="font-size: 15pt;overflow: auto;white-space:pre"><b>Question No: '.$qno.'<br><br></b> '.(htmlentities($qs)).'<span></p><br>
	';
	if( $imgs == NULL){ }else{
		
	print '<center><img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" style="top:0px;"/></center>';
	
	}
	
	
	
	if(htmlentities($op1)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op1.'" class="form-control" value="'.$op1.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op1.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op1).'</span></label></p>
';
if(htmlentities($op2)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op2.'" class="form-control" value="'.$op2.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op2.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op2).'</span></label></p>
';

if(htmlentities($op3)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op3.'" class="form-control" value="'.$op3.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op3.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op3).'</span></label></p>
';

if(htmlentities($op4)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op4.'" class="form-control" value="'.$op4.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op4.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op4).'</span></label></p>
';

print '
	
	
	<p><a role="tab"  href="#tab'.($qno-1).'"  onclick="check(demo'.($qno-1).')" data-toggle="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;"><i class="fa fa-long-arrow-left m-r-5" aria-hidden="true"></i>  Prev</a>
	<input type="button" style = "margin-left : 20px;" class = "btn btn-danger" value="Clear" onclick="Clear('.$qno.')">
	<a role="tab" style="margin-left : 20px; padding:10px;color:white;background-color:#22baa0; text-decoration:none ;" href="#tab'.($qno+1).'"  onclick="check(demo'.($qno+1).')" data-toggle="tab"> Next  <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></a></p>
	
	<p></p>
	
	<input type="hidden" name="pos'.$qno.'" value="'.base64_encode($posmarks).'">
	<input type="hidden" name="neg'.$qno.'" value="'.base64_encode($neg).'">
	<input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
	<input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
	<input type="hidden" name="qqid'.$qno.'" value="'.base64_encode($qsid).'">
	</div>
	';		
	}
	
	$qno = $qno + 1;
	$t_medium = $t_medium -1;
	
	$sql = "INSERT INTO tbl_report (user_id, exam_id, q_id,type, question, img, difficulty, option1, option2, option3, option4, positive_mark, negative_mark, answer, response, status, marks) VALUES ('$myid ', '$exam_id', '$qsid', '$type', '$qs', '$imgs', '$difficulty', '$op1','$op2','$op3','$op4', '$posmarks', '$neg', '$ans', '-', '-','-')";
	$conn->query($sql);
	}
	
	}
	if($difficulty == "hard" && $t_hard >0){
		if ($type == "FB") {
		if ($qno == "1") {
		print '
		<div role="tabpanel" class="tab-pane active fade in" id="tab'.$qno.'">
					<p><span style="font-size: 10pt;white-space:pre">Marks: '.(htmlentities($posmarks)).'<span></p>
					
					<p style="overflow: auto"><span style="font-size: 15pt;white-space:pre"><b>Question No: '.$qno.'<br><br></b> '.(htmlentities($qs)).'<span></p>
					';
					  if( $imgs == NULL){ }else{
					  print '<center><img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" style="top:0px;width:300px;height:300px"/></center>';
					}
		
		print '
		<p><input type="text" name="an'.$qno.'" onkeypress="mycolorss(demo'.$qno.')" class="form-control" placeholder="Enter your answer" autocomplete="off"></p>
		<p><a role="tab"  href="#tab'.($qno-1).'"  onclick="check(demo'.($qno-1).')" data-toggle="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;"><i class="fa fa-long-arrow-left m-r-5" aria-hidden="true"></i>  Prev</a>
		<a role="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;" href="#tab'.($qno+1).'"  onclick="check(demo'.($qno+1).')" data-toggle="tab"> Next  <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></a></p>
		
		<input type="hidden" name="pos'.$qno.'" value="'.base64_encode($posmarks).'">
		<input type="hidden" name="neg'.$qno.'" value="'.base64_encode($neg).'">
		<input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
		<input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
		<input type="hidden" name="qqid'.$qno.'" value="'.base64_encode($qsid).'">
		</div>
		';	
		}else{
		print '
		<div role="tabpanel" class="tab-pane fade in" id="tab'.$qno.'">
		
		<p><span style="font-size: 10pt;white-space:pre">Marks: '.(htmlentities($posmarks)).'<span></p>
		
		<p style="overflow :auto"><span style="font-size: 15pt;overflow :auto;white-space:pre"><b>Question No: '.$qno.'<br><br></b> '.(htmlentities($qs)).'</span></p>
					 ';
					  if( $imgs == NULL){ }else{
					  print '<center><img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" style="top:0px;width:300px;height:300px"/></center>';
					  
					}
		print '
		<p><input type="text" name="an'.$qno.'" onkeypress="mycolorss(demo'.$qno.')"  class="form-control" placeholder="Enter your answer" autocomplete="off"></p>
		<p><a role="tab"  href="#tab'.($qno-1).'"  onclick="check(demo'.($qno-1).')" data-toggle="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;"><i class="fa fa-long-arrow-left m-r-5" aria-hidden="true"></i>  Prev</a>
		<a role="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;" href="#tab'.($qno+1).'"  onclick="check(demo'.($qno+1).')" data-toggle="tab"> Next  <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></a></p>
		
		<input type="hidden" name="pos'.$qno.'" value="'.base64_encode($posmarks).'">
		<input type="hidden" name="neg'.$qno.'" value="'.base64_encode($neg).'">
		<input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
		<input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
		<input type="hidden" name="qqid'.$qno.'" value="'.base64_encode($qsid).'">
		</div>
		';		
		}
		
		$qno = $qno + 1;
		$t_hard = $t_hard -1;
		
		$sql = "INSERT INTO tbl_report (user_id, exam_id, q_id,type, question, img, difficulty, option1, option2, option3, option4, positive_mark, negative_mark, answer, response, status, marks) VALUES ('$myid ', '$exam_id', '$qsid', '$type', '$qs', '$imgs', '$difficulty', '$op1','$op2','$op3','$op4', '$posmarks', '$neg', '$ans', '-', '-','-')";
		$conn->query($sql);
		}else{
		
		if ($qno == "1") {
		$van = "tab'.$qno.'";
		print '
		
		<div role="tabpanel" class="amount_list active fade in" id="tab'.$qno.'">
		
		<p><span style="font-size: 10pt;white-space:pre">Marks: '.(htmlentities($posmarks)).'<span></p>
		
		<p style="overflow :auto"><span style="font-size:15pt;overflow :auto; white-space:pre"><b>Question No: '.$qno.'<br><br></b> '.(htmlentities($qs)).'</span></p>
		<br>
		';
		if( $imgs == NULL){ }else{
		print '<center><img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" style="top:0px;"/></center>';
		
		}
		
		
		if(htmlentities($op1)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op1.'" class="form-control" value="'.$op1.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op1.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op1).'</span></label></p>
';
if(htmlentities($op2)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op2.'" class="form-control" value="'.$op2.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op2.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op2).'</span></label></p>
';

if(htmlentities($op3)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op3.'" class="form-control" value="'.$op3.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op3.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op3).'</span></label></p>
';

if(htmlentities($op4)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op4.'" class="form-control" value="'.$op4.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op4.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op4).'</span></label></p>
';

print '
		
		<p><a role="tab"  href="#tab'.($qno-1).'"  onclick="check(demo'.($qno-1).')" data-toggle="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;"><i class="fa fa-long-arrow-left m-r-5" aria-hidden="true"></i>  Prev</a>
		<input type="button" style = "margin-left : 20px;" class = "btn btn-danger" value="Clear" onclick="Clear('.$qno.')">
		<a role="tab" style="margin-left : 20px; padding:10px;color:white;background-color:#22baa0; text-decoration:none ;" href="#tab'.($qno+1).'"  onclick="check(demo'.($qno+1).')" data-toggle="tab"> Next  <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></a></p>
		
		
		
		<input type="hidden" name="pos'.$qno.'" value="'.base64_encode($posmarks).'">
		<input type="hidden" name="neg'.$qno.'" value="'.base64_encode($neg).'">
		<input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
		<input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
		<input type="hidden" name="qqid'.$qno.'" value="'.base64_encode($qsid).'">
		</div>
		';	
		}else{
		$van = "tab'.$qno.'";
		
		
		
		print '
		<div role="tabpanel" class="amount_list fade in" id="tab'.$qno.'">
		
		<p><span style="font-size: 10pt;white-space:pre">Marks: '.(htmlentities($posmarks)).'<span></p>
		
		<p style="overflow: auto"><span style="font-size: 15pt;overflow: auto;white-space:pre"><b>Question No: '.$qno.'<br><br></b> '.(htmlentities($qs)).'<span></p><br>
		';
		if( $imgs == NULL){ }else{
			
		print '<center><img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" style="top:0px;"/></center>';
		
		}
		
		
		
		if(htmlentities($op1)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op1.'" class="form-control" value="'.$op1.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op1.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op1).'</span></label></p>
';
if(htmlentities($op2)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op2.'" class="form-control" value="'.$op2.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op2.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op2).'</span></label></p>
';

if(htmlentities($op3)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op3.'" class="form-control" value="'.$op3.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op3.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op3).'</span></label></p>
';

if(htmlentities($op4)!= '_')
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op4.'" class="form-control" value="'.$op4.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op4.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op4).'</span></label></p>
';

print '
		
		<p><a role="tab"  href="#tab'.($qno-1).'"  onclick="check(demo'.($qno-1).')" data-toggle="tab" style="padding:10px;color:white;background-color:#22baa0; text-decoration:none ;"><i class="fa fa-long-arrow-left m-r-5" aria-hidden="true"></i>  Prev</a>
		<input type="button" style = "margin-left : 20px;" class = "btn btn-danger" value="Clear" onclick="Clear('.$qno.')">
		<a role="tab" style="margin-left : 20px; padding:10px;color:white;background-color:#22baa0; text-decoration:none ;" href="#tab'.($qno+1).'"  onclick="check(demo'.($qno+1).')" data-toggle="tab"> Next  <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></a></p>
		
		<p></p>
		
		<input type="hidden" name="pos'.$qno.'" value="'.base64_encode($posmarks).'">
		<input type="hidden" name="neg'.$qno.'" value="'.base64_encode($neg).'">
		<input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
		<input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
		<input type="hidden" name="qqid'.$qno.'" value="'.base64_encode($qsid).'">
		</div>
		';		
		}
		
		$qno = $qno + 1;	
		$t_hard = $t_hard -1;
		
		$sql = "INSERT INTO tbl_report (user_id, exam_id, q_id,type, question, img, difficulty, option1, option2, option3, option4, positive_mark, negative_mark, answer, response, status, marks) VALUES ('$myid ', '$exam_id', '$qsid', '$type', '$qs', '$imgs', '$difficulty', '$op1','$op2','$op3','$op4', '$posmarks', '$neg', '$ans', '-', '-','-')";
		$conn->query($sql);
		}
		
		}
}
}} 

?>

</div>

<input type="hidden" name="tq" value="<?php echo "$t_question"; ?>">
<input type="hidden" name="us" value="<?php echo "$myid"; ?>">

<input type="hidden" name="eid" value="<?php echo "$exam_id"; ?>">
<input type="hidden" name="pm" value="<?php echo "$passmark"; ?>">
<input type="hidden" name="ttm" value="<?php echo "$t_mark"; ?>">
<input type="hidden" name=tom value="<?php echo "$t_question"; ?>">
<input type="hidden" name="ri" value="<?php echo "$recid"; ?>">
<input type="hidden" name="pre" value="<?php echo "$pre"; ?>">

<!--</ul>-->

<input type="hidden" name="formid" value="<?php echo htmlspecialchars($_SESSION["current_examid"]); ?>" />

<br>

<input id="btn"  style = "margin-left :300px;"class="btn btn-danger" type="submit" onclick="Submit()" value="End Exam" CssClass="noprompt-required" AutoPostBack="true">


</div> 
<aside style="float:right;top:-120px ;padding-right:5px ;margin-top:20px ; overflow: auto; height:500px ;">
<div style="margin:5px ;">

<p>Attempted Questions : <span style="background-color:#4BB543 ;margin:5px ;width:30px ;height:30px ;color:#4BB543 ;border:1px solid black ;">***</span></p> 
<p>Visited But Not Attempted  : <span style="background-color:#ffcc00 ;width:35px ;height:30px ;color:#ffcc00 ;border:1px solid black ;">***</span></p> 
<p>Not Attempted Questions : <span style="background-color:white ;width:35px ;height:30px ;color:white ;border:1px solid black ;">***</span></p> 

</div>

<table class="table table-bordered" style="border-color:#22BAA3">
<tr> <th colspan="5" style="background-color:#22BAA3 ;color:white ;text-align:center ;letter-spacing: 2px;" >QUESTION PALLETTE </th> </tr>


<tbody>

<?php
$counter= 1 ;
$j =1 ;
for($i=1;$i<=$num/3;$i++)
{

echo "<tr>";
for($j=1;$j<=3;$j++)
{

if($counter==1){
print '<td><a id="demoz'.$counter.'" href="#tab'.$counter.'" role="tab"  data-toggle="tab" onclick="check(demo'.$counter.')"><button style="background-color: #ffcc00;width:100%;border:none;" id="demo'.$counter.'" >'.$counter.'</button></a></td>';	
$counter=$counter+1 ;
}
else {
print '<td><a id="demoz'.$counter.'" href="#tab'.$counter.'" role="tab"  data-toggle="tab" onclick="check(demo'.$counter.')"><button id="demo'.$counter.'" style="width:100%;border:none;background-color:white;">'.$counter.'</button></a></td>';	

$counter=$counter+1 ;
}

}

echo "</tr>";

}

if($num%3 !== 0){
$extra=$num%3 ;
echo "<tr>";
for($j=1;$j<=$extra;$j++)
{

print '<td><a id="demoz'.$counter.'" href="#tab'.$counter.'" role="tab"  data-toggle="tab" onclick="check(demo'.$counter.')"><button  id="demo'.$counter.'" style="width:100%;border:none;background-color:white;" >'.$counter.'</button></a></td>';	
$counter=$counter+1 ;
}

echo "</tr>";

}

?>



</tbody>
</table>



</aside>


</form>

<?php
if(isset($_POST["an'.$qno.'"])){
$cc1 = $cc1 + 1;

}
?>
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
<script src="../assets/js/modern.min.js"></script>

<script>


var idArray=[] ;

function mycolorss(id) {

idArray.push(id) ;

id.setAttribute("style","background-color:#4BB543; color:black;color:white;width:100%;border:none;height:100%;");
}

function check(id) {


console.log(idArray.indexOf(id)) ;

if(idArray.indexOf(id)==-1){
id.setAttribute("style","background-color:#ffcc00; color:black;width:100%;border:none;height:100%;");
}
else{
id.setAttribute("style","background-color:#4BB543;color:white;width:100%;border:none;height:100%;");
}
}

function Submit(){
	console.log('Submitt');
	localStorage.removeItem("total_seconds");
}



function Clear(inp){
	//console.log(inp)
	var name = "an"+inp;
	var id = "demo"+inp;
	var ID = document.getElementById(id).setAttribute("style","background-color:#ffcc00; color:black; width:100%; border:none;height:100%; ");
	document.querySelector('input[name='+name+']:checked').checked = false;
}






var btn = document.getElementById('btn'),
clicked = false;

btn.addEventListener('click', function () {
clicked = true;
});

window.onbeforeunload = function () {
if(!clicked) {
return 'If you resubmit this page, progress will be lost.';
}
}
	
</script>

<script>

$(document).ready(function() {
$("#btn").click(function() {
var length = 3;
var isChecked = true;
for (var i = 1; i <= length; i++) {
isChecked = isChecked && ($("<?php echo "an'.$qno.'"; ?>" + i).is(":checked"));
}
if (isChecked)
alert("All are checked");
else
alert("All are not checked");
});
});

</script>

<script>
function myFunction() {
var x = document.getElementById("snackbar")
x.className = "show";
setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>


<script>

function disable_f5(e)
{
if ((e.which || e.keyCode) == 116)
{
e.preventDefault();
}
}
var subbutton = false;
$(document).ready(function(){
$(document).bind("keydown", disable_f5);    
});
//playing starts here
$('#btn').click(function(){
if(!subbutton){

var c1 = 0;
var na ="";
$('input[type=text]').each(function(){
if (this.value == "") {
c1++;

}
})
$('input:text').each(function(){
if ($(this).attr('name') == true){
na = $(this).attr('name')

} 
})


var names = {};
$('input:radio').each(function() { // find unique names
names[$(this).attr('name')] = true;
});
var count = 0;
$.each(names, function() { // then count them
count++;
});
var c2 = 0;
c2 	= count - $('input:radio:checked').length;
var c3 = 0;
c3 = c2 + c1;
if($('input:radio:checked').length == count && c1 == 0) {
// all questions answered
return confirm("Are you sure you want to submit your assessment ?");
}
else{

a = names + ""
return confirm(c3 + " Questions Are Not Answered \n\nAre you sure you want to submit your assessment ?\n ");
}


}});
</script>



<script type="text/javascript">
var max_time = <?php echo "$duration" ?>;
var c_seconds  = 0;

if(localStorage.getItem("total_seconds")){
    var total_seconds = localStorage.getItem("total_seconds");
} else {
    var total_seconds = 60*max_time;
}
max_time = parseInt(total_seconds/60);
c_seconds = parseInt(total_seconds%60);
document.getElementById("quiz-time-left").innerHTML='' + max_time + ':' + c_seconds + 'Min';
function init()
{
	document.getElementById("quiz-time-left").innerHTML='' + max_time + ':' + c_seconds + ' Min';
	setTimeout("CheckTime()",999);
}
function CheckTime()
{
	document.getElementById("quiz-time-left").innerHTML='' + max_time + ':' + c_seconds + ' Min' ;
	if(total_seconds <=0)
	{
		subbutton = true;
		delete localStorage.total_seconds
		window.onbeforeunload = null;
		setTimeout('document.quiz.submit()', 1);
	} 
	else
	{
		total_seconds = total_seconds -1;
		max_time = parseInt(total_seconds/60);
		c_seconds = parseInt(total_seconds%60);
		localStorage.setItem("total_seconds",total_seconds)
		setTimeout("CheckTime()",999);
	}

}
init();
</script>

</body>


</html>
<?php } else {
			header("location:./take-assessment.php?id=$exam_id");
			
			}
			$conn->close();
?>