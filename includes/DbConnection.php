<?php
$conn = mysqli_connect('localhost', 'spex_db_user_member','AQD8Z0jHlUJypnKf','spex_db');
	if(!$conn){
		die('Could not connect: ' . mysqli_connect($con));
	}