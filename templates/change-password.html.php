<?php
session_start();

include __DIR__ . '/../includes/loginStatus.php';
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset</title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
	<h4 class="errorMsg">You are about to change your password. </h4>
	<p class="form-p">Fields marked with <span class="red"> &#42;</span> are mandatory. </p>
	<p class="form-p">Passwords must be at least eight characters.</p>

	<div id="reset">
	<h2>Change Password</h2>
	
		<form method="POST" action="../includes/processFormAuthentication-Test.php">
			<label for="old_password">Old Password:<span class="red"> &#42;</span></label>
			 <input type="password" name="old_password" autocomplete="off" required>
			<span class="errorMsg"><?php echo (!empty($errors['old_password'])? $errors['old_password'] :'');?></span>
						 
			<label for="new_password">New Password:<span class="red"> &#42;</span></label>
			 <input type="password" name="new_password" autocomplete="off" required>
			<span class="errorMsg"><?php echo (!empty($errors['new_password'])? $errors['new_password'] :'');?></span>
			
			<label for="confirm_new_password">Confirm New Password:<span class="red"> &#42;</span></label>
			 <input type="password" name="confirm_new_password" autocomplete="off" required>
			<span class="errorMsg"><?php echo (!empty($errors['confirm_new_password'])? $errors['confirm_new_password'] :'');?></span>
					
			<input type="submit" name="change_password" class="button" value="Change"> 
		</form>
	</div>
</body>
</html>