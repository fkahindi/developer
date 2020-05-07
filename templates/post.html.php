<?php
if(!isset($_SESSION)){
	session_start();
}
	include __DIR__ .'/../admin/includes/posts_functions.php';
	include __DIR__ .'/../admin/includes/admin_functions.php';
	if(isset($_GET['id'])){
		$posts = getPostById($_GET['id']);
	}
	/* Get page id for this post */ 
	$page_id = $posts['post_id'];
	/* SESSION variables for page reference */ 
	$post_slug = $posts['post_slug'];
	$_SESSION['page_id'] = $page_id;
	$_SESSION['post_slug'] = $post_slug;
	$published_post_ids = getAllPublishedPostIds();
?>
<!DOCTYPE html>
<html lang="en">
	<?php include __DIR__ .'/head.html.php';?>	
	<!-- Links for google code prettify both (.css and .js at bottom of page) files -->
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>resources/css/google-code-prettify/prettify.css" />
	<title><?php echo htmlspecialchars_decode($posts['post_title']) ;?> | Developers Pot</title>
	<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e81b21589347a0019b87608&product=inline-share-buttons' defer></script>
	
</head>
<body>
<div id="fb-root"></div>

	<header>
		<?php include __DIR__ .'/header.html.php';?>
	</header>
	<main class="group">
		<aside class="col-2-10 hide-in-mobile">
				<div>
				<h2>Topics</h2>
				<?php include __DIR__ . '/published_posts_by_topics.html.php';?>
				</div>
		</aside><!--
		--><section class='col-5-10'>
			<!-- The title will be fetched from database -->
			<h1><?php echo ucwords(htmlspecialchars_decode($posts['post_title'])) ;?></h1>
			<div class="post-acreditation">  
				<?php echo isset($posts['updated_at'])? 'Updated on '. date( 'F j, Y', strtotime($posts['updated_at'])): 'Published on '. date( 'F j, Y', strtotime($posts['created_at'])) ?>
			</div>
			<div class="social-media hide-in-bigger-screens">
			<!-- Go to www.addthis.com/dashboard to customize your tools -->
                <?php include __DIR__ .'/social-icons-links.html.php';?>
            
			</div>
			
			<div class="post-main-image">
				<figure>
				<?php echo (!empty($posts['image'])? '<img src="'.$posts['image'].'" loading="lazy" alt="'.(!empty($posts['image_caption'])? $posts['image_caption']:'').'" class="article-post-image">':''); ?>
				<figcaption><?php echo (!empty($posts['image_caption'])? $posts['image_caption']:'' ); ?></figcaption>
				</figure>
			</div>
			
			<div>				
			<!-- The page content will be fetched from database -->
			<?php echo htmlspecialchars_decode($posts['post_body']) ;?>
				<div class="social-media">

                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <?php include __DIR__ .'/social-icons-links.html.php';?>
            
				</div>
				
				<div>
				<!-- Call to subscribe for notification -->
				<?php  include __DIR__.'/subscribe.html.php';?>
				</div>
				<div>
			<!--Comments sections  -->
			<?php include __DIR__ .'/../comments/comments-layout.php'; ?>
				</div>
			</div>
			
		</section><!--
		--><aside class='col-3-10'>
			<div class="recent-posts">
			<!-- Sidebar items go here -->
				<h2 class="left">Recent posts</h2>
				<?php $recent_posts = getMostRecentPosts(); ?>
				<?php foreach($recent_posts as $latest_post): ?>
				<p><a href="post.html.php?id=<?php echo $latest_post['post_id'] ?>&title=<?php echo $latest_post['post_slug']?>"> <?php echo $latest_post['post_title'] ?></a></p>
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
	<footer>
		<?php include __DIR__ .'/footer.html.php'?>
	</footer>
	<!--for local server-->
	<script src="<?php echo BASE_URL ?>resources/js/jquery-1.7.2.min.js"></script> 
	<!-- -->
	<script src="<?php echo BASE_URL ?>resources/css/google-code-prettify/prettify.js"></script>
	<script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
	<script src="<?php echo BASE_URL ?>resources/js/subscribe-comments-replies-scripts.js"></script>
	<!-- This is for local offline server -->
	<script>window.onload=function(){prettyPrint()}</script>
	<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e8b3d1cdb759869"></script>
	
</body>
</html>