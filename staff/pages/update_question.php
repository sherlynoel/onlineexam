<?php
include '../../database/config.php';
include '../../includes/uniques.php';
$question_id = $_POST['question_id'];
$question = mysqli_real_escape_string($conn, $_POST['question']);
$answer = mysqli_real_escape_string($conn, $_POST['answer']);
$pos = (int) mysqli_real_escape_string($conn, $_POST['positive']);
$neg = (int)mysqli_real_escape_string($conn, $_POST['negative']);
$topic = mysqli_real_escape_string($conn, $_POST['topic']);
if (isset($_GET['type'])) {
$question_type = $_GET['type'];	
if ($question_type == "mc") {	
$opt1 = mysqli_real_escape_string($conn, $_POST['opt1']);
$opt2 = mysqli_real_escape_string($conn, $_POST['opt2']);
$opt3 = mysqli_real_escape_string($conn, $_POST['opt3']);
$opt4 = mysqli_real_escape_string($conn, $_POST['opt4']);
if(isset($_FILES['image']['tmp_name']))
{
    $image1 = addslashes(file_get_contents($_FILES['image']['tmp_name']));
}


$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$examid' AND question = '$question' AND question_id != '$question_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
 header("location:../edit-question.php?rp=1185&id=$question_id");
    }
} else {
if(isset($_FILES['image']))
{
    $image1 = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    if($answer == "option1"){
$sql = "UPDATE tbl_questions SET question='$question',positive_mark = $pos, negative_mark = $neg, option1='$opt1', option2='$opt2', option3='$opt3', option4='$opt4', answer='$opt1', imgs='$image1' WHERE question_id='$question_id'";
}
else if($answer == "option2"){
    $sql = "UPDATE tbl_questions SET question='$question',positive_mark = $pos, negative_mark = $neg, option1='$opt1', option2='$opt2', option3='$opt3', option4='$opt4', answer='$opt2', imgs='$image1' WHERE question_id='$question_id'";
    }
    else if($answer == "option3"){
        $sql = "UPDATE tbl_questions SET question='$question',positive_mark = $pos, negative_mark = $neg, option1='$opt1', option2='$opt2', option3='$opt3', option4='$opt4', answer='$opt3', imgs='$image1' WHERE question_id='$question_id'";
        }
        else if($answer == "option4"){
            $sql = "UPDATE tbl_questions SET question='$question',positive_mark = $pos, negative_mark = $neg, option1='$opt1', option2='$opt2', option3='$opt3', option4='$opt4', answer='$opt4', imgs='$image1' WHERE question_id='$question_id'";
            }
}
else{

   if($answer == "option1"){
$sql = "UPDATE tbl_questions SET question='$question',positive_mark = $pos, negative_mark = $neg, option1='$opt1', option2='$opt2', option3='$opt3', option4='$opt4', answer='$opt1'  WHERE question_id='$question_id'";
}
else if($answer == "option2"){
    $sql = "UPDATE tbl_questions SET question='$question',positive_mark = $pos, negative_mark = $neg, option1='$opt1', option2='$opt2', option3='$opt3', option4='$opt4', answer='$opt2' WHERE question_id='$question_id'";
    }
    else if($answer == "option3"){
        $sql = "UPDATE tbl_questions SET question='$question',positive_mark = $pos, negative_mark = $neg, option1='$opt1', option2='$opt2', option3='$opt3', option4='$opt4', answer='$opt3' WHERE question_id='$question_id'";
        }
        else if($answer == "option4"){
            $sql = "UPDATE tbl_questions SET question='$question',positive_mark = $pos, negative_mark = $neg, option1='$opt1', option2='$opt2', option3='$opt3', option4='$opt4', answer='$opt4' WHERE question_id='$question_id'";
            }
}
if ($conn->query($sql) === TRUE) {
    header("location:../edit-question.php?rp=7823&id=$question_id");	
} else {
 header("location:../edit-question.php?rp=1298&id=$question_id");	
}

}


}else if($question_type == "fib") {

$sql = "SELECT * FROM tbl_questions WHERE exam_id = '$examid' AND question = '$question' AND question_id != '$question_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
 header("location:../edit-question.php?rp=1185&id=$question_id");
    }
} else {
	

$sql = "UPDATE tbl_questions SET question='$question',positive_mark = $pos, negative_mark = $neg, answer='$answer' WHERE question_id='$question_id'";

if ($conn->query($sql) === TRUE) {
    header("location:../edit-question.php?rp=7823&id=$question_id");	
} else {
 header("location:../edit-question.php?rp=1298&id=$question_id");	
}


}


}else{
	
}
	
}else{
	

	
}


?>