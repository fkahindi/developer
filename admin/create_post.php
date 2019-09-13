<?php  
	if(!isset($_SESSION)){
		session_start();
	}
	include __DIR__ . '/../includes/loginStatus.php';
	if($_SESSION['role']!== 'Admin' && $_SESSION['role']!== 'Author'){
		header('Location: ../index.php');
	}	
	
	include __DIR__ .'/includes/admin_functions.php';
	include __DIR__ .'/includes/posts_functions.php';

?>
<!DOCTYPE html>
<html lang="en">	
<?php include __DIR__ . '/components/head.php';?>
	<title><?php echo  $_SESSION['role'] ?> | Create Post</title>
	
	<!--Fetch all posts that apply to the user  -->
	<?php $topics = getAllTopics(); ?>
</head>
<body>
	<?php include __DIR__ .'/components/navbar.php'; ?>
	<div class="container border mt-3">
		
		<div class="row my-5">
		<div class="text text-right text-success"><?php include __DIR__ .'/includes/messages.php'?></div>
			<!--Row with 3 equal columns-->
			<div class="col-md-2 panel-body border">
				<!--Column left Navigation-->
				<div class="bg-success rounded text-center">
					<h2>Actions</h2>
				</div>
				<div><a href="#">Create post</a></div>
				<div><a href="posts.php">Manage posts</a></div>
				<?php if($_SESSION['role']== 'Admin'):?>
				<div><a href="users.php">manage users</a></div>
				<div><a href="topics.php">manage topics</a></div>
				<?php endif ?>
			</div>
			<div class="col-md-10 panel-body border">
				<h1>Creat/ Edit Post</h1>
				<form method="post" action="create_post.php">
					<div class="form-group form-group-lg">
						<!-- Validate errors on form-->
						<div class="text-danger"><?php include __DIR__ .'/includes/errors.php';?></div>
						
						<!--Id is required to identify the form -->
						<?php if($isEditingPost == true):?>
						<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
						<?php endif ?> 
						<div class="form-group form-group-lg">
							<input type="text" name="title" value="<?php echo $title; ?>" class="form-control" placeholder="Title">
						</div>
						<div class="form-group form-group-lg">
							
							<textarea name="body" id="body" col="30" row="50" class="form-control"><?php echo $body; ?></textarea>
							
						</div>
						<div>
							<select name="topic_id" class="form-control">
								<option value="" selected disabled>Choose topic</option>
								<?php foreach($topics as $topic):?>
									<option value="<?php echo $topic['topic_id']; ?>">
										<?php echo $topic['topic_name']; ?>
									</option>
								<?php endforeach ?>
							</select>
						</div>
						<!--Only Admin is supposed to publish posts -->
						<?php if($_SESSION['role']== 'Admin'):?>
						<!--Display checkbox for publishing/ unpublishing post  -->
							<?php if($published == true):?>
							<div class="form-group form-group-lg">
								<label for="publish">
									Publish
								<input type="checkbox" value="1" name="publish" checked="checked">&nbsp;
								</label>
							</div>
							<?php else: ?>
							<div class="form-group form-group-lg">
								<label for="publish">
									Publish
								<input type="checkbox" value="0" name="publish">&nbsp;
								</label>
							</div>
							<?php endif ?>
						<?php endif ?>
						
						<!--If editing post, display the update button instead of create button -->
						<div>
							<?php if($isEditingPost == true): ?>
							<button type="submit" class="btn btn-success" name="update_post">UPDATE</button>
							<?php else: ?>
							<button type="submit" class="btn btn-success" name="create_post">Save post</button>
							<?php endif ?>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
</body>
<script src="js/jquery-3.4.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>