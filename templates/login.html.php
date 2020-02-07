<?php
if(!isset($_SESSION)){
	session_start();
} 
require_once __DIR__ .'/../config.php';
include_once __DIR__ . '/../includes/process_form.php';
if(isset($_POST['login'])){
	login();
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Log in</title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
	<h4 class="successMsg"><?php echo(!empty($_SESSION['success_msg'])? $_SESSION['success_msg']:'');?></h4>
		
	<div id="login">
		<h5 class="errorMsg"><?php echo(isset($form_error)? $form_error: '');?></h5>
		<div class="form_image">
			<div class="banner-bar"><h2>Developers Pot</h2></div>
			<h2>Login</h2>
		
		</div>
	
		<form method="POST" action="">
			<label for="email">Email address:</label>
			 <input type="text" name="email" value="<?php echo (!empty($email)? $email:'');?>" autocomplete="off"> <span class="errorMsg"><?php echo (!empty($errors['email'])? $errors['email'] :'');?></span>
			
			<label for="password">Password: <span class="right-align"> </span></label>
			 <input type="password" name="password" autocomplete="off" >
			<span class="errorMsg"><?php echo (!empty($errors['password'])? $errors['password'] :'');?></span>
					
			<input type="submit" name="login" class="button" value="Log in"> 
			<?php echo(!empty($signup_option)? $signup_option : '');?>
			
		</form>
	</div>
	<div class="section">
		<p class="centered"><a href="<?php echo BASE_URL ?>templates/recover-password.html.php">Forgot password</a> | <a href="<?php echo BASE_URL ?>templates/create-account.html.php"> Create an account.</a></p>
	</div>
</body>
</html>