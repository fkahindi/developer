<?php
include __DIR__ .'/DatabaseConnection.php';
//include __DIR__ . '/classes/DatabaseTable.php';
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
	$body = mysqli_real_escape_string($conn, $body);
	
	$sql = "INSERT INTO `comments` (user_id, post_id, body, created_at) VALUES (:user_id, :page_id, ':body', :created_at )";
	
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':user_id', $user_id);
	$stmt->bindValue(':page_id', $page_id);
	$stmt->bindValue(':body', $body);
	$stmt->bindValue(':created_at', now());
	
	$stmt->execute();

	$last_id = $pdo->lastInsertId();

		
	if($last_id){
		$query = "SELECT * FROM comments WHERE comment_id = :last_id";

		$comment = $pdo->prepare($query);
		$comment->bindValue(':last_id', $last_id);
		$comment->execute();
		
		$comment->fetch();
			
		include __DIR__ . '/../comments/layout/comments_output.php';
	}
}

//Receives from jQuery for posting replies
if(isset($_POST['submit_reply']) && $_POST['reply_text']!==""){
	$comment_id = $_POST['comment_id']; 
	$user_id = $_POST['user_id'];
	$reply_text = htmlspecialchars($_POST['reply_text']);
	$reply_text = mysqli_real_escape_string($conn, $reply_text);
			
	$sql = "INSERT INTO `replies` (user_id, comment_id, body, created_at, updated_at) VALUES (:user_id ,:comment_id, ':reply_text', :created_at, :updated_at)";

	$query=$pdo->prepare($sql);
	$query->bindValue(':user_id',$user_id);
	$query->bindValue(':comment_id',comment_id);
	$query->bindValue(':body',$reply_text);
	$query->bindValue(':created_at',now());
	$query->bindValue(':updated_at',null);

	$query->execute();
	$insert_id = $pdo->lastInsertId();

		
	if($insert_id){
		$query = "SELECT * FROM replies WHERE reply_id = :insert_id";

		$reply = $pdo->prepare($query);
		$reply->bindValue(':insert_id', $insert_id);
		
		$reply->execute();
		$reply->fetch();
			
		include __DIR__ . '/../comments/layout/replies_output.php';
		
	}
}