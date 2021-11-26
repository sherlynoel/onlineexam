<?php 
include '../database/config.php';
if (isset($_GET['eid'])) {
    $exam_id = $_GET['eid'];
    $sql = "SELECT * FROM tbl_assessment_records WHERE exam_name = '$exam_id'";
    $result = $conn->query($sql);
    
    if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                    <th>Time Stamp</th> 
                    <th>Course</th>
                         <th>Batch</th>
                         <th>Department</th>
                         <th>Semester-Section</th>

                         <th>Exam Name</th>
                         <th>USN</th>
                         <th>Student Name</th> 
                         <th>Email</th>
			 
                         
             
                        <th>Score</th>
                        <th>Status</th>
             <th>correct Answer</th>
             <th>Total question</th>
		
                        
                    </tr>
  ';
     while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
    <td>'.$row['date'].'</td> 
    <td>'.$row['course'].'</td>
                        <td>'.$row['batch'].'</td>
                        <td>'.$row['department'].'</td>
                        <td>'.$row['sem_sec'].'</td>

                         <td>'.$row['exam_name'].'</td>  
                         <td>'.$row['usn'].'</td>
                         <td>'.$row['student_name'].'</td>  
                         <td>'.$row['email'].'</td> 
			
                        
            
       <td>'.$row['score'].'</td>  
       <td>'.$row['final_status'].'</td>
         <td>'.$row['c_ans'].'</td>
         <td>'.$row['total_question'].'</td>
       
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
