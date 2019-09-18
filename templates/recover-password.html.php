<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Recover Password </title>
	<link rel="stylesheet" href="../resources/css/form.css">
</head>
<body>
	<div id="recover">
		<div class="form_image">
			<img src="../resources/images/spexbanner.png" width="60%" height="30" alt="" >
			<p class="form-p">Please fill out this form to recover your password.</p>
			<h2>Recover Password</h2>
		</div>
		<form method="POST" action="../includes/processFormAuthentication-Test.php">
			<label for="email">Enter your email address:</label>
			 <input type="email" name="email" autocomplete="off" required> <span class="errorMsg">
			 <?php echo (!empty($errors['email'])? $errors['email'] :'');?></span>
			 
			<input type="submit" name="recover_password" class="button" value="Submit"> 
		</form>
	</div>
</body>
</html>