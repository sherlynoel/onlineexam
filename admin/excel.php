<?php  
//  echo $_POST["data"];
 header('Content-Type: application/xls');  
 header('Content-disposition: attachment; filename='.rand().'.xls');
 echo $_GET["data"];  
//  echo $_GET["data"];  
 ?>  