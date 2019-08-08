<?php
require_once __DIR__ .'/../../includes/DbConnection.php';

//Post variables
$post_id ='';
$isEditingPost = false;
$published = 0;
$title ='';
$post_slug = '';
$body = '';
$feature_image = '';
$post_topic ='';
$topic_id ='';


/*---------------
--Post Functions
-----------------*/
//Get numbe of posts in the posts table
function getAllPublishedPostIds(){
	global $conn;
	
	$sql ="SELECT post_id FROM `posts` WHERE published =1 ORDER BY created_at DESC";
	$result = mysqli_query($conn, $sql);
	if($result){
		$published_post_id = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $published_post_id;
	}else{
		return null;
	}	
}
//Get all posts based on the user
function getAllPosts(){
	global $conn, $_SESSION;
	
	//Admins can view all posts but Authors will view only the posts they authored
	if($_SESSION['role'] == 'Admin'){
		
		$sql = "SELECT * FROM `posts`";
		$select = mysqli_query($conn, $sql);
	}elseif($_SESSION['role'] == 'Author'){
		
		$user_id = $_SESSION['user_id'];
		$sql = "SELECT * FROM `posts` WHERE user_id=$user_id";
		$select = mysqli_query($conn, $sql);
	}
	
	$posts = mysqli_fetch_all($select, MYSQLI_ASSOC);
	
	$all_posts = array();
	
	foreach($posts as $key => $post){
		$post['author'] = getPostAuthorById($post['user_id']);
		array_push($all_posts, $post);
	}
	return $all_posts;
}

//Get a single post by supplying post idate
function getPostById($post_id){
	global $conn;
	$sql = "SELECT * FROM `posts` WHERE post_id=$post_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	
	$post = mysqli_fetch_assoc($result);
	
	return $post;
}
//Get username/ author of each post
function getPostAuthorById($user_id){
	global $conn;
	$sql ="SELECT username FROM `users` WHERE user_id=$user_id";
	
	$result = mysqli_query($conn, $sql);
	if($result){
		
		$author = mysqli_fetch_assoc($result);
		return $author['username'];
	}else{
		return null;
	}
}
//Select first 300 characters of post contents
function getFirstParagraphPostById($post_id){
	global $conn;
	$sql ="SELECT SUBSTR(post_body, 1, 300) AS post_body FROM `posts` WHERE post_id=$post_id";

	$result = mysqli_query($conn, $sql);

	if($result){
		$paragraph = mysqli_fetch_assoc($result);
		
		return htmlspecialchars_decode($paragraph['post_body'].'...');	
	}else{
		return null;
	}
}

/*-----------------------
--Post Actions
------------------------*/
//If user clicks Save post button
if(isset($_POST['create_post'])){
	createPost($_POST);
} 
//If user clicks Edit post
if(isset($_GET['edit-post'])){
	$isEditingPost = true;
	$post_id = $_GET['edit-post'];
	editPost($post_id);
}
//If user clicks Update post button
if(isset($_POST['update_post'])){
	updatePost($_POST);
}
//If user click Delete button
if(isset($_GET['delet-post'])){
	$post_id =$_GET['delete-post'];
	deletePost($post_id);
}

/*-----------------------
--Post Functions
-------------------------*/
function createPost($request_values){
	global $conn, $errors, $title, $topic_id, $body, $published;
	
	$title = esc($request_values['title']);
	$body = htmlspecialchars(esc($request_values['body']));
	$user_id = $_SESSION['user_id'];
	
	//Validate form
	if(empty($title)){array_push($errors, "Post title is required");}
	if(empty($body)){array_push($errors, "Post body is required");}
	if(empty($request_values['topic_id'])){
		array_push($errors, "Post topic is required");
	}else{
		$topic_id = $request_values['topic_id'];
	}
	if(isset($_POST['publish'])){
		$published = $_POST['publish'];
	}
	
	//Create slug by replacing spaces in title with hyphens
	$post_slug = makeSlug($title);
			
	//Make sure no file is saved twice
	$post_check ="SELECT * FROM `posts` WHERE post_slug='$post_slug' LIMIT 1";
	
	$result = mysqli_query($conn, $post_check);
		
	if(mysqli_num_rows($result)>0){ //another post with the name exists
		array_push($errors, 'A post with that name already exists');
	}
	
	//If no errors in the form, insert posts	
	if(!$errors){
		$query = "INSERT INTO `posts` (user_id, post_title, post_slug, post_body, published, created_at) VALUES($user_id, '$title', '$post_slug', '$body', $published, now())";
		
		$result = mysqli_query($conn, $query);
		if($result){ //if post created successful
		
			$inserted_id = mysqli_insert_id($conn);
			//Create a relationship between post and topic
			$sql ="INSERT INTO `post_topic` (topic_id, post_id) VALUES ($topic_id, $inserted_id)";
			
			mysqli_query($conn, $sql);
			
			$_SESSION['message']='Post created successfully.';
			header('Location: posts.php');
			exit(0);
		}else{
			array_push($errors, 'Insert record unsuccessful.');
		}		
	} 
}

function editPost($role_id){
	global $conn, $title, $post_slug, $body, $published, $isEditingPost, $post_id;
	$sql = "SELECT * FROM `posts` WHERE post_id = $role_id LIMIT 1";
	
	$result = mysqli_query($conn, $sql);
	$post = mysqli_fetch_assoc($result);
	//Set form values to be updated on form
	$title = $post['post_title'];
	$body = $post['post_body'];
	$published = $post['published'];
}
function updatePost($request_values){
	global $conn, $title, $post_slug, $body, $published, $isEditingPost, $post_id, $errors;
	$title = esc($request_values['title']);
	$body = esc($request_values['body']);
	$post_id = esc($request_values['post_id']);
	if(isset($request_values['topic_id'])){
		$topic_id = esc($request_values['topic_id']);
	}
	if(isset($_POST['publish'])){
		$published = $_POST['publish'];
	}
	
	//Create slug by replacing spaces in title with hyphens
	$post_slug = makeSlug($title);
	//Validate form
	if(empty($title)){array_push($errors, "Post title is required");}
	if(empty($body)){array_push($errors, "Post body is required");}
	
	
	//Udate if there are no errors
	if(!$errors){
		$query = "UPDATE `posts` SET post_title='$title', post_slug='$post_slug', post_body='$body', published=$published, updated_at=now() WHERE post_id=$post_id";
		
		//Attach topic to posts in post_topic table
		if(mysqli_query($conn, $query)){ //if query was created successfully
			if(isset($topic_id)){
				$inserted_post_id = mysqli_insert_id($conn);
				//create relationship between post and topic
				$sql = "UPDATE `post_topic` SET topic_id=$topic_id WHERE post_id=$inserted_post_id";
				
				mysqli_query($conn, $sql);
				$_SESSION['message']= 'Post values update successful.';
				header('Location: posts.php');
				exit(0);
			}
			$_SESSION['message'] = 'Post update successful.';
			header('Location: posts.php');
			exit(0);
		}
	}
}

//Delete blog post
function deletePost($post_id){
	
	global $conn;
	$sql = "DELETE FROM `posts` WHERE post_id=$post_id";
	if(mysqli_query($conn, $sql)){
		
		$_SESSION['message'] = 'Post delete successful.';
		header('Location: posts.php');
			exit(0);
	}
}

//If user clicks Publish post button
if(isset($_GET['publish']) || isset($_GET['unpublish'])){
	$message ='';
	if(isset($_GET['publish'])){
		$message = 'Post published successfully.';
		$post_id = $_GET['publish'];
	}elseif(isset($_GET['unpublish'])){
		$message = 'Post successfully unpublished.';
		$post_id = $_GET['unpublish'];
	}
	togglePublishPost($post_id, $message);
}

//Publish/ unpublish posts
function togglePublishPost($post_id, $message){
	global $conn;
	
	$sql = "UPDATE posts SET published =!published WHERE post_id=$post_id";
	if(mysqli_query($conn, $sql)){
		$_SESSION['message'] = $message;
		header('Location: posts.php');
		exit(0);
	}
}