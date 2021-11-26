<?php

date_default_timezone_set('Africa/Dar_es_salaam');
include '../database/config.php';



if (isset( $_GET['eid'])) {
  
  $exam_id = $_GET['eid'];
  
  $sql = 'SELECT DISTINCT q_id,question FROM `tbl_report` WHERE exam_id = "'.$exam_id.'"';
  $result = $conn->query($sql);
  
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
                        <th>Score</th>
                        <th>Status</th>
                        <th>Correct Answer</th>
                        <th>Total question</th>
                    ';


      $sql = 'SELECT DISTINCT q_id,question FROM `tbl_report` WHERE exam_id = "'.$exam_id.'"'; //max count - exam_name
          
      $result = $conn->query($sql);
      $q_order = array();

      if($result!="null"){

        while($row = mysqli_fetch_array($result)){

          $output .= '<th>'.$row['question'].'</th>';
          array_push($q_order,$row['q_id'] );
        }
        $output .= '</tr>';
      }

      $sql = 'Select * from tbl_assessment_records where exam_id = "'.$exam_id.'"';
      
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
              <td>'.$row['score'].'</td>  
              <td>'.$row['exam_status'].'</td>
              <td>'.$row['c_ans'].'</td>
              <td>'.$row['total_question'].'</td>
          ';

          $sql_inner = 'select q_id, response from tbl_report where user_id = "'.$user_id.'" and exam_id = "'.$exam_id.'"';
          $result_inner = $conn->query($sql_inner);
          $q_id_array = array();
          
          while($row_inner = $result_inner->fetch_assoc())
          {
            $q_id_array[$row_inner["q_id"]] =  $row_inner["response"];
          }

          foreach ($q_order as $val) {
            $output .= '<td>'.$q_id_array[$val].'</td>';
          } 
          $output .= '</tr>';
        
    }
      
      $output .= '</table>';
      // header('Content-Type: application/xls');
      header('Content-Disposition: attachment; filename=download '.$exam_id.'.xls');
      echo $output;
    
}

    
?>