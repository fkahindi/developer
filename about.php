<?php 
session_start(); 
require_once __DIR__ .'/config.php';

?>
<!DOCTYPE html>
<html lang="en">
	<!-- head section -->
	<?php require_once __DIR__ .'/templates/head.html.php'; ?>
	<!--// head section -->
	<title>Developers Pot</title> 
	</head>
	<body>
		<header>
		<?php require_once __DIR__ . '/templates/header.html.php';?>
		</header>
		<main class="group">
			<aside class="col-2-10 hide-in-mobile">
				
			</aside><!--
			--><section class="col-5-10">
				<h1>Developers Pot</h1><hr>
				<div>	
					<p>Developers Pot is a blog dedicated to web web development. It highlights <span class="key">web development technologies</span> and especially the nifty areas that may be tricky to new developers.  </p>
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
				<span class="float-right">
					<?php include  __DIR__ .'/templates/nav.html.php'; ?>	
				</span>
				<span class="float-left">
					<?php include __DIR__ . '/templates/copyright.html.php';?>
				</span>
		</footer>
	</body>
	<script src="<?php echo BASE_URL ?>resources/js/jquery-1.7.2.min.js"></script>
	<script src="<?php echo BASE_URL ?>resources/js/get-meta-keywords.js"></script>
	<script src="<?php echo BASE_URL ?>resources/js/menu-profile-controls.js"></script>
</html>