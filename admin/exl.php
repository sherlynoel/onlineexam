<?php 
include '../database/config.php';
if (isset($_GET['eid'])) {
    $exam_id = $_GET['eid'];
    $sql = "SELECT * FROM tbl_assessment_records WHERE exam_id = '$exam_id'";
    $result = $conn->query($sql);
    
    if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Student Name</th>  
                         
                         <th>Student ID</th>
			 <th>SemesterSection</th>
			<th>USN</th>
                         <th>Exam Name</th>
                        <th>Score</th>
                        <th>Status</th>
             <th>correct Answer</th>
             <th>Total question</th>
			<th>Date</th>
			<th>RE Exam</th>
                        
                    </tr>
  ';
     while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row['student_name'].'</td>  
                         <td>'.$row['student_id'].'</td> 
			<td>'.$row['sem'].'</td>
			<td>'.$row['sec'].'</td> 
                         <td>'.$row['exam_name'].'</td>  
       <td>'.$row['score'].'</td>  
       <td>'.$row['status'].'</td>
         <td>'.$row['c_ans'].'</td>
         <td>'.$row['total_question'].'</td>
        <td>'.$row['date'].'</td>
	<td>'.$row['next_retake'].'</td>
                    </tr>
   ';
  }
  $output .= '</table>';
 
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}

    
?>
