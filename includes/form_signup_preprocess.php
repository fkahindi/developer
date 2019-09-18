<?php 
require_once __DIR__ .'/DbConnection.php';
  if (isset($_POST['username_check'])) {
  	$username = $_POST['username'];
  	$sql = "SELECT username FROM users WHERE username='$username'";
  	$results = mysqli_query($conn, $sql);
  	if (mysqli_num_rows($results) > 0) {
  	  echo "taken";	
  	}else{
  	  echo 'not_taken';
  	}
  	exit();
  }
  if (isset($_POST['email_check'])) {
  	$email = $_POST['email'];
  	$sql = "SELECT email FROM users WHERE email='$email'";
  	$results = mysqli_query($conn, $sql);
  	if (mysqli_num_rows($results) > 0) {
  	  echo "taken";	
  	}else{
  	  echo 'not_taken';
  	}
  	exit();
  }


?>
