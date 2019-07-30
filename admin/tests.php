<?php
session_start();
//include __DIR__ .'/includes/admin_functions.php';
//include __DIR__ .'/includes/posts_functions.php';

if(isset($_POST['create_post'])){
	$title = $_POST['title'];
	$body = htmlspecialchars($_POST['body']);
	$user_id = $_SESSION['user_id'];
	$topic_id = $_POST['topic_id'];
	if(isset($_POST['publish'])){
		$published = $_POST['publish'];
	}
	
	echo 'Post title is: '.$title . '<br>';
	echo 'Post user_id is: '.$user_id . '<br>';
	echo 'Post topic_id is: '.$topic_id . '<br>';
	echo 'Post published: '.$published . '<br>';
	echo $body . '<br>';
	
}


 
