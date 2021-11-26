
<?php
include '../../database/config.php';
if(isset($_POST))
{
error_reporting(0);
$total_questions = $_POST['tq'];
$myid = $_POST['us'];
$starting_mark = 1;
$mytotal_marks = 0;
$mynegmarks = 0;
$exam_id = $_POST['eid'];
$record = $_POST['ri'];
$t_mark = $_POST['ttm'];
$t_question = $_POST['tom'];
//$pre = $_POST['pre'];



$cans = 0;
$wans = 0;
$skipped = 0;
while ($starting_mark <= $t_question) {
    if (strtoupper(base64_decode($_POST['ran'.$starting_mark.''])) == strtoupper($_POST['an'.$starting_mark.''])) {
                $resp = strtoupper($_POST['an'.$starting_mark.'']);
                $qid = strtoupper(base64_decode($_POST['qqid'.$starting_mark.'']));
                $posmarks = (int)strtoupper(base64_decode($_POST['pos'.$starting_mark.'']));
                
                $sql = "UPDATE tbl_report SET response= '$resp', status='correct', marks = $posmarks WHERE user_id='$myid' AND exam_id = '$exam_id' AND q_id ='$qid'";
                $conn->query($sql);
        $mytotal_marks = $mytotal_marks + $posmarks;
        $cans+=1;
   
     }else if(!$_POST['an'.$starting_mark.'']){
        $resp = strtoupper($_POST['an'.$starting_mark.'']);
        $qid = strtoupper(base64_decode($_POST['qqid'.$starting_mark.'']));
        $marks = 0;
        
        $sql = "UPDATE tbl_report SET response='$resp', status='skipped', marks = $marks WHERE user_id='$myid' AND exam_id = '$exam_id' AND q_id ='$qid'";
        $conn->query($sql);
				$skipped+=1;
			}else{
                $resp = strtoupper($_POST['an'.$starting_mark.'']);
                $qid = strtoupper(base64_decode($_POST['qqid'.$starting_mark.'']));
                $neg = (float)strtoupper(base64_decode($_POST['neg'.$starting_mark.'']));
                
                $sql = "UPDATE tbl_report SET response= '$resp', status='wrong', marks = $neg WHERE user_id='$myid' AND exam_id = '$exam_id' AND q_id ='$qid'";
                $conn->query($sql);
                // echo strtoupper(base64_decode($_POST['ran'.$starting_mark.'']))."<br>".strtoupper($_POST['an'.$starting_mark.'']);
				
        $mynegmarks += $neg;
				$wans+=1;
       
    }
    $starting_mark++;
}


$final = (float)($mytotal_marks + $mynegmarks);
$passmark = $_POST['pm'];

$perc = (float)($final/$t_mark)*100;

if ($perc >= $passmark) {
    $status = "PASS";
}else{
    $status = "FAIL";
}

session_start();
$_SESSION['record_id'] = $record;


$sql = "UPDATE tbl_assessment_records SET score=$final, exam_status='$status', c_ans=$cans, f_ans=$wans,skipped=$skipped, total_question=$t_question WHERE record_id='$record'";
$sql2 = "UPDATE tbl_assessment_records A 
SET final_score = (SELECT MAX(score) FROM tbl_assessment_records B WHERE A.usn=B.usn AND A.exam_name=B.exam_name),
final_status = (SELECT MAX(exam_status) FROM tbl_assessment_records B WHERE A.usn=B.usn AND A.exam_name=B.exam_name)";
$sql3 = "DELETE FROM tbl_assessment_records WHERE student_id = '$myid' AND exam_id = '$exam_id' AND c_ans = 0 AND f_ans = 0 AND skipped = 0";
$t1 = $conn->query($sql);
$t2 = $conn->query($sql2);
$t3 = $conn->query($sql3);
if ( t1 === TRUE && t2 === TRUE && t3 === TRUE) {
    
    
   header("location:../assessment-info.php");
} else {
    header("location:../assessment-info.php");
	echo "not inserting";
	
}

$conn->close();

}
?>
