<?php  

date_default_timezone_set('Africa/Dar_es_salaam');
include 'database/config.php';
include 'includes/uniques.php';

$input = filter_input_array(INPUT_POST);
$first_name = ucwords(mysqli_real_escape_string($conn, $input["first_name"]));
$last_name = ucwords(mysqli_real_escape_string($conn, $input["last_name"]));
$sem_sec = mysqli_real_escape_string($conn, $input["sem_sec"]);
$usn = mysqli_real_escape_string($conn, $input["usn"]);
$email = mysqli_real_escape_string($conn, $input["email"]);
$department = mysqli_real_escape_string($conn, $input["department"]);

$number = 15;
if($input["action"] === 'edit')
{
 $query = "
 UPDATE `tbl_users` 
 SET first_name = '".$first_name."', 
 last_name = '".$last_name."', 
 sem_sec = '".$sem_sec."', 
 usn = '".$usn."',
 department = '".$department."',
 email = '".$email."'
 WHERE first_name = '".$first_name."'
 ";

 mysqli_query($conn, $query);
}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM `tbl_users`
 WHERE first_name = '".$input["first_name"]."'
 ";
 mysqli_query($conn, $query);
}
echo json_encode($input);

?>
