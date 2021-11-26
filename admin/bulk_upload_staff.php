<?php

date_default_timezone_set('Africa/Dar_es_salaam');
include '../database/config.php';
include '../includes/uniques.php';
include "../SimpleXLSX.php";

$NUM_OF_COLS = 8;


function insert_into_db($details, $conn) {
  
  $student_id = 'F'.mt_rand(100,999).'-'.mt_rand(100,999).'-'.mt_rand(100,999).'';

  $fname = ucwords(mysqli_real_escape_string($conn, $details["fname"]));
  $lname = ucwords(mysqli_real_escape_string($conn, $details["lname"]));
  $gender = mysqli_real_escape_string($conn, $details["gender"]);
  $email = mysqli_real_escape_string($conn, $details["email"]);
  $sem = mysqli_real_escape_string($conn, $details["sem"]);
  $sec = mysqli_real_escape_string($conn, $details["sec"]);
  $usn = mysqli_real_escape_string($conn, $details["usn"]);
  $department = mysqli_real_escape_string($conn, $details["department"]);
  $phone = mysqli_real_escape_string($conn, $details["phone"]);
  $dob = mysqli_real_escape_string($conn, $details["dob"]);
  $batch = mysqli_real_escape_string($conn, $details["batch"]);
  $ug_pg = mysqli_real_escape_string($conn, $details["course"]);
  $DEFAULT_ROLE = "staff";

  // $pass = ""mysqli_real_escape_string($conn, $_SESSION['pass']);
  // $repass = mysqli_real_escape_string($conn, $_SESSION['repass']);
  $pass = "1234";
  
  
  $semSection=$sem."-".$sec;

  // echo $student_id."<br>".$fname."<br>".$lname."<br>".$sem."<br>".$email."<br>".$phone."<br>".$pass."<br>".$repass."<br>".$department."<br>".$sec."<br>".$gender."<br>".$semSection."<br>" ;


  $sql = "SELECT * FROM tbl_users WHERE email = '$email'";
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

    $new_password = md5($pass);
    $mysql1 = "INSERT INTO tbl_org (email) VALUES ('$email')";
    $conn->query($mysql1);

    $mysql = "INSERT INTO tbl_users (user_id, first_name, last_name, gender,  email,  department, phone,dob, course, login,role) VALUES ('$student_id', '$fname', '$lname', '$gender', '$email',  '$department', '$phone','$dob',  '$ug_pg', '$new_password','$DEFAULT_ROLE')";

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
        
        $details= array("fname"=>"", "lname"=>"", "gender"=>"", "email"=>"",  "phone"=>"","dob"=>"", "department"=>"",    "course"=>"",);
        
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