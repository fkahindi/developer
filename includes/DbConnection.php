<?php
require_once __DIR__ . '/DbCredentials.php';
$conn = mysqli_connect($server_name, $user_name,$db_password,$db_name);
	if(!$conn){
		die('Could not connect: ' . mysqli_connect($con));
	}