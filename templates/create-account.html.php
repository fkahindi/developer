<?php 
if(!isset($_SESSION)){
	session_start();
}
require_once __DIR__ .'/../config.php';
include __DIR__ .'/../includes/process_form.php';
if(isset($_POST['create-account'])){
	createAccount();
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create Account</title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
		<div id="create-account">
			<div class="successMsg"><?php echo(!empty($form_success)? $form_success:''); ?></div>
			<div class="form_image">
				<div class="banner-bar"><h2>Developers Pot</h2></div>
				<div id="error_msg"><?php echo(!empty($form_error)? $form_error :'');?></div>
				<h2>Create Account </h2>
				<p>Fields marked with <span class="red"> &#42;</span> are mandatory. </p>
			</div>
		
		<form  method="POST" action="" id="signup_form" >
					
			<div class="group-form">
				<label for="username">Username:<span class="red"> &#42;</span></label>
				<input  name="username" id="username" class="form-control" type="text" 
				value="<?php echo (empty($username)? '': $username); ?>" maxlength="50" autocomplete="off" >
				<span class="errorMsg"> <?php echo(!empty($errors['username']) ? $errors['username'] : ''); ?></span>
			</div>
			
			<div class="group-form">
				<label for="email"> Email:<span class="red"> &#42;</span></label>
				<input name="email" id="email" class="form-control" type="email" value="<?php echo(empty($email)? '': $email); ?>" maxlength="50" autocomplete="off" >
				<span class="errorMsg"> <?php echo(!empty($errors['email']) ? $errors['email'] : ''); ?> </span>
			</div>
			<input name="create-account" type="submit" id="submit_btn" class="button" value="Create Account">
		</form>
	</div>
	<div class="section">
		<p>Aready have an account? <a href="<?php echo BASE_URL ?>templates/login.html.php">Log in </a>.</p>
	</div>
</body>
</html>
<!-- Scripts -->
<script src="<?php echo BASE_URL ?>resources/js/jquery-1.7.2.min.js"></script>
<script src="<?php echo BASE_URL ?>resources/js/form_check.js"></script>