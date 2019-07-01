<?php
if(!isset($_SESSION)){
	session_start();
}
if(isset($_GET['email']) && isset($_GET['key'])){
	
	$email=$_GET['email'];
	$token=$_GET['key'];	
}
	

if(!empty($email) && !empty($token)){	
?>
	
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Reset</title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
	<h3> </h3>
	<p class="form-p">Please fill out this form to reset your password.</p>
	<p class="form-p">Fields marked with <span class="red"> &#42;</span> are mandatory. Passwords must be at least 6 characters.</p>
	<p class="form-p">Passwords should only contain letters, numbers and underscores</p>
	<div id="error_msg"></div>
	<div id="reset">
			<div class="form_image">
				<img src="../resources/images/spexbanner.png" width="60%" height="30" alt="" >
				<h2>Reset Password</h2>
			</div>
		<form method="POST" name ="reset-password" action="../includes/processFormAuthentication-Test.php">
		
			<input type="hidden" name="action" value="update">
			
			<label for="new_password">New Password:<span class="red"> &#42;</span></label>
			 <input type="password" id ="password" name="new_password" value="<?php echo(empty($new_password)? '': $new_password); ?>" autocomplete="off" >
			<span class="errorMsg"><?php echo (!empty($errors['new_password'])? $errors['new_password'] :'');?></span>
			
			<label for="confirm_new_password">Confirm New Password:<span class="red"> &#42;</span></label>
			 <input type="password" id="confirm_password" name="confirm_new_password" value="<?php echo(empty($confirm_new_password)? '': $confirm_new_password); ?>" autocomplete="off" >
			<span class="errorMsg"><?php echo (!empty($errors['confirm_new_password'])? $errors['confirm_new_password'] :'');?></span>
			
			<input type="hidden" name="email" value="<?php echo $email; ?>">
			<input type="hidden" name="token" value="<?php echo $token; ?>">
					
			<input type="submit" name="reset_password" id="submit_btn" class="button" value="Reset Password"> 
		</form>
	</div>
</body>
</html>
<?php  
}else{
	echo 'Token was not found.';
}
?>
