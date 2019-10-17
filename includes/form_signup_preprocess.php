<?php 
require_once __DIR__ .'/DbConnection.php';
  if (isset($_POST['username_check'])) {
  	$username = $_POST['username'];
  	$sql = "SELECT username FROM users WHERE username='$username'";
  	$results = $conn->query($sql);
  	if ($results->num_rows > 0) {
  	  echo "taken";	
  	}else{
  	  echo 'not_taken';
  	}
  	exit();
  }
  if (isset($_POST['email_check'])) {
  	$email = $_POST['email'];
  	$sql = "SELECT email FROM users WHERE email='$email'";
  	$results = $conn->query($sql);
  	if ($results->num_rows > 0) {
  	  echo "taken";	
  	}else{
  	  echo 'not_taken';
  	}
  	exit();
  }
