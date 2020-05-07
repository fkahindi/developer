<?php 
session_start(); 
require_once __DIR__ .'/config.php';

?>
<!DOCTYPE html>
<html lang="en">
	<!-- head section -->
	<?php require_once __DIR__ .'/templates/head.html.php'; ?>
	<!--// head section -->
	<title>About | Who we are</title> 
	</head>
	<body>
		<header>
		<?php require_once __DIR__ . '/templates/header.html.php';?>
		</header>
		<main class="group">
			<aside class="col-2-10 hide-in-mobile">
				
			</aside><!--
			--><section class="col-5-10">
				<h1>About Us</h1><hr>
				<div>	
					<p><em>Developing something that others find useful is great. But even greater is when what you are passionate about is helping others to be great.</em></p>
					<p>Developerspot is a blogging site/ app dedicated to sharing web development trends and skills with those who aspire to start their journey in app development or are struggling along the way. On this blog we highlight technical areas that many take for granted but are challenging to the upcoming developers.</p>
					<p>The comment system at the end of each post is a means to interact, share experiences and solve real problems. Creating a developers ecosystem where the experienced and novice form a symbiotic relationship for the betterment of the community is hard, but we encourage it. Signing up is being part of the ecosystem.</p>
				</div>
				
			</section><!--			
			--><aside class="col-3-10">
				<!-- Sidebar content goes here-->
				
				</div>
			</aside><!--			
			--><aside class="hide-in-bigger-screens">
				
			</aside>	
		</main>
		<footer class="group">
			<?php include __DIR__ .'/templates/footer.html.php'?>
		</footer>
		<script src="<?php echo BASE_URL ?>resources/js/jquery-1.7.2.min.js"></script>
		<script src="<?php echo BASE_URL ?>resources/js/get-meta-keywords.js"></script>
		<script src="<?php echo BASE_URL ?>resources/js/menu-profile-controls.js"></script>
	</body>
</html>