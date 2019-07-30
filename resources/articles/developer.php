<?php
session_start();
include __DIR__ .'/../../admin/includes/posts_functions.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include __DIR__ .'/../../templates/head.html.php';?>
	<?php $posts = getPostById($post_id); ?>
</head>
<body>
	<header>
		<?php include __DIR__ .'/../../templates/header.html.php';?>
	</header>
	<main class="group">
		<section class='col-3-5'>
			<?php //include __DIR__ . '/front-end-form-validation.php'; ?>
			<?php echo $posts['post_body']?>
			
		</section><!--
		--><aside class='col-2-5'>
			
		</aside>
	
	</main>
	<footer>
		<div class="group">
			<span class="float-right">
				<?php include  __DIR__ .'/../../templates/nav.html.php'; ?>	
			</span>
			<span class="float-left">&copy;<?php date_default_timezone_set("Africa/Nairobi");echo date('Y');?>&nbsp;Spex.co.ke</span>
		</div>
		
	</footer>
</body>
<script src="/spexproject/resources/js/jquery-3.4.0.min.js"></script>
<script src="/spexproject/resources/js/comments-scripts.js"></script>
<script src="/spexproject/resources/js/menu-profile-controls.js"></script>
</html>
