<?php 
include __DIR__ .'/../includes/process_form.php'; 
if(isset($_POST['recover_password'])){
	recoverPassword();	
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Recover Password </title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
	<div id="recover">
		<div class="form_image">
			<div class="banner-bar"><h2>Developers Pot</h2></div>
			<?php ?>
			<div id="error_msg"><?php echo(!empty($email_error)? $email_error :'');?></div>
			<p class="form-p">Please fill out this form to recover your password.</p>
			<h3>Recover Password</h3>
		</div>
		<form method="POST" action="">
			<label for="email">Enter your email address:</label>
			 <input type="email" name="email" maxlength="50" autocomplete="off" required> <span class="errorMsg">
			 <?php echo (!empty($errors['email'])? $errors['email'] :'');?></span>
			 
			<input type="submit" name="recover_password" class="button" value="Submit"> 
		</form>
	</div>
</body>
</html>