<?php include __DIR__ .'/../includes/form_signup_preprocess.php' ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create Account</title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
		<div id="create-account">
			<div class="form_image">
				<img src="../resources/images/spexbanner.png" width="60%" height="30" alt="" >
				
				<div id="error_msg"></div>
				<h2>Create Account </h2>
				<p>Fields marked with <span class="red"> &#42;</span> are mandatory. </p>
			</div>
		
		<form  method="POST" action="../includes/processFormAuthentication-Test.php" id="signup_form" >
		
			<div class="group-form">
				<label for="fullname">Full Name:</label>
				<input  name="fullname" id="fullname" class="form-control" type="text" 
				value="<?php echo (empty($fullname)? '': $fullname); ?>" maxlength="50" autocomplete="off" >
				<span class="errorMsg"> <?php echo(!empty($errors['fullname']) ? $errors['fullname'] : ''); ?></span>
			</div>
			
			<div class="group-form">
				<label for="username">Username:<span class="red"> &#42;</span></label>
				<input  name="username" id="username" class="form-control" type="text" 
				value="<?php echo (empty($username)? '': $username); ?>" maxlength="50" autocomplete="off" required>
				<span class="errorMsg"> <?php echo(!empty($errors['username']) ? $errors['username'] : ''); ?></span>
			</div>
			
			<div class="group-form">
				<label for="email"> Email:<span class="red"> &#42;</span></label>
				<input name="email" id="email" class="form-control" type="email" 
				 type="email" value="<?php echo(empty($email)? '': $email); ?>" autocomplete="off" required>
				<span class="errorMsg"> <?php echo(!empty($errors['email']) ? $errors['email'] : ''); ?> </span>
			</div>
			<input name="create-account" type="submit" id="submit_btn" class="button" value="Create Account">
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