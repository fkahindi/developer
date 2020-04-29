    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    	
    	//Set empty variables
    	$name=$email=$tel=$password=$comment="";
    	
    	//Collect input values into variables 
    	$name = $_POST["name"];
    	$email = $_POST["email"];
    	$tel = $_POST["tel"];
    	$password = $_POST["password"];
    	$comment = $_POST["comment"];
    	$errors = [];
    	$valid = true;
    	
    	//Regular expressions
    	$text_pattern = "/^(?:[a-zA-Z])[\w\s.-]{2,}$/";
    	$tel_pattern = "/^(\+\d{1,3})?[0]?[\d]{9}$/";
    	$password_pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\W_]{8,}$/";
    		
    	//First check that the mandatory fields are not empty
    	//Then sanitize and validate
    	
    	if(empty($_POST["name"])){
    		$errors["name"] = "Name can't be empty";
    		$valid = false;
    	}else{
    		$name = filter_var($name, FILTER_SANITIZE_STRING);
    		//Validate name field
    		if(!preg_match($text_pattern, $name)){
    			$valid = false;
    			$errors["name"] = "Name rejected.";
    		}
    	}
    	if(empty($_POST["email"])){
    		$errors["email"] = "Email can't be empty";
    		$valid = false;
    	}else{
    		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
    		//Validate email field
    		$emaiil = trim($email);
    		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    			$valid = false;
    			$errors["email"] = "Invalid email";
    		}
    	}
    	if(empty($_POST["tel"])){
    		$errors["tel"] = "Tel field can't be blank";
    		$valid = false;
    	}else{
    		$tel = filter_var($tel, FILTER_SANITIZE_NUMBER_INT);
    		if(!preg_match($tel_pattern, $tel)){
    			$valid = false;
    			$errors["tel"] = "Telephone number not valid";
    		}
    	}
    	if(empty($_POST["password"])){
    		$errors["password"] = "Password cannot be blank";
    		$valid = false;
    	}else{
    		$password = filter_var($password, FILTER_SANITIZE_STRING);
    		//$password = trim($password);
    		if(!preg_match($password_pattern, $password)){
    			$errors["password"] = "Password invalid.";
    			$valid = false;
    		}
    	}
    	$comment = htmlspecialchars($comment);
    	if($valid){
    						
    		// output the sanitized and validated data
    		
    		echo 'Name: '.$name .'<br>';
    		echo 'Email: '.$email .'<br>';
    		echo 'Tel Number: '.$tel .'<br>';
    		echo 'Password: '.$password .'<br>';
    		echo 'This is the comment: <br> " '.$comment.' "';
    		//Clear fields after successful submission
    		$name=$email=$tel=$password=$comment="";
    	}	
    }
    ?>
     
    <! DOCTYPE html>
    <html lang="en">
    <head>
    	<meta charset="UTF-8">
    	<title>Registration Form</title>
    	<style>
    	form{
    		width:25%;
    		margin:40px auto;
    		
    	}
    	input{
    		display:block;
    		width:80%;
    		margin:10px 20px;
    		padding:10px 0;
    		
    	}
    	textarea{
    		width:80%;
    		margin-left:20px;
    	}
    	input[type="submit"]{
    		margin:20px;
    		padding:20px;
    		background:rgb(0,69,87);
    	}
    	.error{
    		color:red;
    		font-weight:bold;
    	}
    </style>
    </head>
    <body>
    	<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    		
    		<input type="text" name="name"  placeholder="Name ..." value="<?php echo (empty($name)? '': $name) ?>">
    		<span class="error"><?php echo (!empty($errors["name"])? $errors["name"]:'') ?></span>
    		
    		<input type="email" name="email" placeholder="Email..." value="<?php echo (empty($email)? '': $email) ?>" >
    		<span class="error"><?php echo (!empty($errors["email"])? $errors["email"]:'') ?></span>
    		
    		<input type="tel" name="tel" placeholder="Phone number..." value="<?php echo (empty($tel)? '': $tel) ?>">
    		<span class="error"><?php echo (!empty($errors["tel"])? $errors["tel"]:'') ?></span>
    		
    		<input type="password" name="password" placeholder="Password..." value="<?php echo (empty($password)? '': $password) ?>">
    		<span class="error"><?php echo (!empty($errors["password"])? $errors["password"]:'') ?></span>
    		
    		<textarea name="comment" col=30 rows=5 placeholder="Type your text here..." ></textarea>
    		
    		<input type="submit" name="submit" value="Submit">
    	</form>
    </body>
    </html>