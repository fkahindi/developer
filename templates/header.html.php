<div class="group">
	<!-- Banner bar follows-->
	<div class="banner-bar">
		<img src="/spexproject/resources/images/spexbanner-orange-yellow.png" alt="Spex Banner" class="banner">
	</div>
	<!--Navigation bar follows-->
	<div class="nav-bar dropdown">
	<button class="dropdown-button">|||</button>
	<nav class="dropdown-content">
		<?php include  __DIR__ .'/nav.html.php'; ?>	

	</nav>
	</div>	
	<!--Login bar follows -->
	<div class="login-bar">
		<div class="group">
			<div class="account-photo-box">
			<?php echo (isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true)? '<span> <img src="' .$_SESSION['photo'].'" alt="" class="image-photo"></span>':'';?>
			</div>
			<div class="login-signup ">
			<?php echo (isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true)? 
			'<a href="/spexproject/includes/logout.php">Log out </a> <span> &#124; </span>
			<span class="settings">
				<ul>
					<li><a href="#">Settings</a></li>
					<ul class="settings-content">
						<li><a href="/spexproject/templates/change-password.html.php">Change password </a> 
						</li>
						<li><a href="/spexproject/templates/imageupload.html.php">Add Profile Photo</a></li>
					</ul>
				</ul>						
			</span>':  
			'<a href="/spexproject/templates/login.html.php">Login </a> <span>&#124;</span>
			<a href="/spexproject/templates/signup.html.php">Sign up</a> '; ?>
			</div>
		</div>
		<div class="special">
		<?php echo (isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true)? $_SESSION['fullname']: ''; ?>			
		</div>
	</div>	
</div>