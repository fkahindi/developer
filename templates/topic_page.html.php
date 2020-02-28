<?php 
session_start(); 
include __DIR__ .'/../admin/includes/posts_functions.php';
include __DIR__ .'/../admin/includes/admin_functions.php';
	
	$menu_topic = getTopicByName($_GET['name']);
?>
<!DOCTYPE html>
<html lang="en">
	<!-- head section -->
	<?php require_once __DIR__ .'/head.html.php'; ?>
	<!--// head section -->
	<title><?=$menu_topic['topic_name'] ?></title> 
	</head>
	<body>
		<header>
		<?php require_once __DIR__ . '/header.html.php';?>
		</header>
		<main class="group">
			<aside class="col-2-10 hide-in-mobile">
				<div class="published-topics">
				<h2 class="left">Topics</h2>
					
				<?php include __DIR__ . '/published_posts_by_topics.html.php';?>					
					
				</div>
			</aside><!--
			--><section class="col-5-10">
				<h1><?=$menu_topic['topic_name'] ?></h1><hr>
				<?php $topic_id = $menu_topic['topic_id'] ?>
				<?php $published_posts = getPublishedPostsByTopic($topic_id)?>
				<?php foreach($published_posts as $pub_post):?>
				<?php $pub_post['author'] = getPostAuthorById($pub_post['user_id'])?>
				<h3><a href="<?php echo BASE_URL ?>templates/post.html.php?id=<?php echo $pub_post['post_id'] ?>&title=<?php echo $pub_post['post_slug']?>"><?php echo $pub_post['post_title']?></a></h3>
				<div class="post-acreditation">
					By <?php echo $pub_post['author'];?><span>  
					<?php echo isset($pub_post['updated_at'])? 'Updated on '. date( 'F j, Y', strtotime($pub_post['updated_at'])): 'Published on '. date( 'F j, Y', strtotime($pub_post['created_at'])) ?></span>
				</div>
					
				<div class="paragraph-snippet">
					<?php echo getFirstParagraphPostById($pub_post['post_id']) ?>
					<a href="<?php echo BASE_URL ?>templates/post.html.php?id=<?php echo $pub_post['post_id'] ?>&title=<?php echo $pub_post['post_slug'] ?>">Read more...</a>
				</div><br>
				<?php endforeach ?>
				
			</section><!--			
			--><aside class="col-3-10">
				<!-- Sidebar content goes here-->
				<div class="recent-posts">
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
		<script src="<?php echo BASE_URL ?>resources/js/jquery-1.7.2.min.js"></script>
		<script src="<?php echo BASE_URL ?>resources/js/get-meta-keywords.js"></script>
		<script src="<?php echo BASE_URL ?>resources/js/menu-profile-controls.js"></script>
	</body>
</html>