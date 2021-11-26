<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';

if (isset($_GET['qid'])) {
include '../database/config.php';
$qb_id = mysqli_real_escape_string($conn, $_GET['qid']);	


$sql = "SELECT * FROM tbl_qb WHERE qb_id = '$qb_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
$qb_name =$row['qb_name'];
}
if(isset($_GET['submit'])){

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


    <title>GATE | View Question Bank</title>

  
</head>

<body >
	<div style='margin-left: 10px;'>

                                    <h1><strong><?php echo "$qb_name"?></strong></h1>

                                    <?php 
include '../database/config.php';
												
$sql = "SELECT * FROM tbl_questions WHERE qb_id = '$qb_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$tot_q = $result->num_rows;
echo '<div><h3><b>Total Questions : </b>'.$tot_q.'</h3>

<a'; ?> onclick = "return confirm('Drop <?php echo "$qb_name" ?> ?')" <?php print ' href="pages/delete_qb.php?id='.$qb_id.'"></a><br><hr>';
$qno = 1;
while($row = $result->fetch_assoc()) {
$qs = $row['question'];
$type = $row['type'];

$op1 = $row['option1'];
$op2 = $row['option2'];
$op3 = $row['option3'];
$op4 = $row['option4'];
$imgs = $row['img'];
$posmarks = $row['positive_mark'];
$neg = $row['negative_mark'];
$ans = $row['answer'];

if ($type == "FB") {
if ($qno == "1") {
print '
<div>


<p> Question Number: <b>'.$qno.'.</b><p><b> Positive Marks: </b>'.(htmlentities($posmarks)).'
<b> Negatives Marks:</b> '.(htmlentities($neg)).'</p></div><br> Question: '.nl2br(htmlentities($qs), false).'<br> Answer: '.nl2br(htmlentities($ans), false).'</p>';

                                          if( $imgs == NULL){ }else{
print '<center><img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" style="top:0px;width:300px;height:300px"/></center>';
}print '

<hr>

</div>
';	
}else{
print '
<div>

<p>Question Number: <b>'.$qno.'.</b> <p><b>Positive Marks: </b>'.(htmlentities($posmarks)).'
<b>Negatives Marks:</b> '.(htmlentities($neg)).'</p></div> <br>Question: '.nl2br(htmlentities($qs), false).'<br>Answer: '.nl2br(htmlentities($ans), false).'</p>';
                                          if( $imgs == NULL){ }else{
print '<center><img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" style="top:0px;width:300px;height:300px"/></center>';
}print '

<hr>
</div>
';		
}

$qno = $qno + 1;	
}else{

if ($qno == "1") {

print '
<div>

<p><b> Question Number: </b> '.$qno.'</p><b> Positive Marks: </b>'.(htmlentities($posmarks)).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> Negative Marks:</b> '.(htmlentities($neg)).'<br><br><b> Question :</b>'.nl2br(htmlentities($qs)).'</p>';
                                        if( $imgs == NULL){ }else{
print '<center><img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" style="overflow:scroll"/></center>';
}print '
<p>1) '.htmlentities($op1).'</p>
<p>2) '.htmlentities($op2).'</p>
<p>3) '.htmlentities($op3).'</p>
<p>4) '.htmlentities($op4).'</p>
<p><span style="font-size: 10pt;white-space:pre"><b>Answer option is : </b> '.(htmlentities($ans)).'<span></p>
<hr>
</div>
';	
}else{
print '
<div>

<br>
<br>
<p><b>QNo:</b>'.$qno.'.</b><br><b>Positive Marks: </b>'.(htmlentities($posmarks)).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Negative Marks:</b> '.(htmlentities($neg)).'<br><b>Question :</b>  '.nl2br(htmlentities($qs)).'</p>';
                                          if( $imgs == NULL){ }else{
print '<center><img src="data:image/jpeg;base64,'.base64_encode($imgs).'" class="img-responsive" alt="error" style="overflow:scroll"/></center>';
}print '
<p>1) '.htmlentities($op1).'</p>
<p>2) '.htmlentities($op2).'</p>
<p>3) '.htmlentities($op3).'</p>
<p>4) '.htmlentities($op4).'</p>
<p><span style="font-size: 10pt;white-space:pre"><b>Answer option is : </b> '.(htmlentities($ans)).'<span></p>
<hr>
</div>
';		
}

$qno = $qno + 1;	


}

}
} else {
    echo '<div><h3><b>Total Questions : 0</h3>
    <a href="add-questions-1.php?qid='.$qb_id.'"><button type="button" class = "btn btn-primary">Add questions</button></a><br><br>
    <a'; ?> onclick = "return confirm('Drop <?php echo "$qb_name" ?> ?')" <?php print ' href="pages/delete_qb.php?id='.$qb_id.'"><button type="button" class = "btn btn-danger">Delete Question Bank</button></a><br><hr>';
}

?>

   


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
        function myFunction() {
            var x = document.getElementById("snackbar")
            x.className = "show";
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);
        }
    </script>
</div>
</body>

</html>