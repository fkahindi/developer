<?php
//check if user already loged in, if not redirect to login page
if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin']!= true){
		header('Location: /spexproject/templates/login.html.php');
		exit;
	}else{
		if(!empty($_SESSION['email'])){
			include __DIR__ . '/DatabaseConnection.php';
			
			$sql = 'SELECT * FROM `users` WHERE email = :email';
			
			$stmt=$pdo->prepare($sql);
			$stmt->bindValue(':email', $_SESSION['email']);
			
			$stmt->execute();
			
			if($stmt->rowCount() == 1){
				//The session email is in the database
				if($row = $stmt->fetch()){
					$email = $row['email'];
					$hashed_password = $row['password'];
					
					//Check whether session email and password match the ones in the database
					if($_SESSION['email']== $email && $_SESSION['password'] == $hashed_password){
						
						$_SESSION['loggedin'] = true;
						
					}else{
						//There is a problem, the user session using someones session
						include __DIR__ . '/../includes/logout.php';
					}
				}else{
					echo 'User could not be verified';
				}
			}
		}
	}