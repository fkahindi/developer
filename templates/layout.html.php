
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include __DIR__ .'/head.html.php';?>
</head>
<body>
	<header>
		<?php include __DIR__ .'/header.html.php';?>
	</header>
	<main class="group">
		<section class='col-3-5'>
			<?php echo $output;?>
			
		</section><!--
		--><aside class='col-2-5'>
			
		</aside>
	
	</main>
	<footer>
		<div class="group">
			<span class="float-right">
				<?php include  __DIR__ .'/nav.html.php'; ?>	
			</span>
			<span class="float-left">
				<?php include __DIR__ . '/copyright.html.php';?>
			</span>
		</div>
		
	</footer>
</body>
</html>