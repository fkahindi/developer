<?php
	//global $page_id;

	require_once __DIR__ .'/DbConnection.php';
	//$page_id = $posts['post_id'];
	//Get post by post_id represented by page_id
	/*
	$sql ="SELECT * from `posts` WHERE post_id = $page_id";
	$result = mysqli_query($conn, $sql);
	if($result){
		$posts = mysqli_fetch_assoc($result);
	}else{
		echo 'Error' .$sql. '<br>' .mysqli_error($conn);
	}
*/
	function getAllPostComments($page_id){
		global $conn, $page_id;
		//Get all comments related to a particular post and display them on the page of the post 
		$query = "SELECT * FROM `comments` WHERE post_id = $page_id ORDER BY created_at DESC";
		$query_result = mysqli_query($conn, $query);
		if($query_result){
			$comments = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
			return $comments;
		}else{
			echo 'Error'.$query.'<br>'.mysqli_error($conn);
		}
		
	}
	//Get users by id

	function getUserById($id){
		global $conn;
		$query = "SELECT user_id, username, profile_photo FROM `users` WHERE user_id=$id";
		
		$result =mysqli_query($conn, $query);
		if($result){
			$row = mysqli_fetch_assoc($result);
		
			return $row;
		}else{
			echo 'Error'.$query.'<br>'.mysqli_error($conn);
		}
		
	}
	//Getting replies by comment_id
	function getRepliesByCommentId($id){
		global $conn;
		$sql = "SELECT * FROM `replies` WHERE comment_id =$id";
		
		$result = mysqli_query($conn, $sql);
		if($result){
			$replies = mysqli_fetch_all($result, MYSQLI_ASSOC);
			
			return $replies;
		}else{
			echo 'Error'.$sql.'<br>'.mysqli_error($conn);
		}
		
	}
	
	function getCommentCountByPostId($id){
		global $conn;
		$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM comments WHERE post_id=$id");
		$data = mysqli_fetch_assoc($result);
		
		return $data['total'];
		
	}
	
	//Receives values from jQuery for posting comments	
	if(isset($_POST['submit_comment'])){
		$user_id = $_POST['user_id']; 
		$page_id = $_POST['page_id'];
		$body = htmlspecialchars($_POST['body']);
		$body = mysqli_real_escape_string($conn, $body);
		
		$sql = "INSERT INTO `comments` (user_id, post_id, body, created_at) VALUES ($user_id, $page_id, '$body', now() )";

		mysqli_query($conn, $sql);

		$id = mysqli_insert_id($conn);

			
		if($id){
			$query = "SELECT * FROM comments WHERE comment_id =$id";

			$select = mysqli_query($conn, $query);
			
			if($select){
				$comment = mysqli_fetch_assoc($select);
				
				include __DIR__ . '/../comments/layout/comments_output.php';
			}else{
				echo "Error: ". mysqli_error($conn);
			}
		}else{
			echo "Error: ". mysqli_error($conn);
		}
	
	}
	
	//Receives from jQuery for posting replies
	if(isset($_POST['submit_reply'])){
		$comment_id = $_POST['comment_id']; 
		$user_id = $_POST['user_id'];
		$reply_text = htmlspecialchars($_POST['reply_text']);
		$reply_text = mysqli_real_escape_string($conn, $reply_text);
				
		$sql = "INSERT INTO `replies` (user_id, comment_id, body, created_at, updated_at) VALUES ($user_id ,$comment_id, '$reply_text', now(), null )";

		mysqli_query($conn, $sql);

		$insert_id = mysqli_insert_id($conn);

			
		if($insert_id){
			$query = "SELECT * FROM replies WHERE reply_id =$insert_id";

			$select = mysqli_query($conn, $query);
			
			if($select){
				$reply = mysqli_fetch_assoc($select);
				
				include __DIR__ . '/../comments/layout/replies_output.php';
			}else{
				echo "Error: ". mysqli_error($conn);
			}
		}else{
			echo "Error: ". mysqli_error($conn);
		}
	}