<?php 
session_start(); 
require_once __DIR__ .'/config.php';
include __DIR__ .'/admin/includes/posts_functions.php';
include __DIR__ .'/admin/includes/admin_functions.php';
	$published_post_ids = getAllPublishedPostIds();
?>
<!DOCTYPE html>
<html lang="en">
	<!-- head section -->
	<?php require_once __DIR__ .'/templates/head.html.php'; ?>
	<!--// head section -->
	<title>Developerspot: A blog for developers</title> 
	<script>
		/* The following function help to generate content for description meta tag.  */
		function getMetaDescription(){
			var metaDescription = "Developerspot is a blog for developers, sharing knowledge and skills in the areas of app and web development.";
			return metaDescription;
		}
		
		/* Get description for meta */
		var meta_descr = document.getElementsByName('description')[0];
		var description = getMetaDescription();
		meta_descr.setAttribute("content",description);
		</script>
	
	</head>
	<body>
		<header>
		<?php require_once __DIR__ . '/templates/header.html.php';?>
		
		<!-- Go to www.addthis.com/dashboard to customize your tools -->
		<div class="addthis_inline_share_toolbox"></div>
            
		</header>
		
		<main class="group">
			<aside class="col-2-10 hide-in-mobile">
				<div class="published-topics">
				<h2>Topics</h2>
					
				<?php include __DIR__ . '/templates/published_posts_by_topics.html.php';?>					
					
				</div>
			</aside><!--
			--><section class="col-5-10">
				<h1 class="align-center">The Developers Pot</h1><hr>
				<?php foreach($published_post_ids as $post_id): ?>
				<?php $post = getPostById($post_id['post_id']) ?>
				<?php $post['author'] = getPostAuthorById($post['user_id'])?>
				<div>
					<h3><a href="templates/post.html.php?id=<?php echo $post_id['post_id'] ?>&title=<?php echo $post['post_slug'] ?>"> <?php echo htmlspecialchars_decode($post['post_title']) ?></a></h3>
				</div>
				<div class="post-acreditation">
					<span>  
					<?php echo isset($post['updated_at'])? 'Updated on '. date( 'F j, Y', strtotime($post['updated_at'])): 'Published on '. date( 'F j, Y', strtotime($post['created_at'])) ?></span>, By <?php echo $post['author'];?>
				</div>
				<div class="post-main-image">
				<figure>
				<a href="templates/post.html.php?id=<?php echo $post_id['post_id'] ?>&title=<?php echo $post['post_slug'] ?>">
				<?php echo (!empty($post['image'])? '<img src="'.$post['image'].'" alt="article image" class="article-index-image">':'')?></a>
					<figcaption><?php echo (!empty($post['image_caption'])? $post['image_caption']:'' ); ?></figcaption>
				</figure>
				</div>
				<div class="paragraph-snippet">
					<?php echo getFirstParagraphPostById($post_id['post_id']) ?>
					<a href="templates/post.html.php?id=<?php echo $post_id['post_id'] ?>&title=<?php echo $post['post_slug'] ?>">Read more...</a>
				</div><br>
				<?php endforeach; ?>
			</section><!--			
			--><aside class="col-3-10">
				<!-- Sidebar content goes here-->
				<div class="recent-posts">
				<h2 class="left">Recent posts</h2>
				<?php $recent_posts = getMostRecentPosts(); ?>
				<?php foreach($recent_posts as $latest_post): ?>
				<p><a href="templates/post.html.php?id=<?php echo $latest_post['post_id'] ?>&title=<?php echo $latest_post['post_slug']?>"> <?php echo $latest_post['post_title'] ?></a></p>
				<?php endforeach; ?>
				</div>
			</aside><!--			
			--><aside class="hide-in-bigger-screens">
				<div>
				<h2 class="left">Browse Topics</h2>
					<?php include __DIR__ . '/templates/published_posts_by_topics.html.php';?>				
				</div>
			</aside>	
		</main>
		<footer class="group">
			<div class="align-center">
				<p><a href="policies/privacy-policy.php">Privacy policy</a></p>
				<p><a href="policies/terms-conditions.php">Terms & Conditions </a></p>
				<p><a href="policies/cookie-policy.php">Cookie policy</a></p>
			</div>
			<div class="group">
				<span class="nav">
					<?php include  __DIR__ .'/templates/nav.html.php'; ?>	
				</span>
				<span class="copyright">
					<?php include __DIR__ . '/templates/copyright.html.php';?>
				</span>
				
				<!-- Go to www.addthis.com/dashboard to customize your tools --> 
				<div class="addthis_inline_follow_toolbox"></div> 
			</div>
		</footer>
		<script src="<?php echo BASE_URL ?>resources/js/jquery-1.7.2.min.js"></script>
		<script src="<?php echo BASE_URL ?>resources/js/page-control.js"></script>
		
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e8b3d1cdb759869"></script>

	</body>
</html>