<?php
//require __DIR__ . '/credentials.php';

$con = mysqli_connect('localhost', 'spex_db_user_member','AQD8Z0jHlUJypnKf','spex_db');
if(!$con){
	die('Could not connect: ' . mysqli_connect($con));
}

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
		
/*	
	if(mysqli_query($con, $sql)){
		mysqli_select_db($con,'comments');
		$query =;
		
		$result = mysqli_query($con, $query);
	}
*/