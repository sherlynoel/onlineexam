<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
	
	$myusrid = $_SESSION['user_id'];
	$mydepartment = $_SESSION['department'];
}else{
	header("location:../?rp=9422");
}

?>