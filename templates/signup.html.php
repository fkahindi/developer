<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign Up</title>
	<link rel="stylesheet" href="../resources/css/form.css">
	<style type="text/javascript" src="../resources/js/form.js"></style>
</head>
<body>
	<p class="form-p">Fields marked with <span class="red"> &#42;</span> are mandatory. Passwords must be at least eight characters.</p>
	
	<div id="register">
		<h2>Sign Up Here </h2>
		<form action="../includes/processFormAuthentication-Test.php" method ="POST" name="signup" onsubmit ="return validateFormOnSubmit(this)">
		
			<div class="group-form">
				<label for="fullname">Full Name:<span class="red"> &#42;</span></label>
				<input  name="fullname" id="fullname" class="form-control" type="text" 
				value="<?php echo (empty($fullname)? '': $fullname); ?>" autocomplete="off" >
				<span class="errorMsg"> <?php echo(!empty($errors['fullname']) ? $errors['fullname'] : ''); ?></span>
			</div>
			
			<div class="group-form">
				<label for="email"> Email:<span class="red"> &#42;</span></label>
				<input name="email" id="email" class="form-control" type="text" 
				 type="email" value="<?php echo(empty($email)? '': $email); ?>" autocomplete="off" >
				<span class="errorMsg"> <?php echo(!empty($errors['email']) ? $errors['email'] : ''); ?> </span>
			</div>

			<div class="group-form">
				<label for="password">Password:<span class="red"> &#42;</span></label>
				<input name="password" id="password" class="form-control" type="password" autocomplete="off" >
				<span class="errorMsg" ><?php echo(!empty($errors['password']) ? $errors['password'] : ''); ?></span>
			</div>
			
			<div class="group-form">
			<label for="confirm_password">Confirm Password:<span class="red"> &#42;</span></label>
			<input name="confirm_password" id="confirm_password" class="form-control" type="password" autocomplete="off" >
			<span class="errorMsg"><?php echo(!empty($errors['confirm_password']) ? $errors['confirm_password'] : ''); ?>	</span>
			</div>
			<input name="signup"  type="submit" class="button" value="Sign Up">
		</form>
	</div>
	<div class="section">
		<p>Aready have an account? <a href="/spexproject/templates/login.html.php">Log in here</a>.</p>
	</div>
</body>
</html>