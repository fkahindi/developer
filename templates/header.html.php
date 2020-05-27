<div class="group">
	<!-- Banner bar follows-->
	<div class="banner-bar">
		<a href="<?php echo BASE_URL ?>index.php">Developers Pot</a>
	</div>
		<!--Navigation bar follows-->
	<div class="nav-bar">
		<div id="dropdown-menu-btn">&#9776;</div>
		<nav class="dropdown-content">
		<?php require_once __DIR__ .'/nav.html.php'; ?>	
		</nav>
	</div>
		<!--Login and Search bars follows -->
	<div class="log-account-section">
		<div class="group">
			<div class="login-signup">
			<?php echo (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']=== false)? 
			'<a href="'.BASE_URL .'templates/login.html.php">Login </a>&nbsp;'
			: '' ?>
			</div>	
			<div class="account-photo-box tooltip ">
				<label for="profile-checkbox-control" id="tooltip">
					<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true):?> 
					<span>  <img src="<?php echo $_SESSION['profile_photo'] ?>" alt="" class="image-photo"></span></label>
				
				<div class="tooltip-text">
					<p><strong>Account:</strong></p> 
					<p><?php echo $_SESSION['fullname'] ?></p>
					<p><?php echo $_SESSION['email'] ?></p>
				</div>
				<input type="checkbox" id="profile-checkbox-control">
				<div class="account-display-settings">
					<ul>
						<li><a href="<?php echo BASE_URL ?>templates/change-password.html.php">Change Password </a> 
						</li>
						<li><a href="<?php echo BASE_URL ?>templates/imageupload.html.php">Add Profile Photo</a></li>
						<li><a href="<?php echo BASE_URL ?>includes/logout.php">Sign out </a></li>
						<?php if($_SESSION['role'] == 'Admin'):?>
							<li><a href="<?php echo BASE_URL ?>admin/dashboard.php">Admin Area </a></li>
						<?php elseif($_SESSION['role'] == 'Author'): ?>
							<li><a href="<?php echo BASE_URL ?>admin/posts.php">Admin Posts </a></li>
						<?php endif; ?>
					</ul>
				</div>
				<?php endif; ?>
			</div>						
		</div>
	</div>	
</div>