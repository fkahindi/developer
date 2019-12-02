<?php
include __DIR__ .'/DatabaseConnection.php';

//$page_id = $posts['post_id'];
//Get post by post_id represented by page_id

function getAllPostComments($page_id){
	global $pdo;
	
	//Get all comments related to a particular post and display them on the page of the post 
	$query = "SELECT * FROM `comments` WHERE `post_id` = :page_id ORDER BY created_at DESC";
	
	$stmt = $pdo->prepare($query);
	$stmt->bindValue(':page_id',$page_id);
	
	$stmt->execute();
			
	return $stmt->fetchAll();
}

//Get users by id

function getUserById($id){
	global $pdo;
	$query = "SELECT user_id, username, profile_photo FROM `users` WHERE user_id= :id";
	
	$sql=$pdo->prepare($query);
	$sql->bindValue(':id', $id);
	
	$sql->execute();
	
	return $sql->fetch();
}

//Getting replies by comment_id
function getRepliesByCommentId($id){
	global $pdo;
	$sql = "SELECT * FROM `replies` WHERE comment_id = :id ORDER BY created_at DESC";
	
	$query=$pdo->prepare($sql);
	$query->bindValue(':id', $id);
	
	$query->execute();
	
	return $query->fetchAll();
	
}

//Get number of comments in a page
function getCommentCountByPostId($id){
	global $pdo;
	$query = "SELECT COUNT(*) AS total FROM comments WHERE post_id= :id";
	
	$sql = $pdo->prepare($query);
	$sql->bindValue(':id', $id);
	$sql->execute();
	
	$total = $sql->fetch();
	return $total['total'];
		
}
 
//Receives values from jQuery for posting comments	
if(isset($_POST['submit_comment']) && $_POST['body']!==""){
	$user_id = $_POST['user_id']; 
	$page_id = $_POST['page_id'];
	$body = htmlspecialchars($_POST['body']);
	try{
		$sql = "INSERT INTO `comments` (user_id, post_id, body, created_at) VALUES (:user_id, :page_id, :body, now())";
		
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':user_id', $user_id);
		$stmt->bindValue(':page_id', $page_id);
		$stmt->bindValue(':body', $body);
			
		$stmt->execute();

		$last_id = $pdo->lastInsertId();
		
		$query = "SELECT * FROM comments WHERE comment_id = :last_id";

		$row = $pdo->prepare($query);
		$row->bindValue(':last_id', $last_id);
		$row->execute();
		
		$comment=$row->fetch();
		
		include __DIR__ . '/../comments/layout/comments_output.php';
	}catch(PDOException $e){
		$title ='An error has occured';
		$output = 'Database error: ' . $e->getMessage() . ' in '
		. $e->getFile() . ':' . $e->getLine();			
	}			
}

//Receives from jQuery for posting replies
if(isset($_POST['submit_reply']) && $_POST['reply_text']!==""){
	$comment_id = $_POST['comment_id']; 
	$user_id = $_POST['user_id'];
	$reply_text = htmlspecialchars($_POST['reply_text']);
	
	try{
		$sql = "INSERT INTO `replies` (user_id, comment_id, body, created_at, updated_at) VALUES (:user_id, :comment_id, :reply_text, now(), null)";

		$query=$pdo->prepare($sql);
		$query->bindValue(':user_id',$user_id);
		$query->bindValue(':comment_id',$comment_id);
		$query->bindValue(':reply_text',$reply_text);
		
		$query->execute();
		$insert_id = $pdo->lastInsertId();

			
		if($insert_id){
			$query = "SELECT * FROM replies WHERE reply_id = :insert_id";

			$reply_row = $pdo->prepare($query);
			$reply_row->bindValue(':insert_id', $insert_id);
			
			$reply_row->execute();
			$reply=$reply_row->fetch();
				
			include __DIR__ . '/../comments/layout/replies_output.php';
			
		}
	}catch(PDOException $e){
		$title ='An error has occured';
		$output = 'Database error: ' . $e->getMessage() . ' in '
		. $e->getFile() . ':' . $e->getLine();			
	}
}