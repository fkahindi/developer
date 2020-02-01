<?php
//Initialize the session_cache_expire
session_start();

//Check if the user is logged in, if not redirect to the login page
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
	header('Location: ../templates/login.html.php');
	exit;
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
<h4>Welcome <?php echo (!empty($_SESSION['username'])? $_SESSION['username']:'');?></h4>
<p> <a href="../index.php"> Continue</a>.</p>
</body>
</html>