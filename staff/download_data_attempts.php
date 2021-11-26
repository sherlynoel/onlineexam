<?php

date_default_timezone_set('Africa/Dar_es_salaam');
include '../database/config.php';



if (isset( $_GET['ex_name'])) {
  
  $exam_name = $_GET['ex_name'];
  
  $output .= '
  <table class="table" border="1">  
                    <tr>  
                        <th>Student Name</th> 
                        <th>Student ID</th>
                        <th>Semester-Section</th>
                        <th>Course</th>
                        <th>Batch</th>
                        <th>Department</th>
                        <th>USN</th>
                        <th>Exam Name</th>
                        <th>Highest Score</th>
                        <th>Overall Status</th>
                       
                    ';

    $sql = 'select distinct exam_id from tbl_assessment_records where exam_name = "'.$exam_name.'"';
    $result = $conn->query($sql);
    $count = mysqli_num_rows($result);
    
    $ex_id_order = array();
    $x=1;
    while($row = mysqli_fetch_array($result))
    {
        $output .= '<th>Attempt No. '.$x.'</th>';
        $output .= '<th>Attempt '.$x.' Status </th>';
        array_push($ex_id_order,$row['exam_id'] );
        $x++;
    }
    $output .= '</tr>';

    $sql = 'Select distinct student_name,student_id,sem_sec,course,batch,department,usn,exam_name,final_score,final_status from tbl_assessment_records where exam_name = "'.$exam_name.'"';
    $result = $conn->query($sql);
        
    while($row = mysqli_fetch_array($result))
    {

        $user_id = $row["student_id"];
        $output .= '
        <tr>  
            <td>'.$row['student_name'].'</td>  
            <td>'.$row['student_id'].'</td> 
            <td>'.$row['sem_sec'].'</td>
            <td>'.$row['course'].'</td>
            <td>'.$row['batch'].'</td>
            <td>'.$row['department'].'</td>
            <td>'.$row['usn'].'</td>
            <td>'.$row['exam_name'].'</td>  
            <td>'.$row['final_score'].'</td>  
            <td>'.$row['final_status'].'</td>
            
            
        ';

        $sql_inner = 'select score,exam_status, exam_id from tbl_assessment_records where student_id = "'.$user_id.'" and exam_name = "'.$exam_name.'"';
        
        $result_inner = $conn->query($sql_inner);
        $ex_scores_array = array();
        $ex_status_array = array();
        
        while($row_inner = $result_inner->fetch_assoc())
        {
            $ex_scores_array[$row_inner["exam_id"]] =  $row_inner["score"];
            $ex_status_array[$row_inner["exam_id"]] = $row_inner["exam_status"];
        }

        foreach ($ex_id_order as $val) {
            if(array_key_exists($val,$ex_scores_array)){
                $output .= '<td>'.$ex_scores_array[$val].'</td>';
                $output .= '<td>'.$ex_status_array[$val].'</td>';
            }
            else{
                $output .= '<td>NA</td>';
                $output .= '<td>NA</td>';
            }
        } 
        
        $output .= '</tr>';
        
    }
      
      $output .= '</table>';
      header('Content-Type: application/xls');
      header('Content-Disposition: attachment; filename=download.xls');
      echo $output;
    
}

    
?>