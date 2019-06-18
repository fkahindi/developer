<?php
//Initialize session
session_start();

//include necessary the files

include __DIR__ .'/../includes/DatabaseConnection.php';
include __DIR__ . '/../classes/DatabaseTable.php';

$fullname = $username = $profile_photo = $email = $password = $confirm_password = $new_password = $old_password = $confirm_new_password ='';

$errors =[];
$valid = true;
$pattern = "/^[a-zA-Z_0-9]*$/"; // Matches letters, numbers and the underscore

//This section handles user sign ups (user registration)

if(isset($_POST['signup'])){
	
	//Assign variables
	$fullname = $_POST['fullname'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	
	//Incase any field is left blank
	if(!empty($_POST['fullname'])){
		$fullname = test_input($_POST['fullname']);
	}else{
		$fullname = '';
	}
	if(empty($_POST['username'])){
		$valid = false;
		$errors['username'] = 'Name cannot be blank';
	}else{
		
		$username = test_input($_POST['username']);
		$username = trim($username);
				
		//Check if name contain only aphabet, numbers and underscore
		if (!preg_match($pattern,$username)){
			
			$valid = false;
			$errors['username'] = "Only alpha-numeric and underscore allowed in username";  
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
		
		if(!preg_match($pattern, $_POST['password'])){
			$valid = false;
			$errors['password'] ='Only letters, numbers or underscore allowed.';
		}else if(strlen($_POST['password'])<6){
			$valid = false;
			$errors['password'] ='Password must be atleast 6 characters.';
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
			$membersTable = new DatabaseTable($pdo, 'users', 'email');
			$query = $membersTable->selectRecords($email, $username);
			
			if($query->rowCount()>0){
				//User already exists
				$valid = false;
				$row = $query->fetch();
				if($row['username']=== $username){
					$errors['username'] ='This username already exists';
				}else if($row['email']=== $email){
					$errors['email'] = 'This email already exists';
				}
								
				include __DIR__ .'/../templates/signup.html.php';
				
			}else{
				$valid = true;
			}
			
			if($valid){
			$created_at = new DateTime();	
			$created_at = $created_at->format('Y-m-d H:i:s');
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$profile_photo = '/spexproject/resources/photos/profile.png';
			$fields = [
				'fullname'=> $fullname,
				'username'=> $username,
				'profile_photo'=>$profile_photo,
				'email' => $email,
				'password' => $password,
				'created_at' => $created_at
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
	
	if(empty($email)){
		$valid = false;
		$errors['email'] = 'You did not enter your email';
	}else{
		//Remove illegal characters from email
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$valid = false;
			$errors['email'] = 'Invalid email';
		}else{
			$valid = true;
		}
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
						
			$usersTable = new DatabaseTable($pdo,'users', 'email');
			
			$query = $usersTable->selectRecords($email,$username);
				
			//Check if records exists in the database
			if($query->rowCount()==1){
				
				//Fetch the entire record
				$row = $query->fetch();
				
				//Assign record values to variable
				$user_id = $row['user_id'];
				$fullname = $row['fullname'];
				$username = $row['username'];
				$profile_photo = $row['profile_photo'];
				$email = $row['email'];
				$hashed_password = $row['password'];
				
				//Check if the password in database matches the one typed by user
				if(password_verify($password, $hashed_password)){
					//regenerate a new session id
					session_regenerate_id;
					
					//Store data in session variables
					$_SESSION['loggedin'] = true;
					$_SESSION['user_id'] = $user_id;
					$_SESSION['email'] = $email;
					$_SESSION['password']= $hashed_password;
					$_SESSION['fullname'] = $fullname;
					$_SESSION['username'] = $username;
					$_SESSION['profile_photo']= $profile_photo;
						
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
	
	if(!preg_match($pattern, $new_password)){
		$valid = false;
		$errors['new_password'] ='Only letters, numbers or underscore allowed.';
	}else if(strlen($new_password)<6){
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
			$membersTable = new DatabaseTable($pdo,'users', 'email');
			$query = $membersTable->selectRecords($_SESSION['email'],$_SESSION['username']);
			
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
				
				$sql=$membersTable->updateRecords($fields);
				
				session_destroy();
			
				//Set global variables to display on the login form
				
				$GLOBALS['successMsg'] = 'Update successful.';
				$GLOBALS['loginMsg'] = 'Please, login with your new password';
				
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
			$membersTable = new DatabaseTable($pdo, 'users', 'email');
			
			$query = $membersTable->selectRecords($_POST['email'],$username);
			
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

	$email = $_POST['email'];
	$token = $_POST['token'];
	
	if(!empty($_POST['new_password'])){
		$valid = true;
		$new_password = trim($_POST['new_password']);
		
		if(!preg_match($pattern,$new_password)){
			$valid = false;
			$errors['new_password'] ='Only letter, numbers or underscore allowed.';
		}else if(strlen($new_password)<6){
			$valid = false;
			$errors['new_password'] ='Password must be atleast 6 characters.';
		}		
	}else{
		$valid = false;
		$errors['new_password'] = 'Password cannot be blank.';
	}
	
	if(empty($_POST['confirm_new_password'])){
		$valid = false;
		$errors['confirm_new_password'] = 'Confirm your new password';
		
	}else if($_POST['confirm_new_password'] !== $new_password){
		$valid = false;
		$errors['confirm_new_password'] ='Your passwords did not match';
		
	}else{
		$valid = true;
	}
	
	//If everything is OK and valid is true 
	if($valid){
		
		try{
			
			$curDate = date('Y-m-d H:i:s');
					
			$selectEmailToken = new DatabaseTable ($pdo, 'password_reset_temp', 'token');
			$sql = $selectEmailToken->selectRecords($token, $email);
			
			if(!empty($sql->rowCount())){
				
				$row = $sql->fetch();
				$expDateTimestamp = strtotime($row['expDate']);
				$curDateTimestamp = strtotime($curDate);
				
				if(($curDateTimestamp - $expDateTimestamp)<=86400){
														
					$deleteToken = new DatabaseTable($pdo,'password_reset_temp', 'email');
					$deleteToken->deleteRecords($email);
					
					$new_password = password_hash($new_password, PASSWORD_DEFAULT);
					$_SESSION['email'] = $_POST['email'];
					
					$updatePassword = new DatabaseTable($pdo, 'users', 'email');
					
					$fields = ['password'=> $new_password];
					
					$updatePassword->updateRecords($fields);
					
					session_destroy();
					
					//Redirect to login page
					$successMsg ='You have changed your password.';
					$loginMsg ='Please, login with your new password';
									
					header('Location: ../templates/login.html.php');
								
				}else{
					//$valid = false;
					echo 'The token expired';
					exit();
				}
			
			}else{
				//$valid = false;
				echo 'Token was not found, please try again';
				exit();
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
			$username= $_SESSION['username'];
			
			try{
				$membersTable = new DatabaseTable($pdo, 'users', 'email');
				$query = $membersTable->selectRecords($email, $username);
				
				if($query->rowCount()>0){
					$row = $query->fetch();
					
					//Set the session photo path again	
					$id = $row['user_id'];
				}
				
			}catch(PDOException $e){
					$title ='An error has occured';
					$output = 'Database error: ' . $e->getMessage() . ' in '
					. $e->getFile() . ':' . $e->getLine();
			}
			
			//Prepare file by renaming the image file with account session name
			if(!empty($_SESSION['fullname'])){
				$fullname_arr = explode(' ',$_SESSION['fullname']);
				$name = implode($fullname_arr);
			}else{
				$name = $_SESSION['username'];
			}
			
						
			//Split the original file name and take the extension name
			$file_pieces = explode('.',$_FILES['fileToUpload']['name']);
			$extension = $file_pieces[1];
			
			//To ensure filename uniqueness combine name with user id, add sufix -0 and the extension name
			$target_file = strtolower($name .'-0'. $id .'.'.$extension);
			
			if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],'../resources/photos/'.$target_file)){
				$file_path = '/spexproject/resources/photos/'.$target_file;
											
				try{
					$fields = ['profile_photo' => $file_path];
					
					$membersTable->update($fields);
					
					//Fetch the records again to place the image photo in session
					$query = $membersTable->selectRecords($email, $username);
					if($query->rowCount()== 1){
						$row = $query->fetch();
						
						//Set the session photo path again	
						$_SESSION['profile_photo'] = $row['profile_photo'];
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