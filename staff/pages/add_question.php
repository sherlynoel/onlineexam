<?php
  include '../../database/config.php';
  include '../../includes/uniques.php';
  $qbid = mysqli_real_escape_string($conn, $_POST['qb_id']);
  // $question_id = 'QS-'.mt_rand(100000,999999).'';
  $question = mysqli_real_escape_string($conn, $_POST['question']);
  $answer = mysqli_real_escape_string($conn, $_POST['answer']);
  $difficulty = mysqli_real_escape_string($conn, $_POST['difficulty']);

  $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
  $posmarks = mysqli_real_escape_string($conn, $_POST['marks']);
  $negmarks = 0;

  $question_type = mysqli_real_escape_string($conn, $_POST['type']);

  if($_POST['neg_marks']){
    $negmarks = mysqli_real_escape_string($conn, $_POST['neg_marks']);
    $negmarks= -$negmarks;
  }

  if (isset($_POST['type'])) {
    	
    if ($question_type == "MC") {
      

      $opt1 = mysqli_real_escape_string($conn, $_POST['opt1']);
      $opt2 = mysqli_real_escape_string($conn, $_POST['opt2']);
      $opt3 = mysqli_real_escape_string($conn, $_POST['opt3']);
      $opt4 = mysqli_real_escape_string($conn, $_POST['opt4']);

      // $sql = "SELECT * FROM tbl_questions WHERE exam_id = '$examid' AND question = '$question'";
      // $result = $conn->query($sql);

      // if ($result->num_rows > 0) {

      //     while($row = $result->fetch_assoc()) {
      //  	header("location:../add-questions.php?rp=1185&eid=$examid");
      //     }
      // } else {
        if($answer == "option1"){
          $sql = "INSERT INTO tbl_questions ( qb_id, type,  question, img , difficulty,option1, option2, option3, option4, positive_mark, negative_mark, answer)
          VALUES ('$qbid', 'MC', '$question', '$image', '$difficulty','$opt1', '$opt2', '$opt3', '$opt4', $posmarks, $negmarks,  '$opt1')";
    
          if ($conn->query($sql) === TRUE) {
            
            header("location:../add-questions-1.php?rp=0357&qid=$qbid");
    
          } else {
            
            header("location:../add-questions-1.php?rp=3903&qid=$qbid");	
          }
    
        }
        else if($answer == "option2"){
          $sql = "INSERT INTO tbl_questions ( qb_id, type,  question, img , difficulty,option1, option2, option3, option4, positive_mark, negative_mark, answer)
          VALUES ('$qbid', 'MC', '$question', '$image', '$difficulty','$opt1', '$opt2', '$opt3', '$opt4', $posmarks, $negmarks,  '$opt2')";
    
          if ($conn->query($sql) === TRUE) {
            
            header("location:../add-questions-1.php?rp=0357&qid=$qbid");
    
          } else {
            
            header("location:../add-questions-1.php?rp=3903&qid=$qbid");	
          }
    
        }
        else if($answer == "option3"){
          $sql = "INSERT INTO tbl_questions ( qb_id, type,  question, img , difficulty,option1, option2, option3, option4, positive_mark, negative_mark, answer)
          VALUES ('$qbid', 'MC', '$question', '$image', '$difficulty','$opt1', '$opt2', '$opt3', '$opt4', $posmarks, $negmarks,  '$opt3')";
    
          if ($conn->query($sql) === TRUE) {
            
            header("location:../add-questions-1.php?rp=0357&qid=$qbid");
    
          } else {
            
            header("location:../add-questions-1.php?rp=3903&qid=$qbid");	
          }
    
        }
        else{
          $sql = "INSERT INTO tbl_questions ( qb_id, type,  question, img , difficulty,option1, option2, option3, option4, positive_mark, negative_mark, answer)
          VALUES ('$qbid', 'MC', '$question', '$image', '$difficulty','$opt1', '$opt2', '$opt3', '$opt4', $posmarks, $negmarks,  '$opt4')";
    
          if ($conn->query($sql) === TRUE) {
            
            header("location:../add-questions-1.php?rp=0357&qid=$qbid");
    
          } else {
            
            header("location:../add-questions-1.php?rp=3903&qid=$qbid");	
          }
    
        }
      
      
    //}


    }else if($question_type == "FB") {
    // $sql = "SELECT * FROM tbl_questions WHERE exam_id = '$examid' AND question = '$question'";
    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) {

    //     while($row = $result->fetch_assoc()) {
    // header("location:../add-questions.php?rp=1185&eid=$examid");
    //     }
    // } else {

    $sql = "INSERT INTO tbl_questions ( qb_id, type, question, img, difficulty, positive_mark, negative_mark, answer)
    VALUES ( '$qbid', 'FB', '$question','$image','$difficulty', $posmarks, $negmarks, '$answer')";

    if ($conn->query($sql) === TRUE) {
      header("location:../add-questions-1.php?rp=0357&qid=$qbid");  	
    } else {
    header("location:../add-questions-1.php?rp=3903&qid=$qbid");
    }


    //}


    }else{
      
    }
    
  }else{
    echo $question_type;
    // header("location:./");	
    
  }


?>