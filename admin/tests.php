<?php
session_start();
//include __DIR__ .'/includes/admin_functions.php';
//include __DIR__ .'/includes/posts_functions.php';
include __DIR__ .'/../../includes_devspot/DbConnection.php';

function search($search_term){
	global $conn;
	//$sql = "SELECT * FROM posts WHERE MATCH(post_title, post_body) AGAINST('$search_term')";
	$sql = "SELECT * FROM posts WHERE post_title LIKE '%$search_term%' OR post_body LIKE '%$search_term%'";
	$result = mysqli_query($conn, $sql);
	if($result){
		$term = mysqli_fetch_assoc($result);
	
		foreach($term as $row ){
			echo htmlspecialchars_decode($row['post_title']);
		}
	}else{
		echo 'No results';
	}
	
}
 
search($_POST['search_term']);