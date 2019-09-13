<?php
	//global $page_id;

	require_once __DIR__ .'/DbConnection.php';
	//$page_id = $posts['post_id'];
	//Get post by post_id represented by page_id
	
	function getAllPostComments($page_id){
		global $conn, $page_id;
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
	//Get users by id

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
	//Getting replies by comment_id
	function getRepliesByCommentId($id){
		global $conn;
		$sql = "SELECT * FROM `replies` WHERE comment_id =$id";
		
		$result = $conn->query($sql);
		if($result->num_rows>0){
			$replies = $result->fetch_assoc();
			
			return $replies;
		}else{
			echo '0 replies';
		}
		
	}
	
	function getCommentCountByPostId($id){
		global $conn;
		$result = $conn->query("SELECT COUNT(*) AS total FROM comments WHERE post_id=$id");
		$data = $result->fetch_assoc();
		
		return $data['total'];
		
	}
	
	//Receives values from jQuery for posting comments	
	if(isset($_POST['submit_comment'])){
		$user_id = $_POST['user_id']; 
		$page_id = $_POST['page_id'];
		$body = htmlspecialchars($_POST['body']);
		$body = mysqli_real_escape_string($conn, $body);
		
		//$sql = "INSERT INTO `comments` (user_id, post_id, body, created_at) VALUES ($user_id, $page_id, '$body', now() )";
		$sql = "INSERT INTO `comments` (user_id, post_id, body, created_at) VALUES (?, ?, ?, ? )";
		$stmt = $conn->prepare($sql);
		
		$stmt = bind_param("i,i,s,s",$user_id, $page_id, $body, now());
		//$stmt -> execute();
		//mysqli_query($conn, $sql);

		//$id = mysqli_insert_id($conn);

			
		if($stmt->execute()=== true){
			$id = $conn->insert-id;
			
			$query = "SELECT * FROM comments WHERE comment_id =$id";

			$select = $conn->query($query);
			
			if($select->num_rows>0){
				$comment = $select->fetch_assoc;
				
				include __DIR__ . '/../comments/layout/comments_output.php';
			}else{
				echo "Error: ". $query. '<br>'. $conn->error;
			}
		}else{
			echo "Error: ". $sql. '<br>'. $conn->error;
		}
	
	}
	
	//Receives from jQuery for posting replies
	if(isset($_POST['submit_reply'])){
		$comment_id = $_POST['comment_id']; 
		$user_id = $_POST['user_id'];
		$reply_text = htmlspecialchars($_POST['reply_text']);
		$reply_text = mysqli_real_escape_string($conn, $reply_text);
				
		//$sql = "INSERT INTO `replies` (user_id, comment_id, body, created_at, updated_at) VALUES ($user_id ,$comment_id, '$reply_text', now(), null )";
		
		$sql = "INSERT INTO `replies` (user_id, comment_id, body, created_at, updated_at) VALUES (? ,?, ?, ?, ? )";
		$stmt=$conn->prepare($sql);
		
		$stmt = bind_param("i,i,s,s,s",$user_id, $comment_id,$reply_text,now(), null);
		
		
		//mysqli_query($conn, $sql);

		//$insert_id = mysqli_insert_id($conn);

			
		if($stmt->execute()=== true){
			$insert_id =$conn->insert-id;
			$query = "SELECT * FROM replies WHERE reply_id =$insert_id";

			$select = $conn->query($query);
			
			if($select->num_rows>0){
				$reply = $select->fetch_assoc;
				
				include __DIR__ . '/../comments/layout/replies_output.php';
			}else{
				echo "Error: ". $quety. '<br>'.$conn->error;
			}
		}else{
			echo "Error: ". $sql .'<br>'.$conn->error;
		}
	}