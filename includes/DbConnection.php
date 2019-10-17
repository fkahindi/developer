<?php
require_once __DIR__ . '/DbCredentials.php';
//Create connection
$conn = new mysqli($server_name, $user_name,$db_password,$db_name);
	//Check connection
	if($conn->connect_error){
		die('Could not connect: ' .$conn->connect_error);
	}