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
	<title><?php echo  $_SESSION['role']?> | Posts</title>
	
	<!--Fetch all posts that apply to the user  -->
	<?php $posts = getAllPosts(); ?>
</head>
<body>
	<?php include __DIR__ .'/components/navbar.php'; ?>
	<div class="container border border-dark m-3">
	<div class="text-center text-success"><?php include __DIR__ .'/includes/messages.php'?></div>
		<h1>Welcome <?php echo $_SESSION['fullname'] .' | '. $_SESSION['role']?></h1>
		<div class="row my-5">
		
			<!--Row with 3 equal columns-->
			<div class="col-md-3 panel-body border border-primary">
				<!--Column left Navigation-->
				<div class="bg-success rounded">
					<h2>Actions</h2>
				</div>
				<div ><a href="create_post.php">Create post</a></div>
				<div><a href="#">Manage posts</a></div>
				<?php if($_SESSION['role']== 'Admin'):?>
				<div><a href="users.php">manage users</a></div>
				<div><a href="topics.php">manage topics</a></div>
				<?php endif ?>
			</div>
			<div class="col-md-9 panel-body border">
			<?php if(empty($posts)): ?>
			<div class="mx-auto my-4"><h4>There are no posts to display</h4></div>
				<!--Column right database output-->
			<?php else: ?>	
					<table class="table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th>SNo.</th>
								<th>Author</th>
								<th>Title</th>
								<th>Views</th>
								<!--Only Admin can publish/ unpublish posts  -->
								<?php if($_SESSION['role']=='Admin'): ?>
								<th>Published</th>
								<?php endif ?>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($posts as $key => $post):?>
							<tr>
								<td><?php echo $post['post_id'] ?></td>
								<td><?php echo $post['author'] ?></td>
								<td><?php echo $post['post_title'] ?></td>
								<td><?php echo $post['views'] ?></td>
								
								<!--Only Admin can publish/ unpublish posts  -->
								<?php if($_SESSION['role']== 'Admin'): ?>
								<td>
									<?php if($post['published'] == true): ?>  
										<a href="posts.php?unpublish=<?php echo $post['post_id'] ?>" class="btn btn-success btn-md"><span class="glyphicon glyphicon-ok"></span></a>
									<?php else:?>
										<a href="posts.php?publish=<?php echo $post['post_id'] ?>" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-remove"></span></a>
									<?php endif ?>
								</td>
								<?php endif ?>
								<td>
									<p  class="mx-auto">
									<a href="create_post.php?edit-post=<?php echo $post['post_id'] ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
									</p>
								</td>
								<td>
									<p>
									<a href="create_post.php?delete-post=<?php echo $post['post_id'] ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Trash</a>
									</p>
								</td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				<?php endif ?>
			</div>
		</div>
	</div>
</body>
<script src="js/jquery-3.4.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>