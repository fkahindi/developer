<?php 
if(!isset($_SESSION)){
	session_start();
}

include __DIR__ . '/../includes/loginStatus.php';
	
if($_SESSION['role'] !== 'Admin'){
	header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">	
<?php include __DIR__ . '/components/head.php';?>
<title>Admin | Dashboard</title>
</head>
<body>
	<?php include __DIR__ .'/components/navbar.php'; ?>
	<div class="container bg-info">
	
	</div>
	<div class="container border mt-3">
		<div class="mx-auto my-4"><h1><?php echo $_SESSION['role']; ?></h1></div>
		
		<div class="row ">
			<!--Row with 3 equal columns-->
			<div class="col-md-4 panel-body border">
				<!--Column left -->
				<a href="#">New Registered Users</a>
			</div>
			<div class="col-md-4 panel-body border">
				<!--Column middle -->
				<a href="#">Published posts</a>
			</div>
			<div class="col-md-4 panel-body border">
				<!--Column right -->
				<a href="#">Published comments</a>
			</div>
		</div>
		<div>
			<a href="users.php" class="btn btn-info">Users</a>
			<a href="posts.php " class="btn btn-info ">Posts</a>
		</div>
	</div>
	
</body>
<script src="js/jquery-3.4.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>