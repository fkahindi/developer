<?php 
if(!isset($_SESSION)){
	session_start();
}
include __DIR__ .'/classes/ContactForm.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
	global $errorField;
	//$errors['username']='';
	$email = $_POST['email'];
	$username = $_POST['username'];
	$fieldEmptyCheck = new ContactForm();
	$fieldEmptyCheck->isFieldEmpty($username, 'username');
	$errors['username'] = $errorField;
	echo $errorField;
	$fieldEmptyCheck->isFieldEmpty($email, 'email');
	$errors['email'] = $fieldEmptyCheck->errorField;;
	echo $errors['username'];
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Create Account</title>
	<link rel="stylesheet" href="resources/css/form.css">
</head>
<body>
	<div class="successMsg"><?php echo(!empty($form_success)? $form_success:''); ?></div>
	<div id="create-account">
		<div class="form_image">
			<div class="banner-bar"><h2>Developers Pot</h2></div>
			<div id="error_msg"><?php echo(!empty($form_error)? $form_error :'');?></div>
			<h3>Create Account </h3>
			<p>Fields marked with <span class="red"> &#42;</span> are mandatory. </p>
		</div>
	<form  method="POST" action ="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" id="signup_form" >	
		<div class="group-form">
			<label for="username">Username:<span class="red"> &#42;</span></label>
			<input  name="username" id="username" class="form-control" type="text" 
			value="<?php echo (empty($username)? '': $username); ?>" maxlength="50" autocomplete="off" >
			<span class="errorMsg"> <?php echo(empty($errors['username']) ? '': $errors['username']); ?></span>
		</div>
		<div class="group-form">
			<label for="email"> Email:<span class="red"> &#42;</span></label>
			<input name="email" id="email" class="form-control" type="email" value="<?php echo(empty($email)? '': $email); ?>" maxlength="50" autocomplete="off" >
			<span class="errorMsg"> <?php echo(empty($errors['email']) ? '': $errors['email']); ?> </span>
		</div>
		<div class="group-form">
			<label for="privacy">
			<input type="checkbox" name="privacy" value="privacy" id="privacy-checkbox"><span class="red"> &#42;</span> Yes, I have read and agree with the <a href="<?php echo BASE_URL ?>policies/privacy-policy.php">privacy policy</a></label>
			<span class="errorMsg"> <?php echo(!empty($errors['privacy']) ? $errors['privacy'] : ''); ?> </span>
		</div>
		<input name="create-account" type="submit" id="submit_btn" class="button" value="Create Account">
		
	</form>
</div>
	<div class="section">
		<p>Aready have an account? <a href="<?php echo BASE_URL ?>templates/login.html.php">Log in </a>.</p>
	</div>
	<!-- Scripts -->
	<script src="<?php echo BASE_URL ?>resources/js/jquery-1.7.2.min.js"></script>
	<script src="<?php echo BASE_URL ?>resources/js/form_check.js"></script>
</body>
</html>
