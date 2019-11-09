<?php
	//global $page_id;

	require_once __DIR__ .'/DbConnection.php';
	//$page_id = $posts['post_id'];
	//Get post by post_id represented by page_id
	
	function getAllPostComments($page_id){
		global $conn, $page_id;
		//Get all comments related to a particular post and display them on the page of the post 
		$sql = "SELECT * FROM `comments` WHERE post_id = ? ORDER BY created_at DESC";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('i',$page_id);
		$comm_id =0;
		$user_id =0;
		$post_id =0;
		$comm='';
		$created='';
		$updated='';
		$stmt->bind_result($comm_id,$user_id,$post_id,$comm,$created,$updated);
		$stmt->execute();
		$comments=$stmt->fetch();
	}
	//Get users by id

	function getUserById($id){
		global $conn;
		$sql = "SELECT user_id, username, profile_photo FROM `users` WHERE user_id=?";
		
		$stmt =$conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$user_id =0;
		$username ='';
		$profile_photo ='';
		$stmt->bind_result($user_id,$username,$profile_photo);
		$result = $stmt->execute();
		if($result->num_rows>0){
			$row = $result->fetch();
		
			return $row;
		}else{
			echo '0 records';
		}
		
	}
	//Getting replies by comment_id
	function getRepliesByCommentId($id){
		global $conn;
		$sql = "SELECT * FROM `replies` WHERE comment_id =?";
		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$reply_id =0;
		$user_id =0;
		$comment_id =0;
		$body ='';
		$created ='';
		$updated ='';
		$tmt->bind_result($reply_id,$reply_id,$comment_id,$body,$created,$updated );
		$result=$stmt->execute();
		if($result->num_rows>0){
			$replies = $result->fetch();
			
			return $replies;
		}else{
			echo '0 replies';
		}
		
	}
	//Take page id and retrieve number of comments 
	function getCommentCountByPostId($id){
		global $conn;
		$query="SELECT COUNT(*) AS total FROM comments WHERE post_id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$total =0;
		$stmt->bind_result($total);
		$stmt->execute();
		$data=$stmt->fetch();
		
		return $data['total'];
		
	}
	
	//Receives values from jQuery for posting comments	
	if(isset($_POST['submit_comment'])){
		$user_id = $_POST['user_id']; 
		$page_id = $_POST['page_id'];
		$body = htmlspecialchars($_POST['body']);
		$body = mysqli_real_escape_string($conn, $body);
		
		$sql = "INSERT INTO `comments` (user_id, post_id, body, created_at) VALUES (?, ?, ?, ? )";
		$stmt = $conn->prepare($sql);
		
		$stmt = bind_param("iiss",$user_id, $page_id, $body, now());
		//$stmt -> execute();
					
		if($stmt->execute()){
			$id = $stmt->insert_id;
			
			$query = "SELECT * FROM comments WHERE comment_id =?";

			$result = $conn->prepare($query);
			$result->bind_param('i',$id);
			$comm_id =0;
			$user_id =0;
			$post_id =0;
			$comm='';
			$created='';
			$updated='';
			$result->bind_result($comm_id,$user_id,$post_id,$comm,$created,$updated);
			
			if($result->num_rows>0){
				$comment = $result->fetch();
				
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
				
				
		$sql = "INSERT INTO `replies` (user_id, comment_id, body, created_at, updated_at) VALUES (? ,?, ?, ?, ? )";
		$stmt=$conn->prepare($sql);
		
		$stmt = bind_param("iisss",$user_id, $comment_id,$reply_text,now(), null);
				
		if($stmt->execute()){
			$insert_id =$stmt->insert_id;
			$query = "SELECT * FROM replies WHERE reply_id =?";
			$result=$conn->prepare($query);
			$result->bind_param('i',$insert_id);
			$reply_id =0;
			$user_id =0;
			$comment_id =0;
			$body ='';
			$created ='';
			$updated ='';
			$result->bind_result($reply_id,$reply_id,$comment_id,$body,$created,$updated );
			$result->execute($query);
			
			if($result->num_rows>0){
				$reply = $result->fetch();
				
				include __DIR__ . '/../comments/layout/replies_output.php';
			}else{
				echo "Error: ". $quety. '<br>'.$conn->error;
			}
		}else{
			echo "Error: ". $sql .'<br>'.$conn->error;
		}
	}