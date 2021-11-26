
<?php

date_default_timezone_set('Africa/Dar_es_salaam');
include '../database/config.php';
include '../includes/uniques.php';
include "../SimpleXLSX.php";

function insert_into_db($details, $conn) {
  
  // $question_id = 'QS-'.mt_rand(100000,999999).'';
  $qb_id = mysqli_real_escape_string($conn, $_POST["qb_id"]);
  $type =  mysqli_real_escape_string($conn, $details["type"]);
  $question = mysqli_real_escape_string($conn, $details["Question"]);
  $img = mysqli_real_escape_string($conn, $details["image"]);
  $difficulty = mysqli_real_escape_string($conn, $details["difficulty"]);
  $option1 = mysqli_real_escape_string($conn, $details["option1"]);
  $option2 = mysqli_real_escape_string($conn, $details["option2"]);
  $option3 = mysqli_real_escape_string($conn, $details["option3"]);
  $option4 = mysqli_real_escape_string($conn, $details["option4"]);
  $positive = mysqli_real_escape_string($conn, $details["positive_mark"]);
  $negative = mysqli_real_escape_string($conn, $details["negative_mark"]);
  $answer = mysqli_real_escape_string($conn, $details["answer"]);

$negative = 0-$negative;
  // echo $question_id."<br>".$img."<br>".$type."<br>".$difficulty."<br>".$option1."<br>".$option2."<br>".$option3."<br>".$option4."<br>".$positive."<br>".$negative."<br>".$answer."<br>" ;


  $sql = "SELECT * FROM tbl_questions WHERE question = '$question';";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
      
      $sem = $row['question'];
      
      if ($sem == $question) {

          header("location: add-questions.php");
  
      }
    }
  }
  else
  {
    


    $mysql = "INSERT INTO tbl_questions ( qb_id,type, question, img, difficulty, option1, option2, option3, option4, positive_mark, negative_mark, answer) VALUES ( '$qb_id','$type', '$question', '$img','$difficulty', '$option1','$option2','$option3','$option4', '$positive', '$negative', '$answer');";
//echo $mysql;
    if ($conn->query($mysql) === TRUE) 
    { 
     header("location: add-questions.php");
    }
    else {
     header("location:index.php?rp=9157");
    }
  }

}


if (isset( $_POST['submit'])) {

  

  if ( $xlsx = SimpleXLSX::parse($_FILES['file']['tmp_name']) ) {
    
    // echo '<table><tbody>';
    
    $i = 0;
    list( $num_cols, $num_rows) = $xlsx->dimension();

    
    
    
    foreach ($xlsx->rows() as $instance) {
      
      if ($i <= 7) {
        
        if($num_cols != 11){
          echo "Error: Column mismatch";
          return 1;
        }

      } else {
        
        $details= array("Question"=>"", "image"=>"","type"=>"","difficulty"=>"","option1"=>"", "option2"=>"","option3"=>"", "option4"=>"", "positive_mark"=>"", "negative_mark"=>"", "answer"=>"");
        
        $cell = 0;
  
        foreach($details as $field => $val){
          
          if($instance[$cell] != ""  || $field =="image" || $field =="negative_mark"){
            
            $details[$field] = $instance[$cell];
          }
          else{
            //$i+=1;
           $cell+=1;
            echo "Missing values at Row".$i."Column :".$cell;
            return 1;
          }
          $cell+=1;
          
        }

        insert_into_db($details, $conn);
        
      }      

      $i++;
    }

    // echo "</tbody></table>";

  } else {
    
    echo SimpleXLSX::parseError();
  
  }

}else{
  echo "Error";
}
?>