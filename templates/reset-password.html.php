<?php
if(!isset($_SESSION)){
	session_start();
}
if(isset($_GET['email']) && isset($_GET['key'])){
	
	$email=$_GET['email'];
	$token=$_GET['key'];	
}
	

if(!empty($email) && !empty($token)){
include __DIR__ .'/../includes/process_form.php';
if(isset($_POST['reset_password'])){	
	resetPassword();	
}
?>
	
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reset Password</title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>		
	<div id="error_msg"></div>
	<div id="reset">
		<div class="form_image">
				<div class="banner-bar"><h2>Developers Pot</h2></div>
				<p class="form-p">Fields marked with <span class="red"> &#42;</span> are mandatory</p>
				<h3>Reset Password</h3>
		</div>					
		<form method="POST" name ="reset-password" action="">
		
			<input type="hidden" name="action" value="update">
			<div class="group-form">
			<label for="new_password">New Password:<span class="red"> &#42;</span></label>
			 <input type="password" id ="password" name="new_password" value="<?php echo(empty($new_password)? '': $new_password); ?>" maxlength="50" autocomplete="off" >
			<span class="errorMsg"><?php echo (!empty($errors['new_password'])? $errors['new_password'] :'');?></span>
				<ul class="form-guidelines">
					<li>Passwords must be at least <strong>6</strong> characters.</li>
					<li>May contain letters, numbers, underscore, hyphen or dot.</li>
				</ul>
			</div>
			
			<div class="group-form">
			<label for="confirm_new_password">Confirm New Password:<span class="red"> &#42;</span></label>
			 <input type="password" id="confirm_password" name="confirm_new_password" value="<?php echo(empty($confirm_new_password)? '': $confirm_new_password); ?>" maxlength="51" autocomplete="off" >
			<span class="errorMsg"><?php echo (!empty($errors['confirm_new_password'])? $errors['confirm_new_password'] :'');?></span>
			</div>
			
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
