<?php

require_once __DIR__ .'/../includes/dbConnection.php';

$sql1 = "SELECT * FROM `posts`";
$query1 = mysqli_query($conn, $sql1);
if(!$query1){
	echo 'Error' . mysqli_error($conn);
}

while($row=mysqli_fetch_assoc($query1)){
	$sound ='';
	if($row['post_title'] != null){
		$words = explode(' ', $row['post_title']);
		foreach($words as $word){
			$sound .= metaphone($word).' ';
		}
	}
	if($row['post_body'] != null){
		$words = explode(' ', $row['post_body']);
		foreach($words as $word){
			$sound .= metaphone($word).' ';
		}
	}
	$id = $row['post_id'];
	$sql2 = "UPDATE `posts` SET metaphoned = '$sound' WHERE post_id = $id";
	$query2 = mysqli_query($conn, $sql2);
	if(!$query2){
		echo mysqli_error($conn);
	}
}
echo 'Metaphoned field has been updated';