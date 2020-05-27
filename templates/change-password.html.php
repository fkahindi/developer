<?php

if(!isset($_SESSION)){
	session_start();
}
include __DIR__ . '/../includes/loginStatus.php';
include __DIR__ .'/../includes/process_form.php';
if(isset($_POST['change_password'])){
changePassword();
}
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Change Password </title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
	<div id="reset">
		
		<div class="form_image">
			<div class="banner-bar"><h2>Developers Pot</h2></div>
			<p class="form-p">Fields marked with <span class="red"> &#42;</span> are mandatory. </p>
			<h3>Change Password</h3>
		</div>
	
	
		<form method="POST" action="">
			<div class="group-form">
				<label for="old_password">Old Password:<span class="red"> &#42;</span></label>
				 <input type="password" name="old_password" maxlength="50" autocomplete="off" required>
				<span class="errorMsg"><?php echo (!empty($errors['old_password'])? $errors['old_password'] :'');?></span>
			</div>
			
			<div class="group-form">
				<label for="new_password">New Password:<span class="red"> &#42;</span></label>
				 <input type="password" name="new_password" id ="new_password" maxlength="50" autocomplete="off" required>
				<span class="errorMsg"><?php echo (!empty($errors['new_password'])? $errors['new_password'] :'');?></span>
				<ul class="form-guidelines">
						<li>Passwords must be at least <strong>6</strong> characters.</li>
						<li>May contain letters, numbers, underscore, hyphen or dot.</li>
				</ul>
			</div>
			
			<div class="group-form">
			<label for="confirm_new_password">Confirm New Password:<span class="red"> &#42;</span></label>
			 <input type="password" name="confirm_new_password" id ="confirm_new_password" maxlength="50" autocomplete="off" required>
			<span class="errorMsg"><?php echo (!empty($errors['confirm_new_password'])? $errors['confirm_new_password'] :'');?></span>
			</div>
			
			<input type="submit" name="change_password" class="button" value="Change"> 
		</form>
	</div>
</body>
</html>