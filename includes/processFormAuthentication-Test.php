<?php
//Initialize session
session_start();

//include necessary the files

include __DIR__ .'/../includes/DatabaseConnection.php';
include __DIR__ . '/../classes/DatabaseTable.php';

$fullname = $photo = $email = $password = $confirm_password = $new_password = $old_password ='';

$errors =[];
$valid = true;

//This section handles user sign ups (user registration)

if(isset($_POST['signup'])){
	
	//Assign variables
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	
	//Incase any field is left blank
	if(empty($_POST['fullname'])){
		$valid = false;
		$errors['fullname'] = 'Name cannot be blank';
	}else{
		
		$fullname = test_input($_POST['fullname']);
				
		//Check if name contain only aphabet and whitespaces
		if (!preg_match("/^[a-zA-Z ]*$/",$fullname)){
			
			$valid = false;
			$errors['fullname'] = "Only letters and white space allowed in names";  
		} 
	}
	
	if(empty($_POST['email'])){
		$valid = false;
		$errors['email'] ='Email cannot be blank';
	}else{
		
		//Remove spaces incase they exist
		$email = trim($_POST['email']);
		//Remove illegal characters from email
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		//Check if email address is well formed
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$valid = false;
			$errors['email'] = 'Invalid email address';
		}	
	}

	if(!empty($_POST['password'])){
		
		$valid = true;
		$_POST['password'] = trim($_POST['password']);
		
		if(strlen($_POST['password'])<8){
			$valid = false;
			$errors['password'] ='Password must be atleast 8 characters.';
		}
	}else{
		$valid = false;
		$errors['password'] ='Password cannot be blank';
	}
	
	if(empty($_POST['confirm_password'])){
		
		$valid = false;
		$errors['confirm_password'] ='Must confirm Password';
		
	}else if($_POST['password'] != $_POST['confirm_password']){
		
		$valid = false;
		$errors['confirm_password'] = 'Passwords did not match';
	}
	
	if(!empty($errors)){
	
		include __DIR__ .'/../templates/signup.html.php';
				
	}else{
		try{			
			$membersTable = new DatabaseTable($pdo, 'members', 'email');
			$query = $membersTable->selectRecords($email);
			
			if($query->rowCount()==1){
				$valid = false;
				$errors['email'] = 'This email already exists';
				
				include __DIR__ .'/../templates/signup.html.php';
				
			}else{
				$valid = true;
			}
			
			if($valid){
			$date_reg = new DateTime();	
			$date_reg = $date_reg->format('Y-m-d H:i:s');
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			
			$fields = [
				'fullname'=> $fullname,
				'email' => $email,
				'password' => $password,
				'date_reg' => $date_reg
			];
			
			$membersTable->insertRecord($fields);
					
			header('Location: ../templates/signupsuccessful.html.php');
			}

		}catch(PDOException $e){
			$title ='An error has occured';
			$output = 'Database error: ' . $e->getMessage() . ' in '
			. $e->getFile() . ':' . $e->getLine();
		}	
	}
}
	
// This section handles user logins
if(isset($_POST['login'])){
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	if(empty($_POST['email'])){
		$valid = false;
		$errors['email'] = 'You did not enter your email';
	}else{
		//Remove illegal characters from email
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	} 
		
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$valid = false;
		$errors['email'] = 'Invalid email';
	}else{
		$valid = true;
	}
	
	if(empty($_POST['password'])){
		$valid = false;
		$errors['password'] = 'You did not type a password';
	}else{
		$valid = true;
		$password =trim($_POST['password']);
	}
	if(!$valid){
		include __DIR__ . '/../templates/login.html.php';
	}else{
		
		try{
						
			$membersTable = new DatabaseTable($pdo,'members', 'email');
			
			$query = $membersTable->selectRecords($_POST['email']);
				
			//Check if records exists in the database
			if($query->rowCount()==1){
				
				//Fetch the entire record
				$row = $query->fetch();
				
				//Assign record values to variable
				$id = $row['id'];
				$fullname = $row['fullname'];
				$photo = $row['photo'];
				$email = $row['email'];
				$hashed_password = $row['password'];
				
				//Check if the password in database matches the one typed by user
				if(password_verify($password, $hashed_password)){
					//regenerate a new session id
					session_regenerate_id;
					
					//Store data in session variables
					$_SESSION['loggedin'] = true;
					$_SESSION['email'] = $email;
					$_SESSION['password']= $hashed_password;
					$_SESSION['fullname'] = $fullname;
					$_SESSION['photo']= $photo;
						
					//Redirect to welcome page
					header('Location: ../templates/welcome.html.php');	
				}else{
					//Display password error 
					
					$errors['password'] ='Incorrect email or password';
												
					include __DIR__ . '/../templates/login.html.php';
				}
				
			}else{
				//Display error message: the email does not exist
				$errors['email'] ='Email address does not exist';
				
				//Display login form again
				include __DIR__ . '/../templates/login.html.php';
			}	

		}catch(PDOException $e){
		$title ='An error has occured';
		$output = 'Database error: ' . $e->getMessage() . ' in '
		. $e->getFile() . ':' . $e->getLine();
		}

	}
	
}
	
if(isset($_POST['change_password'])){

	$old_password = $_POST['old_password'];
	$new_password = $_POST['new_password'];
	$confirm_new_password = $_POST['confirm_new_password'];
	
	//If loggedin validate form
	if(empty($_POST['old_password'])){
		$valid = false;
		$errors['old_password'] = 'You must enter your old password';
	}else if(empty($new_password)){
		$valid = false;
		$errors['new_password'] = 'Enter the new password';
	}else if(empty($confirm_new_password)){
		$valid = false;
		$errors['confirm_new_password'] = 'Confirm your new password';
	}else{
		$new_password = trim($new_password);
		$confirm_new_password = trim('confirm_new_password');
	}
	if(strlen($new_password)<6){
		$valid = false;
		$errors['new_password'] ='Password must be atleast 6 characters.';
	}else if($_POST['new_password'] !== $_POST['confirm_new_password']){
		$valid = false;
		$errors['confirm_new_password'] ='Your new password did not match';
	}else{
		$valid = true;
	}
		
	if(!$valid){
		include __DIR__ . '/../templates/change-password.html.php';
	}else{
		
		try{
			
			$membersTable = new DatabaseTable($pdo,'members', 'email');
			$query = $membersTable->selectRecords($_SESSION['email']);
			
			if($query->rowCount()==1){
				
				$row=$query->fetch();
				
				$hashed_password = $row['password'];
				$old_password = $_POST['old_password'];
				
				if(password_verify($old_password, $hashed_password) && (!empty($_SESSION['email']))){
					
					$valid = true;
					
				}else{
					
					$valid = false;
					$errors['old_password'] = 'Password is incorrect';
					
					include __DIR__ . '/../templates/change-password.html.php';		
				}
				
			}else{
				$valid = false;
				$errors['email'] = 'Sorry, you need to login.';
				include __DIR__ . '/../templates/login.html.php';
			}
			
			if($valid){
		
				$new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
				$email = $_SESSION['email'];
				
				$fields =['password'=> $new_password];
				
				$membersTable->update($fields);
				
				session_destroy();
				
				//Set global variables to display on the login form
				$successMsg ='Update successful.';
				$loginMsg ='Please, login with your new password';
				$GLOBALS['success_msg'];
				$GLOBALS['loginMsg'];
				
				//Redirect to login page
				header('Location: ../templates/login.html.php');
			
			}
		}catch(PDOException $e){
			
			$title ='An error has occured';
			$output = 'Database error: ' . $e->getMessage() . ' in '
			. $e->getFile() . ':' . $e->getLine();
		}
	}
}
	
if(isset($_POST['recover_password'])){
	
	$email = $_POST['email'];
			
	if(empty($_POST['email'])){
		$valid = false;
		$errors['email'] = 'Enter your email address';
		
	}else{
		filter_var($email, FILTER_SANITIZE_EMAIL);
	
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$valid = false;
				$errors['email'] = 'Invalid email';
			}else{
				$valid = true;
			}
	}		
	if(!$valid){
		//Display the form again
		include __DIR__ . '/../templates/recover-password.html.php';
		
	}else{
		
		try{
			$membersTable = new DatabaseTable($pdo, 'members', 'email');
			
			$query = $membersTable->selectRecords($_POST['email']);
			
			if(empty($query->rowCount())){
				$valid = false;
				$errors['email'] = 'This email address is not registered';
				include __DIR__ . '/../templates/recover-password.html.php';
			}else{
				$valid = true;
				if($row=$query->fetch()){
				$email = $row['email'];
				$password = $row['password'];
				}
			}
			
			if($valid){
				$expDate = new DateTime();	
				$expDate = $expDate->format('Y-m-d H:i:s');				
				$token = bin2hex(random_bytes(50));
				
				$fields =[
					'email' => $email,
					'token' => $token,
					'expDate' => $expDate
				];
				$password_resetTable =  new DatabaseTable($pdo, 'password_reset_temp');
				$password_resetTable->insertRecord($fields);
				
				include __DIR__. '/../includes/sendLink.php';
			}
		}catch(PDOException $e){
			
			$title ='An error has occured';
			$output = 'Database error: ' . $e->getMessage() . ' in '
			. $e->getFile() . ':' . $e->getLine();
		}
		
		
	}
	
}
	
if(isset($_POST['reset_password'])){	
	$new_password = $_POST['new_password'];
	$confirm_new_password = $_POST['confirm_new_password'];
	$email = filter_input(INPUT_GET, 'email');
	$token = filter_input(INPUT_GET, 'key');
	
	if(empty($_POST['new_password'])){
		$valid = false;
		$errors['new_password'] = 'Type your new password';
	}else if(empty($_POST['confirm_new_password'])){
		$valid = false;
		$errors['confirm_new_password'] = 'Confirm your new password';
	}else if($_POST['new_password'] != $_POST['confirm_new_password']){
		$valid =false;
		$errors['confirm_new_password'] = 'Passwords did not match'; 
	}else{
		$valid = true;
		$new_password = trim($_POST['new_password']);
	}
		
	if($valid){
		
		try{
			
			if(isset($_GET['key']) && isset($_GET['email']) && isset($_GET['action'])){	
				$token = $_GET['key'];
				$email = $_GET['email'];
				$curDate = date('Y-m-d H:i:s');
				$new_password = $_POST['new_password'];
				
				$selectPasswordTemp = selectPasswordTemp($pdo, $email, $token);
				
				if(!empty($selectPasswordTemp->rowCount)){
					$expDateTimestamp = strtotime('expDate');
					$curDateTimestamp = strtotime($curDate);
					
					if((date_diff($expDateTimestamp, $curDateTimestamp)<=86400)){
						
						$valid = true;
						deleteToken($pdo, $email);
						
					}else{
						
						echo 'The token expired';
					}
				}else{
					
					echo 'The link din\'t work, please try again';
				}
				
				if($valid){
					$new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
					$email = $_GET['email'];
					$new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
			
					$update = updatePassword($pdo, $new_password, $email);
					
					session_destroy();
					
					//Redirect to login page
					$successMsg ='You have changed your password.';
					$loginMsg ='Please, login with your new password';
					$GLOBALS['successMsg'];
					$GLOBALS['loginMsg'];
					
					header('Location: ../templates/login.html.php');
							
				}else{
							echo 'Password was not changed, please try again';
				}	
			}	
		}catch(PDOException $e){
		
		$title ='An error has occured';
		$output = 'Database error: ' . $e->getMessage() . ' in '
		. $e->getFile() . ':' . $e->getLine();
		}
			
	}else{
		//Display the form again
		include __DIR__ . '/../templates/reset-password.html.php';
	}
		
}


if(isset($_POST['image-upload'])){
	require __DIR__ . '/loginStatus.php';
	
	$target_dir = '../resources/photos/';
	$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	
	try{	
		//Check if an image has been selected
	
		if(getimagesize($_FILES['fileToUpload']['tmp_name']) !== false){
			
			// Check file size
			if($_FILES['fileToUpload']['size']>500000){
				$uploadOk = 0;
				$errors['fileToUpload'] = 'Sorry, your file is too large';

				include __DIR__ . '/../templates/imageupload.html.php';
				
				// Allow only .jpg, .png and .gif file formats
			}else if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif'){
				$uploadOk = 0;
				$errors['fileToUpload'] = 'Sorry, only JPG and PNG files are allowed';
				
				include __DIR__ . '/../templates/imageupload.html.php';
			}else{
				$uploadOk = 1;
			
			}
			
		}else{
			$uploadOk = 0;
			$errors['fileToUpload'] =  'No image was selected.';	
			
			include __DIR__ . '/../templates/imageupload.html.php';
		}
		
		//If everything is ok, try to upload the file
		if($uploadOk == 1){
			
			//Get the user name id to use in the file name
			$email = $_SESSION['email'];
			
			try{
				$membersTable = new DatabaseTable($pdo, 'members', 'email');
				$query = $membersTable->selectRecords($email);
				
				if($query->rowCount()== 1){
					$row = $query->fetch();
					
					//Set the session photo path again	
					$id = $row['id'];
				}
				
			}catch(PDOException $e){
					$title ='An error has occured';
					$output = 'Database error: ' . $e->getMessage() . ' in '
					. $e->getFile() . ':' . $e->getLine();
			}
			
			//Prepare file by renaming the image file with account session name
			$fullname_arr = explode(' ',$_SESSION['fullname']);
			$name = implode($fullname_arr);
			
			//Split the original file name and take the extension name
			$file_pieces = explode('.',$_FILES['fileToUpload']['name']);
			$extension = $file_pieces[1];
			
			//To ensure filename uniqueness combine name with user id, add sufix -0 and the extension name
			$target_file = strtolower($name .'-0'. $id .'.'.$extension);
			
			if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],'../resources/photos/'.$target_file)){
				$file_path = '/spexproject/resources/photos/'.$target_file;
											
				try{
					$fields = ['photo' => $file_path];
					
					$membersTable->update($fields);
					
					//Fetch the records again to place the image photo in session
					$query = $membersTable->selectRecords($email);
					if($query->rowCount()== 1){
						$row = $query->fetch();
						
						//Set the session photo path again	
						$_SESSION['photo'] = $row['photo'];
					}			
					
					echo 'Your photo has been updated. You may need to refresh the page for it to reflect. <br>';
					echo '<a href="../index.php">Continue</a>';
										
				}catch(PDOException $e){
					$title ='An error has occured';
					$output = 'Database error: ' . $e->getMessage() . ' in '
					. $e->getFile() . ':' . $e->getLine();
				}
				
			}else{
				echo 'Sorry, there was an error uploading your file.';
			}		
		}
	}catch(Exception $e){
		echo 'Caught Exception: ' . $e->getMessage();
	}
}
		
	function test_input($data){
	
	$data = stripslashes($data);
	$data = htmlspecialchars($data, ENT_QUOTES);
	return $data;
	}