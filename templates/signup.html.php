<?php include __DIR__ .'/../includes/form_signup_preprocess.php' ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign Up</title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
	
	
		
		<div id="register">
			<div class="form_image">
				<img src="../resources/images/spexbanner.png" width="60%" height="30" alt="" >
				<p class="form-p">Fields marked with <span class="red"> &#42;</span> are mandatory. </p>
				<div id="error_msg"></div>
				<h2>Sign Up </h2>
			</div>
		
		<form  method="POST" action="../includes/processFormAuthentication-Test.php" id="signup_form" >
		
			<div class="group-form">
				<label for="fullname">Full Name:</label>
				<input  name="fullname" id="fullname" class="form-control" type="text" 
				value="<?php echo (empty($fullname)? '': $fullname); ?>" maxlength="35" autocomplete="off" >
				<span class="errorMsg"> <?php echo(!empty($errors['fullname']) ? $errors['fullname'] : ''); ?></span>
			</div>
			
			<div class="group-form">
				<label for="username">Username:<span class="red"> &#42;</span></label>
				<input  name="username" id="username" class="form-control" type="text" 
				value="<?php echo (empty($username)? '': $username); ?>" maxlength="15" autocomplete="off" required>
				<span class="errorMsg"> <?php echo(!empty($errors['username']) ? $errors['username'] : ''); ?></span>
			</div>
			
			<div class="group-form">
				<label for="email"> Email:<span class="red"> &#42;</span></label>
				<input name="email" id="email" class="form-control" type="email" 
				 type="email" value="<?php echo(empty($email)? '': $email); ?>" autocomplete="off" required>
				<span class="errorMsg"> <?php echo(!empty($errors['email']) ? $errors['email'] : ''); ?> </span>
			</div>

			<div class="group-form">
				<label for="password">Password:<span class="red"> &#42;</span></label>
				<input name="password" id="password" class="form-control" type="password" autocomplete="off" required>
				<span class="errorMsg"><?php echo(!empty($errors['password']) ? $errors['password'] : ''); ?></span>
				<ul>
					<li>Passwords must be at least <strong>6</strong> characters.</li>
					<li>May contain letters, numbers with underscores.</li>
				</ul>
			</div>
			
			<div class="group-form">
			<label for="confirm_password">Confirm Password:<span class="red"> &#42;</span></label>
			<input name="confirm_password" id="confirm_password" class="form-control" type="password" autocomplete="off" required>
			<span class="errorMsg"><?php echo(!empty($errors['confirm_password']) ? $errors['confirm_password'] : ''); ?>	</span>
			</div>
			<input name="signup" type="submit" id="submit_btn" class="button" value="Sign Up">
		</form>
	</div>
	<div class="section">
		<p>Aready have an account? <a href="/spexproject/templates/login.html.php">Log in </a>.</p>
	</div>
</body>
</html>
<!-- Scripts -->
<script src="/spexproject/resources/js/jquery-3.4.0.min.js"></script>
<script src="/spexproject/resources/js/form_check.js"></script>