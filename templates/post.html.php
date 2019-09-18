<?php
if(!isset($_SESSION)){
	session_start();
}
	include __DIR__ .'/../admin/includes/posts_functions.php';
	if(isset($_GET['id'])){
		$posts = getPostById($_GET['id']);
	}
	
	//Get page id representing this post 
	$page_id = $posts['post_id'];
?>
<!DOCTYPE html>
<html lang="en">
	<?php include __DIR__ .'/head.html.php';?>
	
	<!-- Links for google code prettify both (.css and .js at bottom of page) files -->
	<link rel="stylesheet" type="text/css" href="/spexproject/resources/css/google-code-prettify/prettify.css">
	<title><?php echo htmlspecialchars_decode($posts['post_title']) ;?> | Spex Solutions</title>
</head>
<body onload="PR.prettyPrint()">
	<header>
		<?php include __DIR__ .'/header.html.php';?>
		
	</header>
	<main class="group">
		<section class='col-3-5'>
			
			<!-- The title will be fetched from database -->
			<h1><?php echo ucwords(htmlspecialchars_decode($posts['post_title'])) ;?></h1>
			
			<!-- The page content will be fetched from database -->
			<?php echo htmlspecialchars_decode($posts['post_body']) ;?>
			
			<!--Comments sections  -->
			<?php include __DIR__ .'/../comments/layout/comments-layout.php'; ?>
		</section><!--
		--><aside class='col-2-5'>
			<div class="recent-posts">
			<!-- Sidebar items go here -->
				<h2 class="left">Recent posts</h2>
				<?php $recent_posts = getMostRecentPosts(); ?>
				<?php foreach($recent_posts as $latest_post): ?>
				<h5><a href="post.html.php?id=<?php echo $latest_post['post_id'] ?>&title=<?php echo $latest_post['post_slug']?>"> <?php echo $latest_post['post_title'] ?></a></h5>
				<?php endforeach; ?>
				</div>
		</aside>		
	</main>
	<footer class="group">
			<span class="float-right">
				<?php include  __DIR__ .'/nav.html.php'; ?>	
			</span>
			<span class="float-left">
				<?php include __DIR__ . '/copyright.html.php';?>
			</span> 
	</footer>
</body>
<script src="/spexproject/resources/js/jquery-3.4.0.min.js"></script>
<script src="/spexproject/resources/js/comments-scripts.js"></script>
<script src="/spexproject/resources/js/menu-profile-controls.js"></script>
<script type="text/javascript" src="/spexproject/resources/css/google-code-prettify/prettify.js"></script>

</html>
