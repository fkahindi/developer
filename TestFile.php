<?php
require_once __DIR__ . '/includes/DbConnection.php';

	function getUserById($id){
		global $conn;
		$sql = "SELECT user_id, username, profile_photo FROM `users` WHERE user_id=$id";
		
		$result =$conn->query($sql);
		if($result->num_rows>0){
			$row = $result->fetch_assoc();
		
			return $row;
		}else{
			echo '0 records';
		}
		
	}
$row =getUserById(2);
echo $row['username']. '<br>';
echo $row['profile_photo']. '<br>';

function getAllPostComments($page_id){
		global $conn;
		//Get all comments related to a particular post and display them on the page of the post 
		$sql = "SELECT * FROM `comments` WHERE post_id = $page_id ORDER BY created_at DESC";
		$query_result = $conn->query($sql);
		if($query_result->num_rows>0){
			$comments = $query_result->fetch_assoc();
			return $comments;
		}else{
			echo '0 comments';
		}
		
	}
$result = getAllPostComments(2);
foreach($result as $comment){
	echo $comment['comment_id'];
} 