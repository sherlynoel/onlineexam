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
                         
                         <th>Department</th>
             <th>USN</th>
                         <th>Exam Name</th>
                        <th>Score</th>
                        <th>Status</th>
                    </tr>
  ';
     while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row['student_name'].'</td>  
                         
                        <td>'.$row['department'].'</td>
            <td>'.$row['usn'].'</td>
                         <td>'.$row['exam_name'].'</td>  
       <td>'.$row['final_score'].'</td>  
       <td>'.$row['final_status'].'</td>
       
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
