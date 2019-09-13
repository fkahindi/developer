<?php
require_once __DIR__ . '/DbCredentials.php';
$conn = mysqli_connect($servername, $username,$password,$dbname);
	if(!$conn){
		die('Could not connect: ' . mysqli_connect($con));
	}