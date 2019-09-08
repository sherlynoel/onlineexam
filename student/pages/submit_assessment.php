<?php
if(isset($_POST))
{
error_reporting(0);
$total_questions = $_POST['tq'];
$starting_mark = 1;
$mytotal_marks = 0;
$mynegmarks = 0;
$exam_id = $_POST['eid'];
$record = $_POST['ri'];
$t_mark = $_POST['ttm'];
$t_question = $_POST['tom'];
$pre = $_POST['pre'];
$cans = 0;
$wans = 0;
$skipped = 0;
while ($starting_mark <= $total_questions) {
    if (strtoupper(base64_decode($_POST['ran'.$starting_mark.''])) == strtoupper($_POST['an'.$starting_mark.''])) {
		
				$posmarks = (int)strtoupper(base64_decode($_POST['pos'.$starting_mark.'']));
				
        $mytotal_marks = $mytotal_marks + $posmarks;
        $cans+=1;
   
     }else if(!$_POST['an'.$starting_mark.'']){
				$skipped+=1;
			}else{
				$neg = (float)strtoupper(base64_decode($_POST['neg'.$starting_mark.'']));
        $mynegmarks += $neg;
				$wans+=1;
       
    }
    $starting_mark++;
}

$final = (float)($mytotal_marks + $mynegmarks);
$passmark = $_POST['pm'];
	

if ($final >= $passmark) {
    $status = "PASS";
}else{
    $status = "FAIL";
}

//echo $final."<br>".$mytotal_marks."<br>".$mynegmarks;
	

session_start();
$_SESSION['record_id'] = $record;
include '../../database/config.php';
$sql = "UPDATE tbl_assessment_records SET score='$final', status='$status', c_ans='$cans', f_ans='$wans',skipped='$skipped', total_question='$t_question' WHERE record_id='$record'";

if ($conn->query($sql) === TRUE) {
    
    
    header("location:../assessment-info.php");
} else {
    header("location:../assessment-info.php");
}

$conn->close();

}
?>
