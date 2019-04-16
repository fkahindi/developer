
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include __DIR__ .'/../templates/head.html.php';?>
</head>
<body>
	<header>
		<div class="group">
			<div class="login-bar">
				<?php echo (isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true)? 
				'<a href="/spexproject/includes/logout.php">Log out </a> <span>&#124;</span>':  
				'<a href="/spexproject/templates/login.html.php">Login </a> <span>&#124;</span>'; ?>
				<a href="/spexproject/templates/signup.html.php">Sign up</a> 
				<div class="special">
				<?php echo (isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true)? $_SESSION['email']. '<span>&#124;</span>': ''; ?>
				<?php echo (isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true)? '<a href="/spexproject/templates/change-password.html.php">Change password </a>' : ''; ?>
				</div>
			</div><!--
		
			--><div class="banner">
				<img src="/spexproject/resources/images/spexbanner.png" alt="Spex Banner" width="60%" height="60%">
				
			</div>
			
		</div>
		<div class="dropdown">
			<button class="dropdown-button">|||</button>
			<nav class="dropdown-content">
				<?php include  __DIR__ .'/../templates/nav.html.php'; ?>	
		
			</nav>
		</div>
	</header>
	<main class="group">
		<section class='col-3-5'>
			
			
		</section><!--
		--><aside class='col-2-5'>
			<?php
				if(count($_COOKIE)>0){
					echo "Cookies are enabled";
				}else{
					echo "Cookies are disabled";
				}
			?>
		</aside>
	
	</main>
	<footer>
		<div class="group">
			<span class="float-right">
				<?php include  __DIR__ .'/../templates/nav.html.php'; ?>	
			</span>
			<span class="float-left">&copy;<?php date_default_timezone_set("Africa/Nairobi");echo date('Y');?>&nbsp;Spexdata.com</span>
		</div>
		
	</footer>
</body>
</html>