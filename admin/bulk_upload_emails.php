<?php

date_default_timezone_set('Africa/Dar_es_salaam');
include '../database/config.php';
include '../includes/uniques.php';
include "../SimpleXLSX.php";

$NUM_OF_COLS = 1;


function insert_into_db($details, $conn) {
  
  
  $email = mysqli_real_escape_string($conn, $details["email"]);
  

  
  
  
  

  // echo $student_id."<br>".$fname."<br>".$lname."<br>".$sem."<br>".$email."<br>".$phone."<br>".$pass."<br>".$repass."<br>".$department."<br>".$sec."<br>".$gender."<br>".$semSection."<br>" ;


  $sql = "SELECT * FROM tbl_org WHERE email = '$email'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
      
      $sem = $row['email'];
      
      if ($sem == $email) {

          header("location: students.php");
  
      }
    }
  }
  else
  {

    
    $mysql = "INSERT INTO tbl_org (email) VALUES ('$email')";
    

    if ($conn->query($mysql) === TRUE) 
    { 
      header("location: students.php");
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
      
      if ($i <= 3) {
        
        if($num_cols != $NUM_OF_COLS){
          echo "Error: Unequal nunber of columns (".$NUM_OF_COLS." columns required)";
          return 1;
        }

      } else {
        
        $details= array( "email"=>"",);
        
        $cell = 0;
  
        foreach($details as $field => $val){
          
          if(($instance[$cell] != "" || $instance[$cell] != 0) || $field =="lname"){
            
            $details[$field] = $instance[$cell];

          }
          else{
            $i+=1;
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