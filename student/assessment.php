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

			}
			}else {
			header("location:./");
			}

			$sql = "SELECT * FROM tbl_assessment_records WHERE student_id = '$myid'";
			$result = $conn->query($sql);
			
			

			if ($result->num_rows > 0 ) {

			    
			       header("location:./take-assessment.php?id=$exam_id");
			} else {
			$myname = "$myfname $mylname";
			$recid = 'RS'.get_rand_numbers(14).'';
			// record_id 	student_id 	student_name 	sem_sec 	usn 	exam_name 	exam_id 	score 	status 	c_ans 	f_ans 	skipped
			//echo "<br>".$recid."<br>".$myid."<br>".$myname."<br>".$mysem."<br>".$usn."<br>".$exam_name."<br>".$exam_id;
			//$sql = "INSERT INTO tbl_assessment_records (record_id, student_id, student_name, sem_sec, usn, exam_name, exam_id)
			//VALUES ('$recid', '$myid', '$myname', '$mysem', '$usn', '$exam_name', '$exam_id')";

			$sql = "INSERT INTO tbl_assessment_records (record_id, student_id, student_name,sem_sec, usn, exam_name, exam_id, score, status, c_ans, f_ans, skipped, total_question) VALUES ('$recid', '$myid', '$myname', '$mysem', '$usn', '$exam_name', '$exam_id', '0', 'FAIL', '0', '0', '0', '$t_question')";

			if ($conn->query($sql) === TRUE) {

			} else {
			mysqli_error($conn);
			echo "not inserting";
			}

			}

			?>
<!DOCTYPE html>
<html>

<head>


<title>OES | Examination</title>

<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta charset="UTF-8">
<meta name="description" content="Online Examination System" />
<meta name="keywords" content="Online Examination System" />
<meta name="author" content="Bwire Charles Mashauri" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
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
<ul class="menu accordion-menu">
<li><a href="./" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
<li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Subjects</p></a></li>
<li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Students</p></a></li>
<li><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Examinations</p></a></li>
<!-- <li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Exam Results</p></a></li>-->
<li><a href="helps.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-modal-window"></span><p>Help</p></a></li>
</ul>
</div>

	</div>
  <div class="page-inner">
<div class="page-title">
<h3>Examination</h3>
<div class="page-breadcrumb">
<ol class="breadcrumb">
<li><a href="./">Home</a></li>
<li><a href="examinations.php">Examinations</a></li>
<li class="active"><?php echo "$exam_name"; ?></li> 
</ol>
</div>
</div>
<div><p class="alert alert-danger" style="text-align:center; margin:0!important">DO NOT REFRESH THIS PAGE, otherwise exam autosubmits regardless of whether you completed or not.</p></div>
<div><p class="alert alert-success" style="text-align:center; margin:0!important">The test auto submits so don't worry when time expires</p></div>
<div id="main-wrapper" style="margin-top:0!important">
<div class="row">
<div class="panel panel-white">
<div class="panel-body">
<div class="tabs-below" role="tabpanel" style=" width:60% ;float:left ;">
<form action="pages/submit_assessment.php" method="POST" name="quiz" id="quiz_form" >
<div class="tab-content">
<?php 
include '../database/config.php';

$sq = "SELECT t_question from tbl_examinations where exam_id = '$exam_id'";
$res = $conn->query($sq);
$num = 0;
if($res){
$val = $res->fetch_assoc();
$num = $val['t_question'];
}
				
$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id' ORDER BY RAND() LIMIT $num";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$qno = 1;
while($row = $result->fetch_assoc()) {
$qsid = $row['question_id'];
$qs = $row['question'];
$type = $row['type'];
$op1 = $row['option1'];
$op2 = $row['option2'];
$op3 = $row['option3'];
$op4 = $row['option4'];
$posmarks = $row['positive_mark'];
$neg = $row['negative_mark'];
$ans = $row['answer'];
                    
$enan = $row[$ans];
$cc = $row[0];
if ($type == "FB") {
if ($qno == "1") {
print '
<div role="tabpanel" class="tab-pane active fade in" id="tab'.$qno.'"><script type="text/javascript">  mycolorsYellow(demo".$qno."); </script> 
			<p><n style="font-size: 10pt;white-space:pre"><b>Marks:</b> '.(htmlentities($posmarks)).'<span></p><p><span style="font-size: 10pt;white-space:pre"><b>Question No: '.$qno.'<br></b> '.(htmlentities($qs)).'<span></p>
            ';
              if( $imgs == NULL){ }else{
              print '<img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" width="250" alt="error" height="250" align="right"/>';
              
            }

print '
<p><input type="text" name="an'.$qno.'" onkeypress="mycolorss(demo'.$qno.')" class="form-control" placeholder="Enter your answer" autocomplete="off"></p>

<input type="hidden" name="pos'.$qno.'" value="'.base64_encode($posmarks).'">
<input type="hidden" name="neg'.$qno.'" value="'.base64_encode($neg).'">
<input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
<input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
</div>
';	
}else{
print '
<div role="tabpanel" class="tab-pane fade in" id="tab'.$qno.'">
<script type="text/javascript">  mycolorsYellow(demo".$qno."); </script>
<p><span style="font-size: 18pt;white-space:pre"><b>Marks:</b> '.(htmlentities($posmarks)).'<span></p>
<p><span style="font-size: 10pt;white-space:pre"><b>Question No: '.$qno.'<br></b> '.(htmlentities($qs)).'</span></p>
             ';
              if( $imgs == NULL){ }else{
              print '<img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" width="250" height="250" align="right"/>';
              
            }
echo '<script type="text/javascript">  mycolorsYellow(demo".$qno."); </script>' ;
print '
<p><input type="text" name="an'.$qno.'" onkeypress="mycolorss(demo'.$qno.')"  class="form-control" placeholder="Enter your answer" autocomplete="off"></p>

<input type="hidden" name="pos'.$qno.'" value="'.base64_encode($posmarks).'">
<input type="hidden" name="neg'.$qno.'" value="'.base64_encode($neg).'">
<input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
<input type="hidden" name="ran'.$qno.'" value="'.base64_encode($ans).'">
</div>
';		
}

$qno = $qno + 1;	
}else{

if ($qno == "1") {
$van = "tab'.$qno.'";
print '

<div role="tabpanel" class="amount_list active fade in" id="tab'.$qno.'">
<script type="text/javascript">  mycolorsYellow(demo".$qno."); </script>
<p><span style="font-size: 18pt;white-space:pre"><b>Marks:</b> '.(htmlentities($posmarks)).'<span></p>
<p><span style="font-size: 10pt;white-space:pre"><b>Question No: '.$qno.'<br></b> '.(htmlentities($qs)).'</span></p>
<br>
<br>
<br>';
if( $imgs == NULL){ }else{
print '<img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" width="250" height="250" align="right"/>';

}

echo '<script type="text/javascript">  mycolorsYellow(demo".$qno."); </script>' ;
print '
<p><input type="radio" name="an'.$qno.'" id="'.$op1.'" class="form-control" value="'.$op1.'" onclick="mycolorss(demo'.$qno.')" /> <label class="gift_amount" for="'.$op1.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op1).'</span></label></p>

<p><input type="radio" name="an'.$qno.'" id="'.$op2.'" class="form-control" value="'.$op2.'" onclick="mycolorss(demo'.$qno.')"/> <label class="gift_amount" for="'.$op2.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op2).'</span></label></p>

<p><input type="radio" name="an'.$qno.'" id="'.$op3.'" class="form-control" value="'.$op3.'" onclick="mycolorss(demo'.$qno.')"/> <label class="gift_amount" for="'.$op3.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op3).'</span></label></p>

<p><input type="radio" name="an'.$qno.'" id="'.$op4.'" class="form-control" value="'.$op4.'" onclick="mycolorss(demo'.$qno.')"/> <label class="gift_amount" for="'.$op4.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op4).'</span></label></p>
<p><input type="button" value="Clear" onclick="Clear(<?=$qno?>)"></p>

<input type="hidden" name="pos'.$qno.'" value="'.base64_encode($posmarks).'">
<input type="hidden" name="neg'.$qno.'" value="'.base64_encode($neg).'">
<input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
<input type="hidden" name="ran'.$qno.'" value="'.base64_encode($enan).'">
</div>
';	
}else{
$van = "tab'.$qno.'";



print '
<div role="tabpanel" class="amount_list fade in" id="tab'.$qno.'">
<script type="text/javascript">  mycolorsYellow(demo".$qno."); </script>
<p><span style="font-size: 18pt;white-space:pre"><b>Marks:</b> '.(htmlentities($posmarks)).'<span></p>
<p><span style="font-size: 10pt;white-space:pre"><b>Question No: '.$qno.'<br></b> '.(htmlentities($qs)).'<span></p><br><br><br>
';
if( $imgs == NULL){ }else{
print '<img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" width="250" height="250" align="right"/>';

}
echo '<script type="text/javascript">  mycolorsYellow(demo".$qno.");</script>' ;


print '
<p><input type="radio" name="an'.$qno.'" id="'.$op1.'" class="form-control" value="'.$op1.'" onclick="mycolorss(demo'.$qno.')"/> <label class="gift_amount" for="'.$op1.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op1).'</span></label></p>

<p><input type="radio" name="an'.$qno.'" id="'.$op2.'" class="form-control" value="'.$op2.'" onclick="mycolorss(demo'.$qno.')"/> <label class="gift_amount" for="'.$op2.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op2).'</span></label></p>

<p><input type="radio" name="an'.$qno.'" id="'.$op3.'" class="form-control" value="'.$op3.'" onclick="mycolorss(demo'.$qno.')"/> <label class="gift_amount" for="'.$op3.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op3).'</span><label></p>

<p><input type="radio" name="an'.$qno.'" id="'.$op4.'" class="form-control" value="'.$op4.'" onclick="mycolorss(demo'.$qno.')"/> <label class="gift_amount" for="'.$op4.'"><span style="background-color:white; font-size: 10pt; padding-top: 6px; padding-right: 30px;padding-bottom: 8px; padding-left: 15px">'.htmlentities($op4).'</span></label></p>

<p><input type="button" value="Clear" onclick="Clear(<?=$qno?>)"></p>

<input type="hidden" name="pos'.$qno.'" value="'.base64_encode($posmarks).'">
<input type="hidden" name="neg'.$qno.'" value="'.base64_encode($neg).'">
<input type="hidden" name="qst'.$qno.'" value="'.base64_encode($qs).'">
<input type="hidden" name="ran'.$qno.'" value="'.base64_encode($enan).'">
</div>
';		
}

$qno = $qno + 1;	


}

}
} else {

}

?>

</div>



<ul class="nav nav-tabs" role="tablist">
<?php 
include '../database/config.php';

            
$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$exam_id' ORDER BY RAND() LIMIT $num ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$qno = 1;
			$total_questions = 0;
              
while($row = $result->fetch_assoc()) {             
			$total_questions++;
			if ($qno == "1") {
				if (isset($_POST["an'.$qno.'"])) {
						$color = "green";
				}
				print '<li role="presentation" class="active" ><a id="demoz'.$qno.'" href="#tab'.$qno.'" role="tab"  data-toggle="tab" onclick="check(demo'.$qno.')">'.$qno.'</a></li>';	
				}else{
					if (isset($_POST["an'.$qno.'"])) {
							$color = "green";
					}
					print '<li role="presentation" ><a id="demoz'.$qno.'" href="#tab'.$qno.'" role="tab"   data-toggle="tab" onclick="check(demo'.$qno.')">'.$qno.'</a></li>';		
					}

			$qno = $qno + 1;

}
} else {

}

?>
<input type="hidden" name="tq" value="<?php echo "$total_questions"; ?>">
<input type="hidden" name="eid" value="<?php echo "$exam_id"; ?>">
<input type="hidden" name="pm" value="<?php echo "$passmark"; ?>">
<input type="hidden" name="ttm" value="<?php echo "$t_mark"; ?>">
<input type="hidden" name=tom value="<?php echo "$t_question"; ?>">
<input type="hidden" name="ri" value="<?php echo "$recid"; ?>">
<input type="hidden" name="pre" value="<?php echo "$pre"; ?>">

</ul>

<input type="hidden" name="formid" value="<?php echo htmlspecialchars($_SESSION["current_examid"]); ?>" />

<br>

<input id="btn"  class="btn btn-success" type="submit" value="Submit Assessment" CssClass="noprompt-required" AutoPostBack="true">

</div> 
<aside style="float:right;top:-120px ;padding-right:5px ;margin-top:20px ; overflow: scroll; height:500px ;">
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

echo "<tr style='width:2px ; height:2px ;'>";
for($j=1;$j<=3;$j++)
{

if($counter==1){
print '<td style=" width:10px ; height:10px ;background-color: #ffcc00" id="demo'.$counter.'" >'.$counter.'</td>';	
$counter=$counter+1 ;
}
else {
print '<td style="width: 10px ; height : 10px ;"  id="demo'.$counter.'" >'.$counter.'</td>';	

$counter=$counter+1 ;
}

}

echo "</tr>";

}

if($num%3 !=0){
$extra=$total_questions%3 ;
echo "<tr>";
for($j=1;$j<=$extra;$j++)
{

print '<td style="width: 10px ; height : 10px ;" id="demo'.$counter.'" >'.$counter.'</td>';	
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

id.setAttribute("style","background-color:#4BB543; color:black;color:white;");
}

function check(id) {


console.log(idArray.indexOf(id)) ;

if(idArray.indexOf(id)==-1){
id.setAttribute("style","background-color:#ffcc00; color:black; width: 2px ; height : 2px ;");
}
else{
id.setAttribute("style","background-color:#4BB543;color:white;width: 10px ; height : 10px ;");
}
}

function Clear(inp){
	//console.log(inp)
	var name = "an"+inp;
	var id = "demo"+inp;
	var ID = document.getElementById(id).setAttribute("style","background-color:#ffcc00; color:black;");
	document.querySelector('input[name='+name+']:checked').checked = false;
}

</script>



<script type="text/javascript">
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
	
//document.getElementById("quiz_form").onsubmit = function(e){
//			window.onbeforeunload = null;
//      return true;
//		}
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

$(document).ready(function(){
$(document).bind("keydown", disable_f5);    
});
//playing starts here
var subbutton = false;
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
var total_seconds =60*max_time;
max_time = parseInt(total_seconds/60);
c_seconds = parseInt(total_seconds%60);
document.getElementById("quiz-time-left").innerHTML='' + max_time + ':' + c_seconds + 'Min';
function init(){
document.getElementById("quiz-time-left").innerHTML='' + max_time + ':' + c_seconds + ' Min';
setTimeout("CheckTime()",999);
}
function CheckTime(){
document.getElementById("quiz-time-left").innerHTML='' + max_time + ':' + c_seconds + ' Min' ;
if(total_seconds <=0){
subbutton = true;
setTimeout('document.quiz.submit()',1);

} else
{
total_seconds = total_seconds -1;
max_time = parseInt(total_seconds/60);
c_seconds = parseInt(total_seconds%60);
setTimeout("CheckTime()",999);
}

}
init();
</script>

</body>

</html>
