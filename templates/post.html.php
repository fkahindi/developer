<?php
if(!isset($_SESSION)){
	session_start();
}
	include __DIR__ .'/../admin/includes/posts_functions.php';
	include __DIR__ .'/../admin/includes/admin_functions.php';
	if(isset($_GET['id'])){
		$posts = getPostById($_GET['id']);
	}
	
	//Get page id representing this post 
	$page_id = $posts['post_id'];
	//SESSION variables for page reference 
	$post_slug = $posts['post_slug'];
	$_SESSION['page_id'] = $page_id;
	$_SESSION['post_slug'] = $post_slug;
	$published_post_ids = getAllPublishedPostIds();
?>
<!DOCTYPE html>
<html lang="en">
	<?php include __DIR__ .'/head.html.php';?>
	
	<!-- Links for google code prettify both (.css and .js at bottom of page) files -->
	<link rel="stylesheet" type="text/css" href="/spexproject/resources/css/google-code-prettify/prettify.css">
	<title><?php echo htmlspecialchars_decode($posts['post_title']) ;?> | Developers Pot</title>
</head>
<body onload="PR.prettyPrint()">
	<header>
		<?php include __DIR__ .'/header.html.php';?>
	</header>
	<main class="group">
		<aside class="col-2-10 hide-in-mobile">
				<div class="published-topics">
				<h2 class="left">Topics</h2>
				<?php include __DIR__ . '/published_posts_by_topics.html.php';?>
				</div>
			</aside><!--
			--><section class='col-5-10'>
			<!-- The title will be fetched from database -->
			<h1><?php echo ucwords(htmlspecialchars_decode($posts['post_title'])) ;?></h1>
			<div class="post-acreditation">  
				<?php echo isset($posts['updated_at'])? 'Updated on '. date( 'F j, Y', strtotime($posts['updated_at'])): 'Published on '. date( 'F j, Y', strtotime($posts['created_at'])) ?>
			</div>
			<div class="post-main-image">
				<?php echo (!empty($posts['image'])? '<img src="'.$posts['image'].'" alt="article image" class="article-post-image">':'')?>
			</div>
			<div>				
			<!-- The page content will be fetched from database -->
			<?php echo htmlspecialchars_decode($posts['post_body']) ;?>
			<!-- Call to subscribe for notification -->
			<?php  include __DIR__.'/subscribe.html.php';?>
			<!--Comments sections  -->
			<?php include __DIR__ .'/../comments/layout/comments-layout.php'; ?>
			</div>
			
		</section><!--
		--><aside class='col-3-10'>
			<div class="recent-posts">
			<!-- Sidebar items go here -->
				<h2 class="left">Recent posts</h2>
				<?php $recent_posts = getMostRecentPosts(); ?>
				<?php foreach($recent_posts as $latest_post): ?>
				<h5><a href="post.html.php?id=<?php echo $latest_post['post_id'] ?>&title=<?php echo $latest_post['post_slug']?>"> <?php echo $latest_post['post_title'] ?></a></h5>
				<?php endforeach; ?>
			</div>
		</aside><!--			
			--><aside class="hide-in-bigger-screens">
				<div class="published-topics">
				<h2 class="left">Browse Topics</h2>
				<?php include __DIR__ . '/published_posts_by_topics.html.php';?>
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
<script src="/spexproject/resources/js/jquery-1.7.2.min.js"></script>
<script src="/spexproject/resources/js/get-meta-keywords.js"></script>
<script src="/spexproject/resources/js/menu-profile-controls.js"></script>
<script src="/spexproject/resources/js/subscribe-comments-replies-scripts.js"></script>
<script src="/spexproject/resources/css/google-code-prettify/prettify.js"></script>

</html>
