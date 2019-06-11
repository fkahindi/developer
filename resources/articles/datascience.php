<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

	<?php include __DIR__ .'/../../templates/head.html.php';?>
	<title>Data Science</title>
</head>
<body>
	<header>
		<?php include __DIR__ .'/../../templates/header.html.php';?>
	</header>
	<main class="group">
		<section class='col-3-5'>
			<?php include 'best-statistical-software-package.php'; ?>
			
			<!--Comments sections  -->
			<?php include __DIR__ .'/../../comments/layout/comments-layout.php'; ?>
		</section><!--
		--><aside class='col-2-5'>
			
		</aside>
	    
		
	</main>
	<footer>
		<div class="group">
			<span class="float-right">
				<?php include  __DIR__ .'/../../templates/nav.html.php'; ?>	
			</span>
			<span class="float-left">
				<?php include __DIR__ . '/../../templates/copyright.html.php';?>
			</span>
		</div>
		
	</footer>
</body>
</html>
