<div class="group">
	<!-- Banner bar follows-->
	<div class="banner-bar">
		<img src="/spexproject/resources/images/spexbanner-orange-yellow.png" alt="Spex Banner" class="banner">
	</div>
	<!--Navigation bar follows-->
	<div class="nav-bar dropdown">
	<button class="dropdown-button">|||</button>
	<nav class="dropdown-content">
		<?php require_once __DIR__ .'/nav.html.php'; ?>	

	</nav>
	</div>	
	<!--Login bar follows -->
	<div class="login-bar">
		<div class="group">
			<div class="account-photo-box tooltip">
				<label for="checkbox-control">
								<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true):?> 
					<span>  <img src="<?php echo $_SESSION['profile_photo'] ?>" alt="" class="image-photo"></span>
				</label>
				
					<div class="tooltip-text">
						<p><strong>Spex Account:</strong></p> 
						<p><?php echo $_SESSION['fullname'] ?></p>
						<p><?php echo $_SESSION['email'] ?></p>
					</div>
					<input type="checkbox" id="checkbox-control">
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
			<div class="login-signup">
			<?php echo (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']== false)? 
			'<a href="/spexproject/templates/login.html.php">Login </a> <span>&#124;</span>
			<a href="/spexproject/templates/signup.html.php">Sign up</a> '
			: '' ?>
			</div>
		</div>
		
	</div>	
</div>

