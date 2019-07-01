<?php
//require __DIR__ . '/credentials.php';

$con = mysqli_connect('localhost', 'spex_db_user_member','AQD8Z0jHlUJypnKf','spex_db');
if(!$con){
	die('Could not connect: ' . mysqli_connect($con));
}

function totalComments(){
	global $con;
	mysqli_select_db($con,'total comments');
	$sql = 'SELECT COUNT(comment_id) As total FROM Comments';
	$result = mysqli_query($con, $sql);

	$rowNum = mysqli_fetch_assoc($result);
	echo $rowNum['total'];
}

function userComments(){
	global $con;
	mysqli_select_db($con,'comments');
	$query ='SELECT c.body, c.created_at, u.username, u.profile_photo FROM comments c, users u WHERE c.user_id = u.user_id ORDER BY c.created_at ASC';
	
	$result = mysqli_query($con, $query);
		
	while($row = mysqli_fetch_array($result)){
	echo '<div class="comments-section group" >';
	echo '<div class="profile-photo"> <img src='.$row['profile_photo'].' alt="" width=30px height=30px></div>';
	echo '<div class="comments-detail ">';
	echo '<div class="user-info">';
	echo '<span class="username">'.$row['username'].'</span>';
	echo '<span class="created-date">' . date('F j, Y ', strtotime($row['created_at'])).'</span>';
	echo '</div>';
	echo '<div class="comment-text">'.$row['body'].'</div>';
	echo '</div>';
	echo '</div>';
	}
}
/*
function postComment(){
	
	global $con;
	
	if(!empty($_POST['body']) && !empty($_POST['user_id'])){
	$user_id = $_POST['user_id']; 
	$body = mysqli_real_escape_string($con, $_POST['body']);
	
	$sql = 'INSERT INTO `comments` (user_id, post_id, body, created_at) VALUES ('.$user_id .', 1, "'. $body .'", now() )';
	
	mysqli_query($con, $sql);
	
	$id = mysqli_insert_id($con);
	
		
	if($id){
		$query = 'SELECT c.body, c.created_at, u.username, u.profile_photo FROM comments c, users u WHERE c.user_id = u.user_id AND c.comment_id =' .$id.'';
	
		$select = mysqli_query($con, $query);
		
		if($select){
			$row = mysqli_fetch_array($select);
			
			$name =$row['username'];
			$comment =$row['body'];
			$photo =$row['profile_photo'];
			$date =$row['created_at'];
			echo '<div class="comments-section group" >';
			echo '<div class="profile-photo"> <img src='.$photo.' alt="" width=30px height=30px></div>';
			echo '<div class="comments-detail ">';
			echo '<div class="user-info">';
			echo '<span class="username">'.$name.'</span>';
			echo '<span class="created-date">' . date('F j, Y ', strtotime($date)).'</span>';
			echo '</div>';
			echo '<div class="comment-text">'.$comment.'</div>';
			echo '</div>';
			echo '</div>';
		}else{
			echo "Error: ". mysqli_error($con);
		}
	}else{
		echo "Error: ". mysqli_error($con);
	}
}
	
	
	
	
	else{
		echo 'Error: '.$sql. '<br>'. mysqli_error($con);
	}
	//mysqli_close($con);		
}
*/
