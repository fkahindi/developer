<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Log in</title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
	<h3 class="successMsg"><?php echo(!empty($GLOBALS['successMsg'])? $GLOBALS['success_msg'] :'');?></h3>
	<p><?php echo(!empty($loginMsg)? $loginMsg :''); ?></p>
	
	<div id="login">
	<h2>Please, Login</h2>
	
		<form method="POST" action="../includes/processFormAuthentication-Test.php">
			<label for="email">Email address:</label>
			 <input type="text" name="email" value="<?php echo (!empty($email)? $email:'');?>"autocomplete="off" required> <span class="errorMsg"><?php echo (!empty($errors['email'])? $errors['email'] :'');?></span>
			
			<label for="password">Password: <span class="right-align">
			<a href="../templates/recover-password.html.php">Forgot password?</a> </span></label>
			 <input type="password" name="password" autocomplete="off" required>
			<span class="errorMsg"><?php echo (!empty($errors['password'])? $errors['password'] :'');?></span>
					
			<input type="submit" name="login" class="button" value="Log in"> 
			<?php echo(!empty($signup_option)? $signup_option : '');?>
			
		</form>
	</div>
	<div class="section">
		<p>New to Spex? <a href="/spexproject/templates/signup.html.php"> Create an account.</a></p>
	</div>
</body>
</html>