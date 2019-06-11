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

if(isset($_POST['submit'])){
	if(empty($_POST['comment'])){
		exit;
	}else{
		
	}
}
function getUser(){
	
	global $con;
	$user_id = $_SESSION['user_id'];
	$body = $_POST['comment'];
	$sql = 'INSERT INTO `comments` (user_id, body, created_at ) VALUES ('.$user_id.','.$body.', now())';
	
	if(mysqli_query($con, $sql)){
		
		//$q = intval($_GET['q']); 
		mysqli_select_db($con, 'comments');
		
		$query = 'SELECT c.body, c.created_at, u.username, u.profile_photo FROM comments c, users u WHERE c.user_id = u.user_id AND u.username ='.$_SESSION['username'].'ORDER BY c.created_at ASC'; 
		
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
	}else{
		echo 'Error: '.$sql. '<br>'. mysqli_error($con);
	}
	//mysqli_close($con);		
}