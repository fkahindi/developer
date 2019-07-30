<?php
	
	$con = mysqli_connect('localhost', 'spex_db_user_member','AQD8Z0jHlUJypnKf','spex_db');
	if(!$con){
		die('Could not connect: ' . mysqli_connect($con));
	}

	//Get all posts from posts with id =1 (currently)

	$sql ='SELECT * from `posts` WHERE post_id=1';
	$result = mysqli_query($con, $sql);
	if($result){
		$posts = mysqli_fetch_assoc($result);
	}else{
		echo 'Error' .$sql. '<br>' .mysqli_error($con);
	}

	//Get all comments from database with post_id =1 (at the moment)
	$query = 'SELECT * FROM `comments` WHERE post_id = 1 ORDER BY created_at DESC';
	$query_result = mysqli_query($con, $query);
	if($query_result){
		$comments = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
	}else{
		echo 'Error'.$query.'<br>'.mysqli_error($con);
	}

	//Get users by id

	function getUserById($id){
		global $con;
		$query = 'SELECT user_id, username, profile_photo FROM `users` WHERE user_id='.$id;
		
		$result =mysqli_query($con, $query);
		if($result){
			$row = mysqli_fetch_assoc($result);
		
			return $row;
		}else{
			echo 'Error'.$query.'<br>'.mysqli_error($con);
		}
	}
	//Getting replies by commeni id
	function getRepliesByCommentId($id){
		global $con;
		$sql = 'SELECT * FROM `replies` WHERE comment_id ='.$id;
		
		$result = mysqli_query($con, $sql);
		if($result){
			$replies = mysqli_fetch_all($result, MYSQLI_ASSOC);
			
			return $replies;
		}else{
			echo 'Error'.$sql.'<br>'.mysqli_error($con);
		}
		
	}
	
	function getCommentCountByPostId($id){
		global $con;
		$result = mysqli_query($con, 'SELECT COUNT(*) AS total FROM comments WHERE post_id='.$id);
		$data = mysqli_fetch_assoc($result);
		
		return $data['total'];
	}
	
	//Receives values from jQuery for posting comments	
	if(isset($_POST['submit_comment'])){
		$user_id = $_POST['user_id']; 
		$body = htmlspecialchars($_POST['body']);
		$body = mysqli_real_escape_string($con, $body);

		$sql = 'INSERT INTO `comments` (user_id, post_id, body, created_at) VALUES ('.$user_id .', 1, "'. $body .'", now() )';

		mysqli_query($con, $sql);

		$id = mysqli_insert_id($con);

			
		if($id){
			$query = 'SELECT * FROM comments WHERE comment_id =' .$id;

			$select = mysqli_query($con, $query);
			
			if($select){
				$comment = mysqli_fetch_assoc($select);
				
				include __DIR__ . '/../comments/layout/comments_output.php';
			}else{
				echo "Error: ". mysqli_error($con);
			}
		}else{
			echo "Error: ". mysqli_error($con);
		}
	}
	
	//Receives from jQuery for posting replies
	if(isset($_POST['submit_reply'])){
		$comment_id = $_POST['comment_id']; 
		$user_id = $_POST['user_id'];
		$reply_text = htmlspecialchars($_POST['reply_text']);
		$reply_text = mysqli_real_escape_string($con, $reply_text);
				
		$sql = 'INSERT INTO `replies` (user_id, comment_id, body, created_at, updated_at) VALUES ('.$user_id .','. $comment_id . ', "'. $reply_text .'", now(), null )';

		mysqli_query($con, $sql);

		$insert_id = mysqli_insert_id($con);

			
		if($insert_id){
			$query = 'SELECT * FROM replies WHERE reply_id ='.$insert_id;

			$select = mysqli_query($con, $query);
			
			if($select){
				$reply = mysqli_fetch_assoc($select);
				
				include __DIR__ . '/../comments/layout/replies_output.php';
			}else{
				echo "Error: ". mysqli_error($con);
			}
		}else{
			echo "Error: ". mysqli_error($con);
		}
	}