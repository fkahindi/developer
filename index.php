<?php session_start(); ?>

<!-- head section -->
<?php require_once __DIR__ .'/templates/head.html.php'; ?>
<!--// head section -->
<title>Spex Management Solutions</title> 
</head>
<body>
	<!-- Header bar -->
	<header>
	<?php require_once __DIR__ . '/templates/header.html.php';?>
	</header>
	<!-- //Header bar -->
	
	<!-- Main content wrapper -->
	<main class="group">
		<!-- Main section-->
		<section class='col-3-5'>
			
			
		</section>
		<!-- //Main section-->
		<!-- Sidebar-->
		<aside class='col-2-5'>
			
		</aside>
		<!-- //Sidebar-->
	
	</main>
	<!-- //Main content wrapper -->
	<!--Footer bar  -->
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