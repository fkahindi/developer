<?php 
session_start(); 
include __DIR__ .'/admin/includes/posts_functions.php';
	$published_post_ids = getAllPublishedPostIds();
	//$paragraphs = getFirstParagraphPostById();
?>
<!DOCTYPE html>
<html lang="en">
	<!-- head section -->
	<?php require_once __DIR__ .'/templates/head.html.php'; ?>
	<!--// head section -->
	<title>Spex Management Solutions</title> 
	</head>
	<body>
		<header>
		<?php require_once __DIR__ . '/templates/header.html.php';?>
		</header>
		<main class="group">
			<!-- Main section-->
			<section class="col-3-5">
				<h1>Welcome to Developers Pot</h1>
				<?php foreach($published_post_ids as $post_id): ?>
				<?php $post = getPostById($post_id['post_id']) ?>
				<?php $post['author'] = getPostAuthorById($post['user_id'])?>
				<h3><a href="templates/post.html.php?id=<?php echo $post_id['post_id']?>"><?php echo htmlspecialchars_decode($post['post_title']) ; ?><a/></h3>
				<em class="post-acreditation">By <?php echo $post['author'];?><span> Published on <?php echo date( 'F j, Y', strtotime($post['created_at'])) ?></span></em>
				<div class="paragraph-snippet"><?php echo getFirstParagraphPostById($post_id['post_id']); ?> </div><br>
				<?php endforeach; ?>
			</section><!--			
			--><aside class="col-2-5">
				<!-- Sidebar content goes here-->
				<h2 class="centered">Popular posts</h2>
				
			</aside>	
		</main>
		<footer>
			<div class="group">
				<span class="float-right">
					<?php include  __DIR__ .'/templates/nav.html.php'; ?>	
				</span>
				<span class="float-left">
					<?php include __DIR__ . '/templates/copyright.html.php';?>
				</span>
			</div>
		</footer>
	</body>
	<script src="/spexproject/resources/js/jquery-3.4.0.min.js"></script>
	<script src="/spexproject/resources/js/menu-profile-controls.js"></script>
</html>