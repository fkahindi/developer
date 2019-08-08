<div class="group">
	<!-- Banner bar follows-->
	<div class="banner-bar">
		<img src="/spexproject/resources/images/spexbanner-orange-yellow.png" alt="Spex Banner" class="banner">
	</div>
	<!--Navigation bar follows-->
	<div class="nav-bar dropdown">
	<label for="menu-checkbox-control" class="dropdown-button">|||
	<input type="checkbox" id="menu-checkbox-control">
	</label>
		<nav class="dropdown-content">
		<?php require_once __DIR__ .'/nav.html.php'; ?>	

	</nav>
	</div>
	
	<!--Login and Search bars follows -->
	<div class="login-bar">
		<div class="group">
			<div class="account-photo-box tooltip ">
				<label for="profile-checkbox-control" id="tooltip">
								<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true):?> 
					<span>  <img src="<?php echo $_SESSION['profile_photo'] ?>" alt="" class="image-photo"></span>
				</label>
				
					<div class="tooltip-text">
						<p><strong>Account:</strong></p> 
						<p><?php echo $_SESSION['fullname'] ?></p>
						<p><?php echo $_SESSION['email'] ?></p>
					</div>
					<input type="checkbox" id="profile-checkbox-control">
					<div class="account-display-settings">
						 															
 						<ul>
							<li><a href="/spexproject/templates/change-password.html.php">Change Password </a> 
							</li>
							<li><a href="/spexproject/templates/imageupload.html.php">Add Profile Photo</a></li>
							<li><a href="/spexproject/includes/logout.php">Sign out </a></li>
						</ul>
					</div>
				<?php endif; ?>
					
			</div>
			<div class="login-signup-search-bar">
				<!--Search bar -->
				<div class="search-container">
					<form action="" method="GET">
						<span><input type="text" placeholder="Search..." name="search"></span>
						<span><button type="submit"><i class="fa fa-search"></i></button></span>
					</form>
				</div>
				<div class="login-signup">
				<?php echo (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']== false)? 
				'<a href="/spexproject/templates/login.html.php">Login </a> <span>&#124;</span>
				<a href="/spexproject/templates/signup.html.php">Sign up</a> '
				: '' ?>
				</div>
			</div>
		</div>
		
	</div>	
</div>

